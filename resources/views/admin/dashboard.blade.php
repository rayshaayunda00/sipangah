<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Dashboard Admin</title>
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
            --cyan-grad: linear-gradient(135deg, #06b6d4 0%, #3b82f6 100%);
            --green-grad: linear-gradient(135deg, #10b981 0%, #84cc16 100%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
        }

        body {
            /* Background yang lebih terang dan elegan */
            background: linear-gradient(135deg, #f0fdfa 0%, #f8fafc 50%, #ecfdf5 100%);
            color: #374151;
            line-height: 1.6;
            min-height: 100vh;
        }

        .admin-container {
            display: flex;
            min-height: 100vh;
        }

        /* --- Sidebar Styles (Disertakan untuk tampilan penuh) --- */
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
            top: 0; left: 0; right: 0; height: 4px;
            background: linear-gradient(90deg, var(--accent), var(--success));
        }
        .sidebar-header {
            padding: 1.75rem 1.5rem 1.25rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
            text-align: center;
        }
        .sidebar-header h1 {
            font-size: 1.5rem; font-weight: 700; margin-bottom: 0.25rem; letter-spacing: 0.5px;
        }
        .sidebar-header p {
            font-size: 0.875rem; opacity: 0.9;
        }
        .sidebar-nav {
            padding: 1.5rem 0.75rem;
        }
        .nav-item {
            display: flex; align-items: center; padding: 0.875rem 1rem; margin-bottom: 0.5rem;
            border-radius: 0.75rem; color: rgba(255, 255, 255, 0.95); text-decoration: none;
            transition: all 0.3s ease; font-weight: 500; position: relative; overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .nav-item::before {
            content: ''; position: absolute; top: 0; left: -100%; width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
            transition: left 0.5s;
        }
        .nav-item:hover::before { left: 100%; }
        .nav-item:hover {
            background-color: rgba(255, 255, 255, 0.15); color: white; transform: translateX(5px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2); border-color: rgba(255, 255, 255, 0.2);
        }
        .nav-item.active {
            background-color: rgba(255, 255, 255, 0.2); color: white; box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
            border-color: rgba(255, 255, 255, 0.3);
        }
        .nav-item i { margin-right: 0.875rem; font-size: 1.125rem; width: 24px; text-align: center; }
        .logout-btn button { display: flex; align-items: center; padding: 0; }
        .logout-btn {
            margin-top: 2rem; background: linear-gradient(135deg, rgba(239, 68, 68, 0.2) 0%, rgba(220, 38, 38, 0.2) 100%);
            border: 1px solid rgba(239, 68, 68, 0.3); color: rgba(255, 255, 255, 0.95);
        }
        .logout-btn:hover { background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; transform: none; }
        /* --- Main Content & Header Styles --- */
        .main-content {
            flex: 1; padding: 2rem; overflow-y: auto; background: transparent;
        }
        .header {
            display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem;
            padding-bottom: 1.5rem; border-bottom: 1px solid var(--gray-light);
        }
        .page-title {
            font-size: 2rem; font-weight: 800; color: var(--dark); position: relative; display: inline-block;
        }
        .page-title::after {
            content: ''; position: absolute; bottom: -10px; left: 0; width: 60px; height: 4px;
            background: var(--teal-grad); border-radius: 2px;
        }
        .user-info {
            display: flex; align-items: center; background: white; padding: 0.875rem 1.5rem;
            border-radius: 1rem; box-shadow: 0 4px 15px rgba(15, 118, 110, 0.1); transition: all 0.3s ease;
            border: 1px solid rgba(15, 118, 110, 0.1);
        }
        .user-info:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(15, 118, 110, 0.15); }
        .user-info i { margin-right: 0.875rem; color: var(--primary); font-size: 1.5rem; }
        .user-name { font-weight: 700; color: var(--primary); }
        .content-area { background-color: transparent; box-shadow: none; padding: 0; margin-bottom: 1.5rem; }

        /* Statistik Cards */
        .stats-grid {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.5rem; margin-bottom: 2.5rem;
        }
        .stat-card {
            background: white; border-radius: 1.25rem; padding: 2rem; box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            transition: all 0.4s ease; position: relative; overflow: hidden; border: 1px solid rgba(255, 255, 255, 0.8);
        }
        .stat-card::before { content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 5px; }
        .stat-card.user-card::before { background: var(--teal-grad); }
        .stat-card.service-card::before { background: var(--cyan-grad); }
        .stat-card.article-card::before { background: var(--green-grad); }
        .stat-card.gallery-card::before { background: var(--amber-grad); }
        .stat-card:hover { transform: translateY(-8px); box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15); }
        .stat-card h3 {
            font-size: 1rem; font-weight: 600; color: var(--gray); margin-bottom: 0.75rem;
            display: flex; align-items: center;
        }
        .stat-card h3 i { margin-right: 0.5rem; font-size: 1.25rem; }
        .user-card h3 i { color: var(--primary); }
        .service-card h3 i { color: var(--accent); }
        .article-card h3 i { color: var(--success); }
        .gallery-card h3 i { color: var(--secondary); }
        .stat-card .stat-value {
            font-size: 2.5rem; font-weight: 800; margin-bottom: 0.5rem;
            background: linear-gradient(135deg, var(--dark) 0%, var(--gray) 100%);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        }
        .stat-card .stat-trend {
            display: flex; align-items: center; font-size: 0.875rem; font-weight: 600;
            padding: 0.25rem 0.75rem; border-radius: 1rem; width: fit-content;
        }
        .stat-card .trend-up { background: rgba(16, 185, 129, 0.1); color: var(--success); }
        .stat-card .trend-down { background: rgba(239, 68, 68, 0.1); color: var(--danger); }

        /* Quick Menu */
        .quick-menu-grid {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem;
        }
        .menu-card {
            background: white; border-radius: 1.25rem; padding: 2rem;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08); transition: all 0.4s ease;
            text-decoration: none; color: inherit; position: relative; overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.8);
        }
        .menu-card::before {
            content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background: var(--teal-grad); opacity: 0; transition: opacity 0.4s ease;
        }
        .menu-card:hover { transform: translateY(-8px); box-shadow: 0 15px 35px rgba(15, 118, 110, 0.2); color: white; }
        .menu-card:hover::before { opacity: 1; }
        .menu-card:hover h4, .menu-card:hover p, .menu-card:hover .card-icon { color: white; z-index: 2; position: relative; }
        .menu-card h4 {
            font-size: 1.25rem; font-weight: 700; color: var(--dark); margin-bottom: 0.75rem;
            display: flex; align-items: center; transition: color 0.3s ease;
        }
        .menu-card h4 i { margin-right: 0.75rem; font-size: 1.375rem; color: var(--primary); transition: color 0.3s ease; }
        .menu-card p { color: var(--gray); line-height: 1.5; transition: color 0.3s ease; }
        .menu-card .card-icon {
            position: absolute; top: 1.5rem; right: 1.5rem; font-size: 3rem; opacity: 0.08;
            color: var(--primary); transition: all 0.4s ease; z-index: 1;
        }
        .menu-card:hover .card-icon { opacity: 0.2; transform: scale(1.2) rotate(5deg); }
        .menu-card:nth-child(1):hover { box-shadow: 0 15px 35px rgba(15, 118, 110, 0.25); }
        .menu-card:nth-child(2):hover { box-shadow: 0 15px 35px rgba(6, 182, 212, 0.25); }
        .menu-card:nth-child(3):hover { box-shadow: 0 15px 35px rgba(16, 185, 129, 0.25); }
        .menu-card:nth-child(4):hover { box-shadow: 0 15px 35px rgba(245, 158, 11, 0.25); }
        .menu-card:nth-child(5):hover { box-shadow: 0 15px 35px rgba(239, 68, 68, 0.25); }
        .menu-card:nth-child(1)::before { background: var(--teal-grad); }
        .menu-card:nth-child(2)::before { background: var(--cyan-grad); }
        .menu-card:nth-child(3)::before { background: var(--green-grad); }
        .menu-card:nth-child(4)::before { background: var(--amber-grad); }
        .menu-card:nth-child(5)::before { background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); }
        .menu-card:nth-child(4) h4 i { color: var(--secondary); }
        .menu-card:nth-child(5) h4 i { color: var(--danger); }

        /* Elements dekoratif */
        .floating-shapes { position: fixed; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; z-index: -1; }
        .shape { position: absolute; border-radius: 50%; opacity: 0.03; animation: float 20s infinite linear; }
        .shape-1 { width: 300px; height: 300px; background: var(--primary); top: 10%; left: 70%; animation-delay: 0s; }
        .shape-2 { width: 200px; height: 200px; background: var(--secondary); top: 60%; left: 10%; animation-delay: -5s; }
        .shape-3 { width: 150px; height: 150px; background: var(--accent); top: 20%; left: 20%; animation-delay: -10s; }
        @keyframes float { 0% { transform: translateY(0) rotate(0deg); } 50% { transform: translateY(-20px) rotate(180deg); } 100% { transform: translateY(0) rotate(360deg); } }

        /* --- Responsive Styles (Mobile) --- */
        @media (max-width: 768px) {
            .admin-container { flex-direction: column; }
            .sidebar { width: 100%; height: auto; }
            .sidebar-nav { display: flex; flex-wrap: wrap; gap: 0.5rem; padding: 1rem; }
            .nav-item { flex: 1; min-width: 140px; justify-content: center; padding: 0.6rem 0.5rem; }
            .nav-item span { display: none; }
            .nav-item.logout-btn span { display: inline; margin-left: 0.5rem; }
            .nav-item i { margin-right: 0; font-size: 1.2rem; width: auto; }
            .nav-item:hover { transform: none; }
            .logout-btn { margin-top: 1rem; min-width: 100px; justify-content: center; }
            .main-content { padding: 1rem; }
            .header { flex-direction: column; align-items: flex-start; gap: 1.5rem; margin-bottom: 1.5rem; padding-bottom: 1rem; }
            .page-title { font-size: 1.5rem; margin-bottom: 0.5rem; }
            .page-title::after { bottom: -5px; height: 3px; }
            .stats-grid { grid-template-columns: 1fr; }
            .stat-card, .menu-card { padding: 1.5rem; }
            .floating-shapes { display: none; }
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

                <a href="{{ route('admin.pengaduan.index') }}" class="nav-item">
                    <i class="fas fa-concierge-bell"></i>
                    <span>Kelola Layanan Pengaduan</span>
                </a>

                <a href="{{ route('admin.artikel.index') }}" class="nav-item">
                    <i class="fas fa-newspaper"></i>
                    <span>Kelola Artikel</span>
                </a>

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
                <h2 class="page-title">Dashboard Admin</h2>
                <div class="user-info">
                    <i class="fas fa-user-circle"></i>
                    <span>Halo, <span class="user-name">{{ auth()->user()->name }}</span></span>
                </div>
            </div>

            <div class="content-area">
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
                    <div class="stat-card gallery-card">
                        <h3><i class="fas fa-image"></i> Total Galeri</h3>
                        <div class="stat-value">45</div>
                        <div class="stat-trend trend-up">
                            <i class="fas fa-arrow-up"></i>
                            <span>10 foto baru</span>
                        </div>
                    </div>
                </div>

                <h3 class="page-title" style="font-size: 1.5rem; margin-bottom: 1.5rem; border-bottom: none;">Akses Cepat</h3>
                <div class="quick-menu-grid">
                    <a href="{{ route('admin.galeri.index') }}" class="menu-card">
                        <h4><i class="fas fa-images"></i> Kelola Galeri</h4>
                        <p>Tambah, edit, dan hapus foto/video galeri.</p>
                        <i class="fas fa-image card-icon"></i>
                    </a>
                    <a href="{{ route('admin.pengaduan.index') }}" class="menu-card">
                        <h4><i class="fas fa-concierge-bell"></i> Kelola Pengaduan</h4>
                        <p>Tinjau dan tanggapi laporan layanan pengaduan.</p>
                        <i class="fas fa-concierge-bell card-icon"></i>
                    </a>
                    <a href="{{ route('admin.artikel.index') }}" class="menu-card">
                        <h4><i class="fas fa-edit"></i> Kelola Artikel</h4>
                        <p>Buat dan kelola artikel berita/edukasi.</p>
                        <i class="fas fa-newspaper card-icon"></i>
                    </a>
                    <a href="{{ route('admin.item_potensi.index') }}" class="menu-card">
                        <h4><i class="fas fa-leaf"></i> Kelola Potensi</h4>
                        <p>Input dan atur data potensi daerah.</p>
                        <i class="fas fa-file-alt card-icon"></i>
                    </a>
                    <!-- Card baru untuk Kelola Pengguna -->
                    <a href="{{ route('admin.users.index') }}" class="menu-card">
                        <h4><i class="fas fa-users"></i> Kelola Pengguna</h4>
                        <p>Kelola data pengguna dan akses sistem.</p>
                        <i class="fas fa-user-cog card-icon"></i>
                    </a>
                </div>
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navItems = document.querySelectorAll('.nav-item');

            // 1. Logic for dynamic wrapping and active state (included here for completeness if this is a standalone file)
            navItems.forEach(item => {
                // Ensure link text is wrapped in <span> for mobile styling
                if (!item.querySelector('span')) {
                    let textNode = Array.from(item.childNodes).find(node => node.nodeType === 3 && node.textContent.trim().length > 0);
                    if (textNode) {
                        const span = document.createElement('span');
                        span.textContent = textNode.textContent.trim();
                        textNode.replaceWith(span);
                    }
                }

                // Ensure button logout also has span if not present
                const button = item.querySelector('button');
                if (button) {
                     if (!button.querySelector('span')) {
                         let btnTextNode = Array.from(button.childNodes).find(node => node.nodeType === 3 && node.textContent.trim().length > 0);
                         if (btnTextNode) {
                            const span = document.createElement('span');
                            span.textContent = btnTextNode.textContent.trim();
                            btnTextNode.replaceWith(span);
                        }
                    }
                }

                // 2. Logika active class saat klik/navigasi
                if (item.getAttribute('href') || item.querySelector('button')) {
                    item.addEventListener('click', function() {
                        if (!this.classList.contains('logout-btn')) {
                            navItems.forEach(i => i.classList.remove('active'));
                            this.classList.add('active');
                        }
                    });
                }
            });

            // 3. Animasi statistik cards saat dimuat
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

            // 4. Animasi menu cards saat dimuat
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

             // 5. Animasi konten area
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
