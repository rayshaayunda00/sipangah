@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Artikel</h1>
    <a href="{{ route('admin.artikel.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">+ Tambah Artikel</a>

    <table class="w-full mt-6 bg-white border">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="p-2">Gambar</th>
                <th class="p-2">Judul</th>
                <th class="p-2">Kategori</th>
                <th class="p-2">Penulis</th>
                <th class="p-2">Status</th>
                <th class="p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($artikels as $artikel)
            <tr class="border-b">
                <td class="p-3">
                    @if($artikel->url_gambar_utama)
                        <img src="{{ asset('storage/'.$artikel->url_gambar_utama) }}"
                             alt="Gambar Artikel"
                             class="w-20 h-20 object-cover rounded">
                    @else
                        <span class="text-gray-400">Tidak ada</span>
                    @endif
                </td>
                <td class="p-3">{{ $artikel->judul }}</td>
                <td class="p-3">{{ $artikel->kategori->nama_kategori ?? '-' }}</td>
                <td class="p-3">{{ $artikel->penulis->nama_penulis ?? '-' }}</td>
                <td class="p-3">{{ $artikel->status_publikasi }}</td>
                <td class="p-3">
                    <td class="p-3 flex space-x-2">
    <a href="{{ route('admin.artikel.edit', $artikel->id_artikel) }}"
       class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">
       ✏️ Edit
    </a>

    <form action="{{ route('admin.artikel.destroy',$artikel->id_artikel) }}" method="POST" class="inline">
        @csrf
        @method('DELETE')
        <button type="submit"
                class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition"
                onclick="return confirm('Yakin hapus?')">
            🗑 Hapus
        </button>
    </form>
</td>

            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">{{ $artikels->links() }}</div>
</div>
@endsection
