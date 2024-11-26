<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PembelajaranController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])
    ->name('index');
Route::get('/admin', [AdminController::class, 'index'])
    ->name('admin');

Route::prefix('/pembelajaran')
    ->group(function () {
        /* main */
        Route::get('/classical', [PembelajaranController::class, 'classical'])
            ->name('pembelajaran.classical');
        Route::get('/kelompok', [PembelajaranController::class, 'kelompok'])
            ->name('pembelajaran.kelompok');
        Route::get('/mandiri', [PembelajaranController::class, 'mandiri'])
            ->name('pembelajaran.mandiri');

        /* navigate */
        Route::post('/classical_navigate', [PembelajaranController::class, 'classical_navigate'])
            ->name('pembelajaran.classical_navigate');
        Route::post('/kelompok_navigate', [PembelajaranController::class, 'kelompok_navigate'])
            ->name('pembelajaran.kelompok_navigate');
        Route::post('/mandiri_navigate', [PembelajaranController::class, 'mandiri_navigate'])
            ->name('pembelajaran.mandiri_navigate');

        /* saves */
        Route::post('/classical_save', [PembelajaranController::class, 'classical_save'])
            ->name('pembelajaran.classical_save');
        Route::post('/kelompok_save', [PembelajaranController::class, 'kelompok_save'])
            ->name('pembelajaran.kelompok_save');
        Route::post('/mandiri_save', [PembelajaranController::class, 'mandiri_save'])
            ->name('pembelajaran.mandiri_save');
    });
