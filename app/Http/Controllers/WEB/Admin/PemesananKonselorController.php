<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use App\Models\PesanKonsultasiKonselor;

class PemesananKonselorController extends Controller
{
    public function index()
    {
        $data = PesanKonsultasiKonselor::with(['pengguna', 'konselor', 'slotJam.jam'])->get();
        return view('pages.admin.pemesanan-konselor.index', compact('data'));
    }
}

