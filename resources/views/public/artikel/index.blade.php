<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel Terkini | Kelurahan Cupak Tangah</title>
    {{-- Memuat Tailwind CSS via CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- Memuat Font Awesome untuk ikon --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        {{-- Mengimpor font Inter dari Google Fonts --}}
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

        {{-- Variabel CSS global untuk tema warna --}}
        :root {
            --primary: #0f766e;
            --primary-light: #0d9488;
            --primary-dark: #115e59;
            --accent: #f59e0b;
            --accent-light: #fbbf24;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-500: #6b7280;
            --gray-700: #374151;
            --gray-900: #111827;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f0fdfa 0%, #f8fafc 50%, #ecfdf5 100%);
            background-attachment: fixed; {{-- Latar belakang tidak ikut scroll --}}
            color: var(--gray-900);
        }

        {{-- Efek "glassmorphism" untuk kartu --}}
        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow:
                0 4px 6px -1px rgba(0, 0, 0, 0.05),
                0 10px 15px -3px rgba(15, 118, 110, 0.08),
                inset 0 1px 0 0 rgba(255, 255, 255, 0.8);
        }

        {{-- Transisi untuk efek hover --}}
        .card-hover {
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        {{-- Efek 'lift-up' dan bayangan saat kartu di-hover --}}
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow:
                0 25px 50px -12px rgba(15, 118, 110, 0.25),
                0 0 0 1px rgba(255, 255, 255, 0.9);
        }

        .image-container {
            position: relative;
            overflow: hidden;
        }

        {{-- Gradien halus di atas gambar saat hover --}}
        .image-container::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 40%;
            background: linear-gradient(to top, rgba(15, 118, 110, 0.3) 0%, transparent 100%);
            opacity: 0;
            transition: opacity 0.4s ease;
            z-index: 1;
        }

        .card-hover:hover .image-container::after {
            opacity: 1;
        }

        {{-- Badge kategori dengan gradien --}}
        .category-badge {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            box-shadow: 0 4px 12px rgba(15, 118, 110, 0.3);
            z-index: 2;
        }

        {{-- Tombol "Baca" --}}
        .read-btn {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        {{-- Efek 'shine' pada tombol --}}
        .read-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.6), transparent);
            transition: left 0.6s ease;
        }

        .read-btn:hover::before {
            left: 100%;
        }

        .read-btn:hover {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white;
            transform: translateX(4px);
        }

        {{-- Pola gradien radial untuk latar belakang hero --}}
        .hero-pattern {
            background-image:
                radial-gradient(circle at 20% 80%, rgba(13, 148, 136, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(245, 158, 11, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(15, 118, 110, 0.06) 0%, transparent 50%);
            background-size: 100% 100%;
        }

        {{-- Animasi 'float' untuk ikon hero --}}
        .floating-element {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-12px); }
        }

        {{-- Layout grid responsif untuk artikel --}}
        .grid-layout {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 2rem;
        }

        @media (max-width: 640px) {
            .grid-layout {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
        }

        {{-- Utility class untuk membatasi teks 2 baris --}}
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        {{-- Utility class untuk membatasi teks 3 baris --}}
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        {{-- Tombol "Muat Lebih Banyak" --}}
        .load-more-btn {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            box-shadow: 0 8px 25px rgba(15, 118, 110, 0.3);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .load-more-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s ease;
        }

        .load-more-btn:hover::before {
            left: 100%;
        }

        .load-more-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(15, 118, 110, 0.4);
        }

        /* Transisi umum */
        .transition-all {
            transition: all 0.3s ease;
        }

        /* Efek hover untuk grup (digunakan pada kartu) */
        .group:hover .group-hover\:scale-110 {
            transform: scale(1.1);
        }
        .group:hover .group-hover\:translate-y-0 {
            transform: translateY(0);
        }
        .group:hover .group-hover\:translate-x-1 {
            transform: translateX(0.25rem);
        }
        .group:hover .group-hover\:text-teal-700 {
            color: var(--primary);
        }
        .group:hover .group-hover\:opacity-100 {
            opacity: 1;
        }

        /* Animasi 'fade-in-up' untuk elemen saat di-scroll */
        .fade-in-up {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s ease;
        }
        .fade-in-up.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Grid untuk statistik di hero */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 1rem;
            max-width: 400px;
            margin: 0 auto;
        }

        /* Penyesuaian font dan padding untuk layar kecil */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            .hero-subtitle {
                font-size: 1.125rem;
            }
        }
        @media (max-width: 640px) {
            .hero-title {
                font-size: 2rem;
            }
            .hero-section {
                padding: 6rem 0 3rem;
            }
        }
    </style>
