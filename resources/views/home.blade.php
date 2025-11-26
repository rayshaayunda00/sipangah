@extends('layouts.app')

@section('title', 'Beranda | Kelurahan Cupak Tangah')

{{-- Tambahkan Font Poppins khusus untuk halaman Beranda ini --}}
@push('styles')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .font-poppins {
            font-family: 'Poppins', sans-serif;
        }
    </style>
@endpush

@section('content')
<div class="font-poppins bg-gray-50 text-gray-800">

    {{-- Hero Section --}}
    <section class="bg-[#f0fdf4] py-16 pt-24"> {{-- pt-24 agar tidak tertutup navbar fixed --}}
        <div class="max-w-screen-xl mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center gap-10">

                <div class="md:w-1/2">
                    <h1 class="text-4xl md:text-5xl font-bold leading-snug mb-4">
                        Kelurahan <span class="text-[#1abc9c]">Cupak Tangah</span>
                    </h1>
                    <p class="text-gray-600 mb-6">
                        Selamat datang di portal digital Kelurahan Cupak Tangah.
                        Kami hadir untuk memberikan pelayanan terbaik kepada masyarakat
                        dengan sistem informasi yang modern dan terintegrasi.
                    </p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                        <div class="bg-white p-4 rounded-xl shadow border border-gray-100 flex items-center gap-3">
                            <div class="p-3 bg-[#e8f9f5] rounded-lg">
                                <i class="fas fa-map-marker-alt text-[#1abc9c] text-xl"></i>
                            </div>
                            <div>
                                <p class="text-gray-500 text-sm">Lokasi</p>
                                <p class="font-semibold text-[#1abc9c]">Kec. Pauh, Padang</p>
                            </div>
                        </div>

                        <div class="bg-white p-4 rounded-xl shadow border border-gray-100 flex items-center gap-3">
                            <div class="p-3 bg-[#e8f9f5] rounded-lg">
                                <i class="fas fa-users text-[#1abc9c] text-xl"></i>
                            </div>
                            <div>
                                <p class="text-gray-500 text-sm">Total Penduduk</p>
                                <p class="font-semibold text-[#1abc9c]">8.234 Jiwa</p>
                            </div>
                        </div>

                        <div class="bg-white p-4 rounded-xl shadow border border-gray-100 flex items-center gap-3">
                            <div class="p-3 bg-[#e8f9f5] rounded-lg">
                                <i class="fas fa-home text-[#1abc9c] text-xl"></i>
                            </div>
                            <div>
                                <p class="text-gray-500 text-sm">RT/RW</p>
                                <p class="font-semibold text-[#1abc9c]">45 RT / 12 RW</p>
                            </div>
                        </div>

                        <div class="bg-white p-4 rounded-xl shadow border border-gray-100 flex items-center gap-3">
                            <div class="p-3 bg-[#e8f9f5] rounded-lg">
                                <i class="fas fa-envelope text-[#1abc9c] text-xl"></i>
                            </div>
                            <div>
                                <p class="text-gray-500 text-sm">Kode Pos</p>
                                <p class="font-semibold text-[#1abc9c]">25163</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-4">
                        <a href="#layanan" class="bg-[#1abc9c] text-white px-6 py-3 rounded-lg font-medium shadow hover:bg-[#15967d] transition">
                            Jelajahi Layanan
                        </a>
                        <a href="#peta" class="border border-[#1abc9c] text-[#1abc9c] px-6 py-3 rounded-lg font-medium hover:bg-[#1abc9c] hover:text-white transition">
                            Lihat Peta Wilayah
                        </a>
                    </div>
                </div>

                <div class="md:w-1/2 relative">
                    <img src="{{ asset('images/kelurahan.png') }}"
                         onerror="this.src='https://placehold.co/600x400?text=Kantor+Lurah'"
                         alt="Kantor Kelurahan Cupak Tangah"
                         class="rounded-lg shadow-xl w-full max-w-[600px] h-auto object-cover mx-auto">

                    <div class="absolute bottom-4 right-4 bg-white shadow-lg rounded-lg px-4 py-2 text-center animate-bounce">
                        <p class="text-[#1abc9c] font-bold">24/7</p>
                        <p class="text-sm text-gray-600">Layanan Online</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-[#f7faf7]">
        <div class="max-w-screen-xl mx-auto px-6">

            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900">
                    Terbaru Tentang Cupak Tangah
                </h2>
                <p class="mt-3 text-gray-600 text-lg max-w-2xl mx-auto">
                    Berita dan informasi terkini dari Kelurahan Cupak Tangah
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-12 items-start">
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <img src="{{ asset('images/kelurahan.png') }}"
                         onerror="this.src='https://placehold.co/600x400?text=Kantor+Lurah'"
                         alt="Kantor Kelurahan Cupak Tangah"
                         class="w-full h-60 object-cover">

                    <div class="p-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">
                            Tentang Kelurahan Cupak Tangah
                        </h2>
                        <p class="text-gray-600 leading-relaxed mb-4">
                            Kelurahan Cupak Tangah merupakan salah satu kelurahan yang terletak di Kecamatan Pauh, Kota Padang, Provinsi Sumatera Barat.
                            Kelurahan ini memiliki luas wilayah 5,2 km² dengan jumlah penduduk sebanyak 8.234 jiwa.
                        </p>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            Kelurahan Cupak Tangah terus berupaya meningkatkan kualitas pelayanan publik melalui inovasi digital dan peningkatan kapasitas
                            aparatur kelurahan. Berbagai program pembangunan terus dilakukan untuk menciptakan lingkungan yang nyaman dan sejahtera bagi masyarakat.
                        </p>
                        <a href="#"
                           class="inline-block px-6 py-3 border-2 border-[#4a8a68] text-[#4a8a68] font-semibold rounded-lg
                                  hover:bg-[#4a8a68] hover:text-white transition duration-300">
                            Baca Selengkapnya
                        </a>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="p-5 bg-white rounded-lg shadow-md flex items-start justify-between hover:shadow-lg transition cursor-pointer group">
                        <div>
                            <span class="inline-block bg-gray-100 text-gray-700 text-sm font-medium px-3 py-1 rounded-full mb-2 group-hover:bg-[#e8f9f5] group-hover:text-[#1abc9c] transition">Sosial</span>
                            <h3 class="text-lg font-semibold text-gray-800 group-hover:text-[#1abc9c] transition">Sosialisasi Program Bantuan Sosial Tahun 2025</h3>
                            <p class="text-sm text-gray-500 mt-1">16 September 2025</p>
                        </div>
                        <span class="text-gray-400 group-hover:text-[#1abc9c] group-hover:translate-x-1 transition">→</span>
                    </div>

                    <div class="p-5 bg-white rounded-lg shadow-md flex items-start justify-between hover:shadow-lg transition cursor-pointer group">
                        <div>
                            <span class="inline-block bg-gray-100 text-gray-700 text-sm font-medium px-3 py-1 rounded-full mb-2 group-hover:bg-[#e8f9f5] group-hover:text-[#1abc9c] transition">UMKM</span>
                            <h3 class="text-lg font-semibold text-gray-800 group-hover:text-[#1abc9c] transition">Pelatihan UMKM Digital untuk Warga Cupak Tangah</h3>
                            <p class="text-sm text-gray-500 mt-1">14 September 2025</p>
                        </div>
                        <span class="text-gray-400 group-hover:text-[#1abc9c] group-hover:translate-x-1 transition">→</span>
                    </div>

                    <div class="p-5 bg-white rounded-lg shadow-md flex items-start justify-between hover:shadow-lg transition cursor-pointer group">
                        <div>
                            <span class="inline-block bg-gray-100 text-gray-700 text-sm font-medium px-3 py-1 rounded-full mb-2 group-hover:bg-[#e8f9f5] group-hover:text-[#1abc9c] transition">Kesehatan</span>
                            <h3 class="text-lg font-semibold text-gray-800 group-hover:text-[#1abc9c] transition">Vaksinasi Massal COVID-19 di Balai Kelurahan</h3>
                            <p class="text-sm text-gray-500 mt-1">12 September 2025</p>
                        </div>
                        <span class="text-gray-400 group-hover:text-[#1abc9c] group-hover:translate-x-1 transition">→</span>
                    </div>

                    <div class="p-5 bg-white rounded-lg shadow-md flex items-start justify-between hover:shadow-lg transition cursor-pointer group">
                        <div>
                            <span class="inline-block bg-gray-100 text-gray-700 text-sm font-medium px-3 py-1 rounded-full mb-2 group-hover:bg-[#e8f9f5] group-hover:text-[#1abc9c] transition">Lingkungan</span>
                            <h3 class="text-lg font-semibold text-gray-800 group-hover:text-[#1abc9c] transition">Gotong Royong Bersih-Bersih Lingkungan</h3>
                            <p class="text-sm text-gray-500 mt-1">10 September 2025</p>
                        </div>
                        <span class="text-gray-400 group-hover:text-[#1abc9c] group-hover:translate-x-1 transition">→</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="layanan" class="py-16 bg-white scroll-mt-20">
        <div class="max-w-screen-xl mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-[#4a8a68] mb-4 relative inline-block pb-2 after:absolute after:left-0 after:right-0 after:bottom-0 after:h-1 after:bg-[#88c399] after:mx-auto">Layanan Kami</h2>
                <p class="text-gray-600">Berbagai layanan tersedia untuk memudahkan masyarakat</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-[#e8f4ec] p-6 rounded-lg text-center border-b-4 border-[#88c399] transition-transform hover:transform hover:-translate-y-2 group cursor-pointer">
                    <div class="text-[#66a580] text-4xl mb-4 group-hover:text-[#4a8a68] transition">
                        <i class="fas fa-id-card"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-[#4a8a68] mb-4">Pelayanan Administrasi</h3>
                    <p class="text-gray-600 mb-4">Layanan pengurusan surat menyurat dan administrasi kependudukan</p>
                    <a href="#" class="text-[#66a580] font-semibold hover:text-[#4a8a68] inline-flex items-center">
                        Selengkapnya <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition"></i>
                    </a>
                </div>

                <div class="bg-[#e8f4ec] p-6 rounded-lg text-center border-b-4 border-[#88c399] transition-transform hover:transform hover:-translate-y-2 group cursor-pointer">
                    <div class="text-[#66a580] text-4xl mb-4 group-hover:text-[#4a8a68] transition">
                        <i class="fas fa-hand-holding-heart"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-[#4a8a68] mb-4">Bantuan Sosial</h3>
                    <p class="text-gray-600 mb-4">Informasi dan pengajuan bantuan sosial untuk masyarakat</p>
                    <a href="#" class="text-[#66a580] font-semibold hover:text-[#4a8a68] inline-flex items-center">
                        Selengkapnya <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition"></i>
                    </a>
                </div>

                <div class="bg-[#e8f4ec] p-6 rounded-lg text-center border-b-4 border-[#88c399] transition-transform hover:transform hover:-translate-y-2 group cursor-pointer">
                    <div class="text-[#66a580] text-4xl mb-4 group-hover:text-[#4a8a68] transition">
                        <i class="fas fa-comments"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-[#4a8a68] mb-4">Pengaduan Masyarakat</h3>
                    <p class="text-gray-600 mb-4">Layanan pengaduan dan aspirasi masyarakat</p>
                    <a href="#" class="text-[#66a580] font-semibold hover:text-[#4a8a68] inline-flex items-center">
                        Selengkapnya <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="peta" class="py-16 bg-[#f7faf7] scroll-mt-20">
        <div class="max-w-screen-xl mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-[#4a8a68] mb-4 relative inline-block pb-2 after:absolute after:left-0 after:right-0 after:bottom-0 after:h-1 after:bg-[#88c399] after:mx-auto">Peta Wilayah Kelurahan</h2>
                <p class="text-gray-600">Lihat lokasi dan batas wilayah Kelurahan Cupak Tangah</p>
            </div>
            <div class="rounded-lg overflow-hidden shadow-lg h-96">
                {{-- Pastikan URL Embed Google Maps Valid --}}
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31918.47271881829!2d100.38317769999999!3d-0.91684565!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd4b92476d1326d%3A0x600c920153839257!2sCupak%20Tangah%2C%20Kec.%20Pauh%2C%20Kota%20Padang%2C%20Sumatera%20Barat!5e0!3m2!1sid!2sid!4v1732000000000!5m2!1sid!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </section>

</div>
@endsection
