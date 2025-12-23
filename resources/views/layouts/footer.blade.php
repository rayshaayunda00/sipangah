<footer class="bg-teal-900 text-teal-50 pt-10 border-t-4 border-teal-600 font-sans relative mt-16">

    {{-- =================================== --}}
    {{-- FLOATING EMERGENCY BAR --}}
    {{-- =================================== --}}
    {{-- Bar ini akan "mengambang" sedikit di atas footer (margin top negatif) --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
        <div class="-mt-16 mb-8">
            <div class="bg-gradient-to-r from-red-600 to-red-700 rounded-xl shadow-xl py-3 px-4 text-center text-white border border-red-500/50 transform transition hover:-translate-y-1 duration-300">
                <div class="flex flex-col md:flex-row items-center justify-center gap-2 text-sm md:text-base">
                    <div class="flex items-center gap-2 font-bold text-red-100 bg-red-800/40 px-3 py-1 rounded-full animate-pulse text-xs md:text-sm">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>DARURAT</span>
                    </div>
                    <p>
                        Butuh Bantuan? Hubungi <span class="font-bold text-white border-b border-white/40 hover:border-white transition-colors mx-1">112</span>
                        atau <span class="font-bold text-white border-b border-white/40 hover:border-white transition-colors">(0751) 7051234</span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- =================================== --}}
    {{-- KONTEN UTAMA FOOTER --}}
    {{-- =================================== --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-6 gap-y-8 mb-8">

            {{-- KOLOM 1: IDENTITAS --}}
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    {{-- Logo Kotak --}}
                    <div class="w-10 h-10 bg-white text-teal-800 rounded-lg flex items-center justify-center text-lg font-black shadow-lg">
                        CT
                    </div>
                    <div class="flex flex-col">
                        <h3 class="text-lg font-bold text-white leading-none tracking-tight">Cupak Tangah</h3>
                        <span class="text-[10px] font-bold text-teal-400 uppercase tracking-[0.2em] mt-0.5">Kota Padang</span>
                    </div>
                </div>

                <p class="text-sm text-teal-100 leading-relaxed opacity-90 text-justify">
                    Mewujudkan pelayanan publik yang modern, transparan, dan akuntabel berbasis teknologi informasi untuk masyarakat.
                </p>

                <div class="space-y-2 text-sm pt-1">
    {{-- Alamat --}}
    <div class="flex items-start gap-2 group">
        <div class="mt-0.5 min-w-[1.5rem] h-6 rounded bg-teal-800 flex items-center justify-center border border-teal-700">
            <i class="fas fa-map-marker-alt text-teal-300 text-xs"></i>
        </div>
        <span class="text-teal-100 group-hover:text-white transition leading-tight">
            Jl. Raya Cupak Tangah No. 123, Kec. Pauh, Kota Padang
        </span>
    </div>

    {{-- Email --}}
    <div class="flex items-center gap-2 group">
         <div class="w-6 h-6 rounded bg-teal-800 flex items-center justify-center border border-teal-700">
            <i class="fas fa-envelope text-teal-300 text-xs"></i>
        </div>
        <span class="text-teal-100 group-hover:text-white transition">
            cupaktangah2020@gmail.com
        </span>
    </div>

    {{-- WhatsApp (Baru Ditambahkan) --}}
    <div class="flex items-center gap-2 group">
        <div class="w-6 h-6 rounded bg-teal-800 flex items-center justify-center border border-teal-700">
            <i class="fab fa-whatsapp text-teal-300 text-xs"></i>
        </div>
        <a href="https://wa.me/6281211120687" target="_blank" class="text-teal-100 group-hover:text-white transition hover:underline">
            +62 812-1112-0687
        </a>
    </div>
</div>
            </div>

            {{-- KOLOM 2: MENU UTAMA --}}
            <div>
                <h3 class="text-base font-bold text-white mb-4 flex items-center gap-2 border-b border-teal-800 pb-2">
                    Menu Utama
                </h3>
                <ul class="space-y-2 text-sm">
                    <li>
                        <a href="/" class="text-teal-200 hover:text-white hover:pl-1 transition-all duration-200 flex items-center gap-2 group">
                            <i class="fas fa-chevron-right text-teal-500 group-hover:text-white text-xs"></i> Beranda
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tentang_kelurahan.index') }}" class="text-teal-200 hover:text-white hover:pl-1 transition-all duration-200 flex items-center gap-2 group">
                            <i class="fas fa-chevron-right text-teal-500 group-hover:text-white text-xs"></i> Profil Kelurahan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('artikel.public.index') }}" class="text-teal-200 hover:text-white hover:pl-1 transition-all duration-200 flex items-center gap-2 group">
                            <i class="fas fa-chevron-right text-teal-500 group-hover:text-white text-xs"></i> Berita & Artikel
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('potensi.public.index') }}" class="text-teal-200 hover:text-white hover:pl-1 transition-all duration-200 flex items-center gap-2 group">
                            <i class="fas fa-chevron-right text-teal-500 group-hover:text-white text-xs"></i> Potensi Daerah
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('galeri.index') }}" class="text-teal-200 hover:text-white hover:pl-1 transition-all duration-200 flex items-center gap-2 group">
                            <i class="fas fa-chevron-right text-teal-500 group-hover:text-white text-xs"></i> Galeri Kegiatan
                        </a>
                    </li>
                </ul>
            </div>

            {{-- KOLOM 3: LAYANAN ONLINE --}}
            <div>
                <h3 class="text-base font-bold text-white mb-4 flex items-center gap-2 border-b border-teal-800 pb-2">
                    Layanan Online
                </h3>
                <ul class="space-y-2 text-sm">
                    <li>
                        <a href="{{ route('layanan') }}" class="text-teal-200 hover:text-white hover:pl-1 transition-all duration-200 flex items-center gap-2 group">
                            <i class="fas fa-chevron-right text-teal-500 group-hover:text-white text-xs"></i> Surat Pengantar
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('layanan') }}" class="text-teal-200 hover:text-white hover:pl-1 transition-all duration-200 flex items-center gap-2 group">
                            <i class="fas fa-chevron-right text-teal-500 group-hover:text-white text-xs"></i> Surat Domisili
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('layanan') }}" class="text-teal-200 hover:text-white hover:pl-1 transition-all duration-200 flex items-center gap-2 group">
                            <i class="fas fa-chevron-right text-teal-500 group-hover:text-white text-xs"></i> Pengajuan SKTM
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('layanan.pengaduan') }}" class="text-teal-200 hover:text-white hover:pl-1 transition-all duration-200 flex items-center gap-2 group">
                            <i class="fas fa-chevron-right text-teal-500 group-hover:text-white text-xs"></i> Layanan Pengaduan
                        </a>
                    </li>
                </ul>
            </div>

            {{-- KOLOM 4: NOMOR PENTING & SOSMED --}}
            <div>
                <h3 class="text-base font-bold text-white mb-4 flex items-center gap-2 border-b border-teal-800 pb-2">
                    Nomor Penting
                </h3>
                <div class="space-y-2 mb-6">
                    <div class="flex justify-between items-center text-xs p-2 bg-teal-800/40 rounded border border-teal-700/50 hover:bg-teal-800 transition cursor-default">
                        <span class="text-teal-200">Polsek Pauh</span>
                        <span class="font-bold text-white tracking-wide">(0751) 7051234</span>
                    </div>
                    <div class="flex justify-between items-center text-xs p-2 bg-teal-800/40 rounded border border-teal-700/50 hover:bg-teal-800 transition cursor-default">
                        <span class="text-teal-200">Puskesmas</span>
                        <span class="font-bold text-white tracking-wide">(0751) 7051235</span>
                    </div>
                    <div class="flex justify-between items-center text-xs p-2 bg-teal-800/40 rounded border border-teal-700/50 hover:bg-teal-800 transition cursor-default">
                        <span class="text-teal-200">Damkar</span>
                        <span class="font-bold text-white tracking-wide">(0751) 7051236</span>
                    </div>
                </div>

                <h3 class="text-xs font-bold text-teal-300 mb-2 uppercase tracking-wider">Ikuti Kami</h3>
                <div class="flex items-center gap-2">
                    <a href="#" class="w-8 h-8 rounded bg-teal-800 border border-teal-700 flex items-center justify-center text-teal-300 hover:bg-white hover:text-blue-600 hover:-translate-y-1 transition-all duration-300 shadow-sm">
                        <i class="fab fa-facebook-f text-sm"></i>
                    </a>
                    <a href="#" class="w-8 h-8 rounded bg-teal-800 border border-teal-700 flex items-center justify-center text-teal-300 hover:bg-white hover:text-pink-600 hover:-translate-y-1 transition-all duration-300 shadow-sm">
                        <i class="fab fa-instagram text-sm"></i>
                    </a>
                    <a href="#" class="w-8 h-8 rounded bg-teal-800 border border-teal-700 flex items-center justify-center text-teal-300 hover:bg-white hover:text-red-600 hover:-translate-y-1 transition-all duration-300 shadow-sm">
                        <i class="fab fa-youtube text-sm"></i>
                    </a>
                </div>
            </div>

        </div>

        {{-- COPYRIGHT BOTTOM BAR --}}
        <div class="border-t border-teal-800 pt-6 mt-6 flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-teal-400">
            <p class="text-center md:text-left">
                &copy; {{ date('Y') }} <strong class="text-teal-200">Kelurahan Cupak Tangah</strong>. Hak Cipta Dilindungi.
            </p>
            <div class="flex items-center gap-6">
                <a href="#" class="hover:text-white transition-colors relative group">
                    Kebijakan Privasi
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-teal-400 transition-all group-hover:w-full"></span>
                </a>
                <a href="#" class="hover:text-white transition-colors relative group">
                    Syarat & Ketentuan
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-teal-400 transition-all group-hover:w-full"></span>
                </a>
            </div>
        </div>
    </div>
</footer>
