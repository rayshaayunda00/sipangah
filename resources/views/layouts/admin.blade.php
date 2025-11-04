<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | @yield('title', 'Dashboard')</title>
    <!-- Judul halaman akan diganti sesuai section 'title', default 'Dashboard' -->

    <!-- Font Awesome untuk icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Vite untuk CSS & JS (Mengambil file dari folder build Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            /* Warna UI Modern - Skema Teal/Emerald */
            /* Variabel CSS untuk konsistensi tema warna */
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
            /* Tumpukan font modern dengan fallback sans-serif */
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
        }

        body {
            /* Latar belakang gradient halus */
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
            background: var(--teal-grad); /* Background gradient dari variabel */
            color: white;
            box-shadow: 0 0 30px rgba(15, 118, 110, 0.2);
            z-index: 100;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .sidebar::before {
            /* Garis dekoratif atas sidebar */
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
            border-bottom: 1px solid rgba(255, 255, 255, 0.15); /* Garis pemisah transparan */
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
            overflow: hidden; /* Untuk efek hover::before */
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .nav-item::before {
            /* Efek 'shine' saat hover */
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
            left: 100%; /* Pindahkan efek 'shine' dari kiri ke kanan */
        }

        .nav-item:hover {
            background-color: rgba(255, 255, 255, 0.15);
            color: white;
            transform: translateX(5px); /* Efek 'lift' kecil saat hover */
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
            border-color: rgba(255, 255, 255, 0.2);
        }

        /* Style untuk item menu yang sedang aktif */
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
             /* Reset style button agar menyatu dengan form .nav-item */
             display: flex;
             align-items: center;
             padding: 0;
        }

        .logout-btn {
            /* Style khusus untuk tombol logout */
            margin-top: 2rem;
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.2) 0%, rgba(220, 38, 38, 0.2) 100%);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: rgba(255, 255, 255, 0.95);
        }

        .logout-btn:hover {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); /* Warna merah solid saat hover */
            color: white;
            transform: none; /* Hilangkan transform 'lift' khusus untuk logout */
        }

        /* --- Main Content & Header Styles --- */
        .main-content {
            flex: 1; /* Mengisi sisa ruang */
            padding: 2rem;
            overflow-y: auto; /* Scroll jika konten panjang */
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
            /* Garis dekoratif di bawah judul halaman */
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
            transform: translateY(-2px); /* Efek 'lift' pada info user */
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
             /* Area konten utama, style minimalis */
             background-color: transparent;
             box-shadow: none;
             padding: 0;
             margin-bottom: 1.5rem;
        }

        /* --- Responsive Styles (Mobile) --- */
        @media (max-width: 768px) {
            .admin-container { flex-direction: column; } /* Ubah jadi layout kolom di mobile */
            .sidebar { width: 100%; height: auto; } /* Sidebar jadi full-width di atas */
            /* Navigasi di mobile menjadi horizontal dan wrap */
            .sidebar-nav { display: flex; flex-wrap: wrap; gap: 0.5rem; padding: 1rem; }
            .nav-item { flex: 1; min-width: 140px; justify-content: center; padding: 0.6rem 0.5rem; }

            .nav-item span { display: none; } /* Sembunyikan teks menu di mobile */
            .nav-item.logout-btn span { display: inline; margin-left: 0.5rem; } /* Kecuali logout */
            .nav-item i { margin-right: 0; font-size: 1.2rem; width: auto; } /* Icon jadi pusat menu */
            .nav-item:hover { transform: none; } /* Hilangkan efek 'lift' di mobile */

            .logout-btn { margin-top: 1rem; min-width: 100px; justify-content: center; }

            .main-content { padding: 1rem; }

            .header { flex-direction: column; align-items: flex-start; gap: 1.5rem; margin-bottom: 1.5rem; padding-bottom: 1rem; }
            .page-title { font-size: 1.5rem; margin-bottom: 0.5rem; }
            .page-title::after { bottom: -5px; height: 3px; }
        }

        /* --- Dashboard Stats & Quick Menu Styles (CSS TAMBAHAN) --- */
        /* Style ini mungkin digunakan di halaman dashboard.blade.php */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }

        .stat-card {
            background: #ffffff;
            padding: 1.75rem;
            border-radius: 1rem;
            box-shadow: 0 4px 20px rgba(15, 118, 110, 0.08);
            border: 1px solid rgba(15, 118, 110, 0.1);
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(15, 118, 110, 0.12);
        }

        .stat-card h3 {
            font-size: 1rem;
            color: var(--gray);
            margin-bottom: 0.75rem;
            font-weight: 600;
            display: flex;
            align-items: center;
        }
        .stat-card h3 i {
            margin-right: 0.5rem;
            color: var(--primary);
            font-size: 1.125rem;
        }

        .stat-card .stat-value {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--primary-dark);
            margin-bottom: 0.5rem;
        }

        .stat-card .stat-trend {
            font-size: 0.875rem;
            display: flex;
            align-items: center;
        }
        .stat-trend.trend-up { color: var(--success); }
        .stat-trend.trend-down { color: var(--danger); }
        .stat-trend i { margin-right: 0.25rem; }

        /* Card background accents */
        /* Style ini memberi border kiri berwarna sesuai kategori card */
        .user-card { border-left: 5px solid var(--accent); }
        .service-card { border-left: 5px solid var(--secondary); }
        .article-card { border-left: 5px solid var(--primary); }
        .gallery-card { border-left: 5px solid var(--success); }


        /* Quick Menu */
        /* Style ini mungkin digunakan di halaman dashboard.blade.php */
        .quick-menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        .menu-card {
            background: #ffffff;
            padding: 1.5rem;
            border-radius: 1rem;
            box-shadow: 0 4px 20px rgba(15, 118, 110, 0.05);
            border: 1px solid rgba(15, 118, 110, 0.1);
            text-decoration: none;
            color: var(--dark);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(15, 118, 110, 0.1);
            border-color: var(--primary);
        }

        .menu-card h4 {
            font-size: 1.125rem;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
        }
        .menu-card h4 i {
            margin-right: 0.6rem;
            color: var(--primary-dark);
        }

        .menu-card p {
            font-size: 0.875rem;
            color: var(--gray);
            line-height: 1.5;
        }

        .menu-card .card-icon {
            /* Ikon dekoratif besar di background card */
            position: absolute;
            right: 1.5rem;
            bottom: 1.5rem;
            font-size: 3rem;
            color: var(--primary);
            opacity: 0.07;
            transform: rotate(-10deg);
            transition: all 0.3s ease;
        }

        .menu-card:hover .card-icon {
            opacity: 0.1;
            transform: rotate(0deg) scale(1.05);
        }

    </style>
