<?php

namespace App\Http\Controllers\WEB\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('pages.auth.admin-register.index');
    }
        public function register(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'alpha_dash', 'unique:admins,username'],
            'email' => ['required', 'email', 'unique:admins,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        
        Admin::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admin.login')->with('success', 'Pendaftaran berhasil. Silakan login.');
    }


}
