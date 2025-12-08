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

        // Ambil data dengan pagination
        $arsips = $query->latest('tanggal_arsip')->paginate(10)->appends($request->query());

        return view('admin.arsip.index', [
            'arsips' => $arsips,
            'totalArsip' => Arsip::count(),
            'totalSuratMasuk' => Arsip::where('kategori', 'Surat Masuk')->count(),
            'totalSuratKeluar' => Arsip::where('kategori', 'Surat Keluar')->count(),
            'totalDokumen' => Arsip::where('kategori', 'Dokumen Penting')->count(),
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
            'kategori'      => 'required|in:Surat Masuk,Surat Keluar,Dokumen Penting',
            'deskripsi'     => 'nullable|string',
            'tanggal_arsip' => 'required|date',
            // Validasi Array File
            'file_lampiran'   => 'nullable|array',
            'file_lampiran.*' => 'file|mimes:pdf,doc,docx,xlsx,xls,jpg,jpeg,png|max:5120', // Max 5MB per file
        ]);

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
                // Buat nama unik: WAKTU_UNIQID_NAMAASLI
                $filename = time() . '_' . uniqid() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());

                // Simpan ke storage (folder public/arsip-files)
                $path = $file->storeAs('arsip-files', $filename, 'public');

                $filePaths[] = $path;
            }

            // Simpan sebagai array (Model sudah ada casts array, jadi tidak perlu json_encode manual)
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
            'kategori'      => 'required|in:Surat Masuk,Surat Keluar,Dokumen Penting',
            'deskripsi'     => 'nullable|string',
            'tanggal_arsip' => 'required|date',
            'file_lampiran'   => 'nullable|array',
            'file_lampiran.*' => 'file|mimes:pdf,doc,docx,xlsx,xls,jpg,jpeg,png|max:5120',
        ]);

        $validated['status'] = $request->has('status') ? 'Aktif' : 'Tidak Aktif';

        // 2. Proses File Baru (Jika User Mengupload Ulang)
        if ($request->hasFile('file_lampiran')) {

            // A. Hapus File-file Lama dari Storage
            if ($arsip->file_lampiran) {
                // Gunakan helper/logic array check
                $oldFiles = $this->getFilesArray($arsip->file_lampiran);
                foreach ($oldFiles as $oldFile) {
                    if (Storage::disk('public')->exists($oldFile)) {
                        Storage::disk('public')->delete($oldFile);
                    }
                }
            }

            // B. Upload File-file Baru
            $filePaths = [];
            foreach ($request->file('file_lampiran') as $file) {
                $filename = time() . '_' . uniqid() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
                $path = $file->storeAs('arsip-files', $filename, 'public');
                $filePaths[] = $path;
            }

            // Simpan path baru
            $validated['file_lampiran'] = $filePaths;

        } else {
            // Jika tidak ada file baru, jangan update kolom ini (tetap pakai data lama)
            unset($validated['file_lampiran']);
        }

        // 3. Update Database
        $arsip->update($validated);

        // 4. Redirect dengan Pesan Khusus
        // Mengambil nomor arsip terbaru untuk pesan notifikasi
        return redirect()->route('admin.arsip.index')
            ->with('success', "Arsip dengan nomor {$arsip->nomor_arsip} berhasil update");
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
     * Helper: Decode JSON atau String Biasa (Backward Compatibility)
     * Mengubah data database menjadi Array PHP
     */
    private function getFilesArray($fileData)
    {
        // Jika data sudah array (karena model casting), kembalikan langsung
        if (is_array($fileData)) {
            return $fileData;
        }

        // Coba decode JSON jika string
        $decoded = json_decode($fileData, true);

        // Jika valid JSON dan bentuknya array, kembalikan array tersebut
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            return $decoded;
        }

        // Jika bukan JSON (data lama berupa string path tunggal), jadikan array
        return [$fileData];
    }
}
