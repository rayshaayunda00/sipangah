@extends('layouts.admin')
{{-- Menggunakan layout utama admin agar konsisten dengan halaman lain --}}

@section('title', 'Edit Subkategori Potensi')
{{-- Menentukan judul halaman pada tab browser atau header layout --}}

@section('content')
{{-- Awal dari konten utama halaman admin --}}

<h2 class="text-2xl font-bold mb-4">Edit Subkategori</h2>
{{-- Judul halaman di dalam konten admin --}}

{{-- Form untuk mengedit data subkategori potensi --}}
<form action="{{ route('admin.subkategori_potensi.update', $subkategori->id_subkategori_potensi) }}"
      method="POST"
      class="space-y-4">
    @csrf {{-- Token keamanan CSRF --}}
    @method('PUT') {{-- Mengubah method form menjadi PUT untuk update data --}}

    {{-- Dropdown untuk memilih kategori induk subkategori --}}
    <div>
        <label class="font-semibold">Kategori</label>
        <select name="id_kategori_potensi" class="w-full border p-2 rounded">
            {{-- Looping untuk menampilkan daftar kategori --}}
            @foreach ($kategori as $kat)
                <option
                    value="{{ $kat->id_kategori_potensi }}"
                    {{ $kat->id_kategori_potensi == $subkategori->id_kategori_potensi ? 'selected' : '' }}>
                    {{-- Menampilkan nama kategori, dan menandai kategori yang sedang dipilih --}}
                    {{ $kat->nama_kategori }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Input untuk nama subkategori --}}
    <div>
        <label class="font-semibold">Nama Subkategori</label>
        <input
            type="text"
            name="nama_subkategori"
            class="w-full border p-2 rounded"
            value="{{ $subkategori->nama_subkategori }}">
            {{-- Mengisi nilai input dengan data lama dari database --}}
    </div>

    {{-- Tombol untuk mengirim form dan menyimpan perubahan --}}
    <button class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
</form>

@endsection
{{-- Akhir dari konten halaman admin --}}
