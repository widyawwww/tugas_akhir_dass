<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subskala;

class SubskalaSeeder extends Seeder
{
    public function run()
    {
        // Subskala untuk DASS-21 (id = 1)
        Subskala::create(['instrumen_tes_id' => 1, 'nama' => 'Depresi']);
        Subskala::create(['instrumen_tes_id' => 1, 'nama' => 'Kecemasan']);
        Subskala::create(['instrumen_tes_id' => 1, 'nama' => 'Stres']);

        // Subskala untuk BDI-II (id = 2)
        Subskala::create(['instrumen_tes_id' => 2, 'nama' => 'Depresi']);

        // Subskala untuk BAI (id = 3)
        Subskala::create(['instrumen_tes_id' => 3, 'nama' => 'Kecemasan']);

        // Subskala untuk PSS-10 (id = 4)
        Subskala::create(['instrumen_tes_id' => 4, 'nama' => 'Stres Persepsi']);
    }
}
