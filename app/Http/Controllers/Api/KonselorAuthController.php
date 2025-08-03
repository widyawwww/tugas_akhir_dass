<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Konselor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class KonselorAuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // --- PERBAIKAN DI SINI ---
        // 1. Cari konselor berdasarkan username terlebih dahulu.
        $konselor = Konselor::where('username', $request->username)->first();

        // 2. Verifikasi secara manual:
        //    - Apakah konselor ditemukan?
        //    - Apakah password yang dikirim cocok dengan hash di database?
        if (!$konselor || !Hash::check($request->password, $konselor->password)) {
            return response()->json(['message' => 'Username atau password salah'], 401);
        }

        // 3. Jika berhasil, buat token.
        $token = $konselor->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login Konselor berhasil',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user_type' => 'konselor', // Kirim tipe pengguna
            'user' => $konselor,
        ]);
    }
}
