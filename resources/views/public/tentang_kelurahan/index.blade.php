<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kelurahan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

    :root {
        --primary: #0f766e;
        --primary-light: #0d9488;
        --primary-dark: #115e59;
        --accent: #f59e0b;
        --accent-light: #fbbf24;
        --gray-50: #f9fafb;
        --gray-100: #f3f4f6;
        --gray-200: #e5e7eb;
        --gray-500: #6b7280;
        --gray-700: #374151;
        --gray-900: #111827;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', sans-serif;
        background: linear-gradient(135deg, #f0fdfa 0%, #f8fafc 50%, #ecfdf5 100%);
        background-attachment: fixed;
        color: var(--gray-900);
        overflow-x: hidden;
    }

    .glass-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow:
            0 4px 6px -1px rgba(0, 0, 0, 0.05),
            0 10px 15px -3px rgba(15, 118, 110, 0.08),
            inset 0 1px 0 0 rgba(255, 255, 255, 0.8);
    }

    .card-hover {
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .card-hover:hover {
        transform: translateY(-8px);
        box-shadow:
            0 25px 50px -12px rgba(15, 118, 110, 0.25),
            0 0 0 1px rgba(255, 255, 255, 0.9);
    }

    .hero-pattern {
        background-image:
            radial-gradient(circle at 20% 80%, rgba(13, 148, 136, 0.08) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(245, 158, 11, 0.05) 0%, transparent 50%),
            radial-gradient(circle at 40% 40%, rgba(15, 118, 110, 0.06) 0%, transparent 50%);
        background-size: 100% 100%;
    }

    .floating-element {
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-12px); }
    }

    /* ===== GRID LAYOUT UMUM ===== */
    .grid-layout {
        display: flex;
        justify-content: center;
        align-items: stretch;
        flex-wrap: wrap;
        gap: 2rem;
        text-align: left;
    }

    .grid-layout > div {
        flex: 1 1 320px;
        max-width: 420px;
    }

    /* ===== Visi Misi ===== */
    .visi-misi-section {
        text-align: center;
    }

    .visi-misi-section h2 {
        text-align: center;
    }

    .mission-item {
        position: relative;
        padding-left: 1.5rem;
        line-height: 1.6;
    }

    .mission-item::before {
        content: '✓';
        position: absolute;
        left: 0;
        color: var(--primary);
        font-weight: bold;
    }

    /* ===== Animasi ===== */
    .fade-in-up {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.6s ease;
    }

    .fade-in-up.visible {
        opacity: 1;
        transform: translateY(0);
    }

    /* ===== Timeline ===== */
    .timeline-item {
        position: relative;
        padding-left: 2rem;
        margin-bottom: 2rem;
    }

    .timeline-item::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0.5rem;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background-color: var(--primary);
    }

    .timeline-item::after {
        content: '';
        position: absolute;
        left: 5px;
        top: 1.5rem;
        width: 2px;
        height: calc(100% + 0.5rem);
        background-color: var(--gray-200);
    }

    .timeline-item:last-child::after {
        display: none;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 1024px) {
        .hero-title {
            font-size: 3rem;
        }
        .grid-layout {
            gap: 1.5rem;
        }
    }

    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.4rem;
        }
        .hero-subtitle {
            font-size: 1.1rem;
        }
        .grid-layout {
            flex-direction: column;
            align-items: center;
        }
        .grid-layout > div {
            width: 100%;
            max-width: 500px;
        }
    }

    @media (max-width: 480px) {
        .hero-title {
            font-size: 1.9rem;
        }
        .hero-subtitle {
            font-size: 1rem;
        }
    }
</style>

