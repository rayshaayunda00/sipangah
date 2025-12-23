<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ItemPotensi;
use App\Models\SubkategoriPotensi;
use App\Models\KategoriPotensi; // Tambahkan Model Kategori
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemPotensiController extends Controller
{
    public function index(Request $request)
    {
        // ... (Kode index sama seperti sebelumnya) ...
        $query = ItemPotensi::with('subkategori.kategori');

        if ($request->has('search') && $request->search != null) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_item', 'like', "%{$search}%")
                  ->orWhere('nama_pemilik', 'like', "%{$search}%")
                  ->orWhereHas('subkategori', function($subQ) use ($search) {
                      $subQ->where('nama_subkategori', 'like', "%{$search}%")
                           ->orWhereHas('kategori', function($catQ) use ($search) {
                               $catQ->where('nama_kategori', 'like', "%{$search}%");
                           });
                  });
            });
        }

        $items = $query->latest()->paginate(10)->withQueryString();
        return view('admin.potensi.item.index', compact('items'));
    }

    public function create()
    {
        $subkategori = SubkategoriPotensi::with('kategori')->get();
        // Ambil data Kategori Induk untuk pilihan saat buat subkategori baru
        $kategoriInduk = KategoriPotensi::all();

        return view('admin.potensi.item.create', compact('subkategori', 'kategoriInduk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            // Validasi id_subkategori boleh 'lainnya' atau ID yang ada
            'id_subkategori_potensi' => 'required',
            'nama_item' => 'required|max:150',
            'nama_pemilik' => 'nullable|max:150',
            'deskripsi_lengkap' => 'nullable',
            'alamat' => 'nullable|max:255',
            'no_hp' => 'nullable|max:20',
            'url_gambar_utama' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status_publikasi' => 'required|in:draft,published',

            // Validasi tambahan JIKA memilih 'lainnya'
            // Wajib isi nama subkategori baru & pilih induk kategorinya
            'nama_subkategori_baru' => 'required_if:id_subkategori_potensi,lainnya|nullable|max:100',
            'id_kategori_induk' => 'required_if:id_subkategori_potensi,lainnya|nullable|exists:t_kategori_potensi,id_kategori_potensi',
        ]);

        // Ambil semua data request kecuali file & input tambahan
        $data = $request->except(['url_gambar_utama', 'nama_subkategori_baru', 'id_kategori_induk']);

        // --- LOGIKA SUBKATEGORI BARU ---
        if ($request->id_subkategori_potensi === 'lainnya') {
            // 1. Buat Subkategori Baru di Database
            $subBaru = SubkategoriPotensi::create([
                'nama_subkategori' => $request->nama_subkategori_baru,
                'id_kategori_potensi' => $request->id_kategori_induk
            ]);

            // 2. Ganti 'lainnya' dengan ID subkategori yang baru dibuat
            $data['id_subkategori_potensi'] = $subBaru->id_subkategori_potensi;
        }

        // Upload Gambar
        if ($request->hasFile('url_gambar_utama')) {
            $file = $request->file('url_gambar_utama');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('potensi', $filename, 'public');
            $data['url_gambar_utama'] = $path;
        }

        // Simpan Item Potensi
        ItemPotensi::create($data);

        return redirect()->route('admin.item_potensi.index')
                         ->with('success', 'Item potensi berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $item = ItemPotensi::findOrFail($id);
        $subkategori = SubkategoriPotensi::with('kategori')->get();
        // Kirim juga kategori induk untuk edit jika ingin ubah kategori
        $kategoriInduk = KategoriPotensi::all();

        return view('admin.potensi.item.edit', compact('item', 'subkategori', 'kategoriInduk'));
    }

    public function update(Request $request, $id)
    {
        $item = ItemPotensi::findOrFail($id);

        $request->validate([
            'id_subkategori_potensi' => 'required',
            'nama_item' => 'required|max:150',
            'nama_pemilik' => 'nullable|max:150',
            'deskripsi_lengkap' => 'nullable',
            'alamat' => 'nullable|max:255',
            'no_hp' => 'nullable|max:20',
            'url_gambar_utama' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status_publikasi' => 'required|in:draft,published',

            // Validasi 'lainnya' untuk update juga
            'nama_subkategori_baru' => 'required_if:id_subkategori_potensi,lainnya|nullable|max:100',
            'id_kategori_induk' => 'required_if:id_subkategori_potensi,lainnya|nullable|exists:t_kategori_potensi,id_kategori_potensi',
        ]);

        $data = $request->except(['url_gambar_utama', 'nama_subkategori_baru', 'id_kategori_induk']);

        // --- LOGIKA SUBKATEGORI BARU (UPDATE) ---
        if ($request->id_subkategori_potensi === 'lainnya') {
            $subBaru = SubkategoriPotensi::create([
                'nama_subkategori' => $request->nama_subkategori_baru,
                'id_kategori_potensi' => $request->id_kategori_induk
            ]);
            $data['id_subkategori_potensi'] = $subBaru->id_subkategori_potensi;
        }

        // Upload Gambar Baru
        if ($request->hasFile('url_gambar_utama')) {
            if ($item->url_gambar_utama && Storage::disk('public')->exists($item->url_gambar_utama)) {
                Storage::disk('public')->delete($item->url_gambar_utama);
            }
            $file = $request->file('url_gambar_utama');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('potensi', $filename, 'public');
            $data['url_gambar_utama'] = $path;
        }

        $item->update($data);

        return redirect()->route('admin.item_potensi.index')
                         ->with('success', 'Item potensi berhasil diperbarui!');
    }

    // ... destroy method tetap sama ...
    public function destroy($id)
    {
        $item = ItemPotensi::findOrFail($id);
        if ($item->url_gambar_utama && Storage::exists('public/' . $item->url_gambar_utama)) {
            Storage::delete('public/' . $item->url_gambar_utama);
        }
        $item->delete();
        return redirect()->route('admin.item_potensi.index')->with('success', 'Item potensi berhasil dihapus!');
    }
}
