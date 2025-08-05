<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PsikologKlinis;

class PsikologKlinisSeeder extends Seeder
{
    public function run(): void
    {
        PsikologKlinis::insert([
            [
                'nama_lengkap'      => 'Dra. Psi. Yulia Indarsih',
                'spesialisasi'      => 'Psikolog Klinis',
                'sipp'              => '20210189',
                'biaya_layanan'     => 250000.00,
                'lokasi_pelayanan'  => 'Klinik Utama Bunda Nanda, Bandung',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
        ]);
    }
}
