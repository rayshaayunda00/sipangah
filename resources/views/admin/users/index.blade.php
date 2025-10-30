@extends('layouts.admin') {{-- sesuaikan dengan nama file layout adminmu --}}

@section('title', 'Kelola Pengguna')

@section('content')
<div class="bg-white rounded-xl shadow-md p-6">
    <form method="GET" action="{{ route('admin.users.index') }}" class="mb-4 flex gap-2">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, NIK, atau email..."
               class="border-gray-300 rounded-md shadow-sm w-1/3 px-3 py-2">
        <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-md">
            <i class="fas fa-search mr-2"></i>Cari
        </button>
    </form>

    <table class="min-w-full border border-gray-200 rounded-lg">
        <thead class="bg-purple-600 text-white">
            <tr>
                <th class="py-2 px-4 text-left">Nama</th>
                <th class="py-2 px-4 text-left">NIK</th>
                <th class="py-2 px-4 text-left">Alamat</th>
                <th class="py-2 px-4 text-left">No. Telepon</th>
                <th class="py-2 px-4 text-left">Email</th>
                <th class="py-2 px-4 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-2 px-4">{{ $user->name }}</td>
                    <td class="py-2 px-4">{{ $user->nik }}</td>
                    <td class="py-2 px-4">{{ $user->alamat }}</td>
                    <td class="py-2 px-4">{{ $user->no_telepon }}</td>
                    <td class="py-2 px-4">{{ $user->email }}</td>
                    <td class="py-2 px-4">
                        <a href="{{ route('admin.users.show', $user->id) }}"
                           class="text-blue-600 hover:underline">Detail</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-3 text-gray-500">Tidak ada pengguna ditemukan</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
@endsection
