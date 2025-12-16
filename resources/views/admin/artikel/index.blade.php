@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <div class="sm:flex sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-3xl font-black text-gray-900 tracking-tight">Daftar Artikel</h1>
            <p class="mt-2 text-sm text-gray-700">Kelola postingan berita dan artikel.</p>
        </div>
        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
            <a href="{{ route('admin.artikel.create') }}"
               class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all transform hover:-translate-y-0.5">
                <i class="fas fa-plus mr-2"></i> Tambah Artikel
            </a>
        </div>
    </div>

    <form action="{{ route('admin.artikel.index') }}" method="GET" class="flex flex-col sm:flex-row gap-2 mb-6">

        <div class="relative flex-1">
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   class="w-full pl-4 pr-10 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm shadow-sm"
                   placeholder="Cari judul artikel...">
        </div>

        <div class="sm:w-48">
            <select name="kategori" class="w-full py-2 px-3 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm bg-white">
                <option value="">Semua Kategori</option>
                @foreach($kategoriList as $kat)
                    <option value="{{ $kat->id_kategori }}" {{ request('kategori') == $kat->id_kategori ? 'selected' : '' }}>
                        {{ $kat->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="px-6 py-2 bg-teal-600 text-white rounded-lg text-sm font-medium hover:bg-teal-700 transition shadow-sm">
            <i class="fas fa-search mr-1"></i> Cari
        </button>

        @if(request('search') || request('kategori'))
            <a href="{{ route('admin.artikel.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-300 transition shadow-sm flex items-center justify-center">
                Reset
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
                            Judul & Kategori
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                            Penulis
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($artikels as $artikel)
                    <tr class="hover:bg-gray-50 transition-colors duration-200">

                        {{-- Kolom Gambar --}}
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="h-12 w-16 bg-gray-100 rounded-lg overflow-hidden border border-gray-200 flex items-center justify-center shadow-sm">
                                @if($artikel->url_gambar_utama)
                                    <img src="{{ asset('storage/'.$artikel->url_gambar_utama) }}" alt="" class="h-full w-full object-cover">
                                @else
                                    <i class="fas fa-image text-gray-400"></i>
                                @endif
                            </div>
                        </td>

                        {{-- Kolom Judul --}}
                        <td class="px-6 py-4">
                            <div class="text-sm font-bold text-gray-900 line-clamp-1 max-w-xs" title="{{ $artikel->judul }}">
                                {{ $artikel->judul }}
                            </div>
                            <div class="text-xs text-blue-600 mt-1 font-medium bg-blue-50 inline-block px-2 py-0.5 rounded">
                                {{ $artikel->kategori->nama_kategori ?? 'Umum' }}
                            </div>
                        </td>

                        {{-- Kolom Penulis --}}
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            <div class="flex items-center">
                                <i class="fas fa-user-circle text-gray-400 mr-2"></i>
                                {{ $artikel->penulis->nama_penulis ?? 'Admin' }}
                            </div>
                        </td>

                        {{-- Kolom Status --}}
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($artikel->status_publikasi == 'published')
                                <span class="px-2.5 py-0.5 inline-flex text-xs leading-5 font-bold rounded-full bg-green-100 text-green-800 border border-green-200">
                                    Published
                                </span>
                            @else
                                <span class="px-2.5 py-0.5 inline-flex text-xs leading-5 font-bold rounded-full bg-gray-100 text-gray-800 border border-gray-200">
                                    Draft
                                </span>
                            @endif
                        </td>

                        {{-- Kolom Aksi --}}
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            <div class="flex justify-center items-center gap-2">

                                {{-- Edit --}}
                                <a href="{{ route('admin.artikel.edit', $artikel->id_artikel) }}"
                                   class="text-amber-500 hover:text-amber-700 bg-amber-50 hover:bg-amber-100 p-2 rounded-lg transition-colors group-hover:shadow-sm"
                                   title="Edit Artikel">
                                    <i class="fas fa-pen"></i>
                                </a>

                                {{-- Hapus --}}
                                <form action="{{ route('admin.artikel.destroy', $artikel->id_artikel) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                            class="text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 p-2 rounded-lg transition-colors group-hover:shadow-sm"
                                            title="Hapus Artikel">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                            <div class="flex flex-col items-center justify-center">
                                <div class="bg-gray-100 rounded-full p-4 mb-4">
                                    <i class="fas fa-search text-gray-400 text-3xl"></i>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900">Data tidak ditemukan</h3>
                                <p class="text-gray-500 mt-1">Coba kata kunci lain atau reset filter.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
            {{ $artikels->links() }}
        </div>
    </div>

</div>
@endsection
