<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Kegiatan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #0f766e;
            --primary-light: #0d9488;
            --accent: #f59e0b;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f0fdfa 0%, #f8fafc 50%, #ecfdf5 100%);
            background-attachment: fixed;
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

        .photo-badge {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            box-shadow: 0 4px 12px rgba(15, 118, 110, 0.3);
            z-index: 2;
        }

        .read-more {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .read-more::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.6), transparent);
            transition: left 0.6s ease;
        }

        .read-more:hover::before {
            left: 100%;
        }

        .read-more:hover {
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

        /* Loading skeleton */
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
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
            color: #0f766e;
        }

        .group:hover .group-hover\:opacity-100 {
            opacity: 1;
        }
    </style>
</head>
<body>
    @extends('layouts.app')

    @section('title', 'Galeri Kegiatan')

    @section('content')
    <div class="pt-20 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <!-- Enhanced Header -->
            <header class="text-center mb-16 hero-pattern py-12 rounded-3xl">
                <div class="max-w-4xl mx-auto">
                    <div class="floating-element inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-teal-500 to-teal-700 rounded-2xl shadow-lg mb-6">
                        <i class="fas fa-images text-white text-2xl"></i>
                    </div>
                    <h1 class="text-5xl md:text-6xl font-black text-teal-900 mb-4 leading-tight">
                        Galeri <span class="text-teal-600">Kegiatan</span>
                    </h1>
                    <p class="text-xl text-teal-700 mb-8 max-w-2xl mx-auto leading-relaxed">
                        Dokumentasi visual dari momen-momen penting dan berkesan di Kelurahan Cupak Tangah
                    </p>

                    {{-- <!-- Stats -->
                    <div class="flex flex-wrap justify-center gap-6 mt-10">
                        <div class="glass-card rounded-2xl px-6 py-4 min-w-[140px] text-center">
                            <div class="text-2xl font-bold text-teal-800 mb-1">{{ count($galeri) }}+</div>
                            <div class="text-sm text-teal-600 font-medium">Kegiatan</div>
                        </div>
                        <div class="glass-card rounded-2xl px-6 py-4 min-w-[140px] text-center">
                            <div class="text-2xl font-bold text-teal-800 mb-1">{{ $totalFoto ?? '350+' }}</div>
                            <div class="text-sm text-teal-600 font-medium">Foto</div>
                        </div>
                        <div class="glass-card rounded-2xl px-6 py-4 min-w-[140px] text-center">
                            <div class="text-2xl font-bold text-teal-800 mb-1">12</div>
                            <div class="text-sm text-teal-600 font-medium">Bulan Aktif</div>
                        </div>
                    </div> --}}
                </div>
            </header>

            {{-- <!-- Filter Section -->
            <div class="mb-12">
                <div class="flex flex-wrap justify-center gap-3">
                    <button class="filter-btn active px-5 py-2.5 rounded-xl font-semibold text-white bg-gradient-to-r from-teal-600 to-teal-800 shadow-lg transition-all duration-300 transform hover:scale-105">
                        Semua Kegiatan
                    </button>
                    <button class="filter-btn px-5 py-2.5 rounded-xl font-semibold text-teal-700 bg-white/80 border border-teal-200 shadow-sm hover:shadow-md transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-star mr-2 text-amber-500"></i>Terpopuler
                    </button>
                    <button class="filter-btn px-5 py-2.5 rounded-xl font-semibold text-teal-700 bg-white/80 border border-teal-200 shadow-sm hover:shadow-md transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-calendar-plus mr-2 text-teal-500"></i>Terbaru
                    </button>
                    <button class="filter-btn px-5 py-2.5 rounded-xl font-semibold text-teal-700 bg-white/80 border border-teal-200 shadow-sm hover:shadow-md transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-users mr-2 text-blue-500"></i>Sosial
                    </button>
                </div>
            </div> --}}

            <!-- Gallery Grid -->
            <div class="grid-layout">
                @foreach($galeri as $item)
                <div class="glass-card rounded-2xl overflow-hidden card-hover group">
                    <!-- Thumbnail dan Badge -->
                    <div class="relative overflow-hidden image-container">
                        <img src="{{ $item->thumbnail_url ? asset('storage/' . $item->thumbnail_url) : 'https://placehold.co/600x400/E5E7EB/6B7280?text=THUMBNAIL' }}"
                             onerror="this.onerror=null;this.src='https://placehold.co/600x400/E5E7EB/6B7280?text=THUMBNAIL';"
                             alt="{{ $item->judul_kegiatan ?? 'Kegiatan' }}"
                             class="w-full h-52 object-cover transition-transform duration-500 group-hover:scale-110">

                        <!-- Badge Jumlah Foto -->
                        @if($item->fotoGaleri->count() > 0)
                        <div class="absolute top-4 right-4 flex items-center photo-badge text-white text-xs font-semibold px-3 py-1.5 rounded-full">
                            <i class="fas fa-camera mr-1.5"></i>
                            {{ $item->fotoGaleri->count() }} Foto
                        </div>
                        @endif

                        <!-- Hover Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-teal-900/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end justify-start p-6">
                            <div class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                {{-- <span class="text-white text-sm font-medium bg-teal-600/80 px-3 py-1 rounded-full">
                                    Lihat Detail
                                </span> --}}
                            </div>
                        </div>
                    </div>

                    <div class="p-6">
                        <!-- Judul Kegiatan -->
                        <h2 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 leading-tight group-hover:text-teal-700 transition-colors duration-300">
                            {{ $item->judul_kegiatan }}
                        </h2>

                        <!-- Deskripsi Singkat -->
                        <p class="text-gray-600 mb-4 text-sm line-clamp-3 leading-relaxed">
                            {{ Str::limit($item->deskripsi_singkat, 100) }}
                        </p>

                        <!-- Tanggal dan Read More -->
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100/50">
                            <span class="text-sm text-gray-500 flex items-center">
                                <i class="far fa-calendar text-teal-500 mr-2"></i>
                                {{ $item->tanggal_kegiatan->format('d M Y') }}
                            </span>
                            <a href="{{ route('galeri.show', $item->id_kegiatan) }}"
                               class="read-more inline-flex items-center text-teal-600 font-semibold text-sm px-3 py-1.5 rounded-lg bg-teal-50 border border-teal-100">
                                Lihat Galeri <i class="fas fa-arrow-right ml-2 transition-transform duration-300 group-hover:translate-x-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Load More Button -->
            <div class="text-center mt-16">
                <button class="load-more-btn px-8 py-4 text-white font-bold rounded-2xl text-lg">
                    Muat Lebih Banyak Kegiatan
                    <i class="fas fa-chevron-down ml-3 transition-transform duration-300 group-hover:translate-y-1"></i>
                </button>

                {{-- <!-- Progress Indicator -->
                <div class="mt-6 text-sm text-teal-600 font-medium">
                    Menampilkan {{ count($galeri) }} dari {{ $totalKegiatan ?? '50' }} kegiatan
                </div> --}}
            </div>
        </div>
    </div>

    <script>
        // Filter button functionality
        document.querySelectorAll('.filter-btn').forEach(button => {
            button.addEventListener('click', function() {
                document.querySelectorAll('.filter-btn').forEach(btn => {
                    btn.classList.remove('active', 'text-white', 'bg-gradient-to-r', 'from-teal-600', 'to-teal-800', 'shadow-lg');
                    btn.classList.add('text-teal-700', 'bg-white/80', 'border', 'border-teal-200', 'shadow-sm');
                });
                this.classList.add('active', 'text-white', 'bg-gradient-to-r', 'from-teal-600', 'to-teal-800', 'shadow-lg');
                this.classList.remove('text-teal-700', 'bg-white/80', 'border', 'border-teal-200', 'shadow-sm');
            });
        });

        // Image loading animation
        document.addEventListener('DOMContentLoaded', function() {
            const images = document.querySelectorAll('img');
            images.forEach(img => {
                // Add loading class initially
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
        });

        // Smooth scroll for anchor links
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
    </script>
    @endsection
</body>
</html>
