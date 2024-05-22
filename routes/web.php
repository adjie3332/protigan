<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\HargaKaretController;
use App\Http\Controllers\PanenController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\LaporanKeuanganController;
use App\Http\Controllers\ForgotPasswordController;

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


// Route untuk register
Route::get('/register', [AuthController::class, 'create'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');

// Route untuk dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/profile', [AuthController::class, 'profile'])->name('profile')->middleware('auth');
Route::get('/profile/{id}/edit', [AuthController::class, 'edit'])->name('profile.edit')->middleware('auth');
Route::put('/profile/{id}', [AuthController::class, 'update'])->name('profile.update')->middleware('auth');

Route::put('/profile/{id}/password', [AuthController::class, 'changePassword'])->name('profile.change-password')->middleware('auth');

// Route untuk lupa password
Route::get('/forgot-password', [ForgotPasswordController::class, 'forgotPassword'])->name('forgot-password');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('send-reset-link-email');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'resetPassword'])->name('reset-password');
Route::post('/reset-password-process', [ForgotPasswordController::class, 'updatePassword'])->name('reset-password-process');


// Route untuk karyawan
Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan.index')->middleware('auth');
Route::get('/karyawan/create', [KaryawanController::class, 'create'])->name('karyawan.create')->middleware('auth');
Route::post('/karyawan', [KaryawanController::class, 'store'])->name('karyawan.store')->middleware('auth');
Route::get('/karyawan/{id}/edit', [KaryawanController::class, 'edit'])->name('karyawan.edit')->middleware('auth');
Route::put('/karyawan/{id}', [KaryawanController::class, 'update'])->name('karyawan.update')->middleware('auth');
Route::delete('/karyawan/{id}', [KaryawanController::class, 'destroy'])->name('karyawan.destroy')->middleware('auth');

// Route untuk harga karet
Route::get('/harga', [HargaKaretController::class, 'index'])->name('harga.index')->middleware('auth');
Route::post('/harga', [HargaKaretController::class, 'store'])->name('harga.store')->middleware('auth');
Route::get('/harga/{id}/edit', [HargaKaretController::class, 'edit'])->name('harga.edit')->middleware('auth');
Route::put('/harga/{id}', [HargaKaretController::class, 'update'])->name('harga.update')->middleware('auth');
Route::delete('/harga/{id}', [HargaKaretController::class, 'destroy'])->name('harga.destroy')->middleware('auth');

// Route untuk panen
Route::get('/panen', [PanenController::class, 'index'])->name('panen.index')->middleware('auth');
Route::get('/panen/create', [PanenController::class, 'create'])->name('panen.create')->middleware('auth');
Route::post('/panen', [PanenController::class, 'store'])->name('panen.store')->middleware('auth');
Route::get('/panen/{id}/edit', [PanenController::class, 'edit'])->name('panen.edit')->middleware('auth');
Route::put('/panen/{id}', [PanenController::class, 'update'])->name('panen.update')->middleware('auth');
Route::delete('/panen/{id}', [PanenController::class, 'destroy'])->name('panen.destroy')->middleware('auth');

// Route untuk gaji
Route::get('/gaji', [GajiController::class, 'index'])->name('gaji.index')->middleware('auth');
Route::get('/gaji/{id}', [GajiController::class, 'show'])->name('gaji.show')->middleware('auth');   
Route::get('/gaji/create', [GajiController::class, 'create'])->name('gaji.create')->middleware('auth');
Route::post('/gaji', [GajiController::class, 'store'])->name('gaji.store')->middleware('auth');
Route::get('/gaji/{id}/edit', [GajiController::class, 'edit'])->name('gaji.edit')->middleware('auth');
Route::put('/gaji/{id}', [GajiController::class, 'update'])->name('gaji.update')->middleware('auth');
Route::delete('/gaji/{id}', [GajiController::class, 'destroy'])->name('gaji.destroy')->middleware('auth');
Route::get('/gaji/slip/{id}', [GajiController::class, 'slip'])->name('gaji.slip')->middleware('auth');

// Route untuk cuti
Route::get('/cuti', [CutiController::class, 'index'])->name('cuti.index')->middleware('auth');
Route::get('/cuti/create', [CutiController::class, 'create'])->name('cuti.create')->middleware('auth');
Route::post('/cuti', [CutiController::class, 'store'])->name('cuti.store')->middleware('auth');
Route::get('/cuti/{id}/edit', [CutiController::class, 'edit'])->name('cuti.edit')->middleware('auth');
Route::put('/cuti/{id}', [CutiController::class, 'update'])->name('cuti.update')->middleware('auth');
Route::put('/cuti/{id}/update-status', [CutiController::class, 'updateStatus'])->name('cuti.update-status')->middleware('auth');
Route::delete('/cuti/{id}', [CutiController::class, 'destroy'])->name('cuti.destroy')->middleware('auth');
Route::get('/cuti/cetak', [CutiController::class, 'cetakPdf'])->name('cuti.cetak')->middleware('auth');

// Route untuk inventory
Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index')->middleware('auth');
Route::get('/barang-masuk', [InventoryController::class, 'InventoryMasuk'])->name('inventory.masuk')->middleware('auth');
Route::get('/barang-keluar', [InventoryController::class, 'InventoryKeluar'])->name('inventory.keluar')->middleware('auth');
Route::get('/inventory/create', [InventoryController::class, 'create'])->name('inventory.create')->middleware('auth');
Route::post('/inventory', [InventoryController::class, 'store'])->name('inventory.store')->middleware('auth');
Route::post('/barang-masuk', [InventoryController::class, 'storeMasuk'])->name('inventory.store-masuk')->middleware('auth');
Route::post('/barang-keluar', [InventoryController::class, 'storeKeluar'])->name('inventory.store-keluar')->middleware('auth');
Route::get('/inventory/{id}/edit', [InventoryController::class, 'edit'])->name('inventory.edit')->middleware('auth');
Route::get('/inventory-masuk/{id}/edit', [InventoryController::class, 'editMasuk'])->name('inventory.edit-masuk')->middleware('auth');
Route::get('/inventory-keluar/{id}/edit', [InventoryController::class, 'editKeluar'])->name('inventory.edit-keluar')->middleware('auth');
Route::put('/inventory-masuk/{id}', [InventoryController::class, 'updateMasuk'])->name('inventory.update-masuk')->middleware('auth');
Route::put('/inventory-keluar/{id}', [InventoryController::class, 'updateKeluar'])->name('inventory.update-keluar')->middleware('auth');
Route::put('/inventory/{id}', [InventoryController::class, 'update'])->name('inventory.update')->middleware('auth');
Route::delete('/inventory-masuk/{id}', [InventoryController::class, 'destroyMasuk'])->name('inventory-masuk.destroy')->middleware('auth');
Route::delete('/inventory-keluar/{id}', [InventoryController::class, 'destroyKeluar'])->name('inventory-keluar.destroy')->middleware('auth');
Route::delete('/inventory/{id}', [InventoryController::class, 'destroy'])->name('inventory.destroy')->middleware('auth');

// Route untuk laporan Keuangan
Route::get('/laporan-keuangan', [LaporanKeuanganController::class, 'index'])->name('laporan-keuangan')->middleware('auth');
Route::get('/laporan-keuangan/cetak', [LaporanKeuanganController::class, 'cetak'])->name('laporan-keuangan.cetak')->middleware('auth');
