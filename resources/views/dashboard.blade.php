<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- Sambutan Dinamis --}}
                    <h3 class="text-2xl font-bold text-teal-600 mb-4">
                        Selamat Datang, {{ Auth::user()->name }}!
                    </h3>

                    <p class="text-gray-700 mb-6">
                        Ini adalah portal pelayanan mandiri Kelurahan Cupak Tangah. Di sini Anda dapat:
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                        {{-- Kartu Aksi 1: Pengajuan Layanan --}}
                        <a href="#" class="bg-blue-50 p-6 rounded-lg border border-blue-200 hover:bg-blue-100 transition duration-150 ease-in-out">
                            <h4 class="text-xl font-semibold text-blue-700 mb-2 flex items-center">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                Ajukan Layanan Surat
                            </h4>
                            <p class="text-sm text-gray-600">Mulai pengajuan surat domisili, SKTM, atau izin kegiatan secara online.</p>
                        </a>

                        {{-- Kartu Aksi 2: Lacak Status --}}
                        <a href="#" class="bg-yellow-50 p-6 rounded-lg border border-yellow-200 hover:bg-yellow-100 transition duration-150 ease-in-out">
                            <h4 class="text-xl font-semibold text-yellow-700 mb-2 flex items-center">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 17v-1h4v1m0 0a5 5 0 01-4 0m-4 0a5 5 0 01-4 0M10 17H6a2 2 0 01-2-2V9a2 2 0 012-2h12a2 2 0 012 2v6a2 2 0 01-2 2h-4"></path></svg>
                                Lacak Status Permohonan
                            </h4>
                            <p class="text-sm text-gray-600">Periksa sejauh mana progres dokumen yang telah Anda ajukan.</p>
                        </a>

                        {{-- Kartu Aksi 3: Edit Profil --}}
                        <a href="{{ route('profile.edit') }}" class="bg-teal-50 p-6 rounded-lg border border-teal-200 hover:bg-teal-100 transition duration-150 ease-in-out">
                            <h4 class="text-xl font-semibold text-teal-700 mb-2 flex items-center">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37a1.724 1.724 0 002.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                Kelola Profil Akun
                            </h4>
                            <p class="text-sm text-gray-600">Perbarui informasi pribadi dan kata sandi Anda.</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
