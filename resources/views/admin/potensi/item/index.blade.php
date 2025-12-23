@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <div class="sm:flex sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-3xl font-black text-gray-900 tracking-tight">Daftar Item Potensi</h1>
            <p class="mt-2 text-sm text-gray-700">Kelola data potensi daerah, UMKM, dan wisata.</p>
        </div>
        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
            <a href="{{ route('admin.item_potensi.create') }}"
               class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all transform hover:-translate-y-0.5">
                <i class="fas fa-plus mr-2"></i> Tambah Item
            </a>
        </div>
    </div>

    <form action="{{ route('admin.item_potensi.index') }}" method="GET" class="flex flex-col sm:flex-row gap-2 mb-6">
        <div class="relative flex-1 max-w-md">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-search text-gray-400"></i>
            </div>

            {{-- Placeholder diubah untuk mencerminkan pencarian nama pemilik --}}
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm shadow-sm"
                   placeholder="Cari nama item, pemilik, kategori...">
        </div>

        <button type="submit" class="px-4 py-2 bg-teal-600 text-white rounded-lg text-sm font-medium hover:bg-teal-700 transition shadow-sm">
            Cari
        </button>

        @if(request('search'))
            <a href="{{ route('admin.item_potensi.index') }}"
               class="px-4 py-2 bg-gray-100 text-gray-600 border border-gray-300 rounded-lg text-sm font-medium hover:bg-gray-200 transition shadow-sm flex items-center justify-center">
               <i class="fas fa-times mr-1"></i> Reset
            </a>
        @endif
    </form>

    @if(session('success'))
        <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg shadow-sm animate-fade-in-up">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-green-500"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                            Gambar
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                            Nama Item & Kategori
                        </th>

                        {{-- PERUBAHAN: Header Tabel menjadi Nama Pemilik --}}
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                            Nama Pemilik
                        </th>

                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                            Info Kontak
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($items as $itm)
                    <tr class="hover:bg-gray-50 transition-colors duration-200">

                        {{-- Kolom Gambar --}}
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="h-12 w-16 bg-gray-100 rounded-lg overflow-hidden border border-gray-200 flex items-center justify-center shadow-sm">
                                @if($itm->url_gambar_utama)
                                    <img src="{{ asset('storage/' . $itm->url_gambar_utama) }}" alt="" class="h-full w-full object-cover">
                                @else
                                    <i class="fas fa-image text-gray-400"></i>
                                @endif
                            </div>
                        </td>

                        {{-- Kolom Nama & Kategori --}}
                        <td class="px-6 py-4">
                            <div class="text-sm font-bold text-gray-900 line-clamp-1 max-w-xs" title="{{ $itm->nama_item }}">
                                {{ $itm->nama_item }}
                            </div>
                            <div class="flex items-center mt-1 space-x-1">
                                <span class="text-xs text-blue-600 font-medium bg-blue-50 px-2 py-0.5 rounded border border-blue-100">
                                    {{ $itm->subkategori->nama_subkategori }}
                                </span>
                                <span class="text-xs text-gray-400">•</span>
                                <span class="text-xs text-gray-500 italic">
                                    {{ $itm->subkategori->kategori->nama_kategori }}
                                </span>
                            </div>
                        </td>

                        {{-- PERUBAHAN DI SINI: Menampilkan Nama Pemilik --}}
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900 font-medium">
                                {{ $itm->nama_pemilik ?? '-' }}
                            </div>
                        </td>

                        {{-- Kolom Status --}}
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($itm->status_publikasi == 'published')
                                <span class="px-2.5 py-0.5 inline-flex text-xs leading-5 font-bold rounded-full bg-green-100 text-green-800 border border-green-200">
                                    Published
                                </span>
                            @else
                                <span class="px-2.5 py-0.5 inline-flex text-xs leading-5 font-bold rounded-full bg-gray-100 text-gray-800 border border-gray-200">
                                    Draft
                                </span>
                            @endif
                        </td>

                        {{-- Kolom Info Kontak --}}
                        <td class="px-6 py-4">
                            <div class="text-xs text-gray-600">
                                <div class="flex items-start mb-1" title="{{ $itm->alamat }}">
                                    <i class="fas fa-map-marker-alt text-gray-400 mr-1.5 mt-0.5"></i>
                                    <span class="line-clamp-1 max-w-[150px]">{{ $itm->alamat ?? '-' }}</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-phone text-gray-400 mr-1.5"></i>
                                    <span>{{ $itm->no_hp ?? '-' }}</span>
                                </div>
                            </div>
                        </td>

                        {{-- Kolom Aksi --}}
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            <div class="flex justify-center items-center gap-2">
                                <a href="{{ route('admin.item_potensi.edit', $itm->id_item_potensi) }}"
                                   class="text-amber-500 hover:text-amber-700 bg-amber-50 hover:bg-amber-100 p-2 rounded-lg transition-colors group-hover:shadow-sm"
                                   title="Edit Item">
                                    <i class="fas fa-pen"></i>
                                </a>

                                <form action="{{ route('admin.item_potensi.destroy', $itm->id_item_potensi) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus item ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                            class="text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 p-2 rounded-lg transition-colors group-hover:shadow-sm"
                                            title="Hapus Item">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                            <div class="flex flex-col items-center justify-center">
                                <div class="bg-gray-100 rounded-full p-4 mb-4">
                                    <i class="fas fa-search text-gray-400 text-3xl"></i>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900">Data tidak ditemukan</h3>
                                <p class="text-gray-500 mt-1">Coba kata kunci lain atau reset pencarian.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
            {{ $items->links() }}
        </div>
    </div>

</div>
@endsection
