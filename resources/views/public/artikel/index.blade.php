@extends('layouts.app')

@section('title', 'Artikel Terkini | Kelurahan Cupak Tangah')

@section('content')

{{-- **HERO SECTION BARU (Lebih Responsif & Estetik)** --}}
{{-- Catatan: mt-20 untuk mengimbangi navbar fixed h-20 --}}
<div class="relative bg-gradient-to-r from-teal-600 to-teal-800 py-20 mb-12 overflow-hidden mt-20">
    <div class="absolute inset-0 bg-black opacity-10"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white mb-4 tracking-tight">
            Artikel Terkini
        </h1>
        <p class="text-xl text-teal-100 max-w-3xl mx-auto leading-relaxed">
            Informasi terbaru dan perkembangan terkini dari Kelurahan Cupak Tangah
        </p>
        <div class="mt-6">
            {{-- Animasi panah ke bawah untuk mendorong pengguna scroll --}}
            <svg class="w-6 h-6 mx-auto text-teal-200 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </div>
</div>
{{-- **AKHIR HERO SECTION** --}}


<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">

    {{-- Filter Kategori (opsional - hanya placeholder) --}}
    <div class="mb-10 flex flex-wrap justify-center gap-3">
        <button class="px-4 py-2 rounded-full bg-teal-600 text-white font-medium text-sm transition-all hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2">
            Semua Artikel
        </button>
        {{-- Loop kategori jika data $kategoris tersedia --}}
        @foreach($kategoris ?? [] as $kategori)
        <button class="px-4 py-2 rounded-full bg-white text-gray-700 border border-gray-300 font-medium text-sm transition-all hover:bg-gray-50 hover:border-teal-300 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2">
            {{ $kategori->nama_kategori }}
        </button>
        @endforeach
    </div>

    {{-- Daftar Artikel (Grid 1 / 2 / 3 Kolom) --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($artikels as $a)
            {{-- Card Artikel Modern --}}
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden transform hover:-translate-y-2 transition-all duration-300 group border border-gray-100">

                {{-- Gambar utama dengan efek hover dan kategori badge --}}
                <div class="relative overflow-hidden">
                    <img src="{{ $a->url_gambar_utama ? asset('storage/'.$a->url_gambar_utama) : 'https://placehold.co/600x400/E5E7EB/6B7280?text=NO+IMAGE' }}"
                        onerror="this.onerror=null;this.src='https://placehold.co/600x400/E5E7EB/6B7280?text=NO+IMAGE';"
                        alt="Gambar Artikel"
                        class="w-full h-52 object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                    {{-- Kategori badge --}}
                    <div class="absolute top-4 left-4">
                        <span class="inline-block px-3 py-1 bg-teal-600 text-white text-xs font-semibold rounded-full shadow-md">
                            {{ $a->kategori?->nama_kategori ?? 'Umum' }}
                        </span>
                    </div>

                    {{-- Baca Selengkapnya Button (Muncul saat hover) --}}
                    <div class="absolute bottom-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <a href="{{ route('artikel.public.show', $a->url_seo) }}" class="inline-flex items-center px-3 py-2 bg-white text-teal-700 text-sm font-medium rounded-lg shadow-md hover:bg-teal-50 transition-colors">
                            Baca Selengkapnya
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="p-6">
                    {{-- Judul --}}
                    <h2 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 leading-tight">
                        <a href="{{ route('artikel.public.show', $a->url_seo) }}" class="hover:text-teal-600 transition-colors duration-200">
                            {{ $a->judul }}
                        </a>
                    </h2>

                    {{-- Cuplikan konten --}}
                    <p class="text-gray-600 mb-4 line-clamp-3 leading-relaxed">
                        {{ Str::limit(strip_tags($a->isi_konten), 120) }}
                    </p>

                    {{-- Penulis & Tanggal (Baris 1) --}}
                    <div class="flex items-center text-sm text-gray-500 mb-2">
                        <svg class="w-4 h-4 mr-2 text-teal-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="font-medium text-gray-700">{{ $a->penulis?->nama_penulis ?? 'Anonim' }}</span>

                        @if($a->tanggal_publikasi)
                        <span class="text-xs text-gray-500 ml-4 flex items-center">
                            <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            {{ \Carbon\Carbon::parse($a->tanggal_publikasi)->format('d M Y') }}
                        </span>
                        @endif
                    </div>

                    {{-- Metrik (Baris 2) --}}
                    <div class="flex items-center pt-3 border-t border-gray-100 text-sm text-gray-500 space-x-4">

                        {{-- Jumlah Dibaca --}}
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-1 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            <span>{{ number_format($a->jumlah_dibaca, 0, ',', '.') }}</span>
                        </div>

                        {{-- Jumlah Suka --}}
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-1 text-red-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                            </svg>
                            <span>{{ number_format($a->jumlah_suka, 0, ',', '.') }}</span>
                        </div>

                        {{-- Jumlah Dibagikan (Opsional) --}}
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-1 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.88 12.836 9 12.462 9 12c0-.462-.12-.836-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6.632l6.632-3.316m0 0a3 3 0 105.368-2.684 3 3 0 00-5.368 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path>
                            </svg>
                            <span>{{ number_format($a->jumlah_dibagikan, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            {{-- Tampilan saat tidak ada artikel --}}
            <div class="md:col-span-3 text-center py-16 bg-white rounded-2xl shadow-lg border border-gray-200">
                <div class="max-w-md mx-auto">
                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum ada artikel</h3>
                    <p class="text-gray-500">Silakan tambahkan artikel baru melalui panel admin.</p>
                </div>
            </div>
        @endforelse
    </div>

    {{-- Pagination (Terpusat) --}}
    <div class="mt-12 flex justify-center">
        {{ $artikels->links() }}
    </div>
</div>

@endsection
