@extends('layouts.app')

@section('title', 'Galeri Kegiatan')

{{-- 1. CSS & FONTS --}}
@push('styles')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #0f766e;
            --primary-light: #0d9488;
            --primary-dark: #115e59;
            --accent: #f59e0b;
            --accent-light: #fbbf24;
        }

        .page-bg {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f0fdfa 0%, #f8fafc 50%, #ecfdf5 100%);
            background-attachment: fixed;
            color: #111827;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05),
                        0 10px 15px -3px rgba(15, 118, 110, 0.08),
                        inset 0 1px 0 0 rgba(255, 255, 255, 0.8);
        }

        .card-hover { transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1); }
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(15, 118, 110, 0.25), 0 0 0 1px rgba(255, 255, 255, 0.9);
        }

        .image-container { position: relative; overflow: hidden; }
        .image-container::after {
            content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 40%;
            background: linear-gradient(to top, rgba(15, 118, 110, 0.3) 0%, transparent 100%);
            opacity: 0; transition: opacity 0.4s ease; z-index: 1;
        }
        .card-hover:hover .image-container::after { opacity: 1; }

        .photo-badge {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            box-shadow: 0 4px 12px rgba(15, 118, 110, 0.3);
            z-index: 2;
        }

        .read-more { position: relative; overflow: hidden; transition: all 0.3s ease; }
        .read-more:hover {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white; transform: translateX(4px);
        }

        .grid-layout {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 2rem;
        }
        @media (max-width: 640px) {
            .grid-layout { grid-template-columns: 1fr; gap: 1.5rem; }
        }

        .hero-pattern {
            background-image: radial-gradient(circle at 20% 80%, rgba(13, 148, 136, 0.08) 0%, transparent 50%),
                              radial-gradient(circle at 80% 20%, rgba(245, 158, 11, 0.05) 0%, transparent 50%),
                              radial-gradient(circle at 40% 40%, rgba(15, 118, 110, 0.06) 0%, transparent 50%);
            background-size: 100% 100%;
        }

        .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .line-clamp-3 { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }

        .floating-element { animation: float 6s ease-in-out infinite; }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-12px); }
        }

        .stats-grid {
            display: flex; justify-content: center; gap: 1.5rem; max-width: 600px; margin: 0 auto;
        }
        .stats-grid .glass-card { flex: 1; min-width: 140px; max-width: 180px; }
        @media (max-width: 640px) {
            .stats-grid { flex-direction: row; flex-wrap: wrap; max-width: 400px; }
            .stats-grid .glass-card { min-width: 110px; flex: 0 0 calc(33.333% - 1rem); }
        }

        /* === ANIMASI SCROLL === */
        .fade-in-up { opacity: 0; transform: translateY(30px); transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1); }
        .fade-in-up.visible { opacity: 1; transform: translateY(0); }

        /* Group Hover Utils */
        .group:hover .group-hover\:scale-110 { transform: scale(1.1); }
        .group:hover .group-hover\:translate-y-0 { transform: translateY(0); }
        .group:hover .group-hover\:text-teal-700 { color: #0f766e; }
        .group:hover .group-hover\:opacity-100 { opacity: 1; }
    </style>
@endpush

{{-- 2. KONTEN UTAMA --}}
@section('content')
<div class="min-h-screen page-bg">

    <section class="hero-section hero-pattern pt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-20 text-center fade-in-up">
            <div class="floating-element inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-teal-500 to-teal-700 rounded-2xl shadow-lg mb-6">
                <i class="fas fa-images text-white text-2xl"></i>
            </div>
            <h1 class="hero-title text-5xl md:text-6xl font-black text-teal-900 mb-4 leading-tight">
                Galeri <span class="text-teal-600">Kegiatan</span>
            </h1>
            <p class="hero-subtitle text-xl text-teal-700 mb-8 max-w-2xl mx-auto leading-relaxed">
                Dokumentasi visual dari momen-momen penting dan berkesan di Kelurahan Cupak Tangah
            </p>

            
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
        <div class="grid-layout mt-12 md:mt-20">
            @foreach($galeri as $item)
            <div class="glass-card rounded-2xl overflow-hidden card-hover group fade-in-up">
                <div class="relative overflow-hidden image-container">
                    <img src="{{ $item->thumbnail_url ? asset('storage/' . $item->thumbnail_url) : 'https://placehold.co/600x400/E5E7EB/6B7280?text=THUMBNAIL' }}"
                         alt="{{ $item->judul_kegiatan }}"
                         class="w-full h-52 object-cover transition-transform duration-500 group-hover:scale-110">
                    @if($item->fotoGaleri->count() > 0)
                    <div class="absolute top-4 right-4 flex items-center photo-badge text-white text-xs font-semibold px-3 py-1.5 rounded-full">
                        <i class="fas fa-camera mr-1.5"></i>
                        {{ $item->fotoGaleri->count() }} Foto
                    </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-teal-900/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end justify-start p-6">
                    </div>
                </div>
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 leading-tight group-hover:text-teal-700 transition-colors duration-300">
                        {{ $item->judul_kegiatan }}
                    </h2>
                    <p class="text-gray-600 mb-4 text-sm line-clamp-3 leading-relaxed">
                        {{ Str::limit($item->deskripsi_singkat, 100) }}
                    </p>
                    <div class="flex items-center justify-between pt-4 border-t border-gray-100/50">
                        <span class="text-sm text-gray-500 flex items-center">
                            <i class="far fa-calendar text-teal-500 mr-2"></i>
                            {{ $item->tanggal_kegiatan->format('d M Y') }}
                        </span>
                        <a href="{{ route('galeri.show', $item->id_kegiatan) }}"
                           class="read-more inline-flex items-center text-teal-600 font-semibold text-sm px-3 py-1.5 rounded-lg bg-teal-50 border border-teal-100">
                            Lihat Galeri <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-16 fade-in-up">
            <div class="mt-6 text-sm text-teal-600 font-medium">
                Menampilkan {{ count($galeri) }} kegiatan
            </div>
        </div>
    </section>

</div>
@endsection

{{-- 3. JAVASCRIPT --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animasi Scroll
        const observerOptions = { threshold: 0.1, rootMargin: '0px 0px -50px 0px' };
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('visible');
            });
        }, observerOptions);
        document.querySelectorAll('.fade-in-up').forEach(el => observer.observe(el));

        // Animasi loading gambar
        const images = document.querySelectorAll('img');
        images.forEach(img => {
            img.classList.add('opacity-0', 'transition-opacity', 'duration-500');
            const showImg = () => {
                img.classList.remove('opacity-0');
                img.classList.add('opacity-100');
            };
            if (img.complete) { showImg(); } else { img.addEventListener('load', showImg); }
        });
    });
</script>
@endpush
