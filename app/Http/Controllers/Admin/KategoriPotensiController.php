<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriPotensi;
use Illuminate\Http\Request;

class KategoriPotensiController extends Controller
{
    public function index()
    {
        $kategori = KategoriPotensi::latest()->get();
        return view('admin.potensi.kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('admin.potensi.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|max:100',
            'deskripsi_kategori' => 'nullable',
        ]);

        KategoriPotensi::create($request->all());
        return redirect()->route('admin.kategori_potensi.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $kategori = KategoriPotensi::findOrFail($id);
        return view('admin.potensi.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $kategori = KategoriPotensi::findOrFail($id);
        $kategori->update($request->all());
        return redirect()->route('admin.kategori_potensi.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy($id)
    {
        KategoriPotensi::destroy($id);
        return redirect()->route('admin.kategori_potensi.index')->with('success', 'Kategori berhasil dihapus!');
    }
}
