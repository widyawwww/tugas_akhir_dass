<?php

namespace App\Http\Controllers\WEB\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PesanKonsultasiPsikiater;

class PemesananPsikiaterController extends Controller
{
    public function index()
    {
        $data = PesanKonsultasiPsikiater::with(['pengguna', 'psikiater', 'slotJam.jam'])->get();

        return view('pages.admin.pemesanan-psikiater.index', compact('data'));
    }
}
