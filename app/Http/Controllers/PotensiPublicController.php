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
        $kategori = KategoriPotensi::with('subkategori.itemPotensi')
            ->get();

        $items = ItemPotensi::where('status_publikasi', 'published')
    ->when($kategoriAktif, function ($query, $kategoriAktif) {
        return $query->whereHas('subkategori.kategori', function ($q) use ($kategoriAktif) {
            $q->where('nama_kategori', 'like', "%{$kategoriAktif}%");
        });
    })
    ->latest()
    ->get();


        return view('public.potensi.index', compact('kategori', 'items', 'kategoriAktif'));

    }
}
