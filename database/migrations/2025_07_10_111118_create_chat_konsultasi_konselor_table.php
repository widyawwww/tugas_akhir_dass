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
        Schema::create('chat_konsultasi_konselor', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pesan_konsultasi_konselor_id');
            $table->foreign('pesan_konsultasi_konselor_id', 'fk_chat_pesan')
                ->references('id')
                ->on('pesan_konsultasi_konselor') // ← nama tabel yang benar
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_konsultasi_konselor');
    }
};
