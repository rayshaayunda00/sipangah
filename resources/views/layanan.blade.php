@extends('layouts.app')

@section('title', 'Layanan Kami | Kelurahan Sipangah')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    :root {
        --primary: #7c3aed;
        --primary-light: #8b5cf6;
        --primary-dark: #6d28d9;
        --secondary: #06b6d4;
        --secondary-light: #22d3ee;
        --accent: #10b981;
        --accent-light: #34d399;
        --dark: #1e293b;
        --light: #f8fafc;
        --gray: #64748b;
        --gray-light: #e2e8f0;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Inter', sans-serif;
    }

    body {
        background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
        color: #334155;
        line-height: 1.6;
        min-height: 100vh;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 5rem 1.5rem;
    }

    /* Header Styles */
    .page-header {
        text-align: center;
        margin-bottom: 1rem;
        padding: 2rem 0;
    }

    .page-title {
        font-size: 3rem;
        font-weight: 800;
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
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
        background: linear-gradient(90deg, var(--primary), var(--secondary));
        border-radius: 2px;
    }

    .page-subtitle {
        font-size: 1.25rem;
        color: var(--gray);
        max-width: 600px;
        margin: 0 auto;
    }

    /* Welcome Card */
    .welcome-card {
        background: #fff;
        border-radius: 1.5rem;
        padding: 2.5rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        margin-bottom: 3rem;
        text-align: center;
        border: 1px solid rgba(255, 255, 255, 0.8);
        position: relative;
        overflow: hidden;
    }

    .welcome-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, var(--primary), var(--secondary), var(--accent));
    }

    .welcome-icon {
        font-size: 0rem;
        color: var(--primary);
        margin-bottom: 1.5rem;
    }

    .welcome-text {
        font-size: 1.25rem;
        color: var(--gray);
        margin-bottom: 2rem;
        line-height: 1.8;
    }

    /* Services Grid */
    .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 2rem;
        margin-bottom: 3rem;
    }

    .service-card {
        background: white;
        border-radius: 1.5rem;
        padding: 2.5rem;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        transition: all 0.4s ease;
        border: 1px solid rgba(255, 255, 255, 0.8);
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
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(124, 58, 237, 0.15);
    }

    .service-card:hover::before {
        background: linear-gradient(90deg, var(--primary), var(--secondary));
    }

    .service-icon {
        font-size: 3rem;
        color: var(--primary);
        margin-bottom: 1.5rem;
        transition: all 0.4s ease;
    }

    .service-card:hover .service-icon {
        transform: scale(1.1) rotate(5deg);
        color: var(--secondary);
    }

    .service-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 1rem;
    }

    .service-description {
        color: var(--gray);
        line-height: 1.7;
        margin-bottom: 1.5rem;
    }

    .service-features {
        list-style: none;
        margin-top: 1.5rem;
    }

    .service-features li {
        padding: 0.5rem 0;
        color: var(--gray);
        display: flex;
        align-items: center;
    }

    .service-features li i {
        color: var(--accent);
        margin-right: 0.75rem;
        font-size: 0.875rem;
    }

    /* CTA Section */
    .cta-section {
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        border-radius: 1.5rem;
        padding: 3rem;
        text-align: center;
        color: white;
        box-shadow: 0 15px 35px rgba(124, 58, 237, 0.2);
        margin-bottom: 2rem;
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
        background: white;
        border-radius: 1rem;
        padding: 2rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        text-align: center;
        transition: all 0.3s ease;
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
        color: var(--dark);
        margin-bottom: 0.5rem;
    }

    .info-text {
        color: var(--gray);
        font-size: 0.875rem;
    }
</style>

<div class="container mt-20">
    <!-- Header -->
    <div class="page-header">
        <h1 class="page-title">Layanan Kami</h1>
        <p class="page-subtitle">Akses berbagai layanan digital Kelurahan Sipangah untuk kemudahan administrasi Anda</p>
    </div>

    <!-- Welcome Card -->
    <div class="welcome-card">
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
        <div class="service-card">
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

        <div class="service-card">
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

        <div class="service-card">
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

    <!-- CTA -->
    <div class="cta-section">
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
        <div class="info-card">
            <div class="info-icon"><i class="fas fa-clock"></i></div>
            <h4 class="info-title">Layanan Cepat</h4>
            <p class="info-text">Proses administrasi efisien dan cepat</p>
        </div>

        <div class="info-card">
            <div class="info-icon"><i class="fas fa-lock"></i></div>
            <h4 class="info-title">Aman & Terpercaya</h4>
            <p class="info-text">Data Anda terlindungi dengan keamanan terbaik</p>
        </div>

        <div class="info-card">
            <div class="info-icon"><i class="fas fa-headset"></i></div>
            <h4 class="info-title">Bantuan 24/7</h4>
            <p class="info-text">Tim support siap membantu kapan saja</p>
        </div>

        <div class="info-card">
            <div class="info-icon"><i class="fas fa-mobile-alt"></i></div>
            <h4 class="info-title">Akses Mobile</h4>
            <p class="info-text">Nikmati layanan melalui smartphone</p>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.service-card').forEach((card, i) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        setTimeout(() => {
            card.style.transition = 'opacity .6s ease, transform .6s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, 300 + i * 200);
    });
});
</script>
@endsection
