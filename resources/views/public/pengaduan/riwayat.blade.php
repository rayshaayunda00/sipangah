@extends('layouts.app')

@section('title', 'Riwayat Pengaduan')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
:root {
    --primary: #7c3aed; /* Ungu */
    --primary-light: #8b5cf6;
    --primary-dark: #6d28d9;
    --secondary: #06b6d4; /* Biru Muda */
    --secondary-light: #22d3ee;
    --accent: #10b981;
    --accent-light: #34d399;
    --dark: #1e293b;
    --light: #f8fafc;
    --gray: #64748b;
    --gray-light: #e2e8f0;
}

.main-wrapper {
    background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
    min-height: 100vh;
    padding-top: 6rem; /* Tambahkan padding atas untuk kesan modern */
    padding-bottom: 5rem;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1.5rem; /* Padding horizontal yang responsif */
}

/* Header Styles */
.page-header { text-align: center; margin-bottom: 2rem; padding: 2rem 0; }
.page-title {
    font-size: 2.5rem; /* Disesuaikan untuk mobile */
    font-weight: 800;
    background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
    margin-bottom: 1rem; position: relative; display: inline-block;
}
.page-title::after {
    content: ''; position: absolute; bottom: -10px; left: 50%;
    transform: translateX(-50%); width: 80px; height: 4px;
    background: linear-gradient(90deg, var(--primary), var(--secondary)); border-radius: 2px;
}
.page-subtitle { font-size: 1rem; color: var(--gray); max-width: 600px; margin: 0 auto; }

/* MEDIA QUERY: Header untuk Desktop */
@media (min-width: 768px) {
    .page-title { font-size: 3rem; }
    .page-subtitle { font-size: 1.25rem; }
}

