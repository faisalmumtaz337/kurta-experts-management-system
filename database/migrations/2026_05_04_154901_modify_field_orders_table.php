<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {

            // Fix numeric range issue for money values
            $table->decimal('paid_amount', 10, 2)->default(0)->change();
            $table->decimal('total_amount', 10, 2)->default(0)->change();
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {

            // Rollback (adjust if your old type was different)
            $table->decimal('paid_amount', 5, 2)->default(0)->change();
            $table->decimal('total_amount', 5, 2)->default(0)->change();
        });
    }
};
