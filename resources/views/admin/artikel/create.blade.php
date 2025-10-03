@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Tambah Artikel</h1>

    <form action="{{ route('admin.artikel.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label>Judul</label>
            <input type="text" name="judul" class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label>Kategori</label>
            <select name="id_kategori" class="w-full border p-2 rounded">
                @foreach($kategori as $k)
                    <option value="{{ $k->id_kategori }}">{{ $k->nama_kategori }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label>Penulis</label>
            <select name="id_penulis" class="w-full border p-2 rounded">
                @foreach($penulis as $p)
                    <option value="{{ $p->id_penulis }}">{{ $p->nama_penulis }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label>Isi Konten</label>
            <textarea name="isi_konten" class="w-full border p-2 rounded" rows="6" required></textarea>
        </div>

        <div class="mb-4">
            <label>Gambar Utama</label>
            <input type="file" name="url_gambar_utama" class="w-full border p-2 rounded">
        </div>

        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Simpan</button>
    </form>
</div>
@endsection
