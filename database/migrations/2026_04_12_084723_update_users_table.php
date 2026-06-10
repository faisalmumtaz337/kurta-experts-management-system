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
        Schema::table('users', function (Blueprint $table) {
            // $table->dropColumn('email');
            $table->dropColumn('email_verified_at');

            $table->string('caste', 15)->after('name');
            $table->string('contact', 11)->after('caste');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // $table->string('email');
            $table->timestamp('email_verified_at');

            $table->dropColumn('caste', 15)->after('name');
            $table->dropColumn('contact', 11)->after('caste');
        });
    }
};
