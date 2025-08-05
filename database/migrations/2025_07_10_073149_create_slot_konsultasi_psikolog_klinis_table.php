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
        Schema::create('slot_konsultasi_psikolog_klinis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('psikolog_klinis_id')->constrained('psikolog_klinis')->onDelete('cascade');
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slot_konsultasi_psikolog_klinis');
    }
};
