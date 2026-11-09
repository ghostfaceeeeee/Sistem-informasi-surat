<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\SuratKeluarController;
use App\Models\incomingLetter;
use App\Models\OutGoingLetter;

// Halaman Dashboard
Route::get('/', function () {
    $jumlahMasuk = incomingLetter::count();
    $jumlahKeluar = OutGoingLetter::count();
    $suratMasukTerbaru = incomingLetter::orderBy('tanggal', 'desc')->take(5)->get();
    $suratKeluarTerbaru = OutGoingLetter::orderBy('tanggal', 'desc')->take(5)->get();
    return view('dashboard', compact('jumlahMasuk', 'jumlahKeluar', 'suratMasukTerbaru', 'suratKeluarTerbaru'));
})->name('dashboard');

// Halaman Surat Masuk
Route::resource('surat-masuk', SuratMasukController::class)
    ->parameters(['surat-masuk' => 'id']);

// Halaman Surat Keluar
Route::resource('surat-keluar', SuratKeluarController::class)
    ->parameters(['surat-keluar' => 'id']);
