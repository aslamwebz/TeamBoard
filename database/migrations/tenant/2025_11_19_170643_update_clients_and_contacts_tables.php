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
        // Add new fields to clients table
        Schema::table('clients', function (Blueprint $table) {
            $table->text('notes')->after('subscription_status')->nullable()->comment('Additional notes about the client');
            $table->string('billing_address')->after('notes')->nullable()->comment('Billing address for the client');
            $table->string('shipping_address')->after('billing_address')->nullable()->comment('Shipping address for the client');
            $table->string('primary_contact_id')->after('shipping_address')->nullable()->comment('ID of the primary contact');
            $table->json('custom_fields')->after('primary_contact_id')->nullable()->comment('Custom fields for the client');
        });

        // Add new fields to contacts table
        Schema::table('contacts', function (Blueprint $table) {
            $table->string('job_title')->after('position')->nullable()->comment('Job title of the contact');
            $table->string('work_phone')->after('department')->nullable()->comment('Work phone number');
            $table->string('mobile_phone')->after('work_phone')->nullable()->comment('Mobile phone number');
            $table->json('communication_preferences')->after('mobile_phone')->nullable()->comment('Communication preferences');
            $table->boolean('is_billing_contact')->after('communication_preferences')->default(false)->comment('Is this contact used for billing?');
            $table->boolean('is_technical_contact')->after('is_billing_contact')->default(false)->comment('Is this contact used for technical matters?');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn([
                'notes',
                'billing_address',
                'shipping_address',
                'primary_contact_id',
                'custom_fields'
            ]);
        });

        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn([
                'job_title',
                'work_phone',
                'mobile_phone',
                'communication_preferences',
                'is_billing_contact',
                'is_technical_contact'
            ]);

            // Revert position field back to original if needed
            $table->string('position')->nullable()->change();
        });
    }
};
