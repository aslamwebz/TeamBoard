<?php

use App\Models\DiscussionAttachment;
use App\Models\Discussion;
use App\Models\Project;
use App\Models\Client;
use App\Models\User;

it('to array', function () {
    // Create related records in proper order to satisfy foreign key constraints
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

    $discussion = Discussion::create([
        'title' => 'Test Discussion',
        'content' => 'Test discussion content',
        'type' => 'project',
        'type_id' => 1,
        'user_id' => $user->id,
        'project_id' => $project->id,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $discussionAttachment = DiscussionAttachment::create([
        'filename' => 'test.pdf',
        'original_name' => 'test_original.pdf',
        'mime_type' => 'application/pdf',
        'size' => 1024,
        'discussion_id' => $discussion->id,
        'comment_id' => null,
        'user_id' => $user->id,  // Use the created user's ID
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $expectedKeys = [
        'id',
        'filename',
        'original_name',
        'mime_type',
        'size',
        'discussion_id',
        'comment_id',
        'user_id',
        'created_at',
        'updated_at',
    ];

    $actualKeys = array_keys($discussionAttachment->toArray());

    foreach ($expectedKeys as $key) {
        expect($actualKeys)->toContain($key);
    }
});