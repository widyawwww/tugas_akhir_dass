<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InstrumenTes;

class TestInstrumentController extends Controller
{
    // Mengambil daftar semua tes
    public function index()
    {
        // Ambil daftar semua instrumen tes tanpa relasi artikel dan tips
        $tests = InstrumenTes::select('id', 'nama', 'deskripsi', 'pembuat', 'tahun')->get();

        return response()->json($tests);
    }

    public function show($id)
    {
        // Ambil detail instrumen tanpa relasi artikel dan tips
        $test = InstrumenTes::with([
            'pertanyaan.opsiJawabanPertanyaan'
        ])->findOrFail($id);

        // Tambahkan relasi opsiJawaban hanya jika bukan BDI-II
        if ($test->nama !== 'BDI-II') {
            $test->load('opsiJawaban');
        }

        return response()->json($test);
    }
}
