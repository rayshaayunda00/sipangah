<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User; // Pastikan model User di-import

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Mendefinisikan 'is-admin' Gate.
        // Gate ini akan mengembalikan true jika user memiliki kolom is_admin yang bernilai true (1).
        Gate::define('is-admin', function (User $user) {
            // Kita menggunakan Gate ini untuk memproteksi semua rute admin.
            return $user->is_admin;
        });
    }
}
