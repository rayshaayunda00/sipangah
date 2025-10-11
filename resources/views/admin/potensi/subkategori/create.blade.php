@extends('layouts.admin')
@section('title', 'Tambah Subkategori Potensi')

@section('content')
<h2 class="text-2xl font-bold mb-4">Tambah Subkategori</h2>

<form action="{{ route('admin.subkategori_potensi.store') }}" method="POST" class="space-y-4">
    @csrf
    <div>
        <label class="font-semibold">Kategori</label>
        <select name="id_kategori_potensi" class="w-full border p-2 rounded" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach ($kategori as $kat)
                <option value="{{ $kat->id_kategori_potensi }}">{{ $kat->nama_kategori }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="font-semibold">Nama Subkategori</label>
        <input type="text" name="nama_subkategori" class="w-full border p-2 rounded" required>
    </div>
    <button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
</form>
@endsection
