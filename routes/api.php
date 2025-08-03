<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ChatController;
use App\Http\Controllers\Api\TipsController;
use App\Http\Controllers\Api\ArtikelController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\KonselorController;
use App\Http\Controllers\Api\InformasiController;
use App\Http\Controllers\Api\PsikiaterController;
use App\Http\Controllers\Api\TestResultController;
use App\Http\Controllers\Api\KonselorAuthController;
use App\Http\Controllers\Api\TestInstrumentController;
use App\Http\Controllers\Api\BookingKonselorController;
use App\Http\Controllers\Api\BookingPsikiaterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Endpoint publik untuk register dan login
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/login/konselor', [KonselorAuthController::class, 'login']);

Route::get('/tips', [TipsController::class, 'index']);
Route::get('/tips/{id}', [TipsController::class, 'show']);

Route::get('/informasi', [InformasiController::class, 'index']);

Route::get('/artikel', [ArtikelController::class, 'index']);
Route::get('/artikel/{artikel}', [ArtikelController::class, 'show']);

// Endpoint untuk konselor
Route::get('/konselor', [KonselorController::class, 'index']);
Route::get('/konselor/{konselor}/slots', [BookingKonselorController::class, 'getAvailableSlots']);

// Endpoint untuk psikiater
Route::get('/psikiater', [PsikiaterController::class, 'index']);
Route::get('/psikiater/{psikiater}/slots', [BookingPsikiaterController::class, 'getAvailableSlots']);

// tes instrumen
Route::get('/tests', [TestInstrumentController::class, 'index']);
Route::get('/tests/{id}', [TestInstrumentController::class, 'show']);
// Endpoint yang dilindungi oleh autentikasi Sanctum
Route::middleware('auth:sanctum')->group(function () {
    // Endpoint untuk logout
    Route::post('/logout', [AuthController::class, 'logout']);

    // Contoh endpoint yang hanya bisa diakses setelah login
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/profile', [ProfileController::class, 'show']);
    Route::post('/profile', [ProfileController::class, 'update']);

    // booking konselor
    Route::post('/bookings-konselor', [BookingKonselorController::class, 'createBooking']);
    // booking psikiater
    Route::post('/bookings-psikiater', [BookingPsikiaterController::class, 'createBooking']);

    // tes hasil
    Route::post('/tests/{id}/submit', [TestResultController::class, 'store']);
    // histori hasil tes
    Route::get('/test/history', [TestResultController::class, 'history']);

    // Routes untuk Chat
    Route::get('/consultations', [ChatController::class, 'index']);
    Route::get('/consultations/{id}/messages', [ChatController::class, 'show']);
    Route::post('/consultations/{id}/messages', [ChatController::class, 'store']);
});

// BUAT GRUP BARU UNTUK KONSELOR
// Route::middleware('auth:sanctum:konselor-api')->group(function () {
Route::get('/konselor/consultations', [ChatController::class, 'getKonselorConsultations']);
Route::post('/konselor/consultations/{id}/messages', [ChatController::class, 'storeKonselorMessage']);
Route::get('/konselor/consultations/{id}/messages', [ChatController::class, 'showForKonselor']);
// });
