<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int|null $contact_id
 * @property string $type
 * @property string|null $description
 * @property array|null $details
 * @property CarbonInterface|null $activity_date
 * @property int|null $created_by
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 */
final class ContactActivity extends Model
{
    use HasFactory;

    /**
     * Activity types
     */
    public const TYPE_EMAIL = 'email';

    public const TYPE_CALL = 'call';

    public const TYPE_MEETING = 'meeting';

    public const TYPE_NOTE = 'note';

    public const TYPE_TASK = 'task';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'contact_id',
        'type',
        'description',
        'details',
        'activity_date',
        'created_by',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'details' => 'array',
        'activity_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get activity type label
     */
    public function getTypeLabelAttribute(): string
    {
        return match ($this->type) {
            self::TYPE_EMAIL => 'Email',
            self::TYPE_CALL => 'Call',
            self::TYPE_MEETING => 'Meeting',
            self::TYPE_NOTE => 'Note',
            self::TYPE_TASK => 'Task',
            default => ucfirst($this->type)
        };
    }
}
