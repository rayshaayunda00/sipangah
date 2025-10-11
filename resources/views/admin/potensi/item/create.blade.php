@extends('layouts.admin')
@section('title', 'Tambah Item Potensi')

@section('content')
<h2 class="text-2xl font-bold mb-4">Tambah Item Potensi</h2>

<form action="{{ route('admin.item_potensi.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf

    <div>
        <label class="font-semibold">Subkategori</label>
        <select name="id_subkategori_potensi" class="w-full border p-2 rounded" required>
            <option value="">-- Pilih Subkategori --</option>
            @foreach ($subkategori as $sub)
                <option value="{{ $sub->id_subkategori_potensi }}">
                    {{ $sub->nama_subkategori }} ({{ $sub->kategori->nama_kategori }})
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="font-semibold">Nama Item</label>
        <input type="text" name="nama_item" class="w-full border p-2 rounded" required>
    </div>

    <div>
        <label class="font-semibold">Deskripsi Singkat</label>
        <textarea name="deskripsi_singkat" class="w-full border p-2 rounded"></textarea>
    </div>

    <div>
        <label class="font-semibold">Deskripsi Lengkap</label>
        <textarea name="deskripsi_lengkap" class="w-full border p-2 rounded" rows="5"></textarea>
    </div>

    <div>
        <label class="font-semibold">Alamat</label>
        <input type="text" name="alamat" class="w-full border p-2 rounded">
    </div>

    <div>
        <label class="font-semibold">No HP</label>
        <input type="text" name="no_hp" class="w-full border p-2 rounded">
    </div>

    <div>
        <label class="font-semibold">Foto Utama</label>
        <input type="file" name="url_gambar_utama" class="w-full border p-2 rounded" accept="image/*">
    </div>

    <div>
        <label class="font-semibold">Status Publikasi</label>
        <select name="status_publikasi" class="w-full border p-2 rounded" required>
            <option value="draft">Draft</option>
            <option value="published">Published</option>
        </select>
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
</form>
@endsection
