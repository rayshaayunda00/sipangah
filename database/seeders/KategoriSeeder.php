<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoriList = [
            'Teknologi',
            'Kesehatan',
            'Pendidikan',
        ];

        foreach ($kategoriList as $nama) {
            DB::table('t_kategori')->insert([
                'nama_kategori'     => $nama,
                'url_seo_kategori'  => Str::slug($nama),
                'deskripsi_kategori'=> $nama . ' seputar informasi terbaru', // opsional
                'created_at'        => now(),
                'updated_at'        => now(),
            ]);
        }
    }
}
