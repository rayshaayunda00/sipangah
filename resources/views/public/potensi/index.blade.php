<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Potensi Daerah & UMKM</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
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
            background-attachment: fixed;
            color: var(--gray-900);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow:
                0 4px 6px -1px rgba(0, 0, 0, 0.05),
                0 10px 15px -3px rgba(15, 118, 110, 0.08),
                inset 0 1px 0 0 rgba(255, 255, 255, 0.8);
        }

        .card-hover {
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

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

        .category-badge {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            box-shadow: 0 4px 12px rgba(15, 118, 110, 0.3);
            z-index: 2;
        }

        .contact-btn {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .contact-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.6), transparent);
            transition: left 0.6s ease;
        }

        .contact-btn:hover::before {
            left: 100%;
        }

        .contact-btn:hover {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white;
            transform: translateX(4px);
        }

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

        .hero-pattern {
            background-image:
                radial-gradient(circle at 20% 80%, rgba(13, 148, 136, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(245, 158, 11, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(15, 118, 110, 0.06) 0%, transparent 50%);
            background-size: 100% 100%;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

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

        .floating-element {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-12px); }
        }

        /* Filter button styles */
        .filter-btn {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .filter-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s ease;
        }

        .filter-btn:hover::before {
            left: 100%;
        }

        .filter-btn:hover {
            transform: translateY(-2px);
        }

        .active-filter {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white;
            box-shadow: 0 8px 25px rgba(15, 118, 110, 0.3);
        }

        /* Smooth transitions */
        .transition-all {
            transition: all 0.3s ease;
        }

        /* Image hover effects */
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

        /* Animation Classes */
        .fade-in-up {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s ease;
        }

        .fade-in-up.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Stats Grid - MODIFIED FOR HORIZONTAL LAYOUT */
        .stats-grid {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            max-width: 600px;
            margin: 0 auto;
        }

        .stats-grid .glass-card {
            flex: 1;
            min-width: 140px;
            max-width: 180px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.125rem;
            }

            .filter-container {
                flex-wrap: wrap;
                gap: 0.5rem;
            }

            /* Responsive stats layout */
            .stats-grid {
                gap: 1rem;
                max-width: 500px;
            }

            .stats-grid .glass-card {
                min-width: 120px;
            }
        }

        @media (max-width: 640px) {
            .hero-title {
                font-size: 2rem;
            }

            .hero-section {
                padding: 6rem 0 3rem;
            }

            /* Mobile stats layout */
            .stats-grid {
                flex-direction: row;
                flex-wrap: wrap;
                max-width: 400px;
            }

            .stats-grid .glass-card {
                min-width: 110px;
                flex: 0 0 calc(33.333% - 1rem);
            }
        }

        @media (max-width: 480px) {
            .stats-grid {
                gap: 0.75rem;
            }

            .stats-grid .glass-card {
                min-width: 100px;
                flex: 0 0 calc(33.333% - 0.75rem);
                padding: 0.75rem 0.5rem;
            }

            .stats-grid .glass-card .text-2xl {
                font-size: 1.5rem;
            }

            .stats-grid .glass-card .text-sm {
                font-size: 0.75rem;
            }

            /* Search Bar Responsive Fix */
            .search-container {
                width: 100%;
                max-width: 100%;
            }

            @media (min-width: 640px) {
                .search-container {
                    width: 83.333%;
                }
            }

            @media (min-width: 768px) {
                .search-container {
                    width: 66.666%;
                }
            }

            @media (min-width: 1024px) {
                .search-container {
                    width: 50%;
                }
            }

            /* Search Input Responsive */
            .search-input {
                width: 100%;
                padding: 0.75rem 1rem;
                font-size: 0.875rem;
                border-radius: 0.75rem;
            }

            @media (min-width: 768px) {
                .search-input {
                    padding: 1rem 1.25rem;
                    font-size: 1rem;
                    border-radius: 1rem;
                }
            }

            /* Filter Buttons Responsive */
            .filter-btn {
                padding: 0.5rem 0.75rem;
                font-size: 0.75rem;
                border-radius: 0.5rem;
                flex: 1;
                min-width: fit-content;
                text-align: center;
            }

            @media (min-width: 768px) {
                .filter-btn {
                    padding: 0.625rem 1.25rem;
                    font-size: 0.875rem;
                    border-radius: 0.75rem;
                    flex: none;
                }
            }

            @media (max-width: 480px) {
                .filter-btn {
                    flex: 0 0 calc(50% - 0.25rem);
                    font-size: 0.7rem;
                    padding: 0.5rem 0.375rem;
                }

                .filter-btn i {
                    margin-right: 0.25rem;
                }
            }

            @media (max-width: 360px) {
                .filter-btn {
                    flex: 0 0 100%;
                    font-size: 0.65rem;
                }
            }
        }
    </style>
