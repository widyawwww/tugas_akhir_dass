<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Konselor;
use App\Models\Jam;
use App\Models\SlotKonsultasiKonselor;
use App\Models\SlotKonsultasiKonselorJam;
use App\Models\RincianKonsultasiKonselor;

class JadwalKonselorController extends Controller
{
    public function index()
    {
        $jadwal = SlotKonsultasiKonselor::with(['konselor', 'slotJam.jam', 'slotJam.rincian'])->get();
        $konselor = Konselor::all();
        $jam = Jam::all();

        return view('pages.admin.jadwal-konselor.index', compact('jadwal', 'konselor', 'jam'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'konselor_id' => 'required|exists:konselor,id',
            'tanggal' => 'required|date',
            'jam_ids' => 'required|array',
        ]);

        $slot = SlotKonsultasiKonselor::create([
            'konselor_id' => $request->konselor_id,
            'tanggal' => $request->tanggal,
        ]);

        foreach ($request->jam_ids as $jamId) {
            $slotJam = SlotKonsultasiKonselorJam::create([
                'slot_konsultasi_konselor_id' => $slot->id,
                'jam_id' => $jamId,
            ]);

            RincianKonsultasiKonselor::create([
                'slot_konsultasi_konselor_jam_id' => $slotJam->id,
                'jumlah_slot' => 1,
                'slot_tersisa' => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Jadwal berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jam_ids' => 'required|array',
        ]);

        $slot = SlotKonsultasiKonselor::findOrFail($id);

        // Hapus data sebelumnya
        foreach ($slot->slotJam as $slotJam) {
            $slotJam->rincian()->delete();
            $slotJam->delete();
        }

        // Tambahkan data baru
        foreach ($request->jam_ids as $jamId) {
            $slotJam = SlotKonsultasiKonselorJam::create([
                'slot_konsultasi_konselor_id' => $slot->id,
                'jam_id' => $jamId,
            ]);

            RincianKonsultasiKonselor::create([
                'slot_konsultasi_konselor_jam_id' => $slotJam->id,
                'jumlah_slot' => 1,
                'slot_tersisa' => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Jadwal berhasil diperbarui');
    }

    public function destroy($id)
    {
        // Hapus data slot_konsultasi_konselor (otomatis akan cascade ke slot_jam dan rincian jika relasi onDelete('cascade'))
        $slot = \App\Models\SlotKonsultasiKonselor::findOrFail($id);
        $slot->delete();

        return redirect()->back()->with('success', 'Jadwal konselor berhasil dihapus.');
    }

}
