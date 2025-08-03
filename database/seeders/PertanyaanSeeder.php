<?php

namespace Database\Seeders;

use App\Models\Subskala;
use App\Models\Pertanyaan;
use Illuminate\Database\Seeder;

class PertanyaanSeeder extends Seeder
{
    public function run()
    {
        //Subskala berdasarkan nama
        $subskalaDepresi = Subskala::where('nama', 'Depresi')->first()->id;
        $subskalaKecemasan = Subskala::where('nama', 'Kecemasan')->first()->id;
        $subskalaStres = Subskala::where('nama', 'Stres')->first()->id;

        $pertanyaanDass21 = [
            // Depresi
            ['teks' => 'Saya tidak bisa melihat hal positif apa pun untuk dinantikan',  'subskala_id' => 1],
            ['teks' => 'Saya merasa sulit untuk bekerja dan berinisiatif',  'subskala_id' => 1],
            ['teks' => 'Saya merasa tidak ada yang berharga dalam hidup saya',  'subskala_id' => 1],
            ['teks' => 'Saya merasa diri saya tidak berharga',  'subskala_id' => 1],
            ['teks' => 'Saya tidak dapat merasakan antusiasme sama sekali',  'subskala_id' => 1],
            ['teks' => 'Saya merasa sedih dan tertekan',  'subskala_id' => 1],
            ['teks' => 'Saya merasa hidup ini tidak berarti',  'subskala_id' => 1],
            // Kecemasan
            ['teks' => 'Saya menyadari mulut saya terasa kering',  'subskala_id' => 2],
            ['teks' => 'Saya mengalami kesulitan bernapas (misalnya, napas yang cepat, sesak napas tanpa aktivitas fisik)', 'subskala_id' => 2],
            ['teks' => 'Saya mengalami gemetar (misalnya, di tangan)',  'subskala_id' => 2],
            ['teks' => 'Saya khawatir tentang situasi di mana saya mungkin panik dan mempermalukan diri sendiri', 'subskala_id' => 2],
            ['teks' => 'Saya merasa dekat dengan kepanikan',  'subskala_id' => 2],
            ['teks' => 'Saya sadar akan detak jantung saya tanpa adanya aktivitas fisik (misalnya, peningkatan detak jantung, detak jantung yang terlewat)',  'subskala_id' => 2],
            ['teks' => 'Saya merasa takut tanpa alasan yang jelas',  'subskala_id' => 2],
            // Stres
            ['teks' => 'Saya merasa sulit untuk bersantai', 'subskala_id' => 3],
            ['teks' => 'Saya cenderung bereaksi berlebihan terhadap situasi',  'subskala_id' => 3],
            ['teks' => 'Saya merasa sangat gelisah',  'subskala_id' => 3],
            ['teks' => 'Saya merasa sulit untuk beristirahat', 'subskala_id' => 3],
            ['teks' => 'Saya tidak sabaran', 'subskala_id' => 3],
            ['teks' => 'Saya merasa mudah tersinggung', 'subskala_id' => 3],
            ['teks' => 'Saya merasa bahwa saya menggunakan banyak energi saraf',  'subskala_id' => 3],

        ];

        foreach ($pertanyaanDass21 as $p) {
            Pertanyaan::create([
                'instrumen_tes_id' => 1, // ID untuk DASS-21
                'teks_pertanyaan' => $p['teks'],
                // 'urutan' => $p['urutan'],
                'subskala_id' => $p['subskala_id'],
            ]);
        }

        $pertanyaanBDI = [
            'Kesedihan',
            'Pesimistik',
            'Kegagalan masa lalu',
            'Kehilangan kesenangan',
            'Perasaan bersalah',
            'Perasaan merasa dihukum',
            'Benci diri sendiri',
            'Pengkritikan terhadap diri sendiri',
            'Pikiran atau keinginan bunuh diri',
            'Menangis',
            'Tidak bisa istirahat',
            'Kehilangan minat',
            'Keragu-raguan',
            'Ketidak-berartian',
            'Kehilangan energi',
            'Perubahan pola dalam tidur',
            'Mudah tersinggung',
            'Perubahan dalam selera makan',
            'Kesulitan berkonsentrasi',
            'Capek atau lelah',
            'Kehilangan minat seks',
        ];

        foreach ($pertanyaanBDI as $urutan => $teks) {
            Pertanyaan::create([
                'instrumen_tes_id' => 2, // ID BDI-II
                'subskala_id' => $subskalaDepresi, // subskala 'Depresi'
                'teks_pertanyaan'  => $teks,
            ]);
        }

        $pertanyaanBAI = [
            'Mati rasa atau kesemutan',
            'Merasa panas',
            'Kaki lemas atau goyah',
            'Tidak bisa santai',
            'Takut akan hal terburuk yang terjadi',
            'Pusing atau kepala terasa ringan',
            'Jantung berdebar kencang',
            'Lunglai',
            'ketakutan atau takut',
            'Gugup',
            'Perasaan tersedak',
            'Tangan gemetar',
            'Badan goyah atau limbung',
            'Takut kehilangan kendali',
            'Sulit bernafas',
            'Takut mati atau takut akan kematian',
            'Takut',
            'Gangguan pencernaan',
            'Pingsan',
            'Wajah merah',
            'Keringat panas atau dingin',
        ];

        foreach ($pertanyaanBAI as $teks) {
            Pertanyaan::create([
                'instrumen_tes_id' => 3, // ID BAI
                'subskala_id' => $subskalaKecemasan,
                'teks_pertanyaan' => $teks,
            ]);
        }

        $pertanyaanPSS = [
            'Pada bulan lalu, seberapa sering Anda menjadi bingung karena sesuatu yang terjadi secara tiba-tiba?',
            'Pada bulan lalu, seberapa sering Anda telah merasa tidak mampu untuk mengendalikan hal-hal yang penting dalam kehidupan Anda?',
            'Pada bulan lalu, seberapa sering Anda merasa gugup atau stres?',
            'Pada bulan lalu, seberapa sering Anda merasa yakin akan kemampuan Anda untuk menangani masalah pribadi?',
            'Pada bulan lalu, seberapa sering Anda telah merasa bahwa segala sesuatunya berjalan lancar?',
            'Pada bulan lalu, seberapa sering Anda telah merasa bahwa Anda tidak bisa mengatasi semua hal yang harus Anda lakukan?',
            'Pada bulan lalu, seberapa sering Anda telah merasa telah mampu mengendalikan hal-hal yang menyakitkan dalam hidup Anda?',
            'Pada bulan lalu, seberapa sering Anda merasakan bahwa Anda sangat bahagia dan sukses?',
            'Pada bulan lalu, seberapa sering Anda telah merasakan marah karena sesuatu yang terjadi di luar kendali Anda?',
            'Pada bulan lalu, seberapa sering Anda merasakan bahwa kesulitan-kesulitan menumpuk sebegitu tingginya sehingga Anda tidak bisa mengatasinya?',
        ];

        foreach ($pertanyaanPSS as $teks) {
            Pertanyaan::create([
                'instrumen_tes_id' => 4, // Asumsikan ID PSS adalah 4
                'subskala_id' => $subskalaStres,
                'teks_pertanyaan' => $teks,
            ]);
        }
    }
}
