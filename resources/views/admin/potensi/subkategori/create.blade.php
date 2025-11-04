@extends('layouts.admin')
{{-- Menggunakan layout utama admin --}}

@section('title', 'Tambah Subkategori Potensi')
{{-- Menentukan judul halaman --}}

@section('content')
{{-- Bagian utama konten halaman --}}

<h2 class="text-2xl font-bold mb-4">Tambah Subkategori</h2>
{{-- Judul halaman di dalam konten --}}

{{-- Form untuk menambah data subkategori potensi --}}
<form action="{{ route('admin.subkategori_potensi.store') }}" method="POST" class="space-y-4">
    @csrf {{-- Token keamanan untuk mencegah CSRF attack --}}

    {{-- Dropdown memilih kategori induk --}}
    <div>
        <label class="font-semibold">Kategori</label>
        <select name="id_kategori_potensi" class="w-full border p-2 rounded" required>
            <option value="">-- Pilih Kategori --</option>
            {{-- Looping untuk menampilkan semua kategori dari controller --}}
            @foreach ($kategori as $kat)
                <option value="{{ $kat->id_kategori_potensi }}">
                    {{ $kat->nama_kategori }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Input nama subkategori --}}
    <div>
        <label class="font-semibold">Nama Subkategori</label>
        <input type="text" name="nama_subkategori" class="w-full border p-2 rounded" required>
    </div>

    {{-- Tombol submit untuk menyimpan data --}}
    <button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
</form>

@endsection
