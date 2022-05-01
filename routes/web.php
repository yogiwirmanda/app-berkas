<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home_main');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/pasien/index', [App\Http\Controllers\PasienController::class, 'index'])->name('pasien_index');
Route::get('/pasien/create', [App\Http\Controllers\PasienController::class, 'create'])->name('pasien_create');
Route::get('/pasien/create/{id}', [App\Http\Controllers\PasienController::class, 'create'])->name('pasien_create_edit');
Route::post('/pasien/save', [App\Http\Controllers\PasienController::class, 'store'])->name('pasien_save');
Route::post('/pasien/update', [App\Http\Controllers\PasienController::class, 'update'])->name('pasien_update');
Route::get('/pasien/destroy/{id}', [App\Http\Controllers\PasienController::class, 'destroy'])->name('pasien_destroy');
Route::get('/dokter/index', [App\Http\Controllers\DokterController::class, 'index'])->name('dokter_index');
Route::get('/dokter/create', [App\Http\Controllers\DokterController::class, 'create'])->name('dokter_create');
Route::get('/dokter/create/{id}', [App\Http\Controllers\DokterController::class, 'create'])->name('dokter_create_edit');
Route::post('/dokter/save', [App\Http\Controllers\DokterController::class, 'store'])->name('dokter_save');
Route::post('/dokter/update', [App\Http\Controllers\DokterController::class, 'update'])->name('dokter_update');
Route::get('/dokter/destroy/{id}', [App\Http\Controllers\DokterController::class, 'destroy'])->name('dokter_destroy');
Route::get('/ruangan/index', [App\Http\Controllers\RuanganController::class, 'index'])->name('ruangan_index');
Route::get('/ruangan/create', [App\Http\Controllers\RuanganController::class, 'create'])->name('ruangan_create');
Route::get('/ruangan/create/{id}', [App\Http\Controllers\RuanganController::class, 'create'])->name('ruangan_create_edit');
Route::post('/ruangan/save', [App\Http\Controllers\RuanganController::class, 'store'])->name('ruangan_save');
Route::post('/ruangan/update', [App\Http\Controllers\RuanganController::class, 'update'])->name('ruangan_update');
Route::get('/ruangan/destroy/{id}', [App\Http\Controllers\RuanganController::class, 'destroy'])->name('ruangan_destroy');
Route::get('/berkas/index', [App\Http\Controllers\BerkasController::class, 'index'])->name('berkas_index');
Route::get('/berkas/create', [App\Http\Controllers\BerkasController::class, 'create'])->name('berkas_create');
Route::get('/berkas/create/{id}', [App\Http\Controllers\BerkasController::class, 'create'])->name('berkas_create_edit');
Route::post('/berkas/save', [App\Http\Controllers\BerkasController::class, 'store'])->name('berkas_save');
Route::post('/berkas/update', [App\Http\Controllers\BerkasController::class, 'update'])->name('berkas_update');
Route::get('/berkas/destroy/{id}', [App\Http\Controllers\BerkasController::class, 'destroy'])->name('berkas_destroy');
Route::get('/berkas/kembali/{id}', [App\Http\Controllers\BerkasController::class, 'kembali'])->name('berkas_kembali');
Route::get('/berkas/kembali', [App\Http\Controllers\BerkasController::class, 'kembali'])->name('berkas_kembali_get');
Route::get('/check/rm', [App\Http\Controllers\BerkasController::class, 'checkPasienRM'])->name('pasien_check');
Route::get('/laporan/24', [App\Http\Controllers\LaporanController::class, 'index'])->name('laporan_24_index');
Route::get('/laporan/ruangan', [App\Http\Controllers\LaporanController::class, 'ruangan'])->name('laporan_ruangan_index');
Route::get('/laporan/ruangan/{bulan}', [App\Http\Controllers\LaporanController::class, 'ruangan'])->name('laporan_ruangan_index_bulan');
Route::get('/laporan/berkas', [App\Http\Controllers\LaporanController::class, 'berkas'])->name('laporan_berkas_index');
Route::get('/laporan/berkas/{ruangan}/{month}', [App\Http\Controllers\LaporanController::class, 'berkas'])->name('laporan_berkas_index_filter');
