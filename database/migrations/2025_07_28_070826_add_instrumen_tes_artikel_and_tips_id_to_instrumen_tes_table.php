<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('instrumen_tes', function (Blueprint $table) {
            $table->unsignedBigInteger('instrumen_tes_artikel_id')->nullable()->after('deskripsi');
            $table->unsignedBigInteger('instrumen_tes_tips_id')->nullable()->after('instrumen_tes_artikel_id');

            $table->foreign('instrumen_tes_artikel_id')
                ->references('id')
                ->on('artikel')
                ->onDelete('set null');

            $table->foreign('instrumen_tes_tips_id')
                ->references('id')
                ->on('tips')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('instrumen_tes', function (Blueprint $table) {
            $table->dropForeign(['instrumen_tes_artikel_id']);
            $table->dropForeign(['instrumen_tes_tips_id']);
            $table->dropColumn(['instrumen_tes_artikel_id', 'instrumen_tes_tips_id']);
        });
    }
};
