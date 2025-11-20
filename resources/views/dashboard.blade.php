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
                    <h3 class="text-2xl font-bold text-teal-600 mb-4">
                        Selamat Datang, {{ Auth::user()->name }}!
                    </h3>

                    <p class="text-gray-700 mb-6">
                        Ini adalah portal pelayanan mandiri Kelurahan Cupak Tangah.
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
                        <a href="{{ route('profile.edit') }}"
                           class="bg-teal-50 p-6 rounded-lg border border-teal-200 hover:bg-teal-100 transition">
                            <h4 class="text-xl font-semibold text-teal-700 mb-2 flex items-center">
                                Kelola Profil Akun
                            </h4>
                            <p class="text-sm text-gray-600">Perbarui informasi pribadi dan kata sandi.</p>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
