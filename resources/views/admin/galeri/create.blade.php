@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Tambah Kegiatan Galeri</h1>

    <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label class="block font-medium mb-1">Judul Kegiatan</label>
            <input type="text" name="judul_kegiatan" class="w-full border p-2 rounded" required>
        </div>

        <div>
            <label class="block font-medium mb-1">Deskripsi Singkat</label>
            <textarea name="deskripsi_singkat" rows="3" class="w-full border p-2 rounded" required></textarea>
        </div>

        <div>
            <label class="block font-medium mb-1">Tanggal Kegiatan</label>
            <input type="date" name="tanggal_kegiatan" class="w-full border p-2 rounded" required>
        </div>

        <div>
            <label class="block font-medium mb-1">Thumbnail (Opsional)</label>
            <input type="file" name="thumbnail" class="w-full border p-2 rounded">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Simpan
        </button>
    </form>
</div>
@endsection
