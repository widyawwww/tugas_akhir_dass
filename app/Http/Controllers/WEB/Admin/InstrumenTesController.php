<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Models\Tips;
use App\Models\Artikel;
use App\Models\Subskala;
use App\Models\Pertanyaan;
use App\Models\OpsiJawaban;
use App\Models\InstrumenTes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OpsiJawabanPertanyaan;
use Illuminate\Support\Facades\Storage;

class InstrumenTesController extends Controller
{
    // ✅ Tampilkan semua instrumen
    public function index()
    {
        $instrumenList = InstrumenTes::latest()->get();
        return view('pages.admin.instrumen-tes.index', compact('instrumenList'));
    }

    // ✅ Simpan instrumen baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'      => 'required|string|max:255',
            'pembuat'   => 'required|string|max:255',
            'tahun'     => 'required|digits:4|integer',
            'deskripsi' => 'nullable|string',
            'gambar'    => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('instrumen', 'public');
            $validated['gambar'] = $gambarPath;
            $validated['gambar_url'] = asset('storage/' . $gambarPath); // <- tambahkan ini
        }

        InstrumenTes::create($validated);

        return redirect()->back()->with('success', 'Instrumen berhasil ditambahkan.');
    }


    // ✅ Hapus instrumen
    public function destroy($id)
    {
        $instrumen = InstrumenTes::findOrFail($id);

        // Hapus gambar jika ada
        if ($instrumen->gambar && Storage::disk('public')->exists($instrumen->gambar)) {
            Storage::disk('public')->delete($instrumen->gambar);
        }

        $instrumen->delete();

        return redirect()->back()->with('success', 'Instrumen berhasil dihapus.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'nullable',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $instrumen = InstrumenTes::findOrFail($id);

        $data = [
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
        ];

        // Jika gambar baru diunggah
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($instrumen->gambar && Storage::disk('public')->exists($instrumen->gambar)) {
                Storage::disk('public')->delete($instrumen->gambar);
            }

            // Simpan gambar baru
            $gambarPath = $request->file('gambar')->store('instrumen', 'public');
            $data['gambar'] = $gambarPath;

            // Tambahkan URL gambar jika kamu pakai itu di frontend
            $data['gambar_url'] = Storage::url($gambarPath);
        }

        $instrumen->update($data);

        return redirect()->back()->with('success', 'Instrumen berhasil diperbarui.');
    }

    public function edit($id)
    {
        $instrumen = InstrumenTes::findOrFail($id);
        return view('pages.admin.instrumen-tes.edit', compact('instrumen'));
    }

    // Tampilkan pertanyaan instrumen
    public function lihatPertanyaan($id)
    {
        $instrumen = InstrumenTes::with('subskala')->findOrFail($id);
        $pertanyaanList = Pertanyaan::where('instrumen_tes_id', $id)
            ->orderBy('created_at')
            ->get();

        return view('pages.admin.instrumen-tes.pertanyaan', compact('instrumen', 'pertanyaanList'));
    }

    public function storePertanyaan(Request $request)
    {
        $request->validate([
            'instrumen_tes_id' => 'required|exists:instrumen_tes,id',
            'teks_pertanyaan' => 'required|string',
            'subskala_id' => 'nullable|exists:subskala,id',
        ]);

        Pertanyaan::create([
            'instrumen_tes_id' => $request->instrumen_tes_id,
            'teks_pertanyaan' => $request->teks_pertanyaan,
            'subskala_id' => $request->subskala_id,
        ]);

        return back()->with('success', 'Pertanyaan berhasil ditambahkan.');
    }

    public function updatePertanyaan(Request $request, $id)
    {
        $request->validate([
            'teks_pertanyaan' => 'required|string',
            'subskala_id' => 'nullable|exists:subskala,id',
        ]);

        $soal = \App\Models\Pertanyaan::findOrFail($id);

        $soal->update([
            'teks_pertanyaan' => $request->teks_pertanyaan,
            'subskala_id' => $request->subskala_id,
        ]);

        return back()->with('success', 'Soal berhasil diperbarui.');
    }

    public function destroyPertanyaan($id)
    {
        $soal = \App\Models\Pertanyaan::findOrFail($id);
        $soal->delete();

        return back()->with('success', 'Soal berhasil dihapus.');
    }

    public function lihatOpsi($id)
    {
        $instrumen = InstrumenTes::findOrFail($id);

        // Cek apakah opsi per pertanyaan
        $adaOpsiPerPertanyaan = OpsiJawabanPertanyaan::whereHas('pertanyaan', function ($q) use ($id) {
            $q->where('instrumen_tes_id', $id);
        })->exists();

        if ($adaOpsiPerPertanyaan) {
            // Ambil daftar pertanyaan dan opsinya
            $pertanyaans = Pertanyaan::where('instrumen_tes_id', $id)->with('opsiJawabanPertanyaan')->get();

            return view('pages.admin.instrumen-tes.opsi-per-pertanyaan', compact('instrumen', 'pertanyaans'));
        } else {
            // Ambil opsi yang terkait langsung ke instrumen
            $opsiList = OpsiJawaban::where('instrumen_tes_id', $id)->get();

            return view('pages.admin.instrumen-tes.opsi-jawaban', compact('instrumen', 'opsiList'));
        }
    }

    public function storeOpsi(Request $request)
    {
        if ($request->has('pertanyaan_id')) {
            $request->validate([
                'pertanyaan_id' => 'required|exists:pertanyaan,id',
                'teks_opsi' => 'required|string',
                'skor' => 'required|integer',
            ]);

            OpsiJawabanPertanyaan::create([
                'pertanyaan_id' => $request->pertanyaan_id,
                'teks_opsi' => $request->teks_opsi,
                'skor' => $request->skor,
            ]);
        } else {
            $request->validate([
                'instrumen_tes_id' => 'required|exists:instrumen_tes,id',
                'teks_opsi' => 'required|string',
                'skor' => 'required|integer',
            ]);

            OpsiJawaban::create([
                'instrumen_tes_id' => $request->instrumen_tes_id,
                'teks_opsi' => $request->teks_opsi,
                'skor' => $request->skor,
            ]);
        }

        return back()->with('success', 'Opsi berhasil ditambahkan');
    }


    public function updateOpsi(Request $request, $id)
    {
        $request->validate([
            'teks_opsi' => 'required|string',
            'skor' => 'required|integer',
        ]);

        $opsi = OpsiJawaban::findOrFail($id);
        $opsi->update([
            'teks_opsi' => $request->teks_opsi,
            'skor' => $request->skor,
        ]);

        return back()->with('success', 'Opsi berhasil diperbarui');
    }

    public function destroyOpsi($id)
    {
        $opsi = OpsiJawaban::findOrFail($id);
        $opsi->delete();

        return back()->with('success', 'Opsi berhasil dihapus');
    }

    public function lihatSubskala($id)
    {
        $instrumen = InstrumenTes::findOrFail($id);
        $subskalaList = $instrumen->subskala; // gunakan relasi

        return view('pages.admin.instrumen-tes.subskala', compact('instrumen', 'subskalaList'));
    }

    public function storeSubskala(Request $request)
    {
        $request->validate([
            'instrumen_tes_id' => 'required|exists:instrumen_tes,id',
            'nama' => 'required|string|max:255',
        ]);

        \App\Models\Subskala::create([
            'instrumen_tes_id' => $request->instrumen_tes_id,
            'nama' => $request->nama,
        ]);

        return back()->with('success', 'Subskala berhasil ditambahkan.');
    }

    public function updateSubskala(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $subskala = \App\Models\Subskala::findOrFail($id);
        $subskala->update([
            'nama' => $request->nama,
        ]);

        return back()->with('success', 'Subskala berhasil diperbarui.');
    }

    public function destroySubskala($id)
    {
        $subskala = Subskala::findOrFail($id);
        $subskala->delete();

        return back()->with('success', 'Subskala berhasil dihapus.');
    }

    public function artikel($id)
    {
        $instrumen = InstrumenTes::findOrFail($id);
        $artikel = Artikel::all();

        return view('pages.admin.instrumen-tes.artikel', compact('instrumen', 'artikel'));
    }

    public function updateArtikel(Request $request, $id)
    {
        $request->validate([
            'artikel_id' => 'required|array',
            'artikel_id.*' => 'exists:artikel,id',
        ]);

        $instrumen = InstrumenTes::findOrFail($id);
        $instrumen->artikel()->sync($request->input('artikel_id'));

        return redirect()->back()->with('success', 'Artikel berhasil diperbarui.');
    }

    public function tips($id)
    {
        $instrumen = InstrumenTes::findOrFail($id);
        $tips = Tips::all();

        return view('pages.admin.instrumen-tes.tips', compact('instrumen', 'tips'));
    }

    public function updateTips(Request $request, $id)
    {
        $request->validate([
            'tips_id' => 'required|array',
            'tips_id.*' => 'exists:tips,id',
        ]);

        $instrumen = InstrumenTes::findOrFail($id);
        $instrumen->tips()->sync($request->input('tips_id'));

        return redirect()->back()->with('success', 'Tips berhasil diperbarui.');
    }

}
