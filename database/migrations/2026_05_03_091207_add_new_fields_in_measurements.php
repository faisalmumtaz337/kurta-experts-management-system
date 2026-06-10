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
            $table->decimal('length_cotton', 5, 2)->nullable();
            $table->decimal('length_washing_wear', 5, 2)->nullable();
            $table->decimal('aasam', 5, 2)->nullable();
            $table->string('cover_pati')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('measurements', function (Blueprint $table) {
            $table->dropColumn('length_cotton');
            $table->dropColumn('length_washing_wear');
            $table->dropColumn('aasam');
            $table->dropColumn('cover_pati');
        });
    }
};
