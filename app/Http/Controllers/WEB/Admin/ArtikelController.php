<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artikel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArtikelController extends Controller
{
    // Tampilkan daftar artikel
    public function index()
    {
        $artikels = Artikel::latest()->paginate(6);
        return view('pages.admin.artikel.index', compact('artikels'));
    }

    // Simpan artikel baru
        public function store(Request $request)
    {
        $request->validate([
            'nama'              => ['required', 'string'],
            'deskripsi_singkat' => ['nullable', 'string'],
            'deskripsi'         => ['nullable', 'string'],
            'gambar'            => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $data = $request->only(['nama', 'deskripsi_singkat', 'deskripsi']);

        if ($request->hasFile('gambar')) {
            // Simpan gambar dan dapatkan path-nya
            $path = $request->file('gambar')->store('artikel', 'public');
            $data['gambar'] = $path;
            // Buat URL lengkap dan simpan ke kolom terpisah
            $data['gambar_url'] = url('storage/' . $path);
        } else {
            // Jika tidak ada gambar, pastikan kedua kolom null
            $data['gambar'] = null;
            $data['gambar_url'] = null;
        }

        Artikel::create($data);

        return back()->with('success', 'Artikel berhasil ditambahkan.');
    }

    // Perbarui artikel
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'              => ['required', 'string'],
            'deskripsi_singkat' => ['nullable', 'string'],
            'deskripsi'         => ['nullable', 'string'],
            'gambar'            => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $artikel = Artikel::findOrFail($id);
        $artikel->fill($request->only(['nama', 'deskripsi_singkat', 'deskripsi']));

        if ($request->hasFile('gambar')) {
            // 1. Hapus gambar lama jika ada
            if ($artikel->gambar) {
                Storage::disk('public')->delete($artikel->gambar);
            }

            // 2. Simpan gambar baru
            $path = $request->file('gambar')->store('artikel', 'public');
            $artikel->gambar = $path;
            // 3. Perbarui juga URL lengkapnya
            $artikel->gambar_url = url('storage/' . $path);
        }

        $artikel->save();

        return back()->with('success', 'Artikel berhasil diperbarui.');
    }


    // Hapus artikel
    public function destroy($id)
    {
        $artikel = Artikel::findOrFail($id);

        if ($artikel->gambar && Storage::disk('public')->exists($artikel->gambar)) {
            Storage::disk('public')->delete($artikel->gambar);
        }

        $artikel->delete();

        return back()->with('success', 'Artikel berhasil dihapus.');
    }

    // Tampilkan detail artikel (opsional)
    public function show($id)
    {
        $artikel = Artikel::findOrFail($id);
        return view('pages.admin.artikel.show', compact('artikel'));
    }
}
