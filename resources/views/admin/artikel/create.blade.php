@extends('layouts.admin')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-black text-gray-900 tracking-tight">Tambah Artikel</h1>
            <p class="text-sm text-gray-500 mt-1">Buat artikel berita atau informasi baru.</p>
        </div>
    </div>

    @if ($errors->any())
        <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg shadow-sm animate-fade-in-up">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-circle text-red-500"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-bold text-red-800">Terdapat beberapa kesalahan:</h3>
                    <ul class="mt-1 list-disc list-inside text-sm text-red-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        <form action="{{ route('admin.artikel.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-3">

                <div class="p-8 bg-gray-50 border-b lg:border-b-0 lg:border-r border-gray-100">
                    <div class="flex items-center mb-6">
                        <div class="bg-blue-100 text-blue-600 w-10 h-10 rounded-full flex items-center justify-center mr-3 shadow-sm">
                            <i class="fas fa-info-circle text-lg"></i>
                        </div>
                        <h2 class="text-lg font-bold text-gray-800">Informasi Artikel</h2>
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Artikel <span class="text-red-500">*</span></label>
                        <input type="text" name="judul" value="{{ old('judul') }}"
                               class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('judul') border-red-500 ring-2 ring-red-100 @enderror"
                               placeholder="Masukkan judul yang menarik..." required>
                        @error('judul') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori <span class="text-red-500">*</span></label>
                        <select name="id_kategori" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all bg-white @error('id_kategori') border-red-500 @enderror">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategori as $k)
                                <option value="{{ $k->id_kategori }}" {{ old('id_kategori') == $k->id_kategori ? 'selected' : '' }}>
                                    {{ $k->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_kategori') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Penulis</label>
                        <select name="id_penulis" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all bg-white">
                            <option value="">-- Pilih Penulis (Opsional) --</option>
                            @foreach($penulis as $p)
                                <option value="{{ $p->id_penulis }}" {{ old('id_penulis') == $p->id_penulis ? 'selected' : '' }}>
                                    {{ $p->nama_penulis }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Status Publikasi</label>
                        <div class="flex space-x-4">
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input type="radio" name="status_publikasi" value="published" class="text-blue-600 focus:ring-blue-500" {{ old('status_publikasi') == 'published' ? 'checked' : '' }}>
                                <span class="text-sm text-gray-700">Published</span>
                            </label>
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input type="radio" name="status_publikasi" value="draft" class="text-gray-600 focus:ring-gray-500" {{ old('status_publikasi') == 'draft' || !old('status_publikasi') ? 'checked' : '' }}>
                                <span class="text-sm text-gray-700">Draft</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-2 p-8 bg-white">
                    <div class="flex items-center mb-6">
                        <div class="bg-teal-100 text-teal-600 w-10 h-10 rounded-full flex items-center justify-center mr-3 shadow-sm">
                            <i class="fas fa-file-alt text-lg"></i>
                        </div>
                        <h2 class="text-lg font-bold text-gray-800">Konten & Media</h2>
                    </div>

                    <div class="mb-6 p-5 rounded-xl border border-dashed border-gray-300 bg-gray-50 hover:bg-gray-100 transition-colors">
                        <label class="block text-sm font-bold text-gray-700 mb-2">
                            Gambar Utama / Cover
                            <span class="text-gray-400 font-normal ml-1">(Opsional)</span>
                        </label>

                        <input type="file"
                               name="url_gambar_utama"
                               id="gambar-input"
                               onchange="previewImage(this)"
                               class="block w-full text-sm text-gray-500
                                      file:mr-4 file:py-2 file:px-4
                                      file:rounded-full file:border-0
                                      file:text-sm file:font-semibold
                                      file:bg-teal-50 file:text-teal-700
                                      hover:file:bg-teal-100
                                      cursor-pointer"
                               accept="image/*">

                        <p class="text-xs text-gray-500 mt-2">Format: JPG, PNG, JPEG. Max: 2MB.</p>
                        @error('url_gambar_utama') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror

                        <div id="image-preview" class="hidden mt-4">
                            <p class="text-xs text-gray-600 font-semibold mb-2">Preview:</p>
                            <div class="relative w-full max-w-sm h-48 rounded-lg overflow-hidden border border-gray-200 shadow-sm">
                                <img id="preview-img" src="" alt="Preview" class="w-full h-full object-cover">
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Isi Artikel <span class="text-red-500">*</span></label>
                        <textarea name="isi_konten" rows="12"
                                  class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all font-mono text-sm leading-relaxed @error('isi_konten') border-red-500 @enderror"
                                  placeholder="Mulai menulis artikel Anda di sini..." required>{{ old('isi_konten') }}</textarea>
                        @error('isi_konten') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 px-8 py-5 border-t border-gray-100 flex items-center justify-end">
                <a href="{{ route('admin.artikel.index') }}" class="text-gray-600 hover:text-gray-900 font-medium text-sm mr-6">Batal</a>
                <button type="submit" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 border border-transparent rounded-lg font-semibold text-white shadow-md hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all transform hover:-translate-y-0.5">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Artikel
                </button>
            </div>
        </form>
    </div>
</div>

{{-- SCRIPT PREVIEW GAMBAR --}}
<script>
    function previewImage(input) {
        const previewDiv = document.getElementById('image-preview');
        const previewImg = document.getElementById('preview-img');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                previewImg.src = e.target.result;
                previewDiv.classList.remove('hidden');
            }

            reader.readAsDataURL(input.files[0]);
        } else {
            previewImg.src = "";
            previewDiv.classList.add('hidden');
        }
    }
</script>
@endsection
