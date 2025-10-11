<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. BUAT AKUN ADMIN UTAMA
        User::updateOrCreate(
            ['email' => 'admin@cupaktangah.co.id'],
            [
                'name' => 'Admin Kelurahan Sipangah',
                'password' => bcrypt('password'), // Password: password
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );

        // 2. BUAT AKUN PENGGUNA BIASA
        User::updateOrCreate(
            ['email' => 'user@cupaktangah.co.id'],
            [
                'name' => 'Pengguna Biasa',
                'password' => bcrypt('user123'), // Password: user123
                'is_admin' => false,
                'email_verified_at' => now(),
            ]
        );

         // 2. Seeder Kategori Potensi
        $this->call(KategoriPotensiSeeder::class);

        // 3. Seeder Subkategori Potensi
        $this->call(SubkategoriPotensiSeeder::class);
    }

}
