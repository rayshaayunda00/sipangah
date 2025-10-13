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
            --accent: #f59e0b;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f0fdfa 0%, #f8fafc 50%, #ecfdf5 100%);
            background-attachment: fixed;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow:
                0 4px 6px -1px rgba(0, 0, 0, 0.05),
                0 10px 15px -3px rgba(15, 118, 110, 0.08),
                inset 0 1px 0 0 rgba(255, 255, 255, 0.8);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(15, 118, 110, 0.15);
        }

        .hero-pattern {
            background-image:
                radial-gradient(circle at 20% 80%, rgba(13, 148, 136, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(245, 158, 11, 0.05) 0%, transparent 50%);
        }

        .floating-element {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        /* Mobile Optimizations */
        @media (max-width: 768px) {
            .mobile-hero {
                padding-top: 6rem;
                padding-bottom: 3rem;
            }

            .mobile-hero h1 {
                font-size: 2.5rem;
            }

            .mobile-section {
                margin-bottom: 3rem;
            }
        }

        @media (max-width: 640px) {
            .mobile-hero h1 {
                font-size: 2rem;
            }

            .mobile-hero p {
                font-size: 1rem;
            }

            .mobile-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
        }

        .mission-item {
            position: relative;
            padding-left: 1.5rem;
        }

        .mission-item::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: var(--primary);
            font-weight: bold;
        }

        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
    </style>
</head>
<body>
    @extends('layouts.app')

    @section('title', 'Tentang Kelurahan')

    @section('content')
    <div class="pt-20 pb-16 min-h-screen">
        <!-- Enhanced Hero Section -->
        <div class="relative bg-gradient-to-r from-teal-600 to-teal-800 mobile-hero py-16 md:py-20 overflow-hidden">
            <div class="absolute inset-0 bg-black opacity-10"></div>
            <div class="absolute inset-0 hero-pattern"></div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
                <!-- Floating Icon -->
                <div class="floating-element inline-flex items-center justify-center w-16 h-16 md:w-20 md:h-20 bg-white/20 rounded-2xl shadow-lg mb-6 backdrop-blur-sm">
                    <i class="fas fa-landmark text-white text-xl md:text-2xl"></i>
                </div>

                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-white mb-4 md:mb-6 leading-tight">
                    Tentang <span class="text-teal-200">Kelurahan</span>
                </h1>

                <p class="text-lg md:text-xl text-teal-100 max-w-3xl mx-auto leading-relaxed mb-8">
                    Informasi lengkap mengenai visi & misi, sejarah, struktur organisasi, dan peta wilayah kelurahan.
                </p>

                {{-- <!-- Quick Stats -->
                <div class="flex flex-wrap justify-center gap-4 md:gap-6 mt-8">
                    <div class="glass-card rounded-2xl px-4 py-3 text-center min-w-[120px]">
                        <div class="text-xl md:text-2xl font-bold text-teal-800 mb-1">40+</div>
                        <div class="text-xs md:text-sm text-teal-600 font-medium">Tahun</div>
                    </div>
                    <div class="glass-card rounded-2xl px-4 py-3 text-center min-w-[120px]">
                        <div class="text-xl md:text-2xl font-bold text-teal-800 mb-1">15+</div>
                        <div class="text-xs md:text-sm text-teal-600 font-medium">Staf</div>
                    </div>
                    <div class="glass-card rounded-2xl px-4 py-3 text-center min-w-[120px]">
                        <div class="text-xl md:text-2xl font-bold text-teal-800 mb-1">5</div>
                        <div class="text-xs md:text-sm text-teal-600 font-medium">Program</div>
                    </div>
                </div> --}}
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
            <!-- Visi & Misi -->
            <section class="mobile-section mb-12 md:mb-16">
                <div class="text-center mb-8 md:mb-12">
                    <h2 class="text-3xl md:text-4xl font-black text-gray-800 mb-4">Visi & Misi</h2>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Pedoman dan arah pembangunan kelurahan untuk kesejahteraan masyarakat
                    </p>
                </div>

                <div class="mobile-grid grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
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
                                {{-- <li class="mission-item text-gray-700 text-sm md:text-base">
                                    Mengembangkan ekonomi lokal dan UMKM setempat
                                </li>
                                <li class="mission-item text-gray-700 text-sm md:text-base">
                                    Meningkatkan kualitas pendidikan dan kesehatan masyarakat
                                </li> --}}
                            </ul>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Sejarah -->
            <section class="mobile-section mb-12 md:mb-16">
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
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-3 h-3 bg-teal-500 rounded-full mt-2 mr-4"></div>
                            <p class="text-gray-700 leading-relaxed text-sm md:text-base">
                                Kelurahan ini berdiri pada tahun 1980 sebagai hasil pemekaran dari wilayah kecamatan sekitar.
                                Sejak itu, kelurahan berkembang pesat dengan berbagai program pembangunan masyarakat, pendidikan, dan infrastruktur publik.
                                Hingga kini, kelurahan terus menjaga nilai-nilai gotong royong dan kebersamaan masyarakat.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Struktur Organisasi -->
            <section class="mobile-section mb-12 md:mb-16">
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
<section class="mobile-section">
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
           <iframe
  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3981.987654321!2d100.430987!3d-0.935987!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e2d3b4e8a9b2b5b%3A0xabcdef1234567890!2sKantor%20Lurah%20Cupak%20Tangah!5e0!3m2!1sid!2sid!4v1697083200000!5m2!1sid!2sid"
  width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy">
</iframe>


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
        // Add smooth scrolling for better UX
        document.addEventListener('DOMContentLoaded', function() {
            // Add intersection observer for fade-in animations
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            // Observe all cards for animation
            document.querySelectorAll('.card-hover').forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(card);
            });
        });
    </script>
    @endsection
</body>
</html>
