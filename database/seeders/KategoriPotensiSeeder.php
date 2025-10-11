<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KategoriPotensi;

class KategoriPotensiSeeder extends Seeder
{
    public function run(): void
    {
        KategoriPotensi::updateOrCreate(
            ['nama_kategori' => 'UMKM Lokal'],
            ['deskripsi_kategori' => 'Kategori untuk usaha mikro, kecil, dan menengah lokal.']
        );

        KategoriPotensi::updateOrCreate(
            ['nama_kategori' => 'Potensi Daerah'],
            ['deskripsi_kategori' => 'Kategori yang menampilkan potensi alam, budaya, dan wisata daerah.']
        );
    }
}
