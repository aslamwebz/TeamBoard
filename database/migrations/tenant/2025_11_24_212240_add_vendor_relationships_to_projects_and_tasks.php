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
        // Add vendor_id to projects table for outsourcing
        Schema::table('projects', function (Blueprint $table) {
            $table->foreignId('vendor_id')->nullable()->after('client_id');
        });

        // Add vendor_id to tasks table for subcontracting individual tasks
        Schema::table('tasks', function (Blueprint $table) {
            $table->foreignId('vendor_id')->nullable()->after('project_phase_id');
        });

        // Add project_id and task_id to purchase_orders table
        Schema::table('purchase_orders', function (Blueprint $table) {
            $table->foreignId('project_id')->nullable();
            $table->foreignId('task_id')->nullable();
        });

        // Add project_id to vendor_invoices table for cost tracking
        Schema::table('vendor_invoices', function (Blueprint $table) {
            $table->foreignId('project_id')->nullable();
        });

        // Now add the foreign key constraints
        Schema::table('projects', function (Blueprint $table) {
            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('set null');
        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('set null');
        });

        Schema::table('purchase_orders', function (Blueprint $table) {
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('set null');
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('set null');
        });

        Schema::table('vendor_invoices', function (Blueprint $table) {
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove foreign key constraints first
        Schema::table('vendor_invoices', function (Blueprint $table) {
            $table->dropForeign(['project_id']);
        });

        Schema::table('purchase_orders', function (Blueprint $table) {
            $table->dropForeign(['task_id']);
            $table->dropForeign(['project_id']);
        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign(['vendor_id']);
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign(['vendor_id']);
        });

        // Drop the columns
        Schema::table('vendor_invoices', function (Blueprint $table) {
            $table->dropColumn('project_id');
        });

        Schema::table('purchase_orders', function (Blueprint $table) {
            $table->dropColumn('task_id');
            $table->dropColumn('project_id');
        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn('vendor_id');
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('vendor_id');
        });
    }
};
