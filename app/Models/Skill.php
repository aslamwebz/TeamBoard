<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'description',
    ];

    /**
     * Get the worker profiles that have this skill.
     */
    public function workerProfiles()
    {
        return $this->belongsToMany(WorkerProfile::class, 'worker_skills')
                    ->withPivot('proficiency_level', 'notes')
                    ->withTimestamps();
    }
}