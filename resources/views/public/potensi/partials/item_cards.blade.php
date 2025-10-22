@if(isset($items) && count($items) > 0)
    @foreach ($items as $item)
        <div class="glass-card rounded-2xl overflow-hidden card-hover group fade-in-up">
            <div class="relative overflow-hidden image-container">
                <img src="{{ $item->url_gambar_utama ? asset('storage/' . $item->url_gambar_utama) : 'https://images.unsplash.com/photo-1563013544-824ae1b704d3?auto=format&fit=crop&w=800&q=80' }}"
                    alt="{{ $item->nama_item }}"
                    class="w-full h-52 object-cover transition-transform duration-500 group-hover:scale-110">
                @if($item->kategori)
                    <div class="absolute top-4 right-4 flex items-center category-badge text-white text-xs font-semibold px-3 py-1.5 rounded-full">
                        <i class="fas fa-tag mr-1.5"></i>{{ $item->kategori->nama_kategori }}
                    </div>
                @endif
            </div>

            <div class="p-4 md:p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 leading-tight group-hover:text-teal-700 transition-colors duration-300">
                    {{ $item->nama_item }}
                </h2>
                <p class="text-gray-600 mb-4 text-sm line-clamp-3">{{ $item->deskripsi_singkat }}</p>
                @if ($item->alamat)
                    <div class="flex items-start text-gray-600 mb-3">
                        <i class="fas fa-map-marker-alt text-teal-500 mr-2 mt-0.5"></i>
                        <span class="text-sm line-clamp-2">{{ $item->alamat }}</span>
                    </div>
                @endif

                <div class="flex items-center justify-between pt-4 border-t border-gray-100/50">
                    @if ($item->no_hp)
                        <div class="flex items-center text-teal-600 font-semibold text-sm">
                            <i class="fas fa-phone text-green-500 mr-2"></i>{{ $item->no_hp }}
                        </div>
                    @endif
                    <button class="contact-btn inline-flex items-center text-teal-600 font-semibold text-sm px-3 py-1.5 rounded-lg bg-teal-50 border border-teal-100">
                        Hubungi <i class="fas fa-arrow-right ml-2 transition-transform duration-300 group-hover:translate-x-1"></i>
                    </button>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="text-center text-gray-500 col-span-full py-6">
        <i class="fas fa-search mb-2 text-2xl text-teal-500"></i>
        <p>Tidak ada potensi ditemukan untuk pencarian ini.</p>
    </div>
@endif
