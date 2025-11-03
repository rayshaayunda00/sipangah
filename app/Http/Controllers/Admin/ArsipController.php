<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Arsip; // Asumsi Anda memiliki Model Arsip
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Diperlukan untuk manajemen file

class ArsipController extends Controller
{
    /**
     * Menampilkan daftar semua arsip.
     */
    public function index()
    {
        // Implementasi nyata sebaiknya menggunakan pagination:
        // $arsips = Arsip::latest()->paginate(10);

        // Mengikuti contoh KategoriPotensiController:
        $arsips = Arsip::latest()->paginate(10);

        return view('admin.arsip.index', compact('arsips'));
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
            'nomor_arsip' => 'nullable|string|max:255',
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
            // Menyimpan file dan mendapatkan path-nya
            $validatedData['file_lampiran'] = $request->file('file_lampiran')->store('arsip-files');
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
        return 'ARS/' . str_pad($count, 3, '0', STR_PAD_LEFT) . '/' . date('m/Y');
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
            'nomor_arsip' => 'nullable|string|max:255',
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
            $validatedData['file_lampiran'] = $request->file('file_lampiran')->store('arsip-files');
        } else {
             // Jika tidak ada file baru diupload, jangan ikutkan kolom 'file_lampiran'
            unset($validatedData['file_lampiran']);
        }

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
