<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PageController; // <-- TAMBAHKAN INI

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- RUTE HALAMAN STATIS (YANG SUDAH DIPERBAIKI) ---
Route::get('/', [PageController::class, 'welcome'])->name('welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
    Route::get('/kontak', [PageController::class, 'kontak'])->name('kontak');
    Route::get('/menu', [PageController::class, 'menu'])->name('menu');
});


// --- RUTE BARANG ---
Route::resource('barang', BarangController::class)->middleware('auth');
Route::get('/makanan', [BarangController::class, 'showMakanan'])->name('makanan');
Route::get('/minuman', [BarangController::class, 'showMinuman'])->name('minuman');


// --- RUTE PEMESANAN (SUDAH DIRAPIKAN) ---
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/lihat-pesanan', [PemesananController::class, 'index'])->name('pesanan.index');
    // Anda punya 3 rute yang namanya sama ('pesan.store'). Sebaiknya gunakan satu saja.
    Route::post('/pesanan/store', [PemesananController::class, 'store'])->name('pesanan.store');
    Route::delete('/pesanan/{id}', [PemesananController::class, 'destroy'])->name('pesanan.destroy');
    Route::post('/pesanan/{id}/approve', [PemesananController::class, 'aprove'])->name('pesanan.approve');
});


// --- RUTE PROFIL ---
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// --- RUTE AUTENTIKASI ---
require __DIR__.'/auth.php';
