<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Middleware\RedirectIfNotRegistered;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\GaleriPublikController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\Admin\AdminPengaduanController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KategoriPotensiController;
use App\Http\Controllers\Admin\SubkategoriPotensiController;
use App\Http\Controllers\Admin\ItemPotensiController;
use App\Http\Controllers\PotensiPublicController;

// Halaman utama (landing page)
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Halaman layanan (hanya untuk user terdaftar)
Route::get('/layanan', function () {
    return view('layanan');
})->middleware(RedirectIfNotRegistered::class)
  ->name('layanan');



Route::middleware(['auth'])->group(function () {
    Route::get('/layanan/pengaduan', [PengaduanController::class, 'index'])->name('layanan.pengaduan');
    Route::post('/layanan/pengaduan', [PengaduanController::class, 'store'])->name('layanan.pengaduan.store');
        // Riwayat Pengaduan → menampilkan semua pengaduan
    Route::get('/layanan/pengaduan/riwayat', [PengaduanController::class, 'riwayat'])
        ->name('layanan.pengaduan.riwayat');
});



// Route::middleware(['auth', 'admin'])->group(function () {
//     Route::get('/admin/pengaduan', [AdminPengaduanController::class, 'index'])->name('admin.pengaduan.index');
//     Route::get('/admin/pengaduan/{id_pengaduan}', [AdminPengaduanController::class, 'show'])->name('admin.pengaduan.show');
//     Route::post('/admin/pengaduan/{id_pengaduan}/status', [AdminPengaduanController::class, 'updateStatus'])->name('admin.pengaduan.updateStatus');
//     Route::delete('/admin/pengaduan/{id_pengaduan}', [AdminPengaduanController::class, 'destroy'])->name('admin.pengaduan.destroy');
// });
Route::prefix('admin')->middleware(['auth', AdminMiddleware::class])->name('admin.')->group(function () {
    Route::get('/pengaduan', [AdminPengaduanController::class, 'index'])->name('pengaduan.index');
    Route::get('/pengaduan/{id_pengaduan}', [AdminPengaduanController::class, 'show'])->name('pengaduan.show');
    Route::post('/pengaduan/{id_pengaduan}/status', [AdminPengaduanController::class, 'updateStatus'])->name('pengaduan.updateStatus');
    Route::delete('/pengaduan/{id_pengaduan}', [AdminPengaduanController::class, 'destroy'])->name('pengaduan.destroy');
});


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


    /// --- Admin galeri ---
    // --- Admin ---
    Route::prefix('admin')->middleware(['auth'])->group(function () {
        Route::get('/galeri', [App\Http\Controllers\Admin\GaleriController::class, 'index'])->name('admin.galeri.index');
        Route::get('/galeri/create', [App\Http\Controllers\Admin\GaleriController::class, 'create'])->name('admin.galeri.create');
        Route::post('/galeri', [App\Http\Controllers\Admin\GaleriController::class, 'store'])->name('admin.galeri.store');
        Route::get('/galeri/{id}/edit', [App\Http\Controllers\Admin\GaleriController::class, 'edit'])->name('admin.galeri.edit');
        Route::put('/galeri/{id}', [App\Http\Controllers\Admin\GaleriController::class, 'update'])->name('admin.galeri.update');
        Route::delete('/galeri/{id}', [App\Http\Controllers\Admin\GaleriController::class, 'destroy'])->name('admin.galeri.destroy');
        Route::post('/galeri/{id}/upload', [App\Http\Controllers\Admin\GaleriController::class, 'uploadFoto'])->name('admin.galeri.uploadFoto');
        Route::delete('/galeri/foto/{id}', [App\Http\Controllers\Admin\GaleriController::class, 'destroyFoto'])->name('admin.galeri.foto.destroy');
    });


// --- Publik Galeri ---
Route::get('/galeri', [GaleriPublikController::class, 'index'])->name('galeri.index');
Route::get('/galeri/{id}', [GaleriPublikController::class, 'show'])->name('galeri.show');

Route::get('/potensi', [PotensiPublicController::class, 'index'])
    ->name('potensi.public.index');

// ==================== Route Admin ====================
// Middleware 'auth' dipakai agar hanya user login (admin) bisa akses
Route::prefix('admin')->middleware('auth')->group(function () {

    // --- Kategori Potensi ---
    Route::get('/kategori-potensi', [KategoriPotensiController::class, 'index'])->name('admin.kategori_potensi.index');
    Route::get('/kategori-potensi/create', [KategoriPotensiController::class, 'create'])->name('admin.kategori_potensi.create');
    Route::post('/kategori-potensi', [KategoriPotensiController::class, 'store'])->name('admin.kategori_potensi.store');
    Route::get('/kategori-potensi/{id}/edit', [KategoriPotensiController::class, 'edit'])->name('admin.kategori_potensi.edit');
    Route::put('/kategori-potensi/{id}', [KategoriPotensiController::class, 'update'])->name('admin.kategori_potensi.update');
    Route::delete('/kategori-potensi/{id}', [KategoriPotensiController::class, 'destroy'])->name('admin.kategori_potensi.destroy');

    // --- Subkategori Potensi ---
    Route::get('/subkategori-potensi', [SubkategoriPotensiController::class, 'index'])->name('admin.subkategori_potensi.index');
    Route::get('/subkategori-potensi/create', [SubkategoriPotensiController::class, 'create'])->name('admin.subkategori_potensi.create');
    Route::post('/subkategori-potensi', [SubkategoriPotensiController::class, 'store'])->name('admin.subkategori_potensi.store');
    Route::get('/subkategori-potensi/{id}/edit', [SubkategoriPotensiController::class, 'edit'])->name('admin.subkategori_potensi.edit');
    Route::put('/subkategori-potensi/{id}', [SubkategoriPotensiController::class, 'update'])->name('admin.subkategori_potensi.update');
    Route::delete('/subkategori-potensi/{id}', [SubkategoriPotensiController::class, 'destroy'])->name('admin.subkategori_potensi.destroy');

    // --- Item Potensi ---
    Route::get('/item-potensi', [ItemPotensiController::class, 'index'])->name('admin.item_potensi.index');
    Route::get('/item-potensi/create', [ItemPotensiController::class, 'create'])->name('admin.item_potensi.create');
    Route::post('/item-potensi', [ItemPotensiController::class, 'store'])->name('admin.item_potensi.store');
    Route::get('/item-potensi/{id}/edit', [ItemPotensiController::class, 'edit'])->name('admin.item_potensi.edit');
    Route::put('/item-potensi/{id}', [ItemPotensiController::class, 'update'])->name('admin.item_potensi.update');
    Route::delete('/item-potensi/{id}', [ItemPotensiController::class, 'destroy'])->name('admin.item_potensi.destroy');

});


require __DIR__.'/auth.php';
