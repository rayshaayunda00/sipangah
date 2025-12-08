@extends('layouts.app')

@section('title', 'Beranda | Kelurahan Cupak Tangah')

{{-- 1. CSS & FONTS --}}
@push('styles')
    {{-- Font Inter --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Mengatur Font Utama ke Inter */
        body, .font-sans {
            font-family: 'Inter', sans-serif;
        }

        /* Gaya kustom untuk overlay warna pada kartu Potensi */
        .potensi-card {
            position: relative;
            overflow: hidden;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .potensi-card:hover {
            transform: translateY(-5px);
        }

        .potensi-card .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.8;
            pointer-events: none;
            display: flex;
            justify-content: space-between;
            padding: 1rem;
            color: white;
            font-weight: 600;
        }
    </style>
@endpush

{{-- 2. KONTEN UTAMA --}}
@section('content')
<div class="antialiased bg-gray-50 min-h-screen font-sans">

    {{-- =================================== --}}
    {{-- BAGIAN HERO UTAMA --}}
    {{-- =================================== --}}
    {{--
        UBAH: pt-40 (Padding Top 10rem)
        Memberikan jarak yang cukup jauh dari atas agar tidak mepet navbar
    --}}
    <main class="pt-40 pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

                {{-- Blok Kiri: Teks dan Data Statistik --}}
                <div>
                    <h1 class="text-5xl font-extrabold text-teal-700">
                        Kelurahan Cupak Tangah
                    </h1>
                    <p class="mt-4 text-lg text-gray-600 max-w-lg">
                        Selamat datang di portal digital Kelurahan Cupak Tangah. Kami hadir untuk memberikan pelayanan terbaik kepada masyarakat dengan sistem informasi yang modern dan terintegrasi.
                    </p>

                    {{-- Blok Data Statistik --}}
                    <div class="mt-8 grid grid-cols-2 gap-4">

                        {{-- Lokasi --}}
                        <div class="bg-white p-4 rounded-xl shadow-lg border border-gray-200 flex items-center">
                            <span class="text-teal-500 mr-3">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </span>
                            <div>
                                <p class="text-sm text-gray-500">Lokasi</p>
                                <p class="font-semibold text-gray-800">Kec. Pauh, Padang</p>
                            </div>
                        </div>

                        {{-- Total Penduduk --}}
                        <div class="bg-white p-4 rounded-xl shadow-lg border border-gray-200 flex items-center">
                            <span class="text-teal-500 mr-3">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M11 12a4 4 0 11-8 0 4 4 0 018 0zm7 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            </span>
                            <div>
                                <p class="text-sm text-gray-500">Total Penduduk</p>
                                <p class="font-semibold text-gray-800">8.234 Jiwa</p>
                            </div>
                        </div>

                        {{-- RT/RW --}}
                        <div class="bg-white p-4 rounded-xl shadow-lg border border-gray-200 flex items-center">
                            <span class="text-teal-500 mr-3">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
                            </span>
                            <div>
                                <p class="text-sm text-gray-500">RT/RW</p>
                                <p class="font-semibold text-gray-800">21 RT / 6 RW</p>
                            </div>
                        </div>

                        {{-- Kode Pos --}}
                        <div class="bg-white p-4 rounded-xl shadow-lg border border-gray-200 flex items-center">
                            <span class="text-teal-500 mr-3">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-2.414-2.414A1 1 0 0015.586 6H7a2 2 0 00-2 2v11a2 2 0 002 2z"></path></svg>
                            </span>
                            <div>
                                <p class="text-sm text-gray-500">Kode Pos</p>
                                <p class="font-semibold text-gray-800">25163</p>
                            </div>
                        </div>
                    </div>

                    {{-- TOMBOL AKSI DIHAPUS --}}

                </div>

                {{-- Blok Kanan: Gambar --}}
                <div class="relative hidden lg:block">
                    <img class="w-full h-auto rounded-3xl shadow-2xl object-cover transition duration-500 hover:scale-105"
                         src="{{ asset('images/kelurahan.png') }}"
                         onerror="this.src='https://placehold.co/600x600/E5E7EB/6B7280?text=Kantor+Kelurahan';"
                         alt="Kantor Kelurahan Cupak Tangah">

                    {{-- Label 24/7 --}}
                    <div class="absolute bottom-[-20px] right-0 bg-white p-4 rounded-xl shadow-xl border border-gray-200 text-center">
                        <p class="text-xl font-bold text-teal-600">24/7</p>
                        <p class="text-sm text-gray-500">Layanan Online</p>
                    </div>
                </div>

            </div>
        </div>
    </main>

    {{-- =================================== --}}
    {{-- BAGIAN BERITA TERBARU --}}
    {{-- =================================== --}}
    <section class="py-20 bg-white border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800">Terbaru Tentang Cupak Tangah</h2>
                <p class="text-gray-500 mt-2">Berita dan informasi terkini dari Kelurahan Cupak Tangah</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                {{-- Blok Kiri: Featured Post --}}
                @if($featuredArtikel)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200">
                        <div class="relative">
                            <img class="w-full h-80 object-cover"
                                 src="{{ $featuredArtikel->url_gambar_utama ? asset('storage/'.$featuredArtikel->url_gambar_utama) : 'https://placehold.co/800x600/38A169/ffffff?text=Featured' }}"
                                 alt="{{ $featuredArtikel->judul }}">
                            <span class="absolute top-4 left-4 bg-teal-600 text-white text-xs font-semibold px-3 py-1 rounded-full shadow-md">
                                {{ $featuredArtikel->kategori->nama_kategori ?? 'Umum' }}
                            </span>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center text-sm text-gray-500 mb-3">
                                <span class="mr-3 flex items-center">
                                    <i class="far fa-calendar-alt mr-1"></i>
                                    {{ $featuredArtikel->created_at->format('d F Y') }}
                                </span>
                                <span class="flex items-center">
                                    <i class="far fa-eye mr-1"></i>
                                    {{ $featuredArtikel->jumlah_dibaca ?? 0 }} views
                                </span>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $featuredArtikel->judul }}</h3>
                            <p class="text-gray-600 line-clamp-3">{{ Str::limit(strip_tags($featuredArtikel->isi_konten), 150) }}</p>
                            <a href="{{ route('artikel.public.show', $featuredArtikel->url_seo) }}" class="mt-4 inline-flex items-center text-teal-600 font-medium hover:text-teal-800 transition duration-150 ease-in-out">
                                Baca Selengkapnya <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                @endif

                {{-- Blok Kanan: 4 Artikel Terbaru --}}
                <div class="space-y-4">
                    @foreach($latestArtikel as $artikel)
                        <a href="{{ route('artikel.public.show', $artikel->url_seo) }}" class="block bg-white p-4 rounded-xl shadow-md border border-gray-200 hover:shadow-lg transition duration-200">
                            <div class="flex justify-between items-center">
                                <div>
                                    <div class="flex items-center text-xs text-gray-500 mb-1">
                                        <span class="bg-gray-100 text-gray-700 font-medium px-2 py-0.5 rounded mr-3">{{ $artikel->kategori->nama_kategori ?? 'Umum' }}</span>
                                        <span class="flex items-center">
                                            <i class="far fa-eye mr-1"></i>
                                            {{ $artikel->jumlah_dibaca ?? 0 }}
                                        </span>
                                    </div>
                                    <p class="font-semibold text-gray-800 hover:text-teal-600 transition">{{ Str::limit($artikel->judul, 50) }}</p>
                                    <p class="text-xs text-gray-500 mt-1">{{ $artikel->created_at->format('d F Y') }}</p>
                                </div>
                                <i class="fas fa-chevron-right text-teal-600 flex-shrink-0"></i>
                            </div>
                        </a>
                    @endforeach

                    {{-- Tombol Lihat Semua Artikel --}}
                    <div class="pt-4">
                        <a href="{{ route('artikel.public.index') }}"
                           class="w-full inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-teal-600 hover:bg-teal-700 shadow-md hover:shadow-lg transition-all duration-300 ease-in-out">
                            Lihat Semua Artikel <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- =================================== --}}
    {{-- BAGIAN POTENSI (JELAJAHI CUPAK TANGAH) --}}
    {{-- =================================== --}}
    <section class="py-20 bg-gray-50 border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800">Jelajahi Cupak Tangah</h2>
                <p class="text-gray-500 mt-2">Temukan berbagai potensi dan kekayaan yang dimiliki Kelurahan Cupak Tangah</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($latestPotensi as $item)
                <div class="potensi-card bg-white h-full rounded-2xl shadow hover:shadow-lg transition-all duration-300 flex flex-col group">
                    <div class="relative h-48 rounded-t-2xl overflow-hidden">
                        <img class="w-full h-full object-cover absolute group-hover:scale-105 transition-transform duration-500"
                             src="{{ $item->url_gambar_utama ? asset('storage/' . $item->url_gambar_utama) : 'https://placehold.co/400x300/E5E7EB/6B7280?text=Potensi' }}"
                             alt="{{ $item->nama_item }}">
                        <div class="absolute bottom-2 left-2 bg-teal-600/90 text-white text-xs font-semibold px-2 py-1 rounded-full shadow-sm">
                            {{ $item->subkategori->kategori->nama_kategori ?? 'Tanpa Kategori' }}
                        </div>
                    </div>

                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mt-1 line-clamp-2 group-hover:text-teal-600 transition-colors">{{ $item->nama_item }}</h3>
                            <p class="text-sm text-gray-600 mt-2 line-clamp-3 leading-relaxed">
                                {{ Str::limit($item->deskripsi_singkat, 80) }}
                            </p>
                        </div>

                        <div class="mt-5">
                            <a href="{{ route('public.potensi.show', $item) }}"
                               class="inline-flex items-center justify-center w-full px-4 py-2.5 bg-teal-600 text-white text-sm font-medium rounded-xl shadow-sm hover:bg-teal-700 hover:shadow-md transition-all duration-200">
                                Lihat Detail <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('potensi.public.index') }}"
                   class="inline-flex justify-center items-center px-8 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-teal-600 hover:bg-teal-700 shadow-md hover:shadow-lg transition-all duration-300 ease-in-out">
                    Lihat Semua Potensi <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    {{-- =================================== --}}
    {{-- BAGIAN LAYANAN ADMINISTRASI --}}
    {{-- =================================== --}}
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

                <div class="flex flex-col justify-center">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6">Apa yang Bisa Kami Bantu?</h2>
                    <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                        Dapatkan berbagai layanan administrasi dengan mudah dan cepat melalui sistem <span class="font-medium">online</span> yang terintegrasi. Kami siap melayani kebutuhan dokumen Anda.
                    </p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-gray-700 mb-10">
                        <div class="flex items-center py-1">
                            <i class="fas fa-check text-teal-600 mr-3"></i> Layanan 24/7 <span class="font-medium ml-1">Online</span>
                        </div>
                        <div class="flex items-center py-1">
                            <i class="fas fa-check text-teal-600 mr-3"></i> Proses Cepat & Mudah
                        </div>
                        <div class="flex items-center py-1">
                            <i class="fas fa-check text-teal-600 mr-3"></i> <span class="font-medium">Tracking Status Real-time</span>
                        </div>
                        <div class="flex items-center py-1">
                            <i class="fas fa-check text-teal-600 mr-3"></i> <span class="font-medium mr-1">Upload</span> Dokumen Digital
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    {{-- Layanan 1 --}}
                    <div class="bg-white p-5 rounded-xl shadow-md border border-gray-100 hover:shadow-lg transition duration-200 h-full flex flex-col">
                        <div class="flex justify-between items-start mb-3">
                            <span class="bg-blue-50 text-blue-600 p-2 rounded-lg">
                                <i class="fas fa-file-alt w-6 h-6"></i>
                            </span>
                            <span class="text-xs font-medium text-green-600 bg-green-50 px-2 py-1 rounded-full">Tersedia</span>
                        </div>
                        <h3 class="font-semibold text-gray-900 text-lg mb-2">Surat Domisili</h3>
                        <p class="text-sm text-gray-500 mb-4 flex-grow">Pengurusan surat keterangan domisili untuk berbagai keperluan</p>
                        <div class="pt-3 border-t border-gray-100">
                            <span class="flex items-center text-sm text-gray-500">
                                <i class="far fa-clock mr-1"></i> 2-3 Hari
                            </span>
                        </div>
                    </div>

                    {{-- Layanan 2 --}}
                    <div class="bg-white p-5 rounded-xl shadow-md border border-gray-100 hover:shadow-lg transition duration-200 h-full flex flex-col">
                        <div class="flex justify-between items-start mb-3">
                            <span class="bg-green-50 text-green-600 p-2 rounded-lg">
                                <i class="fas fa-hand-holding-heart w-6 h-6"></i>
                            </span>
                            <span class="text-xs font-medium text-green-600 bg-green-50 px-2 py-1 rounded-full">Tersedia</span>
                        </div>
                        <h3 class="font-semibold text-gray-900 text-lg mb-2">SKTM</h3>
                        <p class="text-sm text-gray-500 mb-4 flex-grow">Surat Keterangan Tidak Mampu untuk bantuan sosial</p>
                        <div class="pt-3 border-t border-gray-100">
                            <span class="flex items-center text-sm text-gray-500">
                                <i class="far fa-clock mr-1"></i> 1-2 Hari
                            </span>
                        </div>
                    </div>

                    {{-- Layanan 3 --}}
                    <div class="bg-white p-5 rounded-xl shadow-md border border-gray-100 hover:shadow-lg transition duration-200 h-full flex flex-col">
                        <div class="flex justify-between items-start mb-3">
                            <span class="bg-violet-50 text-violet-600 p-2 rounded-lg">
                                <i class="fas fa-baby w-6 h-6"></i>
                            </span>
                            <span class="text-xs font-medium text-green-600 bg-green-50 px-2 py-1 rounded-full">Tersedia</span>
                        </div>
                        <h3 class="font-semibold text-gray-900 text-lg mb-2">Akta Kelahiran</h3>
                        <p class="text-sm text-gray-500 mb-4 flex-grow">Pengurusan akta kelahiran dan kematian</p>
                        <div class="pt-3 border-t border-gray-100">
                            <span class="flex items-center text-sm text-gray-500">
                                <i class="far fa-clock mr-1"></i> 3-5 Hari
                            </span>
                        </div>
                    </div>

                    {{-- Layanan 4 --}}
                    <div class="bg-white p-5 rounded-xl shadow-md border border-gray-100 hover:shadow-lg transition duration-200 h-full flex flex-col">
                        <div class="flex justify-between items-start mb-3">
                            <span class="bg-red-50 text-red-600 p-2 rounded-lg">
                                <i class="fas fa-calendar-check w-6 h-6"></i>
                            </span>
                            <span class="text-xs font-medium text-green-600 bg-green-50 px-2 py-1 rounded-full">Tersedia</span>
                        </div>
                        <h3 class="font-semibold text-gray-900 text-lg mb-2">Izin Kegiatan</h3>
                        <p class="text-sm text-gray-500 mb-4 flex-grow">Perizinan untuk berbagai kegiatan dan acara</p>
                        <div class="pt-3 border-t border-gray-100">
                            <span class="flex items-center text-sm text-gray-500">
                                <i class="far fa-clock mr-1"></i> 1-3 Hari
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- =================================== --}}
    {{-- BAGIAN RINGKASAN STATISTIK WILAYAH --}}
    {{-- =================================== --}}
    <section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            {{-- Statistik 1: RT/RW --}}
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg transition duration-300 text-center group">
                <div class="inline-flex items-center justify-center w-14 h-14 bg-teal-50 text-teal-600 rounded-full mb-4 group-hover:scale-110 transition duration-300">
                    <i class="fas fa-users w-7 h-7 flex items-center justify-center text-2xl"></i>
                </div>
                <p class="text-4xl font-extrabold text-teal-600 mb-2">12 / 6</p>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Jumlah RT / RW</p>
            </div>

            {{-- Statistik 2: Luas Wilayah --}}
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg transition duration-300 text-center group">
                <div class="inline-flex items-center justify-center w-14 h-14 bg-teal-50 text-teal-600 rounded-full mb-4 group-hover:scale-110 transition duration-300">
                    <i class="fas fa-map-marked-alt w-7 h-7 flex items-center justify-center text-2xl"></i>
                </div>
                <p class="text-4xl font-extrabold text-teal-600 mb-2">2,99 <span class="text-xl text-teal-500/80">km²</span></p>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Luas Wilayah</p>
            </div>
        </div>
    </section>

    {{-- =================================== --}}
    {{-- BAGIAN STRUKTUR ORGANISASI --}}
    {{-- =================================== --}}
    <section class="py-16 bg-white border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <span class="text-teal-600 font-bold tracking-wide uppercase text-xs bg-teal-50 px-3 py-1 rounded-full">Pemerintahan</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-3">Struktur Organisasi</h2>
                <p class="text-gray-500 mt-3 text-sm max-w-2xl mx-auto leading-relaxed">
                    Sinergi tim pemimpin dan aparatur profesional Kelurahan Cupak Tangah dalam melayani masyarakat.
                </p>
            </div>

            <div class="flex flex-wrap justify-center gap-8">
                {{-- 1. LURAH --}}
                <div class="w-full md:w-[calc(50%-2rem)] lg:w-[calc(30%-2rem)] bg-white rounded-2xl shadow-lg hover:shadow-xl border-t-4 border-teal-500 p-6 text-center transition-all duration-300 hover:-translate-y-2 group">
                    <div class="relative inline-block mb-4">
                        <div class="p-1.5 rounded-full bg-gradient-to-br from-teal-400 to-teal-600 shadow-md">
                            <img class="w-28 h-28 rounded-full object-cover border-4 border-white bg-white"
                                 src="https://placehold.co/150x150/10B981/ffffff?text=LURAH"
                                 alt="SAIDUL BAHRI, SH">
                        </div>
                        <span class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 bg-yellow-500 text-white text-[10px] font-bold px-3 py-1 rounded-full shadow-md tracking-wider uppercase">Pemimpin</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 group-hover:text-teal-600 transition-colors">SAIDUL BAHRI, SH</h3>
                    <p class="text-xs text-teal-600 font-bold uppercase tracking-widest mt-1 mb-4">Lurah</p>
                    <div class="border-t border-gray-100 pt-4 space-y-2 text-xs text-gray-500">
                        <div class="flex items-center justify-center gap-2">
                            <i class="fas fa-id-badge text-teal-400"></i> NIP. 19781129 200604 1 006
                        </div>
                    </div>
                </div>

                {{-- 2. SEKRETARIS --}}
                <div class="w-full md:w-[calc(50%-2rem)] lg:w-[calc(30%-2rem)] bg-white rounded-2xl shadow-lg hover:shadow-xl border-t-4 border-teal-500 p-6 text-center transition-all duration-300 hover:-translate-y-2 group">
                    <div class="relative inline-block mb-4">
                        <div class="p-1.5 rounded-full bg-gradient-to-br from-teal-400 to-teal-600 shadow-md">
                            <img class="w-28 h-28 rounded-full object-cover border-4 border-white bg-white"
                                 src="https://placehold.co/150x150/10B981/ffffff?text=SEKRE"
                                 alt="NEFRITA SARI, SE.MM">
                        </div>
                        <span class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 bg-teal-600 text-white text-[10px] font-bold px-3 py-1 rounded-full shadow-md tracking-wider uppercase">Sekretariat</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 group-hover:text-teal-600 transition-colors">NEFRITA SARI, SE.MM</h3>
                    <p class="text-xs text-teal-600 font-bold uppercase tracking-widest mt-1 mb-4">Sekretaris</p>
                    <div class="border-t border-gray-100 pt-4 space-y-2 text-xs text-gray-500">
                        <div class="flex items-center justify-center gap-2">
                            <i class="fas fa-id-badge text-teal-400"></i> NIP. 19800503 200901 2 004
                        </div>
                    </div>
                </div>

                {{-- 3. KASI TAPEM --}}
                <div class="w-full md:w-[calc(50%-2rem)] lg:w-[calc(30%-2rem)] bg-white rounded-2xl shadow-lg hover:shadow-xl border-t-4 border-teal-500 p-6 text-center transition-all duration-300 hover:-translate-y-2 group">
                    <div class="relative inline-block mb-4">
                        <div class="p-1.5 rounded-full bg-gradient-to-br from-teal-400 to-teal-600 shadow-md">
                            <img class="w-28 h-28 rounded-full object-cover border-4 border-white bg-white"
                                 src="https://placehold.co/150x150/10B981/ffffff?text=TAPEM"
                                 alt="MELI CHAIRANI, A.MD">
                        </div>
                        <span class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 bg-gray-600 text-white text-[10px] font-bold px-3 py-1 rounded-full shadow-md tracking-wider uppercase">Seksi</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 group-hover:text-teal-600 transition-colors">MELI CHAIRANI, A.MD</h3>
                    <p class="text-xs text-teal-600 font-bold uppercase tracking-widest mt-1 mb-4">Seksi Tapem</p>
                    <div class="border-t border-gray-100 pt-4 space-y-2 text-xs text-gray-500">
                        <div class="flex items-center justify-center gap-2">
                            <i class="fas fa-id-badge text-teal-400"></i> NIP. 19870612 201001 2 028
                        </div>
                    </div>
                </div>

                {{-- 4. SEKSI PM DAN KESOS --}}
                <div class="w-full md:w-[calc(50%-2rem)] lg:w-[calc(30%-2rem)] bg-white rounded-2xl shadow-lg hover:shadow-xl border-t-4 border-teal-500 p-6 text-center transition-all duration-300 hover:-translate-y-2 group">
                    <div class="relative inline-block mb-4">
                        <div class="p-1.5 rounded-full bg-gradient-to-br from-teal-400 to-teal-600 shadow-md">
                            <img class="w-28 h-28 rounded-full object-cover border-4 border-white bg-white"
                                 src="https://placehold.co/150x150/10B981/ffffff?text=PM+KESOS"
                                 alt="RASNANELLY">
                        </div>
                        <span class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 bg-gray-600 text-white text-[10px] font-bold px-3 py-1 rounded-full shadow-md tracking-wider uppercase">Seksi</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 group-hover:text-teal-600 transition-colors">RASNANELLY</h3>
                    <p class="text-xs text-teal-600 font-bold uppercase tracking-widest mt-1 mb-4">Seksi PM dan Kesos</p>
                    <div class="border-t border-gray-100 pt-4 space-y-2 text-xs text-gray-500">
                        <div class="flex items-center justify-center gap-2">
                            <i class="fas fa-id-badge text-teal-400"></i> NIP. 19730822 200801 2 008
                        </div>
                    </div>
                </div>

                {{-- 5. SEKSI TRANTIBUM DAN PB --}}
                <div class="w-full md:w-[calc(50%-2rem)] lg:w-[calc(30%-2rem)] bg-white rounded-2xl shadow-lg hover:shadow-xl border-t-4 border-teal-500 p-6 text-center transition-all duration-300 hover:-translate-y-2 group">
                    <div class="relative inline-block mb-4">
                        <div class="p-1.5 rounded-full bg-gradient-to-br from-teal-400 to-teal-600 shadow-md">
                            <img class="w-28 h-28 rounded-full object-cover border-4 border-white bg-white"
                                 src="https://placehold.co/150x150/10B981/ffffff?text=TRANTIB"
                                 alt="SAFARIN, S.AP">
                        </div>
                        <span class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 bg-gray-600 text-white text-[10px] font-bold px-3 py-1 rounded-full shadow-md tracking-wider uppercase">Seksi</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 group-hover:text-teal-600 transition-colors">SAFARIN, S.AP</h3>
                    <p class="text-xs text-teal-600 font-bold uppercase tracking-widest mt-1 mb-4">Seksi Trantibum dan PB</p>
                    <div class="border-t border-gray-100 pt-4 space-y-2 text-xs text-gray-500">
                        <div class="flex items-center justify-center gap-2">
                            <i class="fas fa-id-badge text-teal-400"></i> NIP. 19750426 201001 1 003
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- =================================== --}}
    {{-- BAGIAN JAM PELAYANAN --}}
    {{-- =================================== --}}
    <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900">Jam Operasional</h2>
            <p class="text-gray-500 mt-2">Jadwal pelayanan kantor lurah dan layanan digital</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            {{-- Kartu 1: Jam Pelayanan Kantor --}}
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="bg-teal-50 px-6 py-4 border-b border-teal-100 flex items-center gap-3">
                    <div class="bg-white p-2 rounded-lg text-teal-600 shadow-sm">
                        <i class="fas fa-building"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 text-lg">Pelayanan Tatap Muka</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex justify-between items-center pb-4 border-b border-gray-50 last:border-0 last:pb-0">
                        <span class="text-gray-600 font-medium flex items-center gap-2">
                            <i class="far fa-calendar text-teal-400 w-5"></i> Senin - Kamis
                        </span>
                        <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm font-semibold">08:00 – 15:30 WIB</span>
                    </div>
                    <div class="flex justify-between items-center pb-4 border-b border-gray-50 last:border-0 last:pb-0">
                        <span class="text-gray-600 font-medium flex items-center gap-2">
                            <i class="far fa-calendar-check text-teal-400 w-5"></i> Jumat
                        </span>
                        <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm font-semibold">08:00 – 11:30 WIB</span>
                    </div>
                    <div class="flex justify-between items-center pb-4 border-b border-gray-50 last:border-0 last:pb-0">
                        <span class="text-gray-600 font-medium flex items-center gap-2">
                            <i class="far fa-calendar-times text-red-400 w-5"></i> Sabtu - Minggu
                        </span>
                        <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-sm font-bold">Tutup</span>
                    </div>
                </div>
            </div>

            {{-- Kartu 2: Layanan Digital --}}
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="bg-blue-50 px-6 py-4 border-b border-blue-100 flex items-center gap-3">
                    <div class="bg-white p-2 rounded-lg text-blue-600 shadow-sm">
                        <i class="fas fa-laptop-medical"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 text-lg">Layanan Digital (Online)</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex justify-between items-center pb-4 border-b border-gray-50 last:border-0 last:pb-0">
                        <span class="text-gray-600 font-medium flex items-center gap-2">
                            <i class="fas fa-globe text-blue-400 w-5"></i> Portal Sipangah
                        </span>
                        <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-sm font-bold flex items-center gap-1">
                            <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span> 24 Jam
                        </span>
                    </div>
                    <div class="flex justify-between items-center pb-4 border-b border-gray-50 last:border-0 last:pb-0">
                        <span class="text-gray-600 font-medium flex items-center gap-2">
                            <i class="fab fa-whatsapp text-green-500 w-5"></i> WhatsApp CS
                        </span>
                        <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm font-semibold">08:00 – 20:00 WIB</span>
                    </div>
                    <div class="flex justify-between items-center pb-4 border-b border-gray-50 last:border-0 last:pb-0">
                        <span class="text-gray-600 font-medium flex items-center gap-2">
                            <i class="far fa-envelope text-blue-400 w-5"></i> Email Support
                        </span>
                        <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-sm font-bold flex items-center gap-1">
                            <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span> 24 Jam
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection
