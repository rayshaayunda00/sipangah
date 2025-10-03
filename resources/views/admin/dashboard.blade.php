<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #7c3aed;
            --primary-light: #8b5cf6;
            --primary-dark: #6d28d9;
            --secondary: #ec4899;
            --secondary-light: #f472b6;
            --accent: #06b6d4;
            --accent-light: #22d3ee;
            --success: #10b981;
            --success-light: #34d399;
            --warning: #f59e0b;
            --warning-light: #fbbf24;
            --danger: #ef4444;
            --danger-light: #f87171;
            --dark: #1e293b;
            --light: #f8fafc;
            --gray: #64748b;
            --gray-light: #e2e8f0;
            --purple-grad: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
            --blue-grad: linear-gradient(135deg, #06b6d4 0%, #3b82f6 100%);
            --green-grad: linear-gradient(135deg, #10b981 0%, #84cc16 100%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
            color: #334155;
            line-height: 1.6;
            min-height: 100vh;
        }

        .admin-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 280px;
            background: var(--purple-grad);
            color: white;
            box-shadow: 0 0 30px rgba(124, 58, 237, 0.2);
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
            position: relative;
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

        /* Main Content Styles */
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
            background: var(--purple-grad);
            border-radius: 2px;
        }

        .user-info {
            display: flex;
            align-items: center;
            background: white;
            padding: 0.875rem 1.5rem;
            border-radius: 1rem;
            box-shadow: 0 4px 15px rgba(124, 58, 237, 0.1);
            transition: all 0.3s ease;
            border: 1px solid rgba(124, 58, 237, 0.1);
        }

        .user-info:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(124, 58, 237, 0.15);
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

        /* Statistik Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }

        .stat-card {
            background: white;
            border-radius: 1.25rem;
            padding: 2rem;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.8);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
        }

        .stat-card.user-card::before {
            background: var(--purple-grad);
        }

        .stat-card.service-card::before {
            background: var(--blue-grad);
        }

        .stat-card.article-card::before {
            background: var(--green-grad);
        }

        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .stat-card h3 {
            font-size: 1rem;
            font-weight: 600;
            color: var(--gray);
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
        }

        .stat-card h3 i {
            margin-right: 0.5rem;
            font-size: 1.25rem;
        }

        .user-card h3 i { color: var(--primary); }
        .service-card h3 i { color: var(--accent); }
        .article-card h3 i { color: var(--success); }

        .stat-card .stat-value {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, var(--dark) 0%, var(--gray) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stat-card .stat-trend {
            display: flex;
            align-items: center;
            font-size: 0.875rem;
            font-weight: 600;
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            width: fit-content;
        }

        .stat-card .trend-up {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .stat-card .trend-down {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
        }

        /* Quick Menu */
        .quick-menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        .menu-card {
            background: white;
            border-radius: 1.25rem;
            padding: 2rem;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            transition: all 0.4s ease;
            text-decoration: none;
            color: inherit;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.8);
        }

        .menu-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--purple-grad);
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .menu-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(124, 58, 237, 0.2);
            color: white;
        }

        .menu-card:hover::before {
            opacity: 1;
        }

        .menu-card:hover h4,
        .menu-card:hover p,
        .menu-card:hover .card-icon {
            color: white;
            z-index: 2;
            position: relative;
        }

        .menu-card h4 {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            transition: color 0.3s ease;
        }

        .menu-card h4 i {
            margin-right: 0.75rem;
            font-size: 1.375rem;
            color: var(--primary);
            transition: color 0.3s ease;
        }

        .menu-card p {
            color: var(--gray);
            line-height: 1.5;
            transition: color 0.3s ease;
        }

        .menu-card .card-icon {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            font-size: 3rem;
            opacity: 0.08;
            color: var(--primary);
            transition: all 0.4s ease;
            z-index: 1;
        }

        .menu-card:hover .card-icon {
            opacity: 0.2;
            transform: scale(1.2) rotate(5deg);
        }

        /* Color variations for menu cards */
        .menu-card:nth-child(1):hover { box-shadow: 0 15px 35px rgba(124, 58, 237, 0.25); }
        .menu-card:nth-child(2):hover { box-shadow: 0 15px 35px rgba(6, 182, 212, 0.25); }
        .menu-card:nth-child(3):hover { box-shadow: 0 15px 35px rgba(16, 185, 129, 0.25); }
        .menu-card:nth-child(4):hover { box-shadow: 0 15px 35px rgba(236, 72, 153, 0.25); }

        .menu-card:nth-child(1)::before { background: var(--purple-grad); }
        .menu-card:nth-child(2)::before { background: var(--blue-grad); }
        .menu-card:nth-child(3)::before { background: var(--green-grad); }
        .menu-card:nth-child(4)::before { background: linear-gradient(135deg, #ec4899 0%, #f59e0b 100%); }

        /* Responsive */
        @media (max-width: 1024px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

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
                gap: 1.5rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .stat-card, .menu-card {
                padding: 1.5rem;
            }
        }

        /* Additional decorative elements */
        .floating-shapes {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.03;
            animation: float 20s infinite linear;
        }

        .shape-1 {
            width: 300px;
            height: 300px;
            background: var(--primary);
            top: 10%;
            left: 70%;
            animation-delay: 0s;
        }

        .shape-2 {
            width: 200px;
            height: 200px;
            background: var(--secondary);
            top: 60%;
            left: 10%;
            animation-delay: -5s;
        }

        .shape-3 {
            width: 150px;
            height: 150px;
            background: var(--accent);
            top: 20%;
            left: 20%;
            animation-delay: -10s;
        }

        @keyframes float {
            0% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
            100% { transform: translateY(0) rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="floating-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
    </div>

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
                <a href="#" class="nav-item">
                    <i class="fas fa-users"></i>
                    Kelola User
                </a>
                <a href="#" class="nav-item">
                    <i class="fas fa-concierge-bell"></i>
                    Kelola Layanan
                </a>
                <a href="{{ route('admin.artikel.index') }}" class="nav-item">
                    <i class="fas fa-newspaper"></i>
                    Kelola Artikel
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
                <h2 class="page-title">Dashboard Admin</h2>
                <div class="user-info">
                    <i class="fas fa-user-circle"></i>
                    <span>Halo, <span class="user-name">{{ auth()->user()->name }}</span></span>
                </div>
            </div>

            <!-- Statistik -->
            <div class="stats-grid">
                <div class="stat-card user-card">
                    <h3><i class="fas fa-users"></i> Jumlah User</h3>
                    <div class="stat-value">120</div>
                    <div class="stat-trend trend-up">
                        <i class="fas fa-arrow-up"></i>
                        <span>12% dari bulan lalu</span>
                    </div>
                </div>
                <div class="stat-card service-card">
                    <h3><i class="fas fa-concierge-bell"></i> Layanan</h3>
                    <div class="stat-value">8</div>
                    <div class="stat-trend trend-up">
                        <i class="fas fa-arrow-up"></i>
                        <span>2 layanan baru</span>
                    </div>
                </div>
                <div class="stat-card article-card">
                    <h3><i class="fas fa-newspaper"></i> Artikel</h3>
                    <div class="stat-value">15</div>
                    <div class="stat-trend trend-up">
                        <i class="fas fa-arrow-up"></i>
                        <span>5 artikel baru</span>
                    </div>
                </div>
            </div>

            <!-- Quick Menu -->
            <div class="quick-menu-grid">
                <a href="#" class="menu-card">
                    <h4><i class="fas fa-users-cog"></i> Kelola User</h4>
                    <p>Tambah, ubah, atau hapus data pengguna.</p>
                    <i class="fas fa-users card-icon"></i>
                </a>
                <a href="#" class="menu-card">
                    <h4><i class="fas fa-sliders-h"></i> Kelola Layanan</h4>
                    <p>Atur data layanan yang tersedia.</p>
                    <i class="fas fa-concierge-bell card-icon"></i>
                </a>
                <a href="#" class="menu-card">
                    <h4><i class="fas fa-edit"></i> Kelola Artikel</h4>
                    <p>Buat dan kelola artikel edukasi.</p>
                    <i class="fas fa-newspaper card-icon"></i>
                </a>
                <a href="#" class="menu-card">
                    <h4><i class="fas fa-chart-line"></i> Laporan</h4>
                    <p>Lihat laporan penggunaan sistem.</p>
                    <i class="fas fa-file-alt card-icon"></i>
                </a>
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
                    if (!this.classList.contains('logout-btn')) {
                        navItems.forEach(i => i.classList.remove('active'));
                        this.classList.add('active');
                    }
                });
            });

            // Animasi statistik cards saat dimuat
            const statCards = document.querySelectorAll('.stat-card');
            statCards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';

                setTimeout(() => {
                    card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 150);
            });

            // Animasi menu cards saat dimuat
            const menuCards = document.querySelectorAll('.menu-card');
            menuCards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';

                setTimeout(() => {
                    card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, (index * 100) + 500);
            });
        });
    </script>
</body>
</html>
