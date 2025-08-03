<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddArtikelAndTipsIdToInstrumenTesTable extends Migration
{
    public function up()
    {
        Schema::table('instrumen_tes', function (Blueprint $table) {
            // Tambah sebelum created_at (pakai after 'gambar_url' misalnya)
            $table->unsignedBigInteger('artikel_id')->nullable()->after('gambar_url');
            $table->unsignedBigInteger('tips_id')->nullable()->after('artikel_id');

            // Jika ingin menambahkan foreign key (optional)
            $table->foreign('artikel_id')->references('id')->on('artikel')->onDelete('set null');
            $table->foreign('tips_id')->references('id')->on('tips')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('instrumen_tes', function (Blueprint $table) {
            $table->dropForeign(['artikel_id']);
            $table->dropForeign(['tips_id']);
            $table->dropColumn(['artikel_id', 'tips_id']);
        });
    }
}
