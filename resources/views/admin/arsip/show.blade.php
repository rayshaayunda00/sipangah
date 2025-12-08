@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-semibold">Detail Arsip</h1>
            <p class="text-sm text-gray-600">{{ $arsip->judul_arsip }}</p>
        </div>
        <a href="{{ route('admin.arsip.index') }}" class="px-4 py-2 border rounded-md text-sm font-medium bg-white hover:bg-gray-50">Kembali</a>
    </div>

    <div class="bg-white shadow-sm border rounded-xl p-6 space-y-6">
        <h4 class="text-lg font-semibold">{{ $arsip->nomor_arsip }}</h4>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
            <div class="text-gray-500">Judul</div>
            <div class="col-span-2 font-medium">{{ $arsip->judul_arsip }}</div>

            <div class="text-gray-500">Kategori</div>
            <div class="col-span-2"><span class="px-2 py-0.5 rounded bg-gray-100">{{ $arsip->kategori }}</span></div>

            <div class="text-gray-500">Tanggal</div>
            <div class="col-span-2">{{ \Carbon\Carbon::parse($arsip->tanggal_arsip)->format('d F Y') }}</div>

            <div class="text-gray-500">Deskripsi</div>
            <div class="col-span-2">{{ $arsip->deskripsi ?? '-' }}</div>
        </div>

        <div class="border-t pt-4">
            <h5 class="text-sm font-medium text-gray-900 mb-3">File Lampiran</h5>

            {{-- 🔥 LOGIKA NORMALISASI DATA (Anti Error) --}}
            @php
                $files = $arsip->file_lampiran;
                if (empty($files)) {
                    $files = [];
                } elseif (is_string($files)) {
                    $decoded = json_decode($files, true);
                    $files = is_array($decoded) ? $decoded : [$files];
                }
            @endphp

            @if(count($files) > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($files as $file)
                        @php
                            $url = Storage::url($file);
                            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                            $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'gif']);
                        @endphp
                        <div class="border rounded-lg p-3 bg-gray-50 flex flex-col gap-2">
                            <div class="flex items-center gap-2 overflow-hidden">
                                <div class="p-2 bg-white border rounded">
                                    <i class="fas {{ $isImage ? 'fa-image text-purple-500' : 'fa-file-alt text-blue-500' }}"></i>
                                </div>
                                <div class="truncate text-sm font-medium">{{ basename($file) }}</div>
                            </div>

                            @if($isImage)
                                <img src="{{ $url }}" class="w-full h-32 object-contain bg-white rounded border">
                            @endif

                            <div class="flex gap-2 mt-auto">
                                <a href="{{ $url }}" target="_blank" class="flex-1 text-center py-1 text-xs border bg-white rounded hover:bg-gray-100">Lihat</a>
                                <a href="{{ $url }}" download class="flex-1 text-center py-1 text-xs border bg-white rounded hover:bg-gray-100">Unduh</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-gray-500 italic">Tidak ada lampiran.</p>
            @endif
        </div>
    </div>
</div>
@endsection
