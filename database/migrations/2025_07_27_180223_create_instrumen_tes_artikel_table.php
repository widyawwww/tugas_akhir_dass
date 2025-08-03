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
        Schema::create('instrumen_tes_artikel', function (Blueprint $table) {
            $table->id();
            $table->foreignId('instrumen_tes_id')->constrained()->onDelete('cascade');
            $table->foreignId('artikel_id')->constrained('artikel')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instrumen_tes_artikel');
    }
};
