@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Tambah Artikel</h1>

    <!-- Pesan error global -->
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

    <form action="{{ route('admin.artikel.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Judul</label>
            <input type="text" name="judul" value="{{ old('judul') }}" class="w-full border p-2 rounded @error('judul') border-red-500 @enderror" required>
            @error('judul') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Kategori</label>
            <select name="id_kategori" class="w-full border p-2 rounded @error('id_kategori') border-red-500 @enderror">
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategori as $k)
                    <option value="{{ $k->id_kategori }}" {{ old('id_kategori') == $k->id_kategori ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                @endforeach
            </select>
            @error('id_kategori') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Penulis</label>
            <select name="id_penulis" class="w-full border p-2 rounded @error('id_penulis') border-red-500 @enderror">
                <option value="">-- Pilih Penulis --</option>
                @foreach($penulis as $p)
                    <option value="{{ $p->id_penulis }}" {{ old('id_penulis') == $p->id_penulis ? 'selected' : '' }}>{{ $p->nama_penulis }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Isi Konten</label>
            <textarea name="isi_konten" class="w-full border p-2 rounded @error('isi_konten') border-red-500 @enderror" rows="6" required>{{ old('isi_konten') }}</textarea>
            @error('isi_konten') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Gambar Utama</label>
            <input type="file" name="url_gambar_utama" class="w-full border p-2 rounded @error('url_gambar_utama') border-red-500 @enderror">
            @error('url_gambar_utama') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">Simpan</button>
        <a href="{{ route('admin.artikel.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition ml-2">Batal</a>
    </form>
</div>
@endsection
