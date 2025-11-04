{{-- resources/views/admin/arsip/index.blade.php --}}

@extends('layouts.admin') {{-- Pastikan ini nama layout utama admin kamu --}}

@section('content')
    <div class="space-y-6">
        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">Kelola Arsip</h1>
                <p class="text-sm text-gray-600 mt-1">Kelola arsip dan dokumen desa</p>
            </div>
            <a href="{{ route('admin.arsip.create') }}"
               class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium bg-primary text-primary-foreground hover:bg-primary/90 h-9 px-4 py-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                Tambah Arsip
            </a>
        </div>

        {{-- Session Success Message --}}
        @if (session('success'))
            {{-- Notifikasi sukses (dari prototype arsip-page.tsx, tapi dibuat versi Blade) --}}
            <div class="relative w-full rounded-lg border px-4 py-3 text-sm bg-blue-100 border-blue-200 text-blue-800" role="alert">
                {{ session('success') }}
            </div>
        @endif

        {{-- Stats Cards (dari arsip-page.tsx baris 196-235) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white shadow-sm border rounded-xl flex flex-col gap-6"> {{-- Card --}}
                <div class="px-6 [&:last-child]:pb-6 p-6"> {{-- CardContent --}}
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Total Arsip</p>
                            <p class="mt-2 text-2xl font-semibold text-gray-900">{{ $totalArsip ?? 0 }}</p>
                        </div>
                        <div class="p-3 rounded-lg bg-gray-100 text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M10 9H8"/><path d="M16 13H8"/><path d="M16 17H8"/></svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white shadow-sm border rounded-xl flex flex-col gap-6"> {{-- Card --}}
                <div class="px-6 [&:last-child]:pb-6 p-6"> {{-- CardContent --}}
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Surat Masuk</p>
                            <p class="mt-2 text-2xl font-semibold text-gray-900">{{ $totalSuratMasuk ?? 0 }}</p>
                        </div>
                        <div class="p-3 rounded-lg bg-gray-100 text-green-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white shadow-sm border rounded-xl flex flex-col gap-6"> {{-- Card --}}
                <div class="px-6 [&:last-child]:pb-6 p-6"> {{-- CardContent --}}
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Surat Keluar</p>
                            <p class="mt-2 text-2xl font-semibold text-gray-900">{{ $totalSuratKeluar ?? 0 }}</p>
                        </div>
                        <div class="p-3 rounded-lg bg-gray-100 text-orange-600">
                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" x2="12" y1="3" y2="15"/></svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white shadow-sm border rounded-xl flex flex-col gap-6"> {{-- Card --}}
                <div class="px-6 [&:last-child]:pb-6 p-6"> {{-- CardContent --}}
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Dokumen Penting</p>
                            <p class="mt-2 text-2xl font-semibold text-gray-900">{{ $totalDokumen ?? 0 }}</p>
                        </div>
                        <div class="p-3 rounded-lg bg-gray-100 text-purple-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M10 9H8"/><path d="M16 13H8"/><path d="M16 17H8"/></svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Filters and Table (dari arsip-page.tsx baris 238) --}}
        <div class="bg-white shadow-sm border rounded-xl flex flex-col gap-6"> {{-- Card --}}
            <div class="grid auto-rows-min grid-rows-[auto_auto] items-start gap-1.5 px-6 pt-6"> {{-- CardHeader --}}
                <h4 class="leading-none text-lg font-semibold">Daftar Arsip</h4>
                <p class="text-muted-foreground text-sm">Kelola dan cari arsip dokumen desa</p>
            </div>
            <div class="px-6 [&:last-child]:pb-6"> {{-- CardContent --}}

                {{-- Form Filter & Search (Gabungan) --}}
                <form action="{{ route('admin.arsip.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 mb-6">
                    {{-- Search Input --}}
                    <div class="relative flex-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-4 h-4"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                        <input name="search"
                               placeholder="Cari nomor arsip, judul, atau kategori..."
                               class="pl-10 flex h-9 w-full min-w-0 rounded-md border border-input bg-input-background px-3 py-1 text-base"
                               value="{{ request('search') }}">
                    </div>

                    {{-- Category Select --}}
                    <select name="kategori" class="flex h-9 w-full md:w-[200px] items-center justify-between gap-2 rounded-md border border-input bg-input-background px-3 py-2 text-sm whitespace-nowrap">
                        <option value="all" @if(request('kategori') == 'all') selected @endif>Semua Kategori</option>
                        <option value="Surat Masuk" @if(request('kategori') == 'Surat Masuk') selected @endif>Surat Masuk</option>
                        <option value="Surat Keluar" @if(request('kategori') == 'Surat Keluar') selected @endif>Surat Keluar</option>
                        <option value="Dokumen Penting" @if(request('kategori') == 'Dokumen Penting') selected @endif>Dokumen Penting</option>
                    </select>

                    {{-- Submit Button --}}
                    <button type="submit" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium bg-primary text-primary-foreground hover:bg-primary/90 h-9 px-4 py-2">
                        Filter
                    </button>
                </form>


                {{-- Table (dari arsip-page.tsx baris 274) --}}
                <div class="relative w-full overflow-x-auto rounded-md border">
                    <table class="w-full caption-bottom text-sm">
                        <thead class="[&_tr]:border-b">
                            <tr class="hover:bg-muted/50 data-[state=selected]:bg-muted border-b transition-colors">
                                <th class="text-foreground h-10 px-2 text-left align-middle font-medium whitespace-nowrap">Nomor Arsip</th>
                                <th class="text-foreground h-10 px-2 text-left align-middle font-medium whitespace-nowrap">Judul Arsip</th>
                                <th class="text-foreground h-10 px-2 text-left align-middle font-medium whitespace-nowrap">Kategori</th>
                                <th class="text-foreground h-10 px-2 text-left align-middle font-medium whitespace-nowrap">Tanggal</th>
                                <th class="text-foreground h-10 px-2 text-left align-middle font-medium whitespace-nowrap">Status</th>
                                <th class="text-foreground h-10 px-2 text-left align-middle font-medium whitespace-nowrap text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="[&_tr:last-child]:border-0">
                            @forelse ($arsips as $arsip) {{-- Variabel $arsips dari controller --}}
                                <tr class="hover:bg-muted/50 data-[state=selected]:bg-muted border-b transition-colors">
                                    <td class="p-2 align-middle whitespace-nowrap">{{ $arsip->nomor_arsip }}</td>
                                    <td class="p-2 align-middle whitespace-nowrap">{{ $arsip->judul_arsip }}</td>
                                    <td class="p-2 align-middle whitespace-nowrap">
                                        {{-- Logika Badge Kategori (baris 154-169) --}}
                                        @php
                                            $kategoriClass = 'bg-gray-100 text-gray-800';
                                            if ($arsip->kategori == 'Surat Masuk') $kategoriClass = 'bg-blue-100 text-blue-800';
                                            if ($arsip->kategori == 'Surat Keluar') $kategoriClass = 'bg-green-100 text-green-800';
                                            if ($arsip->kategori == 'Dokumen Penting') $kategoriClass = 'bg-purple-100 text-purple-800';
                                        @endphp
                                        <span class="inline-flex items-center justify-center rounded-md border px-2 py-0.5 text-xs font-medium w-fit whitespace-nowrap shrink-0 {{ $kategoriClass }}">
                                            {{ $arsip->kategori }}
                                        </span>
                                    </td>
                                    <td class="p-2 align-middle whitespace-nowrap">{{ \Carbon\Carbon::parse($arsip->tanggal_arsip)->format('d/m/Y') }}</td>
                                    <td class="p-2 align-middle whitespace-nowrap">
                                        {{-- Logika Badge Status (baris 171-175) --}}
                                        @php
                                            $statusClass = $arsip->status == 'Aktif' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800';
                                        @endphp
                                        <span class="inline-flex items-center justify-center rounded-md border px-2 py-0.5 text-xs font-medium w-fit whitespace-nowrap shrink-0 {{ $statusClass }}">
                                            {{ $arsip->status }}
                                        </span>
                                    </td>
                                    <td class="p-2 align-middle whitespace-nowrap text-right">

                                        {{-- Tombol View (BARU) --}}
                                        <a href="{{ route('admin.arsip.show', $arsip->id) }}"
                                           class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium border bg-background text-foreground hover:bg-accent hover:text-accent-foreground h-8 w-8 p-0"
                                           title="Lihat Detail">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                                        </a>

                                        {{-- Tombol Download File (Opsional) --}}
                                        @if($arsip->file_lampiran)
                                            <a href="{{ Storage::url($arsip->file_lampiran) }}" target="_blank"
                                               class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium border bg-background text-foreground hover:bg-accent hover:text-accent-foreground h-8 w-8 p-0"
                                               title="Unduh File">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
                                            </a>
                                        @endif

                                        {{-- Tombol Edit --}}
                                        <a href="{{ route('admin.arsip.edit', $arsip->id) }}"
                                           class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium border bg-background text-foreground hover:bg-accent hover:text-accent-foreground h-8 w-8 p-0"
                                           title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                                        </a>

                                        {{-- Tombol Hapus --}}
                                        <form action="{{ route('admin.arsip.destroy', $arsip->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus arsip ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium border bg-background text-red-600 hover:bg-accent h-8 w-8 p-0"
                                                    title="Hapus">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr class="hover:bg-muted/50 data-[state=selected]:bg-muted border-b transition-colors">
                                    <td colspan="6" class="p-2 align-middle whitespace-nowrap text-center py-8 text-gray-500">
                                        Tidak ada arsip ditemukan
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination Links --}}
                <div class="mt-4">
                    {{-- Ini PENTING: appends() akan menjaga filter tetap aktif saat pindah halaman --}}
                    {{ $arsips->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
