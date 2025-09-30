<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@sipangah.com'],
            [
                'name' => 'Administrator Sipangah',
                'password' => Hash::make('password'), // ganti password sesuai kebutuhan
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );
    }
}
