@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Artikel Terbaru</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse($artikels as $a)
            <div class="bg-white shadow rounded overflow-hidden">
                @if($a->url_gambar_utama)
                    <img src="{{ $a->url_gambar_utama }}" class="w-full h-40 object-cover">
                @else
                    <img src="https://via.placeholder.com/300x200" class="w-full h-40 object-cover">
                @endif

                <div class="p-4">
                    <h2 class="text-lg font-semibold mb-2">
                        <a href="{{ route('artikel.show', $a->url_seo) }}" class="hover:text-blue-600">
                            {{ $a->judul }}
                        </a>
                    </h2>
                    <p class="text-sm text-gray-500 mb-1">
                        Kategori: {{ $a->kategori?->nama_kategori ?? '-' }}
                    </p>
                    <p class="text-sm text-gray-500 mb-2">
                        Penulis: {{ $a->penulis?->nama_penulis ?? '-' }}
                    </p>
                    <p class="text-sm text-gray-600">
                        {{ Str::limit(strip_tags($a->isi_konten), 100) }}
                    </p>
                </div>
            </div>
        @empty
            <p class="text-gray-500">Belum ada artikel yang dipublish.</p>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $artikels->links() }}
    </div>
</div>
@endsection
