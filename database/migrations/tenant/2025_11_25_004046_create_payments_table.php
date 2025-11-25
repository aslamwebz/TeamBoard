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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->nullable()->constrained('invoices')->onDelete('set null');
            $table->decimal('amount', 10, 2); // Amount paid
            $table->string('payment_method')->nullable(); // e.g., credit_card, bank_transfer, check, paypal
            $table->string('transaction_reference')->nullable(); // Transaction ID from payment processor
            $table->text('notes')->nullable(); // Additional notes about the payment
            $table->date('payment_date'); // Date of payment
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};