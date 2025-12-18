@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <div class="space-y-6">
        {{-- Header Section --}}
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Edit Arsip</h1>
                <p class="text-gray-500 mt-1">Perbarui informasi dokumen #{{ $arsip->nomor_arsip }}</p>
            </div>
        </div>

        {{-- Form Card --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <form action="{{ route('admin.arsip.update', $arsip->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="p-6 md:p-8 space-y-8">
                    {{-- Section: Informasi Utama --}}
                    <div class="space-y-6">
                        <div class="pb-2 border-b border-gray-100">
                            <h3 class="text-lg font-semibold text-gray-900">Detail Dokumen</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Nomor Arsip --}}
                            <div class="space-y-2">
                                <label for="nomor_arsip" class="text-sm font-medium text-gray-700">Nomor Arsip</label>
                                <input type="text" name="nomor_arsip" value="{{ old('nomor_arsip', $arsip->nomor_arsip) }}"
                                       class="w-full rounded-lg border-gray-300 bg-gray-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 transition-colors text-sm py-2.5">
                            </div>

                            {{-- Tanggal Arsip --}}
                            <div class="space-y-2">
                                <label for="tanggal_arsip" class="text-sm font-medium text-gray-700">Tanggal Arsip</label>
                                <input type="date" name="tanggal_arsip" value="{{ old('tanggal_arsip', $arsip->tanggal_arsip->format('Y-m-d')) }}" required
                                       class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm py-2.5">
                            </div>

                            {{-- Judul Arsip --}}
                            <div class="space-y-2 md:col-span-2">
                                <label for="judul_arsip" class="text-sm font-medium text-gray-700">Judul Arsip</label>
                                <input type="text" name="judul_arsip" value="{{ old('judul_arsip', $arsip->judul_arsip) }}" required
                                       class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm py-2.5">
                            </div>

                            {{-- Kategori --}}
                            <div class="space-y-2 md:col-span-2">
                                <label class="text-sm font-medium text-gray-700">Kategori Dokumen</label>
                                <select name="kategori" required class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm py-2.5 bg-white">
                                    <option value="Surat Masuk" {{ $arsip->kategori == 'Surat Masuk' ? 'selected' : '' }}>Surat Masuk</option>
                                    <option value="Surat Keluar" {{ $arsip->kategori == 'Surat Keluar' ? 'selected' : '' }}>Surat Keluar</option>
                                    <option value="Dokumen Penting" {{ $arsip->kategori == 'Dokumen Penting' ? 'selected' : '' }}>Dokumen Penting</option>
                                </select>
                            </div>

                            {{-- Deskripsi --}}
                            <div class="space-y-2 md:col-span-2">
                                <label for="deskripsi" class="text-sm font-medium text-gray-700">Deskripsi</label>
                                <textarea name="deskripsi" rows="3"
                                          class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 text-sm">{{ old('deskripsi', $arsip->deskripsi) }}</textarea>
                            </div>
                        </div>
                    </div>

                    {{-- Section: File Lampiran --}}
                    <div class="space-y-6 pt-6 border-t border-gray-100">
                        <div class="pb-2">
                            <h3 class="text-lg font-semibold text-gray-900">Kelola Lampiran</h3>
                        </div>

                        {{-- 1. List File Lama --}}
                        <div class="bg-gray-50 rounded-xl border border-gray-200 p-4">
                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">File Saat Ini</p>
                            @php
                                $files = $arsip->file_lampiran;
                                if (empty($files)) $files = [];
                                elseif (is_string($files)) {
                                    $decoded = json_decode($files, true);
                                    $files = is_array($decoded) ? $decoded : [$files];
                                }
                            @endphp

                            @if(count($files) > 0)
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    @foreach($files as $f)
                                        <div class="flex items-center gap-3 p-3 bg-white border border-gray-200 rounded-lg shadow-sm hover:border-blue-300 transition-colors">
                                            <div class="flex-shrink-0 p-2 bg-blue-50 text-blue-600 rounded">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/></svg>
                                            </div>
                                            <div class="min-w-0 flex-1">
                                                <p class="text-sm font-medium text-gray-900 truncate" title="{{ basename($f) }}">
                                                    {{ basename($f) }}
                                                </p>
                                                <a href="{{ Storage::url($f) }}" target="_blank" class="text-xs text-blue-600 hover:underline hover:text-blue-800">
                                                    Lihat File
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="flex flex-col items-center justify-center py-6 text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mb-2 opacity-50"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/><line x1="12" x2="12" y1="18" y2="18"/></svg>
                                    <p class="text-sm">Tidak ada file lampiran.</p>
                                </div>
                            @endif
                        </div>

                        {{-- 2. Upload Baru --}}
                        <div class="space-y-3">
                            <label class="block text-sm font-medium text-gray-700">Upload File Baru (Menimpa file lama)</label>
                            <label for="file_lampiran" class="relative flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer bg-white hover:bg-gray-50 transition-colors group">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 text-gray-400 group-hover:text-blue-500 mb-2 transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    <p class="text-sm text-gray-500"><span class="font-semibold text-gray-700">Klik upload</span> atau seret file baru</p>
                                </div>
                                <input id="file_lampiran" name="file_lampiran[]" type="file" multiple class="hidden">
                            </label>
                            <div id="previewContainer" class="grid grid-cols-2 sm:grid-cols-4 gap-3 mt-3"></div>
                        </div>
                    </div>

                    {{-- Section: Status --}}
                    <div class="space-y-4 pt-6 border-t border-gray-100">
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200">
                            <div>
                                <label class="text-sm font-medium text-gray-900">Status Arsip</label>
                                <p class="text-xs text-gray-500">Status dokumen saat ini</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="status" value="Aktif" {{ $arsip->status == 'Aktif' ? 'checked' : '' }} class="sr-only peer">
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
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('file_lampiran').addEventListener('change', function(e){
        const container = document.getElementById('previewContainer');
        container.innerHTML = '';
        Array.from(e.target.files).forEach(file => {
            container.innerHTML += `<div class="p-2 border rounded-lg bg-white text-xs font-medium text-gray-700 truncate shadow-sm flex items-center gap-2"><div class="w-2 h-2 rounded-full bg-blue-500"></div>${file.name}</div>`;
        });
    });
</script>
@endpush
