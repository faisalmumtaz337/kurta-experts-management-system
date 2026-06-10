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
            $table->string('collar_nok')->after('collar_value')->nullable();
            $table->string('pacho_extra')->after('collar_nok')->nullable();
            $table->string('pocket_style')->after('pacho_extra')->nullable();
            $table->string('extra_pocket_style')->after('pocket_style')->nullable();
            $table->string('front_pati_length')->after('extra_pocket_style')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('measurements', function (Blueprint $table) {
            $table->dropColumn('collar_nok');
            $table->dropColumn('pacho_extra');
            $table->dropColumn('pocket_style');
            $table->dropColumn('extra_pocket_style');
            $table->dropColumn('front_pati_length');
        });
    }
};
