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
        Schema::create('client_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->string('name')->comment('Name of the attachment');
            $table->string('path')->comment('Path to the file');
            $table->string('mime_type')->comment('MIME type of the file');
            $table->integer('size')->comment('Size of the file in bytes');
            $table->string('type')->comment('Type of attachment (contract, nda, onboarding, etc.)');
            $table->text('description')->nullable()->comment('Description of the attachment');
            $table->foreignId('uploaded_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('uploaded_at')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_attachments');
    }
};
