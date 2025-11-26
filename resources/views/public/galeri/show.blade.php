@extends('layouts.app')

@section('title', $kegiatan->judul_kegiatan ?? 'Detail Kegiatan')

{{-- 1. CSS & FONTS (Masuk ke @stack('styles') di Layout Utama) --}}
@push('styles')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #0f766e;
            --primary-light: #0d9488;
            --accent: #f59e0b;
        }

        /* Gunakan class wrapper, jangan timpa body langsung */
        .detail-page-bg {
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
            transform: translateY(-5px);
            box-shadow: 0 20px 40px -12px rgba(15, 118, 110, 0.25),
                        0 0 0 1px rgba(255, 255, 255, 0.9);
        }

        .image-container { position: relative; overflow: hidden; }
        .image-container::after {
            content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 40%;
            background: linear-gradient(to top, rgba(15, 118, 110, 0.4) 0%, transparent 100%);
            opacity: 0; transition: opacity 0.4s ease; z-index: 1;
        }
        .card-hover:hover .image-container::after { opacity: 1; }

        .photo-overlay {
            background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, transparent 100%);
            opacity: 0; transition: all 0.3s ease;
        }
        .group:hover .photo-overlay { opacity: 1; }

        .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .line-clamp-3 { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }

        .hero-pattern {
            background-image: radial-gradient(circle at 20% 80%, rgba(13, 148, 136, 0.08) 0%, transparent 50%),
                              radial-gradient(circle at 80% 20%, rgba(245, 158, 11, 0.05) 0%, transparent 50%);
            background-size: 100% 100%;
        }

        .floating-element { animation: float 6s ease-in-out infinite; }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
        }

        .stats-card {
            background: linear-gradient(135deg, rgba(13, 148, 136, 0.1) 0%, rgba(15, 118, 110, 0.05) 100%);
            border: 1px solid rgba(13, 148, 136, 0.2);
        }

        .grid-layout {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
        }
        @media (max-width: 640px) {
            .grid-layout {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 1rem;
            }
        }

        .empty-state {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border: 2px dashed #cbd5e1;
        }

        /* Group Hover Utils */
        .group:hover .group-hover\:scale-110 { transform: scale(1.1); }
        .group:hover .group-hover\:translate-y-0 { transform: translateY(0); }
    </style>
@endpush

{{-- 2. KONTEN UTAMA (Masuk ke @yield('content')) --}}
@section('content')
<div class="detail-page-bg pt-20 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="glass-card rounded-3xl p-8 mb-10 hero-pattern">
            <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
                <div class="flex-1">
                    <h1 class="text-4xl md:text-5xl font-black text-gray-900 mb-4 leading-tight">
                        <span class="bg-gradient-to-r from-teal-600 to-teal-800 bg-clip-text text-transparent">
                            {{ $kegiatan->judul_kegiatan }}
                        </span>
                    </h1>

                    <div class="flex items-center text-gray-600 mb-4">
                        <div class="floating-element flex items-center justify-center w-12 h-12 bg-teal-100 rounded-xl mr-4">
                            <i class="fas fa-calendar-day text-teal-600 text-lg"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Tanggal Kegiatan</p>
                            <p class="text-lg font-bold text-teal-700">{{ $kegiatan->tanggal_kegiatan->format('d F Y') }}</p>
                        </div>
                    </div>

                    <div class="bg-white/50 rounded-2xl p-6 border border-teal-100">
                        <p class="text-gray-700 leading-relaxed text-lg">
                            {{ $kegiatan->deskripsi_singkat }}
                        </p>
                    </div>
                </div>

                <div class="stats-card rounded-2xl p-6 text-center min-w-[200px]">
                    <div class="floating-element inline-flex items-center justify-center w-16 h-16 bg-teal-500 rounded-2xl mb-3">
                        <i class="fas fa-camera text-white text-xl"></i>
                    </div>
                    <div class="text-3xl font-bold text-teal-800">{{ $kegiatan->fotoGaleri->count() }}</div>
                    <div class="text-sm font-medium text-teal-600">Total Foto</div>
                </div>
            </div>
        </div>

        <div class="mb-8">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-3xl font-bold text-gray-900">
                    Dokumentasi Foto
                </h2>
                <div class="flex items-center bg-teal-50 px-4 py-2 rounded-full">
                    <i class="fas fa-images text-teal-600 mr-2"></i>
                    <span class="text-teal-800 font-semibold">{{ $kegiatan->fotoGaleri->count() }} Foto</span>
                </div>
            </div>

            @if($kegiatan->fotoGaleri->count() > 0)
            <div class="grid-layout">
                @foreach($kegiatan->fotoGaleri as $foto)
                <div class="glass-card rounded-2xl overflow-hidden card-hover group">
                    <div class="relative overflow-hidden image-container">
                        <img src="{{ asset('storage/' . $foto->url_foto) }}"
                             alt="{{ $foto->deskripsi_foto ?? $kegiatan->judul_kegiatan }}"
                             class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110">

                        <div class="photo-overlay absolute inset-0 flex flex-col justify-end p-4">
                            <div class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                @if($foto->deskripsi_foto)
                                <p class="text-white text-sm font-medium leading-snug line-clamp-2 mb-2">
                                    {{ $foto->deskripsi_foto }}
                                </p>
                                @endif
                                <div class="flex items-center justify-between">
                                    <span class="text-xs text-teal-200 bg-teal-600/50 px-2 py-1 rounded-full">
                                        Foto {{ $loop->iteration }}
                                    </span>
                                    <button class="text-white hover:text-teal-200 transition-colors">
                                        <i class="fas fa-expand text-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="empty-state rounded-3xl p-12 text-center">
                <div class="floating-element inline-flex items-center justify-center w-24 h-24 bg-gray-200 rounded-3xl mb-6">
                    <i class="fas fa-camera-alt text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-600 mb-3">Belum Ada Dokumentasi</h3>
                <p class="text-gray-500 max-w-md mx-auto leading-relaxed">
                    Maaf, belum ada foto yang didokumentasikan untuk kegiatan
                    <span class="font-semibold text-teal-600">{{ $kegiatan->judul_kegiatan }}</span>.
                </p>
            </div>
            @endif
        </div>

    </div>
</div>
@endsection

{{-- 3. JAVASCRIPT (Masuk ke @stack('scripts')) --}}
@push('scripts')
<script>
    // Image loading animation
    document.addEventListener('DOMContentLoaded', function() {
        const images = document.querySelectorAll('img');
        images.forEach(img => {
            img.classList.add('opacity-0', 'transition-opacity', 'duration-500');

            img.addEventListener('load', function() {
                this.classList.remove('opacity-0');
                this.classList.add('opacity-100');
            });

            if (img.complete) {
                img.classList.remove('opacity-0');
                img.classList.add('opacity-100');
            }
        });
    });

    // Add click to enlarge functionality (Simple placeholder)
    document.querySelectorAll('.image-container img').forEach(img => {
        img.addEventListener('click', function() {
            // Anda bisa menambahkan logika Lightbox di sini nanti
            // this.classList.toggle('scale-150'); // Contoh sederhana
        });
    });
</script>
@endpush
