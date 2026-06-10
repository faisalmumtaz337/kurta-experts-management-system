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
        Schema::table('measurements', function (Blueprint $table) {
            $table->dropColumn('neck');
            $table->dropColumn('chest');
            $table->dropColumn('waist');
            $table->dropColumn('hips');
            $table->dropColumn('shoulder');
            $table->dropColumn('sleeve_length');
            $table->dropColumn('shirt_length');
            $table->dropColumn('notes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('measurements', function (Blueprint $table) {
            //
        });
    }
};
