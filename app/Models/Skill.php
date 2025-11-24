<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'description',
    ];

    /**
     * Get the workers that have this skill.
     */
    public function workers(): BelongsToMany
    {
        return $this->belongsToMany(WorkerProfile::class, 'worker_skills')
                    ->withPivot('proficiency_level', 'notes')
                    ->withTimestamps();
    }

    /**
     * Scope a query to only include skills of a given category.
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }
}