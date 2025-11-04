{{-- Pake layout admin (sidebar, header, dll) --}}
@extends('layouts.admin')

{{-- Ini judul halaman di tab browser --}}
@section('title', 'Data Pengaduan Warga')

{{-- Mulai bagian konten utama --}}
@section('content')
<div class="p-6">
    {{-- Judul gede di atas halaman --}}
    <h1 class="text-2xl font-bold mb-6 text-gray-800">📋 Daftar Pengaduan Warga</h1>

    {{--
        Cek ada "pesan sukses" gak dari session (biasanya muncul abis update/delete).
        Kalo ada, tampilin di kotak ijo ini.
    --}}
    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-600 text-green-800 p-3 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{--
        Bungkus tabelnya pake div ini.
        overflow-x-auto = Bikin tabelnya bisa di-scroll ke samping kalo di HP. Wajib!
    --}}
    <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
        <table class="min-w-full border-collapse">
            {{-- Bagian kepala tabel --}}
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold">No</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Nama Pengadu</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Judul</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Tanggal</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Status</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Aksi</th>
                </tr>
            </thead>
            {{-- Bagian isi tabel --}}
            <tbody>
                {{--
                    Kita looping data $pengaduans yang dikirim dari Controller.
                    Pake @forelse biar gampang kalo datanya kosong, nanti lari ke @empty.
                    $index itu buat nomor urut (mulainya dari 0).
                    $p itu satu item data pengaduan.
                --}}
                @forelse($pengaduans as $index => $p)
                <tr class="border-b hover:bg-gray-50">
                    {{-- Kolom Nomor. $index + 1 biar mulainya dari 1 --}}
                    <td class="px-4 py-3">{{ $index + 1 }}</td>
                    {{-- Kolom Nama --}}
                    <td class="px-4 py-3">{{ $p->nama_pengadu }}</td>
                    {{-- Kolom Judul --}}
                    <td class="px-4 py-3">{{ $p->judul_pengaduan }}</td>
                    {{-- Kolom Tanggal --}}
                    <td class="px-4 py-3">{{ $p->tanggal_pengaduan }}</td>

                    {{-- Kolom Status (Dropdown) --}}
                    <td class="px-4 py-3">
                        {{--
                            Ini keren nih. Kita pake form kecil di tiap baris
                            buat ganti status langsung.
                        --}}
                        <form action="{{ route('admin.pengaduan.updateStatus', $p->id_pengaduan) }}" method="POST">
                            @csrf {{-- Jimat Laravel, wajib --}}

                            {{--
                                onchange="this.form.submit()"
                                Ini triknya! Begitu dropdown-nya diganti, form-nya otomatis ke-submit.
                                Gak perlu tombol simpan lagi.
                            --}}
                            <select name="status_pengaduan" onchange="this.form.submit()"
                                {{--
                                    Ini logika buat ganti warna background dropdown-nya.
                                    Kalo Baru=biru, Proses=kuning, Selesai=ijo.
                                --}}
                                class="rounded px-2 py-1 border text-sm
                                    @if($p->status_pengaduan=='Baru') bg-blue-100 text-blue-800
                                    @elseif($p->status_pengaduan=='Dalam Proses') bg-yellow-100 text-yellow-800
                                    @else bg-green-100 text-green-800 @endif">

                                {{--
                                    Ini logika buat nentuin 'selected' di option-nya,
                                    biar statusnya pas sama data yang ada.
                                --}}
                                <option value="Baru" {{ $p->status_pengaduan=='Baru' ? 'selected' : '' }}>Baru</option>
                                <option value="Dalam Proses" {{ $p->status_pengaduan=='Dalam Proses' ? 'selected' : '' }}>Dalam Proses</option>
                                <option value="Selesai" {{ $p->status_pengaduan=='Selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </form>
                    </td>

                    {{-- Kolom Aksi (Tombol-tombol) --}}
                    <td class="px-4 py-3 space-x-2">
                        {{-- Tombol Lihat Detail. Pake link <a> biasa --}}
                        <a href="{{ route('admin.pengaduan.show', $p->id_pengaduan) }}"
                           class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 text-sm">👁️ Lihat</a>

                        {{-- Tombol Hapus. HARUS pake form --}}
                        <form action="{{ route('admin.pengaduan.destroy', $p->id_pengaduan) }}" method="POST" class="inline"
                              onsubmit="return confirm('Yakin ingin menghapus pengaduan ini?')"> {{-- Munculin pop-up konfirmasi --}}
                            @csrf {{-- Jimat --}}
                            @method('DELETE') {{-- Bilang ke Laravel ini method DELETE --}}
                            <button type="submit"
                                class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-sm">🗑️ Hapus</button>
                        </form>
                    </td>
                </tr>
                {{--
                    Ini bagian @empty.
                    Kalo $pengaduans-nya kosong (gak ada data), yang ditampilin baris ini.
                --}}
                @empty
                <tr>
                    {{-- colspan="6" = Gabungin 6 kolom jadi satu --}}
                    <td colspan="6" class="text-center py-6 text-gray-500">Belum ada pengaduan masuk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
