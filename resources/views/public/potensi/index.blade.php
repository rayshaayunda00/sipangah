{{-- resources/views/public/potensi/index.blade.php --}}
@extends('layouts.app') {{-- Gunakan layout utama yang sudah ada navbar --}}

@section('title', 'Potensi Daerah & UMKM') {{-- Judul halaman --}}

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-600 to-teal-500 text-white py-16">
        <div class="max-w-6xl mx-auto text-center px-4">
            <h1 class="text-4xl font-bold mb-4">Potensi Daerah & UMKM Lokal</h1>
            <p class="text-lg opacity-90">Temukan berbagai potensi dan usaha masyarakat sekitar Anda</p>
        </div>
    </section>

    <!-- Filter Kategori -->
    <section class="max-w-6xl mx-auto py-8 px-4">
        <div class="flex flex-wrap gap-3 justify-center">
            <a href="{{ route('potensi.public.index') }}"
               class="px-4 py-2 rounded-full {{ !$kategoriAktif ? 'bg-blue-600 text-white' : 'bg-gray-200 hover:bg-blue-100' }}">
               Semua
            </a>
            @foreach ($kategori as $kat)
            <a href="{{ route('potensi.public.index', ['kategori' => $kat->nama_kategori]) }}"
               class="px-4 py-2 rounded-full {{ $kategoriAktif == $kat->nama_kategori ? 'bg-blue-600 text-white' : 'bg-gray-200 hover:bg-blue-100' }}">
               {{ $kat->nama_kategori }}
            </a>
            @endforeach
        </div>
    </section>

    <!-- Daftar Item Potensi -->
    <section class="max-w-6xl mx-auto py-10 px-4">
        @if ($items->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($items as $item)
            <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-4">
                <img src="{{ $item->url_gambar_utama ? asset('storage/' . $item->url_gambar_utama) : 'https://via.placeholder.com/400x200' }}"
                     alt="{{ $item->nama_item }}"
                     class="w-full h-48 object-cover rounded-lg mb-3">

                <h3 class="font-bold text-lg text-gray-800 mb-1">{{ $item->nama_item }}</h3>
                <p class="text-sm text-gray-500 mb-2">{{ $item->deskripsi_singkat }}</p>
                @if ($item->alamat)
                <p class="text-sm text-gray-600 mb-2">{{ $item->alamat }}</p>
                @endif
                @if ($item->no_hp)
                <p class="text-sm text-blue-600 font-semibold">☎ {{ $item->no_hp }}</p>
                @endif
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center text-gray-600 py-10">
            <p>Tidak ada potensi yang ditemukan.</p>
        </div>
        @endif
    </section>
@endsection
