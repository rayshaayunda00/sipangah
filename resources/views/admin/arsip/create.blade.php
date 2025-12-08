@extends('layouts.admin')
@section('title', 'Tambah Arsip Baru')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Tambah Arsip Baru</h1>
            <p class="text-sm text-gray-600 mt-1">Isi formulir di bawah untuk menambahkan arsip baru</p>
        </div>
    </div>

    <div class="bg-white shadow-sm border rounded-xl">
        <form action="{{ route('admin.arsip.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="px-6 py-4 border-b"><h4 class="text-lg font-semibold">Formulir Arsip Baru</h4></div>

            <div class="px-6 py-6 grid gap-4">
                {{-- Nomor Arsip --}}
                <div class="grid gap-2">
                    <label for="nomor_arsip" class="text-sm font-medium">Nomor Arsip</label>
                    <input type="text" id="nomor_arsip" name="nomor_arsip" placeholder="Kosongkan untuk auto-generate" value="{{ old('nomor_arsip') }}" class="w-full rounded-md border border-input px-3 py-1 text-base">
                    <p class="text-xs text-gray-500">Biarkan kosong otomatis dibuat sistem.</p>
                </div>

                {{-- Judul --}}
                <div class="grid gap-2">
                    <label for="judul_arsip" class="text-sm font-medium">Judul Arsip <span class="text-red-500">*</span></label>
                    <input type="text" id="judul_arsip" name="judul_arsip" value="{{ old('judul_arsip') }}" required class="w-full rounded-md border border-input px-3 py-1 text-base">
                </div>

                {{-- Kategori --}}
                <div class="grid gap-2">
                    <label for="kategori" class="text-sm font-medium">Kategori <span class="text-red-500">*</span></label>
                    <select id="kategori" name="kategori" required class="w-full rounded-md border border-input px-3 py-2 text-sm">
                        <option value="Surat Masuk">Surat Masuk</option>
                        <option value="Surat Keluar">Surat Keluar</option>
                        <option value="Dokumen Penting">Dokumen Penting</option>
                    </select>
                </div>

                {{-- Deskripsi --}}
                <div class="grid gap-2">
                    <label for="deskripsi" class="text-sm font-medium">Deskripsi</label>
                    <textarea id="deskripsi" name="deskripsi" rows="3" class="w-full rounded-md border border-input px-3 py-2">{{ old('deskripsi') }}</textarea>
                </div>

                {{-- Tanggal --}}
                <div class="grid gap-2">
                    <label for="tanggal_arsip" class="text-sm font-medium">Tanggal Arsip <span class="text-red-500">*</span></label>
                    <input type="date" id="tanggal_arsip" name="tanggal_arsip" value="{{ old('tanggal_arsip', now()->format('Y-m-d')) }}" required class="w-full rounded-md border border-input px-3 py-1 text-base">
                </div>

                {{-- Status --}}
                <div class="flex items-center justify-between">
                    <div>
                        <label class="text-sm font-medium">Status Arsip</label>
                        <p class="text-xs text-gray-500">Aktif / Tidak aktif</p>
                    </div>
                    <input type="checkbox" name="status" value="Aktif" checked class="h-6 w-10 rounded-full border border-input">
                </div>

                {{-- File Lampiran (MULTIPLE) --}}
                <div class="grid gap-2 pt-4 border-t">
                    <label class="text-sm font-medium">File Lampiran</label>
                    <label for="file_lampiran" class="relative flex flex-col items-center justify-center w-full h-32 border-2 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                            <p class="text-sm text-gray-500"><span class="font-semibold">Klik upload</span> atau seret file</p>
                            <p class="text-xs text-gray-500">Bisa pilih banyak file (PDF, JPG, PNG)</p>
                        </div>
                    </label>
                    <input id="file_lampiran" name="file_lampiran[]" type="file" multiple class="hidden">
                    <div id="previewContainer" class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-2"></div>
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
        let content = `<div class="p-2 border rounded bg-white text-xs truncate">${file.name}</div>`;
        if(file.type.startsWith('image/')) {
            content = `<img src="${URL.createObjectURL(file)}" class="h-20 w-full object-cover rounded border">`;
        }
        container.innerHTML += content;
    });
});
</script>
@endpush
