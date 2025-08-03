<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Konselor;
use App\Models\PesanKonsultasiKonselor;
use App\Models\RincianKonsultasiKonselor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class BookingKonselorController extends Controller
{
    /**
     * Mengambil semua slot yang tersedia untuk seorang konselor.
     * Endpoint: GET /api/konselor/{konselor}/slots
     */
    public function getAvailableSlots(Konselor $konselor)
    {
        // Ambil slot yang tanggalnya hari ini atau setelahnya
        $slots = $konselor->slotKonsultasi()
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
        $request->validate([
            'konselor_id' => 'required|exists:konselor,id',
            'slot_konsultasi_konselor_jam_id' => 'required|exists:slot_konsultasi_konselor_jam,id',
        ]);

        $user = Auth::user();
        $slotJamId = $request->slot_konsultasi_konselor_jam_id;

        // Gunakan transaksi database untuk memastikan keamanan data
        return DB::transaction(function () use ($user, $request, $slotJamId) {
            // Kunci baris rincian slot untuk mencegah race condition
            $rincian = RincianKonsultasiKonselor::where('slot_konsultasi_konselor_jam_id', $slotJamId)
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
            $booking = PesanKonsultasiKonselor::create([
                'user_id' => $user->id,
                'konselor_id' => $request->konselor_id,
                'slot_konsultasi_konselor_jam_id' => $slotJamId,
                'status' => 'pending',
            ]);

            return response()->json([
                'message' => 'Booking berhasil dibuat! Menunggu persetujuan konselor.',
                'booking' => $booking,
            ], 201);
        });
    }
}