/* Navigation Tabs - Sama dengan halaman Buat Pengaduan */
.max-w-3xl { max-width: 48rem; }
.mx-auto { margin-left: auto; margin-right: auto; }
.mb-10 { margin-bottom: 2.5rem; }
.rounded-full { border-radius: 9999px; }
.shadow-lg { box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); }
.overflow-hidden { overflow: hidden; }
.flex { display: flex; }
.flex-1 { flex: 1 1 0%; }
.items-center { align-items: center; }
.justify-center { justify-content: center; }
.gap-2 { gap: 0.5rem; }
.py-3 { padding-top: 0.75rem; padding-bottom: 0.75rem; }
.font-semibold { font-weight: 600; }
.text-sm { font-size: 0.875rem; }
.sm\\:text-base { font-size: 1rem; }
.transition-all { transition-property: all; transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); transition-duration: 300ms; }
.duration-300 { transition-duration: 300ms; }
.bg-gradient-to-r { background-image: linear-gradient(to right, var(--tw-gradient-stops)); }
.from-indigo-500 { --tw-gradient-from: #6366f1; --tw-gradient-to: rgb(99 102 241 / 0); --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to); }
.via-purple-500 { --tw-gradient-to: rgb(168 85 247 / 0); --tw-gradient-stops: var(--tw-gradient-from), #a855f7, var(--tw-gradient-to); }
.to-pink-500 { --tw-gradient-to: #ec4899; }
.text-white { color: #fff; }
.bg-white { background-color: #fff; }
.text-gray-800 { color: #1f2937; }
.hover\\:text-purple-600:hover { color: #9333ea; }
.text-purple-500 { color: #a855f7; }
.text-sky-500 { color: #0ea5e9; }

/* Sisanya tetap sama dengan kode sebelumnya */
.complaint-card {
    background: white;
    border-radius: 1.5rem;
    padding: 2rem;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    margin-bottom: 1.5rem;
    border-left: 6px solid var(--primary);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.complaint-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--primary), var(--secondary));
    opacity: 0;
    transition: opacity 0.3s ease;
}

.complaint-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.complaint-card:hover::before {
    opacity: 1;
}

.complaint-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
    gap: 1rem;
}

.complaint-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--dark);
    flex: 1;
    min-width: 250px;
    line-height: 1.4;
}

.status-badge {
    display: inline-flex;
    align-items: center;
    padding: 0.5rem 1.25rem;
    border-radius: 2rem;
    font-size: 0.875rem;
    font-weight: 600;
    white-space: nowrap;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.status-new {
    background: linear-gradient(135deg, #3b82f6, #06b6d4);
    color: white;
}

.status-process {
    background: linear-gradient(135deg, #f59e0b, #f97316);
    color: white;
}

.status-completed {
    background: linear-gradient(135deg, #10b981, #34d399);
    color: white;
}

.complaint-meta {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
    padding: 1.5rem;
    background: #f8fafc;
    border-radius: 1rem;
    border: 1px solid #e2e8f0;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.meta-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, var(--primary-light), var(--secondary-light));
    color: white;
    flex-shrink: 0;
}

.meta-content {
    flex: 1;
}

.meta-label {
    font-size: 0.875rem;
    color: var(--gray);
    margin-bottom: 0.25rem;
}

.meta-value {
    font-weight: 600;
    color: var(--dark);
}

.complaint-content {
    margin-bottom: 2rem;
}

.content-label {
    font-weight: 700;
    color: var(--dark);
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 1.125rem;
}

.content-label i {
    color: var(--primary);
}

.content-text {
    color: var(--dark);
    line-height: 1.7;
    white-space: pre-line;
    background: #f8fafc;
    padding: 1.5rem;
    border-radius: 1rem;
    border-left: 4px solid var(--primary-light);
    font-size: 1rem;
}

.attachment-section {
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 2px dashed #e2e8f0;
}

.attachment-label {
    font-weight: 700;
    color: var(--dark);
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 1.125rem;
}

.attachment-label i {
    color: var(--primary);
}

.attachment-image {
    max-width: 100%;
    height: auto;
    border-radius: 1rem;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    border: 2px solid white;
    transition: all 0.3s ease;
}

.attachment-image:hover {
    transform: scale(1.02);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.18);
}

.empty-state {
    text-align: center;
    padding: 4rem 2rem;
    background: white;
    border-radius: 2rem;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    margin: 2rem 0;
}

.empty-icon {
    font-size: 5rem;
    margin-bottom: 1.5rem;
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.empty-title {
    font-size: 1.75rem;
    font-weight: 700;
    margin-bottom: 1rem;
    color: var(--dark);
}

.empty-description {
    font-size: 1.125rem;
    color: var(--gray);
    max-width: 400px;
    margin: 0 auto 2rem;
    line-height: 1.6;
}

.btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem 2rem;
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    color: white;
    border-radius: 1rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 8px 20px rgba(124, 58, 237, 0.3);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 30px rgba(124, 58, 237, 0.4);
}

/* Responsive improvements */
@media (max-width: 768px) {
    .page-title {
        font-size: 2rem;
    }

    .page-subtitle {
        font-size: 1rem;
    }

    .complaint-card {
        padding: 1.5rem;
        border-radius: 1rem;
    }

    .complaint-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .complaint-title {
        min-width: 100%;
        font-size: 1.25rem;
    }

    .complaint-meta {
        grid-template-columns: 1fr;
        gap: 1rem;
        padding: 1rem;
    }

    .content-text {
        padding: 1rem;
    }

    .empty-state {
        padding: 3rem 1.5rem;
    }

    .empty-title {
        font-size: 1.5rem;
    }

    .empty-description {
        font-size: 1rem;
    }
}

@media (max-width: 480px) {
    .main-wrapper {
        padding-top: 4rem;
    }

    .page-title {
        font-size: 1.75rem;
    }

    .complaint-card {
        padding: 1.25rem;
        margin-bottom: 1rem;
    }

    .meta-item {
        flex-direction: column;
        text-align: center;
        gap: 0.5rem;
    }
}

/* Animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.fade-in-up {
    animation: fadeInUp 0.6s ease-out;
}

.stagger-item {
    opacity: 0;
    animation: fadeInUp 0.6s ease-out forwards;
}
</style>

<div class="main-wrapper">
    <div class="container">
        {{-- Header --}}
        <div class="page-header">
            <h1 class="page-title">Riwayat Pengaduan</h1>
            <p class="page-subtitle">Lihat status dan riwayat pengaduan yang telah Anda kirimkan sebelumnya</p>
        </div>

        {{-- 🌈 Tombol Navigasi ala Gradient Tab --}}
<div class="max-w-3xl mx-auto mb-10 flex rounded-full shadow-lg overflow-hidden">
    {{-- Buat Pengaduan --}}
    <a href="{{ route('layanan.pengaduan') }}"
       class="flex-1 flex items-center justify-center gap-2 py-3 font-semibold text-sm sm:text-base transition-all duration-300
              {{ request()->routeIs('layanan.pengaduan')
                  ? 'bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 text-white'
                  : 'bg-white text-gray-800 hover:text-purple-600' }}">
        <i class="fas fa-pen-to-square {{ request()->routeIs('layanan.pengaduan') ? 'text-white' : 'text-purple-500' }}"></i>
        <span>Buat Pengaduan</span>
    </a>

    {{-- Riwayat Pengaduan --}}
    <a href="{{ route('layanan.pengaduan.riwayat') }}"
       class="flex-1 flex items-center justify-center gap-2 py-3 font-semibold text-sm sm:text-base transition-all duration-300
              {{ request()->routeIs('layanan.pengaduan.riwayat')
                  ? 'bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 text-white'
                  : 'bg-white text-gray-800 hover:text-purple-600' }}">
        <i class="fas fa-clock {{ request()->routeIs('layanan.pengaduan.riwayat') ? 'text-white' : 'text-sky-500' }}"></i>
        <span>Riwayat Pengaduan</span>
    </a>
</div>


        <!-- Content -->
        <div class="max-w-6xl mx-auto">
            @forelse($pengaduans as $index => $p)
                <div class="complaint-card fade-in-up" style="animation-delay: {{ $index * 0.1 }}s">
                    <!-- Header dengan judul dan status -->
                    <div class="complaint-header">
                        <h2 class="complaint-title">{{ $p->judul_pengaduan }}</h2>
                        <div class="status-badge
                            @if($p->status_pengaduan == 'Baru') status-new
                            @elseif($p->status_pengaduan == 'Dalam Proses') status-process
                            @else status-completed @endif">
                            <i class="fas
                                @if($p->status_pengaduan == 'Baru') fa-clock
                                @elseif($p->status_pengaduan == 'Dalam Proses') fa-spinner fa-pulse
                                @else fa-check-circle @endif mr-2"></i>
                            {{ $p->status_pengaduan }}
                        </div>
                    </div>

                    <!-- Informasi meta pengaduan -->
                    <div class="complaint-meta">
                        <div class="meta-item">
                            <div class="meta-icon">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="meta-content">
                                <div class="meta-label">Nama Pengadu</div>
                                <div class="meta-value">{{ $p->nama_pengadu }}</div>
                            </div>
                        </div>
                        <div class="meta-item">
                            <div class="meta-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="meta-content">
                                <div class="meta-label">Email</div>
                                <div class="meta-value">{{ $p->email_pengadu }}</div>
                            </div>
                        </div>
                        <div class="meta-item">
                            <div class="meta-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="meta-content">
                                <div class="meta-label">No. HP</div>
                                <div class="meta-value">{{ $p->no_hp_pengadu ?? '-' }}</div>
                            </div>
                        </div>
                        <div class="meta-item">
                            <div class="meta-icon">
                                <i class="fas fa-calendar"></i>
                            </div>
                            <div class="meta-content">
                                <div class="meta-label">Tanggal Pengaduan</div>
                                <div class="meta-value">{{ $p->tanggal_pengaduan }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Isi pengaduan -->
                    <div class="complaint-content">
                        <h3 class="content-label">
                            <i class="fas fa-file-alt"></i> Isi Pengaduan
                        </h3>
                        <div class="content-text">{{ $p->isi_pengaduan }}</div>
                    </div>

                    <!-- Lampiran jika ada -->
                    @if($p->url_lampiran)
                        <div class="attachment-section">
                            <h3 class="attachment-label">
                                <i class="fas fa-paperclip"></i> Lampiran
                            </h3>
                            <div class="flex justify-center">
                                <img src="{{ asset('storage/'.$p->url_lampiran) }}"
                                     alt="Lampiran Pengaduan"
                                     class="attachment-image max-w-md">
                            </div>
                            <div class="text-center mt-4">
                                <a href="{{ asset('storage/'.$p->url_lampiran) }}"
                                   target="_blank"
                                   class="btn-primary inline-flex">
                                    <i class="fas fa-external-link-alt"></i>
                                    Buka Gambar Lengkap
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            @empty
                <!-- Empty state ketika tidak ada pengaduan -->
                <div class="empty-state fade-in-up">
                    <div class="empty-icon">
                        <i class="fas fa-inbox"></i>
                    </div>
                    <h3 class="empty-title">Belum Ada Pengaduan</h3>
                    <p class="empty-description">
                        Anda belum mengirimkan pengaduan apapun.
                        Mulai laporkan masalah atau sampaikan aspirasi Anda untuk mendapatkan bantuan.
                    </p>
                    <a href="{{ route('layanan.pengaduan') }}" class="btn-primary">
                        <i class="fas fa-plus"></i>
                        Buat Pengaduan Pertama
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</div>

<script>
    // Animasi untuk item yang muncul secara berurutan
    document.addEventListener('DOMContentLoaded', function() {
        const complaintCards = document.querySelectorAll('.complaint-card');
        complaintCards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
        });
    });

    // Smooth scroll untuk pengalaman yang lebih baik
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
</script>
@endsection
