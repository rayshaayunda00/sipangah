@extends('layouts.admin')
@section('title', 'Edit Kategori Potensi')

@section('content')
<h2 class="text-2xl font-bold mb-4">Edit Kategori</h2>

<form action="{{ route('admin.kategori_potensi.update', $kategori->id_kategori_potensi) }}" method="POST" class="space-y-4">
    @csrf @method('PUT')
    <div>
        <label class="font-semibold">Nama Kategori</label>
        <input type="text" name="nama_kategori" class="w-full border p-2 rounded" value="{{ $kategori->nama_kategori }}" required>
    </div>
    <div>
        <label class="font-semibold">Deskripsi</label>
        <textarea name="deskripsi_kategori" class="w-full border p-2 rounded">{{ $kategori->deskripsi_kategori }}</textarea>
    </div>
    <button class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
</form>
@endsection
