<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubkategoriPotensi;
use App\Models\KategoriPotensi;
use Illuminate\Http\Request;

class SubkategoriPotensiController extends Controller
{
    public function index()
    {
        $subkategori = SubkategoriPotensi::with('kategori')->latest()->get();
        return view('admin.potensi.subkategori.index', compact('subkategori'));
    }

    public function create()
    {
        $kategori = KategoriPotensi::all();
        return view('admin.potensi.subkategori.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kategori_potensi' => 'required|exists:t_kategori_potensi,id_kategori_potensi',
            'nama_subkategori' => 'required|max:100',
        ]);

        SubkategoriPotensi::create($request->all());
        return redirect()->route('admin.subkategori_potensi.index')->with('success', 'Subkategori berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $subkategori = SubkategoriPotensi::findOrFail($id);
        $kategori = KategoriPotensi::all();
        return view('admin.potensi.subkategori.edit', compact('subkategori', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $subkategori = SubkategoriPotensi::findOrFail($id);
        $subkategori->update($request->all());
        return redirect()->route('admin.subkategori_potensi.index')->with('success', 'Subkategori berhasil diperbarui!');
    }

    public function destroy($id)
    {
        SubkategoriPotensi::destroy($id);
        return redirect()->route('admin.subkategori_potensi.index')->with('success', 'Subkategori berhasil dihapus!');
    }
}
