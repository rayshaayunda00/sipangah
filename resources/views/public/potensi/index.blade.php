@extends('layouts.app')

@section('title', 'Potensi Daerah & UMKM')

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

        .potensi-bg {
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

        .load-more-btn {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            box-shadow: 0 8px 25px rgba(15, 118, 110, 0.3);
            transition: all 0.3s ease; position: relative; overflow: hidden;
        }
        .load-more-btn:hover {
            transform: translateY(-3px); box-shadow: 0 12px 30px rgba(15, 118, 110, 0.4);
        }

        .floating-element { animation: float 6s ease-in-out infinite; }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-12px); }
        }

        /* Filter Styles */
        .filter-btn { transition: all 0.3s ease; position: relative; overflow: hidden; }
        .filter-btn:hover { transform: translateY(-2px); }
        .active-filter {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white; box-shadow: 0 8px 25px rgba(15, 118, 110, 0.3);
        }

        /* Stats Grid */
        .stats-grid { display: flex; justify-content: center; gap: 1.5rem; max-width: 600px; margin: 0 auto; }
        .stats-grid .glass-card { flex: 1; min-width: 140px; max-width: 180px; }

        /* === ANIMASI SCROLL === */
        .fade-in-up { opacity: 0; transform: translateY(30px); transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1); }
        .fade-in-up.visible { opacity: 1; transform: translateY(0); }

        /* Group Hover Utils */
        .group:hover .group-hover\:scale-110 { transform: scale(1.1); }
        .group:hover .group-hover\:text-teal-700 { color: var(--primary); }
    </style>
@endpush

{{-- 2. KONTEN UTAMA --}}
@section('content')
<div class="min-h-screen potensi-bg">

    {{-- HERO SECTION --}}
    <section class="hero-section hero-pattern pt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-20 text-center fade-in-up">

            <div class="floating-element inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-teal-500 to-teal-700 rounded-2xl shadow-lg mb-6">
                <i class="fas fa-store text-white text-2xl"></i>
            </div>

            <h1 class="hero-title text-5xl md:text-6xl font-black text-teal-900 mb-4 leading-tight">
                Potensi <span class="text-teal-600">Daerah</span>
            </h1>

            <p class="hero-subtitle text-xl text-teal-700 mb-8 max-w-2xl mx-auto leading-relaxed">
                Temukan berbagai potensi dan usaha masyarakat sekitar Anda
            </p>

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

    {{-- MAIN SECTION (SEARCH + FILTER + GRID) --}}
    {{-- Menggunakan py-8 md:py-12 agar jarak search bar sama dengan halaman Artikel --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12 scroll-target">

        {{-- Container SEARCH & FILTER (Struktur disamakan dengan Artikel) --}}
        <div class="mb-12 fade-in-up">
            <form action="{{ route('potensi.public.index') }}" method="GET" class="flex justify-center mb-6">
                <div class="relative w-full sm:w-11/12 md:w-3/4 lg:w-2/3 xl:w-1/2">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari potensi berdasarkan judul atau deskripsi..."
                           class="search-input w-full px-5 py-3 rounded-2xl shadow-sm border border-teal-200 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 placeholder-gray-400 text-sm sm:text-base">
                </div>
                @if(request('kategori'))
                    <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                @endif
            </form>

            <div class="flex flex-wrap justify-center gap-3 filter-container">
                <a href="{{ route('potensi.public.index', ['search' => request('search')]) }}"
                   class="filter-btn px-5 py-2.5 rounded-xl font-semibold {{ !$kategoriAktif ? 'active-filter' : 'text-teal-700 bg-white/80 border border-teal-200 shadow-sm hover:shadow-md' }}">
                    <i class="fas fa-th-large mr-2"></i>Semua Potensi
                </a>
                @foreach ($kategori as $kat)
                <a href="{{ route('potensi.public.index', ['kategori' => $kat->nama_kategori, 'search' => request('search')]) }}"
                   class="filter-btn px-5 py-2.5 rounded-xl font-semibold {{ $kategoriAktif == $kat->nama_kategori ? 'active-filter' : 'text-teal-700 bg-white/80 border border-teal-200 shadow-sm hover:shadow-md' }}">
                   <i class="fas fa-tag mr-2"></i>{{ $kat->nama_kategori }}
                </a>
                @endforeach
            </div>
        </div>

        {{-- GRID LAYOUT --}}
        @if ($items->count() > 0)
        <div class="grid-layout">
            @foreach ($items as $item)
            <div class="glass-card rounded-2xl overflow-hidden card-hover group fade-in-up">
                <div class="relative overflow-hidden image-container">
                    <img src="{{ $item->url_gambar_utama ? asset('storage/' . $item->url_gambar_utama) : 'https://placehold.co/600x400/E5E7EB/6B7280?text=No+Image' }}"
                         alt="{{ $item->nama_item }}"
                         class="w-full h-52 object-cover transition-transform duration-500 group-hover:scale-110">

                    @if($item->subkategori && $item->subkategori->kategori)
                        <div class="absolute bottom-4 left-4 flex items-center bg-white/90 text-teal-700 text-xs font-semibold px-3 py-1.5 rounded-full shadow-md">
                            <i class="fas fa-tag mr-1.5"></i>
                            {{ $item->subkategori->kategori->nama_kategori }}
                        </div>
                    @endif
                </div>

                <div class="p-4 md:p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 leading-tight group-hover:text-teal-700 transition-colors duration-300">
                        {{ $item->nama_item }}
                    </h2>
                    <p class="text-gray-600 mb-4 text-sm line-clamp-3 leading-relaxed">
                        {{ $item->deskripsi_singkat }}
                    </p>
                    @if ($item->alamat)
                    <div class="flex items-start text-gray-600 mb-3">
                        <i class="fas fa-map-marker-alt text-teal-500 mr-2 mt-0.5 flex-shrink-0"></i>
                        <span class="text-sm line-clamp-2">{{ $item->alamat }}</span>
                    </div>
                    @endif
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
                            <a href="{{ route('public.potensi.show', $item) }}"
                               class="read-more inline-flex items-center text-teal-600 font-semibold text-sm px-3 py-1.5 rounded-lg bg-teal-50 border border-teal-100 hover:bg-teal-600 hover:text-white transition-all">
                                Lihat Detail <i class="fas fa-arrow-right ml-2 transition-transform duration-300 group-hover:translate-x-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
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

        @if ($items->count() > 0)
        <div class="text-center mt-16 fade-in-up">
            <div class="mt-6 text-sm text-teal-600 font-medium">
                Menampilkan {{ $items->count() }} potensi
            </div>
        </div>
        @endif

    </section>

</div>
@endsection

{{-- 3. JAVASCRIPT --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Observer untuk animasi Fade In
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.fade-in-up').forEach(element => {
            observer.observe(element);
        });

        // Animasi loading gambar
        const images = document.querySelectorAll('img');
        images.forEach(img => {
            img.classList.add('opacity-0', 'transition-opacity', 'duration-500');
            const showImg = () => {
                img.classList.remove('opacity-0');
                img.classList.add('opacity-100');
            };
            if (img.complete) {
                showImg();
            } else {
                img.addEventListener('load', showImg);
            }
        });
    });
</script>
@endpush
