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
        Schema::create('psikiater', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap')->nullable();
            $table->string('gambar')->nullable();
            $table->string('gambar_url')->nullable();
            $table->string('spesialisasi')->nullable();
            $table->string('sipp')->nullable();
            $table->decimal('biaya_layanan', 15, 2)->nullable();
            $table->string('lokasi_pelayanan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('psikiater');
    }
};
