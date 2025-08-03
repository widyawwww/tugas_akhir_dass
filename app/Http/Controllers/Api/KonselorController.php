<?php

namespace App\Http\Controllers\Api;

use App\Models\Konselor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KonselorController extends Controller
{
    public function index()
    {
        // Ambil baris pertama dari tabel konselor.
        $konselor = Konselor::all();

        // Jika tidak ada data sama sekali, kembalikan error 404.
        if (!$konselor) {
            return response()->json(['message' => 'Data konselor tidak ditemukan.'], 404);
        }

        // Kembalikan data sebagai JSON. Accessor akan otomatis dipanggil.
        return response()->json([
            'konselor' => $konselor,
        ]);
    }
}