</head>
<body>
   @extends('layouts.app')

@section('title', 'Potensi Daerah & UMKM')

@section('content')
<div class="min-h-screen">

    <!-- Hero Section -->
    <section class="hero-section hero-pattern pt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-20 text-center">
            <!-- Floating Icon -->
            <div class="floating-element inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-teal-500 to-teal-700 rounded-2xl shadow-lg mb-6">
                <i class="fas fa-store text-white text-2xl"></i>
            </div>

            <h1 class="hero-title text-5xl md:text-6xl font-black text-teal-900 mb-4 leading-tight">
                Potensi <span class="text-teal-600">Daerah</span>
            </h1>

            <p class="hero-subtitle text-xl text-teal-700 mb-8 max-w-2xl mx-auto leading-relaxed">
                Temukan berbagai potensi dan usaha masyarakat sekitar Anda
            </p>

            <!-- Stats -->
            <div class="stats-grid mt-8 md:mt-12">
                <div class="glass-card rounded-2xl px-6 py-4 text-center">
                    <div class="text-2xl font-bold text-teal-800 mb-1">{{ $items->count() }}</div>
                    <div class="text-sm text-teal-600 font-medium">Potensi</div>
                </div>
                <div class="glass-card rounded-2xl px-6 py-4 text-center">
                    <div class="text-2xl font-bold text-teal-800 mb-1">{{ $kategori->count() }}</div>
                    <div class="text-sm text-teal-600 font-medium">Kategori</div>
                </div>
                <div class="glass-card rounded-2xl px-6 py-4 text-center">
                    <div class="text-2xl font-bold text-teal-800 mb-1">100%</div>
                    <div class="text-sm text-teal-600 font-medium">Lokal</div>
                </div>
            </div>
        </div>
    </section>

   <!-- 🔍 Search & Filter Section -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-12 fade-in-up">

    <!-- Search Bar -->
    <form action="{{ route('potensi.public.index') }}" method="GET" class="flex justify-center mb-6">
        <div class="relative w-full sm:w-11/12 md:w-3/4 lg:w-2/3 xl:w-1/2">
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Cari potensi berdasarkan judul atau deskripsi..."
                   class="search-input w-full px-5 py-3 rounded-2xl shadow-sm border border-teal-200 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 placeholder-gray-400 text-sm sm:text-base">
            <!-- Ikon search telah dihapus sesuai permintaan -->
        </div>
    </form>

    <!-- Pertahankan kategori saat search -->
    @if(request('kategori'))
        <input type="hidden" name="kategori" value="{{ request('kategori') }}">
    @endif

    <!-- Tombol Filter Kategori -->
    <div class="flex flex-wrap justify-center gap-3 filter-container">
        <a href="{{ route('potensi.public.index', ['search' => request('search')]) }}"
           class="filter-btn px-5 py-2.5 rounded-xl font-semibold {{ !$kategoriAktif ? 'active-filter text-white bg-teal-600' : 'text-teal-700 bg-white/80 border border-teal-200 shadow-sm hover:shadow-md' }}">
            <i class="fas fa-th-large mr-2"></i>Semua Potensi
        </a>

        @foreach ($kategori as $kat)
        <a href="{{ route('potensi.public.index', ['kategori' => $kat->nama_kategori, 'search' => request('search')]) }}"
           class="filter-btn px-5 py-2.5 rounded-xl font-semibold {{ $kategoriAktif == $kat->nama_kategori ? 'active-filter text-white bg-teal-600' : 'text-teal-700 bg-white/80 border border-teal-200 shadow-sm hover:shadow-md' }}">
           <i class="fas fa-tag mr-2"></i>{{ $kat->nama_kategori }}
        </a>
        @endforeach
    </div>
