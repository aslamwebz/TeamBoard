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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Vendor company name
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('country')->nullable();
            $table->string('tax_id')->nullable(); // VAT number or tax ID
            $table->text('description')->nullable();
            $table->decimal('rating', 3, 2)->default(0.00); // Rating out of 5.00
            $table->string('website')->nullable();
            $table->enum('status', ['active', 'inactive', 'pending'])->default('active');
            $table->string('payment_terms')->nullable(); // NET30, NET60, etc.
            $table->decimal('credit_limit', 10, 2)->nullable(); // Credit limit if applicable
            $table->timestamp('last_transaction_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
