<?php

use App\Models\Timesheet;
use App\Models\WorkerProfile;
use App\Models\Project;
use App\Models\Client;
use App\Models\Task;
use App\Models\User;

it('to array', function () {
    $client = Client::create([
        'company_name' => 'Test Client',
        'name' => 'Test Client',
        'email' => 'client@example.com',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $project = Project::create([
        'name' => 'Test Project',
        'description' => 'Test project description',
        'status' => 'in_progress',
        'due_date' => now()->addMonth(),
        'client_id' => $client->id,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $user = User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => bcrypt('password'),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $workerProfile = WorkerProfile::create([
        'user_id' => $user->id,
        'employee_id' => 'EMP001',
        'job_title' => 'Developer',
        'bio' => 'Test bio',
        'hourly_rate' => 50.00,
        'department' => 'IT',
        'manager_id' => null,
        'hire_date' => now()->subYear(),
        'employment_type' => 'full_time',
        'status' => 'active',
        'availability' => json_encode(['monday' => 'available']),
        'emergency_contact' => 'Emergency Contact',
        'emergency_contact_phone' => '+1-555-0101',
        'address' => '123 Test Street',
        'city' => 'Test City',
        'state' => 'TS',
        'zip_code' => '12345',
        'country' => 'Test Country',
        'phone' => '+1-555-0101',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $task = Task::create([
        'title' => 'Test Task',
        'description' => 'Test task description',
        'status' => 'todo',
        'due_date' => now()->addWeek(),
        'project_id' => $project->id,
        'user_id' => $user->id,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $timesheet = Timesheet::create([
        'worker_profile_id' => $workerProfile->id,
        'project_id' => $project->id,
        'task_id' => $task->id,
        'date' => '2024-01-01',
        'hours_worked' => 8.0,
        'activity_description' => 'Worked on testing',
        'entry_type' => 'regular',
        'status' => 'pending',
        'approved_by' => null,
        'approved_at' => null,
        'notes' => 'Test notes',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $expectedKeys = [
        'id',
        'worker_profile_id',
        'project_id',
        'task_id',
        'date',
        'hours_worked',
        'activity_description',
        'entry_type',
        'status',
        'approved_by',
        'approved_at',
        'notes',
        'created_at',
        'updated_at',
    ];

    $actualKeys = array_keys($timesheet->toArray());

    foreach ($expectedKeys as $key) {
        expect($actualKeys)->toContain($key);
    }
});