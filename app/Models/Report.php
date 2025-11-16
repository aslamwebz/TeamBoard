<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'report_type',
        'data',
        'generated_at',
        'status',
    ];

    protected $casts = [
        'data' => 'array',
        'generated_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public const TYPE_FINANCIAL = 'financial';
    public const TYPE_PROJECT = 'project';
    public const TYPE_INVOICE = 'invoice';
    public const TYPE_CLIENT = 'client';

    public const STATUS_DRAFT = 'draft';
    public const STATUS_GENERATED = 'generated';
    public const STATUS_ARCHIVED = 'archived';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}