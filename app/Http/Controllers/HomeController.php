<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;
use App\Models\ItemPotensi;
use Illuminate\Support\Facades\Auth; // <--- 1. WAJIB TAMBAH INI (Biar bisa cek user login)

class HomeController extends Controller
{
    /**
     * Halaman utama publik (welcome)
     */
    public function index()
    {
        // --- 2. LOGIKA BARU: CEK ADMIN ---
        // Cek: Apakah user sedang login DAN apakah dia Admin?
        if (Auth::check() && Auth::user()->is_admin) {
            // Kalau iya, tendang ke Dashboard Admin
            return redirect()->route('admin.dashboard');
        }
        // ---------------------------------


        // --- KODINGAN LAMA (Tetap Dipakai buat Warga Biasa) ---

        // Ambil 1 Artikel unggulan
        $featuredArtikel = Artikel::where('status_publikasi', 'published')
                                  ->latest()
                                  ->first();

        // Ambil 4 Artikel terbaru
        $latestArtikelQuery = Artikel::where('status_publikasi', 'published')
                                ->latest()
                                ->take(4);

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
