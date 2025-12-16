<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KegiatanGaleri;
use App\Models\FotoGaleri;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    // 📸 Tampilkan semua kegiatan galeri
    public function index()
    {
        $galeri = KegiatanGaleri::latest()->get();
        return view('admin.galeri.index', compact('galeri'));
    }

    // ➕ Form tambah kegiatan baru
    public function create()
    {
        return view('admin.galeri.create');
    }

    // 💾 Simpan kegiatan baru
    // 💾 Simpan kegiatan baru + Foto Dokumentasi sekaligus
    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'judul_kegiatan' => 'required|string|max:255',
            'deskripsi_singkat' => 'required|string',
            'tanggal_kegiatan' => 'required|date',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',

            // Validasi untuk multiple foto dokumentasi
            'url_foto' => 'nullable', // Boleh kosong jika belum ada foto
            'url_foto.*' => 'image|mimes:jpeg,png,jpg|max:2048' // Validasi tiap file
        ]);

        // 2. Simpan Data Utama (Kegiatan)
        $data = $request->only(['judul_kegiatan', 'deskripsi_singkat', 'tanggal_kegiatan']);

        // Upload Thumbnail (Cover)
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('uploads/galeri/thumbnail', 'public');
            $data['thumbnail_url'] = $path;
        }

        // Simpan ke database dan TAMPUNG ke variabel $kegiatan agar kita dapat ID-nya
        $kegiatan = KegiatanGaleri::create($data);

        // 3. Simpan Foto Dokumentasi (Looping)
        // Kita gunakan $kegiatan->id_kegiatan yang baru saja dibuat
        if ($request->hasFile('url_foto')) {
            foreach ($request->file('url_foto') as $file) {
                // Upload foto ke storage
                $pathFoto = $file->store('uploads/galeri/foto', 'public');

                // Simpan ke tabel foto_galeri
                FotoGaleri::create([
                    'id_kegiatan' => $kegiatan->id_kegiatan, // Ambil ID dari kegiatan baru
                    'url_foto' => $pathFoto,
                    'deskripsi_foto' => null // Kosongkan default, atau isi string
                ]);
            }
        }

        return redirect()->route('admin.galeri.index')->with('success', 'Kegiatan dan foto dokumentasi berhasil ditambahkan.');
    }
    // ✏️ Edit kegiatan (Tampilkan Form Edit & Upload Foto)
    public function edit($id)
    {
        // Kita load juga relasi 'fotoGaleri' agar bisa ditampilkan list fotonya
        $kegiatan = KegiatanGaleri::with('fotoGaleri')->findOrFail($id);
        return view('admin.galeri.edit', compact('kegiatan'));
    }

    // 🔄 Update data kegiatan utama (Judul, Deskripsi, Thumbnail)
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul_kegiatan' => 'required|string|max:255',
            'deskripsi_singkat' => 'required|string',
            'tanggal_kegiatan' => 'required|date',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $kegiatan = KegiatanGaleri::findOrFail($id);
        $data = $request->only(['judul_kegiatan', 'deskripsi_singkat', 'tanggal_kegiatan']);

        if ($request->hasFile('thumbnail')) {
            // Hapus thumbnail lama
            if ($kegiatan->thumbnail_url && Storage::disk('public')->exists($kegiatan->thumbnail_url)) {
                Storage::disk('public')->delete($kegiatan->thumbnail_url);
            }
            $path = $request->file('thumbnail')->store('uploads/galeri/thumbnail', 'public');
            $data['thumbnail_url'] = $path;
        }

        $kegiatan->update($data);

        return redirect()->route('admin.galeri.index')->with('success', 'Kegiatan galeri berhasil diperbarui.');
    }

    // 🗑️ Hapus kegiatan beserta semua fotonya
    public function destroy($id)
    {
        $kegiatan = KegiatanGaleri::findOrFail($id);

        // Hapus thumbnail jika ada
        if ($kegiatan->thumbnail_url && Storage::disk('public')->exists($kegiatan->thumbnail_url)) {
            Storage::disk('public')->delete($kegiatan->thumbnail_url);
        }

        // Hapus seluruh foto dokumentasi terkait
        foreach ($kegiatan->fotoGaleri as $foto) {
            if (Storage::disk('public')->exists($foto->url_foto)) {
                Storage::disk('public')->delete($foto->url_foto);
            }
            $foto->delete();
        }

        $kegiatan->delete();

        return redirect()->route('admin.galeri.index')->with('success', 'Kegiatan galeri berhasil dihapus.');
    }

    // 📤 [UPDATE] Upload BANYAK foto dokumentasi
    public function uploadFoto(Request $request, $id)
    {
        $request->validate([
            // Validasi array input
            'url_foto' => 'required',
            // Validasi tiap item di dalam array
            'url_foto.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi_foto' => 'nullable|string|max:255'
        ]);

        // Cek apakah ada file
        if ($request->hasFile('url_foto')) {
            // Looping setiap file yang diupload
            foreach ($request->file('url_foto') as $file) {
                // Simpan file ke storage
                $path = $file->store('uploads/galeri/foto', 'public');

                // Simpan ke database
                FotoGaleri::create([
                    'id_kegiatan' => $id,
                    'url_foto' => $path,
                    'deskripsi_foto' => $request->deskripsi_foto // Deskripsi sama untuk batch ini
                ]);
            }
        }

        return back()->with('success', 'Foto-foto berhasil ditambahkan.');
    }

    // ❌ Hapus satu foto dokumentasi spesifik
    public function destroyFoto($id)
    {
        $foto = FotoGaleri::findOrFail($id);

        if ($foto->url_foto && Storage::disk('public')->exists($foto->url_foto)) {
            Storage::disk('public')->delete($foto->url_foto);
        }

        $foto->delete();

        return back()->with('success', 'Foto berhasil dihapus.');
    }
}
