<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tentang_kelurahan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kelurahan', 100);
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
            $table->text('sejarah')->nullable();
            $table->text('struktur_organisasi')->nullable(); // bisa JSON atau HTML
            $table->string('peta_wilayah')->nullable(); // URL atau embed iframe
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tentang_kelurahan');
    }
};
