<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('t_artikel', function (Blueprint $table) {
            $table->id('id_artikel');
            $table->string('judul', 255);
            $table->string('url_seo')->unique();
            $table->longText('isi_konten');
            $table->string('url_gambar_utama')->nullable();

            // Relasi
            $table->unsignedBigInteger('id_kategori')->nullable();
            $table->unsignedBigInteger('id_penulis')->nullable();

            // Statistik
            $table->unsignedInteger('jumlah_dibaca')->default(0);
            $table->unsignedInteger('jumlah_suka')->default(0);
            $table->unsignedInteger('jumlah_dibagikan')->default(0);

            // Publikasi
            $table->dateTime('tanggal_publikasi')->nullable();
            $table->enum('status_publikasi', ['draft', 'published'])->default('draft');

            $table->timestamps();

            // Foreign Key
            $table->foreign('id_kategori')->references('id_kategori')->on('t_kategori')->cascadeOnDelete();
            $table->foreign('id_penulis')->references('id_penulis')->on('t_penulis')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('t_artikel');
    }
};
