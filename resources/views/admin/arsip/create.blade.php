@extends('layouts.admin')

@section('title', 'Tambah Arsip Baru')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Tambah Arsip Baru</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Arsip Baru</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.arsip.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nomor_arsip" class="form-label">Nomor Arsip</label>
                        <input type="text" class="form-control @error('nomor_arsip') is-invalid @enderror" id="nomor_arsip" name="nomor_arsip" placeholder="Kosongkan untuk generate otomatis" value="{{ old('nomor_arsip') }}">
                        <small class="form-text text-muted">Biarkan kosong untuk generate otomatis</small>
                        @error('nomor_arsip') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="judul_arsip" class="form-label">Judul Arsip <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('judul_arsip') is-invalid @enderror" id="judul_arsip" name="judul_arsip" placeholder="Masukkan judul arsip" value="{{ old('judul_arsip') }}" required>
                        @error('judul_arsip') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="kategori" class="form-label">Kategori Arsip <span class="text-danger">*</span></label>
                        <select class="form-select @error('kategori') is-invalid @enderror" id="kategori" name="kategori" required>
                            <option value="" disabled selected>Pilih kategori</option>
                            <option value="Surat Masuk" {{ old('kategori') == 'Surat Masuk' ? 'selected' : '' }}>Surat Masuk</option>
                            <option value="Surat Keluar" {{ old('kategori') == 'Surat Keluar' ? 'selected' : '' }}>Surat Keluar</option>
                            <option value="Dokumen Penting" {{ old('kategori') == 'Dokumen Penting' ? 'selected' : '' }}>Dokumen Penting</option>
                        </select>
                        @error('kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="tanggal_arsip" class="form-label">Tanggal Arsip</label>
                        <input type="date" class="form-control @error('tanggal_arsip') is-invalid @enderror" id="tanggal_arsip" name="tanggal_arsip" value="{{ old('tanggal_arsip', date('Y-m-d')) }}">
                        <small class="form-text text-muted">Otomatis diisi dengan tanggal hari ini</small>
                        @error('tanggal_arsip') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi Arsip</label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="4" placeholder="Masukkan deskripsi (opsional)">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-4">
                    <label for="file_lampiran" class="form-label">File Lampiran</label>
                    <input class="form-control @error('file_lampiran') is-invalid @enderror" type="file" id="file_lampiran" name="file_lampiran">
                    <small class="form-text text-muted">Opsional. Tipe file: PDF, DOCX, JPG, PNG. (Maks 5MB)</small>
                    @error('file_lampiran') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-check form-switch mb-4">
                    @php
                        $isChecked = old('status', 'Aktif') == 'Aktif';
                    @endphp
                    <input class="form-check-input" type="checkbox" id="status" name="status" value="Aktif" role="switch" {{ $isChecked ? 'checked' : '' }}>
                    <label class="form-check-label" for="status">Status Arsip: <span id="status-label" class="fw-bold {{ $isChecked ? 'text-success' : 'text-secondary' }}">{{ $isChecked ? 'Aktif' : 'Tidak Aktif' }}</span></label>
                    <small class="form-text text-muted d-block">Atur status arsip menjadi aktif atau tidak aktif</small>
                </div>

                <hr>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.arsip.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Simpan Arsip
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    // Logika untuk menampilkan status switch secara dinamis
    document.addEventListener('DOMContentLoaded', function() {
        const statusSwitch = document.getElementById('status');
        if (statusSwitch) {
            const statusLabel = document.getElementById('status-label');

            function updateStatusLabel() {
                if (statusSwitch.checked) {
                    statusLabel.textContent = 'Aktif';
                    statusLabel.classList.remove('text-secondary');
                    statusLabel.classList.add('text-success');
                } else {
                    statusLabel.textContent = 'Tidak Aktif';
                    statusLabel.classList.remove('text-success');
                    statusLabel.classList.add('text-secondary');
                }
            }
            statusSwitch.addEventListener('change', updateStatusLabel);
        }
    });
</script>
@endpush
