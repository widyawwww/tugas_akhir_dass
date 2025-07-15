<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Models\Tips;
use App\Models\Artikel;
use App\Models\Konselor;
use App\Models\Psikiater;
use App\Models\InstrumenTes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahPsikiater = Psikiater::count();
        $jumlahKonselor = Konselor::count();
        $jumlahTips = Tips::count();
        $jumlahArtikel = Artikel::count();
        $jumlahTes = InstrumenTes::count();

        return view('pages.admin.dashboard.index', compact(
            'jumlahPsikiater',
            'jumlahKonselor',
            'jumlahTips',
            'jumlahArtikel',
            'jumlahTes'
        ));
    }
}
