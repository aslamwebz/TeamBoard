<?php

namespace Database\Seeders\webz;

use App\Models\FileAttachment;
use App\Models\User;
use Illuminate\Database\Seeder;

class FileAttachmentSeeder extends Seeder
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
        
        // Create random file attachments
        FileAttachment::factory()->count(20)->create([
            'user_id' => $users->random()->id
        ]);
    }
}