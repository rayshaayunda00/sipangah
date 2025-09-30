<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | @yield('title', 'Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 text-white flex-shrink-0">
        <div class="p-6 text-center border-b border-gray-700">
            <h1 class="text-2xl font-bold">Admin Panel</h1>
            <p class="text-sm text-gray-400 mt-1">Kelurahan Sipangah</p>
        </div>
        <nav class="p-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="block py-2 px-4 rounded-lg bg-gray-700 hover:bg-gray-600 transition">
                📊 Dashboard
            </a>
            <a href="#" class="block py-2 px-4 rounded-lg hover:bg-gray-700 transition">
                👤 Kelola User
            </a>
            <a href="#" class="block py-2 px-4 rounded-lg hover:bg-gray-700 transition">
                🏷️ Kelola Layanan
            </a>
            <a href="#" class="block py-2 px-4 rounded-lg hover:bg-gray-700 transition">
                📰 Kelola Artikel
            </a>
            <a href="#" class="block py-2 px-4 rounded-lg hover:bg-gray-700 transition">
                📑 Laporan
            </a>
            <form method="POST" action="{{ route('logout') }}" class="mt-4">
                @csrf
                <button type="submit" class="w-full text-left py-2 px-4 rounded-lg hover:bg-red-600 bg-red-500 transition">
                    🚪 Logout
                </button>
            </form>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800">@yield('title', 'Dashboard Admin')</h2>
            <span class="text-gray-600">👋 Halo, <b>{{ auth()->user()->name }}</b></span>
        </div>

        @yield('content')
    </main>
</div>

</body>
</html>
