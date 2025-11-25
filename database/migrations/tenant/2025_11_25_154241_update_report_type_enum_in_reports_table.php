<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update the enum values for report_type to include all the required types
        DB::statement("ALTER TABLE reports MODIFY COLUMN report_type ENUM('sales', 'project', 'financial', 'client', 'expense', 'invoice', 'team', 'vendor', 'task', 'revenue')");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert to the original enum values
        DB::statement("ALTER TABLE reports MODIFY COLUMN report_type ENUM('financial', 'project', 'invoice', 'client')");
    }
};