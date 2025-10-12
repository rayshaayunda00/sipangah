<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel Terkini | Kelurahan Cupak Tangah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.95);
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
            background: linear-gradient(135deg, #0f766e 0%, #0d9488 100%);
            box-shadow: 0 4px 12px rgba(15, 118, 110, 0.3);
            z-index: 2;
        }

        .read-btn {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

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
            background: linear-gradient(135deg, #0f766e 0%, #0d9488 100%);
            color: white;
            transform: translateX(4px);
        }

        .hero-pattern {
            background-image:
                radial-gradient(circle at 20% 80%, rgba(13, 148, 136, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(245, 158, 11, 0.05) 0%, transparent 50%);
        }

        .floating-element {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-12px); }
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

        /* Mobile Optimizations */
        @media (max-width: 768px) {
            .mobile-hero {
                padding-top: 6rem;
                padding-bottom: 4rem;
            }

            .mobile-hero h1 {
                font-size: 2.5rem;
            }

            .mobile-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
        }

        @media (max-width: 640px) {
            .mobile-hero h1 {
                font-size: 2rem;
            }

            .mobile-hero p {
                font-size: 1rem;
            }
        }

        .image-loading {
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        .image-loaded {
            opacity: 1;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 1rem;
            max-width: 400px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    @extends('layouts.app')

    @section('title', 'Artikel Terkini | Kelurahan Cupak Tangah')

    @section('content')
    <!-- Enhanced Hero Section -->
    <div class="relative bg-gradient-to-r from-teal-600 to-teal-800 mobile-hero py-16 md:py-20 overflow-hidden mt-20">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="absolute inset-0 hero-pattern"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <!-- Floating Icon -->
            <div class="floating-element inline-flex items-center justify-center w-16 h-16 md:w-20 md:h-20 bg-white/20 rounded-2xl shadow-lg mb-6 backdrop-blur-sm">
                <i class="fas fa-newspaper text-white text-xl md:text-2xl"></i>
            </div>

            <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-white mb-4 md:mb-6 leading-tight">
                Artikel <span class="text-teal-200">Terkini</span>
            </h1>

            <p class="text-lg md:text-xl text-teal-100 max-w-3xl mx-auto leading-relaxed mb-8">
                Informasi terbaru dan perkembangan terkini dari Kelurahan Cupak Tangah
            </p>

            <!-- Stats Section -->
            <div class="stats-grid mt-8 md:mt-12">
                <div class="glass-card rounded-2xl px-4 py-3 text-center">
                    <div class="text-xl md:text-2xl font-bold text-teal-800 mb-1">{{ $artikels->count() }}</div>
                    <div class="text-xs md:text-sm text-teal-600 font-medium">Total Artikel</div>
                </div>
                <div class="glass-card rounded-2xl px-4 py-3 text-center">
                    <div class="text-xl md:text-2xl font-bold text-teal-800 mb-1">{{ $artikels->sum('jumlah_dibaca') }}</div>
                    <div class="text-xs md:text-sm text-teal-600 font-medium">Total Dibaca</div>
                </div>
            </div>

            <!-- Scroll Indicator -->
            <div class="mt-8 md:mt-10">
                <div class="w-6 h-6 mx-auto text-teal-200 animate-bounce">
                    <i class="fas fa-chevron-down"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
        <!-- Articles Grid -->
        <div class="mobile-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
            @forelse($artikels as $a)
            <div class="glass-card rounded-2xl overflow-hidden card-hover group">
                <!-- Image Container -->
                <div class="relative overflow-hidden image-container">
                    <img src="{{ $a->url_gambar_utama ? asset('storage/'.$a->url_gambar_utama) : 'https://placehold.co/600x400/E5E7EB/6B7280?text=NO+IMAGE' }}"
                         onerror="this.onerror=null;this.src='https://placehold.co/600x400/E5E7EB/6B7280?text=NO+IMAGE';"
                         alt="Gambar Artikel"
                         class="w-full h-48 md:h-52 object-cover transition-transform duration-500 group-hover:scale-110 image-loading">

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

                    <!-- Cuplikan Konten -->
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
                            {{ \Carbon\Carbon::parse($a->tanggal_publikasi)->format('d M Y') }}
                        </div>
                        @endif
                    </div>

                    <!-- Stats & Action -->
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between pt-4 border-t border-gray-100/50 space-y-3 sm:space-y-0">
                        <div class="flex space-x-3 md:space-x-4 text-sm text-gray-500">
                            <div class="flex items-center">
                                <i class="fas fa-eye text-teal-500 mr-1 text-xs"></i>
                                <span class="text-xs">{{ number_format($a->jumlah_dibaca, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-heart text-red-500 mr-1 text-xs"></i>
                                <span class="text-xs">{{ number_format($a->jumlah_suka, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-share text-blue-500 mr-1 text-xs"></i>
                                <span class="text-xs">{{ number_format($a->jumlah_dibagikan, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <a href="{{ route('artikel.public.show', $a->url_seo) }}"
                           class="read-btn inline-flex items-center justify-center text-teal-600 font-semibold text-sm px-3 py-2 rounded-lg bg-teal-50 border border-teal-100 w-full sm:w-auto">
                            Baca <i class="fas fa-arrow-right ml-2 transition-transform duration-300 group-hover:translate-x-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <!-- Enhanced Empty State -->
            <div class="md:col-span-3 text-center py-16">
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
        <div class="mt-8 md:mt-12 flex justify-center">
            {{ $artikels->links() }}
        </div>
        @endif
    </div>

    <script>
        // Image loading animation
        document.addEventListener('DOMContentLoaded', function() {
            const images = document.querySelectorAll('img.image-loading');

            images.forEach(img => {
                img.addEventListener('load', function() {
                    this.classList.remove('image-loading');
                    this.classList.add('image-loaded');
                });

                // Fallback for cached images
                if (img.complete) {
                    img.classList.remove('image-loading');
                    img.classList.add('image-loaded');
                }
            });

            // Add scroll animation for hero section
            const scrollIndicator = document.querySelector('.animate-bounce');
            if (scrollIndicator) {
                scrollIndicator.addEventListener('click', function() {
                    window.scrollTo({
                        top: document.querySelector('.mobile-grid').offsetTop - 100,
                        behavior: 'smooth'
                    });
                });
            }
        });
    </script>
    @endsection
</body>
</html>
