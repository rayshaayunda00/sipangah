@extends('layouts.app')

@section('title', $item->nama_item)

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    /* Konsisten dengan tema galeri */
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

    .hero-pattern {
        background-image:
            radial-gradient(circle at 20% 80%, rgba(13, 148, 136, 0.08) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(245, 158, 11, 0.05) 0%, transparent 50%),
            radial-gradient(circle at 40% 40%, rgba(15, 118, 110, 0.06) 0%, transparent 50%);
        background-size: 100% 100%;
    }

    .floating-element {
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-12px); }
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

    /* Responsive Design */
    @media (max-width: 768px) {
        .detail-container {
            padding: 1rem;
        }

        .hero-title {
            font-size: 2rem;
        }

        .stats-grid {
            gap: 1rem;
        }
    }

    @media (max-width: 640px) {
        .detail-container {
            padding: 0.75rem;
        }

        .hero-title {
            font-size: 1.75rem;
        }

        .action-buttons {
            flex-direction: column;
            gap: 0.75rem;
        }

        .action-buttons .btn {
            width: 100%;
            justify-content: center;
        }

        .stats-grid {
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .stats-grid .glass-card {
            min-width: 100px;
            flex: 0 0 calc(33.333% - 0.5rem);
        }
    }

    @media (max-width: 480px) {
        .hero-title {
            font-size: 1.5rem;
        }

        .stats-grid .glass-card {
            padding: 0.75rem 0.5rem;
        }

        .stats-grid .glass-card .text-2xl {
            font-size: 1.25rem;
        }

        .stats-grid .glass-card .text-sm {
            font-size: 0.7rem;
        }
    }
</style>

<div class="min-h-screen pt-20">
    <!-- Hero Section - Konsisten dengan Galeri -->
    <section class="hero-section hero-pattern">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16 text-center">
            <!-- Floating Icon -->
            <div class="floating-element inline-flex items-center justify-center w-16 h-16 md:w-20 md:h-20 bg-gradient-to-br from-teal-500 to-teal-700 rounded-2xl shadow-lg mb-4 md:mb-6">
                <i class="fas fa-store text-white text-xl md:text-2xl"></i>
            </div>

            <h1 class="hero-title text-3xl md:text-4xl lg:text-5xl font-black text-teal-900 mb-3 md:mb-4 leading-tight">
                Detail <span class="text-teal-600">Potensi</span>
            </h1>

            <p class="hero-subtitle text-lg md:text-xl text-teal-700 mb-6 md:mb-8 max-w-2xl mx-auto leading-relaxed">
                Informasi lengkap tentang {{ $item->nama_item }}
            </p>

            {{-- <!-- Stats - Konsisten dengan Galeri -->
            <div class="stats-grid mt-6 md:mt-8">
                <div class="glass-card rounded-xl md:rounded-2xl px-4 py-3 text-center card-hover">
                    <div class="text-xl md:text-2xl font-bold text-teal-800 mb-1">
                        <i class="fas fa-tags text-teal-600"></i>
                    </div>
                    <div class="text-xs md:text-sm text-teal-600 font-medium">Kategori</div>
                </div>
                <div class="glass-card rounded-xl md:rounded-2xl px-4 py-3 text-center card-hover">
                    <div class="text-xl md:text-2xl font-bold text-teal-800 mb-1">
                        <i class="fas fa-map-marker-alt text-teal-600"></i>
                    </div>
                    <div class="text-xs md:text-sm text-teal-600 font-medium">Lokasi</div>
                </div>
                <div class="glass-card rounded-xl md:rounded-2xl px-4 py-3 text-center card-hover">
                    <div class="text-xl md:text-2xl font-bold text-teal-800 mb-1">
                        <i class="fas fa-phone text-teal-600"></i>
                    </div>
                    <div class="text-xs md:text-sm text-teal-600 font-medium">Kontak</div>
                </div>
            </div> --}}
        </div>
    </section>

    <!-- Main Content -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8 detail-container">
        <!-- Main Content Card -->
        <div class="glass-card rounded-2xl md:rounded-3xl overflow-hidden card-hover group fade-in-up">
            <!-- Image Container dengan efek hover galeri -->
            <div class="relative overflow-hidden image-container">
                <img src="{{ $item->url_gambar_utama ? asset('storage/' . $item->url_gambar_utama) : 'https://images.unsplash.com/photo-1563013544-824ae1b704d3?auto=format&fit=crop&w=1200&q=80' }}"
                     alt="{{ $item->nama_item }}"
                     class="w-full h-64 md:h-96 object-cover transition-transform duration-500 group-hover:scale-110">

                <!-- Badge Kategori seperti di galeri -->
                @if($item->subkategori && $item->subkategori->kategori)
                    <div class="absolute top-4 left-4 flex items-center category-badge text-white text-xs md:text-sm font-semibold px-3 md:px-4 py-2 rounded-full">
                        <i class="fas fa-tag mr-2"></i>
                        {{ $item->subkategori->kategori->nama_kategori }}
                    </div>
                @endif

                <!-- Hover Overlay seperti di galeri -->
                <div class="absolute inset-0 bg-gradient-to-t from-teal-900/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end justify-start p-6">
                    <div class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                        <span class="text-white text-sm font-medium bg-teal-600/80 px-3 py-1 rounded-full">
                            Detail Potensi
                        </span>
                    </div>
                </div>
            </div>

            <div class="p-6 md:p-8">
                <!-- Judul Item dengan efek hover -->
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4 md:mb-6 leading-tight group-hover:text-teal-700 transition-colors duration-300">
                    {{ $item->nama_item }}
                </h1>

                <!-- Informasi Detail Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6 md:mb-8">
                    <!-- Kategori & Subkategori -->
                    @if($item->subkategori && $item->subkategori->kategori)
                    <div class="space-y-4">
                        <div class="flex items-center text-gray-700 p-3 rounded-xl bg-gray-50/50 hover:bg-teal-50 transition-colors duration-300">
                            <div class="w-12 h-12 bg-teal-100 rounded-xl flex items-center justify-center mr-4">
                                <i class="fas fa-tags text-teal-600"></i>
                            </div>
                            <div>
                                <div class="text-sm text-gray-500">Kategori</div>
                                <div class="font-semibold text-teal-700">{{ $item->subkategori->kategori->nama_kategori }}</div>
                            </div>
                        </div>
                        <div class="flex items-center text-gray-700 p-3 rounded-xl bg-gray-50/50 hover:bg-teal-50 transition-colors duration-300">
                            <div class="w-12 h-12 bg-teal-100 rounded-xl flex items-center justify-center mr-4">
                                <i class="fas fa-tag text-teal-600"></i>
                            </div>
                            <div>
                                <div class="text-sm text-gray-500">Subkategori</div>
                                <div class="font-semibold text-teal-700">{{ $item->subkategori->nama_subkategori }}</div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Kontak & Lokasi -->
                    <div class="space-y-4">
                        @if ($item->no_hp)
                        <div class="flex items-center text-gray-700 p-3 rounded-xl bg-gray-50/50 hover:bg-green-50 transition-colors duration-300">
                            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mr-4">
                                <i class="fas fa-phone text-green-600"></i>
                            </div>
                            <div>
                                <div class="text-sm text-gray-500">Kontak</div>
                                <div class="font-semibold text-teal-600 text-lg">{{ $item->no_hp }}</div>
                            </div>
                        </div>
                        @endif

                        @if ($item->alamat)
                        <div class="flex items-start text-gray-700 p-3 rounded-xl bg-gray-50/50 hover:bg-blue-50 transition-colors duration-300">
                            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mr-4 mt-1 flex-shrink-0">
                                <i class="fas fa-map-marker-alt text-blue-600"></i>
                            </div>
                            <div>
                                <div class="text-sm text-gray-500">Alamat</div>
                                <div class="font-semibold leading-relaxed text-teal-700">{{ $item->alamat }}</div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Deskripsi Lengkap -->
                <div class="mb-6 md:mb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-file-alt text-teal-600 mr-3"></i>
                        Deskripsi Lengkap
                    </h3>
                    <div class="text-gray-700 leading-relaxed text-lg bg-gray-50/50 p-4 md:p-6 rounded-xl border-l-4 border-teal-500">
                        {!! nl2br(e($item->deskripsi_lengkap ?? $item->deskripsi_singkat)) !!}
                    </div>
                </div>

                <!-- Action Buttons dengan style galeri -->
                <div class="flex flex-col sm:flex-row gap-4 action-buttons pt-6 border-t border-gray-200">
                    @if ($item->no_hp)
                    {{-- <button class="contact-btn inline-flex items-center justify-center text-teal-600 font-semibold text-sm md:text-base px-6 py-3 rounded-xl bg-teal-50 border border-teal-100 shadow-sm">
                        <i class="fas fa-phone mr-2"></i>
                        Hubungi Sekarang
                        <i class="fas fa-arrow-right ml-2 transition-transform duration-300 group-hover:translate-x-1"></i>
                    </button> --}}
                    @endif

                    <a href="{{ route('potensi.public.index') }}"
                       class="load-more-btn inline-flex items-center justify-center text-white font-semibold text-sm md:text-base px-6 py-3 rounded-xl shadow-lg">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali ke Galeri
                    </a>
                </div>
            </div>
        </div>

        <!-- Additional Info Section -->
        <div class="glass-card rounded-2xl p-6 md:p-8 card-hover mt-8 fade-in-up">
            <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                <i class="fas fa-info-circle text-teal-600 mr-3"></i>
                Informasi Tambahan
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-700">
                <div class="flex items-center p-3 rounded-xl bg-gray-50/50 hover:bg-teal-50 transition-colors duration-300">
                    <i class="fas fa-calendar text-teal-500 mr-3 w-5"></i>
                    <span>Terakhir diperbarui: {{ $item->updated_at->format('d M Y') }}</span>
                </div>
                <div class="flex items-center p-3 rounded-xl bg-gray-50/50 hover:bg-teal-50 transition-colors duration-300">
                    <i class="fas fa-map text-teal-500 mr-3 w-5"></i>
                    <span>Lokasi: Kelurahan Cupak Tangah</span>
                </div>
            </div>
        </div>
    </div>
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

        // Contact button animation
        document.querySelectorAll('.contact-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const phoneNumber = '{{ $item->no_hp }}';
                if (phoneNumber) {
                    // Simulate contact action
                    const originalHTML = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-phone mr-2"></i> Memanggil...';
                    this.disabled = true;

                    setTimeout(() => {
                        this.innerHTML = '<i class="fas fa-check mr-2"></i> Terhubung!';
                        setTimeout(() => {
                            this.innerHTML = originalHTML;
                            this.disabled = false;
                        }, 2000);
                    }, 1500);
                }
            });
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

        // Smooth scroll for better user experience
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
