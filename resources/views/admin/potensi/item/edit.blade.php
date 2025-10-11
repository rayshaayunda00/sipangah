@extends('layouts.admin')
@section('title', 'Edit Item Potensi')

@section('content')
<h2 class="text-2xl font-bold mb-4">Edit Item Potensi</h2>

<form action="{{ route('admin.item_potensi.update', $item->id_item_potensi) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf
    @method('PUT')

    <div>
        <label class="font-semibold">Subkategori</label>
        <select name="id_subkategori_potensi" class="w-full border p-2 rounded" required>
            @foreach ($subkategori as $sub)
                <option value="{{ $sub->id_subkategori_potensi }}" {{ $item->id_subkategori_potensi == $sub->id_subkategori_potensi ? 'selected' : '' }}>
                    {{ $sub->nama_subkategori }} ({{ $sub->kategori->nama_kategori }})
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="font-semibold">Nama Item</label>
        <input type="text" name="nama_item" class="w-full border p-2 rounded" value="{{ $item->nama_item }}">
    </div>

    <div>
        <label class="font-semibold">Deskripsi Singkat</label>
        <textarea name="deskripsi_singkat" class="w-full border p-2 rounded">{{ $item->deskripsi_singkat }}</textarea>
    </div>

    <div>
        <label class="font-semibold">Deskripsi Lengkap</label>
        <textarea name="deskripsi_lengkap" class="w-full border p-2 rounded" rows="5">{{ $item->deskripsi_lengkap }}</textarea>
    </div>

    <div>
        <label class="font-semibold">Alamat</label>
        <input type="text" name="alamat" class="w-full border p-2 rounded" value="{{ $item->alamat }}">
    </div>

    <div>
        <label class="font-semibold">No HP</label>
        <input type="text" name="no_hp" class="w-full border p-2 rounded" value="{{ $item->no_hp }}">
    </div>

    <div>
        <label class="font-semibold">Foto Utama</label>
        @if($item->url_gambar_utama)
            <img src="{{ asset('storage/' . $item->url_gambar_utama) }}" alt="Foto" class="w-48 h-32 object-cover mb-2 rounded">
        @endif

        <input type="file" name="url_gambar_utama" class="w-full border p-2 rounded" accept="image/*">
    </div>

    <div>
        <label class="font-semibold">Status Publikasi</label>
        <select name="status_publikasi" class="w-full border p-2 rounded">
            <option value="draft" {{ $item->status_publikasi == 'draft' ? 'selected' : '' }}>Draft</option>
            <option value="published" {{ $item->status_publikasi == 'published' ? 'selected' : '' }}>Published</option>
        </select>
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
</form>
@endsection
