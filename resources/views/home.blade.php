<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Sipangah - Kelurahan Cupak Tangah</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Tailwind -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Font Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>
<body class="bg-gray-50 text-gray-800">

  <!-- Navbar -->
  <header class="bg-white shadow sticky top-0 z-50">
    <div class="max-w-screen-xl mx-auto flex items-center justify-between py-4 px-6">
      <div class="flex items-center space-x-2">
        <div class="bg-[#1abc9c] text-white font-bold p-2 rounded">CT</div>
        <div>
          <h1 class="font-bold">Sipangah</h1>
          <p class="text-sm text-gray-500">Cupak Tangah</p>
        </div>
      </div>
      <nav class="hidden md:flex space-x-6 font-medium">
        <a href="/" class="text-[#1abc9c] hover:text-[#15967d]">Beranda</a>
        <a href="#berita" class="hover:text-[#15967d]">Berita</a>
        <a href="#layanan" class="hover:text-[#15967d]">Layanan</a>
        <a href="#galeri" class="hover:text-[#15967d]">Galeri</a>
        <a href="#potensi" class="hover:text-[#15967d]">Potensi</a>
        <a href="#tentang" class="hover:text-[#15967d]">Tentang</a>
      </nav>
      <a href="/login" class="bg-[#1abc9c] text-white px-4 py-2 rounded-lg hover:bg-[#15967d]">
        Masuk
      </a>
    </div>
  </header>

  <!-- Hero Section -->
  <section class="bg-[#f0fdf4] py-16">
    <div class="max-w-screen-xl mx-auto px-6">
      <div class="flex flex-col md:flex-row items-center gap-10">

        <!-- Left Content -->
        <div class="md:w-1/2">
          <h1 class="text-4xl md:text-5xl font-bold leading-snug mb-4">
            Kelurahan <span class="text-[#1abc9c]">Cupak Tangah</span>
          </h1>
          <p class="text-gray-600 mb-6">
            Selamat datang di portal digital Kelurahan Cupak Tangah.
            Kami hadir untuk memberikan pelayanan terbaik kepada masyarakat
            dengan sistem informasi yang modern dan terintegrasi.
          </p>

          <!-- Grid Info -->
