@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <div class="space-y-6">
        {{-- Header Section --}}
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Tambah Arsip Baru</h1>
                <p class="text-gray-500 mt-1">Isi formulir di bawah untuk menambahkan dokumen ke arsip desa</p>
            </div>
        </div>

        {{-- Form Card --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <form action="{{ route('admin.arsip.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="p-6 md:p-8 space-y-8">
                    {{-- Section: Informasi Utama --}}
                    <div class="space-y-6">
                        <div class="pb-2 border-b border-gray-100">
                            <h3 class="text-lg font-semibold text-gray-900">Informasi Dokumen</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Nomor Arsip --}}
                            <div class="space-y-2">
                                <label for="nomor_arsip" class="text-sm font-medium text-gray-700">Nomor Arsip</label>
                                <div class="relative">
                                    <input type="text" id="nomor_arsip" name="nomor_arsip"
                                           class="w-full rounded-lg border-gray-300 bg-gray-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 transition-colors text-sm py-2.5"
                                           placeholder="Auto-generate jika kosong" value="{{ old('nomor_arsip') }}">
                                </div>
                                <p class="text-xs text-gray-500">Kosongkan untuk dibuat otomatis oleh sistem.</p>
                            </div>

                            {{-- Tanggal Arsip --}}
                            <div class="space-y-2">
                                <label for="tanggal_arsip" class="text-sm font-medium text-gray-700">Tanggal Arsip <span class="text-red-500">*</span></label>
                                <input type="date" id="tanggal_arsip" name="tanggal_arsip"
                                       class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm py-2.5"
                                       value="{{ old('tanggal_arsip', now()->format('Y-m-d')) }}" required>
                            </div>

                            {{-- Judul Arsip --}}
                            <div class="space-y-2 md:col-span-2">
                                <label for="judul_arsip" class="text-sm font-medium text-gray-700">Judul Arsip <span class="text-red-500">*</span></label>
                                <input type="text" id="judul_arsip" name="judul_arsip"
                                       class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm py-2.5"
                                       placeholder="Contoh: Surat Keputusan Kepala Desa No. 10 Tahun 2024"
                                       value="{{ old('judul_arsip') }}" required>
                            </div>

                            {{-- Kategori --}}
                            <div class="space-y-2 md:col-span-2">
                                <label class="text-sm font-medium text-gray-700">Kategori Dokumen <span class="text-red-500">*</span></label>
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                    <label class="relative flex cursor-pointer rounded-lg border bg-white p-4 shadow-sm focus:outline-none hover:border-blue-500 hover:ring-1 hover:ring-blue-500">
                                        <input type="radio" name="kategori" value="Surat Masuk" class="sr-only" required>
                                        <span class="flex flex-1">
                                            <span class="flex flex-col">
                                                <span class="block text-sm font-medium text-gray-900">Surat Masuk</span>
                                                <span class="mt-1 flex items-center text-xs text-gray-500">Dari instansi luar</span>
                                            </span>
                                        </span>
                                        <svg class="h-5 w-5 text-blue-600 hidden check-icon" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                    </label>

                                    <label class="relative flex cursor-pointer rounded-lg border bg-white p-4 shadow-sm focus:outline-none hover:border-green-500 hover:ring-1 hover:ring-green-500">
                                        <input type="radio" name="kategori" value="Surat Keluar" class="sr-only">
                                        <span class="flex flex-1">
                                            <span class="flex flex-col">
                                                <span class="block text-sm font-medium text-gray-900">Surat Keluar</span>
                                                <span class="mt-1 flex items-center text-xs text-gray-500">Ke instansi luar</span>
                                            </span>
                                        </span>
                                        <svg class="h-5 w-5 text-green-600 hidden check-icon" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                    </label>

                                    <label class="relative flex cursor-pointer rounded-lg border bg-white p-4 shadow-sm focus:outline-none hover:border-purple-500 hover:ring-1 hover:ring-purple-500">
                                        <input type="radio" name="kategori" value="Dokumen Penting" class="sr-only">
                                        <span class="flex flex-1">
                                            <span class="flex flex-col">
                                                <span class="block text-sm font-medium text-gray-900">Dokumen Penting</span>
                                                <span class="mt-1 flex items-center text-xs text-gray-500">Arsip internal desa</span>
                                            </span>
                                        </span>
                                        <svg class="h-5 w-5 text-purple-600 hidden check-icon" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                    </label>
                                </div>
                            </div>

                            {{-- Deskripsi --}}
                            <div class="space-y-2 md:col-span-2">
                                <label for="deskripsi" class="text-sm font-medium text-gray-700">Deskripsi Tambahan</label>
                                <textarea id="deskripsi" name="deskripsi" rows="3"
                                          class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm"
                                          placeholder="Tambahkan catatan atau ringkasan isi dokumen...">{{ old('deskripsi') }}</textarea>
                            </div>
                        </div>
                    </div>

                    {{-- Section: Upload File --}}
                    <div class="space-y-6 pt-6 border-t border-gray-100">
                        <div class="pb-2">
                            <h3 class="text-lg font-semibold text-gray-900">Lampiran Dokumen</h3>
                            <p class="text-sm text-gray-500">Unggah file digital arsip di sini (PDF, JPG, PNG)</p>
                        </div>

                        <div class="grid gap-4">
                            <label for="file_lampiran" class="relative flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors group">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <div class="p-3 bg-white rounded-full shadow-sm mb-3 group-hover:scale-110 transition-transform">
                                        <svg class="w-8 h-8 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                        </svg>
                                    </div>
                                    <p class="text-sm text-gray-600"><span class="font-semibold text-blue-600">Klik untuk upload</span> atau seret file ke sini</p>
                                    <p class="text-xs text-gray-400 mt-1">Maksimal 10MB per file</p>
                                </div>
                                <input id="file_lampiran" name="file_lampiran[]" type="file" multiple class="hidden" accept=".pdf,.jpg,.jpeg,.png">
                            </label>

                            {{-- Preview Area --}}
                            <div id="previewContainer" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4"></div>
                        </div>
                    </div>

                    {{-- Section: Status --}}
                    <div class="space-y-4 pt-6 border-t border-gray-100">
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200">
                            <div>
                                <label class="text-sm font-medium text-gray-900">Status Arsip</label>
                                <p class="text-xs text-gray-500">Aktifkan agar arsip dapat diakses oleh publik/petugas</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="status" value="Aktif" checked class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                            </label>
                        </div>
                    </div>
                </div>

                {{-- Footer Actions --}}
                <div class="px-6 md:px-8 py-4 bg-gray-50 border-t border-gray-200 flex items-center justify-end gap-3">
                    <a href="{{ route('admin.arsip.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 transition-colors">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center justify-center gap-2 px-6 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                        Simpan Arsip
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<style>
    /* Custom style for radio button selection highlighting */
    input[type="radio"]:checked + span + svg.check-icon {
        display: block;
    }
    input[type="radio"]:checked + span {
        color: #2563eb;
    }
    input[type="radio"]:checked ~ label {
        border-color: #3b82f6;
        background-color: #eff6ff;
    }
