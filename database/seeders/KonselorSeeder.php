<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Konselor;

class KonselorSeeder extends Seeder
{
    public function run(): void
    {
        Konselor::insert([
            [
                'nama_lengkap'          => 'Mochammad Irgia Mukti, S.Psi',
                'username'              => 'irgi.konselor',
                'email'                 => 'irgi@gmail.com',
                'email_verified_at'     => now(),
                'password'              => Hash::make('konselorirgi'), // ganti sesuai kebutuhan
                'spesialisasi'          => 'Konselor',
                'remember_token'        => null,
                'created_at'            => now(),
                'updated_at'            => now(),
            ],
            [
                'nama_lengkap'          => 'Aldela Silmi, S.Psi',
                'username'              => 'aldela.konselor',
                'email'                 => 'aldela@gmail.com',
                'email_verified_at'     => now(),
                'password'              => Hash::make('konseloraldela'),
                'spesialisasi'          => 'Konselor',
                'remember_token'        => null,
                'created_at'            => now(),
                'updated_at'            => now(),
            ],
            [
                'nama_lengkap'          => 'Hanifa Khoirunnisa Azahra, S.Psi',
                'username'              => 'hanifa.konselor',
                'email'                 => 'hanifa@gmail.com',
                'email_verified_at'     => now(),
                'password'              => Hash::make('konselorhanifa'),
                'spesialisasi'          => 'Konselor',
                'remember_token'        => null,
                'created_at'            => now(),
                'updated_at'            => now(),
            ],
        ]);
    }
}
