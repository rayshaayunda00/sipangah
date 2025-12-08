@extends('layouts.admin')

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
            <div class="relative w-full rounded-lg border px-4 py-3 text-sm bg-blue-100 border-blue-200 text-blue-800" role="alert">
                {{ session('success') }}
            </div>
        @endif

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            {{-- Total Arsip --}}
            <div class="bg-white shadow-sm border rounded-xl flex flex-col gap-6">
                <div class="px-6 [&:last-child]:pb-6 p-6">
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
            {{-- Surat Masuk --}}
            <div class="bg-white shadow-sm border rounded-xl flex flex-col gap-6">
                <div class="px-6 [&:last-child]:pb-6 p-6">
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
            {{-- Surat Keluar --}}
            <div class="bg-white shadow-sm border rounded-xl flex flex-col gap-6">
                <div class="px-6 [&:last-child]:pb-6 p-6">
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
            {{-- Dokumen Penting --}}
            <div class="bg-white shadow-sm border rounded-xl flex flex-col gap-6">
                <div class="px-6 [&:last-child]:pb-6 p-6">
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

        {{-- Filters and Table --}}
        <div class="bg-white shadow-sm border rounded-xl flex flex-col gap-6">
            <div class="px-6 pt-6">
                <div class="flex flex-col gap-1">
                    <h4 class="text-lg font-semibold">Daftar Arsip</h4>
                    <p class="text-muted-foreground text-sm text-gray-500">Kelola dan cari arsip dokumen desa</p>
                </div>

                {{-- Form Filter & Search --}}
                <form action="{{ route('admin.arsip.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 mt-6">
                    <div class="relative flex-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-4 h-4"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                        <input name="search"
                               placeholder="Cari nomor arsip, judul, atau kategori..."
                               class="pl-10 flex h-9 w-full rounded-md border border-input bg-input-background px-3 py-1 text-base"
                               value="{{ request('search') }}">
                    </div>
                    <select name="kategori" class="flex h-9 w-full md:w-[200px] rounded-md border border-input bg-input-background px-3 py-2 text-sm">
                        <option value="all" @if(request('kategori') == 'all') selected @endif>Semua Kategori</option>
                        <option value="Surat Masuk" @if(request('kategori') == 'Surat Masuk') selected @endif>Surat Masuk</option>
                        <option value="Surat Keluar" @if(request('kategori') == 'Surat Keluar') selected @endif>Surat Keluar</option>
                        <option value="Dokumen Penting" @if(request('kategori') == 'Dokumen Penting') selected @endif>Dokumen Penting</option>
                    </select>
                    <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-md text-sm font-medium bg-primary text-primary-foreground hover:bg-primary/90 h-9 px-4 py-2">
                        Filter
                    </button>
                </form>
            </div>

            <div class="px-6 pb-6">
                <div class="relative w-full overflow-x-auto rounded-md border">
                    <table class="w-full caption-bottom text-sm">
                        <thead class="[&_tr]:border-b">
                            <tr class="hover:bg-muted/50 border-b transition-colors bg-gray-50/50">
                                <th class="h-10 px-4 text-left align-middle font-medium text-muted-foreground">Nomor Arsip</th>
                                <th class="h-10 px-4 text-left align-middle font-medium text-muted-foreground">Judul</th>
                                <th class="h-10 px-4 text-left align-middle font-medium text-muted-foreground">Kategori</th>
                                <th class="h-10 px-4 text-left align-middle font-medium text-muted-foreground">Tanggal</th>
                                <th class="h-10 px-4 text-left align-middle font-medium text-muted-foreground">Status</th>
                                <th class="h-10 px-4 text-right align-middle font-medium text-muted-foreground">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="[&_tr:last-child]:border-0">
                            @forelse ($arsips as $arsip)
                                <tr class="hover:bg-muted/50 border-b transition-colors">
                                    <td class="p-4 align-middle font-medium">{{ $arsip->nomor_arsip }}</td>
                                    <td class="p-4 align-middle">{{ $arsip->judul_arsip }}</td>
                                    <td class="p-4 align-middle">
                                        <span class="inline-flex items-center rounded-md border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2
                                            {{ $arsip->kategori == 'Surat Masuk' ? 'border-transparent bg-blue-100 text-blue-800' :
                                              ($arsip->kategori == 'Surat Keluar' ? 'border-transparent bg-green-100 text-green-800' : 'border-transparent bg-purple-100 text-purple-800') }}">
                                            {{ $arsip->kategori }}
                                        </span>
                                    </td>
                                    <td class="p-4 align-middle text-muted-foreground">{{ \Carbon\Carbon::parse($arsip->tanggal_arsip)->format('d/m/Y') }}</td>
                                    <td class="p-4 align-middle">
                                        <span class="inline-flex items-center rounded-md border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2
                                            {{ $arsip->status == 'Aktif' ? 'border-transparent bg-green-100 text-green-800' : 'border-transparent bg-gray-100 text-gray-800' }}">
                                            {{ $arsip->status }}
                                        </span>
                                    </td>
                                    <td class="p-4 align-middle text-right">
                                        {{-- 🔥 LOGIKA NORMALISASI DATA (Anti Error Count String) --}}
                                        @php
                                            $files = $arsip->file_lampiran;
                                            if (empty($files)) {
                                                $files = [];
                                            } elseif (is_string($files)) {
                                                $decoded = json_decode($files, true);
                                                $files = is_array($decoded) ? $decoded : [$files];
                                            }
                                        @endphp

                                        <div class="flex items-center justify-end gap-2">
                                            {{-- View --}}
                                            <a href="{{ route('admin.arsip.show', $arsip->id) }}" class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 border border-input bg-transparent shadow-sm hover:bg-accent hover:text-accent-foreground h-8 w-8" title="Lihat">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                                            </a>

                                            {{-- Download (File Pertama) --}}
                                            @if(count($files) > 0)
                                                <a href="{{ Storage::url($files[0]) }}" target="_blank" class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 border border-input bg-transparent shadow-sm hover:bg-accent hover:text-accent-foreground h-8 w-8" title="Unduh">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
                                                </a>
                                            @endif

                                            {{-- Edit --}}
                                            <a href="{{ route('admin.arsip.edit', $arsip->id) }}" class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 border border-input bg-transparent shadow-sm hover:bg-accent hover:text-accent-foreground h-8 w-8" title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                                            </a>

                                            {{-- Delete --}}
                                            <form action="{{ route('admin.arsip.destroy', $arsip->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus arsip ini?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 border border-input bg-transparent shadow-sm hover:bg-red-50 hover:text-red-600 h-8 w-8 text-red-500" title="Hapus">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-8 text-center text-muted-foreground text-sm">
                                        Tidak ada arsip ditemukan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">{{ $arsips->appends(request()->query())->links() }}</div>
            </div>
        </div>
    </div>
@endsection
