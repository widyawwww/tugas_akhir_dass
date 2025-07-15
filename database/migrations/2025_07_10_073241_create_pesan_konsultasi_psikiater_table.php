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
        Schema::create('pesan_konsultasi_psikiater', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // ← foreign ke tabel 'users'
            $table->unsignedBigInteger('psikiater_id');
            $table->unsignedBigInteger('slot_psikiater_jam_id'); // ← ubah nama kolom agar lebih pendek
            $table->enum('status', ['pending', 'disetujui', 'ditolak', 'selesai'])->default('pending');
            $table->timestamps();

            // Foreign keys dengan nama pendek
            $table->foreign('user_id', 'fk_psn_user')
                ->references('id')->on('users')->onDelete('cascade');

            $table->foreign('psikiater_id', 'fk_psn_psikiater')
                ->references('id')->on('psikiater')->onDelete('cascade');

            $table->foreign('slot_psikiater_jam_id', 'fk_psn_slot_jam')
                ->references('id')->on('slot_konsultasi_psikiater_jam')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesan_konsultasi_psikiater');
    }
};
