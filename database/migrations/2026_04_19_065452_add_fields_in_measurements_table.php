<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('measurements', function (Blueprint $table) {
            $table->id();

            // Relation (customer se link karne ke liye)
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();

            /*
            =====================
            BASIC MEASUREMENTS
            =====================
            */
            $table->string('length_type')->nullable(); // gol / choras
            $table->decimal('length_value', 5, 2)->nullable();

            $table->decimal('shoulder', 5, 2)->nullable();
            $table->decimal('chest', 5, 2)->nullable();
            $table->decimal('waist', 5, 2)->nullable();
            $table->decimal('hips', 5, 2)->nullable();

            /*
            =====================
            SLEEVES
            =====================
            */
            $table->decimal('cuff_length', 5, 2)->nullable();
            $table->decimal('cuff', 5, 2)->nullable();
            $table->decimal('sleeve_round', 5, 2)->nullable(); // gol

            /*
            =====================
            COLLAR (CARLER)
            =====================
            */
            $table->string('collar_type')->nullable();
            // straight, arrow, normal, square, inch_gol, khasi

            /*
            =====================
            SHIRT STYLE
            =====================
            */
            $table->string('shirt_type')->nullable();
            // design, simple, pehriyan, kurta

            /*
            =====================
            POCKETS
            =====================
            */
            $table->string('pockets')->nullable();
            // XX, XXO, XO, XOO

            /*
            =====================
            SHALWAR
            =====================
            */
            $table->string('shalwar_type')->nullable();
            // aam, gher, pajama, choori

            /*
            =====================
            ANKLE (PACHA)
            =====================
            */
            $table->string('ankle_type')->nullable();
            // sado pacho, kandro

            /*
            =====================
            SEWING
            =====================
            */
            $table->string('sewing_type')->nullable();
            // simple, double, double full

            /*
            =====================
            EXTRA NOTES
            =====================
            */
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('measurements');
    }
};
