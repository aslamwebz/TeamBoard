<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Get all existing users
        $users = DB::table('users')->get();

        foreach ($users as $user) {
            // Check if a worker profile already exists for this user
            $existing = DB::table('worker_profiles')->where('user_id', $user->id)->first();

            if (!$existing) {
                // Create a worker profile for each existing user
                DB::table('worker_profiles')->insert([
                    'user_id' => $user->id,
                    'job_title' => 'Team Member', // Default job title
                    'status' => 'active', // Default status
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // This is a one-time migration to populate existing data
        // We don't want to remove the worker profiles that users have created/updated
        // So we'll leave this empty
    }
};
