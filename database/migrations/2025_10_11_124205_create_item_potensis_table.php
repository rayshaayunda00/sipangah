<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('t_item_potensi', function (Blueprint $table) {
            $table->id('id_item_potensi');
            $table->foreignId('id_subkategori_potensi')
                  ->constrained('t_subkategori_potensi', 'id_subkategori_potensi')
                  ->onDelete('cascade');
            $table->string('nama_item', 150);
            $table->string('deskripsi_singkat', 255)->nullable();
            $table->text('deskripsi_lengkap')->nullable();
            $table->string('alamat')->nullable();
            $table->string('no_hp', 20)->nullable();
            $table->string('url_gambar_utama')->nullable();
            $table->enum('status_publikasi', ['draft', 'published'])->default('draft');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('t_item_potensi');
    }
};
