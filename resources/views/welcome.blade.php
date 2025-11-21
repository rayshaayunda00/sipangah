<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sipangah | Kelurahan Cupak Tangah</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Gaya kustom untuk overlay warna pada kartu Potensi */
        .potensi-card {
            position: relative;
            overflow: hidden;
            border-radius: 0.75rem; /* rounded-xl */
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
            opacity: 0.8; /* Opasitas overlay */
            pointer-events: none;
            display: flex;
            justify-content: space-between;
            padding: 1rem;
            color: white;
            font-weight: 600;
        }

        /* Warna spesifik untuk setiap overlay */
        .overlay-blue { background-color: #3b82f6; } /* Tailwind blue-500 */
        .overlay-green { background-color: #22c55e; } /* Tailwind green-500 */
        .overlay-purple { background-color: #a855f7; } /* Tailwind violet-500 */
        .overlay-lime { background-color: #84cc16; } /* Tailwind lime-500 */

    </style>
</head>
<body class="antialiased bg-gray-50">
    <div class="min-h-screen">

        {{-- =================================== --}}
        {{-- BAGIAN NAVIGASI (HEADER) --}}
        {{-- Menggunakan fixed top-0 w-full z-50 agar navbar tetap di atas --}}
        {{-- Kode navigasi yang Anda berikan diletakkan di sini --}}
        {{-- =================================== --}}
        <nav x-data="{ open: false }" class="bg-white shadow-md fixed top-0 w-full z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20">
                    <div class="flex">
                        {{-- Logo dan Nama Kelurahan --}}
                        <a href="/" class="flex-shrink-0 flex items-center">

                            <span class="text-xl font-extrabold text-teal-600 mr-2">CT</span>
                            <span class="text-lg font-semibold text-gray-800">Sipangah Cupak Tangah</span>
                        </a>

                        {{-- Tautan Navigasi Desktop --}}
                        <div class="hidden sm:ml-6 sm:flex sm:space-x-8 items-center">
                            {{-- Tautan Beranda --}}
                            <a href="/"
                                class="px-3 py-2 text-sm font-medium {{ request()->is('/') ? 'text-teal-600 border-b-2 border-teal-600' : 'text-gray-500 hover:text-gray-900 border-b-2 border-transparent hover:border-gray-300' }}">
                                Beranda
                            </a>

                            {{-- Tautan Artikel --}}
                            <a href="{{ route('artikel.public.index') }}"
                                class="px-3 py-2 text-sm font-medium {{ request()->routeIs('artikel.public.*') ? 'text-teal-600 border-b-2 border-teal-600' : 'text-gray-500 hover:text-gray-900' }}">
                                Artikel
                            </a>

<div x-data="{ open: false }" class="relative">
    <button @click="open = !open"
        class="text-gray-500 hover:text-gray-900 px-3 py-2 text-sm font-medium border-b-2 border-transparent hover:border-gray-300 inline-flex items-center">
        Layanan
        <svg class="ml-1 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M19 9l-7 7-7-7" />
        </svg>
    </button>

    <div x-show="open" @click.away="open = false"
        class="absolute bg-white shadow-lg rounded-lg mt-2 w-48 z-50">
        <a href="{{ route('layanan.pengaduan') }}"
            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
            Pengaduan
        </a>
        <a href="{{ route('layanan') }}"
            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
            Administrasi
        </a>
    </div>
</div>


                            <a href="{{ route('galeri.index') }}" class="text-gray-500 hover:text-gray-900 px-3 py-2 text-sm font-medium">Galeri</a>

                            <a href="{{ route('potensi.public.index') }}"
   class="text-gray-500 hover:text-gray-900 px-3 py-2 text-sm font-medium border-b-2 border-transparent hover:border-gray-300">
   Potensi
</a>

                            <a href="{{ route('tentang_kelurahan.index') }}"
   class="text-gray-500 hover:text-gray-900 px-3 py-2 text-sm font-medium border-b-2 border-transparent hover:border-gray-300">
   Tentang
</a>

                        </div>
                    </div>

                    <div class="hidden sm:flex sm:items-center sm:ml-auto">
                        @auth
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 focus:outline-none transition ease-in-out duration-150">
                                        <div>{{ Auth::user()->name }}</div>
                                        <div class="ml-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link :href="route('profile.edit')">
                                        {{ __('Profil') }}
                                    </x-dropdown-link>

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                            {{ __('Keluar') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        @endauth

                        @guest
                            {{-- Kalau belum login tampil Masuk + Daftar --}}
        <a href="{{ route('login') }}"
           class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-teal-600 hover:bg-teal-700 transition duration-150 ease-in-out">
            Masuk
        </a>

        <a href="{{ route('register') }}"
           class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-teal-700 bg-white hover:bg-gray-100 transition duration-150 ease-in-out">
            Daftar
        </a>
                        @endguest
                    </div>

                    {{-- Hamburger (Mobile Menu) --}}
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Responsive Navigation Menu (Mobile) --}}
            <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white">
                <div class="pt-2 pb-3 space-y-1 border-t border-gray-100">
                    {{-- Tautan Navigasi Mobile --}}
                    <a href="/" class="block w-full pl-3 pr-4 py-2 border-l-4 {{ request()->is('/') ? 'border-teal-600 text-teal-700 bg-teal-50' : 'border-transparent text-gray-600 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-800' }}">Beranda</a>
                    <a href="{{ route('artikel.public.index') }}" class="block w-full pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('artikel.public.*') ? 'border-teal-600 text-teal-700 bg-teal-50' : 'border-transparent text-gray-600 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-800' }}">Artikel</a>
                    <a href="{{ route('layanan') }}" class="block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-gray-600 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-800">Layanan</a>
                    <a href="#" class="block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-gray-600 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-800">Galeri</a>
                    <a href="#" class="block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-gray-600 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-800">Potensi</a>
                    <a href="#" class="block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-gray-600 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-800">Tentang</a>
                </div>

                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="px-4">
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()?->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()?->email }}</div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <x-responsive-nav-link :href="route('profile.edit')">
                            {{ __('Profil') }}
                        </x-responsive-nav-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-responsive-nav-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Keluar') }}
                            </x-responsive-nav-link>
                        </form>
                    </div>
                </div>
            </div>
            {{-- Margin top harus di layout utama jika navbar fixed --}}
            <div class="pt-2"></div>
        </nav>


        {{-- =================================== --}}
        {{-- BAGIAN HERO UTAMA --}}
        {{-- Menambahkan pt-28 agar konten tidak tertutup oleh navbar fixed --}}
        {{-- =================================== --}}
        <main class="pt-28 pb-20">
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
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </span>
                                <div>
                                    <p class="text-sm text-gray-500">Lokasi</p>
                                    <p class="font-semibold text-gray-800">Kec. Pauh, Padang</p>
                                </div>
                            </div>

                            {{-- Total Penduduk --}}
                            <div class="bg-white p-4 rounded-xl shadow-lg border border-gray-200 flex items-center">
                                <span class="text-teal-500 mr-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M11 12a4 4 0 11-8 0 4 4 0 018 0zm7 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                </span>
                                <div>
                                    <p class="text-sm text-gray-500">Total Penduduk</p>
                                    <p class="font-semibold text-gray-800">8.234 Jiwa</p>
                                </div>
                            </div>

                            {{-- RT/RW --}}
                            <div class="bg-white p-4 rounded-xl shadow-lg border border-gray-200 flex items-center">
                                <span class="text-teal-500 mr-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
                                </span>
                                <div>
                                    <p class="text-sm text-gray-500">RT/RW</p>
                                    <p class="font-semibold text-gray-800">21 RT / 6 RW</p>
                                </div>
                            </div>

                            {{-- Kode Pos --}}
                            <div class="bg-white p-4 rounded-xl shadow-lg border border-gray-200 flex items-center">
                                <span class="text-teal-500 mr-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-2.414-2.414A1 1 0 0015.586 6H7a2 2 0 00-2 2v11a2 2 0 002 2z"></path></svg>
                                </span>
                                <div>
                                    <p class="text-sm text-gray-500">Kode Pos</p>
                                    <p class="font-semibold text-gray-800">25163</p>
                                </div>
                            </div>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="mt-8 flex space-x-4">
                            <a href="#" class="px-6 py-3 border border-transparent text-base font-medium rounded-lg shadow-sm text-white bg-teal-600 hover:bg-teal-700 transition duration-150 ease-in-out">
                                Jelajahi Layanan
                            </a>
                            <a href="#" class="px-6 py-3 border border-teal-600 text-base font-medium rounded-lg text-teal-600 bg-white hover:bg-teal-50 transition duration-150 ease-in-out">
                                Lihat Peta Wilayah
                            </a>
                        </div>
                    </div>

                    {{-- Blok Kanan: Gambar (Telah diperbaiki agar tegak) --}}
                    <div class="relative hidden lg:block">
                        <img class="w-full h-auto rounded-3xl shadow-2xl object-cover transition duration-500 hover:scale-105"
                             src="{{ asset('images/kelurahan.png') }}"
                             alt="Kantor Kelurahan Cupak Tangah">

                        {{-- Label 24/7 di Sudut Kanan Bawah --}}
                        <div class="absolute bottom-[-20px] right-0 bg-white p-4 rounded-xl shadow-xl border border-gray-200 text-center">
                            <p class="text-xl font-bold text-teal-600">24/7</p>
                            <p class="text-sm text-gray-500">Layanan Online</p>
                        </div>
                    </div>

                </div>
            </div>

            {{-- ** BLOK RINGKASAN STATISTIK DILUAR SINI SEKARANG ** --}}

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
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        {{ $featuredArtikel->created_at->format('d F Y') }}
                    </span>
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        {{ $featuredArtikel->jumlah_dibaca ?? 0 }} views
                    </span>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $featuredArtikel->judul }}</h3>
                <p class="text-gray-600 line-clamp-3">{{ Str::limit($featuredArtikel->isi_konten, 150) }}</p>
                <a href="{{ route('artikel.public.show', $featuredArtikel->url_seo) }}" class="mt-4 inline-flex items-center text-teal-600 font-medium hover:text-teal-800 transition duration-150 ease-in-out">
                    Baca Selengkapnya
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
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
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                {{ $artikel->jumlah_dibaca ?? 0 }}
                            </span>
                        </div>
                        <p class="font-semibold text-gray-800 hover:text-teal-600 transition">{{ Str::limit($artikel->judul, 50) }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $artikel->created_at->format('d F Y') }}</p>
                    </div>
                    <svg class="w-5 h-5 text-teal-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>
            </a>
        @endforeach

        {{-- Tombol Lihat Semua Artikel --}}
        <div class="pt-4">
            <a href="{{ route('artikel.public.index') }}" class="w-full inline-flex justify-center items-center px-6 py-3 border border-teal-600 text-base font-medium rounded-lg text-teal-600 bg-white hover:bg-teal-50 transition duration-150 ease-in-out">
                Lihat Semua Artikel
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
            <div class="potensi-card bg-white h-full rounded-2xl shadow hover:shadow-lg transition-all duration-300 flex flex-col">
                <!-- Gambar -->
                <div class="relative h-48 rounded-t-2xl overflow-hidden">
                    <img class="w-full h-full object-cover absolute"
                         src="{{ $item->url_gambar_utama ? asset('storage/' . $item->url_gambar_utama) : 'https://via.placeholder.com/400x300' }}"
                         alt="{{ $item->nama_item }}">
                    <div class="absolute bottom-2 left-2 bg-teal-600/70 text-white text-xs font-semibold px-2 py-1 rounded-full">
                        {{ $item->subkategori->kategori->nama_kategori ?? 'Tanpa Kategori' }}
                    </div>
                </div>

                <!-- Konten -->
                <div class="p-4 flex-1 flex flex-col justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mt-2 line-clamp-2">{{ $item->nama_item }}</h3>
                        <p class="text-sm text-gray-600 mt-1 line-clamp-3">
                            {{ Str::limit($item->deskripsi_singkat, 80) }}
                        </p>
                    </div>

                    <!-- Tombol aksi -->
                    <div class="mt-4 flex justify-between items-center">
                        <a href="{{ route('public.potensi.show', $item) }}"
   class="inline-flex items-center px-4 py-2 bg-teal-600 text-white text-sm font-medium rounded-lg shadow hover:bg-teal-700 transition">
    Lihat Detail <i class="fas fa-arrow-right ml-2"></i>
