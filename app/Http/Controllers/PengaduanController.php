<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    public function index()
    {
        return view('public.pengaduan.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pengadu' => 'required|string|max:100',
            'email_pengadu' => 'required|email',
            'no_hp_pengadu' => 'nullable|string|max:20',
            'judul_pengaduan' => 'required|string|max:200',
            'isi_pengaduan' => 'required|string',
            'url_lampiran' => 'nullable|file|max:2048|mimes:jpg,jpeg,png,pdf',
        ]);

        if ($request->hasFile('url_lampiran')) {
            $validated['url_lampiran'] = $request->file('url_lampiran')->store('lampiran_pengaduan', 'public');
        }

        Pengaduan::create($validated);

        return redirect()->back()->with('success', 'Pengaduan Anda berhasil dikirim. Terima kasih!');
    }

    public function riwayat()
{
    // Ambil semua pengaduan dari database, urut berdasarkan tanggal terbaru
    $pengaduans = Pengaduan::orderBy('tanggal_pengaduan', 'desc')->get();

    return view('public.pengaduan.riwayat', compact('pengaduans'));
}

}
