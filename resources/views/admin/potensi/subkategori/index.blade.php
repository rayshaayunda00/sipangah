@extends('layouts.admin')
{{-- Menggunakan layout utama admin agar tampilan konsisten dengan halaman admin lainnya --}}

@section('title', 'Subkategori Potensi')
{{-- Menentukan judul halaman untuk ditampilkan pada tab browser atau header --}}

@section('content')
{{-- Awal konten utama halaman --}}

<div class="flex justify-between items-center mb-4">
    {{-- Bagian header halaman yang berisi judul dan tombol tambah --}}
    <h2 class="text-2xl font-bold">Daftar Subkategori Potensi</h2>
    {{-- Tombol menuju halaman tambah subkategori --}}
    <a href="{{ route('admin.subkategori_potensi.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded">
        + Tambah Subkategori
    </a>
</div>

{{-- Notifikasi jika ada pesan sukses setelah menambah/mengedit/menghapus data --}}
@if (session('success'))
<div class="bg-green-100 text-green-800 p-3 rounded mb-4">
    {{ session('success') }}
</div>
@endif

{{-- Tabel utama untuk menampilkan daftar subkategori --}}
<table class="min-w-full border border-gray-300 rounded-lg overflow-hidden">
    <thead class="bg-blue-50">
        <tr>
            <th class="p-3 border">#</th> {{-- Nomor urut --}}
            <th class="p-3 border">Kategori</th> {{-- Nama kategori induk --}}
            <th class="p-3 border">Nama Subkategori</th> {{-- Nama subkategori --}}
            <th class="p-3 border w-32 text-center">Aksi</th> {{-- Kolom untuk tombol edit/hapus --}}
        </tr>
    </thead>
    <tbody>
        {{-- Looping data subkategori yang dikirim dari controller --}}
        @foreach ($subkategori as $sub)
        <tr class="hover:bg-gray-50">
            {{-- $loop->iteration digunakan untuk menampilkan nomor urut otomatis --}}
            <td class="border p-3">{{ $loop->iteration }}</td>

            {{-- Menampilkan nama kategori induk dari relasi model (belongsTo) --}}
            <td class="border p-3">{{ $sub->kategori->nama_kategori }}</td>

            {{-- Menampilkan nama subkategori --}}
            <td class="border p-3">{{ $sub->nama_subkategori }}</td>

            {{-- Kolom aksi untuk edit dan hapus --}}
            <td class="border p-3 text-center">
                {{-- Tombol Edit --}}
                <a href="{{ route('admin.subkategori_potensi.edit', $sub->id_subkategori_potensi) }}"
                   class="bg-yellow-400 px-3 py-1 rounded">
                   Edit
                </a>

                {{-- Form untuk tombol Hapus (gunakan method DELETE) --}}
                <form action="{{ route('admin.subkategori_potensi.destroy', $sub->id_subkategori_potensi) }}"
                      method="POST"
                      class="inline">
                    @csrf
                    @method('DELETE')
                    {{-- Konfirmasi sebelum hapus --}}
                    <button onclick="return confirm('Hapus subkategori ini?')"
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
{{-- Akhir konten utama halaman admin --}}
