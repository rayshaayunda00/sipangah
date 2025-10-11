@extends('layouts.admin')
@section('title', 'Tambah Kategori Potensi')

@section('content')
<h2 class="text-2xl font-bold mb-4">Tambah Kategori</h2>

<form action="{{ route('admin.kategori_potensi.store') }}" method="POST" class="space-y-4">
    @csrf
    <div>
        <label class="font-semibold">Nama Kategori</label>
        <input type="text" name="nama_kategori" class="w-full border p-2 rounded" required>
    </div>
    <div>
        <label class="font-semibold">Deskripsi</label>
        <textarea name="deskripsi_kategori" class="w-full border p-2 rounded"></textarea>
    </div>
    <button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
</form>
@endsection
