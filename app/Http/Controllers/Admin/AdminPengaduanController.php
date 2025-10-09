<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class AdminPengaduanController extends Controller
{
    // Tampilkan semua pengaduan
    public function index()
    {
        $pengaduans = Pengaduan::orderBy('tanggal_pengaduan', 'desc')->get();
        return view('admin.pengaduan.index', compact('pengaduans'));
    }

    // Tampilkan detail pengaduan
    public function show($id_pengaduan)
    {
        $pengaduan = Pengaduan::findOrFail($id_pengaduan);
        return view('admin.pengaduan.show', compact('pengaduan'));
    }

    // Update status pengaduan
    public function updateStatus(Request $request, $id_pengaduan)
    {
        $request->validate([
            'status_pengaduan' => 'required|in:Baru,Dalam Proses,Selesai',
        ]);

        $pengaduan = Pengaduan::findOrFail($id_pengaduan);
        $pengaduan->update(['status_pengaduan' => $request->status_pengaduan]);

        return redirect()->back()->with('success', 'Status pengaduan berhasil diperbarui.');
    }

    // Hapus pengaduan
    public function destroy($id_pengaduan)
    {
        $pengaduan = Pengaduan::findOrFail($id_pengaduan);
        $pengaduan->delete();

        return redirect()->back()->with('success', 'Pengaduan berhasil dihapus.');
    }
}
