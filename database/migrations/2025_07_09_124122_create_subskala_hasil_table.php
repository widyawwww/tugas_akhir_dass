<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subskala_hasil', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hasil_tes_id')->constrained('hasil_tes')->onDelete('cascade');
            $table->foreignId('subskala_id')->constrained('subskala')->onDelete('cascade');
            $table->integer('skor');
            $table->string('tingkatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subskala_hasil');
    }
};
