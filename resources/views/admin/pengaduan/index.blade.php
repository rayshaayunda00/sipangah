@extends('layouts.admin')

@section('title', 'Data Pengaduan Warga')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <div class="bg-white rounded-xl shadow-lg overflow-hidden p-6 sm:p-8">

        <div class="sm:flex sm:items-center sm:justify-between mb-6">
            <div>
                <h1 class="text-3xl font-black text-gray-900 tracking-tight">Daftar Pengaduan</h1>
                <p class="mt-2 text-sm text-gray-700">Pantau dan kelola laporan dari warga.</p>
            </div>

            </div>

        <div class="flex flex-col sm:flex-row gap-4 mb-6">
            <div class="relative flex-1">
                <input type="text"
                       class="w-full pl-4 pr-10 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm shadow-sm"
                       placeholder="Cari pengaduan berdasarkan nama atau judul...">
            </div>

            <div class="w-full sm:w-48">
                <select class="w-full border border-gray-300 rounded-lg py-2 px-3 text-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Semua Status</option>
                    <option value="Baru">Baru</option>
                    <option value="Dalam Proses">Dalam Proses</option>
                    <option value="Selesai">Selesai</option>
                </select>
            </div>

            <button class="px-6 py-2 bg-teal-600 text-white rounded-lg text-sm font-medium hover:bg-teal-700 transition shadow-sm">
                Filter
            </button>
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

        <div class="overflow-x-auto border border-gray-200 rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                            Pelapor & Tanggal
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                            Judul Pengaduan
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
                    @forelse($pengaduans as $index => $p)
                    <tr class="hover:bg-gray-50 transition-colors duration-200">

                        {{-- Kolom No --}}
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $index + 1 }}
                        </td>

                        {{-- Kolom Pelapor --}}
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-bold text-gray-900">
                                {{ $p->nama_pengadu }}
                            </div>
                            <div class="text-xs text-gray-500 mt-1 flex items-center">
                                <i class="far fa-calendar-alt mr-1.5"></i>
                                {{ \Carbon\Carbon::parse($p->tanggal_pengaduan)->format('d M Y') }}
                            </div>
                        </td>

                        {{-- Kolom Judul --}}
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900 font-medium line-clamp-1 max-w-xs" title="{{ $p->judul_pengaduan }}">
                                {{ $p->judul_pengaduan }}
                            </div>
                        </td>

                        {{-- Kolom Status (Dropdown Langsung) --}}
                        <td class="px-6 py-4 whitespace-nowrap">
                            <form action="{{ route('admin.pengaduan.updateStatus', $p->id_pengaduan) }}" method="POST">
                                @csrf
                                <select name="status_pengaduan" onchange="this.form.submit()"
                                        class="text-xs font-bold rounded-full px-3 py-1 border-0 focus:ring-2 focus:ring-offset-1 cursor-pointer shadow-sm
                                        @if($p->status_pengaduan == 'Baru') bg-blue-100 text-blue-700 focus:ring-blue-500
                                        @elseif($p->status_pengaduan == 'Dalam Proses') bg-yellow-100 text-yellow-700 focus:ring-yellow-500
                                        @elseif($p->status_pengaduan == 'Selesai') bg-green-100 text-green-700 focus:ring-green-500
                                        @else bg-gray-100 text-gray-700 @endif">

                                    <option value="Baru" {{ $p->status_pengaduan == 'Baru' ? 'selected' : '' }}>🔵 Baru</option>
                                    <option value="Dalam Proses" {{ $p->status_pengaduan == 'Dalam Proses' ? 'selected' : '' }}>🟡 Proses</option>
                                    <option value="Selesai" {{ $p->status_pengaduan == 'Selesai' ? 'selected' : '' }}>🟢 Selesai</option>
                                </select>
                            </form>
                        </td>

                        {{-- Kolom Aksi (ICON BUTTONS) --}}
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            <div class="flex justify-center items-center gap-2">

                                {{-- Tombol Lihat Detail (Icon Mata Biru) --}}
                                <a href="{{ route('admin.pengaduan.show', $p->id_pengaduan) }}"
                                   class="text-blue-500 hover:text-blue-700 bg-blue-50 hover:bg-blue-100 p-2 rounded-lg transition-colors group-hover:shadow-sm"
                                   title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>

                                {{-- Tombol Hapus (Icon Sampah Merah) --}}
                                <form action="{{ route('admin.pengaduan.destroy', $p->id_pengaduan) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengaduan ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                            class="text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 p-2 rounded-lg transition-colors group-hover:shadow-sm"
                                            title="Hapus Pengaduan">
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
                                    <i class="fas fa-inbox text-gray-400 text-3xl"></i>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900">Belum ada pengaduan</h3>
                                <p class="text-gray-500 mt-1">Belum ada laporan masuk dari warga.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
            {{-- {{ $pengaduans->links() }} --}}
            <div class="text-xs text-gray-500">
                Menampilkan total {{ count($pengaduans) }} pengaduan.
            </div>
        </div>
    </div>

</div>
@endsection
