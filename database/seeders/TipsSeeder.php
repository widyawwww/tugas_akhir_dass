<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tips;

class TipsSeeder extends Seeder
{
    public function run(): void
    {
        Tips::create([
            'nama' => 'Tips Mengatasi Depresi',
            'deskripsi_singkat' => 'Beberapa tips sederhana yang dapat membantu mengelola dan mengatasi depresi.',
            'daftar_tips' => json_encode([
                'Rutin berolahraga',
                'Mengatur pola makan',
                'Berdoa dan bersyukur',
                'Miliki keberanian untuk berubah',
                'Lakukan aktivitas yang menyenangkan',
                'Konseling atau terapi psikologis',
                'Terapi humor dan tawa',
                'Bangun pola pikir realistis',
                'Sampaikan perasaan ke orang yang dipercaya',
                'Hindari menyendiri',
            ])
        ]);

        Tips::create([
            'nama' => 'Tips Mengatasi Kecemasan',
            'deskripsi_singkat' => 'Langkah-langkah praktis untuk mengurangi gejala kecemasan atau GAD.',
            'daftar_tips' => json_encode([
                'Latihan pernapasan dalam dan perlahan',
                'Lakukan aktivitas fisik secara teratur',
                'Tidur yang cukup dan berkualitas',
                'Terapi kognitif perilaku (CBT)',
                'Batasi konsumsi kafein, gula, dan alkohol',
                'Praktik mindfulness atau meditasi',
                'Jaga pola makan sehat dan teratur',
                'Bicarakan perasaan dengan orang terpercaya',
                'Hindari multitasking berlebihan',
                'Pertimbangkan bantuan profesional',
            ])
        ]);

        Tips::create([
            'nama' => 'Tips Mengatasi Stres',
            'deskripsi_singkat' => 'Cara mengelola stres dengan perawatan diri (self-care) yang mudah dilakukan.',
            'daftar_tips' => json_encode([
                'Buat Jadwal Me Time',
                'Tidur dan Istirahat yang Cukup',
                'Latihan Relaksasi',
                'Konsumsi Makanan Sehat',
                'Bangun Dukungan Sosial',
                'Sadari Batasan Diri',
                'Lakukan Aktivitas Kreatif',
                'Tumbuhkan Spiritualitas',
            ])
        ]);
    }
}