</head>
<body>
    {{-- Menggunakan layout utama 'layouts.app' --}}
    @extends('layouts.app')

    {{-- Mendefinisikan judul halaman --}}
    @section('title', 'Artikel Terkini | Kelurahan Cupak Tangah')

    {{-- Memulai section konten --}}
    @section('content')
    <div class="min-h-screen">
        <!-- Hero Section -->
        <section class="hero-section hero-pattern pt-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-20 text-center">
                <!-- Ikon mengambang (floating) -->
                <div class="floating-element inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-teal-500 to-teal-700 rounded-2xl shadow-lg mb-6">
                    <i class="fas fa-newspaper text-white text-2xl"></i>
                </div>

                <h1 class="hero-title text-5xl md:text-6xl font-black text-teal-900 mb-4 leading-tight">
                    Artikel <span class="text-teal-600">Terkini</span>
                </h1>

                <p class="hero-subtitle text-xl text-teal-700 mb-8 max-w-3xl mx-auto leading-relaxed">
                    Informasi terbaru dan perkembangan terkini dari Kelurahan Cupak Tangah
                </p>

                <!-- Stats Section -->
                <div class="stats-grid mt-8 md:mt-12">
                    {{-- Kartu stat total artikel --}}
                    <div class="glass-card rounded-2xl px-6 py-4 text-center">
                        <div class="text-2xl font-bold text-teal-800 mb-1">{{ $artikels->count() }}</div>
                        <div class="text-sm text-teal-600 font-medium">Total Artikel</div>
                    </div>
                    {{-- Kartu stat total dibaca --}}
                    <div class="glass-card rounded-2xl px-6 py-4 text-center">
                        <div class="text-2xl font-bold text-teal-800 mb-1">{{ $artikels->sum('jumlah_dibaca') }}</div>
                        <div class="text-sm text-teal-600 font-medium">Total Dibaca</div>
                    </div>
                </div>

                <!-- Indikator Scroll (Panah ke bawah) -->
                <div class="mt-8 md:mt-10">
                    <div class="w-6 h-6 mx-auto text-teal-200 animate-bounce cursor-pointer">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </div>
        </section>

        <!-- Articles Section -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
            <!-- Articles Grid -->
            <div class="grid-layout">
                {{-- Loop melalui setiap artikel, atau tampilkan @empty jika tidak ada --}}
                @forelse($artikels as $a)
                <article class="glass-card rounded-2xl overflow-hidden card-hover group fade-in-up">
                    <!-- Image Container -->
                    <div class="relative overflow-hidden image-container">
                        {{-- Tampilkan gambar utama, atau placeholder jika tidak ada --}}
                        <img src="{{ $a->url_gambar_utama ? asset('storage/'.$a->url_gambar_utama) : 'https://placehold.co/600x400/E5E7EB/6B7280?text=NO+IMAGE' }}"
                             {{-- Fallback jika gambar gagal dimuat --}}
                             onerror="this.onerror=null;this.src='https://placehold.co/600x400/E5E7EB/6B7280?text=NO+IMAGE';"
                             alt="Gambar Artikel"
                             class="w-full h-48 md:h-52 object-cover transition-transform duration-500 group-hover:scale-110">

                        <!-- Category Badge -->
                        <div class="absolute top-4 left-4 flex items-center category-badge text-white text-xs font-semibold px-3 py-1.5 rounded-full">
                            <i class="fas fa-tag mr-1.5"></i>
                            {{ $a->kategori?->nama_kategori ?? 'Umum' }}
                        </div>

                        <!-- Hover Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-teal-900/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end justify-start p-4 md:p-6">
                            <div class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                <span class="text-white text-sm font-medium bg-teal-600/80 px-3 py-1 rounded-full">
                                    Baca Artikel
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="p-4 md:p-6">
                        <!-- Judul Artikel -->
                        <h2 class="text-lg md:text-xl font-bold text-gray-900 mb-3 line-clamp-2 leading-tight group-hover:text-teal-700 transition-colors duration-300">
                            <a href="{{ route('artikel.public.show', $a->url_seo) }}" class="hover:text-teal-600 transition-colors duration-200">
                                {{ $a->judul }}
                            </a>
                        </h2>

                        <!-- Cuplikan Konten (dibatasi 120 karakter) -->
                        <p class="text-gray-600 mb-4 text-sm line-clamp-3 leading-relaxed">
                            {{ Str::limit(strip_tags($a->isi_konten), 120) }}
                        </p>

                        <!-- Author & Date -->
                        <div class="flex flex-col sm:flex-row sm:items-center text-gray-600 mb-3 space-y-1 sm:space-y-0">
                            <div class="flex items-center text-sm">
                                <i class="fas fa-user text-teal-500 mr-2 text-xs"></i>
                                <span class="font-medium text-gray-700">{{ $a->penulis?->nama_penulis ?? 'Anonim' }}</span>
                            </div>
                            @if($a->tanggal_publikasi)
                            <div class="flex items-center text-xs sm:ml-4">
                                <i class="fas fa-calendar text-teal-500 mr-1"></i>
                                {{-- Format tanggal publikasi --}}
                                {{ \Carbon\Carbon::parse($a->tanggal_publikasi)->format('d M Y') }}
                            </div>
                            @endif
                        </div>

                        <!-- Stats & Action -->
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between pt-4 border-t border-gray-100/50 space-y-3 sm:space-y-0">
                            {{-- Statistik (Dilihat, Suka, Dibagikan) --}}
                            <div class="flex space-x-3 md:space-x-4 text-sm text-gray-500">
                                <div class="flex items-center">
                                    <i class="fas fa-eye text-teal-500 mr-1 text-xs"></i>
                                    <span class="text-xs">{{ number_format($a->jumlah_dibaca, 0, ',', '.') }}</span>
                                </div>
                                {{-- <div class="flex items-center">
                                    <i class="fas fa-heart text-red-500 mr-1 text-xs"></i>
                                    <span class="text-xs">{{ number_format($a->jumlah_suka, 0, ',', '.') }}</span>
                                </div> --}}
                                <div class="flex items-center">
                                    <i class="fas fa-share text-blue-500 mr-1 text-xs"></i>
                                    <span class="text-xs">{{ number_format($a->jumlah_dibagikan, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            {{-- Tombol "Baca" --}}
                            <a href="{{ route('artikel.public.show', $a->url_seo) }}"
                               class="read-btn inline-flex items-center justify-center text-teal-600 font-semibold text-sm px-3 py-2 rounded-lg bg-teal-50 border border-teal-100 w-full sm:w-auto">
                                Baca <i class="fas fa-arrow-right ml-2 transition-transform duration-300 group-hover:translate-x-1"></i>
                            </a>
                        </div>
                    </div>
                </article>
                @empty
                <!-- Tampilan jika tidak ada artikel -->
                <div class="col-span-full text-center py-16 fade-in-up">
                    <div class="max-w-md mx-auto">
                        <div class="floating-element inline-flex items-center justify-center w-20 h-20 bg-teal-100 rounded-2xl mb-6">
                            <i class="fas fa-newspaper text-teal-400 text-2xl"></i>
                        </div>
                        <h3 class="text-xl md:text-2xl font-bold text-gray-700 mb-3">Belum ada artikel</h3>
                        <p class="text-gray-500 mb-6">Silakan tambahkan artikel baru melalui panel admin.</p>
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($artikels->count() > 0)
            <div class="mt-8 md:mt-12 flex justify-center fade-in-up">
                {{-- Menampilkan link pagination --}}
                {{ $artikels->links() }}
            </div>
            @endif

            <!-- Tombol "Muat Lebih Banyak" (Opsional, jika menggunakan lazy loading) -->
            @if($artikels->hasMorePages())
            <div class="text-center mt-12">
                <button class="load-more-btn px-8 py-4 text-white font-bold rounded-2xl text-lg">
                    Muat Lebih Banyak Artikel
                    <i class="fas fa-chevron-down ml-3 transition-transform duration-300"></i>
                </button>
            </div>
            @endif
        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animasi elemen saat di-scroll (menggunakan Intersection Observer)
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, observerOptions);

            // Terapkan observer ke semua elemen dengan class 'fade-in-up'
            document.querySelectorAll('.fade-in-up').forEach(element => {
                observer.observe(element);
            });

            // Fungsionalitas klik pada indikator scroll (panah bawah)
            const scrollIndicator = document.querySelector('.animate-bounce');
            if (scrollIndicator) {
                scrollIndicator.addEventListener('click', function() {
                    // Scroll ke grid artikel dengan behavior 'smooth'
                    document.querySelector('.grid-layout').scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                });
            }

            // Animasi fade-in untuk gambar setelah dimuat
            const images = document.querySelectorAll('img');
            images.forEach(img => {
                img.classList.add('opacity-0', 'transition-opacity', 'duration-500');

                img.addEventListener('load', function() {
                    this.classList.remove('opacity-0');
                    this.classList.add('opacity-100');
                });

                // Fallback untuk gambar yang sudah ada di cache
                if (img.complete) {
                    img.classList.remove('opacity-0');
                    img.classList.add('opacity-100');
                }
            });

            // Smooth scroll untuk link anchor (jika ada)
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });
    </script>
    @endsection
</body>
</html>
