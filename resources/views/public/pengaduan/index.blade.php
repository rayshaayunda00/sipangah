@extends('layouts.app')

@section('title', 'Layanan Pengaduan')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    /* Variabel CSS yang Didefinisikan di Halaman Layanan Administrasi */
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
        padding: 4rem 0 3rem;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    /* Header Styles */
    .page-header {
        text-align: center;
        margin-bottom: 2rem;
        padding: 1.5rem 0;
    }
    .page-title {
        font-size: 2rem;
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
        font-size: 0.95rem;
        color: var(--gray);
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.5;
    }

    /* Navigation Tabs */
    .nav-tabs-container {
        max-width: 48rem;
        margin: 0 auto 2.5rem;
    }
    .nav-tabs {
        display: flex;
        border-radius: 9999px;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        background: white;
    }
    .nav-tab {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 0.75rem;
        font-weight: 600;
        font-size: 0.875rem;
        transition: all 0.3s;
        text-decoration: none;
        border: none;
        cursor: pointer;
    }
    .nav-tab.active {
        background: linear-gradient(to right, #6366f1, #8b5cf6, #ec4899);
        color: white;
    }
    .nav-tab:not(.active) {
        background: white;
        color: #1f2937;
    }
    .nav-tab:not(.active):hover {
        color: #7c3aed;
    }

    /* Form Container */
    .form-container {
        background: white;
        border-radius: 1rem;
        padding: 1.5rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.8);
        transition: all 0.3s ease;
        margin: 0 auto;
        max-width: 56rem;
    }
    .form-container:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
    }

    /* Form Input Styles */
    .form-input {
        border: 1px solid #d1d5db;
        border-radius: 0.5rem;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        padding: 0.75rem;
        transition: all 0.15s ease;
        line-height: 1.5;
        width: 100%;
        font-size: 0.95rem;
    }
    .form-input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.2);
        outline: none;
    }

    /* File Input */
    .file-input-custom {
        display: block;
        width: 100%;
        font-size: 0.875rem;
        color: var(--gray);
        border: 1px solid #d1d5db;
        border-radius: 0.5rem;
        background-color: #fff;
        cursor: pointer;
        transition: all 0.15s ease;
        padding: 0.75rem;
    }
    .file-input-custom:hover {
        border-color: var(--primary);
    }

    /* Submit Button */
    .submit-button {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.5rem;
        width: 100%;
        padding: 0.875rem 2rem;
        font-size: 1rem;
        font-weight: 700;
        background: var(--primary);
        color: white;
        border-radius: 0.75rem;
        box-shadow: 0 8px 20px rgba(124, 58, 237, 0.4);
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border: none;
        cursor: pointer;
    }
    .submit-button:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: 0 12px 25px rgba(124, 58, 237, 0.5);
    }

    /* Success Alert */
    .alert-success {
        background-color: #f0fdf4;
        border-left: 4px solid #10b981;
        color: #065f46;
        padding: 1rem;
        border-radius: 0.5rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
    }

    /* Form Sections */
    .form-section-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 1rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid #e2e8f0;
    }

    /* Grid Layout */
    .form-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.25rem;
    }

    /* Error Styles */
    .error-text {
        color: #ef4444;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

    /* Helper Text */
    .helper-text {
        font-size: 0.75rem;
        color: var(--gray);
        margin-top: 0.25rem;
    }

    /* ========== RESPONSIVE DESIGN ========== */

    /* Tablet Devices (768px and up) */
    @media (min-width: 768px) {
        .main-wrapper {
            padding: 5rem 0 4rem;
        }

        .container {
            padding: 0 1.5rem;
        }

        .page-header {
            padding: 2rem 0;
        }

        .page-title {
            font-size: 2.5rem;
        }

        .page-subtitle {
            font-size: 1.125rem;
        }

        .nav-tab {
            padding: 1rem;
            font-size: 1rem;
        }

        .form-container {
            padding: 2rem;
            border-radius: 1.25rem;
        }

        .form-grid {
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }

        .submit-button {
            padding: 1rem 2.5rem;
            font-size: 1.125rem;
            border-radius: 1rem;
        }
    }

    /* Desktop Devices (1024px and up) */
    @media (min-width: 1024px) {
        .page-title {
            font-size: 3rem;
        }

        .form-container {
            padding: 2.5rem 3rem;
            border-radius: 1.5rem;
        }
    }

    /* Small Mobile Devices (480px and down) */
    @media (max-width: 480px) {
        .main-wrapper {
            padding: 3rem 0 2rem;
        }

        .container {
            padding: 0 0.75rem;
        }

        .page-title {
            font-size: 1.75rem;
        }

        .page-subtitle {
            font-size: 0.875rem;
        }

        .nav-tabs {
            flex-direction: column;
            border-radius: 1rem;
        }

        .nav-tab {
            border-radius: 0.5rem;
            margin: 0.125rem;
        }

        .form-container {
            padding: 1.25rem;
            border-radius: 0.875rem;
        }

        .form-input {
            padding: 0.625rem;
            font-size: 0.9rem;
        }

        .submit-button {
            padding: 0.75rem 1.5rem;
            font-size: 0.95rem;
        }
    }

    /* Extra Small Devices (360px and down) */
    @media (max-width: 360px) {
        .page-title {
            font-size: 1.5rem;
        }

        .page-subtitle {
            font-size: 0.8rem;
        }

        .form-container {
            padding: 1rem;
        }

        .form-section-title {
            font-size: 1.125rem;
        }
    }
</style>

<div class="main-wrapper">
    <div class="container">
        {{-- Header --}}
        <div class="page-header">
            <h1 class="page-title">Layanan Pengaduan</h1>
            <p class="page-subtitle">Sampaikan aduan, aspirasi, atau keluhan Anda secara resmi dan terstruktur. Kerahasiaan data terjamin.</p>
        </div>

        {{-- Navigation Tabs --}}
        <div class="nav-tabs-container">
            <div class="nav-tabs">
                <a href="{{ route('layanan.pengaduan') }}"
                   class="nav-tab {{ request()->routeIs('layanan.pengaduan') ? 'active' : '' }}">
                    <i class="fas fa-pen-to-square {{ request()->routeIs('layanan.pengaduan') ? 'text-white' : 'text-purple-500' }}"></i>
                    <span>Buat Pengaduan</span>
                </a>
                <a href="{{ route('layanan.pengaduan.riwayat') }}"
                   class="nav-tab {{ request()->routeIs('layanan.pengaduan.riwayat') ? 'active' : '' }}">
                    <i class="fas fa-clock {{ request()->routeIs('layanan.pengaduan.riwayat') ? 'text-white' : 'text-sky-500' }}"></i>
                    <span>Riwayat Pengaduan</span>
                </a>
            </div>
        </div>

        <div class="form-container-wrapper">
            {{-- Notifikasi Sukses --}}
            @if(session('success'))
                <div class="alert-success" role="alert">
                    <i class="fas fa-check-circle text-lg mt-0.5"></i>
                    <div>
                        <p class="font-bold">Pengaduan Berhasil Dikirim!</p>
                        <p class="text-sm mt-1">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            {{-- Form Pengaduan --}}
            <form action="{{ route('layanan.pengaduan.store') }}" method="POST" enctype="multipart/form-data"
                  class="form-container">
                @csrf

                <h2 class="form-section-title">Detail Kontak Pelapor</h2>

                <div class="form-grid">
                    {{-- Nama Pengadu --}}
                    <div class="form-group">
                        <label for="nama_pengadu" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Pengadu <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama_pengadu" name="nama_pengadu" value="{{ old('nama_pengadu') }}"
                               class="form-input"
                               placeholder="Nama lengkap Anda" required>
                        @error('nama_pengadu')
                            <p class="error-text">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="form-group">
                        <label for="email_pengadu" class="block text-sm font-semibold text-gray-700 mb-2">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" id="email_pengadu" name="email_pengadu" value="{{ old('email_pengadu') }}"
                               class="form-input"
                               placeholder="Alamat email untuk balasan" required>
                        @error('email_pengadu')
                            <p class="error-text">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Nomor HP --}}
                <div class="form-group mt-4">
                    <label for="no_hp_pengadu" class="block text-sm font-semibold text-gray-700 mb-2">
                        Nomor HP / WhatsApp
                    </label>
                    <input type="text" id="no_hp_pengadu" name="no_hp_pengadu" value="{{ old('no_hp_pengadu') }}"
                           class="form-input"
                           placeholder="Contoh: 081234567890 (Opsional)">
                    <p class="helper-text">Untuk respons yang lebih cepat melalui WhatsApp</p>
                    @error('no_hp_pengadu')
                        <p class="error-text">{{ $message }}</p>
                    @enderror
                </div>

                <hr class="border-gray-200 my-6">

                <h2 class="form-section-title">Isi Pengaduan</h2>

                {{-- Judul Pengaduan --}}
                <div class="form-group">
                    <label for="judul_pengaduan" class="block text-sm font-semibold text-gray-700 mb-2">
                        Judul Pengaduan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="judul_pengaduan" name="judul_pengaduan" value="{{ old('judul_pengaduan') }}"
                           class="form-input"
                           placeholder="Contoh: Lampu Jalan Mati di RT 05" required>
                    @error('judul_pengaduan')
                        <p class="error-text">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Isi Pengaduan --}}
                <div class="form-group">
                    <label for="isi_pengaduan" class="block text-sm font-semibold text-gray-700 mb-2">
                        Isi Pengaduan <span class="text-red-500">*</span>
                    </label>
                    <textarea id="isi_pengaduan" name="isi_pengaduan" rows="6"
                              class="form-input"
                              placeholder="Jelaskan secara detail: lokasi, waktu kejadian, dan pihak terkait. Semakin detail, semakin cepat ditindaklanjuti."
                              required>{{ old('isi_pengaduan') }}</textarea>
                    @error('isi_pengaduan')
                        <p class="error-text">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Lampiran --}}
                <div class="form-group">
                    <label for="url_lampiran" class="block text-sm font-semibold text-gray-700 mb-2">
                        Lampiran Pendukung (Opsional)
                    </label>
                    <input type="file" id="url_lampiran" name="url_lampiran"
                           class="file-input-custom">
                    <p class="helper-text">
                        Format: JPG, PNG, PDF. Ukuran maks: 2MB. (Sertakan foto atau dokumen bukti)
                    </p>
                    @error('url_lampiran')
                        <p class="error-text">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tombol Kirim --}}
                <div class="pt-6">
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
    // Form validation enhancement
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const submitButton = document.querySelector('.submit-button');

        form.addEventListener('submit', function() {
            // Add loading state
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengirim...';
            submitButton.disabled = true;
        });

        // Character counter for textarea
        const textarea = document.getElementById('isi_pengaduan');
        if (textarea) {
            const counter = document.createElement('div');
            counter.className = 'helper-text text-right mt-1';
            counter.textContent = '0 karakter';
            textarea.parentNode.appendChild(counter);

            textarea.addEventListener('input', function() {
                counter.textContent = `${this.value.length} karakter`;
            });
        }
    });
</script>
@endsection
