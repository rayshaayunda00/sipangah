{{-- resources/views/admin/arsip/create.blade.php --}}

@extends('layouts.admin')

@section('title', 'Tambah Arsip Baru')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Tambah Arsip Baru</h1>
            <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">Isi formulir di bawah untuk menambahkan arsip baru</p>
        </div>
    </div>

    {{-- Form Card --}}
    <div class="bg-white dark:bg-gray-800 shadow-sm border dark:border-gray-700 rounded-xl">
        <form action="{{ route('admin.arsip.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Card Header --}}
            <div class="px-6 py-4 border-b dark:border-gray-700">
                <h4 class="text-lg font-semibold text-gray-900 dark:text-white">Formulir Arsip Baru</h4>
            </div>

            {{-- Card Content --}}
            <div class="px-6 py-6 grid gap-4">

                {{-- Nomor Arsip --}}
                <div class="grid gap-2">
                    <label for="nomor_arsip" class="text-sm font-medium text-gray-700 dark:text-gray-300">Nomor Arsip</label>
                    <input type="text" id="nomor_arsip" name="nomor_arsip"
                           placeholder="Kosongkan untuk generate otomatis"
                           value="{{ old('nomor_arsip') }}"
                           class="w-full rounded-md border border-input bg-input-background px-3 py-1 text-base @error('nomor_arsip') border-destructive @enderror">
                    <p class="text-xs text-gray-500">Biarkan kosong untuk generate otomatis</p>
                    @error('nomor_arsip') <p class="text-xs text-destructive">{{ $message }}</p> @enderror
                </div>

                {{-- Judul Arsip --}}
                <div class="grid gap-2">
                    <label for="judul_arsip" class="text-sm font-medium text-gray-700 dark:text-gray-300">Judul Arsip <span class="text-red-500">*</span></label>
                    <input type="text" id="judul_arsip" name="judul_arsip"
                           placeholder="Masukkan judul arsip"
                           value="{{ old('judul_arsip') }}" required
                           class="w-full rounded-md border border-input bg-input-background px-3 py-1 text-base @error('judul_arsip') border-destructive @enderror">
                    @error('judul_arsip') <p class="text-xs text-destructive">{{ $message }}</p> @enderror
                </div>

                {{-- Kategori --}}
                <div class="grid gap-2">
                    <label for="kategori" class="text-sm font-medium text-gray-700 dark:text-gray-300">Kategori Arsip <span class="text-red-500">*</span></label>
                    <select id="kategori" name="kategori" required
                            class="w-full rounded-md border border-input bg-input-background px-3 py-2 text-sm @error('kategori') border-destructive @enderror">
                        <option value="Surat Masuk" {{ old('kategori')=='Surat Masuk'?'selected':'' }}>Surat Masuk</option>
                        <option value="Surat Keluar" {{ old('kategori')=='Surat Keluar'?'selected':'' }}>Surat Keluar</option>
                        <option value="Dokumen Penting" {{ old('kategori')=='Dokumen Penting'?'selected':'' }}>Dokumen Penting</option>
                    </select>
                    @error('kategori') <p class="text-xs text-destructive">{{ $message }}</p> @enderror
                </div>

                {{-- Deskripsi --}}
                <div class="grid gap-2">
                    <label for="deskripsi" class="text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi Arsip</label>
                    <textarea id="deskripsi" name="deskripsi" rows="3"
                              placeholder="Masukkan deskripsi (opsional)"
                              class="w-full rounded-md border border-input bg-input-background px-3 py-2 text-base @error('deskripsi') border-destructive @enderror">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi') <p class="text-xs text-destructive">{{ $message }}</p> @enderror
                </div>

                {{-- Tanggal Arsip --}}
                <div class="grid gap-2">
                    <label for="tanggal_arsip" class="text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Arsip <span class="text-red-500">*</span></label>
                    <input type="date" id="tanggal_arsip" name="tanggal_arsip" required
                           value="{{ old('tanggal_arsip', now()->format('Y-m-d')) }}"
                           class="w-full rounded-md border border-input bg-input-background px-3 py-1 text-base @error('tanggal_arsip') border-destructive @enderror">
                    @error('tanggal_arsip') <p class="text-xs text-destructive">{{ $message }}</p> @enderror
                </div>

                {{-- Status --}}
                <div class="flex items-center justify-between">
                    <div>
                        <label for="status" class="text-sm font-medium text-gray-700 dark:text-gray-300">Status Arsip</label>
                        <p class="text-xs text-gray-500">Aktif / Tidak aktif</p>
                    </div>
                    <input type="checkbox" id="status" name="status" value="Aktif"
                           class="h-6 w-10 rounded-full border border-input"
                           {{ old('status','Aktif')=='Aktif'?'checked':'' }}>
                </div>

                {{-- File Lampiran --}}
                <div class="grid gap-2">
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">File Lampiran</label>
                    <label for="file_lampiran"
       class="relative flex flex-col items-center justify-center w-full h-32 border-2 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600">
    <div class="flex flex-col items-center justify-center pt-5 pb-6">
        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Klik untuk upload</span> atau seret file</p>
        <p class="text-xs text-gray-500 dark:text-gray-400">PDF, DOCX, XLSX, JPG, PNG (maks 2MB)</p>
    </div>
</label>

<input id="file_lampiran" name="file_lampiran" type="file" class="hidden">

                    <div id="previewContainer" class="mt-2 text-sm text-gray-500">(Belum ada file dipilih)</div>
                    @error('file_lampiran') <p class="text-xs text-destructive">{{ $message }}</p> @enderror
                </div>

            </div>

            {{-- Card Footer --}}
            <div class="flex items-center justify-end gap-2 px-6 pb-6">
                <a href="{{ route('admin.arsip.index') }}"
                   class="inline-flex items-center justify-center gap-2 rounded-md text-sm font-medium border bg-background text-foreground hover:bg-accent hover:text-accent-foreground h-9 px-4 py-2">
                    Batal
                </a>
                <button type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-md text-sm font-medium bg-primary text-primary-foreground hover:bg-primary/90 h-9 px-4 py-2">
                    Tambah Arsip
                </button>
            </div>
        </form>
    </div>

</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){
    const input = document.getElementById('file_lampiran');
    const preview = document.getElementById('previewContainer');

    input.addEventListener('change', function(e){
        const file = e.target.files[0];
        preview.innerHTML = '';

        if(!file){
            preview.innerText = "(Belum ada file dipilih)";
            return;
        }

        if(file.type.includes('image')){
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.className = "w-full max-w-xs rounded shadow border mt-1";
            preview.appendChild(img);
        } else if(file.type === 'application/pdf'){
            const iframe = document.createElement('iframe');
            iframe.src = URL.createObjectURL(file);
            iframe.className = "w-full h-64 border rounded mt-1";
            preview.appendChild(iframe);
        } else {
            preview.innerHTML = `<div class="p-2 bg-gray-100 dark:bg-gray-700 rounded border mt-1">
                <p class="text-xs font-semibold text-gray-800 dark:text-white">${file.name}</p>
                <p class="text-xs">(Preview tidak tersedia)</p>
            </div>`;
        }
    });
});
</script>
@endpush
