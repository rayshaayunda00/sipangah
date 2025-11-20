<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        // FIX ERROR SSL + InvalidState
        $googleUser = Socialite::driver('google')
            ->stateless()
            ->setHttpClient(new Client([
                'verify' => false, // 🔥 FIX: hilangkan error SSL cURL 60
            ]))
            ->user();

        // Cek apakah email sudah ada
        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            // Jika belum ada, buat akun baru
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'password' => bcrypt('password'), // password dummy
            ]);
        }

        // Login user
        Auth::login($user);

        return redirect('/dashboard');
    }
}
