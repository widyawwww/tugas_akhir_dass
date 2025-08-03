<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Informasi;

class InformasiSeeder extends Seeder
{
    public function run(): void
    {
        Informasi::create([
            'nama'           => 'Lift Antlers',
            'tentang'        => 'Lift Antlers adalah layanan penghubung antara masyarakat dengan tenaga profesional di bidang kesehatan mental. Kami hadir sebagai ruang aman (safe space) bagi siapa pun yang ingin berbagi, mencari arah, atau butuh didengarkan (bahkan sebelum mereka siap bertemu dengan psikolog atau konselor secara formal)',
            'alamat'         => 'Bandung, Jawa Barat, Indonesia',
            'visi'           => 'Menjadi pelopor layanan konsultasi Psychological First Aid (PFA) yang terpercaya, aman, dan mudah diakses oleh masyarakat luas.',
            'misi'           => '1. Menyediakan tempat bercerita yang nyaman, aman, dan tanpa judgement.
                                \n2. Memberikan psikoedukasi secara preventif agar masyarakat lebih peduli pada kesehatan mental.
                                \n3. Menjembatani kebutuhan masyarakat dengan tenaga profesional psikolog.
                                \n4. Menjadi pertolongan pertama (mental 911) saat individu mengalami krisis emosional.
                                \n5. Menyediakan layanan konseling awal dari tenaga terlatih berlatar belakang psikologi.
                                \n6. Mendekatkan layanan psikologis ke masyarakat melalui pendekatan fleksibel dan personal.',
            'instagram'      => '@liftantlers',
            'tiktok'         => '@liftantlers',
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
    }
}
