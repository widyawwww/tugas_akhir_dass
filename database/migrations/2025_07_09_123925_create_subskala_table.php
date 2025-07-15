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
        Schema::create('subskala', function (Blueprint $table) {
            $table->id();
            $table->foreignId('instrumen_tes_id')->constrained('instrumen_tes')->onDelete('cascade');
            $table->string('nama'); // Depresi, Kecemasan, Stres (untuk DASS-21)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subskala');
    }
};
