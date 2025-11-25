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
        Schema::create('file_attachments', function (Blueprint $table) {
            $table->id();
            $table->string('filename');
            $table->string('original_name');
            $table->string('mime_type');
            $table->unsignedBigInteger('size'); // Size in bytes
            $table->string('attachable_type')->nullable(); // Polymorphic - for projects, tasks, invoices, etc.
            $table->unsignedBigInteger('attachable_id')->nullable(); // ID of the related item
            $table->unsignedBigInteger('user_id'); // User who uploaded the file
            $table->timestamps();
            
            // Indexes
            $table->index(['attachable_type', 'attachable_id']);
            $table->index('user_id');
            
            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        
        // Copy data from existing discussion_attachments table to file_attachments
        // This will transfer the existing data to the new polymorphic table
        if (Schema::hasTable('discussion_attachments')) {
            \DB::statement("
                INSERT INTO file_attachments (filename, original_name, mime_type, size, attachable_type, attachable_id, user_id, created_at, updated_at)
                SELECT filename, original_name, mime_type, size, 
                       CASE 
                           WHEN discussion_id IS NOT NULL THEN 'Discussion' 
                           WHEN comment_id IS NOT NULL THEN 'Comment'
                           ELSE 'Discussion'
                       END as attachable_type,
                       COALESCE(discussion_id, comment_id) as attachable_id,
                       user_id, created_at, updated_at
                FROM discussion_attachments
            ");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_attachments');
    }
};