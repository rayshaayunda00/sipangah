{{-- 1. Memberitahu Laravel untuk "memakai" bingkai/layout --}}
@extends('layouts.admin')

{{-- 2. Mengatur judul halaman --}}
@section('title', 'Dashboard')

{{-- 3. Ini adalah "isi" yang akan dimasukkan ke @yield('content') di layout --}}
@section('content')

    {{-- === WAKTU SAAT INI === --}}
    <div class="mb-8 bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 flex flex-col md:flex-row items-center justify-between gap-4">
        {{-- Kiri: Sapaan --}}
        <div class="text-center md:text-left">
            <h2 id="dynamic-greeting" class="text-2xl font-bold text-gray-800 dark:text-white">
                Selamat Datang, Admin!
            </h2>
            <p class="text-gray-500 dark:text-gray-400 mt-1 text-sm">
                Pantau perkembangan terkini website Kelurahan Cupak Tangah.
            </p>
        </div>

        {{-- Kanan: Jam Digital --}}
        <div class="flex items-center gap-4 bg-gray-50 dark:bg-gray-700/50 px-5 py-3 rounded-xl border border-gray-200 dark:border-gray-600">
            <div class="p-2 bg-blue-100 text-blue-600 rounded-lg">
                <i class="fas fa-clock text-xl"></i>
            </div>
            <div class="text-right">
                <div class="text-xl font-bold text-gray-900 dark:text-white tracking-wide" id="live-time">
                    {{ \Carbon\Carbon::now()->format('H:i:s') }}
                </div>
                <div class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider" id="live-date">
                    {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                </div>
            </div>
        </div>
    </div>

    {{-- === STATISTIK GRID (TAMPILAN BARU) === --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6 mb-10">

        {{-- 1. Card User --}}
        <div class="group bg-white dark:bg-gray-800 rounded-2xl p-5 shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-bold text-blue-500 uppercase tracking-wider mb-1">Total Pengguna</p>
                    <h3 class="text-3xl font-extrabold text-gray-800 dark:text-white">{{ $jumlahUser }}</h3>
                </div>
                <div class="p-3 bg-blue-50 dark:bg-blue-900/20 text-blue-600 rounded-xl group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                    <i class="fas fa-users text-xl"></i>
                </div>
            </div>

        </div>

        {{-- 2. Card Artikel --}}
        <div class="group bg-white dark:bg-gray-800 rounded-2xl p-5 shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-bold text-indigo-500 uppercase tracking-wider mb-1">Artikel Terbit</p>
                    <h3 class="text-3xl font-extrabold text-gray-800 dark:text-white">{{ $jumlahArtikel }}</h3>
                </div>
                <div class="p-3 bg-indigo-50 dark:bg-indigo-900/20 text-indigo-600 rounded-xl group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-300">
                    <i class="fas fa-newspaper text-xl"></i>
                </div>
            </div>

        </div>

        {{-- 3. Card Potensi --}}
        <div class="group bg-white dark:bg-gray-800 rounded-2xl p-5 shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-bold text-emerald-500 uppercase tracking-wider mb-1">Data Potensi</p>
                    <h3 class="text-3xl font-extrabold text-gray-800 dark:text-white">{{ $jumlahPotensi }}</h3>
                </div>
                <div class="p-3 bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 rounded-xl group-hover:bg-emerald-600 group-hover:text-white transition-colors duration-300">
                    <i class="fas fa-seedling text-xl"></i>
                </div>
            </div>

        </div>

        {{-- 4. Card Galeri --}}
        <div class="group bg-white dark:bg-gray-800 rounded-2xl p-5 shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-bold text-purple-500 uppercase tracking-wider mb-1">Album Galeri</p>
                    <h3 class="text-3xl font-extrabold text-gray-800 dark:text-white">{{ $jumlahGaleri ?? 0 }}</h3>
                </div>
                <div class="p-3 bg-purple-50 dark:bg-purple-900/20 text-purple-600 rounded-xl group-hover:bg-purple-600 group-hover:text-white transition-colors duration-300">
                    <i class="fas fa-images text-xl"></i>
                </div>
            </div>

        </div>

        {{-- 5. Card Pengaduan --}}
        <div class="group bg-white dark:bg-gray-800 rounded-2xl p-5 shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-bold text-rose-500 uppercase tracking-wider mb-1">Pengaduan</p>
                    <h3 class="text-3xl font-extrabold text-gray-800 dark:text-white">{{ $jumlahPengaduan ?? 0 }}</h3>
                </div>
                <div class="p-3 bg-rose-50 dark:bg-rose-900/20 text-rose-600 rounded-xl group-hover:bg-rose-600 group-hover:text-white transition-colors duration-300">
                    <i class="fas fa-bullhorn text-xl"></i>
                </div>
            </div>
        </div>

    </div>

    {{-- === MENU AKSES CEPAT (DIPERBAGUS) === --}}
    <div class="mb-6">
        <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-5 flex items-center gap-2">
            <span class="w-1 h-6 bg-teal-500 rounded-full"></span>
            Akses Cepat Menu
        </h3>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">

            <a href="{{ route('admin.galeri.index') }}" class="flex flex-col items-center justify-center p-6 bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md hover:border-teal-500 transition-all duration-300 group cursor-pointer h-full">
                <div class="w-14 h-14 rounded-full bg-teal-50 text-teal-600 flex items-center justify-center mb-3 group-hover:scale-110 transition-transform shadow-sm">
                    <i class="fas fa-images text-xl"></i>
                </div>
                <h4 class="font-semibold text-gray-800 dark:text-white text-sm">Galeri</h4>
                <span class="text-xs text-gray-400 mt-1">Upload Foto</span>
            </a>

            <a href="{{ route('admin.pengaduan.index') }}" class="flex flex-col items-center justify-center p-6 bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md hover:border-rose-500 transition-all duration-300 group cursor-pointer h-full">
                <div class="w-14 h-14 rounded-full bg-rose-50 text-rose-600 flex items-center justify-center mb-3 group-hover:scale-110 transition-transform shadow-sm">
                    <i class="fas fa-concierge-bell text-xl"></i>
                </div>
                <h4 class="font-semibold text-gray-800 dark:text-white text-sm">Pengaduan</h4>
                <span class="text-xs text-gray-400 mt-1">Cek Laporan</span>
            </a>

            <a href="{{ route('admin.artikel.index') }}" class="flex flex-col items-center justify-center p-6 bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md hover:border-indigo-500 transition-all duration-300 group cursor-pointer h-full">
                <div class="w-14 h-14 rounded-full bg-indigo-50 text-indigo-600 flex items-center justify-center mb-3 group-hover:scale-110 transition-transform shadow-sm">
                    <i class="fas fa-edit text-xl"></i>
                </div>
                <h4 class="font-semibold text-gray-800 dark:text-white text-sm">Artikel</h4>
                <span class="text-xs text-gray-400 mt-1">Tulis Berita</span>
            </a>

            <a href="{{ route('admin.item_potensi.index') }}" class="flex flex-col items-center justify-center p-6 bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md hover:border-emerald-500 transition-all duration-300 group cursor-pointer h-full">
                <div class="w-14 h-14 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center mb-3 group-hover:scale-110 transition-transform shadow-sm">
                    <i class="fas fa-leaf text-xl"></i>
                </div>
                <h4 class="font-semibold text-gray-800 dark:text-white text-sm">Potensi</h4>
                <span class="text-xs text-gray-400 mt-1">Input Data</span>
            </a>

            <a href="{{ route('admin.users.index') }}" class="flex flex-col items-center justify-center p-6 bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md hover:border-blue-500 transition-all duration-300 group cursor-pointer h-full">
                <div class="w-14 h-14 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center mb-3 group-hover:scale-110 transition-transform shadow-sm">
                    <i class="fas fa-users-cog text-xl"></i>
                </div>
                <h4 class="font-semibold text-gray-800 dark:text-white text-sm">Pengguna</h4>
                <span class="text-xs text-gray-400 mt-1">Atur Akun</span>
            </a>
        </div>
    </div>

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
