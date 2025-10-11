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
            --primary: #4f46e5;
            --primary-dark: #4338ca;
            --secondary: #10b981;
            --dark: #1f2937;
            --light: #f9fafb;
            --gray: #6b7280;
            --danger: #ef4444;
            --danger-dark: #dc2626;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
        }

        body {
            background-color: #f5f7fa;
            color: #333;
            line-height: 1.6;
        }

        .admin-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 260px;
            background: linear-gradient(180deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            z-index: 100;
            transition: all 0.3s ease;
        }

        .sidebar-header {
            padding: 1.5rem 1.5rem 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
        }

        .sidebar-header h1 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .sidebar-header p {
            font-size: 0.875rem;
            opacity: 0.8;
        }

        .sidebar-nav {
            padding: 1rem 0.75rem;
        }

        .nav-item {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            margin-bottom: 0.5rem;
            border-radius: 0.5rem;
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            transition: all 0.2s ease;
            font-weight: 500;
        }

        .nav-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            transform: translateX(5px);
        }

        .nav-item.active {
            background-color: rgba(255, 255, 255, 0.15);
            color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .nav-item i {
            margin-right: 0.75rem;
            font-size: 1.125rem;
            width: 24px;
            text-align: center;
        }

        .logout-btn {
            margin-top: 2rem;
            background-color: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: rgba(255, 255, 255, 0.9);
        }

        .logout-btn:hover {
            background-color: var(--danger);
            color: white;
            transform: none;
        }

        /* Main Content Styles */
        .main-content {
            flex: 1;
            padding: 1.5rem;
            overflow-y: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .page-title {
            font-size: 1.875rem;
            font-weight: 700;
            color: var(--dark);
        }

        .user-info {
            display: flex;
            align-items: center;
            background-color: white;
            padding: 0.75rem 1.25rem;
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .user-info i {
            margin-right: 0.75rem;
            color: var(--primary);
            font-size: 1.25rem;
        }

        .user-name {
            font-weight: 600;
            color: var(--dark);
        }

        /* Content Area */
        .content-area {
            background-color: white;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .admin-container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                height: auto;
            }

            .sidebar-nav {
                display: flex;
                flex-wrap: wrap;
                gap: 0.5rem;
            }

            .nav-item {
                flex: 1;
                min-width: 140px;
                justify-content: center;
            }

            .logout-btn {
                margin-top: 1rem;
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h1>Admin Panel</h1>
                <p>Kelurahan Sipangah</p>
            </div>
            <nav class="sidebar-nav">
                <a href="{{ route('admin.dashboard') }}" class="nav-item active">
                    <i class="fas fa-chart-bar"></i>
                    Dashboard
                </a>
                 <a href="{{ route('admin.galeri.index') }}" class="nav-item">
    <i class="fas fa-images"></i>
    Kelola Galeri
</a>

               <a href="{{ route('admin.pengaduan.index') }}" class="nav-item flex items-center space-x-2 px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-md transition">
    <i class="fas fa-concierge-bell text-teal-600"></i>
    <span>Kelola Layanan Pengaduan</span>
</a>

                <a href="{{ route('admin.artikel.index') }}" class="nav-item">
                    <i class="fas fa-newspaper"></i>
                    Kelola Artikel
                </a>

               <a href="{{ route('admin.item_potensi.index') }}" class="nav-item flex items-center gap-2 px-4 py-2 hover:bg-gray-100 rounded">
    <i class="fas fa-file-alt"></i>
    <span>Kelola Potensi</span>
</a>


                <a href="#" class="nav-item">
                    <i class="fas fa-file-alt"></i>
                    Laporan
                </a>


                <form method="POST" action="{{ route('logout') }}" class="nav-item logout-btn">
                    @csrf
                    <button type="submit" class="logout-btn" style="background: none; border: none; color: inherit; width: 100%; text-align: left; cursor: pointer;">
                        <i class="fas fa-sign-out-alt"></i>
                        Logout
                    </button>
                </form>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <div class="header">
                <h2 class="page-title">@yield('title', 'Dashboard Admin')</h2>
                <div class="user-info">
                    <i class="fas fa-user-circle"></i>
                    <span>Halo, <span class="user-name">{{ auth()->user()->name }}</span></span>
                </div>
            </div>

            <!-- Content -->
            <div class="content-area">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        // Menambahkan interaktivitas sederhana
        document.addEventListener('DOMContentLoaded', function() {
            // Menambahkan efek aktif pada menu yang diklik
            const navItems = document.querySelectorAll('.nav-item');
            navItems.forEach(item => {
                item.addEventListener('click', function() {
                    navItems.forEach(i => i.classList.remove('active'));
                    this.classList.add('active');
                });
            });

            // Menambahkan animasi pada konten
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
