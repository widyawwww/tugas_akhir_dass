<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Models\Jam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AturJamController extends Controller
{
    public function index()
    {
        $jam = Jam::orderBy('jam_mulai')->get();
        return view('pages.admin.atur-jam.index', compact('jam'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
        ]);

        Jam::create([
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        return redirect()->route('admin.atur-jam.index')->with('success', 'Jam berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        $jam = Jam::findOrFail($id);
        $jam->update([
            'jam_mulai' => $request->jam_mulai,
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
