<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration: membuat tabel t_subkategori_potensi
     */
    public function up(): void
    {
        Schema::create('t_subkategori_potensi', function (Blueprint $table) {
            // Primary key
            $table->id('id_subkategori_potensi');

            // Foreign key ke tabel kategori potensi
            $table->unsignedBigInteger('id_kategori_potensi');
            $table->foreign('id_kategori_potensi')
                  ->references('id_kategori_potensi')
                  ->on('t_kategori_potensi')
                  ->onDelete('cascade');

            // Kolom data utama
            $table->string('nama_subkategori', 100)->comment('Nama sub-kategori, contoh: Kuliner, Fashion, Pertanian');

            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse migration: menghapus tabel jika rollback
     */
    public function down(): void
    {
        Schema::dropIfExists('t_subkategori_potensi');
    }
};
