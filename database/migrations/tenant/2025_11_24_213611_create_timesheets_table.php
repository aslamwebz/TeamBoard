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
        Schema::create('timesheets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('worker_profile_id')->constrained('worker_profiles')->onDelete('cascade');
            $table->foreignId('project_id')->nullable()->constrained('projects')->onDelete('set null'); // Project worked on
            $table->foreignId('task_id')->nullable()->constrained('tasks')->onDelete('set null'); // Task worked on
            $table->date('date'); // Date of the timesheet entry
            $table->decimal('hours_worked', 5, 2); // Hours worked on this date
            $table->string('activity_description')->nullable(); // Description of work done
            $table->enum('entry_type', ['regular', 'overtime', 'vacation', 'sick_leave', 'holiday'])->default('regular');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null'); // Who approved the timesheet
            $table->timestamp('approved_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timesheets');
    }
};
