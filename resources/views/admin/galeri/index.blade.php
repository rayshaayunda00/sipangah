@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <div class="sm:flex sm:items-center sm:justify-between mb-8">
        <div>
            <h1 class="text-3xl font-black text-gray-900 tracking-tight">Daftar Kegiatan</h1>
            <p class="mt-2 text-sm text-gray-700">Kelola semua dokumentasi kegiatan galeri Anda di sini.</p>
        </div>
        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
            <a href="{{ route('admin.galeri.create') }}"
               class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all transform hover:-translate-y-0.5">
                <i class="fas fa-plus mr-2"></i> Tambah Kegiatan
            </a>
        </div>
    </div>

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
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                            Kegiatan & Thumbnail
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                            Tanggal Pelaksanaan
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                            Deskripsi Singkat
                        </th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($galeri as $item)
                        <tr class="hover:bg-gray-50 transition-colors duration-200 group">

                            {{-- Kolom Thumbnail & Judul --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-16 w-24">
                                        @if($item->thumbnail_url)
                                            <img class="h-16 w-24 rounded-lg object-cover shadow-sm border border-gray-200" src="{{ asset('storage/'.$item->thumbnail_url) }}" alt="{{ $item->judul_kegiatan }}">
                                        @else
                                            <div class="h-16 w-24 rounded-lg bg-gray-100 flex items-center justify-center border border-gray-200">
                                                <i class="fas fa-image text-gray-400 text-xl"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-bold text-gray-900 line-clamp-1 max-w-[200px]" title="{{ $item->judul_kegiatan }}">
                                            {{ $item->judul_kegiatan }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            {{-- Kolom Tanggal --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-50 text-blue-700 border border-blue-100">
                                    <i class="far fa-calendar-alt mr-1.5 mt-0.5"></i>
                                    {{ \Carbon\Carbon::parse($item->tanggal_kegiatan)->format('d M Y') }}
                                </span>
                            </td>

                            {{-- Kolom Deskripsi --}}
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-600 line-clamp-2 max-w-xs">
                                    {{ $item->deskripsi_singkat }}
                                </div>
                            </td>

                            {{-- Kolom Aksi --}}
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <div class="flex justify-center items-center space-x-3">
                                    {{-- Tombol Edit --}}
                                    <a href="{{ route('admin.galeri.edit', $item->id_kegiatan) }}"
                                       class="text-amber-500 hover:text-amber-700 bg-amber-50 hover:bg-amber-100 p-2 rounded-lg transition-colors group-hover:shadow-sm"
                                       title="Edit Data">
                                        <i class="fas fa-pen"></i>
                                    </a>

                                    {{-- Tombol Hapus --}}
                                    <form action="{{ route('admin.galeri.destroy', $item->id_kegiatan) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini beserta semua fotonya? Data tidak dapat dikembalikan.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 p-2 rounded-lg transition-colors group-hover:shadow-sm"
                                                title="Hapus Data">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        {{-- Empty State --}}
                        <tr>
                            <td colspan="4" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="bg-gray-100 rounded-full p-4 mb-4">
                                        <i class="fas fa-folder-open text-gray-400 text-3xl"></i>
                                    </div>
                                    <h3 class="text-lg font-medium text-gray-900">Belum ada kegiatan</h3>
                                    <p class="text-gray-500 mt-1 max-w-sm">Mulai dokumentasikan kegiatan Anda dengan menekan tombol tambah di atas.</p>
                                    <div class="mt-6">
                                        <a href="{{ route('admin.galeri.create') }}" class="text-blue-600 hover:text-blue-800 font-medium text-sm hover:underline">
                                            + Tambah Kegiatan Baru
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="bg-gray-50 px-6 py-3 border-t border-gray-200">
            <div class="text-xs text-gray-500">
                Menampilkan total {{ count($galeri) }} data kegiatan.
            </div>
        </div>
    </div>
</div>
@endsection
