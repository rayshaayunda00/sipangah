@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-black text-gray-900 tracking-tight">Edit Kegiatan</h1>
            <p class="text-sm text-gray-500 mt-1">Perbarui informasi utama atau kelola dokumentasi foto.</p>
        </div>
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

    @if ($errors->any())
        <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg shadow-sm">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-circle text-red-500"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-bold text-red-800">Terdapat kesalahan:</h3>
                    <ul class="mt-1 list-disc list-inside text-sm text-red-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden sticky top-6">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 flex items-center">
                    <div class="bg-blue-100 text-blue-600 w-8 h-8 rounded-full flex items-center justify-center mr-3">
                        <i class="fas fa-pen text-sm"></i>
                    </div>
                    <h2 class="font-bold text-gray-800">Data Utama</h2>
                </div>

                <div class="p-6">
                    <form action="{{ route('admin.galeri.update', $kegiatan->id_kegiatan) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-5">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Kegiatan</label>
                            <input type="text" name="judul_kegiatan" value="{{ old('judul_kegiatan', $kegiatan->judul_kegiatan) }}"
                                   class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all text-sm" required>
                        </div>

                        <div class="mb-5">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Singkat</label>
                            <textarea name="deskripsi_singkat" rows="5"
                                      class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all text-sm" required>{{ old('deskripsi_singkat', $kegiatan->deskripsi_singkat) }}</textarea>
                        </div>

                        <div class="mb-5">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Kegiatan</label>
                            {{-- PERBAIKAN TANGGAL DI SINI: --}}
                            <input type="date"
                                   name="tanggal_kegiatan"
                                   {{-- Kita format paksa ke Y-m-d agar input date HTML5 bisa membacanya --}}
                                   value="{{ old('tanggal_kegiatan', optional($kegiatan->tanggal_kegiatan)->format('Y-m-d')) }}"
                                   class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all text-sm"
                                   required>
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Thumbnail (Cover)</label>

                            @if($kegiatan->thumbnail_url)
                                <div class="mb-3 relative rounded-lg overflow-hidden border border-gray-200 group">
                                    <img src="{{ asset('storage/' . $kegiatan->thumbnail_url) }}" class="w-full h-40 object-cover">
                                    <div class="absolute bottom-0 left-0 right-0 bg-black/50 text-white text-xs py-1 px-2 text-center">
                                        Cover Saat Ini
                                    </div>
                                </div>
                            @endif

                            <input type="file" name="thumbnail"
                                   class="block w-full text-xs text-gray-500
                                          file:mr-4 file:py-2 file:px-4
                                          file:rounded-full file:border-0
                                          file:text-xs file:font-semibold
                                          file:bg-blue-50 file:text-blue-700
                                          hover:file:bg-blue-100 cursor-pointer"
                                    accept="image/png, image/jpeg, image/jpg">
                            <p class="text-xs text-gray-400 mt-2">Biarkan kosong jika tidak ingin mengubah.</p>
                        </div>

                        <button type="submit" class="w-full flex justify-center items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-semibold text-white text-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all shadow-md">
                            <i class="fas fa-save mr-2"></i> Simpan Perubahan Data
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2 space-y-8">

            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="bg-teal-100 text-teal-600 w-8 h-8 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-cloud-upload-alt text-sm"></i>
                        </div>
                        <h2 class="font-bold text-gray-800">Tambah Dokumentasi Baru</h2>
                    </div>
                </div>

                <div class="p-6">
                    <form action="{{ route('admin.galeri.uploadFoto', $kegiatan->id_kegiatan) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="relative group mb-4">
                            <div class="w-full p-6 rounded-xl border-2 border-dashed border-teal-200 bg-teal-50/30 hover:bg-teal-50 transition-all text-center">
                                <i class="fas fa-images text-3xl text-teal-300 mb-2"></i>
                                <label for="upload-multiple" class="cursor-pointer block">
                                    <span class="text-teal-700 font-semibold hover:underline">Pilih Foto</span>
                                    <span class="text-gray-500 text-sm"> atau tarik file ke sini</span>
                                </label>
                                <input id="upload-multiple" type="file" name="url_foto[]" multiple class="hidden"
                                       accept="image/png, image/jpeg, image/jpg" onchange="handleFiles(this)" required>
                                <p class="text-xs text-gray-400 mt-1">
                                    Tips: Tahan <strong>CTRL</strong> (Windows) / <strong>CMD</strong> (Mac) untuk pilih banyak.
                                </p>
                            </div>
                        </div>

                        <div id="upload-preview-area" class="hidden mb-4">
                            <p class="text-sm font-semibold text-gray-700 mb-2">Preview Foto yang akan diupload:</p>
                            <div id="image-preview-container" class="grid grid-cols-3 sm:grid-cols-4 gap-2">
                                </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-600 mb-1">Caption / Keterangan (Opsional)</label>
                                <input type="text" name="deskripsi_foto" class="w-full border-gray-300 rounded-lg text-sm focus:ring-teal-500 focus:border-teal-500" placeholder="Contoh: Suasana kegiatan...">
                            </div>
                            <div>
                                <button type="submit" class="w-full flex justify-center items-center px-4 py-2 bg-teal-600 text-white rounded-lg font-semibold text-sm hover:bg-teal-700 transition shadow-md">
                                    <i class="fas fa-upload mr-2"></i> Upload Semua
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="bg-purple-100 text-purple-600 w-8 h-8 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-photo-video text-sm"></i>
                        </div>
                        <h2 class="font-bold text-gray-800">Galeri Foto Tersimpan</h2>
                    </div>
                    <span class="bg-gray-200 text-gray-700 text-xs font-bold px-2 py-1 rounded-full">
                        {{ $kegiatan->fotoGaleri->count() }} Foto
                    </span>
                </div>

                <div class="p-6">
                    @if($kegiatan->fotoGaleri->count() > 0)
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            @foreach($kegiatan->fotoGaleri as $foto)
                                <div class="relative group aspect-square rounded-xl overflow-hidden border border-gray-200 shadow-sm bg-gray-100">
                                    <img src="{{ asset('storage/' . $foto->url_foto) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">

                                    @if($foto->deskripsi_foto)
                                    <div class="absolute bottom-0 left-0 right-0 p-2 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                                        <p class="text-white text-xs truncate">{{ $foto->deskripsi_foto }}</p>
                                    </div>
                                    @endif

                                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-all duration-300 flex flex-col items-center justify-center gap-2 backdrop-blur-[2px]">
                                        <form action="{{ route('admin.galeri.foto.destroy', $foto->id_foto) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="inline-flex items-center px-3 py-1.5 bg-red-600 text-white text-xs font-bold rounded-full hover:bg-red-700 transition transform hover:scale-105 shadow-lg"
                                                    onclick="return confirm('Yakin ingin menghapus foto ini secara permanen?')">
                                                <i class="fas fa-trash-alt mr-1.5"></i> Hapus
                                            </button>
                                        </form>

                                        <a href="{{ asset('storage/' . $foto->url_foto) }}" target="_blank" class="text-white text-xs hover:underline mt-1">
                                            <i class="fas fa-expand mr-1"></i> Lihat Penuh
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12 bg-gray-50 rounded-xl border border-dashed border-gray-200">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                                <i class="fas fa-camera text-gray-400 text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900">Belum ada foto</h3>
                            <p class="text-gray-500 text-sm mt-1">Silakan upload foto dokumentasi pada form di atas.</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>

    </div>
</div>

{{-- Script Preview Gambar Upload --}}
<script>
    function handleFiles(input) {
        const previewArea = document.getElementById('upload-preview-area');
        const previewContainer = document.getElementById('image-preview-container');

        // Reset container
        previewContainer.innerHTML = '';

        if (input.files && input.files.length > 0) {
            previewArea.classList.remove('hidden');

            Array.from(input.files).forEach(file => {
                if (file.type.match('image.*')) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const div = document.createElement('div');
                        div.className = "relative aspect-square rounded-lg overflow-hidden border border-gray-200 bg-gray-100";
                        div.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover">`;
                        previewContainer.appendChild(div);
                    }

                    reader.readAsDataURL(file);
                }
            });
        } else {
            previewArea.classList.add('hidden');
        }
    }
</script>
@endsection
