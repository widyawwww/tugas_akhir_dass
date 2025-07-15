<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WEB\Admin\TipsController;
use App\Http\Controllers\WEB\Auth\LoginController;
use App\Http\Controllers\WEB\Auth\LogoutController;
use App\Http\Controllers\WEB\Admin\ArtikelController;
use App\Http\Controllers\WEB\Admin\AturJamController;
use App\Http\Controllers\WEB\Auth\RegisterController;
use App\Http\Controllers\WEB\Admin\DashboardController;
use App\Http\Controllers\WEB\Admin\InstrumenTesController;

use App\Http\Controllers\WEB\Admin\DaftarPenggunaController;
use App\Http\Controllers\WEB\Admin\JadwalKonselorController;
use App\Http\Controllers\WEB\Admin\JadwalPsikiaterController;
use App\Http\Controllers\WEB\Admin\PemesananKonselorController;
use App\Http\Controllers\WEB\Admin\PemesananPsikiaterController;
use App\Http\Controllers\WEB\Admin\PemesananDaftarPenggunaController;

// ----------------------------
// Redirect / ke login admin
// ----------------------------
Route::get('/', function () {
    return redirect()->route('admin.login');
});

// ----------------------------
// Route Login / Register Admin
// ----------------------------
// Login
Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'login'])->name('admin.login.submit');

// Register
Route::get('/admin/register', [RegisterController::class, 'showRegisterForm'])->name('admin.register');
Route::post('/admin/register', [RegisterController::class, 'register'])->name('admin.register.submit');

// Logout
Route::post('/admin/logout', [LogoutController::class, 'logout'])->name('admin.logout');

