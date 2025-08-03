<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Mengambil data profil pengguna yang sedang login.
     * Endpoint: GET /api/profile
     */
    public function show(Request $request)
    {
        // Cukup kembalikan data user yang terotentikasi
        return response()->json($request->user());
    }

    /**
     * Memperbarui data profil pengguna yang sedang login.
     * Endpoint: POST /api/profile
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'nullable|string|max:255',
            'email' => [
                'nullable',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id), // Unik, tapi abaikan user saat ini
            ],
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|string|in:L,P',
            //'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Validasi gambar
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Ambil data yang sudah divalidasi
        $validatedData = $validator->validated();

        // Handle upload gambar jika ada
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($user->gambar) {
                Storage::delete($user->gambar);
            }

            $path = $request->file('gambar')->store('profile-images', 'public');
            $validatedData['gambar'] = $path;
            $validatedData['gambar_url'] = asset('storage/' . $path); // Simpan URL gambar
        }

        // Update data user
        $user->update($validatedData);

        // Kembalikan data user yang sudah diperbarui
        return response()->json([
            'user' => $user,
        ], 200);
    }
}
