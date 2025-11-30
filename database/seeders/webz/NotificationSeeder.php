<?php

namespace Database\Seeders\webz;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        
        if ($users->isEmpty()) {
            $this->command->warn('No users found. Please run UserSeeder first.');
            return;
        }
        
        // Create notifications for users
        foreach ($users as $user) {
            // Create 3-6 notifications per user
            $notificationCount = rand(3, 6);
            Notification::factory()->count($notificationCount)->create([
                'user_id' => $user->id
            ]);
        }
    }
}