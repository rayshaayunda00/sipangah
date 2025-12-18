@extends('layouts.admin')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-black text-gray-900 tracking-tight">Tambah Kegiatan</h1>
            <p class="text-sm text-gray-500 mt-1">Buat dokumentasi kegiatan baru untuk galeri.</p>
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
        <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-3">

                <div class="p-8 bg-gray-50 border-b lg:border-b-0 lg:border-r border-gray-100">
                    <div class="flex items-center mb-6">
                        <div class="bg-blue-100 text-blue-600 w-10 h-10 rounded-full flex items-center justify-center mr-3 shadow-sm">
                            <i class="fas fa-pen-alt text-lg"></i>
                        </div>
                        <h2 class="text-lg font-bold text-gray-800">Detail Informasi</h2>
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Kegiatan <span class="text-red-500">*</span></label>
                        <input type="text"
                               name="judul_kegiatan"
                               value="{{ old('judul_kegiatan') }}"
                               class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('judul_kegiatan') border-red-500 ring-2 ring-red-100 @enderror"
                               placeholder="Contoh: Kerja Bakti Desa..."
                               required>
                        @error('judul_kegiatan') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Pelaksanaan <span class="text-red-500">*</span></label>
                        <input type="date"
                               name="tanggal_kegiatan"
                               value="{{ old('tanggal_kegiatan') }}"
                               class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('tanggal_kegiatan') border-red-500 @enderror"
                               required>
                        @error('tanggal_kegiatan') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Singkat <span class="text-red-500">*</span></label>
                        <textarea name="deskripsi_singkat"
                                  rows="6"
                                  class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('deskripsi_singkat') border-red-500 @enderror"
                                  placeholder="Jelaskan secara singkat tentang kegiatan ini..."
                                  required>{{ old('deskripsi_singkat') }}</textarea>
                        @error('deskripsi_singkat') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="lg:col-span-2 p-8 bg-white">
                    <div class="flex items-center mb-6">
                        <div class="bg-teal-100 text-teal-600 w-10 h-10 rounded-full flex items-center justify-center mr-3 shadow-sm">
                            <i class="fas fa-images text-lg"></i>
                        </div>
                        <h2 class="text-lg font-bold text-gray-800">Media & Dokumentasi</h2>
                    </div>

                    <div class="mb-8 p-5 rounded-xl border border-dashed border-gray-300 bg-gray-50 hover:bg-gray-100 transition-colors">
                        <label class="block text-sm font-bold text-gray-700 mb-2">
                            Thumbnail / Cover Utama
                            <span class="text-gray-400 font-normal ml-1">(Opsional)</span>
                        </label>
                        <div class="flex items-center gap-4">
                            <input type="file"
                                   name="thumbnail"
                                   id="thumbnail-input"
                                   onchange="previewThumbnail(this)"
                                   class="block w-full text-sm text-gray-500
                                          file:mr-4 file:py-2 file:px-4
                                          file:rounded-full file:border-0
                                          file:text-sm file:font-semibold
                                          file:bg-teal-50 file:text-teal-700
                                          hover:file:bg-teal-100
                                          cursor-pointer"
                                   accept="image/png, image/jpeg, image/jpg">
                             <div id="thumbnail-preview" class="hidden w-16 h-16 rounded-lg overflow-hidden border border-gray-200 shadow-sm flex-shrink-0">
                                 <img src="" class="w-full h-full object-cover">
                             </div>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">
                            <i class="fas fa-info-circle mr-1"></i> Gambar ini akan menjadi sampul di halaman depan.
                        </p>
                        @error('thumbnail') <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p> @enderror
                    </div>

                    <div class="relative group">
    <label class="block text-sm font-bold text-gray-700 mb-2">Upload Dokumentasi Foto</label>

    <div class="w-full p-8 rounded-2xl border-2 border-dashed border-blue-200 bg-blue-50/50 group-hover:border-blue-400 group-hover:bg-blue-50 transition-all text-center">
        <div class="mb-4">
            <i class="fas fa-cloud-upload-alt text-4xl text-blue-300 group-hover:text-blue-500 transition-colors"></i>
        </div>

        <label for="upload-multiple" class="cursor-pointer">
            <span class="block text-sm font-semibold text-blue-600 hover:text-blue-800 underline mb-1">
                Klik untuk memilih foto
            </span>
            <span class="block text-xs text-gray-500">
                Bisa pilih banyak sekaligus (Max 2MB/foto)
            </span>
        </label>

        {{-- ID input tetap sama, namun kita akan memanipulasi filenya lewat JS --}}
        <input id="upload-multiple"
               type="file"
               name="url_foto[]"
               multiple
               class="hidden"
               onchange="handleFiles(this)"
               accept="image/png, image/jpeg, image/jpg">
    </div>

    {{-- Counter File --}}
    <div id="file-count" class="hidden mt-3 text-sm text-teal-700 bg-teal-50 px-3 py-2 rounded-lg inline-flex items-center">
        <i class="fas fa-check-circle mr-2"></i>
        <span id="file-count-text">0 file dipilih</span>
    </div>

    {{-- Container Preview (Tempat foto yang terpilih muncul dengan tombol hapus) --}}
    <div id="image-preview-container" class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6">
        </div>

    <div class="mt-3 text-xs text-gray-400 flex items-start">
        <i class="fas fa-lightbulb text-yellow-400 mr-2 text-base"></i>
        <p><strong>Tips:</strong> Anda bisa menghapus foto yang salah pilih dengan mengklik tombol tong sampah pada gambar preview.</p>
    </div>
