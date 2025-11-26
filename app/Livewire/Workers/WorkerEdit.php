<?php

namespace App\Livewire\Workers;

use App\Models\WorkerProfile;
use App\Models\User;
use Livewire\Component;

class WorkerEdit extends Component
{
    public WorkerProfile $workerProfile;

    public $user_id;
    public string $employee_id = '';
    public string $job_title = '';
    public string $bio = '';
    public string $hourly_rate = '0.00';
    public string $department = '';
    public $manager_id;
    public string $hire_date = '';
    public string $employment_type = '';
    public string $status = 'active';
    public $availability = [];
    public string $emergency_contact = '';
    public string $emergency_contact_phone = '';
    public string $address = '';
    public string $city = '';
    public string $state = '';
    public string $zip_code = '';
    public string $country = '';
    public string $phone = '';

    protected $rules = [
        'employee_id' => 'nullable|string|max:50|unique:worker_profiles,employee_id,' . 'workerProfile.id',
        'job_title' => 'nullable|string|max:255',
        'bio' => 'nullable|string',
        'hourly_rate' => 'nullable|numeric|min:0',
        'department' => 'nullable|string|max:255',
        'manager_id' => 'nullable|integer',
        'hire_date' => 'nullable|date',
        'employment_type' => 'nullable|in:full_time,part_time,contract,freelance,intern',
        'status' => 'required|in:active,inactive,on_leave,terminated',
        'availability' => 'nullable|array',
        'emergency_contact' => 'nullable|string|max:255',
        'emergency_contact_phone' => 'nullable|string|max:20',
        'address' => 'nullable|string',
        'city' => 'nullable|string|max:100',
        'state' => 'nullable|string|max:100',
        'zip_code' => 'nullable|string|max:20',
        'country' => 'nullable|string|max:100',
        'phone' => 'nullable|string|max:20',
    ];

    public function mount(WorkerProfile $workerProfile)
    {
        $this->workerProfile = $workerProfile;
        $this->fill([
            'user_id' => $workerProfile->user_id,
            'employee_id' => $workerProfile->employee_id,
            'job_title' => $workerProfile->job_title,
            'bio' => $workerProfile->bio,
            'hourly_rate' => $workerProfile->hourly_rate,
            'department' => $workerProfile->department,
            'manager_id' => $workerProfile->manager_id,
            'hire_date' => $workerProfile->hire_date ? $workerProfile->hire_date->format('Y-m-d') : '',
            'employment_type' => $workerProfile->employment_type,
            'status' => $workerProfile->status,
            'availability' => $workerProfile->availability ?? [],
            'emergency_contact' => $workerProfile->emergency_contact,
            'emergency_contact_phone' => $workerProfile->emergency_contact_phone,
            'address' => $workerProfile->address,
            'city' => $workerProfile->city,
            'state' => $workerProfile->state,
            'zip_code' => $workerProfile->zip_code,
            'country' => $workerProfile->country,
            'phone' => $workerProfile->phone,
        ]);
    }

    public function update()
    {
        $this->validate();

        $this->workerProfile->update([
            'employee_id' => $this->employee_id,
            'job_title' => $this->job_title,
            'bio' => $this->bio,
            'hourly_rate' => $this->hourly_rate,
            'department' => $this->department,
            'manager_id' => $this->manager_id,
            'hire_date' => $this->hire_date,
            'employment_type' => $this->employment_type,
            'status' => $this->status,
            'availability' => $this->availability,
            'emergency_contact' => $this->emergency_contact,
            'emergency_contact_phone' => $this->emergency_contact_phone,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'zip_code' => $this->zip_code,
            'country' => $this->country,
            'phone' => $this->phone,
        ]);

        return redirect()->route('workers.show', $this->workerProfile->id)->with('message', 'Worker profile updated successfully.');
    }

    public function render()
    {
        $users = User::orderBy('name')->get();
        return view('livewire.workers.worker-edit', [
            'users' => $users,
        ]);
    }
}