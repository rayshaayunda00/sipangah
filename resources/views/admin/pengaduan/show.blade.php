@extends('layouts.admin')

@section('title', 'Detail Pengaduan')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">

    <div class="bg-white shadow rounded-lg overflow-hidden border border-gray-200">

        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h1 class="text-xl font-bold text-gray-800">Detail Pengaduan</h1>

            @php
                $statusColor = match($pengaduan->status_pengaduan) {
                    'Baru' => 'bg-blue-100 text-blue-800',
                    'Dalam Proses' => 'bg-yellow-100 text-yellow-800',
                    'Selesai' => 'bg-green-100 text-green-800',
                    default => 'bg-gray-100 text-gray-800'
                };
            @endphp
            <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $statusColor }}">
                {{ $pengaduan->status_pengaduan }}
            </span>
        </div>

        <div class="p-6 space-y-6">

            <div>
                <label class="block text-sm font-medium text-gray-500">Judul Pengaduan</label>
                <div class="mt-1 text-lg font-semibold text-gray-900">
                    {{ $pengaduan->judul_pengaduan }}
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-gray-50 p-4 rounded-md">
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase">Nama Pelapor</label>
                    <p class="text-gray-900">{{ $pengaduan->nama_pengadu }}</p>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase">Tanggal Masuk</label>
                    <p class="text-gray-900">{{ \Carbon\Carbon::parse($pengaduan->tanggal_pengaduan)->format('d M Y, H:i') }} WIB</p>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase">Email</label>
                    <p class="text-gray-900">{{ $pengaduan->email_pengadu }}</p>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase">No HP</label>
                    <p class="text-gray-900">{{ $pengaduan->no_hp_pengadu ?? '-' }}</p>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-500 mb-2">Isi Laporan</label>
                <div class="p-4 bg-gray-50 rounded border border-gray-200 text-gray-800 whitespace-pre-line">
                    {{ $pengaduan->isi_pengaduan }}
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-500 mb-2">Lampiran Bukti</label>
                @if($pengaduan->url_lampiran)
                    <a href="{{ asset('storage/'.$pengaduan->url_lampiran) }}" target="_blank" class="inline-block border p-1 rounded hover:opacity-80">
                        <img src="{{ asset('storage/'.$pengaduan->url_lampiran) }}" alt="Lampiran" class="h-48 rounded">
                    </a>
                @else
                    <p class="text-sm text-gray-400 italic">Tidak ada lampiran.</p>
                @endif
            </div>

        </div>

    </div>
</div>
@endsection
