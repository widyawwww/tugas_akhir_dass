<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('opsi_jawaban', function (Blueprint $table) {
            if (Schema::hasColumn('opsi_jawaban', 'instrumen_id')) {
                $table->dropColumn('instrumen_id');
            }
        });
    }

    public function down()
    {
        Schema::table('opsi_jawaban', function (Blueprint $table) {
            $table->unsignedBigInteger('instrumen_id')->nullable();
        });
    }

};
