<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use App\Models\PesanKonsultasiKonselor;
use Illuminate\Http\Request;

class PemesananKonselorController extends Controller
{
    public function index()
    {
        $data = PesanKonsultasiKonselor::with(['pengguna', 'konselor', 'slotJam.jam'])->get();
        return view('pages.admin.pemesanan-konselor.index', compact('data'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,disetujui,ditolak',
        ]);

        $pemesanan = PesanKonsultasiKonselor::findOrFail($id);
        $pemesanan->status = $request->status;
        $pemesanan->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui.');
    }
}
