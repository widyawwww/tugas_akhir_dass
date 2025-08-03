<?php

namespace App\Http\Controllers\Api;

use App\Events\NewChatMessage;
use App\Http\Controllers\Controller;
use App\Models\PesanChat;
use App\Models\PesanKonsultasiKonselor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    // Mengambil daftar semua sesi konsultasi (aktif & riwayat)
    public function index()
    {
        $user = Auth::user();
        $consultations = PesanKonsultasiKonselor::where('user_id', $user->id)
            ->with('konselor:id,nama_lengkap,spesialisasi,gambar_url') // Ambil data konselor
            ->with('slotJam.jam', 'slotJam.slotKonsultasi') // Ambil data jadwal
            ->latest()
            ->get();
        return response()->json($consultations);
    }

    // Mengambil semua pesan dari satu sesi konsultasi
    public function show($consultationId)
    {
        $messages = PesanChat::where('pesan_konsultasi_konselor_id', $consultationId)
            ->orderBy('created_at', 'asc')
            ->get();
        return response()->json($messages);
    }

    public function showForKonselor($consultationId)
    {
        $konselor = Auth::guard('konselor-api')->user();
        $consultation = PesanKonsultasiKonselor::findOrFail($consultationId);

        if ($consultation->konselor_id !== $konselor->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $messages = PesanChat::where('pesan_konsultasi_konselor_id', $consultationId)
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($messages);
    }


    // Mengirim pesan baru
    public function store(Request $request, $consultationId)
    {
        $request->validate(['pesan' => 'required|string']);
        $user = Auth::user();

        // Verifikasi bahwa user adalah bagian dari konsultasi ini
        $consultation = PesanKonsultasiKonselor::findOrFail($consultationId);
        if ($consultation->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $message = PesanChat::create([
            'pesan_konsultasi_konselor_id' => $consultationId,
            'pengirim_id' => $user->id,
            'tipe_pengirim' => 'user',
            'pesan' => $request->pesan,
        ]);

        // Kirim event ke Pusher
        broadcast(new NewChatMessage($message))->toOthers();

        return response()->json($message, 201);
    }

    // untuk konselor
    public function getKonselorConsultations()
    {
        // Gunakan guard 'konselor-api' untuk mendapatkan konselor yang login
        $konselor = Auth::guard('konselor-api')->user();

        $consultations = PesanKonsultasiKonselor::where('konselor_id', $konselor->id)
            // Penting: Sekarang kita eager load data 'pengguna' (user)
            ->with(['pengguna:id,nama_lengkap,username,gambar_url', 'slotJam.jam', 'slotJam.slotKonsultasi'])
            ->latest()
            ->get();

        return response()->json($consultations);
    }
    // untuk konselor kirim pesan
    public function storeKonselorMessage(Request $request, $consultationId)
    {
        $request->validate(['pesan' => 'required|string']);
        $konselor = Auth::guard('konselor-api')->user();

        $consultation = PesanKonsultasiKonselor::findOrFail($consultationId);
        // Verifikasi bahwa konselor ini adalah bagian dari konsultasi
        if ($consultation->konselor_id !== $konselor->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $message = PesanChat::create([
            'pesan_konsultasi_konselor_id' => $consultationId,
            'pengirim_id' => $konselor->id,
            'tipe_pengirim' => 'konselor', // <-- Tipe pengirim sekarang 'konselor'
            'pesan' => $request->pesan,
        ]);

        broadcast(new NewChatMessage($message))->toOthers();

        return response()->json($message, 201);
    }
}
