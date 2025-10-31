@extends('layouts.admin')

@section('title', 'Tambah Pengguna')

@section('content')
<div class="bg-white rounded-xl shadow-md p-6 max-w-3xl mx-auto">
    <h2 class="text-xl font-semibold text-purple-700 mb-4">Tambah Pengguna Baru</h2>

    <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block font-medium text-sm">Nama</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded p-2" required>
            @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-medium text-sm">NIK</label>
            <input type="text" name="nik" value="{{ old('nik') }}" class="w-full border rounded p-2" required>
            @error('nik') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-medium text-sm">Alamat</label>
            <textarea name="alamat" class="w-full border rounded p-2" required>{{ old('alamat') }}</textarea>
            @error('alamat') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-medium text-sm">Nomor Telepon</label>
            <input type="text" name="no_telepon" value="{{ old('no_telepon') }}" class="w-full border rounded p-2" required>
            @error('no_telepon') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-medium text-sm">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="w-full border rounded p-2" required>
            @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-medium text-sm">Password</label>
            <input type="password" name="password" class="w-full border rounded p-2" required>
            @error('password') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-end">
            <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
        </div>
    </form>
</div>
@endsection
