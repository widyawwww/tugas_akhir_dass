<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Models\Jam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AturJamController extends Controller
{
    public function index(Request $request)
    {
        $query = Jam::query();

        // Filter berdasarkan hari jika ada
        if ($request->filled('filter_hari')) {
            $query->where('hari', $request->filter_hari);
        }

        // Ambil data dengan pagination
        $jam = $query->orderBy('hari')->paginate(10); // 10 per halaman

        return view('pages.admin.atur-jam.index', compact('jam'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'hari'        => 'required|string',
            'jam_mulai'   => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
        ]);

        Jam::create([
            'hari'        => $request->hari,
            'jam_mulai'   => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        return redirect()->route('admin.atur-jam.index')->with('success', 'Jam berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'hari'        => 'required|string',
            'jam_mulai'   => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
        ]);

        $jam = Jam::findOrFail($id);
        $jam->update([
            'hari'        => $request->hari,
            'jam_mulai'   => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        return back()->with('success', 'Jam berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jam = Jam::findOrFail($id);
        $jam->delete();

        return back()->with('success', 'Jam berhasil dihapus.');
    }

}
