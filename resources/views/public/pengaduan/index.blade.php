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

    /* * { ... } dan body { ... } harus berada di layout induk (layouts.app) agar konsisten */

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


    /* Style untuk form container */
    .form-container {
        background: white;
        border-radius: 1.5rem;
        padding: 2rem; /* Sedikit dikurangi untuk mobile */
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12); /* Shadow lebih kuat */
        border: 1px solid rgba(255, 255, 255, 0.8);
        transition: all 0.3s ease;
    }
    .form-container:hover {
        transform: translateY(-3px);
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
    }
    /* MEDIA QUERY: Form untuk Desktop */
    @media (min-width: 768px) {
        .form-container {
            padding: 2.5rem 3rem; /* Padding lebih besar di desktop */
        }
    }


    /* Style untuk input dan textarea */
    .form-input {
        border-color: #d1d5db;
        border-radius: 0.5rem;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        padding: 0.75rem 1rem; /* Padding ditingkatkan */
        transition: all 0.15s ease;
        line-height: 1.5; /* Memastikan teks di dalam input/textarea rapi */
    }
    .form-input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(124, 58, 237, 0.3); /* Ring lebih lembut */
        outline: none;
    }

    /* Style untuk input file (lampiran) yang disinkronkan */
    .file-input-custom {
        display: block; width: 100%; font-size: 0.875rem; color: var(--gray);
        border: 1px solid #d1d5db; border-radius: 0.5rem; background-color: #fff;
        cursor: pointer; transition: all 0.15s ease;
        padding: 0.5rem; /* Memberi jarak agar tidak terlalu rapat */
    }

    /* Style Tombol Submit */
    .submit-button {
        display: flex; /* Tambahkan flex untuk mengatur ikon/teks jika ada */
        justify-content: center;
        align-items: center;
        gap: 0.5rem;
        width: 100%; padding: 0.8rem 2rem; font-size: 1rem; font-weight: 700;
        background: var(--primary); color: white; border-radius: 0.75rem; /* Sedikit lebih kecil dari container */
        box-shadow: 0 8px 20px rgba(124, 58, 237, 0.4);
        transition: all 0.3s ease;
        text-transform: uppercase; /* Tambahan visual */
        letter-spacing: 0.05em;
    }
    .submit-button:hover {
        background: var(--primary-dark);
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(124, 58, 237, 0.5);
    }
    /* Tombol untuk Desktop */
    @media (min-width: 768px) {
        .submit-button {
            padding: 1rem 2.5rem;
            font-size: 1.125rem;
            border-radius: 1rem;
        }
    }

    /* Error Text Style */
    .text-red-500 {
        color: #ef4444;
    }
    .text-gray-700 {
        color: #374151;
    }
</style>

<div class="main-wrapper">
    <div class="container">
        {{-- Header --}}
        <div class="page-header">
            <h1 class="page-title">Layanan Pengaduan</h1>
            <p class="page-subtitle">Sampaikan aduan, aspirasi, atau keluhan Anda secara resmi dan terstruktur. Kerahasiaan data terjamin.</p>
        </div>

        {{-- Tombol navigasi di atas form --}}
        <div class="max-w-4xl mx-auto mb-6 flex space-x-4">
            <a href="{{ route('layanan.pengaduan') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded flex items-center space-x-2">
                <i class="fas fa-edit"></i>
                <span>Form Pengaduan</span>
            </a>

            <a href="{{ route('layanan.pengaduan.riwayat') }}"
               class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded flex items-center space-x-2">
                <i class="fas fa-history"></i>
                <span>Riwayat Pengaduan</span>
            </a>
        </div>

        <div class="max-w-4xl mx-auto">
            {{-- Notifikasi Sukses --}}
            @if(session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 text-green-800 p-4 rounded-lg mb-8 shadow-md flex items-center" role="alert">
                    <i class="fas fa-check-circle text-xl mr-3"></i>
                    <div>
                        <p class="font-bold">Pengaduan Berhasil Dikirim!</p>
                        <p class="text-sm mt-1">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            {{-- Form Pengaduan --}}
            <form action="{{ route('layanan.pengaduan.store') }}" method="POST" enctype="multipart/form-data"
                  class="form-container space-y-6">
                @csrf

                <h2 class="text-xl font-bold text-gray-800 mb-4 border-b pb-3 border-gray-100">Detail Kontak Pelapor</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Nama Pengadu --}}
                    <div>
                        <label for="nama_pengadu" class="block text-sm font-semibold text-gray-700 mb-1">Nama Pengadu <span class="text-red-500">*</span></label>
                        <input type="text" id="nama_pengadu" name="nama_pengadu" value="{{ old('nama_pengadu') }}"
                               class="w-full form-input"
                               placeholder="Nama lengkap Anda (Wajib)" required>
                        @error('nama_pengadu')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email_pengadu" class="block text-sm font-semibold text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                        <input type="email" id="email_pengadu" name="email_pengadu" value="{{ old('email_pengadu') }}"
                               class="w-full form-input"
                               placeholder="Alamat email untuk balasan" required>
                        @error('email_pengadu')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Nomor HP --}}
                <div>
                    <label for="no_hp_pengadu" class="block text-sm font-semibold text-gray-700 mb-1">Nomor HP / WhatsApp</label>
                    <input type="text" id="no_hp_pengadu" name="no_hp_pengadu" value="{{ old('no_hp_pengadu') }}"
                           class="w-full form-input"
                           placeholder="Contoh: 081234567890 (Opsional, untuk respons cepat)">
                    @error('no_hp_pengadu')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <hr class="border-gray-200/50 my-6">

                <h2 class="text-xl font-bold text-gray-800 mb-4 border-b pb-3 border-gray-100">Isi Pengaduan</h2>

                {{-- Judul Pengaduan --}}
                <div>
                    <label for="judul_pengaduan" class="block text-sm font-semibold text-gray-700 mb-1">Judul Pengaduan <span class="text-red-500">*</span></label>
                    <input type="text" id="judul_pengaduan" name="judul_pengaduan" value="{{ old('judul_pengaduan') }}"
                           class="w-full form-input"
                           placeholder="Contoh: Lampu Jalan Mati di RT 05" required>
                    @error('judul_pengaduan')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Isi Pengaduan --}}
                <div>
                    <label for="isi_pengaduan" class="block text-sm font-semibold text-gray-700 mb-1">Isi Pengaduan <span class="text-red-500">*</span></label>
                    <textarea id="isi_pengaduan" name="isi_pengaduan" rows="6"
                              class="w-full form-input"
                              placeholder="Jelaskan secara detail: lokasi, waktu kejadian, dan pihak terkait. Semakin detail, semakin cepat ditindaklanjuti." required>{{ old('isi_pengaduan') }}</textarea>
                    @error('isi_pengaduan')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Lampiran --}}
                <div>
                    <label for="url_lampiran" class="block text-sm font-semibold text-gray-700 mb-1">Lampiran Pendukung (Opsional)</label>
                    <input type="file" id="url_lampiran" name="url_lampiran"
                           class="file-input-custom">
                    <p class="text-xs text-gray-500 mt-1">
                        Format: JPG, PNG, PDF. Ukuran maks: 2MB. (Sertakan foto atau dokumen bukti)
                    </p>
                    @error('url_lampiran')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
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
@endsection
