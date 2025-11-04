{{--
    Kita "pinjam" layout admin (layouts/admin.blade.php)
    biar dapet sidebar, header, dan CSS-nya.
--}}
@extends('layouts.admin')

{{-- Ini buat ngatur judul di tab browser --}}
@section('title', 'Tambah Item Potensi')

{{--
    Ini bagian konten utamanya,
    yang bakal di-inject ke @yield('content') di layout.
--}}
@section('content')
<h2 class="text-2xl font-bold mb-4">Tambah Item Potensi</h2>

{{--
    Ini form-nya.
    - action: Nanti datanya dikirim ke route 'admin.item_potensi.store'.
    - method: "POST", karena kita mau BIKIN data baru.
    - enctype: "multipart/form-data" -> INI WAJIB BANGET ada kalau di dalam form-nya ada <input type="file">
      buat upload gambar/file. Kalau lupa, filenya gak bakal kekirim.
--}}
<form action="{{ route('admin.item_potensi.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">

    {{--
        @csrf -> Jimat sakti Laravel.
        Wajib ada di setiap form POST/PUT/PATCH/DELETE.
        Biar aman dari serangan jahat dan gak error 419 (Page Expired).
    --}}
    @csrf

    {{-- Input buat milih Subkategori (Dropdown) --}}
    <div>
        <label class="font-semibold">Subkategori</label>
        {{--
            Ini dropdown (select). Datanya kita ambil dari $subkategori
            yang dikirim dari Controller.
        --}}
        <select name="id_subkategori_potensi" class="w-full border p-2 rounded" required>
            <option value="">-- Pilih Subkategori --</option>
            {{--
                Kita looping variabel $subkategori.
                Tiap item-nya kita panggil $sub.
            --}}
            @foreach ($subkategori as $sub)
                <option value="{{ $sub->id_subkategori_potensi }}">
                    {{--
                        Kita tampilin nama subkategori dan nama kategori induknya.
                        ($sub->kategori->nama_kategori) -> Ini bisa karena ada relasi di Model.
                    --}}
                    {{ $sub->nama_subkategori }} ({{ $sub->kategori->nama_kategori }})
                </option>
            @endforeach
        </select>
    </div>

    {{-- Input buat Nama Item --}}
    <div>
        <label class="font-semibold">Nama Item</label>
        <input type="text" name="nama_item" class="w-full border p-2 rounded" required>
    </div>

    {{-- Input buat Deskripsi Singkat --}}
    <div>
        <label class="font-semibold">Deskripsi Singkat</label>
        <textarea name="deskripsi_singkat" class="w-full border p-2 rounded"></textarea>
    </div>

    {{-- Input buat Deskripsi Lengkap (biasanya lebih panjang) --}}
    <div>
        <label class="font-semibold">Deskripsi Lengkap</label>
        <textarea name="deskripsi_lengkap" class="w-full border p-2 rounded" rows="5"></textarea>
    </div>

    {{-- Input buat Alamat --}}
    <div>
        <label class="font-semibold">Alamat</label>
        <input type="text" name="alamat" class="w-full border p-2 rounded">
    </div>

    {{-- Input buat No HP --}}
    <div>
        <label class="font-semibold">No HP</label>
        <input type="text" name="no_hp" class="w-full border p-2 rounded">
    </div>

    {{-- Input buat upload Foto Utama --}}
    <div>
        <label class="font-semibold">Foto Utama</label>
        {{--
            Inget, karena ada type="file", form-nya wajib pake enctype="multipart/form-data".
            accept="image/*" -> Biar pas pilih file, yang muncul cuma gambar.
        --}}
        <input type="file" name="url_gambar_utama" class="w-full border p-2 rounded" accept="image/*">
    </div>

    {{-- Input buat milih Status Publikasi --}}
    <div>
        <label class="font-semibold">Status Publikasi</label>
        <select name="status_publikasi" class="w-full border p-2 rounded" required>
            <option value="draft">Draft</option> {{-- Disimpen tapi gak tampil di web --}}
            <option value="published">Published</option> {{-- Langsung tampil di web --}}
        </select>
    </div>

    {{-- Tombol buat ngirim form --}}
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
</form>
@endsection
