@extends('layouts.admin')
@section('title', 'Item Potensi')

@section('content')
<div class="flex justify-between items-center mb-4">
    {{-- Judul halaman dan tombol tambah data --}}
    <h2 class="text-2xl font-bold">Daftar Item Potensi</h2>
    <a href="{{ route('admin.item_potensi.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">+ Tambah Item</a>
</div>

{{-- Notifikasi sukses jika ada pesan dari session --}}
@if (session('success'))
<div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
@endif

{{-- Tabel utama daftar item potensi --}}
<table class="min-w-full border border-gray-300 rounded-lg overflow-hidden">
    <thead class="bg-blue-50">
        <tr>
            <th class="p-3 border">No</th>
            <th class="p-3 border">Nama Item</th>
            <th class="p-3 border">Subkategori</th>
            <th class="p-3 border">Status</th>
            <th class="p-3 border">Gambar</th>
            <th class="p-3 border">Deskripsi Singkat</th>
            <th class="p-3 border">Alamat</th>
            <th class="p-3 border">No HP</th>
            <th class="p-3 border text-center">Aksi</th>
        </tr>
    </thead>

    <tbody>
        {{-- Looping semua data item potensi dari variabel $items --}}
        @foreach ($items as $itm)
        <tr class="hover:bg-gray-50">
            {{-- Menampilkan nomor urut berdasarkan iterasi --}}
            <td class="border p-3">{{ $loop->iteration }}</td>

            {{-- Nama item --}}
            <td class="border p-3">{{ $itm->nama_item }}</td>

            {{-- Menampilkan nama subkategori dan kategori induknya --}}
            <td class="border p-3">
                {{ $itm->subkategori->nama_subkategori }}
                ({{ $itm->subkategori->kategori->nama_kategori }})
            </td>

            {{-- Status publikasi: tampilkan warna hijau jika "published", abu-abu jika tidak --}}
            <td class="border p-3">
                <span class="px-2 py-1 rounded text-sm
                    {{ $itm->status_publikasi == 'published'
                        ? 'bg-green-100 text-green-700'
                        : 'bg-gray-200 text-gray-700' }}">
                    {{ ucfirst($itm->status_publikasi) }}
                </span>
            </td>

            {{-- Menampilkan gambar utama item jika ada --}}
            <td class="border p-3">
                @if($itm->url_gambar_utama)
                    <img src="{{ asset('storage/' . $itm->url_gambar_utama) }}"
                         alt="Gambar"
                         class="w-24 h-16 object-cover rounded">
                @else
                    <span class="text-gray-400 text-sm">Tidak ada</span>
                @endif
            </td>

            {{-- Deskripsi singkat, alamat, dan nomor HP --}}
            <td class="border p-3">{{ $itm->deskripsi_singkat ?? '-' }}</td>
            <td class="border p-3">{{ $itm->alamat ?? '-' }}</td>
            <td class="border p-3">{{ $itm->no_hp ?? '-' }}</td>

            {{-- Tombol aksi: Edit dan Hapus --}}
            <td class="border p-3 text-center">
                {{-- Tombol Edit --}}
                <a href="{{ route('admin.item_potensi.edit', $itm->id_item_potensi) }}"
                   class="bg-yellow-400 px-3 py-1 rounded hover:bg-yellow-500 transition">
                    Edit
                </a>

                {{-- Tombol Hapus dengan konfirmasi --}}
                <form action="{{ route('admin.item_potensi.destroy', $itm->id_item_potensi) }}"
                      method="POST"
                      class="inline">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Hapus item ini?')"
                            class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
