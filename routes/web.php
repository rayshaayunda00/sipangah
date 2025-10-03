<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Middleware\RedirectIfNotRegistered;
use App\Http\Controllers\ArtikelController;

// Halaman utama (landing page)
Route::get('/', function () {
    return view('welcome');
});

// Halaman layanan (hanya untuk user terdaftar)
Route::get('/layanan', function () {
    return view('layanan');
})->middleware(RedirectIfNotRegistered::class)
  ->name('layanan');

// 🔐 Login & Logout (Breeze)
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Dashboard user biasa
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 🔹 Route Admin
Route::prefix('admin')->middleware(['auth', AdminMiddleware::class])->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // CRUD Artikel
    Route::get('artikel', [ArtikelController::class, 'index'])->name('artikel.index');
    Route::get('artikel/create', [ArtikelController::class, 'create'])->name('artikel.create');
    Route::post('artikel', [ArtikelController::class, 'store'])->name('artikel.store');
    Route::get('artikel/{id_artikel}/edit', [ArtikelController::class, 'edit'])->name('artikel.edit');
    Route::put('artikel/{id_artikel}', [ArtikelController::class, 'update'])->name('artikel.update');
    Route::delete('artikel/{id_artikel}', [ArtikelController::class, 'destroy'])->name('artikel.destroy');
});

// 🔹 Route Publik Artikel
Route::get('/artikel', [ArtikelController::class, 'publicIndex'])->name('artikel.public.index');
Route::get('/artikel/{seo}', [ArtikelController::class, 'publicShow'])->name('artikel.public.show');

require __DIR__.'/auth.php';
