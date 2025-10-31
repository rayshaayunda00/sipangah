@extends('layouts.admin')

@section('title', 'Kelola Pengguna')

@section('content')
<div class="bg-white rounded-xl shadow-md p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold text-purple-700">Daftar Pengguna</h2>
        <a href="{{ route('admin.users.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            + Tambah Pengguna
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border-collapse border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">Nama</th>
                <th class="border p-2">NIK</th>
                <th class="border p-2">Alamat</th>
                <th class="border p-2">No Telepon</th>
                <th class="border p-2">Email</th>
                <th class="border p-2 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr class="hover:bg-gray-50">
                    <td class="border p-2">{{ $user->name }}</td>
                    <td class="border p-2">{{ $user->nik }}</td>
                    <td class="border p-2">{{ $user->alamat }}</td>
                    <td class="border p-2">{{ $user->no_telepon }}</td>
                    <td class="border p-2">{{ $user->email }}</td>
                    <td class="border p-2 text-center space-x-2">
                        <a href="{{ route('admin.users.show', $user->id) }}" class="px-3 py-1 bg-purple-600 text-white rounded hover:bg-purple-700">
                            Detail
                        </a>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus pengguna ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">{{ $users->links() }}</div>
</div>
@endsection
