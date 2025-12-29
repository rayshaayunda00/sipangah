@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-5xl">

    {{-- Header Section --}}
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Edit Arsip</h1>
            <p class="text-gray-500 mt-2 text-base">Perbarui informasi dokumen #{{ $arsip->nomor_arsip }}</p>
        </div>
        <a href="{{ route('admin.arsip.index') }}" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 transition-all shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali
        </a>
    </div>

    {{-- Form Card --}}
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <form action="{{ route('admin.arsip.update', $arsip->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Container untuk menampung path file yang dihapus --}}
            <div id="deletedFilesContainer"></div>

            <div class="p-6 md:p-8 space-y-8">

                {{-- Section 1: Informasi Dokumen --}}
                <section>
                    <div class="flex items-center gap-2 mb-6 pb-4 border-b border-gray-100">
                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-sm">1</div>
                        <h3 class="text-lg font-semibold text-gray-900">Detail Dokumen</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Nomor Arsip --}}
                        <div class="space-y-2">
                            <label for="nomor_arsip" class="block text-sm font-medium text-gray-700">Nomor Arsip</label>
                            <input type="text" name="nomor_arsip" value="{{ old('nomor_arsip', $arsip->nomor_arsip) }}"
                                   class="w-full px-4 py-2.5 rounded-lg border-gray-300 bg-gray-50 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all text-sm">
                        </div>

                        {{-- Tanggal Arsip --}}
                        <div class="space-y-2">
                            <label for="tanggal_arsip" class="block text-sm font-medium text-gray-700">Tanggal Arsip</label>
                            <input type="date" name="tanggal_arsip" value="{{ old('tanggal_arsip', $arsip->tanggal_arsip->format('Y-m-d')) }}" required
                                   class="w-full px-4 py-2.5 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all text-sm cursor-pointer">
                        </div>

                        {{-- Judul Arsip --}}
                        <div class="space-y-2 md:col-span-2">
                            <label for="judul_arsip" class="block text-sm font-medium text-gray-700">Judul Arsip</label>
                            <input type="text" name="judul_arsip" value="{{ old('judul_arsip', $arsip->judul_arsip) }}" required
                                   class="w-full px-4 py-2.5 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all text-sm">
                        </div>
                    </div>
                </section>

                {{-- Section 2: Kategori --}}
                <section>
                    <div class="flex items-center gap-2 mb-6 pb-4 border-b border-gray-100">
                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-sm">2</div>
                        <h3 class="text-lg font-semibold text-gray-900">Klasifikasi</h3>
                    </div>

                    <div class="space-y-6">
                        <div class="space-y-3">
                            <label class="block text-sm font-medium text-gray-700">Kategori Dokumen</label>

                            @php
                                $standardCategories = ['Surat Masuk', 'Surat Keluar', 'Dokumen Penting'];
                                $isCustom = !in_array($arsip->kategori, $standardCategories);
                                $currentKategori = $isCustom ? 'Lainnya' : $arsip->kategori;
                                $customValue = $isCustom ? $arsip->kategori : '';
                            @endphp

                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                                {{-- Surat Masuk --}}
                                <label class="group relative flex cursor-pointer rounded-xl border border-gray-200 bg-white p-4 shadow-sm hover:border-blue-500 hover:shadow-md transition-all duration-200">
                                    <input type="radio" name="kategori" value="Surat Masuk" {{ $currentKategori == 'Surat Masuk' ? 'checked' : '' }} class="sr-only">
                                    <span class="flex flex-1 items-start gap-3">
                                        <span class="flex-shrink-0 w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" /></svg>
                                        </span>
                                        <span class="block text-sm font-semibold text-gray-900 group-hover:text-blue-700">Surat Masuk</span>
                                    </span>
                                    <svg class="h-5 w-5 text-blue-600 absolute top-4 right-4 {{ $currentKategori == 'Surat Masuk' ? '' : 'hidden' }} check-icon" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                                </label>

                                {{-- Surat Keluar --}}
                                <label class="group relative flex cursor-pointer rounded-xl border border-gray-200 bg-white p-4 shadow-sm hover:border-green-500 hover:shadow-md transition-all duration-200">
                                    <input type="radio" name="kategori" value="Surat Keluar" {{ $currentKategori == 'Surat Keluar' ? 'checked' : '' }} class="sr-only">
                                    <span class="flex flex-1 items-start gap-3">
                                        <span class="flex-shrink-0 w-10 h-10 rounded-lg bg-green-50 flex items-center justify-center text-green-600 group-hover:bg-green-600 group-hover:text-white transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" /></svg>
                                        </span>
                                        <span class="block text-sm font-semibold text-gray-900 group-hover:text-green-700">Surat Keluar</span>
                                    </span>
                                    <svg class="h-5 w-5 text-green-600 absolute top-4 right-4 {{ $currentKategori == 'Surat Keluar' ? '' : 'hidden' }} check-icon" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                                </label>

                                {{-- Dokumen Penting --}}
                                <label class="group relative flex cursor-pointer rounded-xl border border-gray-200 bg-white p-4 shadow-sm hover:border-purple-500 hover:shadow-md transition-all duration-200">
                                    <input type="radio" name="kategori" value="Dokumen Penting" {{ $currentKategori == 'Dokumen Penting' ? 'checked' : '' }} class="sr-only">
                                    <span class="flex flex-1 items-start gap-3">
                                        <span class="flex-shrink-0 w-10 h-10 rounded-lg bg-purple-50 flex items-center justify-center text-purple-600 group-hover:bg-purple-600 group-hover:text-white transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                        </span>
                                        <span class="block text-sm font-semibold text-gray-900 group-hover:text-purple-700">Dokumen Penting</span>
                                    </span>
                                    <svg class="h-5 w-5 text-purple-600 absolute top-4 right-4 {{ $currentKategori == 'Dokumen Penting' ? '' : 'hidden' }} check-icon" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                                </label>

                                {{-- Lainnya --}}
                                <label class="group relative flex cursor-pointer rounded-xl border border-gray-200 bg-white p-4 shadow-sm hover:border-gray-500 hover:shadow-md transition-all duration-200">
                                    <input type="radio" name="kategori" value="Lainnya" {{ $currentKategori == 'Lainnya' ? 'checked' : '' }} class="sr-only">
                                    <span class="flex flex-1 items-start gap-3">
                                        <span class="flex-shrink-0 w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center text-gray-600 group-hover:bg-gray-600 group-hover:text-white transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                                        </span>
                                        <span class="block text-sm font-semibold text-gray-900 group-hover:text-gray-700">Lainnya</span>
                                    </span>
                                    <svg class="h-5 w-5 text-gray-600 absolute top-4 right-4 {{ $currentKategori == 'Lainnya' ? '' : 'hidden' }} check-icon" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                                </label>
                            </div>

                            {{-- Input Custom --}}
                            <div id="customKategoriContainer" class="{{ $currentKategori == 'Lainnya' ? '' : 'hidden' }} mt-4 animate-fade-in-down">
                                <label for="kategori_lain" class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori Baru</label>
                                <input type="text" id="kategori_lain" name="kategori_lain"
                                       class="w-full px-4 py-2.5 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all text-sm"
                                       placeholder="Contoh: Potensi Desa" value="{{ old('kategori_lain', $customValue) }}">
                            </div>
                        </div>

                        {{-- Deskripsi --}}
                        <div class="space-y-2">
                            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                            <textarea name="deskripsi" rows="4"
                                      class="w-full px-4 py-3 rounded-lg border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all text-sm placeholder-gray-400">{{ old('deskripsi', $arsip->deskripsi) }}</textarea>
                        </div>
                    </div>
                </section>

                {{-- Section 3: Lampiran --}}
                <section>
                    <div class="flex items-center gap-2 mb-6 pb-4 border-b border-gray-100">
                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-sm">3</div>
                        <h3 class="text-lg font-semibold text-gray-900">Kelola Lampiran</h3>
                    </div>

                    <div class="space-y-6">

                        {{-- List File Lama --}}
                        <div class="bg-gray-50 rounded-xl border border-gray-200 p-5">
                            <p class="text-sm font-bold text-gray-900 uppercase tracking-wide mb-4">File yang Tersimpan</p>

                            @php
                                $files = $arsip->file_lampiran;
                                if (empty($files)) $files = [];
                                elseif (is_string($files)) {
                                    $decoded = json_decode($files, true);
                                    $files = is_array($decoded) ? $decoded : [$files];
                                }
                            @endphp

                            @if(count($files) > 0)
                                <div class="space-y-3" id="existingFilesList">
                                    @foreach($files as $index => $f)
                                        <div class="flex items-center justify-between p-3 bg-white border border-gray-200 rounded-lg shadow-sm hover:border-blue-300 transition-colors group" id="existing-file-{{ $index }}">
                                            <div class="flex items-center gap-3 overflow-hidden">
                                                <div class="flex-shrink-0 w-10 h-10 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center">
                                                    @if(Str::endsWith(strtolower($f), ['.jpg', '.jpeg', '.png']))
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                                    @else
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                                    @endif
                                                </div>
                                                <div class="min-w-0">
                                                    <p class="text-sm font-medium text-gray-900 truncate max-w-xs sm:max-w-md" title="{{ basename($f) }}">
                                                        {{ basename($f) }}
                                                    </p>
                                                    <a href="{{ Storage::url($f) }}" target="_blank" class="text-xs text-blue-600 hover:text-blue-800 hover:underline">Lihat File</a>
                                                </div>
                                            </div>

                                            {{-- Tombol Hapus File Lama --}}
                                            <button type="button" onclick="markForDeletion('{{ $f }}', 'existing-file-{{ $index }}')" class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus File Ini">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-4 text-gray-400">
                                    <p class="text-sm">Tidak ada file lampiran saat ini.</p>
                                </div>
                            @endif
                        </div>

                        {{-- Upload Baru --}}
                        <div class="space-y-4">
                            <label class="block text-sm font-medium text-gray-700">Tambah File Baru</label>

                            <label for="file_lampiran" class="relative flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-gray-300 rounded-2xl cursor-pointer bg-gray-50 hover:bg-blue-50 hover:border-blue-400 transition-all group">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6 text-center px-4">
                                    <div class="p-3 bg-white rounded-full shadow-sm mb-3 group-hover:scale-110 group-hover:shadow-md transition-transform duration-300">
                                        <svg class="w-8 h-8 text-gray-400 group-hover:text-blue-500 transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                        </svg>
                                    </div>
                                    <p class="text-sm text-gray-600 font-medium"><span class="text-blue-600 hover:underline">Klik upload</span> atau seret file baru</p>
                                    <p class="text-xs text-gray-400 mt-1">File baru akan ditambahkan ke daftar</p>
                                </div>
                                <input id="file_lampiran" name="file_lampiran[]" type="file" multiple class="hidden" accept=".pdf,.jpg,.jpeg,.png">
                            </label>

                            <div id="previewContainer" class="grid grid-cols-2 sm:grid-cols-4 gap-3 mt-3"></div>
                        </div>
                    </div>
                </section>

                {{-- Section 4: Status --}}
                <section>
                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 mt-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <label class="text-sm font-semibold text-gray-900">Status Arsip</label>
                                <p class="text-xs text-gray-500 mt-0.5">Status dokumen saat ini</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="status" value="Aktif" {{ $arsip->status == 'Aktif' ? 'checked' : '' }} class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                            </label>
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
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<style>
    /* Styling (Sama seperti halaman Create) */
    input[type="radio"]:checked + span + svg.check-icon { display: block; }

    input[type="radio"][value="Surat Masuk"]:checked ~ span span.text-gray-900 { color: #1d4ed8; }
    input[type="radio"][value="Surat Masuk"]:checked ~ span span.rounded-lg { background-color: #2563eb; color: white; }
    input[type="radio"][value="Surat Masuk"]:checked + span + svg { color: #2563eb; }
    input[type="radio"][value="Surat Masuk"]:checked ~ label { border-color: #3b82f6; background-color: #eff6ff; }

    input[type="radio"][value="Surat Keluar"]:checked ~ span span.text-gray-900 { color: #15803d; }
    input[type="radio"][value="Surat Keluar"]:checked ~ span span.rounded-lg { background-color: #16a34a; color: white; }
    input[type="radio"][value="Surat Keluar"]:checked + span + svg { color: #16a34a; }
    input[type="radio"][value="Surat Keluar"]:checked ~ label { border-color: #22c55e; background-color: #f0fdf4; }

    input[type="radio"][value="Dokumen Penting"]:checked ~ span span.text-gray-900 { color: #7e22ce; }
    input[type="radio"][value="Dokumen Penting"]:checked ~ span span.rounded-lg { background-color: #9333ea; color: white; }
    input[type="radio"][value="Dokumen Penting"]:checked + span + svg { color: #9333ea; }
    input[type="radio"][value="Dokumen Penting"]:checked ~ label { border-color: #a855f7; background-color: #faf5ff; }

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

    // --- 2. LOGIC HAPUS FILE LAMA ---
    window.markForDeletion = function(path, elementId) {
        // 1. Sembunyikan elemen visual
        const element = document.getElementById(elementId);
        if (element) {
            element.style.display = 'none';
        }

        // 2. Buat input hidden untuk memberitahu controller file ini harus dihapus
        const container = document.getElementById('deletedFilesContainer');
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'deleted_files[]';
        input.value = path;
        container.appendChild(input);
    }

    // --- 3. LOGIC UPLOAD FILE BARU (AKUMULATIF) ---
    const fileInput = document.getElementById('file_lampiran');
    const previewContainer = document.getElementById('previewContainer');
    const dataTransfer = new DataTransfer();

    fileInput.addEventListener('change', function(e) {
        const newFiles = Array.from(e.target.files);
        newFiles.forEach(file => dataTransfer.items.add(file));
        fileInput.files = dataTransfer.files;
        renderPreview();
    });

    function renderPreview() {
        previewContainer.innerHTML = '';
        Array.from(dataTransfer.files).forEach((file, index) => {
            let iconType = '';

            if(file.type.startsWith('image/')) {
                const url = URL.createObjectURL(file);
                iconType = `<img src="${url}" class="h-full w-full object-cover group-hover:scale-105 transition-transform duration-300">`;
            } else if(file.type === 'application/pdf') {
                iconType = `<div class="h-full w-full flex flex-col items-center justify-center bg-red-50 text-red-500 p-2"><svg class="w-8 h-8 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 2H7a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg><span class="text-[10px] font-bold uppercase">PDF</span></div>`;
            } else {
                iconType = `<div class="h-full w-full flex flex-col items-center justify-center bg-gray-100 text-gray-500 p-2"><svg class="w-8 h-8 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 2H7a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg><span class="text-[10px] font-bold uppercase">FILE</span></div>`;
            }

            const item = `
                <div class="relative group rounded-xl overflow-hidden border border-gray-200 aspect-[4/3] bg-white shadow-sm hover:shadow-md transition-all">
                    ${iconType}
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-3 pointer-events-none"><p class="text-white text-xs font-medium truncate w-full">${file.name}</p></div>
                    <button type="button" onclick="removeNewFile(${index})" class="absolute top-2 right-2 bg-white text-red-500 hover:bg-red-50 rounded-full p-1 shadow-sm opacity-0 group-hover:opacity-100 transition-all scale-75 group-hover:scale-100 cursor-pointer z-10" title="Hapus File"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
                </div>
            `;
            previewContainer.innerHTML += item;
        });
    }

    window.removeNewFile = function(index) {
        const dt = new DataTransfer();
        const currentFiles = dataTransfer.files;
        for (let i = 0; i < currentFiles.length; i++) {
            if (i !== index) dt.items.add(currentFiles[i]);
        }
        dataTransfer.items.clear();
        for (let i = 0; i < dt.files.length; i++) dataTransfer.items.add(dt.files[i]);
        fileInput.files = dataTransfer.files;
        renderPreview();
    }
</script>
@endpush
