@extends('layouts.admin')
@section('title', 'Subkategori Potensi')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h2 class="text-2xl font-bold">Daftar Subkategori Potensi</h2>
    <a href="{{ route('admin.subkategori_potensi.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">+ Tambah Subkategori</a>
</div>

@if (session('success'))
<div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
@endif

<table class="min-w-full border border-gray-300 rounded-lg overflow-hidden">
    <thead class="bg-blue-50">
        <tr>
            <th class="p-3 border">#</th>
            <th class="p-3 border">Kategori</th>
            <th class="p-3 border">Nama Subkategori</th>
            <th class="p-3 border w-32 text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($subkategori as $sub)
        <tr class="hover:bg-gray-50">
            <td class="border p-3">{{ $loop->iteration }}</td>
            <td class="border p-3">{{ $sub->kategori->nama_kategori }}</td>
            <td class="border p-3">{{ $sub->nama_subkategori }}</td>
            <td class="border p-3 text-center">
                <a href="{{ route('admin.subkategori_potensi.edit', $sub->id_subkategori_potensi) }}" class="bg-yellow-400 px-3 py-1 rounded">Edit</a>
                <form action="{{ route('admin.subkategori_potensi.destroy', $sub->id_subkategori_potensi) }}" method="POST" class="inline">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Hapus subkategori ini?')" class="bg-red-500 text-white px-3 py-1 rounded">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
