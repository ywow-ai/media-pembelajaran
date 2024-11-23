<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PembelajaranController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::prefix('pembelajaran')
    ->group(function () {
        Route::get('/classical', [PembelajaranController::class, 'classical'])->name('classical');
        Route::get('/kelompok', [PembelajaranController::class, 'kelompok'])->name('kelompok');
        Route::get('/mandiri', [PembelajaranController::class, 'mandiri'])->name('mandiri');
    })
    ->name('pembelajaran');
