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
        Schema::create('work_invoices', function (Blueprint $table) {
            $table->id();

            $table->string('invoice_no')->unique(); // print number
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();

            $table->date('issue_date')->nullable();

            $table->text('general_notes')->nullable(); // overall instructions
            $table->enum('status', ['Pending', 'In Progress', 'Completed'])
                ->default('Pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_invoices');
    }
};
