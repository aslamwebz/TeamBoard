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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('type'); // Notification type (e.g., 'task_assigned', 'new_invoice', etc.)
            $table->text('message');
            $table->json('data')->nullable(); // Additional data for the notification
            $table->timestamp('read_at')->nullable(); // When the notification was read
            $table->timestamp('email_sent_at')->nullable(); // When email was sent
            $table->timestamp('push_sent_at')->nullable(); // When push notification was sent
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
