@extends('layouts.app')

@section('title', 'Tentang Kelurahan - Sipangah')

@push('styles')
    {{-- Font Awesome & Leaflet CSS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    {{-- 1. FONT INTER --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #0f766e;
            --primary-light: #0d9488;
            --primary-dark: #115e59;
            --accent: #f59e0b;
        }

        /* Background Halaman Soft Green */
        .page-bg {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f0fdfa 0%, #f8fafc 50%, #ecfdf5 100%);
            background-attachment: fixed;
            color: #111827;
        }

        /* Custom CSS Peta & Kartu */
        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05),
                        0 10px 15px -3px rgba(15, 118, 110, 0.08),
                        inset 0 1px 0 0 rgba(255, 255, 255, 0.8);
        }

        .card-hover { transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1); }
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(15, 118, 110, 0.25),
                        0 0 0 1px rgba(255, 255, 255, 0.9);
        }

        .hero-pattern {
            background-image: radial-gradient(circle at 20% 80%, rgba(13, 148, 136, 0.08) 0%, transparent 50%),
                              radial-gradient(circle at 80% 20%, rgba(245, 158, 11, 0.05) 0%, transparent 50%),
                              radial-gradient(circle at 40% 40%, rgba(15, 118, 110, 0.06) 0%, transparent 50%);
            background-size: 100% 100%;
        }

        .floating-element { animation: float 6s ease-in-out infinite; }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-12px); }
        }

        /* Timeline Styles */
        .timeline-item { position: relative; padding-left: 2rem; margin-bottom: 2rem; }
        .timeline-item::before {
            content: ''; position: absolute; left: 0; top: 0.5rem; width: 12px; height: 12px;
            border-radius: 50%; background-color: #0f766e;
        }
        .timeline-item::after {
            content: ''; position: absolute; left: 5px; top: 1.5rem; width: 2px;
            height: calc(100% + 0.5rem); background-color: #e5e7eb;
        }
        .timeline-item:last-child::after { display: none; }

        /* Animasi Scroll (Fade In Up) */
        .fade-in-up {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .fade-in-up.visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
@endpush

@section('content')
    {{-- Wrapper utama dengan background gradient --}}
    <div class="min-h-screen page-bg">

        {{-- HERO SECTION --}}
        {{-- PADDING DISAMAKAN PERSIS DENGAN POTENSI DAERAH (pt-20) --}}
        <section class="hero-section hero-pattern pt-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-20 text-center fade-in-up">

                {{-- Ikon --}}
                <div class="floating-element inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-teal-500 to-teal-700 rounded-2xl shadow-lg mb-6">
                    <i class="fas fa-landmark text-white text-2xl"></i>
                </div>

                {{-- Judul --}}
                <h1 class="hero-title text-5xl md:text-6xl font-black text-teal-900 mb-4 leading-tight">
                    Tentang <span class="text-teal-600">Kelurahan</span>
                </h1>

                {{-- Deskripsi --}}
                <p class="hero-subtitle text-xl text-teal-700 mb-8 max-w-2xl mx-auto leading-relaxed">
                    Informasi lengkap mengenai visi & misi, sejarah, struktur organisasi, dan peta wilayah kelurahan Cupak Tangah.
                </p>

            </div>
        </section>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">

            {{-- VISI & MISI (Added fade-in-up) --}}
            <section class="mb-12 md:mb-16 fade-in-up">
                <div class="grid md:grid-cols-2 gap-8">
                    <div class="glass-card rounded-2xl overflow-hidden card-hover h-full">
                        <div class="bg-gradient-to-r from-teal-500 to-teal-600 p-6">
                            <div class="flex items-center text-white">
                                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mr-4">
                                    <i class="fas fa-bullseye text-xl"></i>
                                </div>
                                <h3 class="text-xl md:text-2xl font-bold">Visi</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-700 leading-relaxed text-lg">
                                Terwujudnya masyarakat kelurahan yang berpendidikan, sejahtera, religius, dan berbudaya.
                            </p>
                        </div>
                    </div>

                    <div class="glass-card rounded-2xl overflow-hidden card-hover h-full">
                        <div class="bg-gradient-to-r from-teal-500 to-teal-600 p-6">
                            <div class="flex items-center text-white">
                                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mr-4">
                                    <i class="fas fa-tasks text-xl"></i>
                                </div>
                                <h3 class="text-xl md:text-2xl font-bold">Misi</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            <ul class="space-y-4">
                                <li class="flex items-start">
                                    <span class="text-teal-600 mr-2 font-bold">✓</span>
                                    <span class="text-gray-700">Mewujudkan pendidikan yang berkualitas.</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="text-teal-600 mr-2 font-bold">✓</span>
                                    <span class="text-gray-700">Meningkatkan kesejahteraan masyarakat & ekonomi kerakyatan.</span>
                                </li>
                                <li class="flex items-start">
                                    <span class="text-teal-600 mr-2 font-bold">✓</span>
                                    <span class="text-gray-700">Menciptakan masyarakat religius berbudaya lokal.</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>

            {{-- SEJARAH (Added fade-in-up) --}}
            <section class="mb-12 fade-in-up">
                <div class="glass-card rounded-2xl overflow-hidden p-6 md:p-8">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl md:text-4xl font-black text-gray-800 mb-4">Sejarah Singkat</h2>
                    </div>
                    <div class="timeline-container max-w-3xl mx-auto">
                        <div class="timeline-item">
                            <h4 class="font-bold text-lg text-teal-700 mb-1">1980 - Berdiri</h4>
                            <p class="text-gray-600">Pemekaran wilayah dari kecamatan sekitar.</p>
                        </div>
                        <div class="timeline-item">
                            <h4 class="font-bold text-lg text-teal-700 mb-1">Era Modern</h4>
                            <p class="text-gray-600">Terus berinovasi dengan pelayanan berbasis digital seperti Sipangah.</p>
                        </div>
                    </div>
                </div>
            </section>

            {{-- STRUKTUR ORGANISASI (Added fade-in-up) --}}
            <section class="mb-12 fade-in-up">
                <div class="glass-card rounded-2xl overflow-hidden">
                    <div class="bg-gray-50 p-6 border-b border-gray-100">
                        <h2 class="text-2xl font-bold text-center text-gray-800">Struktur Organisasi</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-teal-50">
                                <tr>
                                    <th class="px-6 py-4 text-teal-800 font-semibold">Jabatan</th>
                                    <th class="px-6 py-4 text-teal-800 font-semibold">Nama</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 text-gray-700 font-medium">Lurah</td>
                                    <td class="px-6 py-4 text-gray-600">Saidul Bahri, SH</td>
                                </tr>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 text-gray-700 font-medium">Sekretaris</td>
                                    <td class="px-6 py-4 text-gray-600">Nefrita Sari, SE.MM</td>
                                </tr>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 text-gray-700 font-medium">Seksi Tapem</td>
                                    <td class="px-6 py-4 text-gray-600">Meli Chairani, A.md</td>
                                </tr>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 text-gray-700 font-medium">Seksi PM dan Kesos</td>
                                    <td class="px-6 py-4 text-gray-600">Rasnanelly</td>
                                </tr>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 text-gray-700 font-medium">Seksi Trantibum dan PB</td>
                                    <td class="px-6 py-4 text-gray-600">Safarin S.AP</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            {{-- PETA (Added fade-in-up) --}}
            <section class="fade-in-up pb-16">
                <div class="glass-card rounded-2xl overflow-hidden">
                    <div class="bg-teal-600 p-4 text-white flex items-center">
                        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-map-marked-alt text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold">Peta Wilayah</h3>
                    </div>
                    <div id="map" class="w-full h-[450px] z-0"></div>
                    <div class="p-4 flex justify-end">
    <a href="https://www.google.com/maps/place/Cupak+Tangah,+Kec.+Pauh,+Kota+Padang,+Sumatera+Barat/@-0.9363475,100.4231463,14.47z"
       target="_blank"
       class="inline-flex items-center gap-2 bg-teal-600 hover:bg-teal-700 text-white font-semibold px-4 py-2 rounded-lg shadow-md transition">
        <i class="fas fa-location-arrow"></i>
        Lihat di Google Maps
    </a>
</div>

                </div>
            </section>

        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // === 1. Animasi Scroll (Intersection Observer) ===
            const observerOptions = {
                threshold: 0.1, // Animasi mulai saat 10% elemen terlihat
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, observerOptions);

            // Targetkan semua elemen dengan class fade-in-up
            document.querySelectorAll('.fade-in-up').forEach(el => observer.observe(el));

            // === 2. Map Leaflet ===
            // === 2. Map Leaflet ===
// === 2. Map Leaflet ===
if (document.getElementById('map')) {
    var map = L.map('map').setView([-0.9360, 100.4310], 14);

    // === BASE LAYERS ===
    var esriSat = L.tileLayer(
        'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}',
        {
            maxZoom: 20,
            attribution: 'Tiles © Esri — Source: Esri, Maxar, Earthstar Geographics'
        }
    ).addTo(map);

    var esriStreets = L.tileLayer(
        'https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}',
        {
            maxZoom: 20,
            attribution: 'Tiles © Esri'
        }
    );

    var osm = L.tileLayer(
        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
        {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }
    );

    // === OVERLAYS ===
    var kantorMarker = L.marker([-0.9360, 100.4310]).bindPopup("<b>Kantor Lurah Cupak Tangah</b>");

    var polygonLayer = L.geoJSON(null, {
        style: {
            color: '#0f766e',
            weight: 3,
            fillColor: '#0d9488',
            fillOpacity: 0.25
        }
    });

    // Load GeoJSON
    fetch('{{ asset('geojson/cupak_tangah.json') }}')
        .then(response => response.json())
        .then(data => polygonLayer.addData(data))
        .catch(e => console.log('GeoJSON Error:', e));

    // === GROUP LAYERS ===
    var baseLayers = {
        "ESRI Satellite": esriSat
        // "ESRI Streets": esriStreets,
        // "OpenStreetMap": osm
    };

    var overlays = {
        "Wilayah Cupak Tangah": polygonLayer,
        "Kantor Lurah": kantorMarker
    };

    // === ADD LAYER CONTROL ===
    L.control.layers(baseLayers, overlays, { collapsed: false }).addTo(map);

    // Add overlays default
    kantorMarker.addTo(map);
    polygonLayer.addTo(map);
}

        });
    </script>
@endpush
