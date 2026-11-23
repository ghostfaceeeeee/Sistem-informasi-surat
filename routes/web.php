<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\Auth\LoginController;
use App\Models\incomingLetter;
use App\Models\OutGoingLetter;

// ==========================================
// Route untuk Guest (belum login)
// ==========================================
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
});

// ==========================================
// Route untuk User yang sudah login
// ==========================================
Route::middleware('auth')->group(function () {

    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/', function () {
        $jumlahMasuk = incomingLetter::count();
        $jumlahKeluar = OutGoingLetter::count();
        $suratMasukTerbaru = incomingLetter::orderBy('tanggal', 'desc')->take(5)->get();
        $suratKeluarTerbaru = OutGoingLetter::orderBy('tanggal', 'desc')->take(5)->get();
        return view('dashboard', compact('jumlahMasuk', 'jumlahKeluar', 'suratMasukTerbaru', 'suratKeluarTerbaru'));
    })->name('dashboard');

    // ==========================================
    // Surat Masuk
    // ==========================================
    // Hanya petugas yang bisa create/store/edit/update/destroy
    Route::resource('surat-masuk', SuratMasukController::class)
        ->except(['index', 'show'])
        ->parameters(['surat-masuk' => 'id'])
        ->middleware('can:manage-letters');

    // Semua user (petugas & pembaca) bisa lihat daftar dan detail
    Route::resource('surat-masuk', SuratMasukController::class)
        ->only(['index', 'show'])
        ->parameters(['surat-masuk' => 'id']);

    // ==========================================
    // Surat Keluar
    // ==========================================
    // Hanya petugas yang bisa create/store/edit/update/destroy
    Route::resource('surat-keluar', SuratKeluarController::class)
        ->except(['index', 'show'])
        ->parameters(['surat-keluar' => 'id'])
        ->middleware('can:manage-letters');

    // Semua user (petugas & pembaca) bisa lihat daftar dan detail
    Route::resource('surat-keluar', SuratKeluarController::class)
        ->only(['index', 'show'])
        ->parameters(['surat-keluar' => 'id']);
});
