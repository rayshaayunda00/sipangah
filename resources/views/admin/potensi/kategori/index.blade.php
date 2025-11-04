@extends('layouts.admin')
{{-- Menggunakan layout utama admin --}}

@section('title', 'Kategori Potensi')
{{-- Menentukan judul halaman --}}

@section('content')
{{-- Bagian konten utama halaman --}}

<div class="flex justify-between items-center mb-4">
    {{-- Header halaman dengan judul dan tombol tambah kategori --}}
    <h2 class="text-2xl font-bold">Daftar Kategori Potensi</h2>
    <a href="{{ route('admin.kategori_potensi.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
        + Tambah Kategori
    </a>
</div>

{{-- Tampilkan notifikasi sukses jika ada --}}
@if (session('success'))
<div class="bg-green-100 text-green-800 p-3 rounded mb-4">
    {{ session('success') }}
</div>
@endif

{{-- Tabel data kategori potensi --}}
<table class="min-w-full border border-gray-300 rounded-lg overflow-hidden">
    <thead class="bg-blue-50">
        <tr>
            <th class="p-3 border">#</th> {{-- Nomor urut --}}
            <th class="p-3 border">Nama Kategori</th> {{-- Kolom nama kategori --}}
            <th class="p-3 border">Deskripsi</th> {{-- Kolom deskripsi kategori --}}
            <th class="p-3 border w-32 text-center">Aksi</th> {{-- Kolom aksi (edit/hapus) --}}
        </tr>
    </thead>

    <tbody>
        {{-- Looping data kategori yang dikirim dari controller --}}
        @foreach ($kategori as $kat)
        <tr class="hover:bg-gray-50">
            {{-- Menampilkan nomor urut --}}
            <td class="border p-3">{{ $loop->iteration }}</td>

            {{-- Menampilkan nama kategori --}}
            <td class="border p-3">{{ $kat->nama_kategori }}</td>

            {{-- Menampilkan deskripsi kategori (jika ada, jika tidak tampil "-") --}}
            <td class="border p-3">{{ $kat->deskripsi_kategori ?? '-' }}</td>

            {{-- Kolom tombol edit dan hapus --}}
            <td class="border p-3 text-center">
                {{-- Tombol Edit menuju form edit --}}
                <a href="{{ route('admin.kategori_potensi.edit', $kat->id_kategori_potensi) }}"
                   class="bg-yellow-400 px-3 py-1 rounded">Edit</a>

                {{-- Form hapus kategori (dengan konfirmasi sebelum hapus) --}}
                <form action="{{ route('admin.kategori_potensi.destroy', $kat->id_kategori_potensi) }}"
                      method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Hapus kategori ini?')"
                            class="bg-red-500 text-white px-3 py-1 rounded">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
