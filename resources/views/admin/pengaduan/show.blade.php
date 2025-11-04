{{--
    Kita "pinjam" layout admin (layouts/admin.blade.php)
    biar dapet sidebar, header, dan CSS-nya.
--}}
@extends('layouts.admin')

{{--
    Ini buat ngatur judul di tab browser.
--}}
@section('title', 'Detail Pengaduan')

{{--
    Ini bagian konten utamanya,
    yang bakal di-inject ke @yield('content') di layout.
--}}
@section('content')
{{--
    Bikin kontainer biar rapi.
    'max-w-3xl' = lebarnya dibatasi (gak full)
    'mx-auto' = biar posisinya di tengah layar
--}}
<div class="max-w-3xl mx-auto p-6 bg-white shadow-lg rounded-lg">

    {{-- Ambil judul pengaduan dari database --}}
    <h2 class="text-2xl font-bold mb-4">{{ $pengaduan->judul_pengaduan }}</h2>

    {{--
        Ini blok buat nampilin data-data si pengadu.
        Kita pake variabel $pengaduan yang dikirim dari Controller.
    --}}
    <p class="mb-2 text-gray-600">
        <strong>Nama Pengadu:</strong> {{ $pengaduan->nama_pengadu }}<br>
        <strong>Email:</strong> {{ $pengaduan->email_pengadu }}<br>
        {{--
            Pake '??' (Null Coalescing Operator).
            Artinya: Kalo $pengaduan->no_hp_pengadu ada isinya, tampilin.
            Kalo kosong (null), tampilin '-'. Biar gak error.
        --}}
        <strong>No HP:</strong> {{ $pengaduan->no_hp_pengadu ?? '-' }}<br>
        <strong>Tanggal:</strong> {{ $pengaduan->tanggal_pengaduan }}<br>
        <strong>Status:</strong>
        {{--
            Ini buat ngasih warna-warni di status (badge).
            Kita pake @if @elseif buat ngecek statusnya.
        --}}
        <span class="px-3 py-1 rounded
            @if($pengaduan->status_pengaduan=='Baru') bg-blue-100 text-blue-800
            @elseif($pengaduan->status_pengaduan=='Dalam Proses') bg-yellow-100 text-yellow-800
            @else bg-green-100 text-green-800 @endif">
            {{ $pengaduan->status_pengaduan }}
        </span>
    </p>

    {{-- Kasih garis pemisah biar cakep --}}
    <hr class="my-4">

    {{-- Bagian buat nampilin isi laporannya --}}
    <div class="mb-4">
        <h3 class="font-semibold mb-2">Isi Pengaduan:</h3>
        {{--
            'whitespace-pre-line' ini penting!
            Gunanya buat ngejaga format "Enter" atau baris baru
            dari user. Kalo user ngetik pake enter, di sini juga bakal ke-enter.
        --}}
        <p class="text-gray-700 whitespace-pre-line">{{ $pengaduan->isi_pengaduan }}</p>
    </div>

    {{--
        Cek dulu, ada lampirannya gak?
        Kalo $pengaduan->url_lampiran gak kosong (ada isinya),
        baru kita tampilin blok di bawah ini.
    --}}
    @if($pengaduan->url_lampiran)
    <div class="mb-4">
        <h3 class="font-semibold mb-2">Lampiran:</h3>
        {{--
            Tampilin gambar lampirannya.
            Pake helper asset('storage/...') buat ngambil
            file dari folder public/storage.
        --}}
        <img src="{{ asset('storage/'.$pengaduan->url_lampiran) }}"
             alt="Lampiran Pengaduan"
             class="max-w-full h-auto border rounded"> {{-- max-w-full biar gambarnya gak "mbleber" --}}
    </div>
    @endif


    {{-- Bagian tombol-tombol di bawah --}}
    <div class="flex justify-between">
        {{-- Tombol buat balik ke halaman daftar (index) --}}
        <a href="{{ route('admin.pengaduan.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
            ← Kembali
        </a>
    </div>
</div>
@endsection
