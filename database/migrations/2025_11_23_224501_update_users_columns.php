<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Ubah tipe NIK → CHAR(16) UNIQUE
            $table->char('nik', 16)->nullable()->unique()->change();

            // Ubah tipe no_telepon → VARCHAR(16) UNIQUE
            $table->string('no_telepon', 16)->nullable()->unique()->change();

            // Ubah alamat → TEXT
            $table->text('alamat')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Kembali ke tipe sebelumnya
            $table->string('nik', 255)->nullable()->change();
            $table->string('no_telepon', 255)->nullable()->change();
            $table->string('alamat', 255)->nullable()->change();

            // Drop unique index jika sebelumnya terbuat
            $table->dropUnique(['nik']);
            $table->dropUnique(['no_telepon']);
        });
    }
};
