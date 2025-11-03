@extends('layouts.admin')

@section('title', 'Kelola Arsip')

{{--
============================================================================
CSS KUSTOM (HANYA UNTUK HALAMAN INI AGAR MIRIP FIGMA)
============================================================================
--}}
@push('styles')
<style>
    /* Menimpa background container-fluid agar sesuai Figma */
    .container-fluid {
        background-color: #F8F9FA; /* Latar belakang abu-abu sangat muda */
    }

    /* Tombol Tambah Arsip (Hijau) */
    .btn-figma-primary {
        background-color: #198754; /* Warna hijau dari Figma */
        border-color: #198754;
        color: #ffffff;
        border-radius: 0.5rem; /* Sudut membulat */
        font-weight: 600;
        padding: 0.5rem 1rem;
    }
    .btn-figma-primary:hover {
        background-color: #157347;
        border-color: #146c43;
        color: #ffffff;
    }

    /* Kartu Statistik */
    .figma-stat-card {
        background-color: #ffffff;
        border: none; /* Tanpa border */
        border-radius: 0.75rem; /* Sudut membulat */
        box-shadow: 0 2px 10px rgba(0,0,0,0.05); /* Bayangan halus */
        display: flex;
        flex-direction: row;
        align-items: center;
        padding: 1.5rem;
    }
    .figma-stat-card .figma-stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
    }
    .figma-stat-card .figma-stat-icon i {
        color: #ffffff;
        font-size: 1.25rem;
    }
    /* Warna Ikon Kartu Statistik */
    .figma-stat-icon.icon-total { background-color: #0d6efd; } /* Biru */
    .figma-stat-icon.icon-masuk { background-color: #198754; } /* Hijau */
    .figma-stat-icon.icon-keluar { background-color: #fd7e14; } /* Oranye */
    .figma-stat-icon.icon-penting { background-color: #6f42c1; } /* Ungu */

    .figma-stat-card .figma-stat-info h6 {
        font-size: 0.85rem;
        color: #6c757d; /* Abu-abu */
        margin-bottom: 0.25rem;
        font-weight: 500;
    }
    .figma-stat-card .figma-stat-info p {
        font-size: 1.75rem;
        color: #343a40; /* Hitam */
        font-weight: 700;
        margin-bottom: 0;
    }

    /* Kartu Tabel Utama */
    .figma-card-table {
        background-color: #ffffff;
        border: none;
        border-radius: 0.75rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        padding: 1.5rem;
    }
    .figma-card-table .figma-card-header h5 {
        font-weight: 600;
        color: #343a40;
    }
    .figma-card-table .figma-card-header p {
        color: #6c757d;
        font-size: 0.9rem;
    }

    /* Form Pencarian & Filter di dalam Card */
    .figma-search-form .input-group-text {
        background-color: #F8F9FA; /* Latar abu-abu */
        border: 1px solid #dee2e6;
        border-right: none;
        border-radius: 0.5rem 0 0 0.5rem;
    }
    .figma-search-form .form-control,
    .figma-search-form .form-select {
        background-color: #F8F9FA; /* Latar abu-abu */
        border: 1px solid #dee2e6;
        border-radius: 0.5rem;
        padding: 0.75rem 1rem;
    }
    .figma-search-form .form-control {
        border-left: none;
        border-radius: 0 0.5rem 0.5rem 0;
    }
    .figma-search-form .form-control:focus,
    .figma-search-form .form-select:focus {
        background-color: #ffffff;
        border-color: #86b7fe;
        box-shadow: none;
    }
    .figma-filter-link {
        color: #0d6efd;
        font-weight: 600;
        text-decoration: none;
    }

    /* Tabel (Tanpa Border) */
    .figma-table {
        border-collapse: separate;
        border-spacing: 0 0.25rem; /* Jarak antar baris */
    }
    .figma-table thead th {
        background-color: transparent;
        border: none;
        color: #6c757d;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        padding: 1rem 1rem;
    }
    .figma-table tbody tr {
        background-color: #ffffff;
        border-bottom: 1px solid #f1f1f1; /* Garis pemisah antar baris */
    }
    .figma-table tbody td {
        padding: 1.25rem 1rem;
        vertical-align: middle;
        font-weight: 500;
        color: #343a40;
        border: none;
    }
    .figma-table tbody tr:hover {
        background-color: #f8f9fa; /* Hover baris */
    }
    .figma-table .dropdown-toggle::after {
        display: none; /* Sembunyikan panah dropdown */
    }

    /* Badge Kustom (Pil) */
    .figma-badge {
        padding: 0.4em 0.75em;
        border-radius: 50rem; /* Bentuk pil */
        font-weight: 600;
        font-size: 0.75rem;
    }
    .figma-badge-masuk { background-color: #cfe2ff; color: #0a58ca; }
    .figma-badge-keluar { background-color: #d1e7dd; color: #146c43; }
    .figma-badge-penting { background-color: #f8d7da; color: #b02a37; }
    .figma-badge-aktif { background-color: #d1e7dd; color: #146c43; }
    .figma-badge-tidak-aktif { background-color: #f8d7da; color: #b02a37; }
    .figma-badge-lainnya { background-color: #e2e3e5; color: #495057; }

    /* Modal Styling agar sesuai Figma */
    .modal-content {
        border-radius: 0.75rem !important;
        border: none !important;
    }
    .modal-header {
        border-bottom: 1px solid #e9ecef !important;
        padding: 1.5rem !important;
    }
    .modal-header .modal-title {
        font-weight: 600;
        font-size: 1.25rem;
    }
    .modal-body {
        padding: 1.5rem !important;
    }
    .modal-footer {
        border-top: 1px solid #e9ecef !important;
        padding: 1.5rem !important;
        background-color: #f8f9fa;
        border-bottom-right-radius: 0.75rem;
        border-bottom-left-radius: 0.75rem;
    }
    .modal-footer .btn-secondary {
        font-weight: 600;
        border-radius: 0.5rem;
    }
    .modal-footer .btn-primary {
        font-weight: 600;
        border-radius: 0.5rem;
    }
    .form-label-custom {
        font-weight: 600;
        color: #495057;
        margin-bottom: 0.5rem;
    }

</style>
@endpush
{{-- AKHIR DARI BLOK CSS KUSTOM --}}


@section('content')
<div class="container-fluid" style="background-color: #F8F9FA;">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-1 text-gray-800">Kelola Arsip</h1>
            <p class="mb-0 text-gray-600 small">Kelola arsip dan dokumen desa</p>
        </div>
        <a href="#" class="btn btn-figma-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#createArsipModal">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Arsip
        </a>
    </div>

    <!-- Baris Kartu Statistik (Menggunakan kelas Figma) -->
    <div class="row">
        @php
            $statsData = \App\Models\Arsip::query();
            $totalArsip = $statsData->count();
            $suratMasukCount = (clone $statsData)->where('kategori', 'Surat Masuk')->count();
            $suratKeluarCount = (clone $statsData)->where('kategori', 'Surat Keluar')->count();
            $dokumenPentingCount = (clone $statsData)->where('kategori', 'Dokumen Penting')->count();
        @endphp

        <!-- Total Arsip Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="figma-stat-card">
                <div class="figma-stat-icon icon-total">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="figma-stat-info">
                    <h6>Total Arsip</h6>
                    <p>{{ $totalArsip }}</p>
                </div>
            </div>
        </div>

        <!-- Surat Masuk Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="figma-stat-card">
                <div class="figma-stat-icon icon-masuk">
                    <i class="fas fa-download"></i>
                </div>
                <div class="figma-stat-info">
                    <h6>Surat Masuk</h6>
                    <p>{{ $suratMasukCount }}</p>
                </div>
            </div>
        </div>

        <!-- Surat Keluar Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="figma-stat-card">
                <div class="figma-stat-icon icon-keluar">
                    <i class="fas fa-upload"></i>
                </div>
                <div class="figma-stat-info">
                    <h6>Surat Keluar</h6>
                    <p>{{ $suratKeluarCount }}</p>
                </div>
            </div>
        </div>

        <!-- Dokumen Penting Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="figma-stat-card">
                <div class="figma-stat-icon icon-penting">
                    <i class="fas fa-file-invoice"></i>
                </div>
                <div class="figma-stat-info">
                    <h6>Dokumen Penting</h6>
                    <p>{{ $dokumenPentingCount }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Data Utama -->
    <div class="figma-card-table mb-4">
        <div class="figma-card-header mb-4">
            <h5>Daftar Arsip</h5>
            <p>Kelola dan cari arsip dokumen desa</p>
        </div>

        {{-- Search & Filter --}}
        <form method="GET" action="{{ route('admin.arsip.index') }}" class="row g-3 mb-4 align-items-center figma-search-form">
            <div class="col-md-8 col-lg-9">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-search fa-sm"></i></span>
                    <input type="text" name="search" class="form-control" placeholder="Cari nomor arsip, judul, atau kategori..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-4 col-lg-3">
                <select name="kategori" class="form-select" onchange="this.form.submit()">
                    <option value="">Semua Kategori</option>
                    <option value="Surat Masuk" {{ request('kategori') == 'Surat Masuk' ? 'selected' : '' }}>Surat Masuk</option>
                    <option value="Surat Keluar" {{ request('kategori') == 'Surat Keluar' ? 'selected' : '' }}>Surat Keluar</option>
                    <option value="Dokumen Penting" {{ request('kategori') == 'Dokumen Penting' ? 'selected' : '' }}>Dokumen Penting</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary d-none">Filter</button>
        </form>

        <div class="table-responsive">
            <table class="table figma-table" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nomor Arsip</th>
                        <th>Judul Arsip</th>
                        <th>Kategori</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th class="text-center" style="width: 100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($arsips as $arsip)
                    <tr>
                        <td>{{ $arsip->nomor_arsip }}</td>
                        <td>{{ $arsip->judul_arsip }}</td>
                        <td>
                            @php
                                $badgeClass = '';
                                switch ($arsip->kategori) {
                                    case 'Surat Masuk': $badgeClass = 'figma-badge-masuk'; break;
                                    case 'Surat Keluar': $badgeClass = 'figma-badge-keluar'; break;
                                    case 'Dokumen Penting': $badgeClass = 'figma-badge-penting'; break;
                                    default: $badgeClass = 'figma-badge-lainnya'; break;
                                }
                            @endphp
                            <span class="badge figma-badge {{ $badgeClass }}">{{ $arsip->kategori }}</span>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($arsip->tanggal_arsip)->isoFormat('D MMM YYYY') }}</td>
                        <td>
                            @if ($arsip->status == 'Aktif')
                                <span class="badge figma-badge figma-badge-aktif">Aktif</span>
                            @else
                                <span class="badge figma-badge figma-badge-tidak-aktif">Tidak Aktif</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink-{{ $arsip->id }}"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink-{{ $arsip->id }}">
                                    <div class="dropdown-header">Aksi:</div>
                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#viewArsipModal-{{ $arsip->id }}">
                                        <i class="fas fa-eye fa-sm fa-fw me-2 text-gray-400"></i> Lihat
                                    </a>
                                    <a class="dropdown-item edit-arsip-btn" href="#"
                                       data-bs-toggle="modal"
                                       data-bs-target="#editArsipModal"
                                       data-id="{{ $arsip->id }}"
                                       data-action="{{ route('admin.arsip.update', $arsip->id) }}"
                                       data-arsip="{{ $arsip->toJson() }}">
                                        <i class="fas fa-edit fa-sm fa-fw me-2 text-gray-400"></i> Edit
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <button class="dropdown-item text-danger" type="button" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal-{{ $arsip->id }}">
                                        <i class="fas fa-trash-alt fa-sm fa-fw me-2"></i> Hapus
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-5">
                            <p class="mb-0">Tidak ada arsip ditemukan.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination Links --}}
        <div class="mt-4 d-flex justify-content-center">
            {{ $arsips->withQueryString()->links() }}
        </div>
    </div>

</div>
@endsection {{-- Akhir @section('content') --}}


{{--
============================================================================
MODALS (Menggunakan styling Bootstrap 5 standar agar konsisten)
============================================================================
--}}
@push('modals')

{{-- Modal Tambah Arsip --}}
<div class="modal fade" id="createArsipModal" tabindex="-1" aria-labelledby="createArsipModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createArsipModalLabel">Tambah Arsip Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.arsip.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="is_creating" value="1">
                <div class="modal-body">
                    <p class="text-muted small mb-4">Isi formulir di bawah ini untuk menambahkan arsip baru.</p>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="create_nomor_arsip" class="form-label form-label-custom">Nomor Arsip</label>
                            <input type="text" class="form-control @error('nomor_arsip') is-invalid @enderror" id="create_nomor_arsip" name="nomor_arsip" placeholder="Kosongkan untuk generate otomatis" value="{{ old('nomor_arsip') }}">
                            <small class="form-text text-muted">Biarkan kosong untuk generate otomatis</small>
                            @error('nomor_arsip') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="create_judul_arsip" class="form-label form-label-custom">Judul Arsip <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('judul_arsip') is-invalid @enderror" id="create_judul_arsip" name="judul_arsip" placeholder="Masukkan judul arsip" value="{{ old('judul_arsip') }}" required>
                            @error('judul_arsip') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="create_kategori" class="form-label form-label-custom">Kategori Arsip <span class="text-danger">*</span></label>
                            <select class="form-select @error('kategori') is-invalid @enderror" id="create_kategori" name="kategori" required>
                                <option value="" disabled selected>Pilih kategori</option>
                                <option value="Surat Masuk" {{ old('kategori') == 'Surat Masuk' ? 'selected' : '' }}>Surat Masuk</option>
                                <option value="Surat Keluar" {{ old('kategori') == 'Surat Keluar' ? 'selected' : '' }}>Surat Keluar</option>
                                <option value="Dokumen Penting" {{ old('kategori') == 'Dokumen Penting' ? 'selected' : '' }}>Dokumen Penting</option>
                            </select>
                            @error('kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="create_tanggal_arsip" class="form-label form-label-custom">Tanggal Arsip</label>
                            <input type="date" class="form-control @error('tanggal_arsip') is-invalid @enderror" id="create_tanggal_arsip" name="tanggal_arsip" value="{{ old('tanggal_arsip', date('Y-m-d')) }}">
                            <small class="form-text text-muted">Otomatis diisi dengan tanggal hari ini</small>
                            @error('tanggal_arsip') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="create_deskripsi" class="form-label form-label-custom">Deskripsi Arsip</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="create_deskripsi" name="deskripsi" rows="3" placeholder="Masukkan deskripsi (opsional)">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-4">
                        <label for="create_file_lampiran" class="form-label form-label-custom">File Lampiran</label>
                        <input class="form-control @error('file_lampiran') is-invalid @enderror" type="file" id="create_file_lampiran" name="file_lampiran">
                        <small class="form-text text-muted">Opsional. (Maks 5MB)</small>
                        @error('file_lampiran') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-check form-switch mb-4">
                        <input class="form-check-input" type="checkbox" id="create_status" name="status" value="Aktif" role="switch" {{ old('status', 'Aktif') == 'Aktif' ? 'checked' : '' }}>
                        <label class="form-check-label" for="create_status">Status Arsip Aktif</label>
                        <small class="form-text text-muted d-block">Atur status arsip menjadi aktif atau tidak aktif</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Tambah Arsip
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Edit Arsip (Akan diisi via JavaScript) --}}
<div class="modal fade" id="editArsipModal" tabindex="-1" aria-labelledby="editArsipModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editArsipModalLabel">Edit Arsip</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editArsipForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="is_editing" value="1">
                <input type="hidden" id="edit_arsip_id_on_error" name="arsip_id_on_error" value="{{ old('arsip_id_on_error') }}">

                <div class="modal-body">
                    <p class="text-muted small mb-4">Ubah informasi arsip di bawah ini.</p>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_nomor_arsip" class="form-label form-label-custom">Nomor Arsip</label>
                            <input type="text" class="form-control @error('nomor_arsip') is-invalid @enderror" id="edit_nomor_arsip" name="nomor_arsip" value="{{ old('nomor_arsip') }}" required>
                            @error('nomor_arsip') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_judul_arsip" class="form-label form-label-custom">Judul Arsip <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('judul_arsip') is-invalid @enderror" id="edit_judul_arsip" name="judul_arsip" value="{{ old('judul_arsip') }}" required>
                            @error('judul_arsip') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_kategori" class="form-label form-label-custom">Kategori Arsip <span class="text-danger">*</span></label>
                            <select class="form-select @error('kategori') is-invalid @enderror" id="edit_kategori" name="kategori" required>
                                <option value="Surat Masuk" {{ old('kategori') == 'Surat Masuk' ? 'selected' : '' }}>Surat Masuk</option>
                                <option value="Surat Keluar" {{ old('kategori') == 'Surat Keluar' ? 'selected' : '' }}>Surat Keluar</option>
                                <option value="Dokumen Penting" {{ old('kategori') == 'Dokumen Penting' ? 'selected' : '' }}>Dokumen Penting</option>
                            </select>
                            @error('kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_tanggal_arsip" class="form-label form-label-custom">Tanggal Arsip</label>
                            <input type="date" class="form-control @error('tanggal_arsip') is-invalid @enderror" id="edit_tanggal_arsip" name="tanggal_arsip" value="{{ old('tanggal_arsip') }}">
                            @error('tanggal_arsip') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="edit_deskripsi" class="form-label form-label-custom">Deskripsi Arsip</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="edit_deskripsi" name="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-4">
                        <label for="edit_file_lampiran" class="form-label form-label-custom">Ganti File Lampiran</label>
                        <input class="form-control @error('file_lampiran') is-invalid @enderror" type="file" id="edit_file_lampiran" name="file_lampiran">
                        <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengganti file.</small>
                        <div id="current_file_display" class="mt-2" style="display: none;">
                            <i class="fas fa-file me-1 text-gray-400"></i>
                            <small class="text-secondary">File saat ini: <a id="current_file_link" href="#" target="_blank" class="text-primary fw-bold"></a></small>
                        </div>
                        @error('file_lampiran') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-check form-switch mb-4">
                        <input class="form-check-input" type="checkbox" id="edit_status" name="status" value="Aktif" role="switch" {{ old('status') == 'Aktif' ? 'checked' : '' }}>
                        <label class="form-check-label" for="edit_status">Status Arsip Aktif</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Loop untuk Modal View dan Delete --}}
@foreach ($arsips as $arsip)
    {{-- Modal Lihat Detail --}}
    <div class="modal fade" id="viewArsipModal-{{ $arsip->id }}" tabindex="-1" aria-labelledby="viewArsipModalLabel-{{ $arsip->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewArsipModalLabel-{{ $arsip->id }}">Detail Arsip</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-sm-4 text-gray-600 form-label-custom">Nomor Arsip</div>
                        <div class="col-sm-8 fw-bold text-gray-800">{{ $arsip->nomor_arsip }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-gray-600 form-label-custom">Judul Arsip</div>
                        <div class="col-sm-8 text-gray-800">{{ $arsip->judul_arsip }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-gray-600 form-label-custom">Kategori</div>
                        <div class="col-sm-8">
                            @php
                                $badgeClass = '';
                                switch ($arsip->kategori) {
                                    case 'Surat Masuk': $badgeClass = 'figma-badge-masuk'; break;
                                    case 'Surat Keluar': $badgeClass = 'figma-badge-keluar'; break;
                                    case 'Dokumen Penting': $badgeClass = 'figma-badge-penting'; break;
                                    default: $badgeClass = 'figma-badge-lainnya'; break;
                                }
                            @endphp
                            <span class="badge figma-badge {{ $badgeClass }}">{{ $arsip->kategori }}</span>
                        </div>
                    </div>
                    @if ($arsip->deskripsi)
                    <div class="row mb-3">
                        <div class="col-sm-4 text-gray-600 form-label-custom">Deskripsi</div>
                        <div class="col-sm-8 text-gray-800" style="white-space: pre-wrap;">{{ $arsip->deskripsi }}</div>
                    </div>
                    @endif
                    <div class="row mb-3">
                        <div class="col-sm-4 text-gray-600 form-label-custom">Tanggal Arsip</div>
                        <div class="col-sm-8 text-gray-800">{{ \Carbon\Carbon::parse($arsip->tanggal_arsip)->isoFormat('D MMMM YYYY') }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-gray-600 form-label-custom">Status</div>
                        <div class="col-sm-8">
                            @if ($arsip->status == 'Aktif')
                                <span class="badge figma-badge figma-badge-aktif">Aktif</span>
                            @else
                                <span class="badge figma-badge figma-badge-tidak-aktif">Tidak Aktif</span>
                            @endif
                        </div>
                    </div>
                    @if ($arsip->file_lampiran)
                    <div class="row mb-3">
                        <div class="col-sm-4 text-gray-600 form-label-custom">File Lampiran</div>
                        <div class="col-sm-8 d-flex align-items-center">
                            <i class="fas fa-file-pdf me-2 text-danger fa-lg"></i>
                            <span class="me-3 text-gray-800">{{ basename($arsip->file_lampiran) }}</span>
                            <a href="{{ Storage::url($arsip->file_lampiran) }}" class="btn btn-sm btn-outline-primary" download>
                                <i class="fas fa-download me-1"></i> Unduh
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Konfirmasi Hapus --}}
    <div class="modal fade" id="deleteConfirmationModal-{{ $arsip->id }}" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel-{{ $arsip->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel-{{ $arsip->id }}">Hapus Arsip?</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-gray-800">
                    Apakah Anda yakin ingin menghapus arsip <strong>"{{ $arsip->judul_arsip }}"</strong>?
                    <br>Tindakan ini tidak dapat dibatalkan.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form action="{{ route('admin.arsip.destroy', $arsip->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

@endpush


{{--
============================================================================
SCRIPTS
============================================================================
--}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {

        // --- LOGIKA UNTUK MODAL EDIT ARSIP ---
        const editArsipModal = document.getElementById('editArsipModal');
        if (editArsipModal) {
            editArsipModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget; // Tombol yang mengaktifkan modal

                // Ambil data dari atribut data-* tombol
                const actionUrl = button.getAttribute('data-action');
                const arsipData = JSON.parse(button.getAttribute('data-arsip'));

                // Update action URL form
                const editForm = editArsipModal.querySelector('#editArsipForm');
                editForm.action = actionUrl;

                // Isi field-field form
                editArsipModal.querySelector('#edit_nomor_arsip').value = arsipData.nomor_arsip;
                editArsipModal.querySelector('#edit_judul_arsip').value = arsipData.judul_arsip;
                editArsipModal.querySelector('#edit_kategori').value = arsipData.kategori;
                editArsipModal.querySelector('#edit_deskripsi').value = arsipData.deskripsi;

                // Format tanggal Y-m-d
                if (arsipData.tanggal_arsip) {
                    const tanggal = new Date(arsipData.tanggal_arsip);
                    const formattedDate = tanggal.toISOString().split('T')[0];
                    editArsipModal.querySelector('#edit_tanggal_arsip').value = formattedDate;
                }

                // Update status switch
                const editStatusSwitch = editArsipModal.querySelector('#edit_status');
                editStatusSwitch.checked = (arsipData.status === 'Aktif');

                // Tampilkan info file lampiran saat ini
                const currentFileDisplay = editArsipModal.querySelector('#current_file_display');
                const currentFileLink = editArsipModal.querySelector('#current_file_link');
                if (arsipData.file_lampiran) {
                    // Asumsi Storage::url() sudah benar
                    const fileName = arsipData.file_lampiran.split('/').pop();
                    currentFileLink.href = `/storage/${arsipData.file_lampiran}`; // Sesuaikan path /storage/
                    currentFileLink.textContent = fileName;
                    currentFileDisplay.style.display = 'block';
                } else {
                    currentFileDisplay.style.display = 'none';
                }

                // Set ID arsip untuk penanganan error
                editArsipModal.querySelector('#edit_arsip_id_on_error').value = arsipData.id;
            });
        }

        // --- Penanganan Error Validasi dari Server untuk Modal ---
        @if ($errors->any())
            var createModal = new bootstrap.Modal(document.getElementById('createArsipModal'));
            var editModal = new bootstrap.Modal(document.getElementById('editArsipModal'));

            @if (old('is_creating'))
                // Jika error saat 'create'
                createModal.show();

            @elseif (old('is_editing'))
                // Jika error saat 'edit'
                const errorArsipId = '{{ old('arsip_id_on_error') }}';
                if(errorArsipId) {
                    const editForm = document.getElementById('editArsipForm');
                    editForm.action = '{{ route('admin.arsip.index') }}/' + errorArsipId; // Rebuild action URL

                    // (Field-field lain sudah diisi oleh 'old()' dari Blade)

                    // Tampilkan modal edit
                    editModal.show();
                }
            @endif
        @endif
    });
</script>
@endpush

