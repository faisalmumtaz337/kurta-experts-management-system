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
            $table->string('cuff')->nullable()->after('cuff_type');
            $table->string('cuff_single')->nullable();
            $table->string('cuff_double')->nullable();
            $table->string('golpati')->nullable();
            $table->string('golkani')->nullable();
            $table->string('chhati')->nullable();
            $table->string('extra_request_waist')->nullable();
            $table->string('pocket_type')->nullable();
            $table->string('pocket_size')->nullable();
            $table->string('extra_request_pocket')->nullable();
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
