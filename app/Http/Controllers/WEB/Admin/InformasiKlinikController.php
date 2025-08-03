<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Models\Informasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class InformasiKlinikController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $informasi = Informasi::first(); // Hanya satu informasi
        return view('pages.admin.informasi-klinik.index', compact('informasi'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'      => 'required',
            'telepon'   => 'required',
            'email'     => 'required|email',
            'alamat'    => 'required',
            'tentang'   => 'required',
            'visi'      => 'nullable|string',
            'misi'      => 'nullable|string',
            'instagram' => 'nullable|string',
            'tiktok'    => 'nullable|string',
            'gambar'    => 'nullable|image|max:2048',
            'logo'      => 'nullable|image|max:2048',
        ]);

        // Log untuk debugging
        Log::info('Store: Gambar diterima: ' . $request->hasFile('gambar'));
        Log::info('Store: Logo diterima: ' . $request->hasFile('logo'));

        // Simpan gambar
        if ($request->hasFile('gambar') && $request->file('gambar')->isValid()) {
            $path = $request->file('gambar')->store('informasi', 'public');
            $validated['gambar'] = basename($path);
            $validated['gambar_url'] = asset('storage/' . $path);
        }

        // Simpan logo
        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
            $path = $request->file('logo')->store('informasi', 'public');
            $validated['logo'] = basename($path);
            $validated['logo_url'] = asset('storage/' . $path);
        }

        // Debugging sebelum menyimpan
        // dd($validated);

        Informasi::create($validated);

        return redirect()->route('admin.informasi.index')->with('success', 'Informasi berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $informasi = Informasi::findOrFail($id);

        $validated = $request->validate([
            'nama'      => 'required',
            'telepon'   => 'required',
            'email'     => 'required|email',
            'alamat'    => 'required',
            'tentang'   => 'required',
            'visi'      => 'nullable|string',
            'misi'      => 'nullable|string',
            'instagram' => 'nullable|string',
            'tiktok'    => 'nullable|string',
            'gambar'    => 'nullable|image|max:2048',
            'logo'      => 'nullable|image|max:2048',
        ]);

        // Log untuk debugging
        Log::info('Update: Gambar diterima: ' . $request->hasFile('gambar'));
        Log::info('Update: Logo diterima: ' . $request->hasFile('logo'));

        // Simpan gambar baru dan hapus yang lama
        if ($request->hasFile('gambar') && $request->file('gambar')->isValid()) {
            if ($informasi->gambar && Storage::disk('public')->exists('informasi/' . $informasi->gambar)) {
                Storage::disk('public')->delete('informasi/' . $informasi->gambar);
            }
            $path = $request->file('gambar')->store('informasi', 'public');
            $validated['gambar'] = basename($path);
            $validated['gambar_url'] = asset('storage/' . $path);
        }

        // Simpan logo baru dan hapus yang lama
        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
            if ($informasi->logo && Storage::disk('public')->exists('informasi/' . $informasi->logo)) {
                Storage::disk('public')->delete('informasi/' . $informasi->logo);
            }
            $path = $request->file('logo')->store('informasi', 'public');
            $validated['logo'] = basename($path);
            $validated['logo_url'] = asset('storage/' . $path);
        }

        // Debugging sebelum menyimpan
        // dd($validated);

        $informasi->update($validated);

        return redirect()->route('admin.informasi.index')->with('success', 'Informasi berhasil diperbarui');
    }
}