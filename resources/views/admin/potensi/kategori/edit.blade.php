@extends('layouts.admin')
@section('title', 'Edit Kategori Potensi')

@section('content')
{{-- Judul halaman --}}
<h2 class="text-2xl font-bold mb-4">Edit Kategori</h2>

{{-- Form untuk mengedit data kategori yang sudah ada --}}
<form action="{{ route('admin.kategori_potensi.update', $kategori->id_kategori_potensi) }}"
      method="POST"
      class="space-y-4">

    {{-- Token keamanan bawaan Laravel --}}
    @csrf
    {{-- Method PUT karena ini update data --}}
    @method('PUT')

    {{-- Input nama kategori --}}
    <div>
        <label class="font-semibold">Nama Kategori</label>
        <input type="text"
               name="nama_kategori"
               class="w-full border p-2 rounded"
               value="{{ $kategori->nama_kategori }}"
               required
               placeholder="Masukkan nama kategori">
        {{-- Field ini otomatis terisi dengan data lama dari database --}}
    </div>

    {{-- Input deskripsi kategori --}}
    <div>
        <label class="font-semibold">Deskripsi</label>
        <textarea name="deskripsi_kategori"
                  class="w-full border p-2 rounded"
                  placeholder="Tuliskan deskripsi kategori">{{ $kategori->deskripsi_kategori }}</textarea>
        {{-- Kalau kategori sudah punya deskripsi, langsung tampil di textarea --}}
    </div>

    {{-- Tombol untuk menyimpan perubahan --}}
    <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
        Update
    </button>
</form>
@endsection
