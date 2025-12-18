<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'Sipangah - Kelurahan Cupak Tangah')</title>

        <link rel="icon" type="image/png" href="{{ asset('images/padang.png') }}">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        {{-- Stack Styles --}}
        @stack('styles')
    </head>
    <body class="font-sans antialiased">
        {{--
            UBAH 1: Tambahkan class 'flex flex-col'
            Ini penting agar layout menggunakan Flexbox vertikal,
            sehingga footer bisa didorong ke bawah.
        --}}
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900 flex flex-col">

            @include('layouts.navigation')

            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            {{--
                UBAH 2: Tambahkan class 'flex-grow' pada <main>
                Ini membuat area konten utama mengisi sisa ruang kosong
                sehingga footer terdorong ke dasar halaman.
            --}}
            <main class="flex-grow">
                @if (isset($slot))
                    {{ $slot }}
                @else
                    @yield('content')
                @endif
            </main>

            {{--
                UBAH 3: Panggil Footer di sini (di dalam div wrapper)
            --}}
            @include('layouts.footer')

        </div>

        {{-- Stack Scripts --}}
        @stack('scripts')
    </body>
</html>
