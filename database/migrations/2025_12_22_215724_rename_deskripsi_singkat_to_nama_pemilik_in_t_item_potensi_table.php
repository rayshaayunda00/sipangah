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
       Schema::table('t_item_potensi', function (Blueprint $table) {
        $table->renameColumn('deskripsi_singkat', 'nama_pemilik');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('t_item_potensi', function (Blueprint $table) {
        $table->renameColumn('nama_pemilik', 'deskripsi_singkat');
    });
    }
};
