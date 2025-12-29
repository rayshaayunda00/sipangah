@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-5xl">

    {{-- Header Section --}}
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.arsip.index') }}" class="p-2.5 text-gray-500 hover:text-gray-900 bg-white hover:bg-gray-50 border border-gray-200 rounded-xl transition-all shadow-sm group">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="group-hover:-translate-x-0.5 transition-transform"><path d="m15 18-6-6 6-6"/></svg>
            </a>
            <div>
                <div class="flex items-center gap-3">
                    <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Detail Arsip</h1>
                    @php
                        $badgeColor = match($arsip->kategori) {
                            'Surat Masuk' => 'bg-blue-50 text-blue-700 border-blue-200',
                            'Surat Keluar' => 'bg-green-50 text-green-700 border-green-200',
                            'Dokumen Penting' => 'bg-purple-50 text-purple-700 border-purple-200',
                            default => 'bg-gray-50 text-gray-700 border-gray-200',
                        };
                    @endphp
                    <span class="hidden sm:inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $badgeColor }}">
                        {{ $arsip->kategori }}
                    </span>
                </div>
                <p class="text-sm text-gray-500 mt-1">Nomor Arsip: <span class="font-mono font-medium text-gray-700">{{ $arsip->nomor_arsip ?? '-' }}</span></p>
            </div>
        </div>

        <div class="flex gap-3">
            <a href="{{ route('admin.arsip.edit', $arsip->id) }}" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-orange-500 border border-transparent rounded-lg hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 shadow-sm transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                Edit Data
            </a>
        </div>
    </div>

    {{-- Content Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- Left Column: Informasi Utama --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 md:p-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 leading-relaxed">{{ $arsip->judul_arsip }}</h2>

                    <div class="space-y-6">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wide mb-3 flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" /></svg>
                                Deskripsi
                            </h3>
                            <div class="prose prose-sm text-gray-600 bg-gray-50 p-4 rounded-xl border border-gray-100">
                                @if($arsip->deskripsi)
                                    <p class="whitespace-pre-line">{{ $arsip->deskripsi }}</p>
                                @else
                                    <p class="italic text-gray-400 text-center py-2">Tidak ada deskripsi tambahan.</p>
                                @endif
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-6 border-t border-gray-100">
                            {{-- Tanggal --}}
                            <div>
                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-2">Tanggal Dokumen</p>
                                <div class="flex items-center gap-3 bg-white border border-gray-200 p-3 rounded-lg">
                                    <div class="p-2 bg-blue-50 text-blue-600 rounded-md">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-gray-900">{{ \Carbon\Carbon::parse($arsip->tanggal_arsip)->format('d F Y') }}</p>
                                        <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($arsip->tanggal_arsip)->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </div>

                            {{-- Status --}}
                            <div>
                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-2">Status Arsip</p>
                                <div class="flex items-center gap-3 bg-white border border-gray-200 p-3 rounded-lg">
                                    <div class="p-2 {{ $arsip->status == 'Aktif' ? 'bg-emerald-50 text-emerald-600' : 'bg-gray-100 text-gray-500' }} rounded-md">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold {{ $arsip->status == 'Aktif' ? 'text-emerald-700' : 'text-gray-600' }}">{{ $arsip->status }}</p>
                                        <p class="text-xs text-gray-500">{{ $arsip->status == 'Aktif' ? 'Dapat diakses publik' : 'Disembunyikan' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right Column: Lampiran --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden sticky top-8">
                <div class="p-5 border-b border-gray-100 bg-gray-50/50">
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" /></svg>
                        Lampiran File
                    </h3>
                </div>

                <div class="p-5">
                    @php
                        $files = $arsip->file_lampiran;
                        if (empty($files)) $files = [];
                        elseif (is_string($files)) {
                            $decoded = json_decode($files, true);
                            $files = is_array($decoded) ? $decoded : [$files];
                        }
                    @endphp

                    @if(count($files) > 0)
                        <div class="space-y-4">
                            @foreach($files as $file)
                                @php
                                    $url = Storage::url($file);
                                    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                                    $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                                @endphp

                                <div class="group relative bg-white border border-gray-200 rounded-xl p-3 hover:border-blue-400 hover:shadow-md transition-all duration-200">
                                    <div class="flex items-start gap-3">
                                        {{-- Icon File --}}
                                        <div class="flex-shrink-0 w-12 h-12 bg-gray-50 rounded-lg flex items-center justify-center border border-gray-100 overflow-hidden">
                                            @if($isImage)
                                                <img src="{{ $url }}" class="w-full h-full object-cover" alt="Preview">
                                            @elseif($ext == 'pdf')
                                                <svg class="w-6 h-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 2H7a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
                                            @else
                                                <svg class="w-6 h-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                            @endif
                                        </div>

                                        {{-- Info File --}}
                                        <div class="min-w-0 flex-1">
                                            <p class="text-sm font-semibold text-gray-900 truncate" title="{{ basename($file) }}">{{ basename($file) }}</p>
                                            <p class="text-xs text-gray-500 uppercase mt-0.5">{{ $ext }} File</p>
                                        </div>
                                    </div>

                                    {{-- Actions --}}
                                    <div class="mt-3 flex gap-2">
                                        <a href="{{ $url }}" target="_blank" class="flex-1 inline-flex justify-center items-center px-3 py-1.5 text-xs font-medium text-gray-700 bg-gray-50 border border-gray-200 rounded-lg hover:bg-gray-100 transition-colors">
                                            <svg class="w-3.5 h-3.5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                            Lihat
                                        </a>
                                        <a href="{{ $url }}" download class="flex-1 inline-flex justify-center items-center px-3 py-1.5 text-xs font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors shadow-sm">
                                            <svg class="w-3.5 h-3.5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                                            Unduh
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-10">
                            <div class="bg-gray-50 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-3">
                                <svg class="w-8 h-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                            </div>
                            <p class="text-sm font-medium text-gray-500">Tidak ada lampiran.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
