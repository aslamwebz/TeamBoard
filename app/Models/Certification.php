<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'issuing_organization',
        'license_number',
        'issue_date',
        'expiry_date',
        'credential_id',
        'credential_url',
        'description',
    ];

    protected $casts = [
        'issue_date' => 'date',
        'expiry_date' => 'date',
    ];

    /**
     * Get the worker profiles that have this certification.
     */
    public function workerProfiles()
    {
        return $this->belongsToMany(WorkerProfile::class, 'worker_certifications')
                    ->withPivot('date_obtained', 'expiry_date', 'status', 'notes', 'attachment_path')
                    ->withTimestamps();
    }
}