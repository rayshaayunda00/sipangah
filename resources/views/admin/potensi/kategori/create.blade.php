@extends('layouts.admin')
@section('title', 'Tambah Kategori Potensi')

@section('content')
{{-- Judul halaman --}}
<h2 class="text-2xl font-bold mb-4">Tambah Kategori</h2>

{{-- Form untuk menambahkan kategori baru --}}
<form action="{{ route('admin.kategori_potensi.store') }}" method="POST" class="space-y-4">
    {{-- Token CSRF wajib untuk keamanan form di Laravel --}}
    @csrf

    {{-- Input nama kategori --}}
    <div>
        <label class="font-semibold">Nama Kategori</label>
        <input type="text"
               name="nama_kategori"
               class="w-full border p-2 rounded"
               required
               placeholder="Masukkan nama kategori potensi">
        {{-- Field ini wajib diisi karena menentukan nama utama kategori --}}
    </div>

    {{-- Input deskripsi kategori --}}
    <div>
        <label class="font-semibold">Deskripsi</label>
        <textarea name="deskripsi_kategori"
                  class="w-full border p-2 rounded"
                  placeholder="Tuliskan deskripsi singkat kategori (opsional)"></textarea>
        {{-- Field ini bersifat opsional, untuk menjelaskan detail kategori --}}
    </div>

    {{-- Tombol submit untuk menyimpan data ke database --}}
    <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
        Simpan
    </button>
</form>
@endsection
