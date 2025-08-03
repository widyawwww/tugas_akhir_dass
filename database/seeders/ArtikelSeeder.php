<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Artikel;

class ArtikelSeeder extends Seeder
{
    public function run(): void
    {
        Artikel::create([
            'nama' => 'Memahami Depresi – Gejala, Penyebab, dan Penanganan',
            'deskripsi_singkat' => 'Artikel ini menjelaskan secara ringkas mengenai gangguan depresi, mulai dari gejala umum, faktor penyebab, hingga pendekatan penanganan yang dapat membantu penderita pulih secara bertahap.',
            'deskripsi' => '<p>Depresi adalah gangguan suasana hati yang ditandai oleh kesedihan mendalam, perasaan putus asa, tidak berharga, hingga kehilangan motivasi dalam menjalani kehidupan sehari-hari. Kondisi ini tidak hanya menyerang orang dewasa, namun juga dapat dialami oleh anak-anak dari berbagai latar belakang sosial.</p>

            <p>Data dari WHO menunjukkan bahwa depresi menjadi salah satu penyebab utama bunuh diri, dan prevalensinya terus meningkat secara global. Seseorang dinyatakan mengalami depresi apabila setidaknya lima gejala muncul selama dua minggu atau lebih, seperti gangguan tidur, kehilangan minat, kelelahan, sulit konsentrasi, perasaan bersalah, serta pikiran untuk bunuh diri.</p>

            <p>Depresi dapat disebabkan oleh berbagai faktor yang saling berkaitan, antara lain:</p>

            <ul>
                <li><strong>Faktor Biologis</strong>, seperti ketidakseimbangan neurotransmitter (norepinefrin dan serotonin), perubahan hormon, atau penyakit fisik kronis.</li>
                <li><strong>Faktor Psikologis</strong>, misalnya rendahnya harga diri, cara berpikir negatif, dan kebiasaan menyalahkan diri sendiri.</li>
                <li><strong>Faktor Sosial</strong>, seperti kehilangan orang terdekat, trauma masa kecil, isolasi sosial, tekanan ekonomi, dan tuntutan hidup.</li>
            </ul>

            <p>Penanganan depresi melibatkan kombinasi antara perubahan gaya hidup, terapi psikologis, serta obat-obatan medis. Aktivitas seperti olahraga, pola makan sehat, berdoa, serta rekreasi dapat membantu mengurangi beban emosional. Dukungan sosial, konseling kelompok, hingga terapi kognitif (CBT) juga terbukti efektif dalam membantu penderita mengubah pola pikir negatif. Pada kondisi berat, konsultasi ke psikiater untuk pengobatan farmakologis sangat dianjurkan.</p>

            <p>Dengan memahami depresi secara menyeluruh, diharapkan individu maupun lingkungan sekitarnya dapat memberikan respons yang lebih peduli dan membantu proses pemulihan dengan pendekatan yang tepat.</p>',
        ]);

        Artikel::create([
            'nama' => 'Mengenal Gejala dan Penanganan Gangguan Kecemasan',
            'deskripsi_singkat' => 'Artikel ini membahas tentang gangguan kecemasan umum (GAD), termasuk gejala-gejala yang sering muncul, faktor penyebabnya, serta pendekatan penanganan yang efektif untuk membantu penderita mengelola kecemasan secara lebih sehat.',
            'deskripsi' => '<p>Gangguan kecemasan merupakan kondisi psikologis yang ditandai dengan rasa cemas yang berlebihan, terus-menerus, dan sulit dikendalikan. Kecemasan ini dapat muncul dalam berbagai aspek kehidupan sehari-hari, seperti pekerjaan, kesehatan, hubungan sosial, dan masa depan, meskipun tidak ada ancaman yang nyata.</p>

            <p>Kondisi ini bisa berlangsung dalam jangka waktu yang lama, bahkan hingga berbulan-bulan atau bertahun-tahun, dan kerap membuat penderitanya merasa kewalahan. Beberapa gejala umum yang sering muncul antara lain:</p>

            <ul>
                <li>Perasaan khawatir yang terus-menerus dan sulit dikendalikan</li>
                <li>Gangguan tidur seperti sulit tertidur atau sering terbangun</li>
                <li>Ketegangan otot, kelelahan berlebihan</li>
                <li>Sulit fokus atau berkonsentrasi</li>
                <li>Keluhan fisik seperti sakit kepala, gangguan pencernaan, jantung berdebar, atau sesak napas</li>
            </ul>

            <p>Penyebab gangguan kecemasan sangat beragam dan saling berkaitan, mulai dari faktor genetik, tekanan lingkungan, ketidakseimbangan zat kimia otak (neurotransmitter), hingga gaya hidup yang kurang sehat dan cara seseorang dalam menghadapi stres.</p>

            <p>Untuk membantu mengatasi kecemasan, berbagai pendekatan dapat dilakukan, seperti <strong>terapi psikologis</strong> (terutama terapi kognitif perilaku), yang membantu penderita memahami dan mengubah pola pikir negatif. Dalam beberapa kasus, penggunaan obat penenang atau antidepresan juga dibutuhkan, tetapi harus diawasi oleh profesional medis.</p>

            <p>Selain itu, teknik pendukung seperti <em>latihan pernapasan, relaksasi, mindfulness, olahraga rutin, yoga</em>, serta menjaga gaya hidup sehat sangat bermanfaat untuk mempercepat proses pemulihan.</p>

            <p>Karena kecemasan sering disalahartikan sebagai stres biasa, penting bagi individu dan lingkungan sekitarnya untuk memahami gejalanya sejak dini. Dengan deteksi dan penanganan yang tepat, kecemasan dapat dikelola sehingga tidak berkembang menjadi gangguan mental yang lebih serius.</p>',
        ]);

        Artikel::create([
            'nama' => 'Mengenal dan Mengatasi Stres Melalui Perawatan Diri',
            'deskripsi_singkat' => 'Stres adalah kondisi yang umum dirasakan siapa pun, termasuk para profesional seperti konselor. Jika tidak dikelola dengan baik, stres dapat berdampak negatif pada kesehatan fisik, mental, dan kinerja seseorang.',
            'deskripsi' => '<p>Stres seringkali muncul akibat ketidakseimbangan antara tuntutan pekerjaan dan kemampuan seseorang untuk menghadapinya. Dalam dunia pendidikan, konselor berhadapan langsung dengan masalah siswa yang rumit dan beragam, sehingga rentan mengalami stres.</p><p>Gejala yang sering dirasakan antara lain kelelahan fisik, sulit tidur, sakit kepala, dan penurunan semangat kerja.</p><p>Untuk mengatasi stres, penting bagi seseorang, khususnya konselor, untuk menerapkan perawatan diri (self-care). Perawatan diri mencakup berbagai aspek, mulai dari fisik, psikologis, sosial, hingga spiritual. Contohnya adalah menjaga pola tidur, makan sehat, berolahraga, hingga mencari dukungan dari orang terdekat atau profesional lainnya.</p><p>Dengan mengenali gejala stres dan menerapkan perawatan diri yang sesuai, seseorang dapat kembali seimbang secara emosional dan menjalankan tugasnya dengan lebih optimal. Perawatan diri bukanlah bentuk kemewahan, melainkan kebutuhan agar tetap sehat secara utuh.</p>',
        ]);
    }
}
