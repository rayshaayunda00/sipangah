<?php

namespace App\Http\Controllers;

use App\Models\TentangKelurahan;
use Illuminate\Http\Request;

class TentangKelurahanController extends Controller
{
    public function index()
    {
        // Ambil data terbaru
        $tentang = TentangKelurahan::latest()->first();

        return view('public.tentang_kelurahan.index', compact('tentang'));
    }
}
