<?php

use App\Http\Controllers\DaftarPoliController;
use App\Http\Controllers\Dokter\JadwalPeriksaController;
use App\Http\Controllers\Dokter\PeriksaPasienController;
use App\Http\Controllers\Dokter\RiwayatPasienController;
use App\Http\Controllers\Pasien\RegisterController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// admin
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => ['role:Admin']], function () {
    Route::name('master.')->prefix('master')->group(function ($router) {
        Route::resource('obat', App\Http\Controllers\Master\ObatController::class)->except(['show']);
        Route::resource('poli', App\Http\Controllers\Master\PoliController::class)->except(['show']);
        Route::resource('dokter', App\Http\Controllers\Master\DokterController::class)->except(['show']);
        Route::resource('pasien', App\Http\Controllers\Master\PasienController::class)->except(['show']);
    });
});

Route::group(['middleware' => ['role:Pasien']], function () {
    Route::resource('daftar-poli', DaftarPoliController::class)->except(['show']);
    Route::post('get-jadwal', [DaftarPoliController::class, 'getJadwal'])->name('get-jadwal');
});

Route::group(['middleware' => ['role:Dokter']], function () {
    Route::resource('jadwal-periksa', JadwalPeriksaController::class)->except(['show']);
    Route::resource('periksa-pasien', PeriksaPasienController::class)->except(['destroy']);
    Route::get('periksa-pasien/periksa/{id}', [PeriksaPasienController::class, 'periksa'])->name('periksa-pasien.periksa');
    Route::post('periksa-pasien/periksa/{id}', [PeriksaPasienController::class, 'postPeriksa'])->name('periksa-pasien.periksa');
    Route::get('riwayat-pasien', [RiwayatPasienController::class, 'index'])->name('riwayat-pasien.index');
    Route::get('riwayat-pasien/{id}', [RiwayatPasienController::class, 'show'])->name('riwayat-pasien.show');
});

Route::post('register-pasien', [RegisterController::class, 'register'])->name('pasien.register');

require __DIR__.'/auth.php';