<div class="grid grid-cols-2 gap-4 mb-6">
  <!-- Lokasi -->
  <div class="bg-white p-4 rounded-xl shadow border border-gray-100 flex items-center gap-3">
    <!-- Icon -->
    <div class="p-3 bg-[#e8f9f5] rounded-lg">
      <!-- Heroicon: Map Pin -->
      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-[#1abc9c]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c1.657 0 3-1.343 3-3S13.657 5 12 5 9 6.343 9 8s1.343 3 3 3z"/>
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 22s8-7.582 8-14a8 8 0 10-16 0c0 6.418 8 14 8 14z"/>
      </svg>
    </div>
    <!-- Text -->
    <div>
      <p class="text-gray-500 text-sm">Lokasi</p>
      <p class="font-semibold text-[#1abc9c]">Kec. Pauh, Padang</p>
    </div>
  </div>

  <!-- Total Penduduk -->
  <div class="bg-white p-4 rounded-xl shadow border border-gray-100 flex items-center gap-3">
    <div class="p-3 bg-[#e8f9f5] rounded-lg">
      <!-- Heroicon: Users -->
      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-[#1abc9c]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M12 12a4 4 0 100-8 4 4 0 000 8z"/>
      </svg>
    </div>
    <div>
      <p class="text-gray-500 text-sm">Total Penduduk</p>
      <p class="font-semibold text-[#1abc9c]">8.234 Jiwa</p>
    </div>
  </div>

  <!-- RT/RW -->
  <div class="bg-white p-4 rounded-xl shadow border border-gray-100 flex items-center gap-3">
    <div class="p-3 bg-[#e8f9f5] rounded-lg">
      <!-- Heroicon: Home -->
      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-[#1abc9c]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9.75L12 4l9 5.75M4 10v10h16V10"/>
      </svg>
    </div>
    <div>
      <p class="text-gray-500 text-sm">RT/RW</p>
      <p class="font-semibold text-[#1abc9c]">45 RT / 12 RW</p>
    </div>
  </div>

  <!-- Kode Pos -->
  <div class="bg-white p-4 rounded-xl shadow border border-gray-100 flex items-center gap-3">
    <div class="p-3 bg-[#e8f9f5] rounded-lg">
      <!-- Heroicon: Mail -->
      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-[#1abc9c]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
      </svg>
    </div>
    <div>
      <p class="text-gray-500 text-sm">Kode Pos</p>
      <p class="font-semibold text-[#1abc9c]">25163</p>
    </div>
  </div>
</div>


          <!-- Buttons -->
          <div class="flex gap-4">
            <a href="#layanan" class="bg-[#1abc9c] text-white px-6 py-3 rounded-lg font-medium shadow hover:bg-[#15967d] transition">
              Jelajahi Layanan
            </a>
            <a href="#peta" class="border border-[#1abc9c] text-[#1abc9c] px-6 py-3 rounded-lg font-medium hover:bg-[#1abc9c] hover:text-white transition">
              Lihat Peta Wilayah
            </a>
          </div>
        </div>

        <!-- Right Image -->
        <div class="md:w-1/2 relative">
          <img src="{{ asset('images/kelurahan.png') }}"
               alt="Kantor Kelurahan Cupak Tangah"
               class="rounded-lg shadow-xl w-[600px] h-[400px] object-cover mx-auto">

          <!-- Badge -->
          <div class="absolute bottom-4 right-4 bg-white shadow-lg rounded-lg px-4 py-2 text-center">
            <p class="text-[#1abc9c] font-bold">24/7</p>
            <p class="text-sm text-gray-600">Layanan Online</p>
          </div>
        </div>
      </div>
    </div>
  </section>

<!-- Info Section -->
<section class="py-20 bg-[#f7faf7]">
  <div class="max-w-screen-xl mx-auto px-6">

    <!-- Judul Atas -->
    <div class="text-center mb-12">
      <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900">
        Terbaru Tentang Cupak Tangah
      </h2>
      <p class="mt-3 text-gray-600 text-lg max-w-2xl mx-auto">
        Berita dan informasi terkini dari Kelurahan Cupak Tangah
      </p>
    </div>

    <div class="grid md:grid-cols-2 gap-12 items-start">
      <!-- Kolom Kiri: Tentang Kelurahan -->
      <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <!-- Gambar Header -->
        <img src="{{ asset('images/kelurahan.png') }}"
             alt="Kantor Kelurahan Cupak Tangah"
             class="w-full h-60 object-cover">

        <!-- Isi Card -->
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

      <!-- Kolom Kanan: Kategori Info -->
      <div class="space-y-4">
        <!-- Sosial -->
        <div class="p-5 bg-white rounded-lg shadow-md flex items-start justify-between hover:shadow-lg transition">
          <div>
            <span class="inline-block bg-gray-100 text-gray-700 text-sm font-medium px-3 py-1 rounded-full mb-2">Sosial</span>
            <h3 class="text-lg font-semibold text-gray-800">Sosialisasi Program Bantuan Sosial Tahun 2025</h3>
            <p class="text-sm text-gray-500 mt-1">16 September 2025</p>
          </div>
          <span class="text-gray-400">&rarr;</span>
        </div>

        <!-- UMKM -->
        <div class="p-5 bg-white rounded-lg shadow-md flex items-start justify-between hover:shadow-lg transition">
          <div>
            <span class="inline-block bg-gray-100 text-gray-700 text-sm font-medium px-3 py-1 rounded-full mb-2">UMKM</span>
            <h3 class="text-lg font-semibold text-gray-800">Pelatihan UMKM Digital untuk Warga Cupak Tangah</h3>
            <p class="text-sm text-gray-500 mt-1">14 September 2025</p>
          </div>
          <span class="text-gray-400">&rarr;</span>
        </div>

        <!-- Kesehatan -->
        <div class="p-5 bg-white rounded-lg shadow-md flex items-start justify-between hover:shadow-lg transition">
          <div>
            <span class="inline-block bg-gray-100 text-gray-700 text-sm font-medium px-3 py-1 rounded-full mb-2">Kesehatan</span>
            <h3 class="text-lg font-semibold text-gray-800">Vaksinasi Massal COVID-19 di Balai Kelurahan</h3>
            <p class="text-sm text-gray-500 mt-1">12 September 2025</p>
          </div>
          <span class="text-gray-400">&rarr;</span>
        </div>

        <!-- Lingkungan -->
        <div class="p-5 bg-white rounded-lg shadow-md flex items-start justify-between hover:shadow-lg transition">
          <div>
            <span class="inline-block bg-gray-100 text-gray-700 text-sm font-medium px-3 py-1 rounded-full mb-2">Lingkungan</span>
            <h3 class="text-lg font-semibold text-gray-800">Gotong Royong Bersih-Bersih Lingkungan</h3>
            <p class="text-sm text-gray-500 mt-1">10 September 2025</p>
          </div>
          <span class="text-gray-400">&rarr;</span>
        </div>
      </div>
    </div>
  </div>
</section>



  <!-- Services Section -->
  <section id="layanan" class="py-16 bg-white">
    <div class="max-w-screen-xl mx-auto px-6">
      <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-[#4a8a68] mb-4 relative inline-block pb-2 after:absolute after:left-0 after:right-0 after:bottom-0 after:h-1 after:bg-[#88c399] after:mx-auto">Layanan Kami</h2>
        <p class="text-gray-600">Berbagai layanan tersedia untuk memudahkan masyarakat</p>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-[#e8f4ec] p-6 rounded-lg text-center border-b-4 border-[#88c399] transition-transform hover:transform hover:-translate-y-2">
          <div class="text-[#66a580] text-4xl mb-4">
            <i class="fas fa-id-card"></i>
          </div>
          <h3 class="text-xl font-semibold text-[#4a8a68] mb-4">Pelayanan Administrasi</h3>
          <p class="text-gray-600 mb-4">Layanan pengurusan surat menyurat dan administrasi kependudukan</p>
          <a href="#" class="text-[#66a580] font-semibold hover:text-[#4a8a68] inline-flex items-center">
            Selengkapnya <i class="fas fa-arrow-right ml-2"></i>
          </a>
        </div>
        <div class="bg-[#e8f4ec] p-6 rounded-lg text-center border-b-4 border-[#88c399] transition-transform hover:transform hover:-translate-y-2">
          <div class="text-[#66a580] text-4xl mb-4">
            <i class="fas fa-hand-holding-heart"></i>
          </div>
          <h3 class="text-xl font-semibold text-[#4a8a68] mb-4">Bantuan Sosial</h3>
          <p class="text-gray-600 mb-4">Informasi dan pengajuan bantuan sosial untuk masyarakat</p>
          <a href="#" class="text-[#66a580] font-semibold hover:text-[#4a8a68] inline-flex items-center">
            Selengkapnya <i class="fas fa-arrow-right ml-2"></i>
          </a>
        </div>
        <div class="bg-[#e8f4ec] p-6 rounded-lg text-center border-b-4 border-[#88c399] transition-transform hover:transform hover:-translate-y-2">
          <div class="text-[#66a580] text-4xl mb-4">
            <i class="fas fa-comments"></i>
          </div>
          <h3 class="text-xl font-semibold text-[#4a8a68] mb-4">Pengaduan Masyarakat</h3>
          <p class="text-gray-600 mb-4">Layanan pengaduan dan aspirasi masyarakat</p>
          <a href="#" class="text-[#66a580] font-semibold hover:text-[#4a8a68] inline-flex items-center">
            Selengkapnya <i class="fas fa-arrow-right ml-2"></i>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- Map Section -->
  <section id="peta" class="py-16 bg-[#f7faf7]">
    <div class="max-w-screen-xl mx-auto px-6">
      <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-[#4a8a68] mb-4 relative inline-block pb-2 after:absolute after:left-0 after:right-0 after:bottom-0 after:h-1 after:bg-[#88c399] after:mx-auto">Peta Wilayah Kelurahan</h2>
        <p class="text-gray-600">Lihat lokasi dan batas wilayah Kelurahan Cupak Tangah</p>
      </div>
      <div class="rounded-lg overflow-hidden shadow-lg h-96">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127672.70037636668!2d100.3013403972656!3d-0.9540000000000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd4b942e2b117bb%3A0xb8468cb5c3046ba5!2sPadang%2C%20Kota%20Padang%2C%20Sumatera%20Barat!5e0!3m2!1sid!2sid!4v1684838953783!5m2!1sid!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-gray-800 text-white pt-16 pb-8">
    <div class="max-w-screen-xl mx-auto px-6">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
        <div>
          <h3 class="text-xl font-semibold mb-6 relative pb-2 after:absolute after:left-0 after:bottom-0 after:h-1 after:w-10 after:bg-[#88c399]">Kelurahan Cupak Tangah</h3>
          <p class="text-gray-300 mb-6">Kec. Pauh, Kota Padang, Provinsi Sumatera Barat. Telah hadir untuk memberikan pelayanan terbaik bagi masyarakat.</p>
          <div class="flex space-x-4">
            <a href="#" class="bg-gray-700 w-10 h-10 rounded-full flex items-center justify-center hover:bg-[#88c399]">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="bg-gray-700 w-10 h-10 rounded-full flex items-center justify-center hover:bg-[#88c399]">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="bg-gray-700 w-10 h-10 rounded-full flex items-center justify-center hover:bg-[#88c399]">
              <i class="fab fa-instagram"></i>
            </a>
            <a href="#" class="bg-gray-700 w-10 h-10 rounded-full flex items-center justify-center hover:bg-[#88c399]">
              <i class="fab fa-youtube"></i>
            </a>
          </div>
        </div>
        <div>
          <h3 class="text-xl font-semibold mb-6 relative pb-2 after:absolute after:left-0 after:bottom-0 after:h-1 after:w-10 after:bg-[#88c399]">Menu Cepat</h3>
          <ul class="space-y-3">
            <li><a href="#" class="text-gray-300 hover:text-white">Beranda</a></li>
            <li><a href="#" class="text-gray-300 hover:text-white">Profil Kelurahan</a></li>
            <li><a href="#" class="text-gray-300 hover:text-white">Layanan</a></li>
            <li><a href="#" class="text-gray-300 hover:text-white">Berita</a></li>
            <li><a href="#" class="text-gray-300 hover:text-white">Galeri</a></li>
          </ul>
        </div>
        <div>
          <h3 class="text-xl font-semibold mb-6 relative pb-2 after:absolute after:left-0 after:bottom-0 after:h-1 after:w-10 after:bg-[#88c399]">Layanan</h3>
          <ul class="space-y-3">
            <li><a href="#" class="text-gray-300 hover:text-white">Administrasi Kependudukan</a></li>
            <li><a href="#" class="text-gray-300 hover:text-white">Pengurusan Surat</a></li>
            <li><a href="#" class="text-gray-300 hover:text-white">Bantuan Sosial</a></li>
            <li><a href="#" class="text-gray-300 hover:text-white">Pengaduan Masyarakat</a></li>
          </ul>
        </div>
        <div>
          <h3 class="text-xl font-semibold mb-6 relative pb-2 after:absolute after:left-0 after:bottom-0 after:h-1 after:w-10 after:bg-[#88c399]">Kontak</h3>
          <ul class="space-y-4">
            <li class="flex items-start">
              <i class="fas fa-map-marker-alt text-[#88c399] mt-1 mr-3"></i>
              <span class="text-gray-300">Jl. Cupak Tangah No. 123, Kec. Pauh, Padang</span>
            </li>
            <li class="flex items-start">
              <i class="fas fa-phone text-[#88c399] mt-1 mr-3"></i>
              <span class="text-gray-300">(0751) 123456</span>
            </li>
            <li class="flex items-start">
              <i class="fas fa-envelope text-[#88c399] mt-1 mr-3"></i>
              <span class="text-gray-300">info@cupaktangah.padang.go.id</span>
            </li>
            <li class="flex items-start">
              <i class="fas fa-clock text-[#88c399] mt-1 mr-3"></i>
              <span class="text-gray-300">Senin - Jumat: 08:00 - 16:00 WIB</span>
            </li>
          </ul>
        </div>
      </div>
      <div class="border-t border-gray-700 pt-8 text-center text-gray-400">
        <p>&copy; 2023 Kelurahan Cupak Tangah - Kec. Pauh, Padang. All rights reserved.</p>
      </div>
    </div>
  </footer>

</body>
</html>
