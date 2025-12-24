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
        try {
            // 1. Ambil User dari Google
            $googleUser = Socialite::driver('google')
                ->stateless()
                ->setHttpClient(new Client(['verify' => false]))
                ->user();

            // 2. BERSIHKAN DATA EMAIL (Kunci Perbaikan)
            // Ubah jadi huruf kecil semua & hapus spasi depan/belakang
            $googleEmail = strtolower(trim($googleUser->getEmail()));

            // 3. CARI USER (Case Insensitive Search)
            // Kita cari user yang emailnya sama, tanpa peduli huruf besar/kecil
            $user = User::whereRaw('LOWER(email) = ?', [$googleEmail])->first();

            // 4. LOGIKA UTAMA (Account Linking)
            if ($user) {
                // --- KASUS A: User KETEMU (Sudah daftar manual atau google sebelumnya) ---

                // Jika kolom google_id masih kosong (berarti dulu dia daftar manual),
                // Kita "Sambungkan" akun ini dengan Google ID sekarang.
                if (empty($user->google_id)) {
                    $user->update([
                        'google_id' => $googleUser->getId(),
                        // Opsional: Langsung verifikasi email karena Google sudah memvalidasinya
                        'email_verified_at' => $user->email_verified_at ?? now(),
                    ]);
                }

                // Login User
                Auth::login($user);

                // Redirect ke dashboard
                return redirect()->intended('/dashboard');

            } else {
                // --- KASUS B: User BENAR-BENAR BELUM ADA ---
                return redirect()->route('register')
                    ->with('error', 'Email ' . $googleEmail . ' belum terdaftar. Silakan registrasi manual terlebih dahulu.');
            }

        } catch (\Exception $e) {
            // Error handling
            return redirect()->route('login')->with('error', 'Gagal login dengan Google. Silakan coba lagi.');
        }
    }
}