</section>

    <!-- Potensi Grid -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
    @if ($items->count() > 0)
    <div class="grid-layout">
        @foreach ($items as $item)
        <div class="glass-card rounded-2xl overflow-hidden card-hover group fade-in-up">
            <!-- Image Container -->
            <div class="relative overflow-hidden image-container">
                <img src="{{ $item->url_gambar_utama ? asset('storage/' . $item->url_gambar_utama) : 'https://images.unsplash.com/photo-1563013544-824ae1b704d3?auto=format&fit=crop&w=800&q=80' }}"
                     alt="{{ $item->nama_item }}"
                     class="w-full h-52 object-cover transition-transform duration-500 group-hover:scale-110">

                {{-- Badge kategori --}}
                @if($item->subkategori && $item->subkategori->kategori)
                    <div class="absolute bottom-4 left-4 flex items-center bg-white/90 text-teal-700 text-xs font-semibold px-3 py-1.5 rounded-full shadow-md">
                        <i class="fas fa-tag mr-1.5"></i>
                        {{ $item->subkategori->kategori->nama_kategori }}
                    </div>
                @endif
            </div>

            <div class="p-4 md:p-6">
                <!-- Nama Item -->
                <h2 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 leading-tight group-hover:text-teal-700 transition-colors duration-300">
                    {{ $item->nama_item }}
                </h2>

                <!-- Deskripsi Singkat -->
                <p class="text-gray-600 mb-4 text-sm line-clamp-3 leading-relaxed">
                    {{ $item->deskripsi_singkat }}
                </p>

                <!-- Alamat -->
                @if ($item->alamat)
                <div class="flex items-start text-gray-600 mb-3">
                    <i class="fas fa-map-marker-alt text-teal-500 mr-2 mt-0.5 flex-shrink-0"></i>
                    <span class="text-sm line-clamp-2">{{ $item->alamat }}</span>
                </div>
                @endif

                <!-- Contact & Action Buttons -->
                <div class="flex items-center justify-between pt-4 border-t border-gray-100/50">
                    @if ($item->no_hp)
                    <div class="flex items-center text-teal-600 font-semibold text-sm">
                        <i class="fas fa-phone text-green-500 mr-2"></i>
                        {{ $item->no_hp }}
                    </div>
                    @else
                    <div></div>
                    @endif

                    <div class="flex space-x-2">
                        <!-- Tombol Hubungi -->
                        <button class="contact-btn inline-flex items-center text-teal-600 font-semibold text-sm px-3 py-1.5 rounded-lg bg-teal-50 border border-teal-100">
                            Hubungi <i class="fas fa-arrow-right ml-2 transition-transform duration-300 group-hover:translate-x-1"></i>
                        </button>

                        <!-- Tombol Lihat Detail -->
                        <a href="{{ route('public.potensi.show', $item) }}"
   class="inline-flex items-center text-white bg-teal-600 px-3 py-1.5 rounded-lg font-semibold shadow hover:bg-teal-700 transition">
    Lihat Detail <i class="fas fa-eye ml-2"></i>
</a>

                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <!-- Empty State -->
    <div class="text-center py-16 fade-in-up">
        <div class="max-w-md mx-auto">
            <div class="floating-element inline-flex items-center justify-center w-20 h-20 bg-teal-100 rounded-2xl mb-6">
                <i class="fas fa-search text-teal-400 text-2xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-700 mb-3">Tidak ada potensi yang ditemukan</h3>
            <p class="text-gray-500 mb-6">Coba gunakan kategori lain atau lihat semua potensi</p>
            <a href="{{ route('potensi.public.index') }}"
               class="load-more-btn inline-flex items-center px-6 py-3 text-white font-semibold rounded-xl">
                <i class="fas fa-eye mr-2"></i> Lihat Semua Potensi
            </a>
        </div>
    </div>
    @endif

    <!-- Load More Button -->
    @if ($items->count() > 0)
    <div class="text-center mt-16 fade-in-up">
        <button class="load-more-btn px-8 py-4 text-white font-bold rounded-2xl text-lg">
            Muat Lebih Banyak Potensi
            <i class="fas fa-chevron-down ml-3 transition-transform duration-300"></i>
        </button>

        <div class="mt-6 text-sm text-teal-600 font-medium">
            Menampilkan {{ $items->count() }} potensi
        </div>
    </div>
    @endif
</section>

</div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animate elements on scroll
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

            // Observe all fade-in-up elements
            document.querySelectorAll('.fade-in-up').forEach(element => {
                observer.observe(element);
            });

            // Image loading animation
            const images = document.querySelectorAll('img');
            images.forEach(img => {
                img.classList.add('opacity-0', 'transition-opacity', 'duration-500');

                img.addEventListener('load', function() {
                    this.classList.remove('opacity-0');
                    this.classList.add('opacity-100');
                });

                // Fallback for cached images
                if (img.complete) {
                    img.classList.remove('opacity-0');
                    img.classList.add('opacity-100');
                }
            });

            // Add click animation to contact buttons
            document.querySelectorAll('.contact-btn').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const phoneNumber = this.closest('.glass-card').querySelector('.fa-phone')?.nextSibling?.textContent?.trim();
                    if (phoneNumber) {
                        // Simulate contact action
                        this.innerHTML = '<i class="fas fa-phone mr-2"></i> Memanggil...';
                        setTimeout(() => {
                            this.innerHTML = '<i class="fas fa-check mr-2"></i> Terhubung <i class="fas fa-arrow-right ml-2"></i>';
                        }, 1000);
                    }
                });
            });

            // Smooth scroll for navigation
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
