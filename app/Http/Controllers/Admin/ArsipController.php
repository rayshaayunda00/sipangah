<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Arsip; // Pastikan Model Arsip kamu ada di App\Models\Arsip
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Penting untuk hapus/tampil file

class ArsipController extends Controller
{
    /**
     * Menampilkan daftar semua arsip dengan filter dan search.
     */
    public function index(Request $request)
    {
        // Mulai query builder
        $query = Arsip::query();

        // --- Fitur Search ---
        if ($request->filled('search')) {
            $search = $request->search;
            // Grouping 'where' agar (A or B or C) and (D)
            $query->where(function($q) use ($search) {
                $q->where('nomor_arsip', 'like', "%{$search}%")
                  ->orWhere('judul_arsip', 'like', "%{$search}%")
                  ->orWhere('kategori', 'like', "%{$search}%");
            });
        }

        // --- Fitur Filter Kategori ---
        if ($request->filled('kategori') && $request->kategori != 'all') {
            $query->where('kategori', $request->kategori);
        }

        // Ambil hasil query, urutkan, dan paginasi
        // appends() agar filter tidak hilang saat ganti halaman
        $arsips = $query->latest('tanggal_arsip')->paginate(10)->appends($request->query());

        // --- Data Tambahan untuk Stats Card ---
        $totalArsip = Arsip::count();
        $totalSuratMasuk = Arsip::where('kategori', 'Surat Masuk')->count();
        $totalSuratKeluar = Arsip::where('kategori', 'Surat Keluar')->count();
        $totalDokumen = Arsip::where('kategori', 'Dokumen Penting')->count();

        return view('admin.arsip.index', compact(
            'arsips',
            'totalArsip',
            'totalSuratMasuk',
            'totalSuratKeluar',
            'totalDokumen'
        ));
    }

    /**
     * Menampilkan formulir untuk membuat arsip baru.
     */
    public function create()
    {
        return view('admin.arsip.create');
    }

    /**
     * Menyimpan arsip baru ke database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nomor_arsip' => 'nullable|string|max:255|unique:arsips,nomor_arsip',
            'judul_arsip' => 'required|string|max:255',
            'kategori' => 'required|in:Surat Masuk,Surat Keluar,Dokumen Penting',
            'deskripsi' => 'nullable|string',
            'tanggal_arsip' => 'required|date',
            'file_lampiran' => 'nullable|file|mimes:pdf,doc,docx,xlsx,jpg,png|max:2048', // Max 2MB
        ]);

        // Status dari form Switch (Hanya ada jika 'Aktif')
        $validatedData['status'] = $request->has('status') ? 'Aktif' : 'Tidak Aktif';

        // Handle File Upload
        if ($request->hasFile('file_lampiran')) {
            // Menyimpan file di storage/app/public/arsip-files
            $validatedData['file_lampiran'] = $request->file('file_lampiran')->store('public/arsip-files');
        }

        // Jika nomor arsip kosong, isi otomatis
        if (empty($validatedData['nomor_arsip'])) {
            $validatedData['nomor_arsip'] = $this->generateNomorArsip();
        }

        Arsip::create($validatedData);

        return redirect()->route('admin.arsip.index')->with('success', 'Arsip berhasil ditambahkan!');
    }

    /**
     * Fungsi helper untuk generate nomor arsip (Dummy)
     */
    protected function generateNomorArsip() {
        // Contoh sederhana penomoran otomatis
        $count = Arsip::count() + 1;
        // Format: ARS/001/11/2025
        return 'ARS/' . str_pad($count, 3, '0', STR_PAD_LEFT) . '/' . date('m/Y');
    }

    /**
     * Menampilkan detail satu arsip.
     */
    public function show(Arsip $arsip) // Menggunakan Route Model Binding
    {
        // Panggil view 'show' dan kirim data $arsip
        return view('admin.arsip.show', compact('arsip'));
    }

    /**
     * Menampilkan formulir edit arsip.
     */
    public function edit(Arsip $arsip) // Menggunakan Route Model Binding
    {
        return view('admin.arsip.edit', compact('arsip'));
    }

    /**
     * Memperbarui arsip di database.
     */
    public function update(Request $request, Arsip $arsip)
    {
        $validatedData = $request->validate([
            'nomor_arsip' => 'nullable|string|max:255|unique:arsips,nomor_arsip,' . $arsip->id, // Abaikan ID saat ini
            'judul_arsip' => 'required|string|max:255',
            'kategori' => 'required|in:Surat Masuk,Surat Keluar,Dokumen Penting',
            'deskripsi' => 'nullable|string',
            'tanggal_arsip' => 'required|date',
            'file_lampiran' => 'nullable|file|mimes:pdf,doc,docx,xlsx,jpg,png|max:2048',
        ]);

        // Status dari form Switch
        $validatedData['status'] = $request->has('status') ? 'Aktif' : 'Tidak Aktif';

        // Handle File Upload
        if ($request->hasFile('file_lampiran')) {
            // Hapus file lama jika ada
            if ($arsip->file_lampiran) {
                Storage::delete($arsip->file_lampiran);
            }
            // Simpan file baru
            $validatedData['file_lampiran'] = $request->file('file_lampiran')->store('public/arsip-files');
        }
        // Jika tidak ada file baru, $validatedData['file_lampiran'] tidak diset,
        // sehingga data file lama di DB tidak akan tertimpa.

        $arsip->update($validatedData);

        return redirect()->route('admin.arsip.index')->with('success', 'Arsip berhasil diperbarui!');
    }

    /**
     * Menghapus arsip dari database.
     */
    public function destroy(Arsip $arsip)
    {
        // Hapus file dari storage sebelum menghapus record database
        if ($arsip->file_lampiran) {
            Storage::delete($arsip->file_lampiran);
        }

        $arsip->delete();

        return redirect()->route('admin.arsip.index')->with('success', 'Arsip berhasil dihapus!');
    }
}
