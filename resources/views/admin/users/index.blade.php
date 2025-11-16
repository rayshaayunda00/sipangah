@extends('layouts.admin')
{{-- Menggunakan layout utama admin --}}

@section('title', 'Kelola Pengguna')
{{-- Menetapkan judul halaman --}}

@section('content')
<div class="bg-white rounded-xl shadow-lg p-6 md:p-8">

    {{-- 1. HEADER HALAMAN YANG LEBIH BAIK --}}
    {{-- Pisahkan judul dari tombol aksi untuk tata letak yang lebih bersih --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Daftar Pengguna</h1>
            <p class="text-gray-600 mt-1">Kelola semua akun pengguna dalam sistem.</p>
        </div>
        {{-- Tombol untuk menambah pengguna baru (dengan ikon) --}}
        <a href="{{ route('admin.users.create') }}"
           class="flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-300 shadow-md mt-4 md:mt-0">
            {{-- Ikon Plus SVG (lebih baik dari teks "+") --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Tambah Pengguna
        </a>
    </div>

    {{-- 2. BAR KONTROL (PENCARIAN) --}}
    {{-- Form pencarian kini memiliki area khusus --}}
    <div class="mb-6">
        <form method="GET" action="{{ route('admin.users.index') }}">
            <div class="flex flex-col md:flex-row gap-2">
                {{-- Input pencarian dengan styling modern --}}
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Cari berdasarkan nama, NIK, atau email..."
                       class="w-full md:w-1/3 border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">

                <button type="submit"
                        class="px-5 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-all shadow-sm">
                    Cari
                </button>

                {{-- Tombol Reset hanya muncul jika ada pencarian --}}
                @if(request('search'))
                    <a href="{{ route('admin.users.index') }}"
                       class="flex justify-center items-center px-5 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500 transition-all shadow-sm">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    {{-- 3. PESAN SUKSES (ALERT STYLE) --}}
    {{-- Styling alert yang lebih jelas dengan border dan warna solid --}}
    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md mb-6" role="alert">
            <p class="font-bold">Sukses!</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    {{-- 4. CONTAINER TABEL RESPONSIVE --}}
    {{-- Ini penting! 'overflow-x-auto' membuat tabel bisa di-scroll di HP --}}
    <div class="rounded-lg shadow border border-gray-200 overflow-hidden">

    <table class="w-full table-fixed">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 w-32">Nama</th>
                <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 w-24">NIK</th>
                <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 w-40">Alamat</th>
                <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 w-28">Telepon</th>
                <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 w-40">Email</th>
                <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600 w-20">Role</th>
                <th class="px-4 py-2 text-center text-xs font-semibold text-gray-600 w-24">Aksi</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-200">
            @foreach ($users as $user)
                <tr class="hover:bg-gray-50">

                    <td class="px-4 py-2 text-sm font-medium text-gray-900 truncate">{{ $user->name }}</td>

                    <td class="px-4 py-2 text-sm text-gray-700 truncate">{{ $user->nik }}</td>

                    <td class="px-4 py-2 text-sm text-gray-700 truncate">
                        {{ Str::limit($user->alamat, 25) }}
                    </td>

                    <td class="px-4 py-2 text-sm text-gray-700 truncate">{{ $user->no_telepon }}</td>

                    <td class="px-4 py-2 text-sm text-gray-700 truncate">
                        {{ Str::limit($user->email, 28) }}
                    </td>

                    <td class="px-4 py-2">
                        @if ($user->is_admin)
                            <span class="px-2 py-1 text-xs text-white bg-blue-600 rounded">Admin</span>
                        @else
                            <span class="px-2 py-1 text-xs bg-gray-200 text-gray-700 rounded">User</span>
                        @endif
                    </td>

                    <td class="px-4 py-2 text-center">
                        <div class="flex justify-center gap-1">
                            <a href="{{ route('admin.users.show', $user->id) }}"
                               class="px-2 py-1 text-xs text-white bg-green-600 rounded hover:bg-green-700">
                                Detail
                            </a>

                            <form action="{{ route('admin.users.destroy', $user->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">
                                @csrf @method('DELETE')
                                <button class="px-2 py-1 text-xs text-white bg-red-600 rounded hover:bg-red-700">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

</div>


    {{-- 9. PAGINATION --}}
    {{-- Styling pagination (pastikan Anda sudah publish view pagination laravel untuk tailwind) --}}
    <div class="mt-6">
        {{ $users->links() }}
    </div>

</div>
@endsection
