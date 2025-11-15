{{-- 1. Memberitahu Laravel untuk "memakai" bingkai/layout --}}
@extends('layouts.admin') {{-- Pastikan nama ini sama dengan nama file layout Anda --}}

{{-- 2. Mengatur judul halaman --}}
@section('title', 'Dashboard')

{{-- 3. Ini adalah "isi" yang akan dimasukkan ke @yield('content') di layout --}}
@section('content')

    <div class="stats-grid">
       <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md border-l-4 border-blue-500 hover:shadow-lg transition">
                <h3 class="text-gray-600 dark:text-gray-300 text-lg flex items-center">
                    <i class="fas fa-users text-blue-500 mr-2"></i> Jumlah User
                </h3>
                <div class="text-3xl font-bold mt-2 text-gray-800 dark:text-white">{{ $jumlahUser }}</div>
                <div class="text-green-500 mt-1 text-sm">
                    <i class="fas fa-arrow-up"></i>
                    <span>12% dari bulan lalu</span>
                </div>
            </div>

            <!-- Card Jumlah Artikel -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md border-l-4 border-indigo-500 hover:shadow-lg transition">
                <h3 class="text-gray-600 dark:text-gray-300 text-lg flex items-center">
                    <i class="fas fa-newspaper text-indigo-500 mr-2"></i> Jumlah Artikel
                </h3>
                <div class="text-3xl font-bold mt-2 text-gray-800 dark:text-white">{{ $jumlahArtikel }}</div>
                <div class="text-green-500 mt-1 text-sm">
                    <i class="fas fa-arrow-up"></i>
                    <span>5 artikel baru</span>
                </div>
            </div>

            <!-- Card Jumlah Potensi -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md border-l-4 border-green-500 hover:shadow-lg transition">
                <h3 class="text-gray-600 dark:text-gray-300 text-lg flex items-center">
                    <i class="fas fa-seedling text-green-500 mr-2"></i> Jumlah Potensi
                </h3>
                <div class="text-3xl font-bold mt-2 text-gray-800 dark:text-white">{{ $jumlahPotensi }}</div>
                <div class="text-green-500 mt-1 text-sm">
                    <i class="fas fa-arrow-up"></i>
                    <span>3 potensi baru</span>
                </div>
        </div>
    </div>

    <h3 class="page-title" style="font-size: 1.5rem; margin-top: 2.5rem; margin-bottom: 1.5rem; border-bottom: none;">Akses Cepat</h3>

    <div class="quick-menu-grid">
        <a href="{{ route('admin.galeri.index') }}" class="menu-card">
            <h4><i class="fas fa-images"></i> Kelola Galeri</h4>
            <p>Tambah, edit, dan hapus foto/video galeri.</p>
            <i class="fas fa-image card-icon"></i>
        </a>
        <a href="{{ route('admin.pengaduan.index') }}" class="menu-card">
            <h4><i class="fas fa-concierge-bell"></i> Kelola Pengaduan</h4>
            <p>Tinjau dan tanggapi laporan layanan pengaduan.</p>
            <i class="fas fa-concierge-bell card-icon"></i>
        </a>
        <a href="{{ route('admin.artikel.index') }}" class="menu-card">
            <h4><i class="fas fa-edit"></i> Kelola Artikel</h4>
            <p>Buat dan kelola artikel berita/edukasi.</p>
            <i class="fas fa-newspaper card-icon"></i>
        </a>
        <a href="{{ route('admin.item_potensi.index') }}" class="menu-card">
            <h4><i class="fas fa-leaf"></i> Kelola Potensi</h4>
            <p>Input dan atur data potensi daerah.</p>
            <i class="fas fa-file-alt card-icon"></i>
        </a>
        <a href="{{ route('admin.users.index') }}" class="menu-card">
            <h4><i class="fas fa-users"></i> Kelola Pengguna</h4>
            <p>Kelola data pengguna dan akses sistem.</p>
            <i class="fas fa-user-cog card-icon"></i>
        </a>
    </div>

@endsection