// ----------------------------
// Group route khusus admin (butuh login)
// ----------------------------
Route::prefix('admin')->name('admin.')->middleware('auth.admin')->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Artikel
    Route::resource('artikel', ArtikelController::class)->only(['index', 'store', 'update', 'destroy', 'show']);

    // Tips
    Route::resource('tips', TipsController::class);

    // Atur Jam Konsultasi
    Route::get('/atur-jam', [AturJamController::class, 'index'])->name('atur-jam.index');
    Route::post('/atur-jam', [AturJamController::class, 'store'])->name('atur-jam.store');
    Route::put('/atur-jam/{id}', [AturJamController::class, 'update'])->name('atur-jam.update');
    Route::delete('/atur-jam/{id}', [AturJamController::class, 'destroy'])->name('atur-jam.destroy');

    // Atur Jadwal Konselor
    Route::get('/jadwal-konselor', [JadwalKonselorController::class, 'index'])->name('jadwal-konselor.index');
    Route::post('/jadwal-konselor', [JadwalKonselorController::class, 'store'])->name('jadwal-konselor.store');
    Route::put('/jadwal-konselor/{id}', [JadwalKonselorController::class, 'update'])->name('jadwal-konselor.update');
    Route::delete('/jadwal-konselor/{id}', [JadwalKonselorController::class, 'destroy'])->name('jadwal-konselor.destroy');

    //Atur Jadwal Psikiater
    Route::resource('jadwal-psikiater', JadwalPsikiaterController::class)->only([
        'index', 'store', 'update', 'destroy'
    ]);

    // Instrumen Tes Psikologi
    Route::get('/instrumen-tes', [InstrumenTesController::class, 'index'])->name('instrumen-tes.index');
    Route::post('/instrumen-tes', [InstrumenTesController::class, 'store'])->name('instrumen-tes.store');
    Route::delete('/instrumen-tes/{id}', [InstrumenTesController::class, 'destroy'])->name('instrumen-tes.destroy');

    // Pertanyaan
    Route::get('/instrumen-tes/{id}/pertanyaan', [InstrumenTesController::class, 'lihatPertanyaan'])->name('instrumen-tes.pertanyaan');
    Route::post('instrumen-tes/pertanyaan/store', [InstrumenTesController::class, 'storePertanyaan'])->name('instrumen-tes.pertanyaan.store');
    Route::put('/instrumen-tes/pertanyaan/update/{id}', [InstrumenTesController::class, 'updatePertanyaan'])
    ->name('instrumen-tes.pertanyaan.update');
    Route::delete('/instrumen-tes/pertanyaan/{id}', [InstrumenTesController::class, 'destroyPertanyaan'])
        ->name('instrumen-tes.pertanyaan.destroy');

    // Opsi Jawaban
    Route::get('/instrumen-tes/{id}/opsi-jawaban', [InstrumenTesController::class, 'lihatOpsi'])->name('instrumen-tes.opsi');
    Route::post('/instrumen-tes/opsi-jawaban/store', [InstrumenTesController::class, 'storeOpsi'])->name('instrumen-tes.opsi.store');
    Route::put('/instrumen-tes/opsi-jawaban/update/{id}', [InstrumenTesController::class, 'updateOpsi'])->name('instrumen-tes.opsi.update');
    Route::delete('/instrumen-tes/opsi-jawaban/{id}', [InstrumenTesController::class, 'destroyOpsi'])->name('instrumen-tes.opsi.destroy');

    // Subskala
    Route::get('/instrumen-tes/{id}/subskala', [InstrumenTesController::class, 'lihatSubskala'])->name('instrumen-tes.subskala');
    Route::post('/instrumen-tes/subskala/store', [InstrumenTesController::class, 'storeSubskala'])->name('instrumen-tes.subskala.store');
    Route::put('/instrumen-tes/subskala/update/{id}', [InstrumenTesController::class, 'updateSubskala'])->name('instrumen-tes.subskala.update');
    Route::delete('/instrumen-tes/subskala/{id}', [InstrumenTesController::class, 'destroySubskala'])->name('instrumen-tes.subskala.destroy');

    // Pemesanan Konselor
    Route::get('admin/pemesanan-konselor', [PemesananKonselorController::class, 'index'])->name('pemesanan-konselor.index');

    // Pemesanan Psikiater
    Route::get('/pemesanan-psikiater', [PemesananPsikiaterController::class, 'index'])->name('pemesanan-psikiater.index');

    // Daftar Pengguna berdasarkan role
    Route::get('pengguna/admin', [DaftarPenggunaController::class, 'admin'])->name('daftar-pengguna.admin');
    Route::post('pengguna/admin', [DaftarPenggunaController::class, 'storeAdmin'])->name('users.admin.store');
    Route::put('pengguna/admin/{id}', [DaftarPenggunaController::class, 'updateAdmin'])->name('users.admin.update');
    Route::delete('pengguna/admin/{id}', [DaftarPenggunaController::class, 'destroyAdmin'])->name('users.admin.destroy');

    Route::get('pengguna/psikiater', [DaftarPenggunaController::class, 'psikiater'])->name('daftar-pengguna.psikiater');
    Route::post('pengguna/psikiater', [DaftarPenggunaController::class, 'storePsikiater'])->name('users.psikiater.store');
    Route::put('pengguna/psikiater/{id}', [DaftarPenggunaController::class, 'updatePsikiater'])->name('users.psikiater.update');
    Route::delete('pengguna/psikiater/{id}', [DaftarPenggunaController::class, 'destroyPsikiater'])->name('users.psikiater.destroy');

    Route::get('pengguna/konselor', [DaftarPenggunaController::class, 'konselor'])->name('daftar-pengguna.konselor');
    Route::post('pengguna/konselor', [DaftarPenggunaController::class, 'storeKonselor'])->name('users.konselor.store');
    Route::put('pengguna/konselor/{id}', [DaftarPenggunaController::class, 'updateKonselor'])->name('users.konselor.update');
    Route::delete('pengguna/konselor/{id}', [DaftarPenggunaController::class, 'destroyKonselor'])->name('users.konselor.destroy');

    Route::get('pengguna/pengguna', [DaftarPenggunaController::class, 'pengguna'])->name('daftar-pengguna.pengguna');
    Route::post('pengguna/pengguna', [DaftarPenggunaController::class, 'storePengguna'])->name('users.pengguna.store');
    Route::put('pengguna/pengguna/{id}', [DaftarPenggunaController::class, 'updatePengguna'])->name('users.pengguna.update');
    Route::delete('pengguna/pengguna/{id}', [DaftarPenggunaController::class, 'destroyPengguna'])->name('users.pengguna.destroy');

});
