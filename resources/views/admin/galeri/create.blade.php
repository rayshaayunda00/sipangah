{{--
    Narik layout admin (layouts/admin.blade.php)
    biar kita dapet sidebar, header, dan semua CSS/JS dasarnya.
    Gak perlu pusing bikin ulang.
--}}
@extends('layouts.admin')

{{--
    Semua kode di bawah ini bakal dimasukin ke
    bagian @yield('content') yang ada di file layout admin.
--}}
@section('content')

{{-- Biar ada jarak dikit dari pinggir, kita kasih padding (p-6) --}}
<div class="p-6">
    {{-- Ini judul halamannya --}}
    <h1 class="text-2xl font-bold mb-6">Tambah Kegiatan Galeri</h1>

    {{--
        Ini form-nya.
        - action: Nanti datanya dikirim ke route 'admin.galeri.store'.
        - method: "POST", karena kita mau BIKIN data baru.
        - enctype: "multipart/form-data" -> INI WAJIB BANGET ada kalau di dalam form-nya ada <input type="file">
          buat upload gambar/file. Kalau lupa, filenya gak bakal kekirim.
    --}}
    <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">

        {{--
            @csrf -> Jimat sakti Laravel.
            Wajib ada di setiap form POST/PUT/PATCH/DELETE.
            Biar aman dari serangan jahat dan gak error 419 (Page Expired).
        --}}
        @csrf

        {{-- Input buat Judul Kegiatan --}}
        <div>
            <label class="block font-medium mb-1">Judul Kegiatan</label>
            {{-- 'name="judul_kegiatan"' ini nanti jadi key di Controller --}}
            <input type="text" name="judul_kegiatan" class="w-full border p-2 rounded" required>
        </div>

        {{-- Input buat Deskripsi Singkat --}}
        <div>
            <label class="block font-medium mb-1">Deskripsi Singkat</label>
            {{-- Pake textarea biar bisa ngetik agak panjangan dikit --}}
            <textarea name="deskripsi_singkat" rows="3" class="w-full border p-2 rounded" required></textarea>
        </div>

        {{-- Input buat Tanggal Kegiatan --}}
        <div>
            <label class="block font-medium mb-1">Tanggal Kegiatan</label>
            {{-- Tipenya 'date' biar muncul kalender cakep pas diklik --}}
            <input type="date" name="tanggal_kegiatan" class="w-full border p-2 rounded" required>
        </div>

        {{-- Input buat upload file Thumbnail --}}
        <div>
            <label class="block font-medium mb-1">Thumbnail (Opsional)</label>
            {{-- Tipenya 'file'. Inget, ini nyambung sama 'enctype' di tag <form> tadi --}}
            <input type="file" name="thumbnail" class="w-full border p-2 rounded">
        </div>

        {{-- Tombol buat ngirim semua data di form ini --}}
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Simpan
        </button>
    </form>
</div>

{{-- Penutup untuk @section('content') --}}
@endsection
