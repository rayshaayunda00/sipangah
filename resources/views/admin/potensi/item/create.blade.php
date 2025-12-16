@extends('layouts.admin')

@section('title', 'Tambah Item Potensi')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-black text-gray-900 tracking-tight">Tambah Item Potensi</h1>
            <p class="text-sm text-gray-500 mt-1">Tambahkan data potensi daerah, UMKM, atau wisata baru.</p>
        </div>
        <a href="{{ route('admin.item_potensi.index') }}"
           class="group inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition-all shadow-sm">
            <i class="fas fa-arrow-left mr-2 text-gray-400 group-hover:text-gray-600"></i>
            Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg shadow-sm animate-fade-in-up">
            <div class="flex">
                <div class="flex-shrink-0"><i class="fas fa-exclamation-circle text-red-500"></i></div>
                <div class="ml-3">
                    <h3 class="text-sm font-bold text-red-800">Terdapat kesalahan:</h3>
                    <ul class="mt-1 list-disc list-inside text-sm text-red-700">
                        @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        <form action="{{ route('admin.item_potensi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-3">

                <div class="p-8 bg-gray-50 border-b lg:border-b-0 lg:border-r border-gray-100 lg:col-span-2">
                    <div class="flex items-center mb-6">
                        <div class="bg-blue-100 text-blue-600 w-10 h-10 rounded-full flex items-center justify-center mr-3 shadow-sm">
                            <i class="fas fa-cube text-lg"></i>
                        </div>
                        <h2 class="text-lg font-bold text-gray-800">Informasi Utama</h2>
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Item <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_item" value="{{ old('nama_item') }}"
                               class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 transition-all"
                               placeholder="Contoh: Keripik Balado Sanjai" required>
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Subkategori <span class="text-red-500">*</span></label>

                        <select name="id_subkategori_potensi" id="subkategori-select" onchange="toggleSubkategoriLainnya()"
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 bg-white">
                            <option value="">-- Pilih Subkategori --</option>
                            @foreach ($subkategori as $sub)
                                <option value="{{ $sub->id_subkategori_potensi }}" {{ old('id_subkategori_potensi') == $sub->id_subkategori_potensi ? 'selected' : '' }}>
                                    {{ $sub->nama_subkategori }} ({{ $sub->kategori->nama_kategori }})
                                </option>
                            @endforeach
                            <option value="lainnya" {{ old('id_subkategori_potensi') == 'lainnya' ? 'selected' : '' }}>+ Lainnya (Buat Baru)</option>
                        </select>

                        <div id="subkategori-lainnya-container" class="mt-4 p-4 bg-blue-50 border border-blue-200 rounded-lg {{ old('id_subkategori_potensi') == 'lainnya' ? '' : 'hidden' }}">
                            <h4 class="text-xs font-bold text-blue-800 uppercase tracking-wide mb-3">Buat Subkategori Baru</h4>

                            <div class="mb-3">
                                <label class="block text-xs font-semibold text-gray-600 mb-1">Nama Subkategori Baru <span class="text-red-500">*</span></label>
                                <input type="text" name="nama_subkategori_baru" value="{{ old('nama_subkategori_baru') }}"
                                       class="w-full px-3 py-2 rounded border border-gray-300 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                                       placeholder="Contoh: Kerajinan Tangan">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-gray-600 mb-1">Termasuk Kategori Induk <span class="text-red-500">*</span></label>
                                <select name="id_kategori_induk" class="w-full px-3 py-2 rounded border border-gray-300 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 bg-white">
                                    <option value="">-- Pilih Kategori Induk --</option>
                                    @foreach($kategoriInduk as $kat)
                                        <option value="{{ $kat->id_kategori_potensi }}" {{ old('id_kategori_induk') == $kat->id_kategori_potensi ? 'selected' : '' }}>
                                            {{ $kat->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Singkat</label>
                        <textarea name="deskripsi_singkat" rows="3" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 transition-all text-sm">{{ old('deskripsi_singkat') }}</textarea>
                    </div>
                    <div class="mb-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Lengkap</label>
                        <textarea name="deskripsi_lengkap" rows="6" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 transition-all text-sm">{{ old('deskripsi_lengkap') }}</textarea>
                    </div>
                </div>

                <div class="p-8 bg-white lg:col-span-1">
                    <div class="flex items-center mb-6">
                        <div class="bg-teal-100 text-teal-600 w-10 h-10 rounded-full flex items-center justify-center mr-3 shadow-sm">
                            <i class="fas fa-image text-lg"></i>
                        </div>
                        <h2 class="text-lg font-bold text-gray-800">Media & Kontak</h2>
                    </div>

                    <div class="mb-6 p-5 rounded-xl border border-dashed border-gray-300 bg-gray-50 hover:bg-gray-100 transition-colors">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Foto Utama</label>
                        <input type="file" name="url_gambar_utama" id="gambar-input" onchange="previewImage(this)"
                               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100 cursor-pointer"
                               accept="image/*">
                        <div id="image-preview" class="hidden mt-4">
                            <div class="relative w-full aspect-video rounded-lg overflow-hidden border border-gray-200 shadow-sm">
                                <img id="preview-img" src="" alt="Preview" class="w-full h-full object-cover">
                            </div>
                        </div>
                    </div>

                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">No. HP / WhatsApp</label>
                            <input type="text" name="no_hp" value="{{ old('no_hp') }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat</label>
                            <textarea name="alamat" rows="3" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 transition-all text-sm">{{ old('alamat') }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Status Publikasi</label>
                            <select name="status_publikasi" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 bg-gray-50">
                                <option value="published" {{ old('status_publikasi') == 'published' ? 'selected' : '' }}>Published (Tayang)</option>
                                <option value="draft" {{ old('status_publikasi') == 'draft' ? 'selected' : '' }}>Draft (Konsep)</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 px-8 py-5 border-t border-gray-100 flex items-center justify-end">
                <a href="{{ route('admin.item_potensi.index') }}" class="text-gray-600 hover:text-gray-900 font-medium text-sm mr-6">Batal</a>
                <button type="submit" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 border border-transparent rounded-lg font-semibold text-white shadow-md hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all transform hover:-translate-y-0.5">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Item
                </button>
            </div>
        </form>
    </div>
</div>

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

    // Toggle Input Lainnya
    function toggleSubkategoriLainnya() {
        const select = document.getElementById('subkategori-select');
        const container = document.getElementById('subkategori-lainnya-container');

        if (select.value === 'lainnya') {
            container.classList.remove('hidden');
        } else {
            container.classList.add('hidden');
        }
    }
</script>
@endsection
