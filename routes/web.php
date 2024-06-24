<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SuplierController;
use App\Http\Controllers\JenisBarangController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\RiwayatBarangMasukController;
use App\Http\Controllers\RiwayatBarangKeluarController;

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

// Route untuk login
Route::get('/login', [AuthController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [AuthController::class, 'store'])->middleware('guest');

// Route untuk logout
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

// Route untuk dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::get('/profile', [AuthController::class, 'profile'])->name('profile')->middleware('auth');
Route::get('/profile/{id}/edit', [AuthController::class, 'edit'])->name('profile.edit')->middleware('auth');
Route::put('/profile/{id}', [AuthController::class, 'update'])->name('profile.update')->middleware('auth');

Route::put('/profile/{id}/password', [AuthController::class, 'changePassword'])->name('profile.change-password')->middleware('auth');

// Route untuk lupa password
Route::get('/forgot-password', [ForgotPasswordController::class, 'forgotPassword'])->name('forgot-password');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('send-reset-link-email');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'resetPassword'])->name('reset-password');
Route::post('/reset-password-process', [ForgotPasswordController::class, 'updatePassword'])->name('reset-password-process');

// Route untuk suplier
Route::get('/suplier', [SuplierController::class, 'index'])->name('suplier.index')->middleware('auth');
Route::get('/suplier/create', [SuplierController::class, 'create'])->name('suplier.create')->middleware('auth');
Route::post('/suplier', [SuplierController::class, 'store'])->name('suplier.store')->middleware('auth');
Route::get('/suplier/{id}/edit', [SuplierController::class, 'edit'])->name('suplier.edit')->middleware('auth');
Route::put('/suplier/{id}', [SuplierController::class, 'update'])->name('suplier.update')->middleware('auth');
Route::delete('/suplier/{id}', [SuplierController::class, 'destroy'])->name('suplier.destroy')->middleware('auth');

// Route untuk jenis barang
Route::get('/jenis-barang', [JenisBarangController::class, 'index'])->name('jenis-barang.index')->middleware('auth');
Route::get('/jenis-barang/create', [JenisBarangController::class, 'create'])->name('jenis-barang.create')->middleware('auth');
Route::post('/jenis-barang', [JenisBarangController::class, 'store'])->name('jenis-barang.store')->middleware('auth');
Route::get('/jenis-barang/{id}/edit', [JenisBarangController::class, 'edit'])->name('jenis-barang.edit')->middleware('auth');
Route::put('/jenis-barang/{id}', [JenisBarangController::class, 'update'])->name('jenis-barang.update')->middleware('auth');
Route::delete('/jenis-barang/{id}', [JenisBarangController::class, 'destroy'])->name('jenis-barang.destroy')->middleware('auth');

// Route untuk barang
Route::get('barang', [BarangController::class, 'index'])->name('barang.index')->middleware('auth');
Route::get('barang/create', [BarangController::class, 'create'])->name('barang.create')->middleware('auth');
Route::post('barang', [BarangController::class, 'store'])->name('barang.store')->middleware('auth');
Route::get('barang/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit')->middleware('auth');
Route::put('barang/{id}', [BarangController::class, 'update'])->name('barang.update')->middleware('auth');
Route::delete('barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy')->middleware('auth');

// Route untuk barang masuk
Route::get('/barang-masuk', [BarangMasukController::class, 'index'])->name('barang-masuk.index')->middleware('auth');
Route::get('/barang-masuk/create', [BarangMasukController::class, 'create'])->name('barang-masuk.create')->middleware('auth');
Route::post('/barang-masuk', [BarangMasukController::class, 'store'])->name('barang-masuk.store')->middleware('auth');
Route::get('/barang-masuk/{id}/edit', [BarangMasukController::class, 'edit'])->name('barang-masuk.edit')->middleware('auth');
Route::put('/barang-masuk/{id}', [BarangMasukController::class, 'update'])->name('barang-masuk.update')->middleware('auth');
Route::delete('/barang-masuk/{id}', [BarangMasukController::class, 'destroy'])->name('barang-masuk.destroy')->middleware('auth');

// Route untuk barang keluar
Route::get('/barang-keluar', [BarangKeluarController::class, 'index'])->name('barang-keluar.index')->middleware('auth');
Route::get('/barang-keluar/create', [BarangKeluarController::class, 'create'])->name('barang-keluar.create')->middleware('auth');
Route::post('/barang-keluar', [BarangKeluarController::class, 'store'])->name('barang-keluar.store')->middleware('auth');
Route::get('/barang-keluar/{id}/edit', [BarangKeluarController::class, 'edit'])->name('barang-keluar.edit')->middleware('auth');
Route::put('/barang-keluar/{id}', [BarangKeluarController::class, 'update'])->name('barang-keluar.update')->middleware('auth');
Route::delete('/barang-keluar/{id}', [BarangKeluarController::class, 'destroy'])->name('barang-keluar.destroy')->middleware('auth');

// Route untuk riwayat barang masuk
Route::get('riwayat-masuk', [RiwayatBarangMasukController::class, 'index'])->name('riwayat-masuk.index')->middleware('auth');
Route::get('riwayat-masuk/cetak-pdf', [RiwayatBarangMasukController::class, 'cetakPdf'])->name('riwayat-masuk.cetak-pdf')->middleware('auth');
Route::get('riwayat-masuk/cetak-excel', [RiwayatBarangMasukController::class, 'cetakExcel'])->name('riwayat-masuk.cetak-excel')->middleware('auth');

// Route untuk riwayat barang keluar
Route::get('riwayat-keluar', [RiwayatBarangKeluarController::class, 'index'])->name('riwayat-keluar.index')->middleware('auth');
Route::get('riwayat-keluar/cetak-pdf', [RiwayatBarangKeluarController::class, 'cetakPdf'])->name('riwayat-keluar.cetak-pdf')->middleware('auth');
Route::get('riwayat-keluar/cetak-excel', [RiwayatBarangKeluarController::class, 'cetakExcel'])->name('riwayat-keluar.cetak-excel')->middleware('auth');

