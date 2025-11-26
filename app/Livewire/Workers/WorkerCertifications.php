<?php

namespace App\Livewire\Workers;

use App\Models\WorkerProfile;
use App\Models\Certification;
use Livewire\Component;
use Livewire\WithFileUploads;

class WorkerCertifications extends Component
{
    use WithFileUploads;

    public $workerId;
    public $certification_id;
    public $date_obtained;
    public $expiry_date;
    public $attachment;
    public $status = 'active';
    public $notes = '';
    public $certifications = [];

    protected $rules = [
        'certification_id' => 'required|exists:certifications,id',
        'date_obtained' => 'required|date',
        'expiry_date' => 'nullable|date|after_or_equal:date_obtained',
        'attachment' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240', // 10MB max
        'status' => 'required|in:active,expired,suspended,pending_verification',
        'notes' => 'nullable|string',
    ];

    public function mount($workerId): void
    {
        $this->workerId = $workerId;
        $this->date_obtained = now()->format('Y-m-d');
    }

    public function addCertification(): void
    {
        $this->validate();

        $worker = WorkerProfile::find($this->workerId);
        $certification = Certification::find($this->certification_id);

        // Handle file upload if provided
        $attachmentPath = null;
        if ($this->attachment) {
            $attachmentPath = $this->attachment->store('certifications/' . $this->workerId, 'public');
        }

        // Attach the certification to the worker
        $worker->certifications()->attach($this->certification_id, [
            'date_obtained' => $this->date_obtained,
            'expiry_date' => $this->expiry_date,
            'attachment_path' => $attachmentPath,
            'status' => $this->status,
            'notes' => $this->notes,
        ]);

        $this->reset(['certification_id', 'date_obtained', 'expiry_date', 'attachment', 'status', 'notes']);

        session()->flash('message', 'Certification added successfully.');
    }

    public function removeCertification($certificationId): void
    {
        $worker = WorkerProfile::find($this->workerId);
        $worker->certifications()->detach($certificationId);

        session()->flash('message', 'Certification removed successfully.');
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        $worker = WorkerProfile::with('certifications')->find($this->workerId);
        $allCertifications = Certification::orderBy('name')->get();

        return view('livewire.workers.worker-certifications', [
            'worker' => $worker,
            'allCertifications' => $allCertifications,
        ]);
    }
}