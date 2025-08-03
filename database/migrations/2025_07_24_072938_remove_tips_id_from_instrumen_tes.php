<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('instrumen_tes', function (Blueprint $table) {
            // Hapus foreign key dulu jika ada
            if (Schema::hasColumn('instrumen_tes', 'tips_id')) {
                $table->dropForeign(['tips_id']);
                $table->dropColumn('tips_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('instrumen_tes', function (Blueprint $table) {
            // Jika di-rollback, tambahkan kembali kolom tips_id
            $table->unsignedBigInteger('tips_id')->nullable()->after('artikel_id');
            $table->foreign('tips_id')->references('id')->on('tips')->onDelete('set null');
        });
    }
};
