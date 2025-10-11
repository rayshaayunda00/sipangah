<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubkategoriPotensi;
use App\Models\KategoriPotensi;

class SubkategoriPotensiSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan kategori sudah ada
        $kategoriUmkm = KategoriPotensi::firstOrCreate([
            'nama_kategori' => 'UMKM Lokal'
        ], [
            'deskripsi_kategori' => 'Kategori untuk usaha mikro, kecil, dan menengah lokal.'
        ]);

        $kategoriDaerah = KategoriPotensi::firstOrCreate([
            'nama_kategori' => 'Potensi Daerah'
        ], [
            'deskripsi_kategori' => 'Kategori yang menampilkan potensi alam, budaya, dan wisata daerah.'
        ]);

        // Subkategori untuk UMKM Lokal
        SubkategoriPotensi::create([
            'id_kategori_potensi' => $kategoriUmkm->id_kategori_potensi,
            'nama_subkategori' => 'Kuliner'
        ]);

        SubkategoriPotensi::create([
            'id_kategori_potensi' => $kategoriUmkm->id_kategori_potensi,
            'nama_subkategori' => 'Kerajinan'
        ]);

        SubkategoriPotensi::create([
            'id_kategori_potensi' => $kategoriUmkm->id_kategori_potensi,
            'nama_subkategori' => 'Fashion Lokal'
        ]);

        // Subkategori untuk Potensi Daerah
        SubkategoriPotensi::create([
            'id_kategori_potensi' => $kategoriDaerah->id_kategori_potensi,
            'nama_subkategori' => 'Wisata Alam'
        ]);

        SubkategoriPotensi::create([
            'id_kategori_potensi' => $kategoriDaerah->id_kategori_potensi,
            'nama_subkategori' => 'Budaya & Tradisi'
        ]);

        SubkategoriPotensi::create([
            'id_kategori_potensi' => $kategoriDaerah->id_kategori_potensi,
            'nama_subkategori' => 'Sumber Daya Alam'
        ]);
    }
}
