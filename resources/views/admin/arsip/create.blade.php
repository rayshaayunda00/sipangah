@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-5xl">

    {{-- Header Section --}}
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Tambah Arsip Baru</h1>
            <p class="text-gray-500 mt-2 text-base">Lengkapi formulir di bawah untuk menambahkan dokumen ke arsip digital.</p>
        </div>
    </div>

    {{-- Form Card --}}
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <form action="{{ route('admin.arsip.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="p-6 md:p-8 space-y-8">

                {{-- Section 1: Informasi Dasar --}}
                <section>
                    <div class="flex items-center gap-2 mb-6 pb-4 border-b border-gray-100">
                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-sm">1</div>
                        <h3 class="text-lg font-semibold text-gray-900">Informasi Dokumen</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Nomor Arsip --}}
                        <div class="space-y-2">
                            <label for="nomor_arsip" class="block text-sm font-medium text-gray-700">Nomor Arsip</label>
                            <input type="text" id="nomor_arsip" name="nomor_arsip"
                                   class="w-full px-4 py-2.5 rounded-lg border-gray-300 bg-gray-50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all text-sm placeholder-gray-400"
                                   placeholder="Contoh: ARS/001/X/2024" value="{{ old('nomor_arsip') }}">
                            <p class="text-xs text-gray-500 flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" /></svg>
                                Biarkan kosong untuk auto-generate nomor.
                            </p>
                        </div>

                        {{-- Tanggal Arsip --}}
                        <div class="space-y-2">
                            <label for="tanggal_arsip" class="block text-sm font-medium text-gray-700">Tanggal Dokumen <span class="text-red-500">*</span></label>
                            <input type="date" id="tanggal_arsip" name="tanggal_arsip"
                                   class="w-full px-4 py-2.5 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all text-sm cursor-pointer"
                                   value="{{ old('tanggal_arsip', now()->format('Y-m-d')) }}" required>
                        </div>

                        {{-- Judul Arsip --}}
                        <div class="space-y-2 md:col-span-2">
                            <label for="judul_arsip" class="block text-sm font-medium text-gray-700">Judul Arsip <span class="text-red-500">*</span></label>
                            <input type="text" id="judul_arsip" name="judul_arsip"
                                   class="w-full px-4 py-2.5 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all text-sm placeholder-gray-400"
                                   placeholder="Contoh: Surat Keputusan Kepala Desa No. 10 Tahun 2024 Tentang Anggaran"
                                   value="{{ old('judul_arsip') }}" required>
                        </div>
                    </div>
                </section>

                {{-- Section 2: Klasifikasi --}}
                <section>
                    <div class="flex items-center gap-2 mb-6 pb-4 border-b border-gray-100">
                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-sm">2</div>
                        <h3 class="text-lg font-semibold text-gray-900">Klasifikasi & Kategori</h3>
                    </div>

                    <div class="space-y-6">
                        {{-- Kategori --}}
                        <div class="space-y-3">
                            <label class="block text-sm font-medium text-gray-700">Pilih Kategori <span class="text-red-500">*</span></label>

                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                                {{-- Surat Masuk --}}
                                <label class="group relative flex cursor-pointer rounded-xl border border-gray-200 bg-white p-4 shadow-sm hover:border-blue-500 hover:shadow-md transition-all duration-200">
                                    <input type="radio" name="kategori" value="Surat Masuk" class="sr-only" required>
                                    <span class="flex flex-1 items-start gap-3">
                                        <span class="flex-shrink-0 w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" /></svg>
                                        </span>
                                        <span class="flex flex-col">
                                            <span class="block text-sm font-semibold text-gray-900 group-hover:text-blue-700">Surat Masuk</span>
                                            <span class="mt-0.5 text-xs text-gray-500">Dari eksternal</span>
                                        </span>
                                    </span>
                                    <svg class="h-5 w-5 text-blue-600 absolute top-4 right-4 hidden check-icon" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                                </label>

                                {{-- Surat Keluar --}}
                                <label class="group relative flex cursor-pointer rounded-xl border border-gray-200 bg-white p-4 shadow-sm hover:border-green-500 hover:shadow-md transition-all duration-200">
                                    <input type="radio" name="kategori" value="Surat Keluar" class="sr-only">
                                    <span class="flex flex-1 items-start gap-3">
                                        <span class="flex-shrink-0 w-10 h-10 rounded-lg bg-green-50 flex items-center justify-center text-green-600 group-hover:bg-green-600 group-hover:text-white transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" /></svg>
                                        </span>
                                        <span class="flex flex-col">
                                            <span class="block text-sm font-semibold text-gray-900 group-hover:text-green-700">Surat Keluar</span>
                                            <span class="mt-0.5 text-xs text-gray-500">Ke eksternal</span>
                                        </span>
                                    </span>
                                    <svg class="h-5 w-5 text-green-600 absolute top-4 right-4 hidden check-icon" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                                </label>

                                {{-- Dokumen Penting --}}
                                <label class="group relative flex cursor-pointer rounded-xl border border-gray-200 bg-white p-4 shadow-sm hover:border-purple-500 hover:shadow-md transition-all duration-200">
                                    <input type="radio" name="kategori" value="Dokumen Penting" class="sr-only">
                                    <span class="flex flex-1 items-start gap-3">
                                        <span class="flex-shrink-0 w-10 h-10 rounded-lg bg-purple-50 flex items-center justify-center text-purple-600 group-hover:bg-purple-600 group-hover:text-white transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                        </span>
                                        <span class="flex flex-col">
                                            <span class="block text-sm font-semibold text-gray-900 group-hover:text-purple-700">Dokumen Penting</span>
                                            <span class="mt-0.5 text-xs text-gray-500">Arsip Internal</span>
                                        </span>
                                    </span>
                                    <svg class="h-5 w-5 text-purple-600 absolute top-4 right-4 hidden check-icon" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                                </label>

                                {{-- Lainnya --}}
                                <label class="group relative flex cursor-pointer rounded-xl border border-gray-200 bg-white p-4 shadow-sm hover:border-gray-500 hover:shadow-md transition-all duration-200">
                                    <input type="radio" name="kategori" value="Lainnya" class="sr-only">
                                    <span class="flex flex-1 items-start gap-3">
                                        <span class="flex-shrink-0 w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center text-gray-600 group-hover:bg-gray-600 group-hover:text-white transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                                        </span>
                                        <span class="flex flex-col">
                                            <span class="block text-sm font-semibold text-gray-900 group-hover:text-gray-700">Lainnya</span>
                                            <span class="mt-0.5 text-xs text-gray-500">Buat Baru</span>
                                        </span>
                                    </span>
                                    <svg class="h-5 w-5 text-gray-600 absolute top-4 right-4 hidden check-icon" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                                </label>
                            </div>

                            {{-- Input Text Kategori Custom (Hidden by default) --}}
                            <div id="customKategoriContainer" class="hidden mt-4 animate-fade-in-down">
                                <label for="kategori_lain" class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori Baru <span class="text-red-500">*</span></label>
                                <input type="text" id="kategori_lain" name="kategori_lain"
                                       class="w-full px-4 py-2.5 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all text-sm"
                                       placeholder="Contoh: Laporan Keuangan, Potensi Desa, Inventaris..." value="{{ old('kategori_lain') }}">
                            </div>
                        </div>

                        {{-- Deskripsi --}}
                        <div class="space-y-2">
                            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi Tambahan</label>
                            <textarea id="deskripsi" name="deskripsi" rows="4"
                                      class="w-full px-4 py-3 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all text-sm placeholder-gray-400"
                                      placeholder="Tambahkan catatan, ringkasan, atau keterangan penting mengenai dokumen ini...">{{ old('deskripsi') }}</textarea>
                        </div>
                    </div>
                </section>

                {{-- Section 3: Upload & Status --}}
                <section>
                    <div class="flex items-center gap-2 mb-6 pb-4 border-b border-gray-100">
                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-sm">3</div>
                        <h3 class="text-lg font-semibold text-gray-900">Lampiran & Status</h3>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        {{-- Upload File --}}
                        <div class="lg:col-span-2 space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Upload Dokumen</label>
                                <p class="text-xs text-gray-500 mb-3">Format: PDF, JPG, PNG (Max 10MB per file)</p>

                                <label for="file_lampiran" class="relative flex flex-col items-center justify-center w-full h-48 border-2 border-dashed border-gray-300 rounded-2xl cursor-pointer bg-gray-50 hover:bg-blue-50 hover:border-blue-400 transition-all group">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6 text-center px-4">
                                        <div class="p-3 bg-white rounded-full shadow-sm mb-3 group-hover:scale-110 group-hover:shadow-md transition-transform duration-300">
                                            <svg class="w-8 h-8 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                            </svg>
                                        </div>
                                        <p class="text-sm text-gray-600 font-medium"><span class="text-blue-600 hover:underline">Klik untuk upload</span> atau seret file ke sini</p>
                                        <p class="text-xs text-gray-400 mt-1">Bisa upload lebih dari satu file sekaligus</p>
                                    </div>
                                    <input id="file_lampiran" name="file_lampiran[]" type="file" multiple class="hidden" accept=".pdf,.jpg,.jpeg,.png">
                                </label>
                            </div>

                            {{-- Preview Container --}}
                            <div id="previewContainer" class="grid grid-cols-2 sm:grid-cols-3 gap-3"></div>
                        </div>

                        {{-- Status --}}
                        <div class="space-y-4">
                            <label class="block text-sm font-medium text-gray-700">Status Publikasi</label>
                            <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">Status Arsip</p>
                                        <p class="text-xs text-gray-500 mt-0.5">Aktifkan agar terlihat di sistem</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="status" value="Aktif" checked class="sr-only peer">
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                    </label>
                                </div>
                            </div>
                            <div class="bg-blue-50 p-4 rounded-xl border border-blue-100">
                                <p class="text-xs text-blue-700 leading-relaxed">
                                    <strong>Info:</strong> Pastikan semua data yang bertanda bintang (<span class="text-red-500">*</span>) sudah terisi dengan benar sebelum menyimpan.
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

            </div>

            {{-- Footer Actions --}}
            <div class="px-6 md:px-8 py-5 bg-gray-50 border-t border-gray-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.arsip.index') }}" class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 transition-all shadow-sm">
                    Batal
                </a>
                <button type="submit" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-md hover:shadow-lg transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                    Simpan Arsip
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<style>
    /* Styling Radio Button (Sama seperti sebelumnya) */
    input[type="radio"]:checked + span + svg.check-icon { display: block; }

    /* Input: Surat Masuk */
    input[type="radio"][value="Surat Masuk"]:checked ~ span span.text-gray-900 { color: #1d4ed8; }
    input[type="radio"][value="Surat Masuk"]:checked ~ span span.rounded-lg { background-color: #2563eb; color: white; }
    input[type="radio"][value="Surat Masuk"]:checked + span + svg { color: #2563eb; }
    input[type="radio"][value="Surat Masuk"]:checked ~ label { border-color: #3b82f6; background-color: #eff6ff; }

    /* Input: Surat Keluar */
    input[type="radio"][value="Surat Keluar"]:checked ~ span span.text-gray-900 { color: #15803d; }
    input[type="radio"][value="Surat Keluar"]:checked ~ span span.rounded-lg { background-color: #16a34a; color: white; }
    input[type="radio"][value="Surat Keluar"]:checked + span + svg { color: #16a34a; }
    input[type="radio"][value="Surat Keluar"]:checked ~ label { border-color: #22c55e; background-color: #f0fdf4; }

    /* Input: Dokumen Penting */
    input[type="radio"][value="Dokumen Penting"]:checked ~ span span.text-gray-900 { color: #7e22ce; }
    input[type="radio"][value="Dokumen Penting"]:checked ~ span span.rounded-lg { background-color: #9333ea; color: white; }
    input[type="radio"][value="Dokumen Penting"]:checked + span + svg { color: #9333ea; }
    input[type="radio"][value="Dokumen Penting"]:checked ~ label { border-color: #a855f7; background-color: #faf5ff; }

    /* Input: Lainnya */
    input[type="radio"][value="Lainnya"]:checked ~ span span.text-gray-900 { color: #374151; }
    input[type="radio"][value="Lainnya"]:checked ~ span span.rounded-lg { background-color: #4b5563; color: white; }
    input[type="radio"][value="Lainnya"]:checked + span + svg { color: #4b5563; }
    input[type="radio"][value="Lainnya"]:checked ~ label { border-color: #6b7280; background-color: #f9fafb; }

    .animate-fade-in-down { animation: fadeInDown 0.3s ease-out forwards; }
    @keyframes fadeInDown { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
</style>

<script>
    // --- 1. LOGIC RADIO BUTTON (KATEGORI) ---
    const radioInputs = document.querySelectorAll('input[type="radio"][name="kategori"]');
    const customContainer = document.getElementById('customKategoriContainer');
    const customInput = document.getElementById('kategori_lain');

    radioInputs.forEach(input => {
        input.addEventListener('change', function() {
            // Reset Style
            radioInputs.forEach(rb => {
                const label = rb.closest('label');
                label.classList.remove('ring-2', 'ring-blue-500', 'bg-blue-50', 'border-blue-500');
                label.classList.remove('ring-2', 'ring-green-500', 'bg-green-50', 'border-green-500');
                label.classList.remove('ring-2', 'ring-purple-500', 'bg-purple-50', 'border-purple-500');
                label.classList.remove('ring-2', 'ring-gray-500', 'bg-gray-50', 'border-gray-500');
                label.querySelector('.check-icon').classList.add('hidden');
            });

            // Set Active
            const activeLabel = this.closest('label');
            const icon = activeLabel.querySelector('.check-icon');
            icon.classList.remove('hidden');

            if(this.value === 'Surat Masuk') activeLabel.classList.add('ring-2', 'ring-blue-500', 'bg-blue-50', 'border-blue-500');
            else if (this.value === 'Surat Keluar') activeLabel.classList.add('ring-2', 'ring-green-500', 'bg-green-50', 'border-green-500');
            else if (this.value === 'Dokumen Penting') activeLabel.classList.add('ring-2', 'ring-purple-500', 'bg-purple-50', 'border-purple-500');
            else activeLabel.classList.add('ring-2', 'ring-gray-500', 'bg-gray-50', 'border-gray-500');

            // Custom Input
            if(this.value === 'Lainnya') {
                customContainer.classList.remove('hidden');
                customInput.setAttribute('required', 'required');
                setTimeout(() => customInput.focus(), 100);
            } else {
                customContainer.classList.add('hidden');
                customInput.removeAttribute('required');
            }
        });
    });

    // --- 2. LOGIC UPLOAD FILE (AKUMULATIF) ---
    const fileInput = document.getElementById('file_lampiran');
    const previewContainer = document.getElementById('previewContainer');

    // Variable penampung file (DataTransfer API)
    const dataTransfer = new DataTransfer();

    fileInput.addEventListener('change', function(e) {
        // Ambil file yang baru dipilih
        const newFiles = Array.from(e.target.files);

        // Masukkan file baru ke penampung 'dataTransfer'
        newFiles.forEach(file => {
            dataTransfer.items.add(file);
        });

        // Update input asli dengan data gabungan (lama + baru)
        fileInput.files = dataTransfer.files;

        // Render ulang tampilan preview
        renderPreview();
    });

    function renderPreview() {
        previewContainer.innerHTML = ''; // Reset tampilan container

        Array.from(dataTransfer.files).forEach((file, index) => {
            let iconType = '';

            if(file.type.startsWith('image/')) {
                const url = URL.createObjectURL(file);
                iconType = `<img src="${url}" class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-300">`;
            } else if(file.type === 'application/pdf') {
                iconType = `
                    <div class="h-full w-full flex flex-col items-center justify-center bg-red-50 text-red-500 p-2">
                        <svg class="w-8 h-8 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 2H7a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
                        <span class="text-[10px] font-bold uppercase">PDF</span>
                    </div>`;
            } else {
                iconType = `
                    <div class="h-full w-full flex flex-col items-center justify-center bg-gray-100 text-gray-500 p-2">
                        <svg class="w-8 h-8 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 2H7a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
                        <span class="text-[10px] font-bold uppercase">FILE</span>
                    </div>`;
            }

            const item = `
                <div class="relative group rounded-xl overflow-hidden border border-gray-200 aspect-[4/3] bg-white shadow-sm hover:shadow-md transition-all">
                    ${iconType}

                    {{-- Overlay Nama File --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-3 pointer-events-none">
                        <p class="text-white text-xs font-medium truncate w-full">${file.name}</p>
                    </div>

                    {{-- Tombol Hapus (X) --}}
                    <button type="button" onclick="removeFile(${index})" class="absolute top-2 right-2 bg-white text-red-500 hover:bg-red-50 rounded-full p-1 shadow-sm opacity-0 group-hover:opacity-100 transition-all scale-75 group-hover:scale-100 cursor-pointer z-10" title="Hapus File">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
            `;
            previewContainer.innerHTML += item;
        });
    }

    // Fungsi Hapus File dari List
    window.removeFile = function(index) {
        const dt = new DataTransfer();
        const currentFiles = dataTransfer.files;

        // Loop file yang ada, masukkan ke dt BARU kecuali file yang dihapus
        for (let i = 0; i < currentFiles.length; i++) {
            if (i !== index) {
                dt.items.add(currentFiles[i]);
            }
        }

        // Update DataTransfer Global & Input
        dataTransfer.items.clear();
        for (let i = 0; i < dt.files.length; i++) {
            dataTransfer.items.add(dt.files[i]);
        }
        fileInput.files = dataTransfer.files;

        // Render ulang
        renderPreview();
    }
</script>
@endpush
