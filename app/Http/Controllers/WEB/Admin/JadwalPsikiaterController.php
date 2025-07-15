<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Psikiater;
use App\Models\Jam;
use App\Models\SlotKonsultasiPsikiater;
use App\Models\SlotKonsultasiPsikiaterJam;
use App\Models\RincianKonsultasiPsikiater;

class JadwalPsikiaterController extends Controller
{
    public function index()
    {
        $jadwal = SlotKonsultasiPsikiater::with(['psikiater', 'slotJam.jam', 'slotJam.rincian'])->get();
        $psikiater = Psikiater::all();
        $jam = Jam::all();

        return view('pages.admin.jadwal-psikiater.index', compact('jadwal', 'psikiater', 'jam'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'psikiater_id' => 'required|exists:psikiater,id',
            'tanggal' => 'required|date',
            'jam_ids' => 'required|array',
        ]);

        $slot = SlotKonsultasiPsikiater::create([
            'psikiater_id' => $request->psikiater_id,
            'tanggal' => $request->tanggal,
        ]);

        foreach ($request->jam_ids as $jamId) {
            $slotJam = SlotKonsultasiPsikiaterJam::create([
                'slot_konsultasi_psikiater_id' => $slot->id,
                'jam_id' => $jamId,
            ]);

            RincianKonsultasiPsikiater::create([
                'slot_konsultasi_psikiater_jam_id' => $slotJam->id,
                'jumlah_slot' => 1,
                'slot_tersisa' => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Jadwal psikiater berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jam_ids' => 'required|array',
        ]);

        $slot = SlotKonsultasiPsikiater::findOrFail($id);

        // Hapus data sebelumnya
        foreach ($slot->slotJam as $slotJam) {
            $slotJam->rincian()->delete();
            $slotJam->delete();
        }

        // Tambah data baru
        foreach ($request->jam_ids as $jamId) {
            $slotJam = SlotKonsultasiPsikiaterJam::create([
                'slot_konsultasi_psikiater_id' => $slot->id,
                'jam_id' => $jamId,
            ]);

            RincianKonsultasiPsikiater::create([
                'slot_konsultasi_psikiater_jam_id' => $slotJam->id,
                'jumlah_slot' => 1,
                'slot_tersisa' => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Jadwal psikiater berhasil diperbarui');
    }

    public function destroy($id)
    {
        $slot = SlotKonsultasiPsikiater::findOrFail($id);
        $slot->delete();

        return redirect()->back()->with('success', 'Jadwal psikiater berhasil dihapus.');
    }
}
