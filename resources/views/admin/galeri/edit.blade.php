@extends('layouts.admin')

@section('content')
<div class="p-6">
    <!-- Judul halaman edit galeri -->
    <h1 class="text-2xl font-bold mb-4">✏️ Edit & Kelola Galeri</h1>

    <!-- Pesan error kalau ada validasi yang gagal -->
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
            <h4 class="font-bold">Terjadi Kesalahan!</h4>
            <ul class="mt-1 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li> <!-- Nampilin pesan error satu-satu -->
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Pesan sukses setelah update berhasil -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-800 p-3 rounded mb-4">
            ✅ {{ session('success') }}
        </div>
    @endif

    {{-- === FORM EDIT DATA KEGIATAN === --}}
    <form action="{{ route('admin.galeri.update', $kegiatan->id_kegiatan) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow rounded-lg p-6 mb-8">
        @csrf
        @method('PUT') <!-- Method PUT biar update data -->

        <!-- Input Judul Kegiatan -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Judul Kegiatan</label>
            <input type="text" name="judul_kegiatan" value="{{ old('judul_kegiatan', $kegiatan->judul_kegiatan) }}" class="w-full p-2 border rounded @error('judul_kegiatan') border-red-500 @enderror" required>
        </div>

        <!-- Input Deskripsi Singkat -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Deskripsi Singkat</label>
            <textarea name="deskripsi_singkat" rows="4" class="w-full p-2 border rounded @error('deskripsi_singkat') border-red-500 @enderror" required>{{ old('deskripsi_singkat', $kegiatan->deskripsi_singkat) }}</textarea>
        </div>

        <!-- Input Tanggal Kegiatan -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Tanggal Kegiatan</label>
            <!-- Format tanggal pakai YYYY-MM-DD biar cocok sama input type=date -->
            <input type="date" name="tanggal_kegiatan"
                   value="{{ old('tanggal_kegiatan', $kegiatan->tanggal_kegiatan ? $kegiatan->tanggal_kegiatan->format('Y-m-d') : '') }}"
                   class="w-full p-2 border rounded @error('tanggal_kegiatan') border-red-500 @enderror" required>
            @error('tanggal_kegiatan')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Bagian thumbnail (preview & upload baru) -->
        <div class="mb-4">
            <label class="block text-gray-700 font-semibold">Thumbnail Saat Ini</label>
            @if($kegiatan->thumbnail_url)
                <!-- Kalau sudah ada thumbnail, tampilkan -->
                <img src="{{ asset('storage/' . $kegiatan->thumbnail_url) }}" alt="Thumbnail" class="w-48 rounded mb-2 shadow">
            @else
                <!-- Kalau belum ada thumbnail -->
                <p class="text-gray-500 italic">Belum ada thumbnail</p>
            @endif

            <!-- Upload thumbnail baru (opsional) -->
            <label class="block text-gray-700 font-semibold mt-3">Ganti Thumbnail (Opsional)</label>
            <input type="file" name="thumbnail" class="w-full border p-2 rounded @error('thumbnail') border-red-500 @enderror">
            <p class="text-xs text-gray-500 mt-1">Hanya file JPG/PNG, max 2MB.</p>
            @error('thumbnail')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Tombol simpan dan kembali -->
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">💾 Simpan Perubahan</button>
        <a href="{{ route('admin.galeri.index') }}" class="ml-2 bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded">↩️ Kembali</a>
    </form>

    {{-- === BAGIAN UPLOAD FOTO DOKUMENTASI === --}}
    <hr class="my-6 border-gray-300">
    <h2 class="text-xl font-semibold mb-3">📸 Kelola Foto Dokumentasi</h2>

    <!-- Form upload foto dokumentasi -->
    <form action="{{ route('admin.galeri.uploadFoto', $kegiatan->id_kegiatan) }}" method="POST" enctype="multipart/form-data" class="mb-6 bg-white shadow rounded-lg p-4">
        @csrf
        <div class="flex flex-col md:flex-row items-center gap-3">
            <!-- Input file foto -->
            <div class="w-full md:w-auto flex-1">
                <label class="block text-gray-700 text-sm mb-1">Pilih File Foto</label>
                <input type="file" name="url_foto" class="border p-2 rounded w-full @error('url_foto') border-red-500 @enderror" required>
                @error('url_foto')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <!-- Input deskripsi foto -->
            <div class="w-full md:w-auto flex-1">
                <label class="block text-gray-700 text-sm mb-1">Deskripsi Foto</label>
                <input type="text" name="deskripsi_foto" placeholder="Deskripsi foto..." class="border p-2 rounded w-full @error('deskripsi_foto') border-red-500 @enderror">
                @error('deskripsi_foto')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <!-- Tombol upload -->
            <button type="submit" class="w-full md:w-auto mt-2 md:mt-auto bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 h-[42px]">Upload</button>
        </div>
    </form>

    {{-- === DAFTAR FOTO-FOTO YANG SUDAH DIUPLOAD === --}}
    <h3 class="text-lg font-semibold mb-4 text-gray-800">
        Daftar Foto Kegiatan ({{ $kegiatan->fotoGaleri->count() }})
    </h3>

    <!-- Grid daftar foto -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @forelse ($kegiatan->fotoGaleri as $foto)
            <div class="border rounded shadow p-2 relative group bg-white">
                <!-- Tampilkan foto -->
                <img src="{{ asset('storage/'.$foto->url_foto) }}" class="w-full h-32 object-cover rounded">
                <p class="text-sm mt-2 text-gray-600 line-clamp-2">
                    {{ $foto->deskripsi_foto ?? 'Tanpa Deskripsi' }}
                </p>

                <!-- Tombol hapus foto (muncul saat hover) -->
                <form action="{{ route('admin.galeri.foto.destroy', $foto->id_foto) }}" method="POST" class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition duration-200" onsubmit="return confirm('Hapus foto ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 text-white text-xs px-2 py-1 rounded hover:bg-red-700 shadow-lg">
                        Hapus
                    </button>
                </form>
            </div>
        @empty
            <!-- Kalau belum ada foto -->
            <p class="text-gray-500 italic col-span-4">Belum ada foto dokumentasi yang diupload.</p>
        @endforelse
    </div>
</div>
@endsection
