<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Kategori;
use App\Models\Penulis;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArtikelController extends Controller
{
    public function index()
    {
        $artikels = Artikel::with(['kategori','penulis'])->latest()->paginate(10);
        return view('admin.artikel.index', compact('artikels'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        $penulis = Penulis::all();
        return view('admin.artikel.create', compact('kategori','penulis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'isi_konten' => 'required',
            'url_gambar_utama' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'id_kategori' => 'required|exists:t_kategori,id_kategori',
            'id_penulis' => 'required|exists:t_penulis,id_penulis',
        ]);

        $path = null;
        if ($request->hasFile('url_gambar_utama')) {
            $path = $request->file('url_gambar_utama')->store('artikel', 'public');
        }

        Artikel::create([
    'judul' => $request->judul,
    'url_seo' => Str::slug($request->judul),
    'isi_konten' => $request->isi_konten,
    'url_gambar_utama' => $path,
    'id_kategori' => $request->id_kategori,
    'id_penulis' => $request->id_penulis,
    'jumlah_dibaca' => 0,
    'tanggal_publikasi' => now(),
    'status_publikasi' => 'published',
]);


        return redirect()->route('admin.artikel.index')->with('success','Artikel berhasil ditambahkan!');
    }

    public function edit($id_artikel)
    {
        $artikel = Artikel::findOrFail($id_artikel);
        $kategori = Kategori::all();
        $penulis = Penulis::all();
        return view('admin.artikel.edit', compact('artikel','kategori','penulis'));
    }

    public function update(Request $request, $id_artikel)
    {
        $artikel = Artikel::findOrFail($id_artikel);

        $request->validate([
            'judul' => 'required|max:255',
            'isi_konten' => 'required',
            'url_gambar_utama' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'id_kategori' => 'required|exists:t_kategori,id_kategori',
            'id_penulis' => 'required|exists:t_penulis,id_penulis',
        ]);

        $path = $artikel->url_gambar_utama;
        if ($request->hasFile('url_gambar_utama')) {
            $path = $request->file('url_gambar_utama')->store('artikel', 'public');
        }

        $artikel->update([
            'judul' => $request->judul,
            'url_seo' => Str::slug($request->judul),
            'isi_konten' => $request->isi_konten,
            'url_gambar_utama' => $path,
            'id_kategori' => $request->id_kategori,
            'id_penulis' => $request->id_penulis,
            'status_publikasi' => $request->status_publikasi ?? 'draft',
        ]);

        return redirect()->route('admin.artikel.index')->with('success','Artikel berhasil diperbarui!');
    }

    public function destroy($id_artikel)
    {
        $artikel = Artikel::findOrFail($id_artikel);
        $artikel->delete();

        return redirect()->route('admin.artikel.index')->with('success','Artikel berhasil dihapus!');
    }

     // ================== PUBLIC ==================
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
