<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ItemPotensi;
use App\Models\SubkategoriPotensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemPotensiController extends Controller
{
    public function index()
    {
        $items = ItemPotensi::with('subkategori.kategori')->latest()->get();
        return view('admin.potensi.item.index', compact('items'));
    }

    public function create()
    {
        $subkategori = SubkategoriPotensi::with('kategori')->get();
        return view('admin.potensi.item.create', compact('subkategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_subkategori_potensi' => 'required|exists:t_subkategori_potensi,id_subkategori_potensi',
            'nama_item' => 'required|max:150',
            'deskripsi_singkat' => 'nullable|max:255',
            'deskripsi_lengkap' => 'nullable',
            'alamat' => 'nullable|max:255',
            'no_hp' => 'nullable|max:20',
            'url_gambar_utama' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status_publikasi' => 'required|in:draft,published',
        ]);

        $data = $request->except('url_gambar_utama');

        // Upload gambar
        if ($request->hasFile('url_gambar_utama')) {
        $file = $request->file('url_gambar_utama');
        $filename = time() . '_' . $file->getClientOriginalName();

        // Simpan di storage/app/public/potensi
        $path = $file->storeAs('potensi', $filename, 'public');

        // Simpan path relatif di DB
        $data['url_gambar_utama'] = $path; // contoh: potensi/123456_nama.jpg
    }


        ItemPotensi::create($data);

        return redirect()->route('admin.item_potensi.index')
                         ->with('success', 'Item potensi berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $item = ItemPotensi::findOrFail($id);
        $subkategori = SubkategoriPotensi::with('kategori')->get();
        return view('admin.potensi.item.edit', compact('item', 'subkategori'));
    }

    public function update(Request $request, $id)
    {
        $item = ItemPotensi::findOrFail($id);

        $request->validate([
            'id_subkategori_potensi' => 'required|exists:t_subkategori_potensi,id_subkategori_potensi',
            'nama_item' => 'required|max:150',
            'deskripsi_singkat' => 'nullable|max:255',
            'deskripsi_lengkap' => 'nullable',
            'alamat' => 'nullable|max:255',
            'no_hp' => 'nullable|max:20',
            'url_gambar_utama' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status_publikasi' => 'required|in:draft,published',
        ]);

        $data = $request->except('url_gambar_utama');

        // Upload gambar baru jika ada
        if ($request->hasFile('url_gambar_utama')) {
            // Hapus gambar lama jika ada
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

    public function destroy($id)
    {
        $item = ItemPotensi::findOrFail($id);

        // Hapus gambar
        if ($item->url_gambar_utama && Storage::exists(str_replace('storage/', 'public/', $item->url_gambar_utama))) {
            Storage::delete(str_replace('storage/', 'public/', $item->url_gambar_utama));
        }

        $item->delete();

        return redirect()->route('admin.item_potensi.index')
                         ->with('success', 'Item potensi berhasil dihapus!');
    }
}
