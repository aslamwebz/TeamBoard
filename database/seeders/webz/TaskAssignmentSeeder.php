<?php

namespace Database\Seeders\webz;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class TaskAssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = Task::all();
        $users = User::all();
        
        if ($tasks->isEmpty() || $users->isEmpty()) {
            $this->command->warn('Tasks or Users not found. Please run TaskSeeder and UserSeeder first.');
            return;
        }

        foreach ($tasks as $task) {
            $assignedUsers = $users->random(min(2, $users->count()))->pluck('id')->toArray();
            $task->users()->attach($assignedUsers);
        }
    }
}