<?php

namespace App\Http\Controllers;

use App\Models\KategoriPotensi;
use App\Models\ItemPotensi;
use Illuminate\Http\Request;


class PotensiPublicController extends Controller
{
  public function index(Request $request)
{
    $kategoriAktif = $request->query('kategori');
    $search = $request->query('search'); // ambil kata kunci pencarian

    $kategori = KategoriPotensi::with('subkategori.itemPotensi')->get();

    $items = ItemPotensi::with(['subkategori.kategori'])
        ->where('status_publikasi', 'published')
        // Filter kategori jika ada
        ->when($kategoriAktif, function ($query, $kategoriAktif) {
            return $query->whereHas('subkategori.kategori', function ($q) use ($kategoriAktif) {
                $q->where('nama_kategori', 'like', "%{$kategoriAktif}%");
            });
        })
        // Filter search berdasarkan judul atau deskripsi
        ->when($search, function ($query, $search) {
            return $query->where(function($q) use ($search) {
                $q->where('nama_item', 'like', "%{$search}%")
                  ->orWhere('deskripsi_singkat', 'like', "%{$search}%");
            });
        })
        ->latest()
        ->get();

    return view('public.potensi.index', compact('kategori', 'items', 'kategoriAktif', 'search'));
}



//🏡 Halaman Homepage (menampilkan potensi terbaru di beranda)
    public function home()
    {
        // Ambil 4 potensi terbaru yang sudah dipublikasikan
        $items = ItemPotensi::where('status_publikasi', 'published')
            ->latest()
            ->take(4)
            ->get();

        // Ambil semua kategori untuk filter/keperluan lain
        $kategori = KategoriPotensi::all();

        return view('welcome', compact('items', 'kategori'));
    }
    public function show(ItemPotensi $item)
{
    return view('public.potensi.show', compact('item'));
}

}
