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
        Schema::create('worker_certifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('worker_profile_id')->constrained('worker_profiles')->onDelete('cascade');
            $table->foreignId('certification_id')->constrained('certifications')->onDelete('cascade');
            $table->date('date_obtained'); // Date the worker obtained the certification
            $table->date('expiry_date')->nullable(); // Date the certification expires
            $table->string('attachment_path')->nullable(); // Path to certification document/file
            $table->enum('status', ['active', 'expired', 'suspended', 'pending_verification'])->default('active');
            $table->text('notes')->nullable(); // Additional notes about the certification
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('worker_certifications');
    }
};