</a>


                        <a href="{{ route('potensi.public.index', ['kategori' => $item->subkategori->kategori->nama_kategori ?? '']) }}"
                           class="text-teal-600 text-sm font-medium hover:text-teal-800">
                            Pelajari Lebih Lanjut &rarr;
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Tombol lihat semua -->
        <div class="text-center mt-12">
            <a href="{{ route('potensi.public.index') }}"
               class="inline-flex justify-center items-center px-8 py-3 border border-transparent text-base font-medium rounded-lg shadow-sm text-white bg-teal-600 hover:bg-teal-700 transition duration-150 ease-in-out">
                Lihat Semua Potensi
            </a>
        </div>
    </div>
</section>



        {{-- =================================== --}}
        {{-- BAGIAN LAYANAN ADMINISTRASI (APA YANG BISA KAMI BANTU?) --}}
        {{-- =================================== --}}
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

                    {{-- Blok Kiri: Teks dan Checklist --}}
                    <div>
                        <h2 class="text-4xl font-extrabold text-gray-800 mb-6">Apa yang Bisa Kami Bantu?</h2>
                        <p class="text-lg text-gray-600 mb-8">
                            Dapatkan berbagai layanan administrasi dengan mudah dan cepat melalui sistem *online* yang terintegrasi. Kami siap melayani kebutuhan dokumen Anda.
                        </p>

                        {{-- Checklist Fitur --}}
                        <div class="grid grid-cols-2 gap-4 text-gray-700 font-medium mb-10">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-teal-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Layanan 24/7 *Online*
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-teal-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Proses Cepat & Mudah
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-teal-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                *Tracking Status Real-time*
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-teal-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                *Upload* Dokumen Digital
                            </div>
                        </div>

                        {{-- Tombol Mulai --}}
                        <a href="#" class="inline-flex items-center px-8 py-3 border border-transparent text-base font-medium rounded-lg shadow-sm text-white bg-teal-600 hover:bg-teal-700 transition duration-150 ease-in-out">
                            Mulai Sekarang &rarr;
                        </a>
                    </div>

                    {{-- Blok Kanan: Daftar Kartu Layanan --}}
                    <div class="grid grid-cols-2 gap-6">

                        {{-- Kartu Layanan 1: Surat Domisili --}}
                        <div class="bg-white p-4 rounded-xl shadow-lg border border-gray-200 hover:shadow-xl transition duration-200">
                            <div class="flex justify-between items-start mb-2">
                                <span class="bg-blue-100 text-blue-600 p-2 rounded-lg">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                </span>
                                <span class="text-xs font-medium text-green-600 bg-green-100 px-3 py-1 rounded-full">Tersedia</span>
                            </div>
                            <h3 class="font-semibold text-gray-900">Surat Domisili</h3>
                            <p class="text-xs text-gray-500 my-2">Pengurusan surat keterangan domisili untuk berbagai keperluan</p>
                            <div class="flex justify-between items-center pt-2 border-t border-gray-100">
                                <span class="flex items-center text-sm text-gray-500">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    2-3 Hari
                                </span>
                                <a href="#" class="text-teal-600 hover:text-teal-800 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </a>
                            </div>
                        </div>

                        {{-- Kartu Layanan 2: SKTM --}}
                        <div class="bg-white p-4 rounded-xl shadow-lg border border-gray-200 hover:shadow-xl transition duration-200">
                            <div class="flex justify-between items-start mb-2">
                                <span class="bg-green-100 text-green-600 p-2 rounded-lg">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                </span>
                                <span class="text-xs font-medium text-green-600 bg-green-100 px-3 py-1 rounded-full">Tersedia</span>
                            </div>
                            <h3 class="font-semibold text-gray-900">SKTM</h3>
                            <p class="text-xs text-gray-500 my-2">Surat Keterangan Tidak Mampu untuk bantuan sosial</p>
                            <div class="flex justify-between items-center pt-2 border-t border-gray-100">
                                <span class="flex items-center text-sm text-gray-500">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    1-2 Hari
                                </span>
                                <a href="#" class="text-teal-600 hover:text-teal-800 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </a>
                            </div>
                        </div>

                        {{-- Kartu Layanan 3: Akta Kelahiran --}}
                        <div class="bg-white p-4 rounded-xl shadow-lg border border-gray-200 hover:shadow-xl transition duration-200">
                            <div class="flex justify-between items-start mb-2">
                                <span class="bg-violet-100 text-violet-600 p-2 rounded-lg">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                </span>
                                <span class="text-xs font-medium text-green-600 bg-green-100 px-3 py-1 rounded-full">Tersedia</span>
                            </div>
                            <h3 class="font-semibold text-gray-900">Akta Kelahiran</h3>
                            <p class="text-xs text-gray-500 my-2">Pengurusan akta kelahiran dan kematian</p>
                            <div class="flex justify-between items-center pt-2 border-t border-gray-100">
                                <span class="flex items-center text-sm text-gray-500">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    3-5 Hari
                                </span>
                                <a href="#" class="text-teal-600 hover:text-teal-800 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </a>
                            </div>
                        </div>

                        {{-- Kartu Layanan 4: Izin Kegiatan --}}
                        <div class="bg-white p-4 rounded-xl shadow-lg border border-gray-200 hover:shadow-xl transition duration-200">
                            <div class="flex justify-between items-start mb-2">
                                <span class="bg-red-100 text-red-600 p-2 rounded-lg">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </span>
                                <span class="text-xs font-medium text-green-600 bg-green-100 px-3 py-1 rounded-full">Tersedia</span>
                            </div>
                            <h3 class="font-semibold text-gray-900">Izin Kegiatan</h3>
                            <p class="text-xs text-gray-500 my-2">Perizinan untuk berbagai kegiatan dan acara</p>
                            <div class="flex justify-between items-center pt-2 border-t border-gray-100">
                                <span class="flex items-center text-sm text-gray-500">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    1-3 Hari
                                </span>
                                <a href="#" class="text-teal-600 hover:text-teal-800 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- =================================== --}}
        {{-- BAGIAN CTA (BUTUH BANTUAN) --}}
        {{-- =================================== --}}
        {{-- <section class="mb-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-teal-600 text-white p-8 md:p-12 rounded-xl shadow-2xl text-center">
                    <h3 class="text-2xl font-bold mb-3">Butuh Bantuan Lebih Lanjut?</h3>
                    <p class="mb-8 max-w-3xl mx-auto">
                        Tim *customer service* kami siap membantu Anda 24/7. Hubungi kami untuk konsultasi gratis mengenai layanan yang tersedia.
                    </p>
                    <div class="flex justify-center space-x-4">
                        <a href="#" class="inline-flex items-center px-6 py-3 border border-white text-base font-medium rounded-lg text-white bg-transparent hover:bg-white/10 transition duration-150 ease-in-out">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Ajukan Pengaduan
                        </a>
                        <a href="#" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-teal-600 bg-white hover:bg-gray-100 transition duration-150 ease-in-out">
                             <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            Hubungi CS
                        </a>
                    </div>
                </div>
            </div>
        </section> --}}

        {{-- =================================== --}}
        {{-- BAGIAN PETA ADMINISTRASI --}}
        {{-- =================================== --}}
        {{-- <section class="py-20 bg-gray-50 border-t border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-800">Peta Administrasi Cupak Tangah</h2>
                    <p class="text-gray-500 mt-2">Jelajahi fasilitas dan *landmark* penting di wilayah kami</p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8"> --}}

                    {{-- Blok Kiri: Peta Interaktif (Placeholder) --}}
                    {{-- <div class="lg:col-span-2 bg-green-50/50 rounded-xl shadow-lg p-6 flex flex-col h-[500px]"> --}}

                        {{-- Legend (Marker List) --}}
                        {{-- <div class="flex flex-wrap gap-2 mb-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 border border-blue-300">
                                <span class="w-2 h-2 rounded-full bg-blue-800 mr-2"></span>
                                Kantor Kelurahan
                            </span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-300">
                                <span class="w-2 h-2 rounded-full bg-green-800 mr-2"></span>
                                Pasar
                            </span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800 border border-purple-300">
                                <span class="w-2 h-2 rounded-full bg-purple-800 mr-2"></span>
                                Sekolah
                            </span>
                        </div> --}}

                        {{-- Area Peta Placeholder --}}
                        {{-- <div class="flex-grow flex flex-col items-center justify-center bg-white border border-gray-300 rounded-lg shadow-inner text-center">
                            <div class="p-6">
                                <svg class="w-12 h-12 text-teal-600 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <p class="text-lg font-semibold text-gray-800">Peta Interaktif</p>
                                <p class="text-sm text-gray-500 mt-1">Peta Google Maps akan ditampilkan di sini dengan *marker* fasilitas umum dan batas administrasi</p>
                                <span class="mt-3 inline-block bg-teal-600 text-white text-xs font-medium px-3 py-1 rounded-full">
                                    Koordinat: -0.8471°S, 100.4338°E
                                </span>
                            </div>
                        </div>

                    </div> --}}

                    {{-- Blok Kanan: Daftar Fasilitas --}}
                    {{-- <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Fasilitas Umum</h3> --}}

                        {{-- Item Fasilitas 1: Kantor Kelurahan --}}
                        {{-- <div class="bg-white p-4 rounded-xl shadow-md border border-gray-200 flex justify-between items-center hover:shadow-lg transition duration-200">
                            <div class="flex items-center">
                                <span class="bg-blue-100 text-blue-600 p-2 rounded-lg mr-4">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h-2M5 21h2m0 0h10M5 21v-4a2 2 0 012-2h10a2 2 0 012 2v4"></path></svg>
                                </span>
                                <div>
                                    <p class="font-medium text-gray-800">Kantor Kelurahan</p>
                                    <p class="text-sm text-gray-500">1 lokasi</p>
                                </div>
                            </div>
                            <span class="text-xl font-bold text-gray-600 bg-gray-100 px-3 py-1 rounded-full">1</span>
                        </div> --}}

                        {{-- Item Fasilitas 2: Pasar Tradisional --}}
                        {{-- <div class="bg-white p-4 rounded-xl shadow-md border border-gray-200 flex justify-between items-center hover:shadow-lg transition duration-200">
                            <div class="flex items-center">
                                <span class="bg-green-100 text-green-600 p-2 rounded-lg mr-4">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                </span>
                                <div>
                                    <p class="font-medium text-gray-800">Pasar Tradisional</p>
                                    <p class="text-sm text-gray-500">3 lokasi</p>
                                </div>
                            </div>
                            <span class="text-xl font-bold text-gray-600 bg-gray-100 px-3 py-1 rounded-full">3</span>
                        </div> --}}

                        {{-- Item Fasilitas 3: Sekolah --}}
                        {{-- <div class="bg-white p-4 rounded-xl shadow-md border border-gray-200 flex justify-between items-center hover:shadow-lg transition duration-200">
                            <div class="flex items-center">
                                <span class="bg-purple-100 text-purple-600 p-2 rounded-lg mr-4">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M5 3v18h14V3M7 3h10v6H7V3z"></path></svg>
                                </span>
                                <div>
                                    <p class="font-medium text-gray-800">Sekolah</p>
                                    <p class="text-sm text-gray-500">8 lokasi</p>
                                </div>
                            </div>
                            <span class="text-xl font-bold text-gray-600 bg-gray-100 px-3 py-1 rounded-full">8</span>
                        </div> --}}

                        {{-- Item Fasilitas 4: Masjid --}}
                        {{-- <div class="bg-white p-4 rounded-xl shadow-md border border-gray-200 flex justify-between items-center hover:shadow-lg transition duration-200">
                            <div class="flex items-center">
                                <span class="bg-orange-100 text-orange-600 p-2 rounded-lg mr-4">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H9a1 1 0 01-1-1v-1a2 2 0 00-2-2H6a2 2 0 00-2 2v1a1 1 0 01-1 1h18a1 1 0 011-1v-1a2 2 0 00-2-2h-2a2 2 0 00-2 2v1a1 1 0 01-1 1z"></path></svg>
                                </span>
                                <div>
                                    <p class="font-medium text-gray-800">Masjid</p>
                                    <p class="text-sm text-gray-500">12 lokasi</p>
                                </div>
                            </div>
                            <span class="text-xl font-bold text-gray-600 bg-gray-100 px-3 py-1 rounded-full">12</span>
                        </div> --}}

                        {{-- Item Fasilitas 5: PLTA --}}
                        {{-- <div class="bg-white p-4 rounded-xl shadow-md border border-gray-200 flex justify-between items-center hover:shadow-lg transition duration-200">
                            <div class="flex items-center">
                                <span class="bg-yellow-100 text-yellow-600 p-2 rounded-lg mr-4">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                </span>
                                <div>
                                    <p class="font-medium text-gray-800">PLTA</p>
                                    <p class="text-sm text-gray-500">2 lokasi</p>
                                </div>
                            </div>
                            <span class="text-xl font-bold text-gray-600 bg-gray-100 px-3 py-1 rounded-full">2</span>
                        </div> --}}

                        {{-- Item Fasilitas 6: Objek Wisata --}}
                        {{-- <div class="bg-white p-4 rounded-xl shadow-md border border-gray-200 flex justify-between items-center hover:shadow-lg transition duration-200">
                              <div class="flex items-center">
                                <span class="bg-teal-100 text-teal-600 p-2 rounded-lg mr-4">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.667 9.818c0-3.92-3.177-7.098-7.098-7.098S5.471 5.898 5.471 9.818c0 3.738 2.871 6.848 6.551 7.07l.076.004c3.682-.222 6.553-3.332 6.553-7.07z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18v3m3-3h-6m6 0h-6"></path></svg>
                                </span>
                                <div>
                                    <p class="font-medium text-gray-800">Objek Wisata</p>
                                    <p class="text-sm text-gray-500">5 lokasi</p>
                                </div>
                            </div>
                            <span class="text-xl font-bold text-gray-600 bg-gray-100 px-3 py-1 rounded-full">5</span>
                        </div> --}}

                    {{-- </div>
                </div>
            </div>
        </section> --}}


        {{-- =================================== --}}
        {{-- BAGIAN RINGKASAN STATISTIK WILAYAH (Dipindahkan ke bawah PETA) --}}
        {{-- =================================== --}}
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- Statistik 1: RT/RW --}}
                <div class="bg-white p-6 rounded-xl shadow-lg text-center border border-gray-200">
                    <p class="text-4xl font-extrabold text-teal-600">12/6</p>
                    <p class="text-sm text-gray-600 mt-2">RT/RW</p>
                </div>

                {{-- Statistik 2: Luas Wilayah --}}
                <div class="bg-white p-6 rounded-xl shadow-lg text-center border border-gray-200">
                    <p class="text-4xl font-extrabold text-teal-600">2,99 km²</p>
                    <p class="text-sm text-gray-600 mt-2">Luas Wilayah</p>
                </div>

                {{-- Statistik 3: Ketinggian Rata-rata --}}
                <div class="bg-white p-6 rounded-xl shadow-lg text-center border border-gray-200">
                    <p class="text-4xl font-extrabold text-teal-600">850m</p>
                    <p class="text-sm text-gray-600 mt-2">Ketinggian Rata-rata</p>
                </div>

            </div>
        </section>



        {{-- =================================== --}}
        {{-- BAGIAN BARU: STRUKTUR ORGANISASI TATA KERJA --}}
        {{-- =================================== --}}
        <section class="py-20 bg-white border-t border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-800">Struktur Organisasi Tata Kerja</h2>
                    <p class="text-gray-500 mt-2">Tim pemimpin dan aparatur yang siap melayani masyarakat Cupak Tangah</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                    {{-- Card 1: Lurah --}}
                    <div class="bg-green-50/50 rounded-xl shadow-lg p-6 text-center border border-green-100">
                        <div class="relative inline-block mb-4">
                            <img class="w-24 h-24 rounded-full object-cover mx-auto"
                                 src="https://placehold.co/100x100/10B981/ffffff?text=AH"
                                 alt="Drs. Ahmad Suhendra, M.Si">
                            <span class="absolute top-0 right-0 bg-yellow-500 text-white text-xs font-semibold px-2 py-0.5 rounded-full shadow-md">
                                Lurah
                            </span>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800">SAIDUL BAHRI,SH</h3>
                        <p class="text-sm text-teal-600 font-semibold">LURAH</p>
                        <div class="mt-4 text-left space-y-1 text-sm text-gray-600">
                            <p class="flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                lurah@cupaktangah.co.id
                            </p>
                            <p class="flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                +62 751 123456
                            </p>
                        </div>
                    </div>

                    {{-- Card 2: Sekretaris --}}
                    <div class="bg-green-50/50 rounded-xl shadow-lg p-6 text-center border border-green-100">
                        <div class="relative inline-block mb-4">
                            <img class="w-24 h-24 rounded-full object-cover mx-auto"
                                 src="https://placehold.co/100x100/10B981/ffffff?text=SR"
                                 alt="Siti Rahmawati, S.Sos">
                            <span class="absolute top-0 right-0 bg-yellow-500/0 text-white text-xs font-semibold px-2 py-0.5 rounded-full shadow-md">
                            </span>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800">NEFRITA SARI,SE.MM</h3>
                        <p class="text-sm text-teal-600 font-semibold">SEKRETARIS</p>
                        <p class="text-sm text-gray-600">Sekretariat</p>
                        <div class="mt-4 text-left space-y-1 text-sm text-gray-600">
                            <p class="flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                sekretaris@cupaktangah.co.id
                            </p>
                            <p class="flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                +62 751 123457
                            </p>
                        </div>
                    </div>

                    {{-- Card 3: Kepala Seksi Pemerintahan --}}
                    <div class="bg-green-50/50 rounded-xl shadow-lg p-6 text-center border border-green-100">
                        <div class="relative inline-block mb-4">
                            <img class="w-24 h-24 rounded-full object-cover mx-auto"
                                 src="https://placehold.co/100x100/10B981/ffffff?text=BS"
                                 alt="Budi Santoso, S.Ap">
                            <span class="absolute top-0 right-0 bg-yellow-500/0 text-white text-xs font-semibold px-2 py-0.5 rounded-full shadow-md">
                            </span>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800">MELI CHAIRANI,A.MD</h3>
                        <p class="text-sm text-teal-600 font-semibold">SAKSI TAPEM</p>
                        <p class="text-sm text-gray-600">Seksi Pemerintahan</p>
                        <div class="mt-4 text-left space-y-1 text-sm text-gray-600">
                            <p class="flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                pemerintahan@cupaktangah.co.id
                            </p>
                            <p class="flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                +62 751 123458
                            </p>
                        </div>
                    </div>

                    {{-- Card 4: Kepala Seksi Kesejahteraan --}}
                    <div class="bg-green-50/50 rounded-xl shadow-lg p-6 text-center border border-green-100">
                        <div class="relative inline-block mb-4">
                            <img class="w-24 h-24 rounded-full object-cover mx-auto"
                                 src="https://placehold.co/100x100/10B981/ffffff?text=RM"
                                 alt="Rina Marlina, S.E">
                            <span class="absolute top-0 right-0 bg-yellow-500/0 text-white text-xs font-semibold px-2 py-0.5 rounded-full shadow-md">
                            </span>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800">Rina Marlina, S.E</h3>
                        <p class="text-sm text-teal-600 font-semibold">Kepala Seksi Kesejahteraan</p>
                        <p class="text-sm text-gray-600">Seksi Kesejahteraan</p>
                        <div class="mt-4 text-left space-y-1 text-sm text-gray-600">
                            <p class="flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                kesejahteraan@cupaktangah.co.id
                            </p>
                            <p class="flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                +62 751 123459
                            </p>
                        </div>
                    </div>

                    {{-- Card 5: Kepala Seksi Pelayanan --}}
                    <div class="bg-green-50/50 rounded-xl shadow-lg p-6 text-center border border-green-100">
                        <div class="relative inline-block mb-4">
                            <img class="w-24 h-24 rounded-full object-cover mx-auto"
                                 src="https://placehold.co/100x100/10B981/ffffff?text=IW"
                                 alt="Indra Wijaya, S.T">
                            <span class="absolute top-0 right-0 bg-yellow-500/0 text-white text-xs font-semibold px-2 py-0.5 rounded-full shadow-md">
                            </span>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800">Indra Wijaya, S.T</h3>
                        <p class="text-sm text-teal-600 font-semibold">Kepala Seksi Pelayanan</p>
                        <p class="text-sm text-gray-600">Seksi Pelayanan</p>
                        <div class="mt-4 text-left space-y-1 text-sm text-gray-600">
                            <p class="flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                pelayanan@cupaktangah.co.id
                            </p>
                            <p class="flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                +62 751 123460
                            </p>
                        </div>
                    </div>

                    {{-- Card 6: Kepala Seksi Ekonomi --}}
                    <div class="bg-green-50/50 rounded-xl shadow-lg p-6 text-center border border-green-100">
                        <div class="relative inline-block mb-4">
                            <img class="w-24 h-24 rounded-full object-cover mx-auto"
                                 src="https://placehold.co/100x100/10B981/ffffff?text=MS"
                                 alt="Maya Sari, S.Kom">
                            <span class="absolute top-0 right-0 bg-yellow-500/0 text-white text-xs font-semibold px-2 py-0.5 rounded-full shadow-md">
                            </span>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800">Maya Sari, S.Kom</h3>
                        <p class="text-sm text-teal-600 font-semibold">Kepala Seksi Ekonomi</p>
                        <p class="text-sm text-gray-600">Seksi Ekonomi & Pembangunan</p>
                        <div class="mt-4 text-left space-y-1 text-sm text-gray-600">
                            <p class="flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                ekonomi@cupaktangah.co.id
                            </p>
                            <p class="flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                +62 751 123461
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        {{-- =================================== --}}
        {{-- BAGIAN JAM PELAYANAN --}}
        {{-- =================================== --}}
        <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-20 bg-white shadow-xl rounded-xl border border-gray-100 mb-12">
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-gray-800">Jam Pelayanan</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

                {{-- Kolom Kiri: Hari Kerja --}}
                <div>
                    <h3 class="text-lg font-bold text-gray-800 border-b pb-2 mb-4">Hari Kerja</h3>

                    <div class="flex justify-between items-center py-2">
                        <span class="font-semibold text-gray-700">Senin - Kamis</span>
                        <span class="font-semibold text-gray-800">08:00 – 15:30 WIB</span>
                    </div>

                    <div class="flex justify-between items-center py-2 border-t border-gray-100">
                        <span class="font-semibold text-gray-700">Jumat</span>
                        <span class="font-semibold text-gray-800">08:00 – 11:30 WIB</span>
                    </div>

                    <div class="flex justify-between items-center py-2 border-t border-gray-100">
                        <span class="font-semibold text-gray-700">Sabtu - Minggu</span>
                        <span class="font-bold text-red-600">Tutup</span>
                    </div>
                </div>

                {{-- Kolom Kanan: Layanan Online --}}
                <div>
                    <h3 class="text-lg font-bold text-gray-800 border-b pb-2 mb-4">Layanan Online</h3>

                    <div class="flex justify-between items-center py-2">
                        <span class="font-semibold text-teal-600 hover:underline">Portal Sipangah</span>
                        <span class="font-bold text-green-600">24/7</span>
                    </div>

                    <div class="flex justify-between items-center py-2 border-t border-gray-100">
                        <span class="font-semibold text-teal-600 hover:underline">WhatsApp CS</span>
                        <span class="font-semibold text-gray-800">08:00 – 20:00 WIB</span>
                    </div>

                    <div class="flex justify-between items-center py-2 border-t border-gray-100">
                        <span class="font-semibold text-teal-600 hover:underline">Email Support</span>
                        <span class="font-bold text-green-600">24/7</span>
                    </div>
                </div>

            </div>
        </section>


        {{-- =================================== --}}
        {{-- FOOTER --}}
        {{-- =================================== --}}
        <footer class="bg-gray-900 text-white pt-12">

            {{-- Top Bar Darurat --}}
            <div class="bg-red-600 py-3 text-center text-sm font-semibold">
                <p>
                    <span class="mr-2">⚠️</span> Darurat? Hubungi 112 atau (0751) 7051234
                </p>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-10">

                    {{-- KOLOM 1: INFO KONTAK UTAMA --}}
                    <div>
                        <div class="flex items-center mb-4">
                            <span class="text-xl font-extrabold text-teal-400 mr-2">CT</span>
                            <span class="text-lg font-semibold">Cupak Tangah</span>
                        </div>
                        <p class="text-sm text-gray-400 mb-4">
                            Sistem Informasi Kelurahan Cupak Tangah yang melayani masyarakat dengan teknologi modern dan pelayanan terbaik.
                        </p>

                        <div class="text-sm text-gray-400 space-y-2">
                            <p class="flex items-start">
                                <svg class="w-5 h-5 mr-3 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                Jl. Raya Cupak Tangah No. 123 Kec. Pauh, Kota Padang 25163
                            </p>
                            <p class="flex items-center">
                                <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                (0751) 7051234
                            </p>
                            <p class="flex items-center">
                                <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                info@cupaktangah.padang.go.id
                            </p>
                        </div>
                    </div>

                    {{-- KOLOM 2: MENU UTAMA & LAYANAN --}}
                    <div>
                        <h3 class="text-lg font-semibold text-white mb-4">Menu Utama</h3>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#" class="text-gray-400 hover:text-teal-400 transition">Beranda</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-teal-400 transition">Layanan</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-teal-400 transition">Pengaduan</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-teal-400 transition">Berita</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-teal-400 transition">Galeri</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-teal-400 transition">Peta</a></li>
                        </ul>
                    </div>

                    {{-- KOLOM 3: LAYANAN & NOMOR DARURAT --}}
                    <div>
                        <h3 class="text-lg font-semibold text-white mb-4">Layanan</h3>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#" class="text-gray-400 hover:text-teal-400 transition">Surat Domisili</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-teal-400 transition">SKTM</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-teal-400 transition">Akta Kelahiran</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-teal-400 transition">Izin Kegiatan</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-teal-400 transition">Pengaduan Online</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-teal-400 transition">Bantuan CS</a></li>
                        </ul>
                    </div>

                    {{-- KOLOM 4: NOMOR DARURAT & SOSIAL MEDIA --}}
                    <div>
                        <h3 class="text-lg font-semibold text-white mb-4">Nomor Darurat</h3>
                        <div class="space-y-1 text-sm mb-6">
                            <div class="flex justify-between">
                                <span class="text-gray-400">Polsek Pauh</span>
                                <span class="font-semibold text-teal-400">(0751) 7051234</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Puskesmas</span>
                                <span class="font-semibold text-teal-400">(0751) 7051235</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Damkar</span>
                                <span class="font-semibold text-teal-400">(0751) 7051236</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Emergency</span>
                                <span class="font-bold text-red-400">112</span>
                            </div>
                        </div>

                        <h3 class="text-lg font-semibold text-white mb-4">Jam Operasional</h3>
                        <div class="space-y-1 text-sm mb-6">
                            <div class="flex justify-between">
                                <span class="text-gray-400">Senin - Kamis</span>
                                <span class="font-semibold text-gray-300">08:00 – 15:30</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Jumat</span>
                                <span class="font-semibold text-gray-300">08:00 – 11:30</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Sabtu - Minggu</span>
                                <span class="font-bold text-red-500">Tutup</span>
                            </div>
                        </div>

                        <h3 class="text-lg font-semibold text-white mb-4">Ikuti Kami</h3>
                        <div class="flex space-x-3">
                            {{-- Placeholder Icons untuk Sosial Media --}}
                            <a href="#" class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-700 hover:bg-teal-600 transition">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 2C6.477 2 2 6.477 2 12c0 5.084 3.738 9.31 8.604 10.043v-7.043h-2.54v-3h2.54V9.35c0-2.51 1.49-3.9 3.774-3.9 1.094 0 2.24.195 2.24.195v2.46h-1.26c-1.247 0-1.637.772-1.637 1.564v1.88h2.77l-.446 3h-2.324v7.043C18.262 21.31 22 17.084 22 12c0-5.523-4.477-10-10-10z"/></svg>
                            </a>
                            <a href="#" class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-700 hover:bg-teal-600 transition">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 2c-3.197 0-4.28 0-4.326.02-.07.006-.118.01-.17.01-.482.02-.75.056-1.12.18-.363.125-.688.318-.99.62-.303.3-.497.625-.622.99-.124.37-.158.64-.18 1.12-.02.05-.015.1-.01.17-.003.046 0 .142 0 .326v4.326c0 .184 0 .28-.003.326-.006.07-.01.118-.01.17-.02.482-.056.75-.18 1.12-.125.363-.318.688-.62.99-.3.303-.625.497-.99.622-.37.124-.64.158-1.12.18-.05.002-.1.01-.17.01-.046.003-.142 0-.326 0-3.197 0-4.28 0-4.326-.02-.07-.006-.118-.01-.17-.01-.482-.02-.75-.056-1.12-.18-.363-.125-.688-.318-.99-.62-.303-.3-.497-.625-.622-.99-.124-.37-.158-.64-.18-1.12-.002-.05-.01-.1-.01-.17-.003-.046 0-.142 0-.326V12c0-3.197 0-4.28-.02-4.326zM12 16.5a4.5 4.5 0 110-9 4.5 4.5 0 010 9zm0-2a2.5 2.5 0 100-5 2.5 2.5 0 000 5zM17.5 7A.5.5 0 0117 7.5a.5.5 0 01-1 0 .5.5 0 010-1 .5.5 0 01.5.5z"/></svg>
                            </a>
                            <a href="#" class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-700 hover:bg-teal-600 transition">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M22.062 6.062c-.628.278-1.306.465-2.01.554.724-.435 1.282-1.122 1.543-1.94-.68.405-1.43.698-2.227.854C18.528 4.67 17.527 4.25 16.486 4.25c-1.92 0-3.47 1.55-3.47 3.47 0 .272.03.535.086.79C10.742 7.74 8.52 6.543 6.945 4.79c-.31.53-.487 1.144-.487 1.802 0 1.2.613 2.25 1.54 2.873-.603-.02-1.17-.184-1.666-.46v.04c0 1.68 1.198 3.085 2.784 3.4c-.29.08-.597.124-.91.124-.224 0-.44-.022-.656-.062.443 1.38 1.72 2.38 3.237 2.41-1.187.933-2.68 1.49-4.3 1.49-.276 0-.546-.016-.814-.047 1.535.986 3.356 1.564 5.32 1.564 6.38 0 9.873-5.285 9.873-9.872 0-.15-.003-.298-.008-.445.676-.487 1.26-1.1 1.72-1.792z"/></svg>
                            </a>
                            <a href="#" class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-700 hover:bg-teal-600 transition">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 2C6.477 2 2 6.477 2 12c0 5.523 4.477 10 10 10 5.523 0 10-4.477 10-10C22 6.477 17.523 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8zM12 7c-2.761 0-5 2.239-5 5s2.239 5 5 5 5-2.239 5-5-2.239-5-5-5zm0 8c-1.656 0-3-1.344-3-3s1.344-3 3-3 3 1.344 3 3-1.344 3-3 3z"/></svg>
                            </a>
                        </div>
                    </div>

                </div>

                {{-- FOOTER BAWAH (Kebijakan & Hak Cipta) --}}
                <div class="border-t border-gray-700/50 pt-6 mt-6 flex flex-col md:flex-row justify-between items-center text-gray-400">
                    <p class="text-sm">&copy; {{ date('Y') }} Kelurahan Cupak Tangah. Semua hak dilindungi.</p>
                    <div class="flex space-x-4 mt-4 md:mt-0 text-sm">
                        <a href="#" class="hover:text-teal-400">Kebijakan Privasi</a>
                        <a href="#" class="hover:text-teal-400">Syarat & Ketentuan</a>
                        <a href="#" class="hover:text-teal-400">Peta Situs</a>
                    </div>
                </div>
            </div>
        </footer>

    </div>
</body>
</html>
