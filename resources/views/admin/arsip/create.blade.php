{{-- resources/views/admin/arsip/create.blade.php --}}

@extends('layouts.admin')

@section('content')
    <div class="space-y-6">
        {{-- Header --}}
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">Tambah Arsip Baru</h1>
                <p class="text-sm text-gray-600 mt-1">Isi formulir di bawah untuk menambahkan arsip baru</p>
            </div>
        </div>

        {{-- Form Card --}}
        <div class="bg-white shadow-sm border rounded-xl flex flex-col gap-6"> {{-- Card --}}
            <form action="{{ route('admin.arsip.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid auto-rows-min grid-rows-[auto_auto] items-start gap-1.5 px-6 pt-6"> {{-- CardHeader --}}
                    <h4 class="leading-none text-lg font-semibold">Formulir Arsip Baru</h4>
                </div>

                {{-- CardContent (Form Fields) --}}
                <div class="px-6 [&:last-child]:pb-6 grid gap-4 py-4">

                    <div class="grid gap-2">
                        <label for="nomor_arsip" class="flex items-center gap-2 text-sm leading-none font-medium">Nomor Arsip</label>
                        <input id="nomor_arsip" name="nomor_arsip"
                               placeholder="Kosongkan untuk generate otomatis"
                               class="flex h-9 w-full min-w-0 rounded-md border border-input bg-input-background px-3 py-1 text-base @error('nomor_arsip') border-destructive @enderror"
                               value="{{ old('nomor_arsip') }}">
                        <p class="text-xs text-gray-500">Biarkan kosong untuk generate otomatis</p>
                        @error('nomor_arsip') <p class="text-xs text-destructive">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid gap-2">
                        <label for="judul_arsip" class="flex items-center gap-2 text-sm leading-none font-medium">Judul Arsip *</label>
                        <input id="judul_arsip" name="judul_arsip"
                               placeholder="Masukkan judul arsip"
                               class="flex h-9 w-full min-w-0 rounded-md border border-input bg-input-background px-3 py-1 text-base @error('judul_arsip') border-destructive @enderror"
                               value="{{ old('judul_arsip') }}" required>
                        @error('judul_arsip') <p class="text-xs text-destructive">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid gap-2">
                        <label for="kategori" class="flex items-center gap-2 text-sm leading-none font-medium">Kategori Arsip *</label>
                        <select id="kategori" name="kategori"
                                class="flex h-9 w-full items-center justify-between gap-2 rounded-md border border-input bg-input-background px-3 py-2 text-sm whitespace-nowrap @error('kategori') border-destructive @enderror"
                                required>
                            <option value="Surat Masuk" {{ old('kategori') == 'Surat Masuk' ? 'selected' : '' }}>Surat Masuk</option>
                            <option value="Surat Keluar" {{ old('kategori') == 'Surat Keluar' ? 'selected' : '' }}>Surat Keluar</option>
                            <option value="Dokumen Penting" {{ old('kategori') == 'Dokumen Penting' ? 'selected' : '' }}>Dokumen Penting</option>
                        </select>
                        @error('kategori') <p class="text-xs text-destructive">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid gap-2">
                        <label for="deskripsi" class="flex items-center gap-2 text-sm leading-none font-medium">Deskripsi Arsip</label>
                        <textarea id="deskripsi" name="deskripsi"
                                  placeholder="Masukkan deskripsi (opsional)"
                                  rows="3"
                                  class="resize-none border-input flex min-h-16 w-full rounded-md border bg-input-background px-3 py-2 text-base @error('deskripsi') border-destructive @enderror">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi') <p class="text-xs text-destructive">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid gap-2">
                        <label for="tanggal_arsip" class="flex items-center gap-2 text-sm leading-none font-medium">Tanggal Arsip *</label>
                        <input id="tanggal_arsip" name="tanggal_arsip" type="date"
                               class="flex h-9 w-full min-w-0 rounded-md border border-input bg-input-background px-3 py-1 text-base @error('tanggal_arsip') border-destructive @enderror"
                               value="{{ old('tanggal_arsip', now()->format('Y-m-d')) }}" required>
                        @error('tanggal_arsip') <p class="text-xs text-destructive">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="space-y-0.5">
                            <label for="status" class="flex items-center gap-2 text-sm leading-none font-medium">Status Arsip</label>
                            <p class="text-xs text-gray-500">Atur status arsip menjadi aktif atau tidak aktif</p>
                        </div>
                        <input type="checkbox" name="status" id="status" value="Aktif"
                               class="peer h-[1.15rem] w-8 shrink-0 rounded-full border-transparent data-[state=checked]:bg-primary data-[state=unchecked]:bg-switch-background"
                               role="switch"
                               {{ old('status', 'Aktif') == 'Aktif' ? 'checked' : '' }}>
                    </div>

                    <div class="grid gap-2">
                        <label for="file_lampiran" class="flex items-center gap-2 text-sm leading-none font-medium">File Lampiran</label>
                        <input id="file_lampiran" name="file_lampiran" type="file"
                               class="flex h-9 w-full min-w-0 rounded-md border border-input bg-input-background px-3 py-1 text-base file:font-medium file:border-0 file:bg-transparent file:text-sm @error('file_lampiran') border-destructive @enderror">
                        <p class="text-xs text-gray-500">Opsional - File maks 2MB (pdf, doc, xlsx, jpg, png)</p>
                        @error('file_lampiran') <p class="text-xs text-destructive">{{ $message }}</p> @enderror
                    </div>
                </div>

                {{-- CardFooter --}}
                <div class="flex items-center px-6 pb-6 justify-end gap-2">
                    <a href="{{ route('admin.arsip.index') }}"
                       class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium border bg-background text-foreground hover:bg-accent hover:text-accent-foreground h-9 px-4 py-2">
                        Batal
                    </a>
                    <button type="submit"
                            class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium bg-primary text-primary-foreground hover:bg-primary/90 h-9 px-4 py-2">
                        Tambah Arsip
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
