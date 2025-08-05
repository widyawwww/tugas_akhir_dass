<?php

namespace App\Http\Controllers\Api;

use App\Models\PsikologKlinis;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PsikologKlinisController extends Controller
{
    public function index()
    {
        $psikologklinis = PsikologKlinis::all();

        if ($psikologklinis->isEmpty()) {
            return response()->json(['message' => 'Data psikolog klinis tidak ditemukan.'], 404);
        }

        return response()->json([
            'psikolog_klinis' => $psikologklinis,
        ]);
    }

}
