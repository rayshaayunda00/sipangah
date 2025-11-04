@extends('layouts.admin')

@section('content')
<div class="p-6">
    <!-- Judul halaman -->
    <h1 class="text-2xl font-bold mb-4">Edit Artikel</h1>

    <!-- Form buat ngedit data artikel yang udah ada -->
    <form action="{{ route('admin.artikel.update', $artikel->id_artikel) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Karena ini form update, jadi pakai method PUT -->

        <!-- Input judul artikel -->
        <div class="mb-4">
            <label>Judul</label>
            <input type="text" name="judul" value="{{ $artikel->judul }}" class="w-full border p-2 rounded" required>
            <!-- Isi otomatis dari data artikel yang lagi diedit -->
        </div>

        <!-- Dropdown kategori artikel -->
        <div class="mb-4">
            <label>Kategori</label>
            <select name="id_kategori" class="w-full border p-2 rounded">
                @foreach($kategori as $k)
                    <option value="{{ $k->id_kategori }}" {{ $artikel->id_kategori == $k->id_kategori ? 'selected' : '' }}>
                        {{ $k->nama_kategori }}
                    </option>
                @endforeach
            </select>
            <!-- Otomatis pilih kategori yang sebelumnya dipakai artikel -->
        </div>

        <!-- Dropdown penulis artikel -->
        <div class="mb-4">
            <label>Penulis</label>
            <select name="id_penulis" class="w-full border p-2 rounded">
                @foreach($penulis as $p)
                    <option value="{{ $p->id_penulis }}" {{ $artikel->id_penulis == $p->id_penulis ? 'selected' : '' }}>
                        {{ $p->nama_penulis }}
                    </option>
                @endforeach
            </select>
            <!-- Sama kayak kategori, otomatis pilih penulis lama -->
        </div>

        <!-- Tambahan: Pilihan status publikasi -->
        <div class="mb-4">
            <label>Status Publikasi</label>
            <select name="status_publikasi" class="w-full border p-2 rounded">
                <option value="published" {{ $artikel->status_publikasi == 'published' ? 'selected' : '' }}>Published</option>
                <option value="draft" {{ $artikel->status_publikasi == 'draft' ? 'selected' : '' }}>Draft (Tidak Ditampilkan)</option>
            </select>
            <p class="text-xs text-gray-500 mt-1">
                Hanya artikel yang berstatus <b>Published</b> yang bakal muncul di halaman publik, ya.
            </p>
            <!-- Jadi admin bisa atur mau ditampilkan atau belum -->
        </div>

        <!-- Textarea buat isi konten artikel -->
        <div class="mb-4">
            <label>Isi Konten</label>
            <textarea name="isi_konten" class="w-full border p-2 rounded" rows="6" required>{{ $artikel->isi_konten }}</textarea>
            <!-- Isinya langsung tampil dari data lama biar gampang edit -->
        </div>

        <!-- Upload gambar utama -->
        <div class="mb-4">
            <label>Gambar Utama</label><br>
            @if($artikel->url_gambar_utama)
                <!-- Kalau artikel udah punya gambar, tampilkan preview-nya -->
                <img src="{{ asset('storage/'.$artikel->url_gambar_utama) }}" class="w-32 h-32 object-cover rounded mb-2">
            @endif
            <input type="file" name="url_gambar_utama" class="w-full border p-2 rounded">
            <!-- Bisa ganti gambar utama kalau mau -->
        </div>

        <!-- Tombol buat update data -->
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Update</button>
        <!-- Setelah klik ini, data baru dikirim ke controller buat disimpan -->
    </form>
</div>
@endsection
