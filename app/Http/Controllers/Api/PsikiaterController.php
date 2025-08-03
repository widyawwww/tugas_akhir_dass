<?php

namespace App\Http\Controllers\Api;

use App\Models\Psikiater;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PsikiaterController extends Controller
{
    public function index()
    {
        // Ambil baris pertama dari tabel psikiater.
        $psikiater = Psikiater::all();

        // Jika tidak ada data sama sekali, kembalikan error 404.
        if (!$psikiater) {
            return response()->json(['message' => 'Data psikiater tidak ditemukan.'], 404);
        }

        // Kembalikan data sebagai JSON. Accessor akan otomatis dipanggil.
        return response()->json([
            'psikiater' => $psikiater,
        ]);
    }
}
