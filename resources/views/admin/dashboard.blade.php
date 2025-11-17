{{-- 1. Memberitahu Laravel untuk "memakai" bingkai/layout --}}
@extends('layouts.admin')

{{-- 2. Mengatur judul halaman --}}
@section('title', 'Dashboard')

{{-- 3. Ini adalah "isi" yang akan dimasukkan ke @yield('content') di layout --}}
@section('content')

    {{-- === WAKTU SAAT INI (TATA LETAK BARU: SPLIT) === --}}
    <div class="mb-6 bg-white dark:bg-gray-800 p-5 rounded-xl shadow-md flex items-center justify-between">

        {{-- Kiri: Sapaan Dinamis --}}
        <div>
            <div id="dynamic-greeting" class="text-xl font-semibold text-gray-800 dark:text-white">
                {{-- Fallback jika JS gagal --}}
                Selamat Datang, Admin!
            </div>
            <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Berikut adalah ringkasan aktivitas website Anda.
            </div>
        </div>

        {{-- Kanan: Jam & Tanggal Live --}}
        <div class="flex items-center gap-4">
            <i class="fas fa-clock text-blue-500 text-3xl fa-fw"></i>
            <div class="text-right"> {{-- Membuat teks jam rata kanan --}}

                {{-- Waktu (dibuat lebih besar) --}}
                <div class="text-lg font-semibold text-gray-900 dark:text-white">
                    <span id="live-time">
                        {{-- Fallback: Tampilkan waktu dari server --}}
                        {{ \Carbon\Carbon::now()->translatedFormat('H:i:s') }}
                    </span> WIB
                </div>

                {{-- Tanggal (dibuat lebih kecil) --}}
                <div id="live-date" class="text-sm font-medium text-gray-600 dark:text-gray-300">
                    {{-- Fallback: Tampilkan tanggal dari server --}}
                    {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                </div>
            </div>
        </div>
    </div>
    {{-- === AKHIR WAKTU === --}}


    {{-- === STATISTIK CARD === --}}
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
    {{-- === AKHIR STATISTIK CARD === --}}


    {{-- === MENU AKSES CEPAT === --}}
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
    {{-- === AKHIR MENU AKSES CEPAT === --}}

@endsection


{{-- ================================================================== --}}
{{-- SCRIPT KHUSUS UNTUK HALAMAN INI (UNTUK JAM LIVE) --}}
{{-- ================================================================== --}}
@push('scripts')
<script>
    // Fungsi ini akan mengupdate sapaan, tanggal, dan jam
    function updateLiveClock() {
        const now = new Date();
        const hour = now.getHours();

        // 1. Update Sapaan (Greeting)
        const greetingEl = document.getElementById('dynamic-greeting');
        if (greetingEl) {
            let greetingText = 'Selamat Datang, Admin!';
            if (hour < 4) {
                greetingText = 'Selamat Dini Hari, Admin!';
            } else if (hour < 11) {
                greetingText = 'Selamat Pagi, Admin!';
            } else if (hour < 15) {
                greetingText = 'Selamat Siang, Admin!';
            } else if (hour < 19) {
                greetingText = 'Selamat Sore, Admin!';
            } else {
                greetingText = 'Selamat Malam, Admin!';
            }
            greetingEl.innerText = greetingText;
        }

        // 2. Update Tanggal (Date)
        const dateEl = document.getElementById('live-date');
        const dateOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        if (dateEl) {
            dateEl.innerText = now.toLocaleDateString('id-ID', dateOptions);
        }

        // 3. Update Waktu (Time)
        const timeEl = document.getElementById('live-time');
        const timeOptions = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };
        if (timeEl) {
            // Mengganti format '14.30.05' (format id-ID) menjadi '14:30:05'
            timeEl.innerText = now.toLocaleTimeString('id-ID', timeOptions).replace(/\./g, ':');
        }
    }

    // Panggil fungsi sekali saat halaman dimuat agar tidak ada kedipan
    updateLiveClock();

    // Panggil fungsi setiap detik (1000ms) untuk mengupdate jam
    setInterval(updateLiveClock, 1000);
</script>
@endpush
