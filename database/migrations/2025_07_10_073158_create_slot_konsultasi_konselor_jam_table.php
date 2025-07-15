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
        Schema::create('slot_konsultasi_konselor_jam', function (Blueprint $table) {
            $table->id();
            $table->foreignId('slot_konsultasi_konselor_id')->constrained('slot_konsultasi_konselor')->onDelete('cascade');
            $table->foreignId('jam_id')->constrained('jam')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slot_konsultasi_konselor_jam');
    }
};
