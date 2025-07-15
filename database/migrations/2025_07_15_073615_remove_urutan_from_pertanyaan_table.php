<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('pertanyaan', function (Blueprint $table) {
            $table->dropColumn('urutan');
        });
    }

    public function down()
    {
        Schema::table('pertanyaan', function (Blueprint $table) {
            $table->integer('urutan')->nullable(); // Optional: kasih default kalau mau rollback
        });
    }
};

