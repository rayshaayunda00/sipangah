@extends('layouts.app')

@section('title', 'Riwayat Pengaduan')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    /* Variabel CSS yang Konsisten dengan Halaman Pengaduan */
    :root {
        --primary: #0f766e;
        --primary-light: #0d9488;
        --primary-dark: #115e59;
        --accent: #f59e0b;
        --accent-light: #fbbf24;
        --dark: #1e293b;
        --light: #f8fafc;
        --gray: #64748b;
        --gray-light: #e2e8f0;
    }

    .main-wrapper {
        background: linear-gradient(135deg, #f0fdfa 0%, #f8fafc 50%, #ecfdf5 100%);
        background-attachment: fixed;
        min-height: 100vh;
        padding: 5rem 0 3rem;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    /* Header Styles - Consistent with Pengaduan Page */
    .page-header {
        text-align: center;
        margin-bottom: 3rem;
        padding: 2rem 0;
    }

    .page-title {
        font-size: 2.5rem;
        font-weight: 800;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 1rem;
        position: relative;
        display: inline-block;
    }

    .page-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background: linear-gradient(90deg, var(--primary), var(--primary-light));
        border-radius: 2px;
    }

    .page-subtitle {
        font-size: 1.125rem;
        color: var(--gray);
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.6;
    }

    /* Floating Icon - Consistent with Pengaduan Page */
    .floating-element {
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-12px); }
    }

    /* Navigation Tabs - Enhanced with Glass Effect */
    .nav-tabs-container {
        max-width: 48rem;
        margin: 0 auto 3rem;
    }

    .nav-tabs {
        display: flex;
        border-radius: 1rem;
        box-shadow: 0 10px 25px rgba(15, 118, 110, 0.1);
        overflow: hidden;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .nav-tab {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        padding: 1rem 1.5rem;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        text-decoration: none;
        border: none;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .nav-tab.active {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(15, 118, 110, 0.3);
    }

    .nav-tab:not(.active) {
        background: transparent;
        color: var(--dark);
    }

    .nav-tab:not(.active):hover {
        color: var(--primary);
        background: rgba(15, 118, 110, 0.05);
    }

    /* Glass Card Effect - Consistent with Pengaduan Page */
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

    /* Complaint Card Styles */
    .complaint-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 1.5rem;
        padding: 2rem;
        box-shadow:
            0 10px 25px rgba(0, 0, 0, 0.1),
            inset 0 1px 0 0 rgba(255, 255, 255, 0.8);
        margin-bottom: 2rem;
        border-left: 6px solid var(--primary);
        transition: all 0.4s ease;
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
        background: linear-gradient(90deg, var(--primary), var(--primary-light));
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .complaint-card:hover {
        transform: translateY(-5px);
        box-shadow:
            0 20px 40px rgba(0, 0, 0, 0.15),
            inset 0 1px 0 0 rgba(255, 255, 255, 0.8);
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
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        border-radius: 2rem;
        font-size: 0.875rem;
        font-weight: 600;
        white-space: nowrap;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(10px);
    }

    .status-new {
        background: linear-gradient(135deg, #0ea5e9, #06b6d4);
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
        background: rgba(248, 250, 252, 0.6);
        border-radius: 1rem;
        border: 1px solid rgba(226, 232, 240, 0.5);
        backdrop-filter: blur(10px);
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
        background: linear-gradient(135deg, var(--primary-light), var(--primary));
        color: white;
        flex-shrink: 0;
        box-shadow: 0 4px 8px rgba(15, 118, 110, 0.2);
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
        background: rgba(248, 250, 252, 0.6);
        padding: 1.5rem;
        border-radius: 1rem;
        border-left: 4px solid var(--primary-light);
        font-size: 1rem;
        backdrop-filter: blur(10px);
    }

    .attachment-section {
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 2px dashed rgba(226, 232, 240, 0.8);
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
        border: 2px solid rgba(255, 255, 255, 0.8);
        transition: all 0.3s ease;
    }

    .attachment-image:hover {
        transform: scale(1.02);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.18);
    }

    /* Empty State - Enhanced */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 2rem;
        box-shadow:
            0 10px 25px rgba(0, 0, 0, 0.08),
            inset 0 1px 0 0 rgba(255, 255, 255, 0.8);
        margin: 2rem 0;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .empty-icon {
        font-size: 5rem;
        margin-bottom: 1.5rem;
        background: linear-gradient(135deg, var(--primary), var(--primary-light));
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

    /* Button Primary - Consistent with Pengaduan Page */
    .btn-primary {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1rem 2rem;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        color: white;
        border-radius: 1rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.4s ease;
        box-shadow: 0 8px 20px rgba(15, 118, 110, 0.3);
        border: none;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .btn-primary::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.6s ease;
    }

    .btn-primary:hover::before {
        left: 100%;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 30px rgba(15, 118, 110, 0.4);
    }

    /* Hero Pattern Background */
    .hero-pattern {
        background-image:
            radial-gradient(circle at 20% 80%, rgba(13, 148, 136, 0.08) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(245, 158, 11, 0.05) 0%, transparent 50%),
            radial-gradient(circle at 40% 40%, rgba(15, 118, 110, 0.06) 0%, transparent 50%);
        background-size: 100% 100%;
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
        opacity: 0;
        animation: fadeInUp 0.6s ease-out forwards;
    }

    /* ========== RESPONSIVE DESIGN ========== */

    /* Tablet Devices (768px and up) */
    @media (min-width: 768px) {
        .main-wrapper {
            padding: 6rem 0 4rem;
        }

        .container {
            padding: 0 1.5rem;
        }

        .page-header {
            padding: 3rem 0;
        }

        .page-title {
            font-size: 3rem;
        }

        .page-subtitle {
            font-size: 1.25rem;
        }

        .nav-tab {
            padding: 1.25rem 2rem;
            font-size: 1.125rem;
        }

        .complaint-card {
            padding: 2.5rem;
            border-radius: 2rem;
        }

        .complaint-meta {
            grid-template-columns: repeat(2, 1fr);
            gap: 2rem;
        }
    }

    /* Desktop Devices (1024px and up) */
    @media (min-width: 1024px) {
        .page-title {
            font-size: 3.5rem;
        }

        .complaint-card {
            padding: 3rem;
            border-radius: 2.5rem;
        }

        .complaint-meta {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    /* Small Mobile Devices (480px and down) */
    @media (max-width: 480px) {
        .main-wrapper {
            padding: 4rem 0 2rem;
        }

        .container {
            padding: 0 0.75rem;
        }

        .page-title {
            font-size: 2rem;
        }

        .page-subtitle {
            font-size: 1rem;
        }

        .nav-tabs {
            flex-direction: column;
            border-radius: 1rem;
        }

        .nav-tab {
            border-radius: 0.75rem;
            margin: 0.25rem;
        }

        .complaint-card {
            padding: 1.5rem;
            border-radius: 1.25rem;
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

    /* Extra Small Devices (360px and down) */
    @media (max-width: 360px) {
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
</style>

<div class="main-wrapper hero-pattern">
    <div class="container">
        {{-- Enhanced Header with Floating Icon --}}
        <div class="page-header">
            <div class="floating-element inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-teal-500 to-teal-700 rounded-2xl shadow-lg mb-6">
                <i class="fas fa-history text-white text-2xl"></i>
            </div>
            <h1 class="page-title">Riwayat Pengaduan</h1>
            <p class="page-subtitle">Lihat status dan riwayat pengaduan yang telah Anda kirimkan sebelumnya</p>
        </div>

        {{-- Enhanced Navigation Tabs --}}
        <div class="nav-tabs-container">
            <div class="nav-tabs">
                <a href="{{ route('layanan.pengaduan') }}"
                   class="nav-tab {{ request()->routeIs('layanan.pengaduan') ? 'active' : '' }} card-hover">
                    <i class="fas fa-pen-to-square text-lg"></i>
                    <span>Buat Pengaduan</span>
                </a>
                <a href="{{ route('layanan.pengaduan.riwayat') }}"
                   class="nav-tab {{ request()->routeIs('layanan.pengaduan.riwayat') ? 'active' : '' }} card-hover">
                    <i class="fas fa-clock text-lg"></i>
                    <span>Riwayat Pengaduan</span>
                </a>
            </div>
        </div>

        <!-- Content -->
        <div class="max-w-6xl mx-auto">
            @forelse($pengaduans as $index => $p)
                <div class="complaint-card glass-card card-hover fade-in-up" style="animation-delay: {{ $index * 0.1 }}s">
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
                                @else fa-check-circle @endif"></i>
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
                <div class="empty-state glass-card card-hover fade-in-up">
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
    // Enhanced Animation and Interactions
    document.addEventListener('DOMContentLoaded', function() {
        // Stagger animation for complaint cards
        const complaintCards = document.querySelectorAll('.complaint-card');
        complaintCards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
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

        // Add hover effects to meta items
        const metaItems = document.querySelectorAll('.meta-item');
        metaItems.forEach(item => {
            item.addEventListener('mouseenter', function() {
                this.style.transform = 'translateX(8px)';
            });

            item.addEventListener('mouseleave', function() {
                this.style.transform = 'translateX(0)';
            });
        });

        // Image loading animation
        const images = document.querySelectorAll('.attachment-image');
        images.forEach(img => {
            img.addEventListener('load', function() {
                this.style.opacity = '1';
                this.style.transform = 'scale(1)';
            });

            // Set initial state
            img.style.opacity = '0';
            img.style.transform = 'scale(0.9)';
            img.style.transition = 'all 0.3s ease';

            // Check if image is already loaded
            if (img.complete) {
                img.style.opacity = '1';
                img.style.transform = 'scale(1)';
            }
        });
    });
</script>
@endsection
