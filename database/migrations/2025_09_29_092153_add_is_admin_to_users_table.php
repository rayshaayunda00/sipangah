<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Menambahkan kolom 'is_admin' dengan nilai default FALSE (0).
            // Ini memastikan pengguna baru secara default adalah non-admin.
            $table->boolean('is_admin')->default(false)->after('email')->comment('Flag untuk status Admin (1) atau Pengguna Biasa (0)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Menghapus kolom 'is_admin' saat rollback/undo migrasi.
            $table->dropColumn('is_admin');
        });
    }
};
