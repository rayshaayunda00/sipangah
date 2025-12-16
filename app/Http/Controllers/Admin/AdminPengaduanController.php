<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class AdminPengaduanController extends Controller
{
    // Tampilkan semua pengaduan dengan filter & search
    public function index(Request $request)
    {
        // 1. Mulai Query
        $query = Pengaduan::query();

        // 2. Logika Search (Nama Pengadu atau Judul)
        if ($request->has('search') && $request->search != null) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_pengadu', 'like', "%{$search}%")
                  ->orWhere('judul_pengaduan', 'like', "%{$search}%");
            });
        }

        // 3. Logika Filter Status
        if ($request->has('status') && $request->status != null) {
            $query->where('status_pengaduan', $request->status);
        }

        // 4. Ambil data dengan urutan terbaru & pagination
        $pengaduans = $query->latest('tanggal_pengaduan')
                            ->paginate(10)
                            ->withQueryString(); // Agar parameter search tidak hilang saat pindah halaman

        return view('admin.pengaduan.index', compact('pengaduans'));
    }

    // ... method show, updateStatus, destroy tetap sama ...

    public function show($id_pengaduan)
    {
        $pengaduan = Pengaduan::findOrFail($id_pengaduan);
        return view('admin.pengaduan.show', compact('pengaduan'));
    }

    public function updateStatus(Request $request, $id_pengaduan)
    {
        $request->validate([
            'status_pengaduan' => 'required|in:Baru,Dalam Proses,Selesai',
        ]);

        $pengaduan = Pengaduan::findOrFail($id_pengaduan);
        $pengaduan->update(['status_pengaduan' => $request->status_pengaduan]);

        return redirect()->back()->with('success', 'Status pengaduan berhasil diperbarui.');
    }

    public function destroy($id_pengaduan)
    {
        $pengaduan = Pengaduan::findOrFail($id_pengaduan);
        // Hapus file lampiran jika ada (Opsional, tambahkan jika perlu)
        // if ($pengaduan->url_lampiran && \Storage::exists('public/'.$pengaduan->url_lampiran)) { ... }

        $pengaduan->delete();

        return redirect()->back()->with('success', 'Pengaduan berhasil dihapus.');
    }
}
