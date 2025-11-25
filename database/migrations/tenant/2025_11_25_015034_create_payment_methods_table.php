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
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Name of the payment method (e.g., Credit Card, Bank Transfer)
            $table->string('type'); // Type of payment method (e.g., card, transfer, digital_wallet)
            $table->text('description')->nullable(); // Description of the payment method
            $table->boolean('is_active')->default(true); // Whether this payment method is active
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
};