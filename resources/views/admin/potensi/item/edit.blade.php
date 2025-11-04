@extends('layouts.admin')
{{-- Menentukan layout admin yang akan digunakan --}}

@section('title', 'Edit Item Potensi')
{{-- Menentukan judul halaman --}}

@section('content')
{{-- Memulai section content --}}
<h2 class="text-2xl font-bold mb-4">Edit Item Potensi</h2>

{{--
  Form untuk mengupdate data Item Potensi.
  Action: route('admin.item_potensi.update', $item->id_item_potensi) - Mengarah ke route update dengan ID item.
  Method: POST - Method HTTP yang digunakan.
  enctype: multipart/form-data - Diperlukan karena ada input file (upload gambar).
--}}
<form action="{{ route('admin.item_potensi.update', $item->id_item_potensi) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf
    {{-- Token CSRF untuk keamanan form --}}
    @method('PUT')
    {{-- Method spoofing untuk menggunakan method PUT (karena HTML form hanya support GET/POST) --}}

    {{-- Input untuk memilih Subkategori --}}
    <div>
        <label class="font-semibold">Subkategori</label>
        <select name="id_subkategori_potensi" class="w-full border p-2 rounded" required>
            {{-- Loop semua data subkategori --}}
            @foreach ($subkategori as $sub)
                <option value="{{ $sub->id_subkategori_potensi }}" {{-- Tampilkan opsi subkategori --}}
                    {{-- Jika id subkategori item sama dengan id subkategori saat ini, tandai sebagai selected --}}
                    {{ $item->id_subkategori_potensi == $sub->id_subkategori_potensi ? 'selected' : '' }}>
                    {{ $sub->nama_subkategori }} ({{ $sub->kategori->nama_kategori }})
                    {{-- Tampilkan nama subkategori dan nama kategori induknya --}}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Input untuk Nama Item --}}
    <div>
        <label class="font-semibold">Nama Item</label>
        <input type="text" name="nama_item" class="w-full border p-2 rounded" value="{{ $item->nama_item }}">
        {{-- Tampilkan nilai nama_item yang ada saat ini --}}
    </div>

    {{-- Input untuk Deskripsi Singkat --}}
    <div>
        <label class="font-semibold">Deskripsi Singkat</label>
        <textarea name="deskripsi_singkat" class="w-full border p-2 rounded">{{ $item->deskripsi_singkat }}</textarea>
        {{-- Tampilkan nilai deskripsi_singkat yang ada saat ini --}}
    </div>

    {{-- Input untuk Deskripsi Lengkap --}}
    <div>
        <label class="font-semibold">Deskripsi Lengkap</label>
        <textarea name="deskripsi_lengkap" class="w-full border p-2 rounded" rows="5">{{ $item->deskripsi_lengkap }}</textarea>
        {{-- Tampilkan nilai deskripsi_lengkap yang ada saat ini --}}
    </div>

    {{-- Input untuk Alamat --}}
    <div>
        <label class="font-semibold">Alamat</label>
        <input type="text" name="alamat" class="w-full border p-2 rounded" value="{{ $item->alamat }}">
        {{-- Tampilkan nilai alamat yang ada saat ini --}}
    </div>

    {{-- Input untuk No HP --}}
    <div>
        <label class="font-semibold">No HP</label>
        <input type="text" name="no_hp" class="w-full border p-2 rounded" value="{{ $item->no_hp }}">
        {{-- Tampilkan nilai no_hp yang ada saat ini --}}
    </div>

    {{-- Input untuk Foto Utama --}}
    <div>
        <label class="font-semibold">Foto Utama</label>
        {{-- Cek jika item memiliki gambar utama --}}
        @if($item->url_gambar_utama)
            {{-- Tampilkan preview gambar yang ada saat ini --}}
            <img src="{{ asset('storage/' . $item->url_gambar_utama) }}" alt="Foto" class="w-48 h-32 object-cover mb-2 rounded">
        @endif

        {{-- Input file untuk mengganti/mengupload gambar baru --}}
        <input type="file" name="url_gambar_utama" class="w-full border p-2 rounded" accept="image/*">
    </div>

    {{-- Input untuk Status Publikasi --}}
    <div>
        <label class="font-semibold">Status Publikasi</label>
        <select name="status_publikasi" class="w-full border p-2 rounded">
            {{-- Opsi Draft --}}
            <option value="draft" {{ $item->status_publikasi == 'draft' ? 'selected' : '' }}>Draft</option>
            {{-- Opsi Published --}}
            <option value="published" {{ $item->status_publikasi == 'published' ? 'selected' : '' }}>Published</option>
        </select>
    </div>

    {{-- Tombol Submit Form --}}
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
</form>
@endsection
{{-- Mengakhiri section content --}}