</head>
<body>
    @extends('layouts.app')

    @section('title', 'Tentang Kelurahan')

    @section('content')
    <div class="min-h-screen">
        <!-- Hero Section -->
        <section class="hero-section hero-pattern pt-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-20 text-center">
                <!-- Floating Icon -->
                <div class="floating-element inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-teal-500 to-teal-700 rounded-2xl shadow-lg mb-6">
                    <i class="fas fa-landmark text-white text-2xl"></i>
                </div>

                <h1 class="hero-title text-5xl md:text-6xl font-black text-teal-900 mb-4 leading-tight">
                    Tentang <span class="text-teal-600">Kelurahan</span>
                </h1>

                <p class="hero-subtitle text-xl text-teal-700 mb-8 max-w-3xl mx-auto leading-relaxed">
                    Informasi lengkap mengenai visi & misi, sejarah, struktur organisasi, dan peta wilayah kelurahan.
                </p>

                {{-- <!-- Stats Section -->
                <div class="stats-grid mt-8 md:mt-12">
                    <div class="glass-card rounded-2xl px-6 py-4 text-center">
                        <div class="text-2xl font-bold text-teal-800 mb-1">40+</div>
                        <div class="text-sm text-teal-600 font-medium">Tahun</div>
                    </div>
                    <div class="glass-card rounded-2xl px-6 py-4 text-center">
                        <div class="text-2xl font-bold text-teal-800 mb-1">15+</div>
                        <div class="text-sm text-teal-600 font-medium">Staf</div>
                    </div>
                    <div class="glass-card rounded-2xl px-6 py-4 text-center">
                        <div class="text-2xl font-bold text-teal-800 mb-1">5</div>
                        <div class="text-sm text-teal-600 font-medium">Program</div>
                    </div>
                </div> --}}
            </div>
        </section>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
            <!-- Visi & Misi -->
            <section class="mb-12 md:mb-16 fade-in-up">
                <div class="text-center mb-8 md:mb-12">
                    <h2 class="text-3xl md:text-4xl font-black text-gray-800 mb-4">Visi & Misi</h2>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Pedoman dan arah pembangunan kelurahan untuk kesejahteraan masyarakat
                    </p>
                </div>

                <div class="grid-layout">
                    <!-- Visi Card -->
                    <div class="glass-card rounded-2xl overflow-hidden card-hover">
                        <div class="bg-gradient-to-r from-teal-500 to-teal-600 p-4 md:p-6">
                            <div class="flex items-center text-white mb-4">
                                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mr-4">
                                    <i class="fas fa-bullseye text-xl"></i>
                                </div>
                                <h3 class="text-xl md:text-2xl font-bold">Visi</h3>
                            </div>
                        </div>
                        <div class="p-4 md:p-6">
                            <p class="text-gray-700 leading-relaxed text-sm md:text-base">
                                Terwujudnya masyarakat kelurahan yang berpendidikan, sejahtera, religius, dan berbudaya.
                            </p>
                        </div>
                    </div>

                    <!-- Misi Card -->
                    <div class="glass-card rounded-2xl overflow-hidden card-hover">
                        <div class="bg-gradient-to-r from-teal-500 to-teal-600 p-4 md:p-6">
                            <div class="flex items-center text-white mb-4">
                                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mr-4">
                                    <i class="fas fa-tasks text-xl"></i>
                                </div>
                                <h3 class="text-xl md:text-2xl font-bold">Misi</h3>
                            </div>
                        </div>
                        <div class="p-4 md:p-6">
                            <ul class="space-y-3">
                                <li class="mission-item text-gray-700 text-sm md:text-base">
                                    Mewujudkan pendidikan yang berkualitas (produktif, partisipatif, dan kompetitif).
                                </li>
                                <li class="mission-item text-gray-700 text-sm md:text-base">
                                    Meningkatkan kesejahteraan masyarakat dan pengembangan ekonomi kerakyatan.
                                </li>
                                <li class="mission-item text-gray-700 text-sm md:text-base">
                                    Menciptakan masyarakat kelurahan yang religius dengan memperhatikan budaya lokal.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Sejarah -->
            <section class="mb-12 md:mb-16 fade-in-up">
                <div class="text-center mb-8">
                    <h2 class="text-3xl md:text-4xl font-black text-gray-800 mb-4">Sejarah Kelurahan</h2>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Perjalanan panjang menuju kemajuan dan kesejahteraan
                    </p>
                </div>

                <div class="glass-card rounded-2xl overflow-hidden card-hover">
                    <div class="bg-gradient-to-r from-teal-500 to-teal-600 p-4 md:p-6">
                        <div class="flex items-center text-white">
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mr-4">
                                <i class="fas fa-history text-xl"></i>
                            </div>
                            <h3 class="text-xl md:text-2xl font-bold">Perjalanan Kami</h3>
                        </div>
                    </div>
                    <div class="p-4 md:p-6">
                        <div class="timeline-container">
                            <div class="timeline-item">
                                <h4 class="font-bold text-lg text-teal-700 mb-2">1980 - Berdiri</h4>
                                <p class="text-gray-700 leading-relaxed">
                                    Kelurahan ini berdiri pada tahun 1980 sebagai hasil pemekaran dari wilayah kecamatan sekitar.
                                </p>
                            </div>
                            <div class="timeline-item">
                                <h4 class="font-bold text-lg text-teal-700 mb-2">1980-2000 - Perkembangan Awal</h4>
                                <p class="text-gray-700 leading-relaxed">
                                    Sejak berdiri, kelurahan berkembang pesat dengan berbagai program pembangunan masyarakat, pendidikan, dan infrastruktur publik.
                                </p>
                            </div>
                            <div class="timeline-item">
                                <h4 class="font-bold text-lg text-teal-700 mb-2">2000-Sekarang - Modernisasi</h4>
                                <p class="text-gray-700 leading-relaxed">
                                    Hingga kini, kelurahan terus menjaga nilai-nilai gotong royong dan kebersamaan masyarakat sambil mengadopsi teknologi untuk pelayanan yang lebih baik.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Struktur Organisasi -->
            <section class="mb-12 md:mb-16 fade-in-up">
                <div class="text-center mb-8">
                    <h2 class="text-3xl md:text-4xl font-black text-gray-800 mb-4">Struktur Organisasi</h2>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Tim profesional yang siap melayani masyarakat
                    </p>
                </div>

                <div class="glass-card rounded-2xl overflow-hidden card-hover">
                    <div class="bg-gradient-to-r from-teal-500 to-teal-600 p-4 md:p-6">
                        <div class="flex items-center text-white">
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mr-4">
                                <i class="fas fa-sitemap text-xl"></i>
                            </div>
                            <h3 class="text-xl md:text-2xl font-bold">Tim Pengelola</h3>
                        </div>
                    </div>
                    <div class="p-4 md:p-6 table-responsive">
                        <table class="w-full border-collapse">
                            <thead>
                                <tr class="bg-teal-50">
                                    <th class="px-3 py-3 md:px-4 md:py-4 text-left text-teal-800 font-semibold text-sm md:text-base border-b">Jabatan</th>
                                    <th class="px-3 py-3 md:px-4 md:py-4 text-left text-teal-800 font-semibold text-sm md:text-base border-b">Nama</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-3 py-3 md:px-4 md:py-4 border-b text-gray-700 text-sm md:text-base">Lurah</td>
                                    <td class="px-3 py-3 md:px-4 md:py-4 border-b text-gray-700 text-sm md:text-base">Saidul Bahri, SH</td>
                                </tr>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-3 py-3 md:px-4 md:py-4 border-b text-gray-700 text-sm md:text-base">Sekretaris Kelurahan</td>
                                    <td class="px-3 py-3 md:px-4 md:py-4 border-b text-gray-700 text-sm md:text-base">Nefrita sari, SE.MM</td>
                                </tr>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-3 py-3 md:px-4 md:py-4 border-b text-gray-700 text-sm md:text-base">Seksi Tapem</td>
                                    <td class="px-3 py-3 md:px-4 md:py-4 border-b text-gray-700 text-sm md:text-base">Meli Chairani, A.md</td>
                                </tr>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-3 py-3 md:px-4 md:py-4 border-b text-gray-700 text-sm md:text-base">Seksi PM dan KESOS</td>
                                    <td class="px-3 py-3 md:px-4 md:py-4 border-b text-gray-700 text-sm md:text-base">Rasnanelly</td>
                                </tr>
                                 <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-3 py-3 md:px-4 md:py-4 border-b text-gray-700 text-sm md:text-base">Seksi Trantibum dan PB</td>
                                    <td class="px-3 py-3 md:px-4 md:py-4 border-b text-gray-700 text-sm md:text-base">Safarin, S.AP</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <!-- Peta Wilayah -->
            <section class="fade-in-up">
                <div class="text-center mb-8">
                    <h2 class="text-3xl md:text-4xl font-black text-gray-800 mb-4">Peta Wilayah</h2>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Lokasi dan batas wilayah kelurahan kami
                    </p>
                </div>

                <div class="glass-card rounded-2xl overflow-hidden card-hover">
                    <div class="bg-gradient-to-r from-teal-500 to-teal-600 p-4 md:p-6">
                        <div class="flex items-center text-white">
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mr-4">
                                <i class="fas fa-map-marked-alt text-xl"></i>
                            </div>
                            <h3 class="text-xl md:text-2xl font-bold">Lokasi Kelurahan</h3>
                        </div>
                    </div>
                    <div class="p-0">
                       {{-- <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3981.987654321!2d100.430987!3d-0.935987!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e2d3b4e8a9b2b5b%3A0xabcdef1234567890!2sKantor%20Lurah%20Cupak%20Tangah!5e0!3m2!1sid!2sid!4v1697083200000!5m2!1sid!2sid"
                            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy">
                        </iframe> --}}
                        <div id="map" style="height: 450px; width: 100%; border-radius: 0 0 1rem 1rem;"></div>

                        <!-- Koordinat -->
                        <div class="text-center py-4 bg-gray-50 text-gray-700 text-sm font-medium">
                            Koordinat GPS: <span class="font-semibold">-0.9360° S, 100.4310° E</span>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animate elements on scroll
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, observerOptions);

            // Observe all fade-in-up elements
            document.querySelectorAll('.fade-in-up').forEach(element => {
                observer.observe(element);
            });

            // Add hover effects to cards with delay
            const cards = document.querySelectorAll('.card-hover');
            cards.forEach((card, index) => {
                card.style.transitionDelay = `${index * 100}ms`;
            });

            // Smooth scroll for navigation
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });
    </script>
    @endsection
       @push('scripts')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Inisialisasi peta
    var map = L.map('map').setView([-0.9360, 100.4310], 14);

    // Tambahkan layer dasar (OpenStreetMap)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Ambil file GeoJSON dari folder public/geojson
    fetch('{{ asset('geojson/cupak_tangah.json') }}')
        .then(response => response.json())
        .then(data => {
            var geojsonLayer = L.geoJSON(data, {
                style: {
                    color: '#0f766e',      // Warna garis batas
                    weight: 2,             // Ketebalan garis
                    fillColor: '#0d9488',  // Warna isian (arsiran)
                    fillOpacity: 0.3       // Transparansi arsiran
                }
            }).addTo(map);

            // Sesuaikan tampilan peta dengan area GeoJSON
            map.fitBounds(geojsonLayer.getBounds());
        })
        .catch(err => console.error('Gagal memuat GeoJSON:', err));
});
</script>
@endpush
@stack('scripts')
</body>
</html>
