@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Artikel</h1>
    <a href="{{ route('admin.artikel.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">+ Tambah Artikel</a>

    <table class="w-full mt-6 bg-white border">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="p-2">Judul</th>
                <th class="p-2">Kategori</th>
                <th class="p-2">Penulis</th>
                <th class="p-2">Status</th>
                <th class="p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($artikels as $a)
            <tr class="border-b">
                <td class="p-2">{{ $a->judul }}</td>
                <td class="p-2">{{ $a->kategori?->nama_kategori ?? '-' }}</td>
                <td class="p-2">{{ $a->penulis?->nama_penulis ?? '-' }}</td>
                <td class="p-2">{{ $a->status_publikasi }}</td>
                <td class="p-2">
                    <a href="{{ route('admin.artikel.edit',$a->id_artikel) }}" class="text-blue-600">✏️ Edit</a>
                    <form action="{{ route('admin.artikel.destroy',$a->id_artikel) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" onclick="return confirm('Hapus artikel ini?')" class="text-red-600">🗑 Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">{{ $artikels->links() }}</div>
</div>
@endsection
