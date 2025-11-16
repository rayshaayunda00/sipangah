{{-- resources/views/admin/arsip/show.blade.php --}}

@extends('layouts.admin') {{-- Pastikan ini nama layout utama admin kamu --}}

@section('content')
    <div class="space-y-6">
        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">Detail Arsip</h1>
                {{-- Judul arsip sebagai sub-header --}}
                <p class="text-sm text-gray-600 mt-1">{{ $arsip->judul_arsip }}</p>
            </div>
            <a href="{{ route('admin.arsip.index') }}"
               class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium border bg-background text-foreground hover:bg-accent hover:text-accent-foreground h-9 px-4 py-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="m15 18-6-6 6-6"/></svg>
                Kembali ke Daftar
            </a>
        </div>

        {{-- Detail Card (Meniru 'View Archive Dialog' dari prototype) --}}
        <div class="bg-white shadow-sm border rounded-xl flex flex-col gap-6"> {{-- Card --}}
            <div class="grid auto-rows-min grid-rows-[auto_auto] items-start gap-1.5 px-6 pt-6"> {{-- CardHeader --}}
                {{-- Nomor arsip sebagai Judul Card --}}
                <h4 class="leading-none text-lg font-semibold">{{ $arsip->nomor_arsip }}</h4> {{-- CardTitle --}}
            </div>

            <div class="px-6 [&:last-child]:pb-6"> {{-- CardContent --}}
                <div class="grid gap-4 py-4">
                    {{-- Baris Detail --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                        <div class="text-sm text-gray-500">Judul Arsip</div>
                        <div class="col-span-2 text-sm text-gray-900 font-medium">{{ $arsip->judul_arsip }}</div>
                    </div>

                    {{-- Baris Detail --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                        <div class="text-sm text-gray-500">Kategori</div>
                        <div class="col-span-2">
                            @php
                                $kategoriClass = 'bg-gray-100 text-gray-800';
                                if ($arsip->kategori == 'Surat Masuk') $kategoriClass = 'bg-blue-100 text-blue-800';
                                if ($arsip->kategori == 'Surat Keluar') $kategoriClass = 'bg-green-100 text-green-800';
                                if ($arsip->kategori == 'Dokumen Penting') $kategoriClass = 'bg-purple-100 text-purple-800';
                            @endphp
                            <span class="inline-flex items-center justify-center rounded-md border px-2 py-0.5 text-xs font-medium w-fit whitespace-nowrap shrink-0 {{ $kategoriClass }}">
                                {{ $arsip->kategori }}
                            </span>
                        </div>
                    </div>

                    {{-- Baris Detail --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                        <div class="text-sm text-gray-500">Deskripsi</div>
                        <div class="col-span-2 text-sm text-gray-900 whitespace-pre-wrap">{{ $arsip->deskripsi ?? '-' }}</div>
                    </div>

                    {{-- Baris Detail --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                        <div class="text-sm text-gray-500">Tanggal Arsip</div>
                        <div class="col-span-2 text-sm text-gray-900">{{ \Carbon\Carbon::parse($arsip->tanggal_arsip)->format('d F Y') }}</div>
                    </div>

                    {{-- Baris Detail --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                        <div class="text-sm text-gray-500">Status</div>
                        <div class="col-span-2">
                            @php
                                $statusClass = $arsip->status == 'Aktif' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800';
                            @endphp
                            <span class="inline-flex items-center justify-center rounded-md border px-2 py-0.5 text-xs font-medium w-fit whitespace-nowrap shrink-0 {{ $statusClass }}">
                                {{ $arsip->status }}
                            </span>
                        </div>
                    </div>

                    {{-- Baris Detail --}}
                   {{-- Baris Detail --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-2">
    <div class="text-sm text-gray-500">File Lampiran</div>

    <div class="col-span-2">
        @if ($arsip->file_lampiran)
            @php
                $fileUrl = Storage::url($arsip->file_lampiran);
                $ext = strtolower(pathinfo($arsip->file_lampiran, PATHINFO_EXTENSION));
                $isImage = in_array($ext, ['jpg','jpeg','png','gif','webp']);
            @endphp

            <div class="w-full rounded-lg border bg-gray-50 p-4 flex flex-col gap-4">

                {{-- Bagian atas: ikon + nama file + tombol --}}
                <div class="flex items-center justify-between">

                    {{-- Kiri: ikon + nama file --}}
                    <div class="flex items-center gap-3">
                        {{-- Ikon file --}}
                        <div class="p-2 rounded-md bg-white border shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 width="20" height="20" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor"
                                 stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round"
                                 class="text-gray-700">
                                <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/>
                                <polyline points="14 2 14 8 20 8"/>
                            </svg>
                        </div>

                        <div>
                            <p class="text-sm font-semibold text-gray-800">
                                {{ basename($arsip->file_lampiran) }}
                            </p>
                            <p class="text-xs text-gray-500 uppercase">{{ $ext }}</p>
                        </div>
                    </div>

                    {{-- Kanan: tombol aksi --}}
                    <div class="flex items-center gap-2">

                        {{-- Tombol download --}}
                        <a href="{{ $fileUrl }}" download
                            class="h-9 px-3 rounded-md border text-sm bg-white hover:bg-gray-100 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 width="18" height="18" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor"
                                 stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                                <polyline points="7 10 12 15 17 10"/>
                                <line x1="12" y1="15" x2="12" y2="3"/>
                            </svg>
                            Unduh
                        </a>

                        {{-- Tombol lihat --}}
                        <a href="{{ $fileUrl }}" target="_blank"
                            class="h-9 px-3 rounded-md border text-sm bg-white hover:bg-gray-100 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 width="18" height="18" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor"
                                 stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round">
                                <circle cx="12" cy="12" r="3"/>
                                <path d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7S2 12 2 12z"/>
                            </svg>
                            Preview
                        </a>
                    </div>

                </div>

                {{-- Preview gambar jika image --}}
                @if ($isImage)
                    <div class="mt-2">
                        <img src="{{ $fileUrl }}"
                             class="w-60 rounded-lg border shadow-sm"
                             alt="Preview Lampiran">
                    </div>
                @endif

            </div>

        @else
            <span class="text-sm text-gray-500">- Tidak ada file -</span>
        @endif
    </div>
</div>

                </div>
            </div>

            {{-- CardFooter --}}
            <div class="flex items-center px-6 pb-6 justify-end gap-2">
                 <a href="{{ route('admin.arsip.edit', $arsip->id) }}"
                       class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium border bg-background text-foreground hover:bg-accent hover:text-accent-foreground h-9 px-4 py-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                        Edit Arsip
                    </a>
            </div>
        </div>
    </div>
@endsection
