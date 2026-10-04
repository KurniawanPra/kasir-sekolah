<?php

use App\Http\Controllers\GuruController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Halaman Dashboard & Profile (Bisa diakses Admin, Guru, Siswa)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/home', function () {
        return redirect()->route('dashboard');
    })->name('home');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// --- LEVEL: ADMIN SAJA ---
// Admin mengelola Master Data dan Akun Pengguna
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('guru', GuruController::class);
    Route::resource('kelas', KelasController::class);
    Route::get('/siswa/cetak-pdf', [SiswaController::class, 'cetakPdf'])->name('siswa.cetak-pdf');
    Route::resource('siswa', SiswaController::class);
});

// --- LEVEL: ADMIN & GURU ---
// Transaksi pembayaran SPP bisa dilakukan oleh Admin maupun Guru (Bendahara)
Route::middleware(['auth', 'role:admin,guru'])->group(function () {
    Route::resource('transaksi', TransaksiController::class);
});

require __DIR__.'/auth.php';
