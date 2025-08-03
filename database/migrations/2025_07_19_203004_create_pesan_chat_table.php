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
        Schema::create('pesan_chat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesan_konsultasi_konselor_id')->constrained('pesan_konsultasi_konselor')->onDelete('cascade');
            $table->unsignedBigInteger('pengirim_id'); // ID dari user atau konselor
            $table->string('tipe_pengirim'); // 'user' atau 'konselor'
            $table->text('pesan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesan_chat');
    }
};
