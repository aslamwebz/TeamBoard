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
        Schema::table('tasks', function (Blueprint $table) {
            $table->foreignId('project_phase_id')->nullable()->constrained('project_phases')->onDelete('set null');
            $table->json('dependencies')->nullable()->comment('List of task IDs this task depends on');
            $table->integer('order')->default(0)->after('project_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign(['project_phase_id']);
            $table->dropColumn(['project_phase_id', 'dependencies', 'order']);
        });
    }
};