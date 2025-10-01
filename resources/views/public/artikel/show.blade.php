@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-4">{{ $artikel->judul }}</h1>

    <p class="text-sm text-gray-500 mb-6">
        Dipublikasikan: {{ $artikel->tanggal_publikasi ? $artikel->tanggal_publikasi->format('d M Y') : '-' }} |
        Kategori: {{ $artikel->kategori?->nama_kategori ?? '-' }} |
        Penulis: {{ $artikel->penulis?->nama_penulis ?? '-' }}
    </p>

    @if($artikel->url_gambar_utama)
        <img src="{{ $artikel->url_gambar_utama }}" class="w-full h-60 object-cover rounded mb-6">
    @endif

    <div class="prose max-w-none">
        {!! $artikel->isi_konten !!}
    </div>

    <div class="mt-6">
        <a href="{{ route('artikel.index') }}" class="text-blue-600 hover:underline">⬅ Kembali ke daftar artikel</a>
    </div>
</div>
@endsection
