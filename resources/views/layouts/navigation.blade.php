<nav x-data="{ open: false }" class="bg-white shadow-md fixed top-0 w-full z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                {{-- Logo dan Nama Kelurahan --}}
                <a href="/" class="flex-shrink-0 flex items-center">
                    <span class="text-xl font-extrabold text-teal-600 mr-2">CT</span>
                    <span class="text-lg font-semibold text-gray-800">Sipangah Cupak Tangah</span>
                </a>

                {{-- Tautan Navigasi Desktop --}}
                <div class="hidden sm:ml-6 sm:flex sm:space-x-8 items-center">
                    {{-- Tautan Beranda --}}
                    <a href="/"
                       class="px-3 py-2 text-sm font-medium {{ request()->is('/') ? 'text-teal-600 border-b-2 border-teal-600' : 'text-gray-500 hover:text-gray-900 border-b-2 border-transparent hover:border-gray-300' }}">
                        Beranda
                    </a>

                    {{-- Tautan Artikel --}}
                    <a href="{{ route('artikel.public.index') }}"
                       class="px-3 py-2 text-sm font-medium {{ request()->routeIs('artikel.public.*') ? 'text-teal-600 border-b-2 border-teal-600' : 'text-gray-500 hover:text-gray-900 border-b-2 border-transparent hover:border-gray-300' }}">
                        Artikel
                    </a>

                    {{-- Tautan Lain --}}
                    <a href="{{ route('layanan') }}"
                       class="text-gray-500 hover:text-gray-900 px-3 py-2 text-sm font-medium border-b-2 border-transparent hover:border-gray-300">
                        Layanan
                    </a>
                    <a href="#"
                       class="text-gray-500 hover:text-gray-900 px-3 py-2 text-sm font-medium border-b-2 border-transparent hover:border-gray-300">
                        Galeri
                    </a>
                    <a href="#"
                       class="text-gray-500 hover:text-gray-900 px-3 py-2 text-sm font-medium border-b-2 border-transparent hover:border-gray-300">
                        Potensi
                    </a>
                    <a href="#"
                       class="text-gray-500 hover:text-gray-900 px-3 py-2 text-sm font-medium border-b-2 border-transparent hover:border-gray-300">
                        Tentang
                    </a>
                </div>
            </div>

             <!-- Settings Dropdown -->
               <!-- Wrapper kanan -->
<div class="hidden sm:flex sm:items-center sm:ml-auto">
    @auth
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 focus:outline-none transition ease-in-out duration-150">
                    <div>{{ Auth::user()->name }}</div>
                    <div class="ml-1">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link :href="route('profile.edit')">
                    {{ __('Profil') }}
                </x-dropdown-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Keluar') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    @endauth

    @guest
        <a href="{{ route('login') }}"
           class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900">
            Login
        </a>
    @endguest
</div>


            {{-- Hamburger (Mobile Menu) --}}
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Responsive Navigation Menu (Mobile) --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white">
        <div class="pt-2 pb-3 space-y-1 border-t border-gray-100">
            {{-- Tautan Navigasi Mobile --}}
            <a href="/" class="block w-full pl-3 pr-4 py-2 border-l-4 {{ request()->is('/') ? 'border-teal-600 text-teal-700 bg-teal-50' : 'border-transparent text-gray-600 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-800' }}">Beranda</a>
            <a href="{{ route('artikel.public.index') }}" class="block w-full pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('artikel.public.*') ? 'border-teal-600 text-teal-700 bg-teal-50' : 'border-transparent text-gray-600 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-800' }}">Artikel</a>
            <a href="{{ route('layanan') }}" class="block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-gray-600 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-800">Layanan</a>
            <a href="#" class="block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-gray-600 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-800">Galeri</a>
            <a href="#" class="block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-gray-600 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-800">Potensi</a>
            <a href="#" class="block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-gray-600 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-800">Tentang</a>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()?->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()?->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profil') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                            this.closest('form').submit();">
                        {{ __('Keluar') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
    {{-- Margin top harus di layout utama jika navbar fixed --}}
    <div class="pt-2"></div>
</nav>
