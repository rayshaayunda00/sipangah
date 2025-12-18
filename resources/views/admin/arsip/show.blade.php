@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-5xl">
    <div class="space-y-6">
        {{-- Header Section --}}
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.arsip.index') }}" class="p-2 text-gray-500 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Detail Arsip</h1>
                    <div class="flex items-center gap-2 mt-1">
                        <span class="text-sm text-gray-500">#{{ $arsip->nomor_arsip }}</span>
                        <span class="text-gray-300">•</span>
                        @php
                            $badgeColor = match($arsip->kategori) {
                                'Surat Masuk' => 'bg-blue-100 text-blue-700 ring-blue-600/20',
                                'Surat Keluar' => 'bg-green-100 text-green-700 ring-green-600/20',
                                'Dokumen Penting' => 'bg-purple-100 text-purple-700 ring-purple-600/20',
                                default => 'bg-gray-100 text-gray-700 ring-gray-600/20',
                            };
                        @endphp
                        <span class="inline-flex items-center rounded-md px-2 py-0.5 text-xs font-medium ring-1 ring-inset {{ $badgeColor }}">
                            {{ $arsip->kategori }}
                        </span>
                    </div>
                </div>
            </div>

            <a href="{{ route('admin.arsip.edit', $arsip->id) }}"
               class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-medium text-orange-700 bg-orange-50 border border-orange-200 rounded-lg hover:bg-orange-100 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                Edit Arsip
            </a>
        </div>

        {{-- Detail Card --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-6 md:p-8">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    {{-- Left Column: Info --}}
                    <div class="lg:col-span-2 space-y-8">
                        <div>
                            <h2 class="text-xl font-bold text-gray-900 mb-4">{{ $arsip->judul_arsip }}</h2>
                            <div class="prose prose-sm text-gray-600 max-w-none">
                                @if($arsip->deskripsi)
                                    <p>{{ $arsip->deskripsi }}</p>
                                @else
                                    <p class="italic text-gray-400">Tidak ada deskripsi tambahan.</p>
                                @endif
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4 pt-6 border-t border-gray-100">
                            <div>
                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Tanggal Arsip</p>
                                <p class="text-sm font-semibold text-gray-900 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                    {{ \Carbon\Carbon::parse($arsip->tanggal_arsip)->format('d F Y') }}
                                </p>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Status</p>
                                <div class="flex items-center gap-2">
                                    <span class="relative flex h-2.5 w-2.5">
                                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full {{ $arsip->status == 'Aktif' ? 'bg-emerald-400' : 'bg-gray-400' }} opacity-75"></span>
                                      <span class="relative inline-flex rounded-full h-2.5 w-2.5 {{ $arsip->status == 'Aktif' ? 'bg-emerald-500' : 'bg-gray-500' }}"></span>
                                    </span>
                                    <span class="text-sm font-semibold {{ $arsip->status == 'Aktif' ? 'text-emerald-700' : 'text-gray-600' }}">
                                        {{ $arsip->status }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Right Column: Attachments --}}
                    <div class="bg-gray-50 rounded-xl p-5 border border-gray-100 h-fit">
                        <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4 flex items-center gap-2">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" /></svg>
                            Lampiran File
                        </h3>

                        @php
                            $files = $arsip->file_lampiran;
                            if (empty($files)) $files = [];
                            elseif (is_string($files)) {
                                $decoded = json_decode($files, true);
                                $files = is_array($decoded) ? $decoded : [$files];
                            }
                        @endphp

                        @if(count($files) > 0)
                            <div class="space-y-3">
                                @foreach($files as $file)
                                    @php
                                        $url = Storage::url($file);
                                        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                                        $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'gif']);
                                    @endphp

                                    <div class="group relative bg-white border border-gray-200 rounded-lg p-3 hover:border-blue-400 hover:shadow-md transition-all">
                                        <div class="flex items-center gap-3">
                                            <div class="flex-shrink-0 w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center text-gray-500">
                                                @if($isImage)
                                                    <svg class="w-6 h-6 text-purple-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                                @elseif($ext == 'pdf')
                                                    <svg class="w-6 h-6 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 2H7a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
                                                @else
                                                    <svg class="w-6 h-6 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                                @endif
                                            </div>
                                            <div class="min-w-0 flex-1">
                                                <p class="text-sm font-medium text-gray-900 truncate" title="{{ basename($file) }}">{{ basename($file) }}</p>
                                                <p class="text-xs text-gray-500 uppercase">{{ $ext }} File</p>
                                            </div>
                                        </div>
                                        <div class="mt-3 flex gap-2">
                                            <a href="{{ $url }}" target="_blank" class="flex-1 text-center px-3 py-1.5 text-xs font-medium text-gray-700 bg-gray-50 border border-gray-200 rounded hover:bg-gray-100 transition-colors">
                                                Lihat
                                            </a>
                                            <a href="{{ $url }}" download class="flex-1 text-center px-3 py-1.5 text-xs font-medium text-white bg-blue-600 rounded hover:bg-blue-700 transition-colors shadow-sm">
                                                Download
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <p class="text-sm text-gray-500">Tidak ada lampiran.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
