<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Psikiater;
use App\Models\PesanKonsultasiPsikiater;
use App\Models\RincianKonsultasiPsikiater;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class BookingPsikiaterController extends Controller
{
    /**
     * Mengambil semua slot yang tersedia untuk seorang psikiater.
     * Endpoint: GET /api/psikiater/{psikiater}/slots
     */
    public function getAvailableSlots(Psikiater $psikiater)
    {
        // Ambil slot yang tanggalnya hari ini atau setelahnya
        $slots = $psikiater->slotKonsultasi()
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
            'psikiater_id' => 'required|exists:psikiater,id',
            'slot_psikiater_jam_id' => 'required|exists:slot_konsultasi_psikiater_jam,id',
        ]);

        $user = Auth::user();
        $slotJamId = $request->slot_psikiater_jam_id;

        // Gunakan transaksi database untuk memastikan keamanan data
        return DB::transaction(function () use ($user, $request, $slotJamId) {
            // Kunci baris rincian slot untuk mencegah race condition
            // Pastikan nama kolom di sini juga benar
            $rincian = RincianKonsultasiPsikiater::where('slot_konsultasi_psikiater_jam_id', $slotJamId)
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
            $booking = PesanKonsultasiPsikiater::create([
                'user_id' => $user->id,
                'psikiater_id' => $request->psikiater_id,
                'slot_psikiater_jam_id' => $slotJamId,
                'status' => 'pending',
            ]);

            return response()->json([
                'message' => 'Booking berhasil dibuat! Menunggu persetujuan psikiater.',
                'booking' => $booking,
            ], 201);
        });
    }
}
