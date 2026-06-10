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
        Schema::create('employee_payments', function (Blueprint $table) {

            $table->id();

            /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

            $table->foreignId('employee_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('order_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            /*
    |--------------------------------------------------------------------------
    | PAYMENT DETAILS
    |--------------------------------------------------------------------------
    */

            $table->decimal('amount', 10, 2);

            $table->enum('payment_type', [
                'advance',
                'settlement',
                'bonus',
                'deduction'
            ])->default('settlement');

            $table->enum('payment_method', [
                'cash',
                'bank_transfer',
                'jazzcash',
                'easypaisa'
            ])->default('cash');

            /*
    |--------------------------------------------------------------------------
    | EXTRA INFORMATION
    |--------------------------------------------------------------------------
    */

            $table->date('payment_date');

            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_payments');
    }
};
