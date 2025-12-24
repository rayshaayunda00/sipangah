@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="space-y-8">
        {{-- Header Section --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Kelola Arsip</h1>
                <p class="text-gray-500 mt-2 text-lg">Pusat pengelolaan dokumen dan arsip desa</p>
            </div>
            <a href="{{ route('admin.arsip.create') }}"
               class="inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors shadow-sm hover:shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                Tambah Arsip Baru
            </a>
        </div>

        {{-- Alert Success --}}
        @if (session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-r shadow-sm animate-fade-in-down" role="alert">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        {{-- Stats Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            {{-- Card 1: Total Arsip --}}
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Total Arsip</p>
                        <h3 class="text-3xl font-bold text-gray-900">{{ $totalArsip ?? 0 }}</h3>
                    </div>
                    <div class="p-3 bg-blue-50 rounded-lg">
                        <svg class="w-6 h-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Card 2: Surat Masuk --}}
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Surat Masuk</p>
                        <h3 class="text-3xl font-bold text-gray-900">{{ $totalSuratMasuk ?? 0 }}</h3>
                    </div>
                    <div class="p-3 bg-green-50 rounded-lg">
                        <svg class="w-6 h-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 16l6 6 6-6m-6 6V4" />
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Card 3: Surat Keluar --}}
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Surat Keluar</p>
                        <h3 class="text-3xl font-bold text-gray-900">{{ $totalSuratKeluar ?? 0 }}</h3>
                    </div>
                    <div class="p-3 bg-orange-50 rounded-lg">
                        <svg class="w-6 h-6 text-orange-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l6-6 6 6m-6-6v18" />
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Card 4: Dokumen Penting --}}
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Dokumen Penting</p>
                        <h3 class="text-3xl font-bold text-gray-900">{{ $totalDokumen ?? 0 }}</h3>
                    </div>
                    <div class="p-3 bg-purple-50 rounded-lg">
                        <svg class="w-6 h-6 text-purple-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- Main Content Card --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">Daftar Arsip</h2>
                        <p class="text-sm text-gray-500 mt-1">Cari dan filter dokumen arsip dengan mudah</p>
                    </div>

                    {{-- Filter Form --}}
                    <form action="{{ route('admin.arsip.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500 transition-colors" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}"
                                   class="pl-10 pr-4 py-2 w-full sm:w-64 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all text-sm"
                                   placeholder="Cari arsip...">
                        </div>

                        <select name="kategori" class="pl-4 pr-10 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm bg-white cursor-pointer">
                            <option value="all" {{ request('kategori') == 'all' ? 'selected' : '' }}>Semua Kategori</option>
                            <option value="Surat Masuk" {{ request('kategori') == 'Surat Masuk' ? 'selected' : '' }}>Surat Masuk</option>
                            <option value="Surat Keluar" {{ request('kategori') == 'Surat Keluar' ? 'selected' : '' }}>Surat Keluar</option>
                            <option value="Dokumen Penting" {{ request('kategori') == 'Dokumen Penting' ? 'selected' : '' }}>Dokumen Penting</option>
                        </select>

                        <button type="submit" class="inline-flex items-center justify-center gap-2 bg-gray-900 hover:bg-gray-800 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            Filter
                        </button>
                    </form>
                </div>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-gray-500 uppercase bg-gray-50/50 border-b">
                        <tr>
                            <th scope="col" class="px-6 py-4 font-semibold">Nomor Arsip</th>
                            <th scope="col" class="px-6 py-4 font-semibold">Judul Dokumen</th>
                            <th scope="col" class="px-6 py-4 font-semibold">Kategori</th>
                            <th scope="col" class="px-6 py-4 font-semibold">Tanggal</th>
                            <th scope="col" class="px-6 py-4 font-semibold">Status</th>
                            <th scope="col" class="px-6 py-4 font-semibold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($arsips as $arsip)
                            <tr class="bg-white hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $arsip->nomor_arsip }}</td>
                                <td class="px-6 py-4 text-gray-700">
                                    <div class="font-medium">{{ $arsip->judul_arsip }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $badgeColor = match($arsip->kategori) {
                                            'Surat Masuk' => 'bg-blue-100 text-blue-700 ring-blue-600/20',
                                            'Surat Keluar' => 'bg-green-100 text-green-700 ring-green-600/20',
                                            'Dokumen Penting' => 'bg-purple-100 text-purple-700 ring-purple-600/20',
                                            default => 'bg-gray-100 text-gray-700 ring-gray-600/20',
                                        };
                                    @endphp
                                    <span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset {{ $badgeColor }}">
                                        {{ $arsip->kategori }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-500 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($arsip->tanggal_arsip)->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-medium {{ $arsip->status == 'Aktif' ? 'bg-emerald-50 text-emerald-700' : 'bg-gray-100 text-gray-600' }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $arsip->status == 'Aktif' ? 'bg-emerald-500' : 'bg-gray-400' }}"></span>
                                        {{ $arsip->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        {{-- View Button --}}
                                        <a href="{{ route('admin.arsip.show', $arsip->id) }}"
                                           class="p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors"
                                           title="Lihat Detail">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                                        </a>

                                        {{-- Download Button --}}
                                        {{-- @php
                                            $files = is_string($arsip->file_lampiran) ? json_decode($arsip->file_lampiran, true) : $arsip->file_lampiran;
                                            $files = is_array($files) ? $files : ($files ? [$files] : []);
                                        @endphp

                                        @if(count($files) > 0)
                                            <a href="{{ Storage::url($files[0]) }}" target="_blank"
                                               class="p-2 text-gray-400 hover:text-green-600 hover:bg-green-50 rounded-lg transition-colors"
                                               title="Unduh Lampiran">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
                                            </a>
                                        @endif --}}

                                        {{-- Edit Button --}}
                                        <a href="{{ route('admin.arsip.edit', $arsip->id) }}"
                                           class="p-2 text-gray-400 hover:text-orange-600 hover:bg-orange-50 rounded-lg transition-colors"
                                           title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                                        </a>

                                        {{-- Delete Button --}}
                                        <form action="{{ route('admin.arsip.destroy', $arsip->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus arsip ini? Data yang dihapus tidak dapat dikembalikan.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                                    title="Hapus">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center space-y-3">
                                        <div class="p-4 bg-gray-50 rounded-full">
                                            <svg class="w-10 h-10 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </div>
                                        <div class="text-gray-500 font-medium">Belum ada arsip ditemukan</div>
                                        <p class="text-sm text-gray-400">Silakan tambahkan arsip baru atau ubah filter pencarian Anda</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($arsips->hasPages())
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
                    {{ $arsips->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
