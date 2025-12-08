@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Artikel</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 flex justify-between items-center">
            <div>
                <strong class="font-bold">Berhasil!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <div class="mb-6">
        <a href="{{ route('admin.artikel.create') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded transition">
            + Tambah Artikel
        </a>
    </div>

    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 text-left text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6">Gambar</th>
                    <th class="py-3 px-6">Judul</th>
                    <th class="py-3 px-6">Kategori</th>
                    <th class="py-3 px-6">Penulis</th>
                    <th class="py-3 px-6">Status</th>
                    <th class="py-3 px-6 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @forelse($artikels as $artikel)
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="py-3 px-6 text-left">
                        @if($artikel->url_gambar_utama)
                            <img src="{{ asset('storage/'.$artikel->url_gambar_utama) }}" alt="Img" class="w-16 h-16 object-cover rounded shadow-sm">
                        @else
                            <span class="text-gray-400 italic text-xs">No Image</span>
                        @endif
                    </td>
                    <td class="py-3 px-6 text-left font-medium">{{ Str::limit($artikel->judul, 40) }}</td>
                    <td class="py-3 px-6 text-left">
                        <span class="bg-blue-100 text-blue-600 py-1 px-3 rounded-full text-xs">
                            {{ $artikel->kategori->nama_kategori ?? '-' }}
                        </span>
                    </td>
                    <td class="py-3 px-6 text-left">{{ $artikel->penulis->nama_penulis ?? '-' }}</td>
                    <td class="py-3 px-6 text-left">
                        @if($artikel->status_publikasi == 'published')
                            <span class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">Published</span>
                        @else
                            <span class="bg-gray-200 text-gray-600 py-1 px-3 rounded-full text-xs">Draft</span>
                        @endif
                    </td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex item-center justify-center space-x-2">
                            <a href="{{ route('admin.artikel.edit', $artikel->id_artikel) }}" class="w-8 h-8 flex items-center justify-center bg-yellow-500 text-white rounded hover:bg-yellow-600 transition" title="Edit">✏️</a>
                            <form action="{{ route('admin.artikel.destroy', $artikel->id_artikel) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-8 h-8 flex items-center justify-center bg-red-500 text-white rounded hover:bg-red-600 transition" onclick="return confirm('Yakin hapus?')" title="Hapus">🗑</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-6 px-6 text-center text-gray-500">Belum ada data artikel.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $artikels->links() }}
    </div>
</div>
@endsection