</head>
<body>
    <div class="admin-container">
        <!-- SIDEBAR -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h1>Admin Panel</h1>
                <p>Kelurahan Sipangah</p>
            </div>

            <nav class="sidebar-nav">
                <!-- Menu Dashboard -->
                {{--
                  Cek jika route saat ini adalah 'admin.dashboard'.
                  Jika ya, tambahkan class 'active'
                --}}
                <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-bar"></i>
                    <span>Dashboard</span>
                </a>

                <!-- Menu Kelola Galeri -->
                {{-- request()->routeIs('admin.galeri.*') akan 'active' di halaman index, create, edit galeri --}}
                <a href="{{ route('admin.galeri.index') }}" class="nav-item {{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}">
                    <i class="fas fa-images"></i>
                    <span>Kelola Galeri</span>
                </a>

                <!-- Menu Kelola Layanan Pengaduan -->
                <a href="{{ route('admin.pengaduan.index') }}" class="nav-item {{ request()->routeIs('admin.pengaduan.*') ? 'active' : '' }}">
                    <i class="fas fa-concierge-bell"></i>
                    <span>Kelola Layanan Pengaduan</span>
                </a>

                <!-- Menu Kelola Artikel -->
                <a href="{{ route('admin.artikel.index') }}" class="nav-item {{ request()->routeIs('admin.artikel.*') ? 'active' : '' }}">
                    <i class="fas fa-newspaper"></i>
                    <span>Kelola Artikel</span>
                </a>

                <!-- Menu Kelola Potensi -->
                <a href="{{ route('admin.item_potensi.index') }}" class="nav-item {{ request()->routeIs('admin.item_potensi.*') ? 'active' : '' }}">
                    <i class="fas fa-file-alt"></i>
                    <span>Kelola Potensi</span>
                </a>

                <!-- Menu Kelola Pengguna -->
                <a href="{{ route('admin.users.index') }}" class="nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i>
                    <span>Kelola Pengguna</span>
                </a>

                <!-- Menu Kelola Arsip -->
                <a href="{{ route('admin.arsip.index') }}" class="nav-item {{ request()->routeIs('admin.arsip.*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i> <!-- Ganti icon jika perlu, misal fas fa-archive -->
                    <span>Kelola Arsip</span>
                </a>

                <!-- Form Logout -->
                <form method="POST" action="{{ route('logout') }}" class="nav-item logout-btn">
                    @csrf
                    <button type"submit" style="background: none; border: none; color: inherit; width: 100%; text-align: left; cursor: pointer; display: flex; align-items: center;">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </nav>
            </aside>

        <!-- MAIN CONTENT -->
        <main class="main-content">
            <div class="header">
                {{-- Menampilkan section 'title' (judul halaman) --}}
                <h2 class="page-title">@yield('title', 'Dashboard Admin')</h2>
                <div class="user-info">
                    <i class="fas fa-user-circle"></i>
                    {{-- Menampilkan nama pengguna yang sedang login --}}
                    <span>Halo, <span class="user-name">{{ auth()->user()->name }}</span></span>
                </div>
            </div>

            <!-- AREA UNTUK HALAMAN KONTEN -->
            <div class="content-area">
                {{-- Di sinilah konten dari file lain (seperti index_item.blade.php) akan dimasukkan --}}
                @yield('content')
            </div>
            </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Logika 'active' class sudah ditangani oleh Blade di sisi server

            // Animasi masuk halaman sederhana
            const contentArea = document.querySelector('.content-area');
            if (contentArea) {
                // Atur style awal (transparan dan sedikit ke bawah)
                contentArea.style.opacity = '0';
                contentArea.style.transform = 'translateY(10px)';

                // Setelah sedikit delay, animasikan ke style akhir (terlihat dan posisi normal)
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

