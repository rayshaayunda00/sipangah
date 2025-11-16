<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Arsip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArsipController extends Controller
{
    public function index(Request $request)
    {
        $query = Arsip::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nomor_arsip', 'like', "%{$search}%")
                  ->orWhere('judul_arsip', 'like', "%{$search}%")
                  ->orWhere('kategori', 'like', "%{$search}%");
            });
        }

        if ($request->filled('kategori') && $request->kategori != 'all') {
            $query->where('kategori', $request->kategori);
        }

        $arsips = $query->latest('tanggal_arsip')->paginate(10)->appends($request->query());

        return view('admin.arsip.index', [
            'arsips' => $arsips,
            'totalArsip' => Arsip::count(),
            'totalSuratMasuk' => Arsip::where('kategori', 'Surat Masuk')->count(),
            'totalSuratKeluar' => Arsip::where('kategori', 'Surat Keluar')->count(),
            'totalDokumen' => Arsip::where('kategori', 'Dokumen Penting')->count(),
        ]);
    }

    public function create()
    {
        return view('admin.arsip.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_arsip' => 'nullable|string|max:255|unique:arsips,nomor_arsip',
            'judul_arsip' => 'required|string|max:255',
            'kategori' => 'required|in:Surat Masuk,Surat Keluar,Dokumen Penting',
            'deskripsi' => 'nullable|string',
            'tanggal_arsip' => 'required|date',
            'file_lampiran' => 'nullable|file|mimes:pdf,doc,docx,xlsx,jpg,jpeg,png|max:2048',
        ]);

        $validated['status'] = $request->has('status') ? 'Aktif' : 'Tidak Aktif';

        // 🔥 Upload file dengan nama asli + timestamp agar unik
        if ($request->hasFile('file_lampiran')) {
            $file = $request->file('file_lampiran');

            $filename = time() . '-' . preg_replace('/\s+/', '_', $file->getClientOriginalName());

            $validated['file_lampiran'] = $file->storeAs('arsip-files', $filename, 'public');
        }

        if (empty($validated['nomor_arsip'])) {
            $validated['nomor_arsip'] = $this->generateNomorArsip();
        }

        Arsip::create($validated);

        return redirect()->route('admin.arsip.index')->with('success', 'Arsip berhasil ditambahkan!');
    }

    protected function generateNomorArsip()
    {
        $count = Arsip::count() + 1;
        return 'ARS/' . str_pad($count, 3, '0', STR_PAD_LEFT) . '/' . date('m/Y');
    }

    public function show(Arsip $arsip)
    {
        return view('admin.arsip.show', compact('arsip'));
    }

    public function edit(Arsip $arsip)
    {
        return view('admin.arsip.edit', compact('arsip'));
    }

    public function update(Request $request, Arsip $arsip)
    {
        $validated = $request->validate([
            'nomor_arsip' => 'nullable|string|max:255|unique:arsips,nomor_arsip,' . $arsip->id,
            'judul_arsip' => 'required|string|max:255',
            'kategori' => 'required|in:Surat Masuk,Surat Keluar,Dokumen Penting',
            'deskripsi' => 'nullable|string',
            'tanggal_arsip' => 'required|date',
            'file_lampiran' => 'nullable|file|mimes:pdf,doc,docx,xlsx,jpg,jpeg,png|max:2048',
        ]);

        $validated['status'] = $request->has('status') ? 'Aktif' : 'Tidak Aktif';

        // 🔥 Jika ada file baru
        if ($request->hasFile('file_lampiran')) {

            // Hapus file lama
            if ($arsip->file_lampiran && Storage::disk('public')->exists($arsip->file_lampiran)) {
                Storage::disk('public')->delete($arsip->file_lampiran);
            }

            $file = $request->file('file_lampiran');
            $filename = time() . '-' . preg_replace('/\s+/', '_', $file->getClientOriginalName());

            $validated['file_lampiran'] = $file->storeAs('arsip-files', $filename, 'public');
        }

        $arsip->update($validated);

        return redirect()->route('admin.arsip.index')->with('success', 'Arsip berhasil diperbarui!');
    }

    public function destroy(Arsip $arsip)
    {
        if ($arsip->file_lampiran && Storage::disk('public')->exists($arsip->file_lampiran)) {
            Storage::disk('public')->delete($arsip->file_lampiran);
        }

        $arsip->delete();

        return redirect()->route('admin.arsip.index')->with('success', 'Arsip berhasil dihapus!');
    }
}
