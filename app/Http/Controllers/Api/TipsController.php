<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tips;
use Illuminate\Http\Request;

class TipsController extends Controller
{
    /**
     * Menampilkan daftar semua tips (untuk halaman list).
     * Endpoint: GET /api/tips
     */
    public function index()
    {
        // Ambil semua tips, tapi hanya kolom yang dibutuhkan untuk list
        $tips = Tips::select('id', 'nama', 'deskripsi_singkat', 'gambar_url')->get();

        // Accessor 'getGambarAttribute' di model akan otomatis dipanggil di sini
        return response()->json([
            'tips' => $tips,

        ]);
    }

    public function show($id)
    {
        $tips = Tips::findOrFail($id);
        $daftarTips = json_decode($tips->daftar_tips, true) ?? [];

        return response()->json([
            'tips' => $tips,
            'daftar_tips' => $daftarTips,

        ]);
    }
}
