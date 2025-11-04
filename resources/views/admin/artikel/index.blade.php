@extends('layouts.admin')

@section('content')
<div class="p-6">
    <!-- Judul halaman -->
    <h1 class="text-2xl font-bold mb-4">Daftar Artikel</h1>

    <!-- Tombol untuk menuju halaman tambah artikel baru -->
    <a href="{{ route('admin.artikel.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">
        + Tambah Artikel
    </a>

    <!-- Tabel daftar artikel -->
    <table class="w-full mt-6 bg-white border">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="p-2">Gambar</th>
                <th class="p-2">Judul</th>
                <th class="p-2">Kategori</th>
                <th class="p-2">Penulis</th>
                <th class="p-2">Status</th>
                <th class="p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($artikels as $artikel)
            <!-- Loop tiap artikel -->
            <tr class="border-b">
                <!-- Kolom gambar artikel -->
                <td class="p-3">
                    @if($artikel->url_gambar_utama)
                        <!-- Kalau ada gambar, tampilkan -->
                        <img src="{{ asset('storage/'.$artikel->url_gambar_utama) }}"
                             alt="Gambar Artikel"
                             class="w-20 h-20 object-cover rounded">
                    @else
                        <!-- Kalau nggak ada gambar -->
                        <span class="text-gray-400">Tidak ada</span>
                    @endif
                </td>

                <!-- Kolom judul artikel -->
                <td class="p-3">{{ $artikel->judul }}</td>

                <!-- Kolom kategori -->
                <td class="p-3">{{ $artikel->kategori->nama_kategori ?? '-' }}</td>

                <!-- Kolom penulis -->
                <td class="p-3">{{ $artikel->penulis->nama_penulis ?? '-' }}</td>

                <!-- Kolom status publikasi -->
                <td class="p-3">{{ $artikel->status_publikasi }}</td>

                <!-- Kolom aksi -->
                <td class="p-3 flex space-x-2">
                    <!-- Tombol edit -->
                    <a href="{{ route('admin.artikel.edit', $artikel->id_artikel) }}"
                       class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">
                        ✏️ Edit
                    </a>

                    <!-- Tombol hapus (pakai konfirmasi biar aman) -->
                    <form action="{{ route('admin.artikel.destroy', $artikel->id_artikel) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition"
                                onclick="return confirm('Yakin hapus?')">
                            🗑 Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination biar daftar artikelnya nggak terlalu panjang -->
    <div class="mt-4">{{ $artikels->links() }}</div>
</div>
@endsection
