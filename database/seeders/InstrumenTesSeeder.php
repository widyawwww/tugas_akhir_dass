<?php

namespace Database\Seeders;

use App\Models\InstrumenTes;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class InstrumenTesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        InstrumenTes::create([
            'id' => 1, // DASS-21 => HARUS 1 supaya cocok dengan SubskalaSeeder
            'nama' => 'DASS-21',
            'pembuat' => 'Lovibond & Lovibond',
            'tahun' => 1995,
            'deskripsi' => 'Depression Anxiety Stress Scales 21 (DASS-21) adalah serangkaian skala penilaian diri yang dirancang untuk mengukur tiga keadaan emosional negatif: depresi, kecemasan, dan stres.',
        ]);

        InstrumenTes::create([
            'id' => 2, // BDI-II
            'nama' => 'BDI-II',
            'pembuat' => 'Aaron T. Beck',
            'tahun' => 1996,
            'deskripsi' => 'Beck Depression Inventory II (BDI-II) adalah instrumen yang banyak digunakan untuk mengukur tingkat keparahan depresi.',
        ]);

        InstrumenTes::create([
            'id' => 3, // BAI
            'nama' => 'BAI',
            'pembuat' => 'Aaron T. Beck',
            'tahun' => 1988,
            'deskripsi' => 'Beck Anxiety Inventory (BAI) adalah alat penilaian diri yang dikembangkan oleh Aaron T. Beck pada tahun 1988 untuk mengukur tingkat keparahan gejala kecemasan pada orang dewasa.',
        ]);

        InstrumenTes::create([
            'id' => 4, // PSS-10
            'nama' => 'PSS-10',
            'pembuat' => 'Sheldon Cohen',
            'tahun' => 1983,
            'deskripsi' => 'Perceived Stress Scale (PSS-10) adalah alat ukur yang dikembangkan oleh Sheldon Cohen untuk menilai sejauh mana individu menilai situasi dalam kehidupannya sebagai sesuatu yang menegangkan secara psikologis.',
        ]);
    }
}
