<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOpsiJawabanForInstrumen extends Migration
{
    public function up()
    {
        Schema::table('opsi_jawaban', function (Blueprint $table) {
            // Hapus relasi lama jika masih ada
            if (Schema::hasColumn('opsi_jawaban', 'pertanyaan_id')) {
                $table->dropForeign(['pertanyaan_id']);
                $table->dropColumn('pertanyaan_id');
            }

            // Tambahkan foreign key ke tabel instrumen_tes
            if (!Schema::hasColumn('opsi_jawaban', 'instrumen_tes_id')) {
                $table->foreignId('instrumen_tes_id')
                    ->after('id')
                    ->constrained('instrumen_tes')
                    ->onDelete('cascade');
            }
        });
    }

    public function down()
    {
        Schema::table('opsi_jawaban', function (Blueprint $table) {
            // Kembalikan pertanyaan_id jika rollback
            $table->foreignId('pertanyaan_id')
                ->after('id')
                ->constrained('pertanyaan')
                ->onDelete('cascade');

            // Hapus kolom instrumen_tes_id
            $table->dropForeign(['instrumen_tes_id']);
            $table->dropColumn('instrumen_tes_id');
        });
    }
}

