@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Tambah Kegiatan Galeri</h1>

    <!-- Tampilkan Error Global (Kotak Merah di Atas) -->
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <strong class="font-bold">Terjadi Kesalahan!</strong>
            <ul class="mt-1 list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow-sm">
        @csrf

        <!-- Input Judul Kegiatan -->
        <div class="mb-4">
            <label class="block font-medium mb-1">Judul Kegiatan</label>
            <input type="text"
                   name="judul_kegiatan"
                   value="{{ old('judul_kegiatan') }}"
                   class="w-full border p-2 rounded @error('judul_kegiatan') border-red-500 @enderror"
                   required>

            <!-- Pesan Error Per-Input -->
            @error('judul_kegiatan')
                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Input Deskripsi Singkat -->
        <div class="mb-4">
            <label class="block font-medium mb-1">Deskripsi Singkat</label>
            <textarea name="deskripsi_singkat"
                      rows="3"
                      class="w-full border p-2 rounded @error('deskripsi_singkat') border-red-500 @enderror"
                      required>{{ old('deskripsi_singkat') }}</textarea>

            @error('deskripsi_singkat')
                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Input Tanggal Kegiatan -->
        <div class="mb-4">
            <label class="block font-medium mb-1">Tanggal Kegiatan</label>
            <input type="date"
                   name="tanggal_kegiatan"
                   value="{{ old('tanggal_kegiatan') }}"
                   class="w-full border p-2 rounded @error('tanggal_kegiatan') border-red-500 @enderror"
                   required>

            @error('tanggal_kegiatan')
                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Input Thumbnail -->
        <div class="mb-4">
            <label class="block font-medium mb-1">Thumbnail (Opsional)</label>
            <input type="file"
                   name="thumbnail"
                   class="w-full border p-2 rounded @error('thumbnail') border-red-500 @enderror">
            <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG. Maks: 2MB.</p>

            @error('thumbnail')
                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            Simpan
        </button>
        <a href="{{ route('admin.galeri.index') }}" class="ml-2 text-gray-600 hover:text-gray-800">Batal</a>
    </form>
</div>
@endsection
