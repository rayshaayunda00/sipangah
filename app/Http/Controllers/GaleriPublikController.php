<?php

namespace App\Http\Controllers;

use App\Models\KegiatanGaleri;

class GaleriPublikController extends Controller
{
    public function index()
    {
        $galeri = KegiatanGaleri::latest()->get();
        return view('public.galeri.index', compact('galeri'));
    }

   public function show($id)
{
    $kegiatan = KegiatanGaleri::with('fotoGaleri')->findOrFail($id);
    return view('public.galeri.show', compact('kegiatan'));
}


}
