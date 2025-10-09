<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artikel;

class DashboardController extends Controller
{

    public function index()
    {
        // Ambil 1 artikel terbaru untuk featured
        $featuredArtikel = Artikel::where('status_publikasi','published')->latest()->first();

$latestArtikel = Artikel::where('status_publikasi','published')
                        ->where('id_artikel', '!=', $featuredArtikel->id_artikel ?? 0)
                        ->latest()
                        ->take(4)
                        ->get();


        return view('welcome', compact('featuredArtikel','latestArtikel'));
    }
}
