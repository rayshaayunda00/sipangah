<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenulisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('t_penulis')->insert([
            [
                'nama_penulis' => 'Admin Utama',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'nama_penulis' => 'Editor',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ]);
    }
}
