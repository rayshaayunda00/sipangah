@extends('layouts.app')

@section('title', 'Layanan Pengaduan')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    /* Variabel CSS yang Konsisten dengan Galeri */
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

    /* Header Styles - Consistent with Gallery */
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

    /* Floating Icon - Consistent with Gallery */
    .floating-element {
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-12px); }
    }

    /* Navigation Tabs - Enhanced with Gallery Style */
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

    /* Glass Card Effect - Consistent with Gallery */
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

    /* Form Container - Enhanced with Glass Effect */
    .form-container {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 1.5rem;
        padding: 2rem;
        box-shadow:
            0 10px 25px rgba(0, 0, 0, 0.1),
            inset 0 1px 0 0 rgba(255, 255, 255, 0.8);
        transition: all 0.3s ease;
        margin: 0 auto;
        max-width: 56rem;
    }

    .form-container:hover {
        transform: translateY(-2px);
        box-shadow:
            0 15px 35px rgba(0, 0, 0, 0.15),
            inset 0 1px 0 0 rgba(255, 255, 255, 0.8);
    }

    /* Form Input Styles - Enhanced */
    .form-input {
        border: 1px solid #e2e8f0;
        border-radius: 0.75rem;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        padding: 1rem;
        transition: all 0.3s ease;
        line-height: 1.5;
        width: 100%;
        font-size: 1rem;
        background: rgba(255, 255, 255, 0.8);
    }

    .form-input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.2);
        outline: none;
        background: white;
    }

    /* File Input - Enhanced */
    .file-input-custom {
        display: block;
        width: 100%;
        font-size: 1rem;
        color: var(--gray);
        border: 2px dashed #e2e8f0;
        border-radius: 0.75rem;
        background-color: rgba(255, 255, 255, 0.6);
        cursor: pointer;
        transition: all 0.3s ease;
        padding: 1.5rem;
        text-align: center;
    }

    .file-input-custom:hover {
        border-color: var(--primary);
        background-color: rgba(15, 118, 110, 0.05);
    }

    /* Submit Button - Enhanced with Gallery Style */
    .submit-button {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.75rem;
        width: 100%;
        padding: 1.25rem 2.5rem;
        font-size: 1.125rem;
        font-weight: 700;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        color: white;
        border-radius: 1rem;
        box-shadow: 0 8px 25px rgba(15, 118, 110, 0.4);
        transition: all 0.4s ease;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border: none;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .submit-button::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.6s ease;
    }

    .submit-button:hover::before {
        left: 100%;
    }

    .submit-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(15, 118, 110, 0.5);
    }

    /* Success Alert - Enhanced */
    .alert-success {
        background: rgba(16, 185, 129, 0.1);
        border-left: 4px solid var(--accent);
        color: #065f46;
        padding: 1.5rem;
        border-radius: 1rem;
        margin-bottom: 2rem;
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    /* Form Sections */
    .form-section-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #e2e8f0;
        position: relative;
    }

    .form-section-title::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 60px;
        height: 2px;
        background: linear-gradient(90deg, var(--primary), var(--primary-light));
    }

    /* Grid Layout */
    .form-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    /* Error Styles */
    .error-text {
        color: #ef4444;
        font-size: 0.875rem;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* Helper Text */
    .helper-text {
        font-size: 0.875rem;
        color: var(--gray);
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* Hero Pattern Background */
    .hero-pattern {
        background-image:
            radial-gradient(circle at 20% 80%, rgba(13, 148, 136, 0.08) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(245, 158, 11, 0.05) 0%, transparent 50%),
            radial-gradient(circle at 40% 40%, rgba(15, 118, 110, 0.06) 0%, transparent 50%);
        background-size: 100% 100%;
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

        .form-container {
            padding: 2.5rem;
            border-radius: 2rem;
        }

        .form-grid {
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }

        .submit-button {
            padding: 1.5rem 3rem;
            font-size: 1.25rem;
            border-radius: 1.25rem;
        }
    }

    /* Desktop Devices (1024px and up) */
    @media (min-width: 1024px) {
        .page-title {
            font-size: 3.5rem;
        }

        .form-container {
            padding: 3rem 4rem;
            border-radius: 2.5rem;
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

        .form-container {
            padding: 1.5rem;
            border-radius: 1.25rem;
        }

        .form-input {
            padding: 0.875rem;
            font-size: 1rem;
        }

        .submit-button {
            padding: 1rem 2rem;
            font-size: 1rem;
        }
    }

    /* Extra Small Devices (360px and down) */
    @media (max-width: 360px) {
        .page-title {
            font-size: 1.75rem;
        }

        .page-subtitle {
            font-size: 0.9rem;
        }

        .form-container {
            padding: 1.25rem;
        }

        .form-section-title {
            font-size: 1.25rem;
        }
    }
</style>

<div class="main-wrapper hero-pattern">
    <div class="container">
        {{-- Enhanced Header with Floating Icon --}}
        <div class="page-header">
            <div class="floating-element inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-teal-500 to-teal-700 rounded-2xl shadow-lg mb-6">
                <i class="fas fa-headset text-white text-2xl"></i>
            </div>
            <h1 class="page-title">Layanan Pengaduan</h1>
            <p class="page-subtitle">Sampaikan aduan, aspirasi, atau keluhan Anda secara resmi dan terstruktur. Kerahasiaan data terjamin.</p>
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

        <div class="form-container-wrapper">
            {{-- Enhanced Success Notification --}}
            @if(session('success'))
                <div class="alert-success glass-card card-hover" role="alert">
                    <i class="fas fa-check-circle text-2xl text-green-500 mt-0.5"></i>
                    <div>
                        <p class="font-bold text-lg">Pengaduan Berhasil Dikirim!</p>
                        <p class="text-base mt-2">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            {{-- Enhanced Form Container --}}
            <form action="{{ route('layanan.pengaduan.store') }}" method="POST" enctype="multipart/form-data"
                  class="form-container glass-card card-hover">
                @csrf

                <h2 class="form-section-title">
                    <i class="fas fa-user-circle mr-3 text-teal-600"></i>
                    Detail Kontak Pelapor
                </h2>

                <div class="form-grid">
                    {{-- Nama Pengadu --}}
                    <div class="form-group">
                        <label for="nama_pengadu" class="block text-sm font-semibold text-gray-700 mb-3">
                            <i class="fas fa-user mr-2 text-teal-600"></i>
                            Nama Pengadu <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama_pengadu" name="nama_pengadu" value="{{ old('nama_pengadu') }}"
                               class="form-input"
                               placeholder="Nama lengkap Anda" required>
                        @error('nama_pengadu')
                            <p class="error-text">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="form-group">
                        <label for="email_pengadu" class="block text-sm font-semibold text-gray-700 mb-3">
                            <i class="fas fa-envelope mr-2 text-teal-600"></i>
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" id="email_pengadu" name="email_pengadu" value="{{ old('email_pengadu') }}"
                               class="form-input"
                               placeholder="Alamat email untuk balasan" required>
                        @error('email_pengadu')
                            <p class="error-text">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                {{-- Nomor HP --}}
                <div class="form-group mt-6">
                    <label for="no_hp_pengadu" class="block text-sm font-semibold text-gray-700 mb-3">
                        <i class="fas fa-phone mr-2 text-teal-600"></i>
                        Nomor HP / WhatsApp
                    </label>
                    <input type="text" id="no_hp_pengadu" name="no_hp_pengadu" value="{{ old('no_hp_pengadu') }}"
                           class="form-input"
                           placeholder="Contoh: 081234567890 (Opsional)">
                    <p class="helper-text">
                        <i class="fas fa-info-circle"></i>
                        Untuk respons yang lebih cepat melalui WhatsApp
                    </p>
                    @error('no_hp_pengadu')
                        <p class="error-text">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <hr class="border-gray-200 my-8">

                <h2 class="form-section-title">
                    <i class="fas fa-edit mr-3 text-teal-600"></i>
                    Isi Pengaduan
                </h2>

                {{-- Judul Pengaduan --}}
                <div class="form-group">
                    <label for="judul_pengaduan" class="block text-sm font-semibold text-gray-700 mb-3">
                        <i class="fas fa-heading mr-2 text-teal-600"></i>
                        Judul Pengaduan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="judul_pengaduan" name="judul_pengaduan" value="{{ old('judul_pengaduan') }}"
                           class="form-input"
                           placeholder="Contoh: Lampu Jalan Mati di RT 05" required>
                    @error('judul_pengaduan')
                        <p class="error-text">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Isi Pengaduan --}}
                <div class="form-group">
                    <label for="isi_pengaduan" class="block text-sm font-semibold text-gray-700 mb-3">
                        <i class="fas fa-align-left mr-2 text-teal-600"></i>
                        Isi Pengaduan <span class="text-red-500">*</span>
                    </label>
                    <textarea id="isi_pengaduan" name="isi_pengaduan" rows="6"
                              class="form-input"
                              placeholder="Jelaskan secara detail: lokasi, waktu kejadian, dan pihak terkait. Semakin detail, semakin cepat ditindaklanjuti."
                              required>{{ old('isi_pengaduan') }}</textarea>
                    <div id="char-counter" class="helper-text text-right mt-2">
                        <i class="fas fa-text-height"></i>
                        <span>0 karakter</span>
                    </div>
                    @error('isi_pengaduan')
                        <p class="error-text">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Lampiran --}}
                <div class="form-group">
                    <label for="url_lampiran" class="block text-sm font-semibold text-gray-700 mb-3">
                        <i class="fas fa-paperclip mr-2 text-teal-600"></i>
                        Lampiran Pendukung (Opsional)
                    </label>
                    <input type="file" id="url_lampiran" name="url_lampiran"
                           class="file-input-custom">
                    <p class="helper-text mt-3">
                        <i class="fas fa-info-circle"></i>
                        Format: JPG, PNG, PDF. Ukuran maks: 2MB. (Sertakan foto atau dokumen bukti)
                    </p>
                    @error('url_lampiran')
                        <p class="error-text">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Enhanced Submit Button --}}
                <div class="pt-8">
                    <button type="submit" class="submit-button">
                        <i class="fas fa-paper-plane"></i>
                        Kirim Pengaduan Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Enhanced Form Functionality
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const submitButton = document.querySelector('.submit-button');
        const textarea = document.getElementById('isi_pengaduan');
        const charCounter = document.getElementById('char-counter');

        // Form submission loading state
        form.addEventListener('submit', function() {
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengirim Pengaduan...';
            submitButton.disabled = true;
        });

        // Character counter for textarea
        if (textarea && charCounter) {
            const counterSpan = charCounter.querySelector('span');

            textarea.addEventListener('input', function() {
                const count = this.value.length;
                counterSpan.textContent = `${count} karakter`;

                // Change color based on length
                if (count < 50) {
                    charCounter.className = 'helper-text text-right mt-2 text-red-500';
                } else if (count < 200) {
                    charCounter.className = 'helper-text text-right mt-2 text-yellow-500';
                } else {
                    charCounter.className = 'helper-text text-right mt-2 text-green-500';
                }
            });
        }

        // File input enhancement
        const fileInput = document.querySelector('.file-input-custom');
        if (fileInput) {
            fileInput.addEventListener('change', function() {
                if (this.files.length > 0) {
                    const fileName = this.files[0].name;
                    this.style.borderColor = '#10b981';
                    this.style.backgroundColor = 'rgba(16, 185, 129, 0.1)';

                    // Update helper text
                    const helperText = this.nextElementSibling;
                    if (helperText) {
                        helperText.innerHTML = `<i class="fas fa-check-circle text-green-500"></i> File terpilih: ${fileName}`;
                    }
                }
            });
        }

        // Add focus effects to form inputs
        const inputs = document.querySelectorAll('.form-input');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('transform', 'scale-105');
            });

            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('transform', 'scale-105');
            });
        });
    });
</script>
@endsection
