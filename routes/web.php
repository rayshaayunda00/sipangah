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

Route::get('/layanan', function () {
    return view('layanan');
})->middleware(RedirectIfNotRegistered::class)
  ->name('layanan'); // tambahkan nama route


// 🔐 Login & Logout (pakai Breeze bawaan)
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

// Dashboard umum (user login biasa)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Route khusus admin (tanpa mendaftar di Kernel)
Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    // Tambahkan route admin lain di sini
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



// 🔹 Route Admin (CRUD)
Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () {
    Route::get('artikel', [ArtikelController::class, 'index'])->name('artikel.index');
    Route::get('artikel/create', [ArtikelController::class, 'create'])->name('artikel.create');
    Route::post('artikel', [ArtikelController::class, 'store'])->name('artikel.store');
    Route::get('artikel/{id}/edit', [ArtikelController::class, 'edit'])->name('artikel.edit');
    Route::put('artikel/{id}', [ArtikelController::class, 'update'])->name('artikel.update');
    Route::delete('artikel/{id}', [ArtikelController::class, 'destroy'])->name('artikel.destroy');
});



Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel.index');


/// 🔹 Route Publik
// Daftar artikel (harus ditulis dulu)
Route::get('/artikel', [ArtikelController::class, 'publicIndex'])->name('artikel.index');

// Detail artikel (ditulis setelah route daftar)
Route::get('/artikel/{seo}', [ArtikelController::class, 'publicShow'])->name('artikel.show');

require __DIR__.'/auth.php';
