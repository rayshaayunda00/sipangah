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
    public function store(Request $request)
    {
        $request->validate([
            'judul_kegiatan' => 'required|string|max:255',
            'deskripsi_singkat' => 'required|string',
            'tanggal_kegiatan' => 'required|date',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->only(['judul_kegiatan', 'deskripsi_singkat', 'tanggal_kegiatan']);

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('uploads/galeri/thumbnail', 'public');
            $data['thumbnail_url'] = $path;
        }

        KegiatanGaleri::create($data);

        return redirect()->route('admin.galeri.index')->with('success', 'Kegiatan galeri berhasil ditambahkan.');
    }

    // ✏️ Edit kegiatan
    public function edit($id)
    {
        $kegiatan = KegiatanGaleri::with('fotoGaleri')->findOrFail($id);
        return view('admin.galeri.edit', compact('kegiatan'));
    }

    // 🔄 Update kegiatan
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

        return redirect()->route('admin.galeri.index', $id)->with('success', 'Kegiatan galeri berhasil diperbarui.');
    }

    // 🗑️ Hapus kegiatan
    public function destroy($id)
    {
        $kegiatan = KegiatanGaleri::findOrFail($id);

        // Hapus thumbnail jika ada
        if ($kegiatan->thumbnail_url && Storage::disk('public')->exists($kegiatan->thumbnail_url)) {
            Storage::disk('public')->delete($kegiatan->thumbnail_url);
        }

        // Hapus seluruh foto terkait
        foreach ($kegiatan->fotoGaleri as $foto) {
            if (Storage::disk('public')->exists($foto->url_foto)) {
                Storage::disk('public')->delete($foto->url_foto);
            }
            $foto->delete();
        }

        $kegiatan->delete();

        return redirect()->route('admin.galeri.index')->with('success', 'Kegiatan galeri berhasil dihapus.');
    }

    // 📤 Upload foto dokumentasi ke kegiatan
    public function uploadFoto(Request $request, $id)
    {
        $request->validate([
            'url_foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi_foto' => 'nullable|string|max:255'
        ]);

        $path = $request->file('url_foto')->store('uploads/galeri/foto', 'public');

        FotoGaleri::create([
            'id_kegiatan' => $id,
            'url_foto' => $path,
            'deskripsi_foto' => $request->deskripsi_foto
        ]);

        return back()->with('success', 'Foto berhasil ditambahkan.');
    }

    // ❌ Hapus foto dokumentasi
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
