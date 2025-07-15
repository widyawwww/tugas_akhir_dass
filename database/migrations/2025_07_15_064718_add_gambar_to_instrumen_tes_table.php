<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGambarToInstrumenTesTable extends Migration
{
    public function up()
    {
        Schema::table('instrumen_tes', function (Blueprint $table) {
            $table->string('gambar')->nullable()->after('deskripsi');
        });
    }

    public function down()
    {
        Schema::table('instrumen_tes', function (Blueprint $table) {
            $table->dropColumn('gambar');
        });
    }
}

