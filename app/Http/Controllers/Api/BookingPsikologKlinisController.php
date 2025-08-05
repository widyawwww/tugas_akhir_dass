<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PsikologKlinis;
use App\Models\PesanKonsultasiPsikologKlinis;
use App\Models\RincianKonsultasiPsikologKlinis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class BookingPsikologKlinisController extends Controller
{
    /**
     * Mengambil semua slot yang tersedia untuk seorang psikolog klinis.
     * Endpoint: GET /api/psikolog-klinis/{psikolog_klinis}/slots
     */
    public function getAvailableSlots(PsikologKlinis $psikologklinis)
    {
        // Ambil slot yang tanggalnya hari ini atau setelahnya
        $slots = $psikologklinis->slotKonsultasi()
            ->where('tanggal', '>=', now()->format('Y-m-d'))
            ->with(['jamSlots.jam', 'jamSlots.rincian' => function ($query) {
                // Hanya ambil rincian yang slotnya masih tersisa
                $query->where('slot_tersisa', '>', 0);
            }])
            ->get();

        return response()->json($slots);
    }

    /**
     * Membuat booking baru.
     * Endpoint: POST /api/bookings
     */
    public function createBooking(Request $request)
    {
        // --- PERBAIKAN DI SINI ---
        // Sesuaikan nama tabel di dalam aturan 'exists'
        $request->validate([
            'psikolog_klinis_id' => 'required|exists:psikolog_klinis,id',
            'slot_psikolog_klinis_jam_id' => 'required|exists:slot_konsultasi_psikolog_klinis_jam,id',
        ]);

        $user = Auth::user();
        $slotJamId = $request->slot_psikolog_klinis_jam_id;

        // Gunakan transaksi database untuk memastikan keamanan data
        return DB::transaction(function () use ($user, $request, $slotJamId) {
            // Kunci baris rincian slot untuk mencegah race condition
            // Pastikan nama kolom di sini juga benar
            $rincian = RincianKonsultasiPsikologKlinis::where('slot_konsultasi_psikolog_klinis_jam_id', $slotJamId)
                ->lockForUpdate()
                ->first();

            // Cek jika slot masih tersedia
            if (!$rincian || $rincian->slot_tersisa <= 0) {
                throw ValidationException::withMessages([
                    'slot' => 'Maaf, slot untuk jadwal ini sudah habis.'
                ]);
            }

            // Kurangi slot yang tersisa
            $rincian->slot_tersisa -= 1;
            $rincian->save();

            // Buat data pemesanan baru
            $booking = PesanKonsultasiPsikologKlinis::create([
                'user_id' => $user->id,
                'psikolog_klinis_id' => $request->psikolog_klinis_id,
                'slot_psikolog_klinis_jam_id' => $slotJamId,
                'status' => 'pending',
            ]);

            return response()->json([
                'message' => 'Booking berhasil dibuat! Menunggu persetujuan psikolog klinis.',
                'booking' => $booking,
            ], 201);
        });
    }
}
