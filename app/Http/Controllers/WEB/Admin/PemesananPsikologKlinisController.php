<?php

namespace App\Http\Controllers\WEB\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PesanKonsultasiPsikologKlinis;

class PemesananPsikologKlinisController extends Controller
{
    public function index()
    {
        $data = PesanKonsultasiPsikologKlinis::with(['pengguna', 'psikolog_klinis', 'slotJam.jam'])->get();

        return view('pages.admin.pemesanan-psikolog-klinis.index', compact('data'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,disetujui,ditolak',
        ]);

        $pemesanan = PesanKonsultasiPsikologKlinis::findOrFail($id);
        $pemesanan->status = $request->status;
        $pemesanan->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui.');
    }

}
