<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\SuratKeluarController;

// Halaman Dashboard
Route::get('/', function () {
    return view('welcome');
})->name('dashboard');

// Halaman Surat Masuk
Route::get('/surat-masuk', [SuratMasukController::class, 'index'])
    ->name('surat-masuk.index');
    
    // Detail Surat Masuk
    Route::get('/surat-masuk/{id}', [SuratMasukController::class, 'show'])
    ->name('surat-masuk.show');

    Route::get('/surat-keluar', [SuratKeluarController::class, 'index'])
        ->name('surat-keluar.index');
    Route::get('/surat-keluar/{id}', [SuratKeluarController::class, 'show'])
    ->name('surat-keluar.show');

// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\SuratMasukController;

// Route::get('/', function () {
//     return view('welcome');
// });

// //route  sederhana
// Route::get('surat-masuk', function () {
//     return view('halaman Surat Masuk');
// });

// //route dengan parameter
// Route::get('surat-masuk/{id}', function ($id) {
//     return 'Detail Surat Masuk dengan ID:' .$id;
//     });
    
//     //name route
//     Route::get('/surat-masuk', function () {
//         return view('halaman Surat Masuk');
//         })->name('surat-masuk.index');
        
        
// Route::get('/surat-masuk/{id}', function ($id) {
//      return 'Detail Surat Masuk dengan ID:' .$id;
// })->name('surat-masuk.show');

// Route::get('/surat-masuk', [SuratMasukController::class, 'index'])->name('surat-masuk.index');
// Route::get('/surat-masuk/{id}', [SuratMasukController::class, 'show'])->name('surat-masuk.show');
