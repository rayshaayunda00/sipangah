@extends('layouts.admin')

@section('title', 'Detail Pengguna')

@section('content')
<div class="bg-white rounded-xl shadow-md p-6">
    <h3 class="text-2xl font-semibold mb-4 text-emerald-700">{{ $user->name }}</h3>

    <div class="space-y-2 text-gray-700">
        <p><strong>NIK:</strong> {{ $user->nik ?? '-' }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Alamat:</strong> {{ $user->alamat ?? '-' }}</p>
        <p><strong>No. Telepon:</strong> {{ $user->no_telepon ?? '-' }}</p>
        <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
    </div>

    <a href="{{ route('admin.users.index') }}"
   class="inline-block mt-5 bg-gradient-to-r from-teal-500 to-emerald-600 text-white px-4 py-2 rounded-md shadow hover:opacity-90 transition-all duration-300">
   <i class="fas fa-arrow-left mr-2"></i> Kembali
</a>

</div>
@endsection
