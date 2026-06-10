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
        Schema::create('work_invoice_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('work_invoice_id')->constrained()->cascadeOnDelete();

            $table->string('item_type'); // Kurta, Pajama, Coat etc
            $table->string('fabric')->nullable();
            $table->string('color')->nullable();

            $table->integer('quantity')->default(1);

            $table->text('design_details')->nullable(); // collar, cuff etc

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
