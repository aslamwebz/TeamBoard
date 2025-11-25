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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->nullable()->constrained()->onDelete('set null');
            $table->string('name');
            $table->string('category')->nullable(); // e.g., travel, office, software
            $table->text('description')->nullable();
            $table->decimal('amount', 10, 2);
            $table->date('expense_date');
            $table->string('expense_type')->default('expense'); // e.g., expense, bill, receipt
            $table->enum('status', ['draft', 'pending_approval', 'approved', 'paid', 'rejected', 'cancelled'])
                  ->default('pending_approval');
            $table->string('receipt_url')->nullable(); // URL to receipt/image
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};