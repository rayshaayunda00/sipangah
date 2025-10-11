<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration: membuat tabel t_kategori_potensi
     */
    public function up(): void
    {
        Schema::create('t_kategori_potensi', function (Blueprint $table) {
            // Primary key
            $table->id('id_kategori_potensi');

            // Kolom data utama
            $table->string('nama_kategori', 100)->comment('Nama kategori potensi, contoh: UMKM Lokal');
            $table->text('deskripsi_kategori')->nullable()->comment('Deskripsi singkat tentang kategori');

            // Kolom timestamps (created_at dan updated_at)
            $table->timestamps();
        });
    }

    /**
     * Reverse migration: menghapus tabel jika rollback
     */
    public function down(): void
    {
        Schema::dropIfExists('t_kategori_potensi');
    }
};
