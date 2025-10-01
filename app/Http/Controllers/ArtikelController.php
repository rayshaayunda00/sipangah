<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Kategori;
use App\Models\Penulis;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArtikelController extends Controller
{
    /**
     * Halaman daftar artikel untuk Admin
     */
    public function index()
    {
        $artikels = Artikel::with(['kategori','penulis'])->latest()->paginate(10);
        return view('admin.artikel.index', compact('artikels'));
    }

    /**
     * Form tambah artikel
     */
    public function create()
    {
        $kategori = Kategori::all();
        $penulis = Penulis::all();
        return view('admin.artikel.create', compact('kategori','penulis'));
    }

    /**
     * Simpan artikel baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'isi_konten' => 'required',
            'url_gambar_utama' => 'nullable|string',
            'id_kategori' => 'required|exists:t_kategori,id_kategori',
            'id_penulis' => 'required|exists:t_penulis,id_penulis',
        ]);

        Artikel::create([
            'judul' => $request->judul,
            'url_seo' => Str::slug($request->judul),
            'isi_konten' => $request->isi_konten,
            'url_gambar_utama' => $request->url_gambar_utama,
            'id_kategori' => $request->id_kategori,
            'id_penulis' => $request->id_penulis,
            'jumlah_dibaca' => 0,
            'jumlah_suka' => 0,
            'jumlah_dibagikan' => 0,
            'tanggal_publikasi' => now(),
            'status_publikasi' => 'published',
        ]);

        return redirect()->route('admin.artikel.index')->with('success','Artikel berhasil ditambahkan!');
    }

    /**
     * Form edit artikel
     */
    public function edit($id)
    {
        $artikel = Artikel::findOrFail($id);
        $kategori = Kategori::all();
        $penulis = Penulis::all();
        return view('admin.artikel.edit', compact('artikel','kategori','penulis'));
    }

    /**
     * Update artikel
     */
    public function update(Request $request, $id)
    {
        $artikel = Artikel::findOrFail($id);

        $request->validate([
            'judul' => 'required|max:255',
            'isi_konten' => 'required',
            'url_gambar_utama' => 'nullable|string',
            'id_kategori' => 'required|exists:t_kategori,id_kategori',
            'id_penulis' => 'required|exists:t_penulis,id_penulis',
        ]);

        $artikel->update([
            'judul' => $request->judul,
            'url_seo' => Str::slug($request->judul),
            'isi_konten' => $request->isi_konten,
            'url_gambar_utama' => $request->url_gambar_utama,
            'id_kategori' => $request->id_kategori,
            'id_penulis' => $request->id_penulis,
            'status_publikasi' => $request->status_publikasi ?? 'draft',
        ]);

        return redirect()->route('admin.artikel.index')->with('success','Artikel berhasil diperbarui!');
    }

    /**
     * Hapus artikel
     */
    public function destroy($id)
    {
        $artikel = Artikel::findOrFail($id);
        $artikel->delete();

        return redirect()->route('admin.artikel.index')->with('success','Artikel berhasil dihapus!');
    }

    /**
     * Halaman publik daftar artikel
     */
    public function publicIndex()
{
    $artikels = Artikel::with(['penulis','kategori'])
        ->where('status_publikasi','published')
        ->latest()
        ->paginate(6);

    return view('public.artikel.index', compact('artikels'));
}

public function publicShow($seo)
{
    $artikel = Artikel::with(['penulis','kategori'])
        ->where('url_seo',$seo)
        ->firstOrFail();

    $artikel->increment('jumlah_dibaca');

    return view('public.artikel.show', compact('artikel'));
}

}
