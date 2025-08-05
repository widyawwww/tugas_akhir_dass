<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Models\User;
use App\Models\Admin;
use App\Models\Konselor;
use App\Models\PsikologKlinis;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DaftarPenggunaController extends Controller
{
    public function admin()
    {
        $admins = Admin::latest()->paginate(10);
        return view('pages.admin.daftar-pengguna.admin', compact('admins'));
    }

    public function storeAdmin(Request $request)
    {
        $request->validate([
            'username'     => ['required', 'string', 'max:255'],
            'email'        => ['required', 'email', 'unique:admins,email'],
            'password'     => ['required', 'string', 'min:6'],
            'gambar'       => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $data = [
            'username'     => $request->username,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
        ];

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('admin', 'public');
        }

        Admin::create($data);

        return back()->with('success', 'Admin berhasil ditambahkan.');
    }

    public function updateAdmin(Request $request, $id)
    {
        $request->validate([
            'username'     => ['required', 'string', 'max:255'],
            'password'     => ['nullable', 'string', 'min:6'],
            'gambar'       => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $admin = Admin::findOrFail($id);
        $admin->username = $request->username;

        // Jika password diisi, update
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        // Jika upload gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($admin->gambar && Storage::disk('public')->exists($admin->gambar)) {
                Storage::disk('public')->delete($admin->gambar);
            }

            // Simpan gambar baru
            $admin->gambar = $request->file('gambar')->store('admin', 'public');
        }

        $admin->save();

        return back()->with('success', 'Admin berhasil diperbarui.');
    }

    public function destroyAdmin($id)
    {
        $admin = Admin::findOrFail($id);

        if ($admin->gambar && Storage::disk('public')->exists($admin->gambar)) {
            Storage::disk('public')->delete($admin->gambar);
        }

        $admin->delete();

        return back()->with('success', 'Admin berhasil dihapus.');
    }

    public function psikologklinis()
    {
        $psikologklinis = PsikologKlinis::latest()->paginate(10);
        return view('pages.admin.daftar-pengguna.psikolog-klinis', compact('psikologklinis'));
    }

    public function storePsikologKlinis(Request $request)
    {
        $request->validate([
            'nama_lengkap'     => ['required', 'string', 'max:255'],
            'email'            => ['nullable', 'email', 'unique:psikolog_klinis,email'],
            'spesialisasi'     => ['nullable', 'string'],
            'sipp'             => ['nullable', 'string'],
            'biaya_layanan'    => ['nullable', 'numeric'],
            'lokasi_pelayanan' => ['nullable', 'string'],
            'gambar'           => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $data = $request->only([
            'nama_lengkap',
            'email',
            'spesialisasi',
            'sipp',
            'biaya_layanan',
            'lokasi_pelayanan',
        ]);

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('psikolog_klinis', 'public');
            $data['gambar'] = $path;
            $data['gambar_url'] = asset('storage/' . $path);
        }

        PsikologKlinis::create($data);

        return back()->with('success', 'Data psikolog klinis berhasil ditambahkan.');
    }


    public function updatePsikologKlinis(Request $request, $id)
    {
        $request->validate([
            'nama_lengkap'     => ['required', 'string', 'max:255'],
            'email'            => ['nullable', 'email', 'unique:psikolog_klinis,email,' . $id],
            'spesialisasi'     => ['nullable', 'string'],
            'sipp'             => ['nullable', 'string'],
            'biaya_layanan'    => ['nullable', 'numeric'],
            'lokasi_pelayanan' => ['nullable', 'string'],
            'gambar'           => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $psikologklinis = PsikologKlinis::findOrFail($id);
        $psikologklinis->fill($request->only([
            'nama_lengkap',
            'email',
            'spesialisasi',
            'sipp',
            'biaya_layanan',
            'lokasi_pelayanan',
        ]));

        if ($request->hasFile('gambar')) {
            if ($psikologklinis->gambar && Storage::disk('public')->exists($psikologklinis->gambar)) {
                Storage::disk('public')->delete($psikologklinis->gambar);
            }

            $path = $request->file('gambar')->store('psikolog_klinis', 'public');
            $psikologklinis->gambar = $path;
            $psikologklinis->gambar_url = asset('storage/' . $path);
        }

        $psikologklinis->saver->save();

        return back()->with('success', 'Data psikolog klinis berhasil diperbarui.');
    }


    public function destroyPsikologKlinis($id)
    {
        $psikologklinis = PsikologKlinis::findOrFail($id);

        if ($psikologklinis->gambar && Storage::disk('public')->exists($psikologklinis->gambar)) {
            Storage::disk('public')->delete($psikologklinis->gambar);
        }

        $psikologklinis->delete();

        return back()->with('success', 'Data psikolog klinis berhasil dihapus.');
    }

    public function konselor()
    {
        $konselors = Konselor::latest()->paginate(10);
        return view('pages.admin.daftar-pengguna.konselor', compact('konselors'));
    }

    // Simpan konselor baru
    public function storeKonselor(Request $request)
    {
        $request->validate([
            'nama_lengkap'     => ['required', 'string', 'max:255'],
            'username'         => ['nullable', 'string'],
            'email'            => ['nullable', 'email', 'unique:konselor,email'],
            'password'         => ['required', 'string', 'min:6'],
            'spesialisasi'     => ['nullable', 'string'],
            'gambar'           => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $data = $request->only([
            'nama_lengkap',
            'username',
            'email',
            'spesialisasi',
        ]);

        $data['password'] = Hash::make($request->password);

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('konselor', 'public');
            $data['gambar'] = $path;
            $data['gambar_url'] = asset('storage/' . $path);
        }

        Konselor::create($data);

        return back()->with('success', 'Data konselor berhasil ditambahkan.');
    }


    // Update data konselor
    public function updateKonselor(Request $request, $id)
    {
        $request->validate([
            'nama_lengkap'     => ['required', 'string', 'max:255'],
            'username'         => ['nullable', 'string'],
            'email'            => ['nullable', 'email', 'unique:konselor,email,' . $id],
            'password'         => ['nullable', 'string', 'min:6'],
            'spesialisasi'     => ['nullable', 'string'],
            'gambar'           => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $konselor = Konselor::findOrFail($id);

        $konselor->fill($request->only([
            'nama_lengkap',
            'username',
            'email',
            'spesialisasi',
        ]));

        if ($request->filled('password')) {
            $konselor->password = Hash::make($request->password);
        }

        if ($request->hasFile('gambar')) {
            if ($konselor->gambar && Storage::disk('public')->exists($konselor->gambar)) {
                Storage::disk('public')->delete($konselor->gambar);
            }

            $path = $request->file('gambar')->store('konselor', 'public');
            $konselor->gambar = $path;
            $konselor->gambar_url = asset('storage/' . $path);
        }

        $konselor->save();

        return back()->with('success', 'Data konselor berhasil diperbarui.');
    }


    // Hapus konselor
    public function destroyKonselor($id)
    {
        $konselor = Konselor::findOrFail($id);

        if ($konselor->gambar && Storage::disk('public')->exists($konselor->gambar)) {
            Storage::disk('public')->delete($konselor->gambar);
        }

        $konselor->delete();

        return back()->with('success', 'Data konselor berhasil dihapus.');
    }

    public function pengguna()
    {
        $users = User::latest()->paginate(10);
        return view('pages.admin.daftar-pengguna.pengguna', compact('users'));
    }

    public function storePengguna(Request $request)
    {
        $request->validate([
            'nama_lengkap'   => ['nullable', 'string', 'max:255'],
            'username'       => ['required', 'string', 'max:255', 'unique:users,username'],
            'email'          => ['required', 'email', 'unique:users,email'],
            'password'       => ['required', 'string', 'min:6'],
            'tanggal_lahir'  => ['nullable', 'date'],
            'jenis_kelamin'  => ['nullable', 'in:L,P'],
            'gambar'         => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $data = $request->only([
            'nama_lengkap',
            'username',
            'email',
            'tanggal_lahir',
            'jenis_kelamin',
        ]);

        $data['password'] = Hash::make($request->password);

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('pengguna', 'public');
            $data['gambar'] = $path;
            $data['gambar_url'] = asset('storage/' . $path);
        }

        User::create($data);

        return back()->with('success', 'Data pengguna berhasil ditambahkan.');
    }


    public function updatePengguna(Request $request, $id)
    {
        $request->validate([
            'nama_lengkap'   => ['nullable', 'string', 'max:255'],
            'username'       => ['required', 'string', 'max:255', 'unique:users,username,' . $id],
            'email'          => ['required', 'email', 'unique:users,email,' . $id],
            'password'       => ['nullable', 'string', 'min:6'],
            'tanggal_lahir'  => ['nullable', 'date'],
            'jenis_kelamin'  => ['nullable', 'in:L,P'],
            'gambar'         => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $user = User::findOrFail($id);

        $user->fill($request->only([
            'nama_lengkap',
            'username',
            'email',
            'tanggal_lahir',
            'jenis_kelamin',
        ]));

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('gambar')) {
            if ($user->gambar && Storage::disk('public')->exists($user->gambar)) {
                Storage::disk('public')->delete($user->gambar);
            }

            $path = $request->file('gambar')->store('pengguna', 'public');
            $user->gambar = $path;
            $user->gambar_url = asset('storage/' . $path);
        }

        $user->save();

        return back()->with('success', 'Data pengguna berhasil diperbarui.');
    }


    public function destroyPengguna($id)
    {
        $user = User::findOrFail($id);

        if ($user->gambar && Storage::disk('public')->exists($user->gambar)) {
            Storage::disk('public')->delete($user->gambar);
        }

        $user->delete();

        return back()->with('success', 'Data pengguna berhasil dihapus.');
    }
}
