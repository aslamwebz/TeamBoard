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
        // First drop the foreign key constraints
        Schema::table('expense_attachments', function (Blueprint $table) {
            $table->dropForeign(['uploaded_by']);
        });

        // Modify the column to be nullable
        Schema::table('expense_attachments', function (Blueprint $table) {
            $table->unsignedBigInteger('uploaded_by')->nullable()->change();
        });

        // Add the foreign key constraint with set null option
        Schema::table('expense_attachments', function (Blueprint $table) {
            $table->foreign('uploaded_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('expense_attachments', function (Blueprint $table) {
            $table->dropForeign(['uploaded_by']);
            $table->unsignedBigInteger('uploaded_by')->change();
        });
    }
};