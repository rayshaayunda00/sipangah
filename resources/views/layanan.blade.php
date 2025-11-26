@extends('layouts.app')

@section('title', 'Layanan Kami | Kelurahan Sipangah')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        line-height: 1.6;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1.5rem;
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

    /* Hero Section */
    .hero-section {
        padding: 8rem 0 4rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .hero-pattern {
        background-image:
            radial-gradient(circle at 20% 80%, rgba(13, 148, 136, 0.08) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(245, 158, 11, 0.05) 0%, transparent 50%),
            radial-gradient(circle at 40% 40%, rgba(15, 118, 110, 0.06) 0%, transparent 50%);
    }

    .floating-element {
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-12px); }
    }

    .hero-title {
        font-size: 3.4rem;
        font-weight: 800;
        color: var(--primary-dark);
        margin-bottom: 1rem;
        line-height: 1.2;
    }

    .hero-subtitle {
        font-size: 1.25rem;
        color: var(--gray-700);
        max-width: 600px;
        margin: 0 auto 0rem;
        line-height: 1.6;
    }

    /* Welcome Card */
    .welcome-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 1.5rem;
        padding: 3rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        margin-bottom: 5rem;
        text-align: center;
        border: 1px solid rgba(255, 255, 255, 0.3);
        position: relative;
        overflow: hidden;
    }

    .welcome-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 8px;
        background: linear-gradient(90deg, var(--primary), var(--primary-light), var(--accent));
    }

    .welcome-icon {
        font-size: 1rem;
        color: var(--primary);
        margin-bottom: 1.5rem;
    }

    .welcome-text {
        font-size: 1.125rem;
        color: var(--gray-600);
        line-height: 1.7;
        margin-bottom: 0;
    }

    /* Services Grid */
    .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 2rem;
        margin-bottom: 3rem;
    }

    .service-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border-radius: 1.5rem;
        padding: 2.5rem;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        transition: all 0.4s ease;
        border: 1px solid rgba(255, 255, 255, 0.3);
        position: relative;
        overflow: hidden;
    }

    .service-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: var(--primary);
        transition: all 0.4s ease;
    }

    .service-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(15, 118, 110, 0.15);
    }

    .service-card:hover::before {
        background: linear-gradient(90deg, var(--primary), var(--primary-light));
    }

    .service-icon {
        font-size: 3rem;
        color: var(--primary);
        margin-bottom: 1.5rem;
        transition: all 0.4s ease;
    }

    .service-card:hover .service-icon {
        transform: scale(1.1) rotate(5deg);
        color: var(--primary-light);
    }

    .service-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 1rem;
    }

    .service-description {
        color: var(--gray-600);
        line-height: 1.7;
        margin-bottom: 1.5rem;
    }

    .service-features {
        list-style: none;
        margin-top: 1.5rem;
    }

    .service-features li {
        padding: 0.5rem 0;
        color: var(--gray-600);
        display: flex;
        align-items: center;
        font-size: 0.9rem;
    }

    .service-features li i {
        color: var(--accent);
        margin-right: 0.75rem;
        font-size: 0.875rem;
    }

    /* CTA Section */
    .cta-section {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        border-radius: 1.5rem;
        padding: 3rem;
        text-align: center;
        color: white;
        box-shadow: 0 15px 35px rgba(15, 118, 110, 0.2);
        margin-bottom: 3rem;
        position: relative;
        overflow: hidden;
    }

    .cta-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .cta-description {
        font-size: 1.125rem;
        opacity: 0.9;
        margin-bottom: 2rem;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.6;
    }

    .cta-button {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        background: white;
        color: var(--primary);
        padding: 1rem 2.5rem;
        border-radius: 1rem;
        text-decoration: none;
        font-weight: 600;
        font-size: 1.125rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        position: relative;
        overflow: hidden;
    }

    .cta-button::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.6), transparent);
        transition: left 0.6s ease;
    }

    .cta-button:hover::before {
        left: 100%;
    }

    .cta-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        color: var(--primary-dark);
    }

    /* Info Cards */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-top: 3rem;
    }

    .info-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border-radius: 1rem;
        padding: 2rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        text-align: center;
        transition: all 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .info-icon {
        font-size: 2.5rem;
        color: var(--primary);
        margin-bottom: 1rem;
    }

    .info-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--gray-900);
        margin-bottom: 0.5rem;
    }

    .info-text {
        color: var(--gray-600);
        font-size: 0.875rem;
        line-height: 1.5;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.5rem;
        }

        .hero-subtitle {
            font-size: 1.125rem;
        }

        .services-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .welcome-card,
        .service-card,
        .cta-section {
            padding: 2rem;
        }

        .cta-title {
            font-size: 1.75rem;
        }
    }

    @media (max-width: 640px) {
        .hero-title {
            font-size: 2rem;
        }

        .hero-section {
            padding: 6rem 0 3rem;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }
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
</style>

<div class="min-h-screen">
    <!-- Hero Section -->
    <section class="hero-section hero-pattern">
        <div class="container">
            <div class="text-center">
                <!-- Floating Icon -->
                <div class="floating-element inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-teal-500 to-teal-700 rounded-2xl shadow-lg mb-6">
                    <i class="fas fa-handshake text-white text-2xl"></i>
                </div>

                <h1 class="hero-title">
                    Layanan <span class="text-teal-600">Kami</span>
                </h1>

                <p class="hero-subtitle">
                    Akses berbagai layanan digital Kelurahan Sipangah untuk kemudahan administrasi Anda
                </p>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container pb-16">
        <!-- Welcome Card -->
        <div class="welcome-card fade-in-up">
            <div class="welcome-icon">
                <i class="fas fa-shield-check"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Selamat Datang di Area Layanan</h2>
            <p class="welcome-text">
                Ini adalah halaman layanan eksklusif yang hanya dapat diakses oleh pengguna terdaftar.
                Nikmati berbagai layanan digital kami yang dirancang untuk memberikan kemudahan dan efisiensi dalam pengurusan administrasi.
            </p>
        </div>

        <!-- Services Grid -->
        <div class="services-grid">
            <div class="service-card card-hover fade-in-up">
                <div class="service-icon"><i class="fas fa-file-contract"></i></div>
                <h3 class="service-title">Surat Menyurat</h3>
                <p class="service-description">Layanan pembuatan surat administrasi seperti surat keterangan, pengantar, dan dokumen resmi lainnya.</p>
                <ul class="service-features">
                    <li><i class="fas fa-check"></i> Surat Keterangan Domisili</li>
                    <li><i class="fas fa-check"></i> Surat Keterangan Tidak Mampu</li>
                    <li><i class="fas fa-check"></i> Surat Pengantar Nikah</li>
                    <li><i class="fas fa-check"></i> Surat Keterangan Usaha</li>
                </ul>
            </div>

            <div class="service-card card-hover fade-in-up">
                <div class="service-icon"><i class="fas fa-users"></i></div>
                <h3 class="service-title">Administrasi Kependudukan</h3>
                <p class="service-description">Pengurusan dokumen kependudukan seperti KTP, KK, dan mutasi penduduk.</p>
                <ul class="service-features">
                    <li><i class="fas fa-check"></i> Kartu Keluarga</li>
                    <li><i class="fas fa-check"></i> KTP Elektronik</li>
                    <li><i class="fas fa-check"></i> Akta Kelahiran</li>
                    <li><i class="fas fa-check"></i> Mutasi Penduduk</li>
                </ul>
            </div>

            <div class="service-card card-hover fade-in-up">
                <div class="service-icon"><i class="fas fa-hand-holding-heart"></i></div>
                <h3 class="service-title">Layanan Sosial</h3>
                <p class="service-description">Program bantuan sosial dan layanan masyarakat untuk kesejahteraan warga.</p>
                <ul class="service-features">
                    <li><i class="fas fa-check"></i> Bansos Tunai</li>
                    <li><i class="fas fa-check"></i> Kartu Indonesia Sehat</li>
                    <li><i class="fas fa-check"></i> Kartu Indonesia Pintar</li>
                    <li><i class="fas fa-check"></i> Bantuan Lansia</li>
                </ul>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="cta-section fade-in-up">
            <h2 class="cta-title">Akses Layanan Digital Lengkap</h2>
            <p class="cta-description">
                Kunjungi portal e-Kelurahan untuk mengakses semua layanan digital secara lengkap dan terintegrasi.
            </p>
            <a href="https://ekelurahan.padang.go.id/masyarakat" target="_blank" class="cta-button">
                <i class="fas fa-external-link-alt"></i>
                Kunjungi e-Kelurahan
            </a>
        </div>

        <!-- Info Grid -->
        <div class="info-grid">
            <div class="info-card card-hover fade-in-up">
                <div class="info-icon"><i class="fas fa-clock"></i></div>
                <h4 class="info-title">Layanan Cepat</h4>
                <p class="info-text">Proses administrasi efisien dan cepat</p>
            </div>

            <div class="info-card card-hover fade-in-up">
                <div class="info-icon"><i class="fas fa-lock"></i></div>
                <h4 class="info-title">Aman & Terpercaya</h4>
                <p class="info-text">Data Anda terlindungi dengan keamanan terbaik</p>
            </div>

            <div class="info-card card-hover fade-in-up">
                <div class="info-icon"><i class="fas fa-headset"></i></div>
                <h4 class="info-title">Bantuan 24/7</h4>
                <p class="info-text">Tim support siap membantu kapan saja</p>
            </div>

            <div class="info-card card-hover fade-in-up">
                <div class="info-icon"><i class="fas fa-mobile-alt"></i></div>
                <h4 class="info-title">Akses Mobile</h4>
                <p class="info-text">Nikmati layanan melalui smartphone</p>
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

    // Add hover effects to service cards
    const serviceCards = document.querySelectorAll('.service-card');
    serviceCards.forEach((card, index) => {
        card.style.transitionDelay = `${index * 100}ms`;
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
