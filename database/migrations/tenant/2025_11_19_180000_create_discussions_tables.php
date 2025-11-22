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
        Schema::create('discussions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('type'); // project, task, client, etc.
            $table->unsignedBigInteger('type_id'); // ID of the related item
            $table->unsignedBigInteger('user_id'); // Creator of the discussion
            $table->timestamps();
            
            // Indexes for performance
            $table->index(['type', 'type_id']);
            $table->index('user_id');
            
            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->unsignedBigInteger('discussion_id');
            $table->unsignedBigInteger('user_id'); // Comment author
            $table->unsignedBigInteger('parent_id')->nullable(); // For nested replies
            $table->timestamps();
            
            // Indexes
            $table->index('discussion_id');
            $table->index('user_id');
            $table->index('parent_id');
            
            // Foreign key constraints
            $table->foreign('discussion_id')->references('id')->on('discussions')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('comments')->onDelete('cascade');
        });

        Schema::create('discussion_attachments', function (Blueprint $table) {
            $table->id();
            $table->string('filename');
            $table->string('original_name');
            $table->string('mime_type');
            $table->unsignedBigInteger('size'); // Size in bytes
            $table->unsignedBigInteger('discussion_id')->nullable();
            $table->unsignedBigInteger('comment_id')->nullable();
            $table->unsignedBigInteger('user_id'); // Uploader
            $table->timestamps();
            
            // Indexes
            $table->index(['discussion_id', 'comment_id']);
            $table->index('user_id');
            
            // Foreign key constraints
            $table->foreign('discussion_id')->references('id')->on('discussions')->onDelete('cascade');
            $table->foreign('comment_id')->references('id')->on('comments')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('activity_log', function (Blueprint $table) {
            $table->id();
            $table->string('action'); // created_discussion, commented, uploaded_file, etc.
            $table->string('description')->nullable();
            $table->string('type')->nullable(); // project, task, etc.
            $table->unsignedBigInteger('type_id')->nullable(); // ID of the related item
            $table->unsignedBigInteger('user_id'); // User who performed the action
            $table->json('metadata')->nullable(); // Additional data about the action
            $table->timestamps();
            
            // Indexes
            $table->index(['type', 'type_id']);
            $table->index('user_id');
            $table->index('action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_log');
        Schema::dropIfExists('discussion_attachments');
        Schema::dropIfExists('comments');
        Schema::dropIfExists('discussions');
    }
};