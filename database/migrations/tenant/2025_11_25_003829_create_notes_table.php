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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->string('noteable_type'); // Polymorphic relation type (e.g., 'App\Models\Client', 'App\Models\Project')
            $table->unsignedBigInteger('noteable_id'); // Polymorphic relation ID
            $table->string('title');
            $table->text('content')->nullable();
            $table->string('type')->default('general'); // e.g., general, follow_up, meeting, reminder
            $table->boolean('is_public')->default(true); // Whether the note is publicly visible
            $table->unsignedBigInteger('created_by')->nullable(); // User who created the note
            $table->timestamps();
            
            // Indexes for polymorphic relationship
            $table->index(['noteable_type', 'noteable_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};