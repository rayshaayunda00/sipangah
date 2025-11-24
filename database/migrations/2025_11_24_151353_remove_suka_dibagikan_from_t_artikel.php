<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('t_artikel', function (Blueprint $table) {
            $table->dropColumn('jumlah_suka');
            $table->dropColumn('jumlah_dibagikan');
        });
    }

    public function down()
    {
        Schema::table('t_artikel', function (Blueprint $table) {
            $table->unsignedInteger('jumlah_suka')->default(0);
            $table->unsignedInteger('jumlah_dibagikan')->default(0);
        });
    }
};
