@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">✏️ Edit Artikel</h1>

    <form action="{{ route('admin.artikel.update', $artikel->id_artikel) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Judul -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Judul</label>
            <input type="text" name="judul" value="{{ old('judul', $artikel->judul) }}"
                   class="w-full border p-2 rounded" required>
        </div>

        <!-- Kategori -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Kategori</label>
            <select name="id_kategori" class="w-full border p-2 rounded" required>
                @foreach($kategori as $k)
                    <option value="{{ $k->id_kategori }}"
                        {{ $artikel->id_kategori == $k->id_kategori ? 'selected' : '' }}>
                        {{ $k->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Penulis -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Penulis</label>
            <select name="id_penulis" class="w-full border p-2 rounded" required>
                @foreach($penulis as $p)
                    <option value="{{ $p->id_penulis }}"
                        {{ $artikel->id_penulis == $p->id_penulis ? 'selected' : '' }}>
                        {{ $p->nama_penulis }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Isi Konten -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Isi Konten</label>
            <textarea name="isi_konten" class="w-full border p-2 rounded" rows="8" required>{{ old('isi_konten', $artikel->isi_konten) }}</textarea>
        </div>

        <!-- URL Gambar -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">URL Gambar Utama</label>
            <input type="text" name="url_gambar_utama" value="{{ old('url_gambar_utama', $artikel->url_gambar_utama) }}"
                   class="w-full border p-2 rounded">
        </div>

        <!-- Status -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Status Publikasi</label>
            <select name="status_publikasi" class="w-full border p-2 rounded">
                <option value="draft" {{ $artikel->status_publikasi == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="published" {{ $artikel->status_publikasi == 'published' ? 'selected' : '' }}>Published</option>
            </select>
        </div>

        <!-- Tombol -->
        <div class="flex space-x-3">
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                💾 Update
            </button>
            <a href="{{ route('admin.artikel.index') }}"
               class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                ⬅ Kembali
            </a>
        </div>
    </form>
</div>
@endsection
