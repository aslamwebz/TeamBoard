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
        // Update the existing clients to populate company_name if it's empty or null
        $clients = DB::table('clients')->select('id', 'name', 'company_name')->get();
        foreach ($clients as $client) {
            if ((empty($client->company_name) || is_null($client->company_name)) && !empty($client->name)) {
                DB::table('clients')
                    ->where('id', $client->id)
                    ->update(['company_name' => $client->name]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Nothing to reverse as we only updated existing data
    }
};
