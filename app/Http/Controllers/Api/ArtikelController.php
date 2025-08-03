<?php

namespace App\Http\Controllers\Api; // Pastikan namespace-nya Api

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    /**
     * Menampilkan daftar semua artikel untuk halaman list.
     * Endpoint: GET /api/artikel
     */
    public function index()
    {
        // Ambil semua artikel, tapi hanya kolom yang dibutuhkan untuk list
        $artikels = Artikel::select('id', 'nama', 'deskripsi_singkat', 'gambar_url')->get();

        return response()->json($artikels);
    }

    /**
     * Menampilkan detail satu artikel dan daftar artikel lainnya.
     * Endpoint: GET /api/artikel/{artikel}
     */
    public function show(Artikel $artikel)
    {
        // Dengan Route Model Binding, Laravel otomatis mencari Artikel berdasarkan ID.

        // Ambil daftar artikel lain (hanya ID dan nama) untuk navigasi cepat
        $artikelLainnya = Artikel::where('id', '!=', $artikel->id)
            ->select('id', 'nama')
            ->get();

        return response()->json([
            'artikel' => $artikel,
            'lainnya' => $artikelLainnya,
        ]);
    }
}
