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
        Schema::create('hasil_tes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('instrumen_tes_id')->constrained('instrumen_tes')->onDelete('cascade');
            $table->integer('skor_total')->nullable(); // untuk instrumen tanpa subskala
            $table->string('tingkatan')->nullable(); // Misal: Sedang, Berat, dll
            $table->enum('status', ['selesai', 'belum'])->default('belum');
            $table->timestamp('tanggal_tes')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_tes');
    }
};
