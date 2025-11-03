<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     * Membuat tabel 'arsips' untuk menyimpan data arsip dokumen.
     */
    public function up(): void
    {
        Schema::create('arsips', function (Blueprint $table) {
            $table->id();

            // Nomor arsip, bisa kosong jika di-generate otomatis, dan harus unik jika diisi
            $table->string('nomor_arsip')->nullable()->unique()->comment('Nomor unik arsip, diisi otomatis jika kosong');

            // Data utama arsip
            $table->string('judul_arsip')->comment('Judul lengkap dari dokumen arsip');

            // Kategori arsip, menggunakan tipe ENUM untuk membatasi pilihan
            $table->enum('kategori', ['Surat Masuk', 'Surat Keluar', 'Dokumen Penting'])->comment('Kategori jenis arsip');

            $table->text('deskripsi')->nullable()->comment('Deskripsi atau ringkasan singkat isi arsip');
            $table->date('tanggal_arsip')->comment('Tanggal dokumen arsip dibuat atau diterima');

            // Kolom untuk path file lampiran
            $table->string('file_lampiran')->nullable()->comment('Path lokasi file (misalnya PDF) di storage');

            // Status arsip (Aktif/Tidak Aktif)
            $table->enum('status', ['Aktif', 'Tidak Aktif'])->default('Aktif')->comment('Status ketersediaan arsip');

            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Membatalkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('arsips');
    }
};
