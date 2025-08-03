<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OpsiJawabanPertanyaan;

class OpsiJawabanPertanyaanSeeder extends Seeder
{
    public function run()
    {
        $opsiBdi = [
            22 => [
                ['teks' => 'Saya tidak merasa sedih', 'skor' => 0],
                ['teks' => 'Saya sering kali merasa sedih', 'skor' => 1],
                ['teks' => 'Saya merasa sedih sepanjang waktu', 'skor' => 2],
                ['teks' => 'Saya merasa sangat tidak bahagia atau sedih sampai tidak tertahankan', 'skor' => 3],
            ],
            23 => [
                ['teks' => 'Saya tidak meragukan masa depan saya', 'skor' => 0],
                ['teks' => 'Saya merasa lebih meragukan masa depan saya dibanding biasanya', 'skor' => 1],
                ['teks' => 'Saya merasa segala sesuatu tidak berjalan dengan baik bagi saya', 'skor' => 2],
                ['teks' => 'Saya merasa masa depan saya tidak ada harapan dan akan semakin buruk', 'skor' => 3],
            ],
            24 => [
                ['teks' => 'Saya tidak merasa gagal', 'skor' => 0],
                ['teks' => 'Saya telah  gagal lebih dari yang seharusnya', 'skor' => 1],
                ['teks' => 'Saya melakukan banyak kegagalan di masa lalu', 'skor' => 2],
                ['teks' => 'Saya merasa gagal sama sekali (betul-betul gagal)', 'skor' => 3],
            ],
            25 => [
                ['teks' => 'Saya mendapatkan kesenangan dari hal-hal yang saya lakukan', 'skor' => 0],
                ['teks' => 'Saya tidak menikmati sesuatu seperti biasanya', 'skor' => 1],
                ['teks' => 'Saya hanya mendapatkan sangat sedikit kesenangan dari hal-hal yang biasanya bisa saya nikmati', 'skor' => 2],
                ['teks' => 'Saya tidak mendapatkan kesenangan sama sekali dari hal-hal yang biasanya bisa saya nikmati', 'skor' => 3],
            ],
            26 => [
                ['teks' => 'Saya sama sekali tidak merasa bersalah', 'skor' => 0],
                ['teks' => 'Saya merasa bersalah atas banyak hal yang telah atau seharusnya saya lakukan', 'skor' => 1],
                ['teks' => 'Saya sering merasa bersalah', 'skor' => 2],
                ['teks' => 'Saya merasa bersalah setiap saat', 'skor' => 3],
            ],
            27 => [
                ['teks' => 'Saya tidak merasa bahwa saya sedang dihukum', 'skor' => 0],
                ['teks' => 'Saya merasa bahwa mungkin saya akan dihukum', 'skor' => 1],
                ['teks' => 'Saya yakin bahwa saya akan dihukum', 'skor' => 2],
                ['teks' => 'Saya merasa bahwa saya sedang dihukum', 'skor' => 3],
            ],
            28 => [
                ['teks' => 'Saya tidak merasa kecewa pada diri sendiri', 'skor' => 0],
                ['teks' => 'Saya kehilangan kepercayaan pada diri sendiri', 'skor' => 1],
                ['teks' => 'Saya merasa kecewa pada diri sendiri', 'skor' => 2],
                ['teks' => 'Saya benci pada diri sendiri', 'skor' => 3],
            ],
            29 => [
                ['teks' => 'Saya tidak mengkritik atau menyalahkan diri sendiri lebih dari biasanya', 'skor' => 0],
                ['teks' => 'Saya mengkritik diri sendiri lebih dari biasanya', 'skor' => 1],
                ['teks' => 'Saya mengkritik diri sendiri atas semua kesalahan yang saya lakukan', 'skor' => 2],
                ['teks' => 'Saya menyalahkan diri sendiri untuk semua hal-hal buruk yang terjadi', 'skor' => 3],
            ],
            30 => [
                ['teks' => 'Saya tidak berpikir untuk bunuh diri', 'skor' => 0],
                ['teks' => 'Saya berpikir untuk bunuh diri, tetapi hal itu tidak akan saya lakukan', 'skor' => 1],
                ['teks' => 'Saya ingin bunuh diri', 'skor' => 2],
                ['teks' => 'Saya akan bunuh diri seandainya ada kesempatan', 'skor' => 3],
            ],
            31 => [
                ['teks' => 'Saya tidak menangis lagi seperti biasanya', 'skor' => 0],
                ['teks' => 'Saya lebih sering menangis dibanding biasanya', 'skor' => 1],
                ['teks' => 'Saya menangis bahkan untuk masalah masalah kecil', 'skor' => 2],
                ['teks' => 'Rasanya saya ingin sekali menangis tetapi tidak bisa', 'skor' => 3],
            ],
            32 => [
                ['teks' => 'Saya tidak lagi merasa gelisah atau tertekan dibandingkan biasanya', 'skor' => 0],
                ['teks' => 'Saya merasa lebih mudah gelisah atau tertekan dibanding biasanya', 'skor' => 1],
                ['teks' => 'Saya sangat tertekan dan gelisah sampai  sulit untuk berdiam diri', 'skor' => 2],
                ['teks' => 'Saya sangat gelisah sehingga harus senantiasa bergerak atau melakukan sesuatu', 'skor' => 3],
            ],
            33 => [
                ['teks' => 'Saya tidak kehilangan minat untuk berelasi dengan orang lain atau melakukan aktivitas', 'skor' => 0],
                ['teks' => 'Saya kurang berminat untuk berelasi dengan orang lain atau terhadap sesuatu dibandingkan biasanya', 'skor' => 1],
                ['teks' => 'Saya kehilangan hampir seluruh minat saya untuk berelasi dengan orang lain atau terhadap sesuatu', 'skor' => 2],
                ['teks' => 'Saya tidak berminat akan apapun', 'skor' => 3],
            ],
            34 => [
                ['teks' => 'Saya dapat mengambil keputusan sebagaimana yang biasanya saya lakukan', 'skor' => 0],
                ['teks' => 'Saya agak sulit mengambil keputusan dibanding biasanya', 'skor' => 1],
                ['teks' => 'Saya lebih banyak mengalami kesulitan dalam mengambil keputusan dibanding biasanya', 'skor' => 2],
                ['teks' => 'Saya sangat mengalami kesulitan setiap kali  mengambil keputusan', 'skor' => 3],
            ],
            35 => [
                ['teks' => 'Saya merasa layak', 'skor' => 0],
                ['teks' => 'Saya merasa tidak layak dan tidak berguna dibandingkan biasanya', 'skor' => 1],
                ['teks' => 'Saya merasa lebih tidak layak dibanding orang lain', 'skor' => 2],
                ['teks' => 'Saya merasa sama sekali tidak layak', 'skor' => 3],
            ],
            36 => [
                ['teks' => 'Saya memiliki tenaga (semangat) seperti biasanya', 'skor' => 0],
                ['teks' => 'Saya memiliki tenaga lebih sedikit dibanding yang seharusnya saya miliki', 'skor' => 1],
                ['teks' => 'Saya tidak memiliki tenaga yang cukup untuk berbuat banyak', 'skor' => 2],
                ['teks' => 'Saya tidak memiliki tenaga yang cukup untuk melakukan apapun', 'skor' => 3],
            ],
            37 => [ // Perubahan pola tidur
                ['teks' => 'Saya tidak mengalami perubahan apapun dalam pola tidur saya', 'skor' => 0],
                ['teks' => 'Saya tidur lebih dari biasanya', 'skor' => 1],
                ['teks' => 'Saya tidur kurang dari biasanya', 'skor' => 1],
                ['teks' => 'Saya tidur jauh lebih lama dari biasanya', 'skor' => 2],
                ['teks' => 'Saya tidur sangat kurang dari biasanya', 'skor' => 2],
                ['teks' => 'Saya tidur hampir sepanjang hari', 'skor' => 3],
                ['teks' => 'Saya bangun 1-2 jam lebih awal dan tidak dapat tidur kembali', 'skor' => 3],
            ],
            38 => [
                ['teks' => 'Saya tidak lebih mudah marah seperti biasanya', 'skor' => 0],
                ['teks' => 'Saya lebih mudah marah dibanding biasanya', 'skor' => 1],
                ['teks' => 'Saya jauh lebih mudah marah dibanding biasanya', 'skor' => 2],
                ['teks' => 'Saya mudah marah sepanjang waktu', 'skor' => 3],
            ],
            39 => [ // Perubahan selera makan
                ['teks' => 'Selera makan saya tidak berubah (tidak lebih buruk) dari biasanya', 'skor' => 0],
                ['teks' => 'Selera makan saya kurang dari biasanya', 'skor' => 1],
                ['teks' => 'Selera makan saya lebih dari biasanya', 'skor' => 1],
                ['teks' => 'Selera makan saya sangat kurang dibanding biasanya', 'skor' => 2],
                ['teks' => 'Selera makan saya sangat lebih dibanding biasanya', 'skor' => 2],
                ['teks' => 'Saya tidak punya selera makan sama sekali', 'skor' => 3],
                ['teks' => 'Saya ingin makan setiap waktu', 'skor' => 3],
            ],
            40 => [
                ['teks' => 'Saya mampu berkonsentrasi seperti biasanya', 'skor' => 0],
                ['teks' => 'Saya tidak mampu berkonsentrasi seperti biasanya', 'skor' => 1],
                ['teks' => 'Saya sangat sulit untuk tetap memusatkan pikiran terhadap sesuatu dalam jangka waktu yang panjang', 'skor' => 2],
                ['teks' => 'Saya merasa saya tidak mampu berkonsentrasi dalam semua hal', 'skor' => 3],
            ],
            41 => [
                ['teks' => 'Saya tidak lebih capek atau lelah dibanding biasanya', 'skor' => 0],
                ['teks' => 'Saya lebih mudah capek atau lelah dari biasanya', 'skor' => 1],
                ['teks' => 'Saya merasa capek atau lelah untuk melakukan banyak hal yang biasanya saya lakukan', 'skor' => 2],
                ['teks' => 'Saya terlalu capek atau lelah untuk melakukan hampir semua hal yang biasanya saya lakukan', 'skor' => 3],
            ],
            42 => [
                ['teks' => 'Saya tidak melihat adanya perubahan pada gairah seksual saya', 'skor' => 0],
                ['teks' => 'Gairah seksual saya berkurang, tidak seperti biasanya', 'skor' => 1],
                ['teks' => 'Saya menjadi sangat kurang berminat pada aktivitas seksual saat ini', 'skor' => 2],
                ['teks' => 'Gairah seksual saya hilang sama sekali', 'skor' => 3],
            ],
        ];

        foreach ($opsiBdi as $pertanyaanId => $opsiList) {
            foreach ($opsiList as $opsi) {
                OpsiJawabanPertanyaan::create([
                    'pertanyaan_id' => $pertanyaanId,
                    'teks_opsi'     => $opsi['teks'],
                    'skor'          => $opsi['skor'],
                ]);
            }
        }
    }
}
