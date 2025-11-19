<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tenants', function (Blueprint $table) {
            $table->string('legal_name')->after('id')->nullable()->comment('Company legal name');
            $table->string('logo')->after('legal_name')->nullable()->comment('Company logo path');
            $table->text('address')->after('logo')->nullable()->comment('Company address');
            $table->string('phone')->after('address')->nullable()->comment('Company phone number');
            $table->string('email')->after('phone')->nullable()->comment('Company email');
            $table->string('tax_vat_number')->after('email')->nullable()->comment('Tax/VAT number');
            $table->string('industry')->after('tax_vat_number')->nullable()->comment('Industry type');
            $table->string('currency')->after('industry')->default('USD')->comment('Default currency');
            $table->string('timezone')->after('currency')->default('UTC')->comment('Default timezone');
            $table->json('branding')->after('timezone')->nullable()->comment('Branding settings (theme, colors, etc.)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tenants', function (Blueprint $table) {
            $table->dropColumn([
                'legal_name',
                'logo',
                'address',
                'phone',
                'email',
                'tax_vat_number',
                'industry',
                'currency',
                'timezone',
                'branding'
            ]);
        });
    }
};
