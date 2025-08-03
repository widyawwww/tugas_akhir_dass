<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InstrumenTes;
use App\Models\OpsiJawaban;

class OpsiJawabanSeeder extends Seeder
{
    public function run()
    {
        $opsiDass21 = [
            ['teks' => 'Tidak pernah', 'skor' => 0],
            ['teks' => 'Kadang-kadang', 'skor' => 1],
            ['teks' => 'Sering', 'skor' => 2],
            ['teks' => 'Hampir selalu', 'skor' => 3],
        ];

        // Buat opsi jawaban untuk DASS-21 (ID = 1)
        foreach ($opsiDass21 as $o) {
            OpsiJawaban::create([
                'instrumen_tes_id' => 1,
                'teks_opsi' => $o['teks'],
                'skor' => $o['skor'],
            ]);
        }

        $opsiBAI = [
            ['teks' => 'Tidak sama sekali', 'skor' => 0],
            ['teks' => 'Ringan, tetapi tidak mengganggu', 'skor' => 1],
            ['teks' => 'Sedang, tidak menyenangkan', 'skor' => 2],
            ['teks' => 'Berat, sangat mengganggu', 'skor' => 3],
        ];

        foreach ($opsiBAI as $o) {
            OpsiJawaban::create([
                'instrumen_tes_id' => 3, // ID untuk BAI
                'teks_opsi' => $o['teks'],
                'skor' => $o['skor'],
            ]);
        }

        // Opsi jawaban PSS-10
        $opsiPss = [
            ['teks' => 'Tidak pernah', 'skor' => 0],
            ['teks' => 'Hampir tidak pernah', 'skor' => 1],
            ['teks' => 'Kadang-kadang', 'skor' => 2],
            ['teks' => 'Cukup sering', 'skor' => 3],
            ['teks' => 'Terlalu sering', 'skor' => 4],
        ];

        // Buat opsi jawaban untuk PSS (instrumen_tes_id = 4)
        foreach ($opsiPss as $o) {
            OpsiJawaban::create([
                'instrumen_tes_id' => 4,
                'teks_opsi' => $o['teks'],
                'skor' => $o['skor'],
            ]);
        }
    }
}
