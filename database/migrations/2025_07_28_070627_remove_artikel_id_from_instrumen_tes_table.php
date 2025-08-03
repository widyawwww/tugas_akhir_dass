<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('instrumen_tes', function (Blueprint $table) {
            $table->dropForeign(['artikel_id']);
            $table->dropColumn('artikel_id');
        });
    }

    public function down(): void
    {
        Schema::table('instrumen_tes', function (Blueprint $table) {
            $table->unsignedBigInteger('artikel_id')->nullable()->after('gambar_url');
            $table->foreign('artikel_id')->references('id')->on('artikel')->onDelete('set null');
        });
    }
};
