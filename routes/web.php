<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard;
use App\Http\Controllers\Users;
use App\Http\Controllers\Produk;
use App\Http\Controllers\Laporan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/logout', [Users::class, 'logout'])->name('logout')->middleware('auth');


Route::middleware('auth')->group(function () {
    Route::get('/', [dashboard::class, 'index'])->name('dashboard.index');
    Route::get('/laporan', [Laporan::class, 'index'])->name('laporan.index');
    
    Route::prefix('produk')->name('produk.')->group(function () {
        Route::get('/', [Produk::class, 'index'])->name('index');
        Route::get('/create', [Produk::class, 'create'])->name('create');
        Route::post('/', [Produk::class, 'store'])->name('store');
        Route::get('/{id}/edit', [Produk::class, 'edit'])->name('edit');
        Route::put('/{id}', [Produk::class, 'update'])->name('update');
        Route::delete('/{id}', [Produk::class, 'destroy'])->name('destroy');
    });
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [Users::class, 'index'])->name('login.index');
    Route::post('/login', [Users::class, 'login'])->name('login');
});



