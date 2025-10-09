@extends('layouts.admin')

@section('title', 'Data Pengaduan Warga')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">📋 Daftar Pengaduan Warga</h1>

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-600 text-green-800 p-3 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
        <table class="min-w-full border-collapse">
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
            <tbody>
                @forelse($pengaduans as $index => $p)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-3">{{ $index + 1 }}</td>
                    <td class="px-4 py-3">{{ $p->nama_pengadu }}</td>
                    <td class="px-4 py-3">{{ $p->judul_pengaduan }}</td>
                    <td class="px-4 py-3">{{ $p->tanggal_pengaduan }}</td>
                    <td class="px-4 py-3">
                        <form action="{{ route('admin.pengaduan.updateStatus', $p->id_pengaduan) }}" method="POST">
                            @csrf
                            <select name="status_pengaduan" onchange="this.form.submit()"
                                class="rounded px-2 py-1 border text-sm
                                    @if($p->status_pengaduan=='Baru') bg-blue-100 text-blue-800
                                    @elseif($p->status_pengaduan=='Dalam Proses') bg-yellow-100 text-yellow-800
                                    @else bg-green-100 text-green-800 @endif">
                                <option value="Baru" {{ $p->status_pengaduan=='Baru' ? 'selected' : '' }}>Baru</option>
                                <option value="Dalam Proses" {{ $p->status_pengaduan=='Dalam Proses' ? 'selected' : '' }}>Dalam Proses</option>
                                <option value="Selesai" {{ $p->status_pengaduan=='Selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </form>
                    </td>
                    <td class="px-4 py-3 space-x-2">
                        <a href="{{ route('admin.pengaduan.show', $p->id_pengaduan) }}"
                           class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 text-sm">👁️ Lihat</a>

                        <form action="{{ route('admin.pengaduan.destroy', $p->id_pengaduan) }}" method="POST" class="inline"
                              onsubmit="return confirm('Yakin ingin menghapus pengaduan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-sm">🗑️ Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-6 text-gray-500">Belum ada pengaduan masuk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
