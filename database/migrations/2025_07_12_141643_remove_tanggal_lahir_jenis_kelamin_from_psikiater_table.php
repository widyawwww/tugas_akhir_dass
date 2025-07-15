<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('psikiater', function (Blueprint $table) {
            $table->dropColumn('tanggal_lahir');
            $table->dropColumn('jenis_kelamin');
        });
    }

    public function down(): void
    {
        Schema::table('psikiater', function (Blueprint $table) {
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
        });
    }

};
