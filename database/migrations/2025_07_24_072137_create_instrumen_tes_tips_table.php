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
        Schema::create('instrumen_tes_tips', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('instrumen_tes_id');
            $table->unsignedBigInteger('tips_id');
            $table->timestamps();

            $table->foreign('instrumen_tes_id')->references('id')->on('instrumen_tes')->onDelete('cascade');
            $table->foreign('tips_id')->references('id')->on('tips')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instrumen_tes_tips');
    }
};
