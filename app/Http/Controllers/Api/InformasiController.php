<?php

namespace App\Http\Controllers\Api;

use App\Models\Informasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InformasiController extends Controller
{
    public function index()
    {
        // Ambil baris pertama dari tabel informasi.
        $informasi = Informasi::first();

        // Jika tidak ada data sama sekali, kembalikan error 404.
        if (!$informasi) {
            return response()->json(['message' => 'Data informasi tidak ditemukan.'], 404);
        }

        // Kembalikan data sebagai JSON. Accessor akan otomatis dipanggil.
        return response()->json($informasi);
    }
}
