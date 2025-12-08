@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-semibold">Edit Arsip</h1>
    </div>

    <div class="bg-white shadow-sm border rounded-xl">
        <form action="{{ route('admin.arsip.update', $arsip->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="px-6 py-6 grid gap-4">
                {{-- Input Standar (Nomor, Judul, dll) Sama seperti Create --}}
                <div class="grid gap-2">
                    <label class="text-sm font-medium">Nomor Arsip</label>
                    <input type="text" name="nomor_arsip" value="{{ old('nomor_arsip', $arsip->nomor_arsip) }}" class="w-full rounded-md border px-3 py-1">
                </div>

                <div class="grid gap-2">
                    <label class="text-sm font-medium">Judul Arsip</label>
                    <input type="text" name="judul_arsip" value="{{ old('judul_arsip', $arsip->judul_arsip) }}" required class="w-full rounded-md border px-3 py-1">
                </div>

                <div class="grid gap-2">
                    <label class="text-sm font-medium">Kategori</label>
                    <select name="kategori" required class="w-full rounded-md border px-3 py-2">
                        <option value="Surat Masuk" {{ $arsip->kategori == 'Surat Masuk' ? 'selected' : '' }}>Surat Masuk</option>
                        <option value="Surat Keluar" {{ $arsip->kategori == 'Surat Keluar' ? 'selected' : '' }}>Surat Keluar</option>
                        <option value="Dokumen Penting" {{ $arsip->kategori == 'Dokumen Penting' ? 'selected' : '' }}>Dokumen Penting</option>
                    </select>
                </div>

                <div class="grid gap-2">
                    <label class="text-sm font-medium">Deskripsi</label>
                    <textarea name="deskripsi" rows="3" class="w-full rounded-md border px-3 py-2">{{ old('deskripsi', $arsip->deskripsi) }}</textarea>
                </div>

                <div class="grid gap-2">
                    <label class="text-sm font-medium">Tanggal Arsip</label>
                    <input type="date" name="tanggal_arsip" value="{{ old('tanggal_arsip', $arsip->tanggal_arsip->format('Y-m-d')) }}" required class="w-full rounded-md border px-3 py-1">
                </div>

                <div class="flex items-center justify-between">
                    <label class="text-sm font-medium">Status Arsip</label>
                    <input type="checkbox" name="status" value="Aktif" {{ $arsip->status == 'Aktif' ? 'checked' : '' }} class="h-6 w-10 rounded-full border">
                </div>

                {{-- FILE LAMPIRAN --}}
                <div class="grid gap-2 border-t pt-4">
                    <label class="text-sm font-medium">File Lampiran</label>

                    {{-- 1. List File Lama (Normalisasi) --}}
                    @php
                        $files = $arsip->file_lampiran;
                        if (empty($files)) $files = [];
                        elseif (is_string($files)) {
                            $decoded = json_decode($files, true);
                            $files = is_array($decoded) ? $decoded : [$files];
                        }
                    @endphp

                    <div class="bg-gray-50 p-3 rounded border">
                        <p class="text-xs font-semibold mb-2">File Saat Ini:</p>
                        @if(count($files) > 0)
                            <ul class="space-y-1">
                                @foreach($files as $f)
                                    <li class="text-xs flex items-center gap-2">
                                        <i class="fas fa-check text-green-500"></i>
                                        <a href="{{ Storage::url($f) }}" target="_blank" class="text-blue-600 hover:underline">{{ basename($f) }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-xs text-gray-500">- Kosong -</p>
                        @endif
                    </div>

                    {{-- 2. Upload Baru --}}
                    <label class="mt-2 text-sm">Upload File Baru (Akan menimpa file lama)</label>
                    <input id="file_lampiran" name="file_lampiran[]" type="file" multiple class="w-full text-sm border rounded p-2">
                    <div id="previewContainer" class="grid grid-cols-4 gap-2 mt-2"></div>
                </div>
            </div>

            {{-- Card Footer --}}
            <div class="flex items-center justify-end gap-2 px-6 pb-6 bg-gray-50/50 rounded-b-xl pt-4">
                <a href="{{ route('admin.arsip.index') }}"
                   class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Batal
                </a>
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md text-sm font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('file_lampiran').addEventListener('change', function(e){
    const container = document.getElementById('previewContainer');
    container.innerHTML = '';
    Array.from(e.target.files).forEach(file => {
        container.innerHTML += `<div class="p-1 border rounded bg-white text-xs truncate">${file.name}</div>`;
    });
});
</script>
@endpush
