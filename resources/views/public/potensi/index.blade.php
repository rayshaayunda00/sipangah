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
    --primary: #2563eb;
    --primary-light: #3b82f6;
    --accent: #f59e0b;
}

body {
    font-family: 'Inter', sans-serif;
    background: linear-gradient(135deg, #f0f9ff 0%, #f8fafc 50%, #eff6ff 100%);
    background-attachment: fixed;
}

.glass-card {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    box-shadow:
        0 4px 6px -1px rgba(0, 0, 0, 0.05),
        0 10px 15px -3px rgba(37, 99, 235, 0.08),
        inset 0 1px 0 0 rgba(255, 255, 255, 0.8);
}

.card-hover {
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.card-hover:hover {
    transform: translateY(-8px);
    box-shadow:
        0 25px 50px -12px rgba(37, 99, 235, 0.25),
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
    background: linear-gradient(to top, rgba(37, 99, 235, 0.3) 0%, transparent 100%);
    opacity: 0;
    transition: opacity 0.4s ease;
    z-index: 1;
}

.card-hover:hover .image-container::after {
    opacity: 1;
}

.photo-badge {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
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
        radial-gradient(circle at 20% 80%, rgba(59, 130, 246, 0.08) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(245, 158, 11, 0.05) 0%, transparent 50%),
        radial-gradient(circle at 40% 40%, rgba(37, 99, 235, 0.06) 0%, transparent 50%);
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
    box-shadow: 0 8px 25px rgba(37, 99, 235, 0.3);
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
    box-shadow: 0 12px 30px rgba(37, 99, 235, 0.4);
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

.group:hover .group-hover\:text-blue-700 {
    color: #1d4ed8;
}

.group:hover .group-hover\:opacity-100 {
    opacity: 1;
}

/* Filter button styles untuk galeri */
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
    box-shadow: 0 8px 25px rgba(37, 99, 235, 0.3);
}

/* Additional styles untuk konsistensi dengan potensi */
.category-badge {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
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

/* Mobile Optimizations tambahan */
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

    .mobile-stats {
        flex-direction: column;
        gap: 1rem;
    }

    .mobile-stats > div {
        min-width: auto;
        width: 100%;
        max-width: 200px;
    }

    .filter-container {
        flex-wrap: wrap;
        gap: 0.5rem;
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

/* Image loading states */
.image-loading {
    opacity: 0;
    transition: opacity 0.5s ease;
}

.image-loaded {
    opacity: 1;
}

/* Stats grid untuk konsistensi */
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

    @section('title', 'Potensi Daerah & UMKM')

    @section('content')
    <div class="pt-20 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <!-- Enhanced Header -->
            <header class="text-center mb-16 hero-pattern py-12 rounded-3xl">
                <div class="max-w-4xl mx-auto">
                    <div class="floating-element inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl shadow-lg mb-6">
                        <i class="fas fa-store text-white text-2xl"></i>
                    </div>
                    <h1 class="text-5xl md:text-6xl font-black text-blue-900 mb-4 leading-tight">
                        Potensi <span class="text-blue-600">Daerah</span>
                    </h1>
                    <p class="text-xl text-blue-700 mb-8 max-w-2xl mx-auto leading-relaxed">
                        Temukan berbagai potensi dan usaha masyarakat sekitar Anda
                    </p>

                    <!-- Stats -->
                    <div class="flex flex-wrap justify-center gap-6 mt-10">
                        <div class="glass-card rounded-2xl px-6 py-4 min-w-[140px] text-center">
                            <div class="text-2xl font-bold text-blue-800 mb-1">{{ $items->count() }}+</div>
                            <div class="text-sm text-blue-600 font-medium">Potensi</div>
                        </div>
                        <div class="glass-card rounded-2xl px-6 py-4 min-w-[140px] text-center">
                            <div class="text-2xl font-bold text-blue-800 mb-1">{{ $kategori->count() }}+</div>
                            <div class="text-sm text-blue-600 font-medium">Kategori</div>
                        </div>
                        <div class="glass-card rounded-2xl px-6 py-4 min-w-[140px] text-center">
                            <div class="text-2xl font-bold text-blue-800 mb-1">100%</div>
                            <div class="text-sm text-blue-600 font-medium">Lokal</div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Filter Section -->
            <div class="mb-12">
                <div class="flex flex-wrap justify-center gap-3">
                    <a href="{{ route('potensi.public.index') }}"
                       class="filter-btn px-5 py-2.5 rounded-xl font-semibold {{ !$kategoriAktif ? 'active-filter text-white' : 'text-blue-700 bg-white/80 border border-blue-200 shadow-sm hover:shadow-md' }} transition-all duration-300">
                        <i class="fas fa-th-large mr-2"></i>Semua Potensi
                    </a>
                    @foreach ($kategori as $kat)
                    <a href="{{ route('potensi.public.index', ['kategori' => $kat->nama_kategori]) }}"
                       class="filter-btn px-5 py-2.5 rounded-xl font-semibold {{ $kategoriAktif == $kat->nama_kategori ? 'active-filter text-white' : 'text-blue-700 bg-white/80 border border-blue-200 shadow-sm hover:shadow-md' }} transition-all duration-300">
                       <i class="fas fa-tag mr-2"></i>{{ $kat->nama_kategori }}
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- Potensi Grid -->
            @if ($items->count() > 0)
            <div class="grid-layout">
                @foreach ($items as $item)
                <div class="glass-card rounded-2xl overflow-hidden card-hover group">
                    <!-- Image Container -->
                    <div class="relative overflow-hidden image-container">
                        <img src="{{ $item->url_gambar_utama ? asset('storage/' . $item->url_gambar_utama) : 'https://images.unsplash.com/photo-1563013544-824ae1b704d3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80' }}"
                             onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1563013544-824ae1b704d3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80';"
                             alt="{{ $item->nama_item }}"
                             class="w-full h-52 object-cover transition-transform duration-500 group-hover:scale-110">

                        <!-- Category Badge -->
                        @if($item->kategori)
                        <div class="absolute top-4 right-4 flex items-center category-badge text-white text-xs font-semibold px-3 py-1.5 rounded-full">
                            <i class="fas fa-tag mr-1.5"></i>
                            {{ $item->kategori->nama_kategori }}
                        </div>
                        @endif

                        <!-- Hover Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-blue-900/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end justify-start p-6">
                            <div class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                <span class="text-white text-sm font-medium bg-blue-600/80 px-3 py-1 rounded-full">
                                    Lihat Detail
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="p-6">
                        <!-- Nama Item -->
                        <h2 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 leading-tight group-hover:text-blue-700 transition-colors duration-300">
                            {{ $item->nama_item }}
                        </h2>

                        <!-- Deskripsi Singkat -->
                        <p class="text-gray-600 mb-4 text-sm line-clamp-3 leading-relaxed">
                            {{ $item->deskripsi_singkat }}
                        </p>

                        <!-- Alamat -->
                        @if ($item->alamat)
                        <div class="flex items-start text-gray-600 mb-3">
                            <i class="fas fa-map-marker-alt text-blue-500 mr-2 mt-0.5 flex-shrink-0"></i>
                            <span class="text-sm line-clamp-2">{{ $item->alamat }}</span>
                        </div>
                        @endif

                        <!-- Contact & Action Buttons -->
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100/50">
                            @if ($item->no_hp)
                            <div class="flex items-center text-blue-600 font-semibold text-sm">
                                <i class="fas fa-phone text-green-500 mr-2"></i>
                                {{ $item->no_hp }}
                            </div>
                            @else
                            <div></div>
                            @endif

                            <div class="flex space-x-2">
                                <button class="contact-btn inline-flex items-center text-blue-600 font-semibold text-sm px-3 py-1.5 rounded-lg bg-blue-50 border border-blue-100">
                                    Hubungi <i class="fas fa-arrow-right ml-2 transition-transform duration-300 group-hover:translate-x-1"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="max-w-md mx-auto">
                    <i class="fas fa-search text-6xl text-blue-300 mb-6"></i>
                    <h3 class="text-2xl font-bold text-gray-700 mb-3">Tidak ada potensi yang ditemukan</h3>
                    <p class="text-gray-500 mb-6">Coba gunakan kategori lain atau lihat semua potensi</p>
                    <a href="{{ route('potensi.public.index') }}"
                       class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-eye mr-2"></i> Lihat Semua Potensi
                    </a>
                </div>
            </div>
            @endif

            <!-- Load More Button -->
            @if ($items->count() > 0)
            <div class="text-center mt-16">
                <button class="filter-btn px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-bold rounded-2xl text-lg shadow-lg hover:shadow-xl transition-all duration-300">
                    Muat Lebih Banyak Potensi
                    <i class="fas fa-chevron-down ml-3 transition-transform duration-300 group-hover:translate-y-1"></i>
                </button>

                <!-- Progress Indicator -->
                <div class="mt-6 text-sm text-blue-600 font-medium">
                    Menampilkan {{ $items->count() }} potensi
                </div>
            </div>
            @endif
        </div>
    </div>

    <script>
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

        // Add floating animation to stats cards
        document.querySelectorAll('.glass-card').forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
        });
    </script>
    @endsection
</body>
</html>
