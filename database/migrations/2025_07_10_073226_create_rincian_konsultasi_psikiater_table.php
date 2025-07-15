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
        Schema::create('rincian_konsultasi_psikiater', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('slot_konsultasi_psikiater_jam_id');
            $table->integer('jumlah_slot');
            $table->integer('slot_tersisa');
            $table->timestamps();

            $table->foreign('slot_konsultasi_psikiater_jam_id', 'fk_rincian_psikiater_slot')
                ->references('id')
                ->on('slot_konsultasi_psikiater_jam')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rincian_konsultasi_psikiater');
    }
};
