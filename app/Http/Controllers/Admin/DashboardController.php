<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Artikel;
use App\Models\ItemPotensi;
use App\Models\Pengaduan; // 1. Tambahkan Import Model Pengaduan

class DashboardController extends Controller
{
    /**
     * Halaman utama publik (welcome)
     */
    public function index()
    {
        $featuredArtikel = Artikel::where('status_publikasi', 'published')->latest()->first();

        $latestArtikel = Artikel::where('status_publikasi', 'published')
                                ->where('id_artikel', '!=', $featuredArtikel->id_artikel ?? 0)
                                ->latest()
                                ->take(4)
                                ->get();

        $latestPotensi = ItemPotensi::where('status_publikasi', 'published')
                                    ->latest()
                                    ->take(4)
                                    ->get();

        return view('welcome', compact('featuredArtikel', 'latestArtikel', 'latestPotensi'));
    }

    /**
     * Halaman Dashboard Admin
     */
    public function adminDashboard()
    {
        // Hitung Data Statistik
        $jumlahUser = User::count();
        $jumlahArtikel = Artikel::count();
        $jumlahPotensi = ItemPotensi::count();
        $jumlahPengaduan = Pengaduan::count(); // 2. Hitung jumlah pengaduan

        // Kirim data ke view
        return view('admin.dashboard', compact(
            'jumlahUser',
            'jumlahArtikel',
            'jumlahPotensi',
            'jumlahPengaduan' // 3. Masukkan variabel ke compact
        ));
    }


}
