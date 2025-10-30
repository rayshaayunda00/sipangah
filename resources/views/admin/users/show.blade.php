@extends('layouts.admin')

@section('title', 'Detail Pengguna')

@section('content')
<div class="bg-white rounded-xl shadow-md p-6">
    <h3 class="text-2xl font-semibold mb-4 text-purple-700">{{ $user->name }}</h3>

    <div class="space-y-2">
        <p><strong>NIK:</strong> {{ $user->nik ?? '-' }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Alamat:</strong> {{ $user->alamat ?? '-' }}</p>
        <p><strong>No. Telepon:</strong> {{ $user->no_telepon ?? '-' }}</p>
        <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
    </div>

    <a href="{{ route('admin.users.index') }}"
       class="inline-block mt-5 bg-purple-600 text-white px-4 py-2 rounded-md hover:bg-purple-700">
       <i class="fas fa-arrow-left mr-2"></i> Kembali
    </a>
</div>
@endsection
