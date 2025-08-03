<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HasilTes;
use App\Models\InstrumenTes;
use App\Models\JawabanPengguna;
use App\Models\OpsiJawaban;
use App\Models\OpsiJawabanPertanyaan;
use App\Models\SubskalaHasil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TestResultController extends Controller
{
    public function store(Request $request, $testId)
    {
        $request->validate([
            'answers' => 'required|array',
            'answers.*.question_id' => 'required|integer|exists:pertanyaan,id',
            'answers.*.option_id' => 'required|integer',
        ]);

        $user = Auth::user();
        $instrumen = InstrumenTes::with(['pertanyaan.subskala', 'artikel', 'tips'])->findOrFail($testId);

        $hasilTes = DB::transaction(function () use ($user, $instrumen, $request) {
            $hasilTes = HasilTes::create([
                'user_id' => $user->id,
                'instrumen_tes_id' => $instrumen->id,
                'status' => 'belum',
            ]);

            $skorPerSubskala = [];
            $totalSkor = 0;

            foreach ($request->answers as $answer) {
                $pertanyaan = $instrumen->pertanyaan->find($answer['question_id']);
                $skor = 0;

                if ($instrumen->nama === 'BDI-II') {
                    $opsi = OpsiJawabanPertanyaan::find($answer['option_id']);
                    if ($opsi) {
                        $skor = $opsi->skor;
                        JawabanPengguna::create([
                            'hasil_tes_id' => $hasilTes->id,
                            'pertanyaan_id' => $answer['question_id'],
                            'opsi_jawaban_pertanyaan_id' => $answer['option_id'],
                        ]);
                    }
                } else {
                    $opsi = OpsiJawaban::find($answer['option_id']);
                    if ($opsi) {
                        $skor = $opsi->skor;

                        // PSS-10: balik skor item positif (4, 5, 7, 8)
                        if ($instrumen->nama === 'PSS-10') {
                            $indexPertanyaan = $pertanyaan?->nomor;
                            $itemPositif = [4, 5, 7, 8];
                            if (in_array($indexPertanyaan, $itemPositif)) {
                                $skor = 4 - $skor;
                            }
                        }

                        JawabanPengguna::create([
                            'hasil_tes_id' => $hasilTes->id,
                            'pertanyaan_id' => $answer['question_id'],
                            'opsi_jawaban_id' => $answer['option_id'],
                        ]);
                    }
                }

                $totalSkor += $skor;

                if ($pertanyaan && $pertanyaan->subskala) {
                    $subskalaId = $pertanyaan->subskala_id;
                    if (!isset($skorPerSubskala[$subskalaId])) {
                        $skorPerSubskala[$subskalaId] = 0;
                    }
                    $skorPerSubskala[$subskalaId] += $skor;
                }
            }

            if ($instrumen->nama === 'DASS-21') {
                foreach ($skorPerSubskala as $subskalaId => $skor) {
                    $finalSkor = $skor * 2;
                    $tingkatan = $this->getDass21Tingkatan($subskalaId, $finalSkor);
                    SubskalaHasil::create([
                        'hasil_tes_id' => $hasilTes->id,
                        'subskala_id' => $subskalaId,
                        'skor' => $finalSkor,
                        'tingkatan' => $tingkatan,
                    ]);
                }
            } elseif ($instrumen->nama === 'BDI-II') {
                $subskala = $instrumen->subskala->first();
                $tingkatan = $this->getBdiTingkatan($totalSkor);
                SubskalaHasil::create([
                    'hasil_tes_id' => $hasilTes->id,
                    'subskala_id' => $subskala->id,
                    'skor' => $totalSkor,
                    'tingkatan' => $tingkatan,
                ]);
                $hasilTes->skor_total = $totalSkor;
                $hasilTes->tingkatan = $tingkatan;
            } elseif ($instrumen->nama === 'BAI') {
                $subskala = $instrumen->subskala->first();
                $tingkatan = $this->getBaiTingkatan($totalSkor);
                SubskalaHasil::create([
                    'hasil_tes_id' => $hasilTes->id,
                    'subskala_id' => $subskala->id,
                    'skor' => $totalSkor,
                    'tingkatan' => $tingkatan,
                ]);
                $hasilTes->skor_total = $totalSkor;
                $hasilTes->tingkatan = $tingkatan;
            } elseif ($instrumen->nama === 'PSS-10') {
                $subskala = $instrumen->subskala->first();
                $tingkatan = $this->getPssTingkatan($totalSkor);
                SubskalaHasil::create([
                    'hasil_tes_id' => $hasilTes->id,
                    'subskala_id' => $subskala->id,
                    'skor' => $totalSkor,
                    'tingkatan' => $tingkatan,
                ]);
                $hasilTes->skor_total = $totalSkor;
                $hasilTes->tingkatan = $tingkatan;
            }

            $hasilTes->status = 'selesai';
            $hasilTes->save();

            return $hasilTes;
        });

        // Memuat relasi artikel dan tips dalam respons
        return response()->json($hasilTes->load([
            'subskalaHasil.subskala',
            'instrumen' => function ($query) {
                $query->with(['artikel' => function ($q) {
                    $q->select('artikel_id', 'nama', 'deskripsi_singkat', 'gambar_url');
                }, 'tips' => function ($q) {
                    $q->select('tips_id', 'nama', 'deskripsi_singkat', 'gambar_url');
                }]);
            }
        ]), 201);
    }

    public function history(Request $request)
    {
        $user = Auth::user();

        $history = HasilTes::where('user_id', $user->id)
            ->with([
                'instrumen' => function ($query) {
                    $query->select('id', 'nama')
                        ->with([
                            'artikel' => function ($q) {
                                $q->select('artikel_id', 'nama', 'deskripsi_singkat', 'gambar_url');
                            },
                            'tips' => function ($q) {
                                $q->select('tips_id', 'nama', 'deskripsi_singkat', 'gambar_url');
                            }
                        ]);
                },
                'subskalaHasil.subskala:id,nama'
            ])
            ->latest()
            ->get();

        return response()->json($history);
    }

    private function getDass21Tingkatan($subskalaId, $skor)
    {
        if ($subskalaId == 1) {
            if ($skor <= 14) return 'Depresi Normal';
            if ($skor <= 18) return 'Depresi Ringan';
            if ($skor <= 25) return 'Depresi Sedang';
            if ($skor <= 33) return 'Depresi Parah';
            return 'Depresi Sangat Parah';
        } elseif ($subskalaId == 2) {
            if ($skor <= 7) return 'Kecemasan Normal';
            if ($skor <= 9) return 'Kecemasan Ringan';
            if ($skor <= 14) return 'Kecemasan Sedang';
            if ($skor <= 19) return 'Kecemasan Parah';
            return 'Kecemasan Sangat Parah';
        } elseif ($subskalaId == 3) {
            if ($skor <= 9) return 'Stress Normal';
            if ($skor <= 13) return 'Stress Ringan';
            if ($skor <= 20) return 'Stress Sedang';
            if ($skor <= 27) return 'Stress Parah';
            return 'Stress Sangat Parah';
        }
        return 'Tidak Diketahui';
    }

    private function getBdiTingkatan($skor)
    {
        if ($skor <= 13) return 'Depresi Minimal';
        if ($skor <= 19) return 'Depresi Ringan';
        if ($skor <= 28) return 'Depresi Sedang';
        return 'Depresi Berat';
    }

    private function getBaiTingkatan($skor)
    {
        if ($skor <= 21) return 'Kecemasan Rendah';
        if ($skor <= 35) return 'Kecemasan Sedang';
        return 'Kecemasan Berat';
    }

    private function getPssTingkatan($skor)
    {
        if ($skor <= 14) return 'Stres Rendah';
        if ($skor <= 26) return 'Stres Sedang';
        return 'Stres Tinggi';
    }
}