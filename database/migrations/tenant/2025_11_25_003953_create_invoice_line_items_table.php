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
        Schema::create('invoice_line_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->constrained('invoices')->onDelete('cascade');
            $table->string('description'); // Brief description of the item/service
            $table->text('detail')->nullable(); // More detailed description
            $table->integer('quantity'); // Quantity of items/services
            $table->decimal('unit_price', 10, 2); // Price per unit
            $table->decimal('total', 10, 2); // Quantity × Unit Price
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_line_items');
    }
};