</div>
                </div>
            </div>

            <div class="bg-gray-50 px-8 py-5 border-t border-gray-100 flex items-center justify-end">
                <a href="{{ route('admin.galeri.index') }}" class="text-gray-600 hover:text-gray-900 font-medium text-sm mr-6">Batal</a>
                <button type="submit" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 border border-transparent rounded-lg font-semibold text-white shadow-md hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all transform hover:-translate-y-0.5">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Kegiatan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- SCRIPT UNTUK PREVIEW GAMBAR --}}
<script>
    // Variabel global untuk menyimpan daftar file yang valid
    let selectedFiles = [];
    const fileInput = document.getElementById('upload-multiple');
    const previewContainer = document.getElementById('image-preview-container');
    const fileCountDiv = document.getElementById('file-count');
    const fileCountText = document.getElementById('file-count-text');

    // 1. Preview untuk Thumbnail (Single Image) - Tetap seperti awal
    function previewThumbnail(input) {
        const previewDiv = document.getElementById('thumbnail-preview');
        const previewImg = previewDiv.querySelector('img');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                previewDiv.classList.remove('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            previewDiv.classList.add('hidden');
        }
    }

    // 2. Fungsi Utama Menangani Multiple Files
    function handleFiles(input) {
        // Ambil file baru yang dipilih dan masukkan ke array selectedFiles
        const files = Array.from(input.files);

        files.forEach(file => {
            // Validasi tipe file sederhana
            if (file.type.match('image.*')) {
                selectedFiles.push(file);
            }
        });

        renderPreviews();
        updateInputFiles();
    }

    // 3. Fungsi Render Preview dengan Tombol Hapus
    function renderPreviews() {
        previewContainer.innerHTML = ''; // Kosongkan container

        selectedFiles.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = "relative group aspect-square rounded-xl overflow-hidden shadow-sm border border-gray-200 bg-gray-100";

                div.innerHTML = `
                    <img src="${e.target.result}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                        <button type="button" onclick="removeFile(${index})" class="bg-red-500 text-white w-10 h-10 rounded-full hover:bg-red-600 transition-transform transform hover:scale-110 flex items-center justify-center shadow-lg">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                `;
                previewContainer.appendChild(div);
            };
            reader.readAsDataURL(file);
        });

        // Update counter
        if (selectedFiles.length > 0) {
            fileCountText.textContent = `${selectedFiles.length} foto siap diupload`;
            fileCountDiv.classList.remove('hidden');
        } else {
            fileCountDiv.classList.add('hidden');
        }
    }

    // 4. Fungsi Menghapus File dari Array
    function removeFile(index) {
        selectedFiles.splice(index, 1); // Hapus dari array berdasarkan index
        renderPreviews(); // Gambar ulang preview
        updateInputFiles(); // Sinkronkan ke elemen input file
    }

    // 5. Fungsi Sinkronisasi Array ke Elemen Input (Paling Penting)
    function updateInputFiles() {
        const dataTransfer = new DataTransfer();
        selectedFiles.forEach(file => {
            dataTransfer.items.add(file);
        });
        fileInput.files = dataTransfer.files; // Ganti daftar file di input dengan yang baru
    }
</script>
@endsection
