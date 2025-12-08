<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $issuing_organization
 * @property string|null $license_number
 * @property CarbonInterface|null $issue_date
 * @property CarbonInterface|null $expiry_date
 * @property string|null $credential_id
 * @property string|null $credential_url
 * @property string|null $description
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 */
final class Certification extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
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

    /**
     * @var array<string, string>
     */
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
