<?php

namespace App\Http\Controllers\WEB\Pengguna;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\InstrumenTes;
use App\Models\Pertanyaan;
use App\Models\OpsiJawaban;
use App\Models\OnlineTestResult;

class TesController extends Controller
{
    // ✅ 1. Tampilkan Tes
    public function kerjakan($instrumen_id)
    {
        $instrumen = InstrumenTes::with('pertanyaan.subskala')->findOrFail($instrumen_id);

        $pertanyaan = Pertanyaan::where('instrumen_tes_id', $instrumen_id)
                        ->orderBy('urutan')
                        ->get();

        $opsiJawaban = OpsiJawaban::where('instrumen_tes_id', $instrumen_id)
                        ->orderBy('skor')
                        ->get();

        return view('tes.kerjakan', compact('instrumen', 'pertanyaan', 'opsiJawaban'));
    }

    // ✅ 2. Simpan Hasil Tes
    public function simpanJawaban(Request $request, $instrumen_id)
    {
        $request->validate([
            'jawaban' => 'required|array',
        ]);

        foreach ($request->jawaban as $pertanyaan_id => $skor) {
            OnlineTestResult::create([
                'user_id' => Auth::id(),
                'instrumen_tes_id' => $instrumen_id,
                'pertanyaan_id' => $pertanyaan_id,
                'skor' => $skor,
            ]);
        }

        return redirect()->route('tes.selesai', $instrumen_id)
                         ->with('success', 'Jawaban berhasil disimpan!');
    }

    // ✅ 3. Halaman Selesai
    public function selesai($instrumen_id)
    {
        $instrumen = InstrumenTes::findOrFail($instrumen_id);

        return view('tes.selesai', compact('instrumen'));
    }
}
