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
            'daftar_tips' => '[]', // Default array JSON kosong
        ];

        if ($request->hasFile('gambar')) {
            // Simpan gambar dan dapatkan path-nya
            $path = $request->file('gambar')->store('tips', 'public');
            $data['gambar'] = $path;
            // Buat URL lengkap dan simpan ke kolom terpisah
            $data['gambar_url'] = url('storage/' . $path);
        } else {
            // Jika tidak ada gambar, pastikan kedua kolom null
            $data['gambar'] = null;
            $data['gambar_url'] = null;
        }

        Tips::create($data);

        return back()->with('success', 'Jenis tips berhasil ditambahkan.');
    }

    /**
     * Memperbarui data tips yang ada, termasuk daftar tips.
     */
    public function update(Request $request, $id)
    {
        $tips = Tips::findOrFail($id);

        // --- Bagian untuk mengelola DAFTAR TIPS (dari form terpisah) ---
        if ($request->has('action')) {
            $daftar = json_decode($tips->daftar_tips, true) ?? [];

            if ($request->action === 'add') {
                $request->validate(['new_tip' => 'required|string']);
                $daftar[] = $request->new_tip;
            } elseif ($request->action === 'delete') {
                $index = (int) $request->index;
                if (isset($daftar[$index])) {
                    array_splice($daftar, $index, 1);
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

            return back()->with('success', 'Daftar tips berhasil diperbarui.');
        }

        // --- Bagian untuk mengelola DATA UTAMA (dari form edit utama) ---
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $tips->nama = $request->nama;
        $tips->deskripsi_singkat = $request->deskripsi;

        if ($request->hasFile('gambar')) {
            // 1. Hapus gambar lama jika ada
            if ($tips->gambar) {
                Storage::disk('public')->delete($tips->gambar);
            }

            // 2. Simpan gambar baru
            $path = $request->file('gambar')->store('tips', 'public');
            $tips->gambar = $path;
            // 3. Perbarui juga URL lengkapnya
            $tips->gambar_url = url('storage/' . $path);
        }

        $tips->save();

        return redirect()->back()->with('success', 'Data tips berhasil diperbarui.'); // Sesuaikan nama route
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
