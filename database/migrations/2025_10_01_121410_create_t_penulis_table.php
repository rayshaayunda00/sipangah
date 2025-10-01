<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('t_penulis', function (Blueprint $table) {
            $table->id('id_penulis');
            $table->string('nama_penulis', 150);
            $table->string('email')->unique()->nullable();
            $table->string('foto')->nullable();
            $table->text('bio')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('t_penulis');
    }
};
