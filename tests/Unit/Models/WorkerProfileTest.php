<?php

use App\Models\WorkerProfile;

it('to array', function () {
    $workerProfile = WorkerProfile::factory()->create()->refresh();

    expect(array_keys($workerProfile->toArray()))->toBe([
        'id',
        'user_id',
        'employee_id',
        'job_title',
        'bio',
        'hourly_rate',
        'department',
        'manager_id',
        'hire_date',
        'employment_type',
        'status',
        'availability',
        'emergency_contact',
        'emergency_contact_phone',
        'address',
        'city',
        'state',
        'zip_code',
        'country',
        'phone',
        'created_at',
        'updated_at',
    ]);
});