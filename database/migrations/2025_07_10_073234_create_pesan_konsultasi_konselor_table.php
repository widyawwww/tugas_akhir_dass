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
        Schema::create('pesan_konsultasi_konselor', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // ← ganti dari pengguna_id
            $table->unsignedBigInteger('konselor_id');
            $table->unsignedBigInteger('slot_konsultasi_konselor_jam_id');
            $table->enum('status', ['pending', 'disetujui', 'ditolak', 'selesai'])->default('pending');
            $table->timestamps();

            // FOREIGN KEYS
            $table->foreign('user_id', 'fk_pesan_user')
                ->references('id')->on('users')->onDelete('cascade');

            $table->foreign('konselor_id', 'fk_pesan_konselor')
                ->references('id')->on('konselor')->onDelete('cascade');

            $table->foreign('slot_konsultasi_konselor_jam_id', 'fk_pesan_slot_konselor_jam')
                ->references('id')->on('slot_konsultasi_konselor_jam')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesan_konsultasi_konselor');
    }
};
