<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Models\User;
use App\Models\Admin;
use App\Models\Konselor;
use App\Models\Psikiater;
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

    public function psikiater()
    {
        $psikiaters = Psikiater::latest()->paginate(10);
        return view('pages.admin.daftar-pengguna.psikiater', compact('psikiaters'));
    }

    public function storePsikiater(Request $request)
    {
        $request->validate([
            'nama_lengkap'     => ['required', 'string', 'max:255'],
            'email'            => ['nullable', 'email', 'unique:psikiater,email'],
            'spesialisasi'     => ['nullable', 'string'],
            'nomor_lisensi'    => ['nullable', 'string'],
            'biaya_layanan'    => ['nullable', 'numeric'],
            'lokasi_pelayanan' => ['nullable', 'string'],
            'gambar'           => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $data = $request->only([
            'nama_lengkap',
            'email',
            'spesialisasi',
            'nomor_lisensi',
            'biaya_layanan',
            'lokasi_pelayanan',
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('psikiater', 'public');
        }

        Psikiater::create($data);

        return back()->with('success', 'Data psikiater berhasil ditambahkan.');
    }

    public function updatePsikiater(Request $request, $id)
    {
        $request->validate([
            'nama_lengkap'     => ['required', 'string', 'max:255'],
            'email'            => ['nullable', 'email', 'unique:psikiater,email,' . $id],
            'spesialisasi'     => ['nullable', 'string'],
            'nomor_lisensi'    => ['nullable', 'string'],
            'biaya_layanan'    => ['nullable', 'numeric'],
            'lokasi_pelayanan' => ['nullable', 'string'],
            'gambar'           => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $psikiater = Psikiater::findOrFail($id);
        $psikiater->fill($request->only([
            'nama_lengkap',
            'email',
            'spesialisasi',
            'nomor_lisensi',
            'biaya_layanan',
            'lokasi_pelayanan',
        ]));

        if ($request->hasFile('gambar')) {
            if ($psikiater->gambar && Storage::disk('public')->exists($psikiater->gambar)) {
                Storage::disk('public')->delete($psikiater->gambar);
            }

            $psikiater->gambar = $request->file('gambar')->store('psikiater', 'public');
        }

        $psikiater->save();

        return back()->with('success', 'Data psikiater berhasil diperbarui.');
    }

    public function destroyPsikiater($id)
    {
        $psikiater = Psikiater::findOrFail($id);

        if ($psikiater->gambar && Storage::disk('public')->exists($psikiater->gambar)) {
            Storage::disk('public')->delete($psikiater->gambar);
        }

        $psikiater->delete();

        return back()->with('success', 'Data psikiater berhasil dihapus.');
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
            'tanggal_lahir'    => ['nullable', 'date'],
            'jenis_kelamin'    => ['nullable', 'in:L,P'],
            'spesialisasi'     => ['nullable', 'string'],
            'nomor_lisensi'    => ['nullable', 'string'],
            'gambar'           => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $data = $request->only([
            'nama_lengkap',
            'username',
            'email',
            'tanggal_lahir',
            'jenis_kelamin',
            'spesialisasi',
            'nomor_lisensi',
        ]);

        $data['password'] = Hash::make($request->password);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('konselor', 'public');
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
            'tanggal_lahir'    => ['nullable', 'date'],
            'jenis_kelamin'    => ['nullable', 'in:L,P'],
            'spesialisasi'     => ['nullable', 'string'],
            'nomor_lisensi'    => ['nullable', 'string'],
            'gambar'           => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $konselor = Konselor::findOrFail($id);

        $konselor->fill($request->only([
            'nama_lengkap',
            'username',
            'email',
            'tanggal_lahir',
            'jenis_kelamin',
            'spesialisasi',
            'nomor_lisensi',
        ]));

        if ($request->filled('password')) {
            $konselor->password = Hash::make($request->password);
        }

        if ($request->hasFile('gambar')) {
            if ($konselor->gambar && Storage::disk('public')->exists($konselor->gambar)) {
                Storage::disk('public')->delete($konselor->gambar);
            }
            $konselor->gambar = $request->file('gambar')->store('konselor', 'public');
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
            $data['gambar'] = $request->file('gambar')->store('pengguna', 'public');
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

            $user->gambar = $request->file('gambar')->store('pengguna', 'public');
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
