@extends('layouts.app')

@section('title', 'Detail Artikel | Kelurahan Cupak Tangah')

@section('content')
{{-- Tambahkan padding-top untuk menggeser konten dari fixed navbar --}}
<div class="pt-20 bg-gray-50 min-h-screen">

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        {{-- Link kembali --}}
        {{-- <a href="{{ route('artikel.public.index') }}" class="text-teal-600 hover:text-teal-800 transition duration-150 inline-flex items-center mb-6">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke daftar artikel
        </a> --}}

        {{-- Card Utama Artikel --}}
        <article class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 p-6 sm:p-8 lg:p-10">

            {{-- Judul --}}
            <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-6 leading-tight">
                {{ $artikel->judul }}
            </h1>

            {{-- Info publikasi --}}
            <div class="flex flex-wrap items-center text-sm text-gray-500 mb-6 border-b pb-4 border-gray-100">

                {{-- Tanggal Publikasi --}}
                <span class="flex items-center mr-6">
                    <svg class="w-4 h-4 mr-1 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Dipublikasikan: {{ $artikel->tanggal_publikasi ? $artikel->tanggal_publikasi->format('d M Y') : '-' }}
                </span>

                {{-- Kategori --}}
                <span class="flex items-center mr-6">
                    <svg class="w-4 h-4 mr-1 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                    </svg>
                    Kategori: {{ $artikel->kategori?->nama_kategori ?? '-' }}
                </span>

                {{-- Penulis --}}
                <span class="flex items-center">
                    <svg class="w-4 h-4 mr-1 text-teal-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                              d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                              clip-rule="evenodd"></path>
                    </svg>
                    Penulis: {{ $artikel->penulis?->nama_penulis ?? '-' }}
                </span>
            </div>

            {{-- Gambar utama --}}
            <img src="{{ $artikel->url_gambar_utama ? asset('storage/'.$artikel->url_gambar_utama) : 'https://placehold.co/900x500/E5E7EB/6B7280?text=Gambar+Artikel' }}"
                 onerror="this.onerror=null;this.src='https://placehold.co/900x500/E5E7EB/6B7280?text=Gambar+Artikel';"
                 alt="Gambar Utama Artikel"
                 class="w-full max-h-[400px] object-cover rounded-xl shadow-lg mb-8">

            {{-- Konten artikel --}}
            <div class="prose max-w-none prose-teal lg:prose-lg leading-relaxed text-gray-700">
                {!! $artikel->isi_konten !!}
            </div>

            {{-- Statistik --}}
            <div class="mt-8 pt-4 border-t border-gray-100 flex flex-wrap items-center text-sm text-gray-500 space-x-6">
                <span class="flex items-center">
                    <svg class="w-5 h-5 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    Dibaca: <span class="font-semibold text-gray-700 ml-1">{{ number_format($artikel->jumlah_dibaca, 0, ',', '.') }}</span>
                </span>
            </div>
        </article>
    </div>
</div>
@endsection
