<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class JamSeeder extends Seeder
{
    public function run(): void
    {
        $jamList = [
            // Rabu & Sabtu
            ['jam_mulai' => '09:00:00', 'jam_selesai' => '10:00:00', 'hari' => 'Rabu'],
            ['jam_mulai' => '10:00:00', 'jam_selesai' => '11:00:00', 'hari' => 'Rabu'],
            ['jam_mulai' => '11:00:00', 'jam_selesai' => '12:00:00', 'hari' => 'Rabu'],
            ['jam_mulai' => '12:00:00', 'jam_selesai' => '13:00:00', 'hari' => 'Rabu'],
            ['jam_mulai' => '13:00:00', 'jam_selesai' => '14:00:00', 'hari' => 'Rabu'],

            ['jam_mulai' => '09:00:00', 'jam_selesai' => '10:00:00', 'hari' => 'Sabtu'],
            ['jam_mulai' => '10:00:00', 'jam_selesai' => '11:00:00', 'hari' => 'Sabtu'],
            ['jam_mulai' => '11:00:00', 'jam_selesai' => '12:00:00', 'hari' => 'Sabtu'],
            ['jam_mulai' => '12:00:00', 'jam_selesai' => '13:00:00', 'hari' => 'Sabtu'],
            ['jam_mulai' => '13:00:00', 'jam_selesai' => '14:00:00', 'hari' => 'Sabtu'],

            // Selasa & Kamis
            ['jam_mulai' => '15:00:00', 'jam_selesai' => '16:00:00', 'hari' => 'Selasa'],
            ['jam_mulai' => '16:00:00', 'jam_selesai' => '17:00:00', 'hari' => 'Selasa'],
            ['jam_mulai' => '17:00:00', 'jam_selesai' => '18:00:00', 'hari' => 'Selasa'],

            ['jam_mulai' => '15:00:00', 'jam_selesai' => '16:00:00', 'hari' => 'Kamis'],
            ['jam_mulai' => '16:00:00', 'jam_selesai' => '17:00:00', 'hari' => 'Kamis'],
            ['jam_mulai' => '17:00:00', 'jam_selesai' => '18:00:00', 'hari' => 'Kamis'],
        ];

        $malamSessions = [
            ['17:30:00', '18:00:00'],
            ['18:00:00', '18:30:00'],
            ['18:30:00', '19:00:00'],
            ['19:00:00', '19:30:00'],
            ['19:30:00', '20:00:00'],
            ['20:00:00', '20:30:00'],
            ['20:30:00', '21:00:00'],
            ['21:00:00', '21:30:00'],
            ['21:30:00', '22:00:00'],
        ];

        $hariKerja = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];

        foreach ($hariKerja as $hari) {
            foreach ($malamSessions as [$mulai, $selesai]) {
                $jamList[] = [
                    'jam_mulai' => $mulai,
                    'jam_selesai' => $selesai,
                    'hari' => $hari,
                ];
            }
        }

        foreach ($jamList as $jam) {
            DB::table('jam')->insert([
                'hari'        => $jam['hari'],
                'jam_mulai'   => $jam['jam_mulai'],
                'jam_selesai' => $jam['jam_selesai'],
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ]);
        }
    }
}
