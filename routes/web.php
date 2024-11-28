<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PembelajaranController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::get('/pembelajaran/{kategori}', [PembelajaranController::class, 'index'])->name('pembelajaran.index');
Route::post('/pembelajaran/{kategori}/navigate', [PembelajaranController::class, 'navigate'])->name('pembelajaran.navigate');
Route::post('/pembelajaran/{kategori}/save', [PembelajaranController::class, 'save'])->name('pembelajaran.save');
