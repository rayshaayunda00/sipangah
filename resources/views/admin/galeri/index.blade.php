{{--
    Kita "pinjam" lagi layout admin (layouts/admin.blade.php)
    buat nampilin sidebar, header, dll.
--}}
@extends('layouts.admin')

{{--
    Semua yang ada di dalam section ini bakal
    dimasukin ke @yield('content') di file layout.
--}}
@section('content')

{{-- Kasih padding 6 biar ada jarak dari pinggir --}}
<div class="p-6">

    {{-- Ini baris buat judul halaman dan tombol "Tambah Kegiatan" --}}
    <div class="flex justify-between items-center mb-6">
        {{-- Judul halamannya --}}
        <h1 class="text-2xl font-bold">📸 Daftar Kegiatan Galeri</h1>

        {{--
            Tombol ini bakal ngarah ke route 'admin.galeri.create',
            yang nampilin form tambah data (file yang kita komentari sebelumnya).
        --}}
        <a href="{{ route('admin.galeri.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
            + Tambah Kegiatan
        </a>
    </div>

    {{--
        Ini buat nampilin pesan 'sukses' (Flash Message).
        Pesan ini kita kirim dari Controller (pakai ->with('success', '...'))
        setelah berhasil nambah, edit, atau hapus data.
    --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-800 p-3 rounded mb-4">
            ✅ {{ session('success') }}
        </div>
    @endif

    {{--
        Bungkus tabelnya pake div ini biar bisa di-scroll
        ke samping (horizontal) kalo di layar kecil/HP.
    --}}
    <div class="overflow-x-auto">
        {{-- Mulai tabelnya --}}
        <table class="w-full border-collapse bg-white shadow rounded-lg">
            {{-- Ini kepala tabel (header) --}}
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="p-3 text-left w-28">Thumbnail</th>
                    <th class="p-3 text-left">Judul</th>
                    <th class="p-3 text-left">Tanggal</th>
                    <th class="p-3 text-left">Deskripsi</th>
                    <th class="p-3 text-center w-48">Aksi</th> {{-- Kolom buat tombol Edit/Hapus --}}
                </tr>
            </thead>
            {{-- Ini badan tabel (isinya) --}}
            <tbody>
                {{--
                    Kita looping datanya pakai @forelse.
                    Ini kayak @foreach, tapi ada @empty-nya.
                    $galeri itu variabel yang dikirim dari Controller.
                    Tiap data di $galeri kita panggil sebagai $item.
                --}}
                @forelse ($galeri as $item)
                    <tr class="border-b hover:bg-gray-50 transition">
                        {{-- Kolom Thumbnail --}}
                        <td class="p-3">
                            {{-- Cek dulu, ada thumbnail-nya gak? --}}
                            @if($item->thumbnail_url)
                                {{--
                                    Kalo ada, tampilin gambarnya.
                                    Pake asset('storage/...') buat ngakses file di folder public/storage.
                                --}}
                                <img src="{{ asset('storage/'.$item->thumbnail_url) }}" alt="thumb" class="w-24 h-16 object-cover rounded shadow-sm">
                            @else
                                {{-- Kalo gak ada, tampilin teks ini --}}
                                <span class="text-gray-400 italic">Tidak ada</span>
                            @endif
                        </td>
                        {{-- Kolom Judul --}}
                        <td class="p-3 font-semibold text-gray-800">{{ $item->judul_kegiatan }}</td>
                        {{-- Kolom Tanggal --}}
                        <td class="p-3 text-gray-600">
                            {{--
                                Kita format tanggalnya pake Carbon biar cakep (cth: 04 Nov 2025).
                                Gak format default YYYY-MM-DD.
                            --}}
                            {{ \Carbon\Carbon::parse($item->tanggal_kegiatan)->format('d M Y') }}
                        </td>
                        {{-- Kolom Deskripsi --}}
                        <td class="p-3 text-gray-700">{{ $item->deskripsi_singkat }}</td>
                        {{-- Kolom Aksi (Tombol-tombol) --}}
                        <td class="p-3 text-center">
                            <div class="flex justify-center space-x-2">
                                {{-- Tombol Edit: Ini link biasa (<a>) aja --}}
                                <a href="{{ route('admin.galeri.edit', $item->id_kegiatan) }}"
                                   class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">
                                    ✏️ Edit
                                </a>
                                {{--
                                    Tombol Hapus: WAJIB pake <form> dengan method DELETE.
                                    Gak bisa pake link <a> biasa.
                                --}}
                                <form action="{{ route('admin.galeri.destroy', $item->id_kegiatan) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kegiatan ini?')">
                                    @csrf {{-- Jimat keamanan Laravel, wajib --}}
                                    @method('DELETE') {{-- Bilang ke Laravel kalo ini method DELETE, bukan POST --}}
                                    <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition">
                                        🗑 Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                {{--
                    Ini bagian @empty dari @forelse.
                    Bagian ini cuma muncul kalo variabel $galeri-nya kosong (gak ada data).
                --}}
                @empty
                    <tr>
                        <td colspan="5" class="p-4 text-center text-gray-500 italic">Belum ada kegiatan galeri.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
