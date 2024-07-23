<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KeuanganMasukController;
use App\Http\Controllers\KeuanganKeluarController;
use App\Http\Controllers\MasterBerasController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\BerasMasukController;
use App\Http\Controllers\BerasKeluarController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;

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
Route::get('/', [AuthController::class, 'index']);

Route::get('/login', [AuthController::class, 'formLogin'])->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth'])->group(function () 
{

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('home');
    });

    Route::prefix('data-keuangan-masuk')->group(function () {
        Route::get('/', [KeuanganMasukController::class, 'index'])->name('home-keuangan-masuk');
        Route::get('/data', [KeuanganMasukController::class, 'data'])->name('data-keuangan-masuk');
        Route::get('/kode', [KeuanganMasukController::class, 'kode'])->name('kode_masuk');
        Route::get('/create', [KeuanganMasukController::class, 'create'])->name('create-keuangan-masuk');
        Route::post('/store', [KeuanganMasukController::class, 'store'])->name('store-keuangan-masuk');
        Route::get('/download-pdf/{id}', [KeuanganMasukController::class, 'downloadpdf']);
        Route::get('/download-excel', [KeuanganMasukController::class, 'downloadexcel'])->name('excel');
        Route::get('/download-pdff', [KeuanganMasukController::class, 'downloadpdff'])->name('pdf');
    });

    Route::prefix('data-keuangan-keluar')->group(function () {
        Route::get('/', [KeuanganKeluarController::class, 'index'])->name('home-keuangan-keluar');
        Route::get('/data', [KeuanganKeluarController::class, 'data'])->name('data-keuangan-keluar');
        Route::get('/kode', [KeuanganKeluarController::class, 'kode'])->name('kode_keluar');
        Route::get('/create', [KeuanganKeluarController::class, 'create'])->name('create-keuangan-keluar');
        Route::post('/store', [KeuanganKeluarController::class, 'store'])->name('store-keuangan-keluar');
        Route::get('/download-excel', [KeuanganKeluarController::class, 'downloadexcel'])->name('excel-keluar');
        Route::get('/download-pdf', [KeuanganKeluarController::class, 'downloadpdf'])->name('pdf-keluar');
        Route::get('/show-photo/{id}', [KeuanganKeluarController::class, 'showPhoto'])->name('photo.view');
    });

    Route::prefix('data-stok-beras')->group(function () {
        Route::get('/', [MasterBerasController::class, 'index'])->name('home-stok-beras');
        Route::get('/create', [MasterBerasController::class, 'create'])->name('create-stok-beras');
        Route::post('/store', [MasterBerasController::class, 'store'])->name('store-stok-beras');
        Route::get('/edit/{id}', [MasterBerasController::class, 'edit'])->name('edit-stok-beras');
        Route::post('/update', [MasterBerasController::class, 'update'])->name('update-stok-beras');
        Route::delete('/delete/{id}', [MasterBerasController::class, 'delete'])->name('delete-stok-beras');
    });

    Route::prefix('setting')->group(function () {
        Route::get('/', [SettingController::class, 'index'])->name('setting');
        Route::post('/update', [SettingController::class, 'update'])->name('update-setting');
    });
});