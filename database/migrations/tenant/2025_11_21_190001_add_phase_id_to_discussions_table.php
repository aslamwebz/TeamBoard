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
        Schema::table('discussions', function (Blueprint $table) {
            $table->unsignedBigInteger('project_phase_id')->nullable()->after('project_id');
            
            // Add foreign key constraint
            $table->foreign('project_phase_id')->references('id')->on('project_phases')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('discussions', function (Blueprint $table) {
            $table->dropForeign(['project_phase_id']);
            $table->dropColumn('project_phase_id');
        });
    }
};