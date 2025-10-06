<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('t_foto_galeri', function (Blueprint $table) {
            $table->id('id_foto');
            $table->unsignedBigInteger('id_kegiatan');
            $table->string('url_foto');
            $table->string('deskripsi_foto')->nullable();
            $table->timestamps();

            $table->foreign('id_kegiatan')
                  ->references('id_kegiatan')
                  ->on('t_kegiatan_galeri')
                  ->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('t_foto_galeri');
    }
};
