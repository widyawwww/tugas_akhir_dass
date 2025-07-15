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
        Schema::create('instrumen_tes', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // Contoh: DASS-21, BDI-II
            $table->string('pembuat'); // Contoh: Lovibond & Lovibond
            $table->year('tahun');
            $table->text('deskripsi')->nullable(); // deskripsi instrumen
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instrumen_tes');
    }
};
