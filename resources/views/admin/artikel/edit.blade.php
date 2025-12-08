@extends('layouts.admin')

@section('content')
<div class="p-6">
    <!-- Judul halaman -->
    <h1 class="text-2xl font-bold mb-4">Edit Artikel</h1>

    <!-- Tampilkan alert error global jika ada -->
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
            <strong class="font-bold">Terjadi Kesalahan!</strong>
            <span class="block sm:inline">Silakan periksa kembali inputan Anda.</span>
            <ul class="mt-2 list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form update -->
    <form action="{{ route('admin.artikel.update', $artikel->id_artikel) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Input Judul -->
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Judul</label>
            <input type="text"
                   name="judul"
                   value="{{ old('judul', $artikel->judul) }}"
                   class="w-full border p-2 rounded @error('judul') border-red-500 @enderror"
                   required>
            @error('judul')
                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Kategori -->
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Kategori</label>
            <select name="id_kategori" class="w-full border p-2 rounded @error('id_kategori') border-red-500 @enderror">
                @foreach($kategori as $k)
                    <option value="{{ $k->id_kategori }}"
                        {{ old('id_kategori', $artikel->id_kategori) == $k->id_kategori ? 'selected' : '' }}>
                        {{ $k->nama_kategori }}
                    </option>
                @endforeach
            </select>
            @error('id_kategori')
                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Penulis -->
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Penulis</label>
            <select name="id_penulis" class="w-full border p-2 rounded @error('id_penulis') border-red-500 @enderror">
                @foreach($penulis as $p)
                    <option value="{{ $p->id_penulis }}"
                        {{ old('id_penulis', $artikel->id_penulis) == $p->id_penulis ? 'selected' : '' }}>
                        {{ $p->nama_penulis }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Status Publikasi -->
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Status Publikasi</label>
            <select name="status_publikasi" class="w-full border p-2 rounded">
                <option value="published" {{ old('status_publikasi', $artikel->status_publikasi) == 'published' ? 'selected' : '' }}>Published</option>
                <option value="draft" {{ old('status_publikasi', $artikel->status_publikasi) == 'draft' ? 'selected' : '' }}>Draft</option>
            </select>
        </div>

        <!-- Isi Konten -->
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Isi Konten</label>
            <textarea name="isi_konten" class="w-full border p-2 rounded @error('isi_konten') border-red-500 @enderror" rows="6" required>{{ old('isi_konten', $artikel->isi_konten) }}</textarea>
            @error('isi_konten')
                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Gambar Utama -->
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Gambar Utama</label>
            @if($artikel->url_gambar_utama)
                <div class="mb-2">
                    <img src="{{ asset('storage/'.$artikel->url_gambar_utama) }}" class="w-32 h-32 object-cover rounded border">
                    <p class="text-xs text-gray-500">Gambar saat ini</p>
                </div>
            @endif
            <input type="file" name="url_gambar_utama" class="w-full border p-2 rounded @error('url_gambar_utama') border-red-500 @enderror">
            @error('url_gambar_utama')
                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Update</button>
        <a href="{{ route('admin.artikel.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition ml-2">Batal</a>
    </form>
</div>
@endsection
