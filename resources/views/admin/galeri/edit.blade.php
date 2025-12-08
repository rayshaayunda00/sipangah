@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Edit Kegiatan Galeri</h1>

    <!-- Validasi Error Global -->
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <strong class="font-bold">Periksa Inputan Anda!</strong>
            <ul class="mt-1 list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.galeri.update', $kegiatan->id_kegiatan) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow p-6 rounded">
        @csrf
        @method('PUT')

        <!-- Judul -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Judul Kegiatan</label>
            <input type="text"
                   name="judul_kegiatan"
                   value="{{ old('judul_kegiatan', $kegiatan->judul_kegiatan) }}"
                   class="w-full p-2 border rounded @error('judul_kegiatan') border-red-500 @enderror"
                   required>
            @error('judul_kegiatan')
                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Deskripsi -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Deskripsi Singkat</label>
            <textarea name="deskripsi_singkat"
                      rows="4"
                      class="w-full p-2 border rounded @error('deskripsi_singkat') border-red-500 @enderror"
                      required>{{ old('deskripsi_singkat', $kegiatan->deskripsi_singkat) }}</textarea>
            @error('deskripsi_singkat')
                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Tanggal -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Tanggal Kegiatan</label>
            <input type="date"
                   name="tanggal_kegiatan"
                   value="{{ old('tanggal_kegiatan', $kegiatan->tanggal_kegiatan) }}"
                   class="w-full p-2 border rounded @error('tanggal_kegiatan') border-red-500 @enderror"
                   required>
            @error('tanggal_kegiatan')
                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Thumbnail -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">Thumbnail</label>

            <!-- Preview Gambar Lama -->
            @if($kegiatan->thumbnail_url)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $kegiatan->thumbnail_url) }}" class="w-32 h-auto rounded border shadow-sm">
                    <p class="text-xs text-gray-500 mt-1">Gambar saat ini</p>
                </div>
            @endif

            <input type="file" name="thumbnail" class="w-full border p-2 rounded @error('thumbnail') border-red-500 @enderror">
            @error('thumbnail')
                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition">Update Data</button>
        <a href="{{ route('admin.galeri.index') }}" class="ml-2 text-gray-500 hover:text-gray-700">Batal</a>
    </form>
</div>
@endsection
