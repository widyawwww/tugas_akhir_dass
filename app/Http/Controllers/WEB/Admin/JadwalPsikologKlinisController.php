<?php

namespace App\Http\Controllers\WEB\Admin;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PsikologKlinis;
use App\Models\Jam;
use App\Models\SlotKonsultasiPsikologKlinis;
use App\Models\SlotKonsultasiPsikologKlinisJam;
use App\Models\RincianKonsultasiPsikologKlinis;

class JadwalPsikologKlinisController extends Controller
{
    public function index()
    {
        $jadwal = SlotKonsultasiPsikologKlinis::with(['psikologklinis', 'slotJam.jam', 'slotJam.rincian'])->get();
        $psikologklinis = PsikologKlinis::all();
        $jam = Jam::all();

        return view('pages.admin.jadwal-psikolog-klinis.index', compact('jadwal', 'psikologklinis', 'jam'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'psikolog_klinis_id' => 'required|exists:psikolog_klinis,id',
            'tanggal' => 'required|date',
            'jam_ids' => 'required|array',
        ]);

        $slot = SlotKonsultasiPsikologKlinis::create([
            'psikolog_klinis_id' => $request->psikolog_klinis_id,
            'tanggal' => $request->tanggal,
        ]);

        foreach ($request->jam_ids as $jamId) {
            $slotJam = SlotKonsultasiPsikologKlinisJam::create([
                'slot_konsultasi_psikolog_klinis_id' => $slot->id,
                'jam_id' => $jamId,
            ]);

            RincianKonsultasiPsikologKlinis::create([
                'slot_konsultasi_psikolog_klinis_jam_id' => $slotJam->id,
                'jumlah_slot' => 1,
                'slot_tersisa' => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Jadwal psikolog klinis berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jam_ids' => 'required|array',
        ]);

        $slot = SlotKonsultasiPsikologKlinis::findOrFail($id);

        // Hapus data sebelumnya
        foreach ($slot->slotJam as $slotJam) {
            $slotJam->rincian()->delete();
            $slotJam->delete();
        }

        // Tambah data baru
        foreach ($request->jam_ids as $jamId) {
            $slotJam = SlotKonsultasiPsikologKlinisJam::create([
                'slot_konsultasi_psikolog_klinis_id' => $slot->id,
                'jam_id' => $jamId,
            ]);

            RincianKonsultasiPsikologKlinis::create([
                'slot_konsultasi_psikolog_klinis_jam_id' => $slotJam->id,
                'jumlah_slot' => 1,
                'slot_tersisa' => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Jadwal psikolog klinis berhasil diperbarui');
    }

    public function destroy($id)
    {
        $slot = SlotKonsultasiPsikologKlinis::findOrFail($id);
        $slot->delete();

        return redirect()->back()->with('success', 'Jadwal psikolog klinis berhasil dihapus.');
    }

    public function generateJadwalMingguan()
    {
        $psikologklinis = PsikologKlinis::all();
        $jamList = Jam::all();

        // 7 hari ke depan
        $tanggalMulai = Carbon::today();
        $tanggalAkhir = Carbon::today()->addDays(6);

        for ($date = $tanggalMulai; $date->lte($tanggalAkhir); $date->addDay()) {
            $hariIni = $date->translatedFormat('l'); // "Monday", "Tuesday", dst.

            // Filter jam berdasarkan hari
            $jamUntukHariIni = $jamList->filter(fn($jam) => strtolower($jam->hari) == strtolower($hariIni));

            if ($jamUntukHariIni->isEmpty()) {
                continue;
            }

            foreach ($psikologkliniss as $psikologklinis) {
                // Cek apakah jadwal sudah ada
                $sudahAda = SlotKonsultasiPsikologKlinis::where('psikolog_klinis_id', $psikologklinis->id)
                    ->whereDate('tanggal', $date)
                    ->exists();

                if ($sudahAda) continue;

                // Buat Slot Konsultasi
                $slot = SlotKonsultasiPsikologKlinis::create([
                    'psikolog_klinis_id' => $psikologklinis->id,
                    'tanggal' => $date->toDateString(),
                ]);

                foreach ($jamUntukHariIni as $jam) {
                    $slotJam = SlotKonsultasiPsikologKlinisJam::create([
                        'slot_konsultasi_psikolog_klinis_id' => $slot->id,
                        'jam_id' => $jam->id,
                    ]);

                    RincianKonsultasiPsikologKlinis::create([
                        'slot_konsultasi_psikolog_klinis_jam_id' => $slotJam->id,
                        'jumlah_slot' => 1,
                        'slot_tersisa' => 1,
                    ]);
                }
            }
        }

        return redirect()->back()->with('success', 'Jadwal otomatis 1 minggu berhasil dibuat.');
    }
}
