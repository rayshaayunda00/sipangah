<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id('id_pengaduan');
            $table->string('nama_pengadu');
            $table->string('email_pengadu');
            $table->string('no_hp_pengadu', 20)->nullable();
            $table->string('judul_pengaduan');
            $table->text('isi_pengaduan');
            $table->timestamp('tanggal_pengaduan')->useCurrent();
            $table->enum('status_pengaduan', ['Baru', 'Dalam Proses', 'Selesai'])->default('Baru');
            $table->string('url_lampiran')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaduans');
    }
};
