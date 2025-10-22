<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artikel;
use App\Models\ItemPotensi;

class DashboardController extends Controller
{

    public function index()
{
    // Artikel featured
    $featuredArtikel = Artikel::where('status_publikasi', 'published')->latest()->first();

    // 4 artikel terbaru selain featured
    $latestArtikel = Artikel::where('status_publikasi', 'published')
                            ->where('id_artikel', '!=', $featuredArtikel->id_artikel ?? 0)
                            ->latest()
                            ->take(4)
                            ->get();

    // 4 potensi terbaru yang dipublikasikan
    $latestPotensi = ItemPotensi::where('status_publikasi', 'published')
                                ->latest()
                                ->take(4)
                                ->get();

    return view('welcome', compact('featuredArtikel', 'latestArtikel', 'latestPotensi'));
}

}
