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
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->string('action'); // created_discussion, commented, uploaded_file, etc.
            $table->text('description')->nullable();
            $table->string('type')->nullable(); // project, task, etc.
            $table->unsignedBigInteger('type_id')->nullable(); // ID of the related item
            $table->unsignedBigInteger('user_id'); // User who performed the action
            $table->json('metadata')->nullable(); // Additional data about the action
            $table->timestamps();

            // Indexes
            $table->index(['type', 'type_id']);
            $table->index('user_id');
            $table->index('action');

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
