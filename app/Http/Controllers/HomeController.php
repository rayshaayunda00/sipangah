<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;
use App\Models\ItemPotensi;

class HomeController extends Controller
{
    /**
     * Halaman utama publik (welcome)
     */
    public function index()
    {
        // Ambil 1 Artikel unggulan (misalnya, yang terbaru)
        $featuredArtikel = Artikel::where('status_publikasi', 'published')
                                  ->latest()
                                  ->first();

        // Ambil 4 Artikel terbaru
        $latestArtikelQuery = Artikel::where('status_publikasi', 'published')
                                ->latest()
                                ->take(4);

        // Lewati artikel yang sudah jadi featured HANYA JIKA featuredArtikel ada
        if ($featuredArtikel) {
            $latestArtikelQuery->where('id_artikel', '!=', $featuredArtikel->id_artikel);
        }

        $latestArtikel = $latestArtikelQuery->get();


        // Ambil 4 Potensi terbaru
        $latestPotensi = ItemPotensi::with('subkategori.kategori')
                                    ->where('status_publikasi', 'published')
                                    ->latest()
                                    ->take(4)
                                    ->get();

        // Kirim data ke view 'welcome'
        return view('welcome', compact('featuredArtikel', 'latestArtikel', 'latestPotensi'));
    }
}
