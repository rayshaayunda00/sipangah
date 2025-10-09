@extends('layouts.admin')

@section('title', 'Detail Pengaduan')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white shadow-lg rounded-lg">
    <h2 class="text-2xl font-bold mb-4">{{ $pengaduan->judul_pengaduan }}</h2>

    <p class="mb-2 text-gray-600">
        <strong>Nama Pengadu:</strong> {{ $pengaduan->nama_pengadu }}<br>
        <strong>Email:</strong> {{ $pengaduan->email_pengadu }}<br>
        <strong>No HP:</strong> {{ $pengaduan->no_hp_pengadu ?? '-' }}<br>
        <strong>Tanggal:</strong> {{ $pengaduan->tanggal_pengaduan }}<br>
        <strong>Status:</strong>
        <span class="px-3 py-1 rounded
            @if($pengaduan->status_pengaduan=='Baru') bg-blue-100 text-blue-800
            @elseif($pengaduan->status_pengaduan=='Dalam Proses') bg-yellow-100 text-yellow-800
            @else bg-green-100 text-green-800 @endif">
            {{ $pengaduan->status_pengaduan }}
        </span>
    </p>

    <hr class="my-4">

    <div class="mb-4">
        <h3 class="font-semibold mb-2">Isi Pengaduan:</h3>
        <p class="text-gray-700 whitespace-pre-line">{{ $pengaduan->isi_pengaduan }}</p>
    </div>

    @if($pengaduan->url_lampiran)
    <div class="mb-4">
        <h3 class="font-semibold mb-2">Lampiran:</h3>
        <img src="{{ asset('storage/'.$pengaduan->url_lampiran) }}"
             alt="Lampiran Pengaduan"
             class="max-w-full h-auto border rounded">
    </div>
@endif


    <div class="flex justify-between">
        <a href="{{ route('admin.pengaduan.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
            ← Kembali
        </a>
    </div>
</div>
@endsection