</style>
<script>
    // Simple script to toggle visual state of radio buttons
    const radioInputs = document.querySelectorAll('input[type="radio"][name="kategori"]');
    radioInputs.forEach(input => {
        input.addEventListener('change', function() {
            // Reset all parent labels
            radioInputs.forEach(rb => {
                const label = rb.closest('label');
                label.classList.remove('border-blue-500', 'ring-1', 'ring-blue-500', 'bg-blue-50',
                                     'border-green-500', 'ring-green-500', 'bg-green-50',
                                     'border-purple-500', 'ring-purple-500', 'bg-purple-50');
                label.querySelector('.check-icon').classList.add('hidden');
            });

            // Set active state
            const activeLabel = this.closest('label');
            const icon = activeLabel.querySelector('.check-icon');
            icon.classList.remove('hidden');

            if(this.value === 'Surat Masuk') {
                activeLabel.classList.add('border-blue-500', 'ring-1', 'ring-blue-500', 'bg-blue-50');
            } else if (this.value === 'Surat Keluar') {
                activeLabel.classList.add('border-green-500', 'ring-1', 'ring-green-500', 'bg-green-50');
            } else {
                activeLabel.classList.add('border-purple-500', 'ring-1', 'ring-purple-500', 'bg-purple-50');
            }
        });
    });

    // File Preview Script
    document.getElementById('file_lampiran').addEventListener('change', function(e){
        const container = document.getElementById('previewContainer');
        container.innerHTML = '';
        Array.from(e.target.files).forEach(file => {
            const isImage = file.type.startsWith('image/');
            const icon = isImage
                ? `<img src="${URL.createObjectURL(file)}" class="h-full w-full object-cover">`
                : `<div class="h-full w-full flex items-center justify-center bg-gray-100 text-gray-400"><svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg></div>`;

            const item = `
                <div class="relative group rounded-lg overflow-hidden border border-gray-200 aspect-square bg-white shadow-sm">
                    ${icon}
                    <div class="absolute inset-0 bg-black/40 flex items-end p-2 opacity-0 group-hover:opacity-100 transition-opacity">
                        <p class="text-white text-xs truncate w-full">${file.name}</p>
                    </div>
                </div>
            `;
            container.innerHTML += item;
        });
    });
</script>
@endpush
