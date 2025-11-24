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
        Schema::create('worker_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('employee_id')->unique()->nullable(); // Internal employee ID
            $table->string('job_title')->nullable();
            $table->text('bio')->nullable(); // Worker bio/description
            $table->decimal('hourly_rate', 10, 2)->nullable(); // Hourly rate for the worker
            $table->string('department')->nullable();
            $table->string('manager_id')->nullable(); // ID of the worker's manager
            $table->date('hire_date')->nullable(); // When the worker was hired
            $table->enum('employment_type', ['full_time', 'part_time', 'contract', 'freelance', 'intern'])->nullable();
            $table->enum('status', ['active', 'inactive', 'on_leave', 'terminated'])->default('active');
            $table->json('availability')->nullable(); // JSON for availability hours per day
            $table->text('emergency_contact')->nullable();
            $table->string('emergency_contact_phone')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('country')->nullable();
            $table->string('phone')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('worker_profiles');
    }
};
