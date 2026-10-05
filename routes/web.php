<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//route sederhana
Route::get('/surat-masuk', function () {
    return "Daftar Surat Masuk";
});

//route dengan parameter
Route::get('/surat-masuk', function () {
    return "Daftar Surat Masuk";
});