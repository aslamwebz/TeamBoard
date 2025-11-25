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
        Schema::create('certifications', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Name of the certification
            $table->string('issuing_organization')->nullable(); // Organization that issued the certification
            $table->string('license_number')->nullable(); // License or certification number
            $table->date('issue_date')->nullable(); // Date the certification was issued
            $table->date('expiry_date')->nullable(); // Date the certification expires
            $table->string('credential_id')->nullable(); // Credential ID from the issuing organization
            $table->string('credential_url')->nullable(); // URL to verify the credential
            $table->text('description')->nullable(); // Description of the certification
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certifications');
    }
};
