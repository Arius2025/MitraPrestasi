<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LombaController;
use App\Http\Controllers\BlogPublicController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\LombaController as AdminLombaController;
use Illuminate\Support\Facades\Storage;
use App\Http\Middleware\IsAdmin;

/*
|--------------------------------------------------------------------------
| Web Routes - MITRA PRESTASI
|--------------------------------------------------------------------------
|
| Dibagi menjadi:
| 1. Publik (blog & lomba)
| 2. Admin (pengelolaan konten)
| 3. User (profil)
|
*/

/**
 * 🔷 Landing Page
 */
Route::get('/', [LandingController::class, 'index'])->name('home');

/**
 * 📖 Blog Publik
 */
Route::prefix('blog')->group(function () {
    Route::get('/', [BlogPublicController::class, 'index'])->name('blog.index');
    Route::get('/{blog}', [BlogPublicController::class, 'show'])->name('blog.show');
});

/**
 * 🏆 Lomba Publik
 */
Route::prefix('lomba')->group(function () {
    Route::get('/', [LombaController::class, 'index'])->name('lomba.index');
    Route::get('/{id}', [LombaController::class, 'show'])->name('lomba.show');
});

/**
 * 🛠️ Cek Koneksi Database (Opsional)
 */
Route::get('/cek-db', function () {
    try {
        DB::connection()->getPdo();
        return '✅ Terkoneksi ke database: ' . DB::connection()->getDatabaseName();
    } catch (\Exception $e) {
        return '❌ Gagal koneksi: ' . $e->getMessage();
    }
});

/**
 * 🧑‍💼 Admin Routes (Blog & Lomba Management)
 */
Route::middleware(['auth', 'isadmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', fn () => view('admin.dashboard'))->name('dashboard');

    // Blog Admin
    Route::resource('blog', AdminBlogController::class)->except(['show']);
    Route::post('blog/upload', [AdminBlogController::class, 'upload'])->name('blog.upload');

    // Lomba Admin
    Route::resource('lomba', AdminLombaController::class);
});

/**
 * 🙋 User Routes (Profil)
 */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->prefix('admin/settings')->group(function () {
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('password', [ProfileController::class, 'edit'])->name('profile.password.edit'); // bisa pakai view yang sama
    Route::post('password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
});

Route::get('/thumbnail/{filename}', function ($filename) {
    $path = storage_path('app/thumbnail/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path);
});


/**
 * 🔐 Auth Routes (Bawaan Laravel Breeze atau Jetstream)
 */
require __DIR__.'/auth.php';
