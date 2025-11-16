@extends('layouts.admin')
{{-- Menggunakan layout utama admin agar tampilan konsisten --}}

@section('title', 'Tambah Pengguna')
{{-- Menentukan judul halaman --}}

@section('content')
{{--
  Gunakan 'max-w-4xl' agar form 2 kolom terlihat lebih seimbang.
  Gunakan shadow-lg dan padding lebih besar (p-6 md:p-8) untuk tampilan 'premium'.
--}}
<div class="bg-white rounded-xl shadow-lg p-6 md:p-8 max-w-4xl mx-auto">

    {{-- 1. HEADER HALAMAN YANG LEBIH BAIK --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Tambah Pengguna Baru</h1>
            <p class="text-gray-600 mt-1">Isi formulir di bawah untuk mendaftarkan akun baru.</p>
        </div>
        {{-- Tombol 'Kembali' untuk navigasi yang mudah --}}
        <a href="{{ route('admin.users.index') }}"
   class="mt-4 md:mt-0 px-4 py-2 rounded-lg text-white transition-all text-sm font-medium hover:brightness-90"
   style="background-color: #0f766e;">
    Kembali ke Daftar
</a>


    </div>

    {{--
      Form dengan layout GRID.
      - 'grid-cols-1': 1 kolom di HP.
      - 'md:grid-cols-2': 2 kolom di tablet/desktop.
      - 'gap-6': Jarak antar elemen form.
    --}}
    <form action="{{ route('admin.users.store') }}" method="POST" class="mt-6">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- 2. STYLING INPUT MODERN --}}
            {{-- Tambahkan 'id' dan 'for' pada label/input untuk accessibility --}}

            {{-- Input Nama --}}
            <div>
                <label for="name" class="block font-medium text-sm text-gray-700">Nama Lengkap</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                       class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                       required>
                {{-- Styling error yang lebih rapi --}}
                @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Input NIK --}}
            <div>
                <label for="nik" class="block font-medium text-sm text-gray-700">NIK</label>
                <input type="text" name="nik" id="nik" value="{{ old('nik') }}"
                       class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                       required>
                @error('nik') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Input Alamat (dibuat 'span 2' agar lebar penuh) --}}
            <div class="md:col-span-2">
                <label for="alamat" class="block font-medium text-sm text-gray-700">Alamat</label>
                <textarea name="alamat" id="alamat" rows="3"
                          class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                          required>{{ old('alamat') }}</textarea>
                @error('alamat') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Input Nomor Telepon --}}
            <div>
                <label for="no_telepon" class="block font-medium text-sm text-gray-700">Nomor Telepon</label>
                <input type="text" name="no_telepon" id="no_telepon" value="{{ old('no_telepon') }}"
                       class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                       placeholder="Contoh: 08123456..."
                       required>
                @error('no_telepon') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Input Email --}}
            <div>
                <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                       class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                       required>
                @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Input Password --}}
            <div>
                <label for="password" class="block font-medium text-sm text-gray-700">Password</label>
                <input type="password" name="password" id="password"
                       class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                       required>
                @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Disarankan: Tambah Konfirmasi Password --}}
            {{--
            <div>
                <label for="password_confirmation" class="block font-medium text-sm text-gray-700">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                       class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                       required>
            </div>
            --}}

            {{-- Input ROLE (Admin / Pengguna) --}}
            <div>
                <label for="is_admin" class="block font-medium text-sm text-gray-700">Role Pengguna</label>
                <select name="is_admin" id="is_admin"
                        class="w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                        required>
                    <option value="0" {{ old('is_admin') == 0 ? 'selected' : '' }}>User</option>
                    <option value="1" {{ old('is_admin') == 1 ? 'selected' : '' }}>Admin</option>
                </select>
                @error('is_admin') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

        </div> {{-- Akhir dari grid --}}

        {{-- 3. TOMBOL AKSI DENGAN PEMISAH --}}
        <div class="border-t border-gray-200 mt-8 pt-6">
            <div class="flex justify-end items-center gap-3">
                {{-- Tombol Batal/Kembali (Aksi Sekunder) --}}
                <a href="{{ route('admin.users.index') }}"
                   class="px-5 py-2 bg-white text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50 transition-all font-medium">
                    Batal
                </a>

                {{-- Tombol Simpan (Aksi Primer) --}}
                <button type="submit"
    class="flex items-center gap-2 px-5 py-2 text-white rounded-lg transition-all shadow-md font-medium"
    style="background-color:#06b6d4;"
    onmouseover="this.style.backgroundColor='#0891b2'"
    onmouseout="this.style.backgroundColor='#06b6d4'">

    {{-- Ikon Simpan --}}
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
        <path d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V6a1 1 0 10-2 0v5.586L7.707 10.293zM5 3a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2H5z" />
    </svg>

    Simpan Pengguna
</button>

            </div>
        </div>
    </form>
</div>
@endsection
