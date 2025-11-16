{{-- resources/views/admin/arsip/edit.blade.php --}}

@extends('layouts.admin')

@section('content')
    <div class="space-y-6">
        {{-- Header --}}
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">Edit Arsip</h1>
                <p class="text-sm text-gray-600 mt-1">Perbarui arsip: {{ $arsip->judul_arsip }}</p>
            </div>
        </div>

        {{-- Form Card --}}
        <div class="bg-white shadow-sm border rounded-xl flex flex-col gap-6">
            <form action="{{ route('admin.arsip.update', $arsip->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid auto-rows-min grid-rows-[auto_auto] items-start gap-1.5 px-6 pt-6">
                    <h4 class="leading-none text-lg font-semibold">Formulir Edit Arsip</h4>
                </div>

                <div class="px-6 [&:last-child]:pb-6 grid gap-4 py-4">

                    {{-- Nomor Arsip --}}
                    <div class="grid gap-2">
                        <label for="nomor_arsip" class="flex items-center gap-2 text-sm leading-none font-medium">Nomor Arsip</label>
                        <input id="nomor_arsip" name="nomor_arsip"
                               class="flex h-9 w-full min-w-0 rounded-md border border-input bg-input-background px-3 py-1 text-base @error('nomor_arsip') border-destructive @enderror"
                               value="{{ old('nomor_arsip', $arsip->nomor_arsip) }}">
                        @error('nomor_arsip') <p class="text-xs text-destructive">{{ $message }}</p> @enderror
                    </div>

                    {{-- Judul Arsip --}}
                    <div class="grid gap-2">
                        <label for="judul_arsip" class="flex items-center gap-2 text-sm leading-none font-medium">Judul Arsip *</label>
                        <input id="judul_arsip" name="judul_arsip"
                               placeholder="Masukkan judul arsip"
                               class="flex h-9 w-full min-w-0 rounded-md border border-input bg-input-background px-3 py-1 text-base @error('judul_arsip') border-destructive @enderror"
                               value="{{ old('judul_arsip', $arsip->judul_arsip) }}" required>
                        @error('judul_arsip') <p class="text-xs text-destructive">{{ $message }}</p> @enderror
                    </div>

                    {{-- Kategori --}}
                    <div class="grid gap-2">
                        <label for="kategori" class="flex items-center gap-2 text-sm leading-none font-medium">Kategori Arsip *</label>
                        <select id="kategori" name="kategori"
                                class="flex h-9 w-full items-center justify-between gap-2 rounded-md border border-input bg-input-background px-3 py-2 text-sm whitespace-nowrap @error('kategori') border-destructive @enderror"
                                required>
                            <option value="Surat Masuk" {{ old('kategori', $arsip->kategori) == 'Surat Masuk' ? 'selected' : '' }}>Surat Masuk</option>
                            <option value="Surat Keluar" {{ old('kategori', $arsip->kategori) == 'Surat Keluar' ? 'selected' : '' }}>Surat Keluar</option>
                            <option value="Dokumen Penting" {{ old('kategori', $arsip->kategori) == 'Dokumen Penting' ? 'selected' : '' }}>Dokumen Penting</option>
                        </select>
                        @error('kategori') <p class="text-xs text-destructive">{{ $message }}</p> @enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div class="grid gap-2">
                        <label for="deskripsi" class="flex items-center gap-2 text-sm leading-none font-medium">Deskripsi Arsip</label>
                        <textarea id="deskripsi" name="deskripsi"
                                  placeholder="Masukkan deskripsi (opsional)"
                                  rows="3"
                                  class="resize-none border-input flex min-h-16 w-full rounded-md border bg-input-background px-3 py-2 text-base @error('deskripsi') border-destructive @enderror">{{ old('deskripsi', $arsip->deskripsi) }}</textarea>
                        @error('deskripsi') <p class="text-xs text-destructive">{{ $message }}</p> @enderror
                    </div>

                    {{-- Tanggal Arsip --}}
                    <div class="grid gap-2">
                        <label for="tanggal_arsip" class="flex items-center gap-2 text-sm leading-none font-medium">Tanggal Arsip *</label>
                        <input id="tanggal_arsip" name="tanggal_arsip" type="date"
                               class="flex h-9 w-full min-w-0 rounded-md border border-input bg-input-background px-3 py-1 text-base @error('tanggal_arsip') border-destructive @enderror"
                               value="{{ old('tanggal_arsip', $arsip->tanggal_arsip->format('Y-m-d')) }}" required>
                        @error('tanggal_arsip') <p class="text-xs text-destructive">{{ $message }}</p> @enderror
                    </div>

                    {{-- Status --}}
                    <div class="flex items-center justify-between">
                        <div class="space-y-0.5">
                            <label for="status" class="flex items-center gap-2 text-sm leading-none font-medium">Status Arsip</label>
                            <p class="text-xs text-gray-500">Atur status arsip menjadi aktif atau tidak aktif</p>
                        </div>
                        <input type="checkbox" name="status" id="status" value="Aktif"
                               class="peer h-[1.15rem] w-8 shrink-0 rounded-full border-transparent data-[state=checked]:bg-primary data-[state=unchecked]:bg-switch-background"
                               role="switch"
                               {{ old('status', $arsip->status) == 'Aktif' ? 'checked' : '' }}>
                    </div>

                    {{-- FILE LAMPIRAN --}}
                    <div class="grid gap-2">
                        <label for="file_lampiran" class="flex items-center gap-2 text-sm leading-none font-medium">
                            File Lampiran Baru (Opsional)
                        </label>

                        <input id="file_lampiran" name="file_lampiran" type="file"
                               class="flex h-9 w-full min-w-0 rounded-md border border-input bg-input-background px-3 py-1 text-base file:font-medium file:border-0 file:bg-transparent file:text-sm @error('file_lampiran') border-destructive @enderror">

                        {{-- PREVIEW FILE LAMA --}}
                        @if ($arsip->file_lampiran)
                            @php
                                $fileUrl = Storage::url($arsip->file_lampiran);
                                $ext = strtolower(pathinfo($arsip->file_lampiran, PATHINFO_EXTENSION));
                                $isImage = in_array($ext, ['jpg','jpeg','png','gif','webp']);
                            @endphp

                            <p class="text-xs text-gray-500">File saat ini:
                                <a href="{{ $fileUrl }}" target="_blank" class="text-primary hover:underline">
                                    {{ basename($arsip->file_lampiran) }}
                                </a>
                            </p>

                            @if($isImage)
                                <div class="mt-3">
                                    <img src="{{ $fileUrl }}"
                                         alt="Preview File"
                                         class="w-40 h-auto rounded-md border shadow-sm">
                                </div>
                            @endif
                        @endif

                        {{-- PREVIEW FILE BARU --}}
                        <p class="text-xs font-semibold mt-3">Preview File Baru:</p>
                        <div id="previewContainer" class="mt-2"></div>

                        <p class="text-xs text-gray-500">Biarkan kosong jika tidak ingin mengubah file.</p>
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
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- 🔥 SCRIPT PREVIEW FILE BARU --}}
    <script>
        document.getElementById('file_lampiran').addEventListener('change', function(event) {
            let file = event.target.files[0];
            let previewContainer = document.getElementById('previewContainer');

            previewContainer.innerHTML = "";

            if (!file) return;

            let fileType = file.type;

            if (fileType.includes('image')) {
                let img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.className = "w-40 rounded-md border shadow-sm";
                previewContainer.appendChild(img);
            }
            else if (fileType === "application/pdf") {
                let iframe = document.createElement('iframe');
                iframe.src = URL.createObjectURL(file);
                iframe.className = "w-full h-64 border rounded";
                previewContainer.appendChild(iframe);
            }
            else {
                let div = document.createElement('div');
                div.className = "p-3 bg-gray-100 rounded border text-sm";
                div.innerHTML = `
                    File dipilih: <strong>${file.name}</strong><br>
                    (Preview tidak tersedia untuk tipe file ini)
                `;
                previewContainer.appendChild(div);
            }
        });
    </script>

@endsection
