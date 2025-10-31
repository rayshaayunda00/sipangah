<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | @yield('title', 'Dashboard')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            /* Warna UI Modern - Skema Teal/Emerald */
            --primary: #0f766e; /* Teal */
            --primary-light: #0d9488;
            --primary-dark: #115e59;
            --secondary: #f59e0b; /* Amber */
            --accent: #06b6d4; /* Cyan */
            --success: #10b981;
            --danger: #ef4444;
            --dark: #111827;
            --light: #f9fafb;
            --gray: #6b7280;
            --gray-light: #e5e7eb;
            --teal-grad: linear-gradient(135deg, #0f766e 0%, #0d9488 100%);
            --amber-grad: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);
            --green-grad: linear-gradient(135deg, #10b981 0%, #84cc16 100%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f0fdfa 0%, #f8fafc 50%, #ecfdf5 100%);
            color: #374151;
            line-height: 1.6;
            min-height: 100vh;
        }

        .admin-container {
            display: flex;
            min-height: 100vh;
        }

        /* --- Sidebar Styles (Modernized) --- */
        .sidebar {
            width: 280px;
            background: var(--teal-grad);
            color: white;
            box-shadow: 0 0 30px rgba(15, 118, 110, 0.2);
            z-index: 100;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .sidebar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--accent), var(--success));
        }

        .sidebar-header {
            padding: 1.75rem 1.5rem 1.25rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
            text-align: center;
        }

        .sidebar-header h1 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
            letter-spacing: 0.5px;
        }

        .sidebar-header p {
            font-size: 0.875rem;
            opacity: 0.9;
        }

        .sidebar-nav {
            padding: 1.5rem 0.75rem;
        }

        .nav-item {
            display: flex;
            align-items: center;
            padding: 0.875rem 1rem;
            margin-bottom: 0.5rem;
            border-radius: 0.75rem;
            color: rgba(255, 255, 255, 0.95);
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .nav-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
            transition: left 0.5s;
        }

        .nav-item:hover::before {
            left: 100%;
        }

        .nav-item:hover {
            background-color: rgba(255, 255, 255, 0.15);
            color: white;
            transform: translateX(5px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .nav-item.active {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
            border-color: rgba(255, 255, 255, 0.3);
        }

        .nav-item i {
            margin-right: 0.875rem;
            font-size: 1.125rem;
            width: 24px;
            text-align: center;
        }

        .logout-btn button {
             display: flex;
             align-items: center;
             padding: 0;
        }

        .logout-btn {
            margin-top: 2rem;
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.2) 0%, rgba(220, 38, 38, 0.2) 100%);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: rgba(255, 255, 255, 0.95);
        }

        .logout-btn:hover {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            transform: none;
        }

        /* --- Main Content & Header Styles --- */
        .main-content {
            flex: 1;
            padding: 2rem;
            overflow-y: auto;
            background: transparent;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid var(--gray-light);
        }

        .page-title {
            font-size: 2rem;
            font-weight: 800;
            color: var(--dark);
            position: relative;
            display: inline-block;
        }

        .page-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 60px;
            height: 4px;
            background: var(--teal-grad);
            border-radius: 2px;
        }

        .user-info {
            display: flex;
            align-items: center;
            background: white;
            padding: 0.875rem 1.5rem;
            border-radius: 1rem;
            box-shadow: 0 4px 15px rgba(15, 118, 110, 0.1);
            transition: all 0.3s ease;
            border: 1px solid rgba(15, 118, 110, 0.1);
        }

        .user-info:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(15, 118, 110, 0.15);
        }

        .user-info i {
            margin-right: 0.875rem;
            color: var(--primary);
            font-size: 1.5rem;
        }

        .user-name {
            font-weight: 700;
            color: var(--primary);
        }

        .content-area {
             background-color: transparent;
             box-shadow: none;
             padding: 0;
             margin-bottom: 1.5rem;
        }

        /* --- Responsive Styles (Mobile) --- */
        @media (max-width: 768px) {
            .admin-container { flex-direction: column; }
            .sidebar { width: 100%; height: auto; }
            .sidebar-nav { display: flex; flex-wrap: wrap; gap: 0.5rem; padding: 1rem; }
            .nav-item { flex: 1; min-width: 140px; justify-content: center; padding: 0.6rem 0.5rem; }

            /* Sembunyikan label di mobile, kecuali Logout */
            .nav-item span { display: none; }
            .nav-item.logout-btn span { display: inline; margin-left: 0.5rem; }
            .nav-item i { margin-right: 0; font-size: 1.2rem; width: auto; }
            .nav-item:hover { transform: none; }

            .logout-btn { margin-top: 1rem; min-width: 100px; justify-content: center; }

            .main-content { padding: 1rem; }

            .header { flex-direction: column; align-items: flex-start; gap: 1.5rem; margin-bottom: 1.5rem; padding-bottom: 1rem; }
            .page-title { font-size: 1.5rem; margin-bottom: 0.5rem; }
            .page-title::after { bottom: -5px; height: 3px; }
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <h1>Admin Panel</h1>
                <p>Kelurahan Sipangah</p>
            </div>
            <nav class="sidebar-nav">
                <a href="{{ route('admin.dashboard') }}" class="nav-item active">
                    <i class="fas fa-chart-bar"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.galeri.index') }}" class="nav-item">
                    <i class="fas fa-images"></i>
                    <span>Kelola Galeri</span>
                </a>

                {{-- Tautan Pengaduan disinkronkan ke gaya nav-item --}}
                <a href="{{ route('admin.pengaduan.index') }}" class="nav-item">
                    <i class="fas fa-concierge-bell"></i>
                    <span>Kelola Layanan Pengaduan</span>
                </a>

                <a href="{{ route('admin.artikel.index') }}" class="nav-item">
                    <i class="fas fa-newspaper"></i>
                    <span>Kelola Artikel</span>
                </a>

                {{-- Tautan Potensi disinkronkan ke gaya nav-item --}}
                <a href="{{ route('admin.item_potensi.index') }}" class="nav-item">
                    <i class="fas fa-file-alt"></i>
                    <span>Kelola Potensi</span>
                </a>

                <a href="{{ route('admin.users.index') }}" class="nav-item">
                    <i class="fas fa-users"></i>
                    <span>Kelola Pengguna</span>
                </a>

                <a href="#" class="nav-item">
                    <i class="fas fa-file-alt"></i>
                    <span>Laporan</span>
                </a>

                <form method="POST" action="{{ route('logout') }}" class="nav-item logout-btn">
                    @csrf
                    <button type="submit" style="background: none; border: none; color: inherit; width: 100%; text-align: left; cursor: pointer; display: flex; align-items: center;">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </nav>
        </aside>

        <main class="main-content">
            <div class="header">
                <h2 class="page-title">@yield('title', 'Dashboard Admin')</h2>
                <div class="user-info">
                    <i class="fas fa-user-circle"></i>
                    <span>Halo, <span class="user-name">{{ auth()->user()->name }}</span></span>
                </div>
            </div>

            <div class="content-area">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        // Menambahkan interaktivitas sederhana
        document.addEventListener('DOMContentLoaded', function() {
            const navItems = document.querySelectorAll('.nav-item');

            // 1. Memastikan semua teks menu dibungkus <span> (Hanya untuk tombol logout yang menggunakan button)
            navItems.forEach(item => {
                const button = item.querySelector('button');
                if (button) {
                     // Wrap button content with <span> if not already present
                     if (!button.querySelector('span')) {
                        const icon = button.querySelector('i');
                        const text = Array.from(button.childNodes).find(node => node.nodeType === 3 && node.textContent.trim().length > 0);
                        if (text) {
                            const span = document.createElement('span');
                            span.textContent = text.textContent.trim();
                            text.replaceWith(span);
                        }
                        if (icon) {
                            // Ensure the button elements are properly aligned inside the flex container
                            button.style.textAlign = 'left';
                        }
                    }
                }
            });

            // 2. Logika active class saat klik/navigasi
            navItems.forEach(item => {
                if (item.getAttribute('href') || item.querySelector('button')) {
                    item.addEventListener('click', function() {
                        if (!this.classList.contains('logout-btn')) {
                            navItems.forEach(i => i.classList.remove('active'));
                            this.classList.add('active');
                        }
                    });
                }
            });

            // 3. Menambahkan animasi pada konten
            const contentArea = document.querySelector('.content-area');
            if (contentArea) {
                contentArea.style.opacity = '0';
                contentArea.style.transform = 'translateY(10px)';

                setTimeout(() => {
                    contentArea.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                    contentArea.style.opacity = '1';
                    contentArea.style.transform = 'translateY(0)';
                }, 100);
            }
        });
    </script>
</body>
</html>
