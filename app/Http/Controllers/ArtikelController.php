<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Kategori;
use App\Models\Penulis;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArtikelController extends Controller
{
    // ... (Method admin index, create, store, edit, update, destroy BIARKAN SAJA SEPERTI SEBELUMNYA) ...
    // Saya tulis ulang bagian ADMIN agar file ini lengkap bisa langsung di-copy paste

   public function index(Request $request)
{
    // 1. Ambil kata kunci pencarian & kategori dari URL
    $search = $request->input('search');
    $filterKategori = $request->input('kategori');

    // 2. Query dasar dengan Eager Loading
    $query = Artikel::with(['kategori', 'penulis']);

    // 3. Logika Pencarian Judul
    if ($search) {
        $query->where('judul', 'like', '%' . $search . '%');
    }

    // 4. Logika Filter Kategori
    if ($filterKategori) {
        $query->where('id_kategori', $filterKategori);
    }

    // 5. Eksekusi & Pagination
    $artikels = $query->latest()->paginate(10)->withQueryString(); // withQueryString() agar parameter search tidak hilang saat pindah halaman

    // 6. Ambil semua kategori untuk dropdown filter
    $kategoriList = Kategori::all();

    return view('admin.artikel.index', compact('artikels', 'kategoriList'));
}

    public function create()
    {
        $kategori = Kategori::all();
        $penulis = Penulis::all();
        return view('admin.artikel.create', compact('kategori','penulis'));
    }

    public function store(Request $request)
{
    // 1. Validasi Dasar
    $request->validate([
        'judul' => 'required|max:255',
        'isi_konten' => 'required',
        'url_gambar_utama' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        // id_kategori boleh string 'lainnya' atau integer (id yang ada)
        'id_kategori' => 'required',
        'id_penulis' => 'nullable|exists:t_penulis,id_penulis',

        // Validasi kondisional: jika pilih 'lainnya', maka nama_kategori_baru wajib diisi
        'nama_kategori_baru' => 'required_if:id_kategori,lainnya|nullable|string|max:100|unique:t_kategori,nama_kategori',
    ], [
        'nama_kategori_baru.required_if' => 'Nama kategori baru wajib diisi jika memilih opsi Lainnya.',
        'nama_kategori_baru.unique' => 'Nama kategori tersebut sudah ada.',
    ]);

    // 2. Logika Kategori (Inti Perubahan)
    $kategoriId = $request->id_kategori;

    if ($kategoriId === 'lainnya') {
        // Buat Kategori Baru
        $kategoriBaru = Kategori::create([
            'nama_kategori' => $request->nama_kategori_baru,
            'url_seo_kategori' => Str::slug($request->nama_kategori_baru), // Asumsi ada kolom slug
            // 'deskripsi_kategori' => ... (opsional jika ada)
        ]);

        // Update variable ID dengan ID kategori yang baru dibuat
        $kategoriId = $kategoriBaru->id_kategori;
    }

    // 3. Upload Gambar
    $path = null;
    if ($request->hasFile('url_gambar_utama')) {
        $path = $request->file('url_gambar_utama')->store('artikel', 'public');
    }

    // 4. Simpan Artikel
    Artikel::create([
        'judul' => $request->judul,
        'url_seo' => Str::slug($request->judul),
        'isi_konten' => $request->isi_konten,
        'url_gambar_utama' => $path,
        'id_kategori' => $kategoriId, // Gunakan ID yang sudah diproses
        'id_penulis' => $request->id_penulis,
        'jumlah_dibaca' => 0,
        'tanggal_publikasi' => now(),
        'status_publikasi' => $request->status_publikasi ?? 'draft',
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
        'id_kategori' => 'required',
        'id_penulis' => 'nullable|exists:t_penulis,id_penulis',
        'nama_kategori_baru' => 'required_if:id_kategori,lainnya|nullable|string|max:100|unique:t_kategori,nama_kategori',
    ]);

    // Logika Kategori Baru
    $kategoriId = $request->id_kategori;
    if ($kategoriId === 'lainnya') {
        $kategoriBaru = Kategori::create([
            'nama_kategori' => $request->nama_kategori_baru,
            'url_seo_kategori' => Str::slug($request->nama_kategori_baru),
        ]);
        $kategoriId = $kategoriBaru->id_kategori;
    }

    // Upload Gambar
    $path = $artikel->url_gambar_utama;
    if ($request->hasFile('url_gambar_utama')) {
        $path = $request->file('url_gambar_utama')->store('artikel', 'public');
    }

    $artikel->update([
        'judul' => $request->judul,
        'url_seo' => Str::slug($request->judul),
        'isi_konten' => $request->isi_konten,
        'url_gambar_utama' => $path,
        'id_kategori' => $kategoriId, // ID baru atau lama
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

    // ================== PUBLIC (BAGIAN INI YANG DIPERBAIKI) ==================

    // Tambahkan 'Request $request' agar fitur search & filter berfungsi
    public function publicIndex(Request $request)
    {
        // 1. Siapkan Query Dasar
        $query = Artikel::with(['penulis', 'kategori'])
            ->where('status_publikasi', 'published');

        // 2. Logika Pencarian (Search)
        if ($request->has('search') && $request->search != null) {
            $query->where(function($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->search . '%')
                  ->orWhere('isi_konten', 'like', '%' . $request->search . '%');
            });
        }

        // 3. Logika Filter Kategori
        if ($request->has('kategori') && $request->kategori != null) {
            $query->whereHas('kategori', function($q) use ($request) {
                $q->where('nama_kategori', $request->kategori);
            });
        }

        // 4. Eksekusi Query & Pagination
        $artikels = $query->latest()->paginate(6)->withQueryString();

        // 5. AMBIL DATA KATEGORI (INI YANG SEBELUMNYA KURANG)
        $kategori = Kategori::all();

        // 6. Kirim $artikels DAN $kategori ke view
        return view('public.artikel.index', compact('artikels', 'kategori'));
    }

    public function publicShow($seo)
    {
        $artikel = Artikel::with(['penulis', 'kategori'])
            ->where('url_seo', $seo)
            ->firstOrFail();

        $artikel->increment('jumlah_dibaca');

        return view('public.artikel.show', compact('artikel'));
    }
}
