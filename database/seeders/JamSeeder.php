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
            // Sesi pagi (sebelumnya untuk Rabu & Sabtu, sekarang tanpa hari)
            ['jam_mulai' => '09:00:00', 'jam_selesai' => '10:00:00'],
            ['jam_mulai' => '10:00:00', 'jam_selesai' => '11:00:00'],
            ['jam_mulai' => '11:00:00', 'jam_selesai' => '12:00:00'],
            ['jam_mulai' => '12:00:00', 'jam_selesai' => '13:00:00'],
            ['jam_mulai' => '13:00:00', 'jam_selesai' => '14:00:00'],

            // Sesi sore (sebelumnya untuk Selasa & Kamis)
            ['jam_mulai' => '15:00:00', 'jam_selesai' => '16:00:00'],
            ['jam_mulai' => '16:00:00', 'jam_selesai' => '17:00:00'],
            ['jam_mulai' => '17:00:00', 'jam_selesai' => '18:00:00'],

            // Sesi malam (sebelumnya untuk hari kerja)
            ['jam_mulai' => '17:30:00', 'jam_selesai' => '18:00:00'],
            ['jam_mulai' => '18:00:00', 'jam_selesai' => '18:30:00'],
            ['jam_mulai' => '18:30:00', 'jam_selesai' => '19:00:00'],
            ['jam_mulai' => '19:00:00', 'jam_selesai' => '19:30:00'],
            ['jam_mulai' => '19:30:00', 'jam_selesai' => '20:00:00'],
            ['jam_mulai' => '20:00:00', 'jam_selesai' => '20:30:00'],
            ['jam_mulai' => '20:30:00', 'jam_selesai' => '21:00:00'],
            ['jam_mulai' => '21:00:00', 'jam_selesai' => '21:30:00'],
            ['jam_mulai' => '21:30:00', 'jam_selesai' => '22:00:00'],
        ];

        foreach ($jamList as $jam) {
            DB::table('jam')->insert([
                'jam_mulai'   => $jam['jam_mulai'],
                'jam_selesai' => $jam['jam_selesai'],
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ]);
        }
    }
}