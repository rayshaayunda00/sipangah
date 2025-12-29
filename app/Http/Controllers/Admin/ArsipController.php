<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Arsip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArsipController extends Controller
{
    /**
     * Menampilkan daftar arsip (Read)
     */
   public function index(Request $request)
{
    $query = Arsip::query();

    // 1. Filter Pencarian
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('nomor_arsip', 'like', "%{$search}%")
              ->orWhere('judul_arsip', 'like', "%{$search}%")
              ->orWhere('kategori', 'like', "%{$search}%");
        });
    }

    // 2. Filter Kategori
    if ($request->filled('kategori') && $request->kategori != 'all') {
        $query->where('kategori', $request->kategori);
    }

    // Ambil data untuk tabel
    $arsips = $query->latest('tanggal_arsip')->paginate(10)->appends($request->query());

    // --- LOGIKA BARU UNTUK STATISTIK DINAMIS ---

    // Ambil list kategori unik saja
    $kategoriList = Arsip::select('kategori')->distinct()->pluck('kategori');

    // Hitung jumlah per kategori
    // Hasilnya akan berupa array: ['Surat Masuk' => 10, 'Surat Keluar' => 5, 'Laporan' => 2]
    $statsPerKategori = Arsip::select('kategori', \DB::raw('count(*) as total'))
                             ->groupBy('kategori')
                             ->pluck('total', 'kategori');

    return view('admin.arsip.index', [
        'arsips' => $arsips,
        'kategoriList' => $kategoriList,
        'totalArsip' => Arsip::count(),
        'statsPerKategori' => $statsPerKategori, // <-- Kirim variabel ini
    ]);
}
    /**
     * Menampilkan form tambah (Create)
     */
    public function create()
    {
        return view('admin.arsip.create');
    }

    /**
     * Menyimpan data baru ke database (Store)
     */
    public function store(Request $request)
    {
        // 1. Validasi
        $validated = $request->validate([
            'nomor_arsip'   => 'nullable|string|max:255|unique:arsips,nomor_arsip',
            'judul_arsip'   => 'required|string|max:255',
            // Validasi kategori dilonggarkan (tidak pakai in:...)
            'kategori'      => 'required|string',
            // Validasi kategori_lain wajib diisi JIKA kategori == Lainnya
            'kategori_lain' => 'required_if:kategori,Lainnya|nullable|string|max:255',
            'deskripsi'     => 'nullable|string',
            'tanggal_arsip' => 'required|date',
            'file_lampiran'   => 'nullable|array',
            'file_lampiran.*' => 'file|mimes:pdf,doc,docx,xlsx,xls,jpg,jpeg,png|max:5120', // Max 5MB per file
        ]);

        // LOGIKA BARU: Jika pilih "Lainnya", ambil nilai dari input teks
        if ($request->kategori == 'Lainnya') {
            $validated['kategori'] = $request->kategori_lain;
        }

        // Hapus key kategori_lain agar tidak error saat insert (karena kolom ini tidak ada di DB)
        unset($validated['kategori_lain']);

        // 2. Set Status
        $validated['status'] = $request->has('status') ? 'Aktif' : 'Tidak Aktif';

        // 3. Generate Nomor Arsip jika kosong
        if (empty($validated['nomor_arsip'])) {
            $validated['nomor_arsip'] = $this->generateNomorArsip();
        }

        // 4. Proses Multiple Upload
        if ($request->hasFile('file_lampiran')) {
            $filePaths = [];

            foreach ($request->file('file_lampiran') as $file) {
                $filename = time() . '_' . uniqid() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
                $path = $file->storeAs('arsip-files', $filename, 'public');
                $filePaths[] = $path;
            }
            $validated['file_lampiran'] = $filePaths;
        }

        // 5. Simpan Data
        Arsip::create($validated);

        return redirect()->route('admin.arsip.index')->with('success', 'Arsip berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail arsip (Show)
     */
    public function show(Arsip $arsip)
    {
        return view('admin.arsip.show', compact('arsip'));
    }

    /**
     * Menampilkan form edit (Edit)
     */
    public function edit(Arsip $arsip)
    {
        return view('admin.arsip.edit', compact('arsip'));
    }

    /**
     * Memperbarui data (Update)
     */
    public function update(Request $request, Arsip $arsip)
    {
        // 1. Validasi
        $validated = $request->validate([
            'nomor_arsip'   => 'nullable|string|max:255|unique:arsips,nomor_arsip,' . $arsip->id,
            'judul_arsip'   => 'required|string|max:255',
            'kategori'      => 'required|string',
            'kategori_lain' => 'required_if:kategori,Lainnya|nullable|string|max:255',
            'deskripsi'     => 'nullable|string',
            'tanggal_arsip' => 'required|date',
            'file_lampiran'   => 'nullable|array',
            'file_lampiran.*' => 'file|mimes:pdf,doc,docx,xlsx,xls,jpg,jpeg,png|max:5120',
        ]);

        // Handle Kategori Custom
        if ($request->kategori == 'Lainnya') {
            $validated['kategori'] = $request->kategori_lain;
        }
        unset($validated['kategori_lain']);

        $validated['status'] = $request->has('status') ? 'Aktif' : 'Tidak Aktif';

        // --- LOGIKA FILE MANAGEMENT BARU ---

        // 1. Ambil file yang sudah ada di database (sebagai array)
        $currentFiles = $this->getFilesArray($arsip->file_lampiran);

        // 2. Cek apakah ada file lama yang ingin dihapus user
        // Input 'deleted_files' dikirim dari form (hidden input)
        if ($request->has('deleted_files')) {
            $filesToDelete = $request->input('deleted_files');

            foreach ($filesToDelete as $fileToDelete) {
                // Hapus fisik file
                if (Storage::disk('public')->exists($fileToDelete)) {
                    Storage::disk('public')->delete($fileToDelete);
                }

                // Hapus dari array currentFiles
                $key = array_search($fileToDelete, $currentFiles);
                if ($key !== false) {
                    unset($currentFiles[$key]);
                }
            }
            // Re-index array agar urutannya rapi
            $currentFiles = array_values($currentFiles);
        }

        // 3. Proses File Baru (Upload Tambahan)
        $newFilesPath = [];
        if ($request->hasFile('file_lampiran')) {
            foreach ($request->file('file_lampiran') as $file) {
                $filename = time() . '_' . uniqid() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
                $path = $file->storeAs('arsip-files', $filename, 'public');
                $newFilesPath[] = $path;
            }
        }

        // 4. Gabungkan File Sisa (Lama) + File Baru
        $finalFiles = array_merge($currentFiles, $newFilesPath);

        // Simpan ke database
        $validated['file_lampiran'] = $finalFiles;

        $arsip->update($validated);

        return redirect()->route('admin.arsip.index')
            ->with('success', "Arsip berhasil diperbarui");
    }

    /**
     * Menghapus data (Destroy)
     */
    public function destroy(Arsip $arsip)
    {
        // 1. Hapus Fisik File di Storage
        if ($arsip->file_lampiran) {
            $files = $this->getFilesArray($arsip->file_lampiran);

            foreach ($files as $file) {
                if (Storage::disk('public')->exists($file)) {
                    Storage::disk('public')->delete($file);
                }
            }
        }

        // 2. Hapus Record Database
        $arsip->delete();

        return redirect()->route('admin.arsip.index')->with('success', 'Arsip berhasil dihapus!');
    }

    /**
     * Helper: Generate Nomor Arsip Otomatis
     */
    protected function generateNomorArsip()
    {
        $count = Arsip::count() + 1;
        return 'ARS/' . str_pad($count, 3, '0', STR_PAD_LEFT) . '/' . date('m/Y');
    }

    /**
     * Helper: Decode JSON atau String Biasa
     */
    private function getFilesArray($fileData)
    {
        if (is_array($fileData)) {
            return $fileData;
        }
        $decoded = json_decode($fileData, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            return $decoded;
        }
        return [$fileData];
    }
}
