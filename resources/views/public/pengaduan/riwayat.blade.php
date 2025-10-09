@extends('layouts.app')

@section('title', 'Riwayat Pengaduan')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">📋 Riwayat Pengaduan Anda</h1>

    @forelse($pengaduans as $p)
        <div class="mb-6 p-6 bg-white shadow rounded-lg">
            <h2 class="text-xl font-semibold mb-2">{{ $p->judul_pengaduan }}</h2>

            <p class="mb-2 text-gray-600">
                <strong>Nama Pengadu:</strong> {{ $p->nama_pengadu }}<br>
                <strong>Email:</strong> {{ $p->email_pengadu }}<br>
                <strong>No HP:</strong> {{ $p->no_hp_pengadu ?? '-' }}<br>
                <strong>Tanggal:</strong> {{ $p->tanggal_pengaduan }}<br>
                <strong>Status:</strong>
                <span class="px-3 py-1 rounded
                    @if($p->status_pengaduan=='Baru') bg-blue-100 text-blue-800
                    @elseif($p->status_pengaduan=='Dalam Proses') bg-yellow-100 text-yellow-800
                    @else bg-green-100 text-green-800 @endif">
                    {{ $p->status_pengaduan }}
                </span>
            </p>

            <hr class="my-4">

            <div class="mb-4">
                <h3 class="font-semibold mb-2">Isi Pengaduan:</h3>
                <p class="text-gray-700 whitespace-pre-line">{{ $p->isi_pengaduan }}</p>
            </div>

            @if($p->url_lampiran)
                <div class="mb-4">
                    <h3 class="font-semibold mb-2">Lampiran:</h3>
                    <img src="{{ asset('storage/'.$p->url_lampiran) }}"
                         alt="Lampiran Pengaduan"
                         class="max-w-sm h-auto border rounded">
                </div>
            @endif
        </div>
    @empty
        <p class="text-gray-500">Belum ada pengaduan yang dikirim.</p>
    @endforelse
</div>
@endsection
