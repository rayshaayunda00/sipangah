@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
    <!-- Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-blue-500 text-white p-6 rounded-xl shadow-md">
            <h3 class="text-lg font-semibold">Jumlah User</h3>
            <p class="text-3xl font-bold mt-2">120</p>
        </div>
        <div class="bg-green-500 text-white p-6 rounded-xl shadow-md">
            <h3 class="text-lg font-semibold">Layanan</h3>
            <p class="text-3xl font-bold mt-2">8</p>
        </div>
        <div class="bg-purple-500 text-white p-6 rounded-xl shadow-md">
            <h3 class="text-lg font-semibold">Artikel</h3>
            <p class="text-3xl font-bold mt-2">15</p>
        </div>
    </div>

    <!-- Quick Menu -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <a href="#" class="block bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition">
            <h4 class="text-xl font-semibold text-gray-800 mb-2">Kelola User</h4>
            <p class="text-gray-600">Tambah, ubah, atau hapus data pengguna.</p>
        </a>
        <a href="#" class="block bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition">
            <h4 class="text-xl font-semibold text-gray-800 mb-2">Kelola Layanan</h4>
            <p class="text-gray-600">Atur data layanan yang tersedia.</p>
        </a>
        <a href="#" class="block bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition">
            <h4 class="text-xl font-semibold text-gray-800 mb-2">Kelola Artikel</h4>
            <p class="text-gray-600">Buat dan kelola artikel edukasi.</p>
        </a>
        <a href="#" class="block bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition">
            <h4 class="text-xl font-semibold text-gray-800 mb-2">Laporan</h4>
            <p class="text-gray-600">Lihat laporan penggunaan sistem.</p>
        </a>
    </div>
@endsection
