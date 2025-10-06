@extends('layouts.admin')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">📸 Daftar Kegiatan Galeri</h1>
        <a href="{{ route('admin.galeri.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
            + Tambah Kegiatan
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-800 p-3 rounded mb-4">
            ✅ {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full border-collapse bg-white shadow rounded-lg">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="p-3 text-left w-28">Thumbnail</th>
                    <th class="p-3 text-left">Judul</th>
                    <th class="p-3 text-left">Tanggal</th>
                    <th class="p-3 text-left">Deskripsi</th>
                    <th class="p-3 text-center w-48">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($galeri as $item)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="p-3">
                            @if($item->thumbnail_url)
                                <img src="{{ asset('storage/'.$item->thumbnail_url) }}" alt="thumb" class="w-24 h-16 object-cover rounded shadow-sm">
                            @else
                                <span class="text-gray-400 italic">Tidak ada</span>
                            @endif
                        </td>
                        <td class="p-3 font-semibold text-gray-800">{{ $item->judul_kegiatan }}</td>
                        <td class="p-3 text-gray-600">{{ \Carbon\Carbon::parse($item->tanggal_kegiatan)->format('d M Y') }}</td>
                        <td class="p-3 text-gray-700">{{ $item->deskripsi_singkat }}</td>
                        <td class="p-3 text-center">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('admin.galeri.edit', $item->id_kegiatan) }}"
                                   class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">
                                    ✏️ Edit
                                </a>
                                <form action="{{ route('admin.galeri.destroy', $item->id_kegiatan) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kegiatan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition">
                                        🗑 Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-4 text-center text-gray-500 italic">Belum ada kegiatan galeri.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
