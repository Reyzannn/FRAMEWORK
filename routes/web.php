<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard;
use App\Http\Controllers\Users;
use App\Http\Controllers\Produk;
use App\Http\Controllers\Laporan;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\StockController;

Route::get('/logout', [Users::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/', [dashboard::class, 'index'])->name('dashboard.index');
    Route::get('/laporan', [Laporan::class, 'index'])->name('laporan.index');
    Route::get('/cetak-stok-pdf', [PdfController::class, 'cetakStok'])->name('cetak.stok.pdf');
    Route::post('/laporan/proses', [PdfController::class, 'proses'])->name('laporan.proses');



    Route::prefix('produk')->name('produk.')->group(function () {
        Route::get('/', [Produk::class, 'index'])->name('index');
        Route::get('/create', [Produk::class, 'create'])->name('create');
        Route::post('/', [Produk::class, 'store'])->name('store');
        Route::get('/{id}/edit', [Produk::class, 'edit'])->name('edit');
        Route::put('/{id}', [Produk::class, 'update'])->name('update');
        Route::delete('/{id}', [Produk::class, 'destroy'])->name('destroy');
    });

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [Users::class, 'table'])->name('index');
        Route::get('/create', [Users::class, 'create'])->name('create');
        Route::post('/', [Users::class, 'store'])->name('store');
        Route::get('/{id}/edit', [Users::class, 'edit'])->name('edit');
        Route::put('/{id}', [Users::class, 'update'])->name('update');
        Route::delete('/{id}', [Users::class, 'destroy'])->name('destroy');
    });
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [Users::class, 'index'])->name('login.index');
    Route::post('/login', [Users::class, 'login'])->name('login');
});

Route::prefix('stock')->name('stock.')->group(function () {
    // Barang Masuk
    Route::get('masuk', [StockController::class, 'masuk'])->name('masuk');
    Route::get('masuk/tambah', [StockController::class, 'createMasuk'])->name('masuk.create');
    Route::post('masuk', [StockController::class, 'storeMasuk'])->name('masuk.store');

    // Barang Keluar
    Route::get('keluar', [StockController::class, 'keluar'])->name('keluar');
    Route::get('keluar/tambah', [StockController::class, 'createKeluar'])->name('keluar.create');
    Route::post('keluar', [StockController::class, 'storeKeluar'])->name('keluar.store');

      Route::post('restore/{id}', [StockController::class, 'restore'])->name('restore');
});
