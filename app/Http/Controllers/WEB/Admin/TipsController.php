<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tips;
use Illuminate\Support\Facades\Storage;

class TipsController extends Controller
{
    public function index()
    {
        $tips = Tips::all();
        return view('pages.admin.tips.index', compact('tips'));
    }

    public function show($id)
    {
        $tips = Tips::findOrFail($id);
        $daftarTips = json_decode($tips->daftar_tips, true) ?? [];

        return view('pages.admin.tips.show', [
            'tips' => $tips,
            'daftarTips' => $daftarTips,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'nama' => $request->nama,
            'deskripsi_singkat' => $request->deskripsi,
            'daftar_tips' => '[]', // default kosong
        ];

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('tips', 'public');
        }

        Tips::create($data);

        return back()->with('success', 'Jenis tips berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $tips = Tips::findOrFail($id);
        $daftar = json_decode($tips->daftar_tips, true) ?? [];

        if ($request->action === 'add') {
            $request->validate(['new_tip' => 'required|string']);
            $daftar[] = $request->new_tip;

        } elseif ($request->action === 'delete') {
            $index = (int) $request->index;
            if (isset($daftar[$index])) {
                unset($daftar[$index]);
                $daftar = array_values($daftar); // reset index array
            }

        } elseif ($request->action === 'edit') {
            $request->validate(['edited_tip' => 'required|string']);
            $index = (int) $request->index;
            if (isset($daftar[$index])) {
                $daftar[$index] = $request->edited_tip;
            }
        }

        $tips->daftar_tips = json_encode($daftar);
        $tips->save();

        return back()->with('success', 'Tips berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $tips = Tips::findOrFail($id);

        if ($tips->gambar && Storage::disk('public')->exists($tips->gambar)) {
            Storage::disk('public')->delete($tips->gambar);
        }

        $tips->delete();

        return back()->with('success', 'Jenis tips berhasil dihapus.');
    }
}



