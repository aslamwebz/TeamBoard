<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\User as UserModel;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property int $id
 * @property string $noteable_type
 * @property int $noteable_id
 * @property string $title
 * @property string $content
 * @property string|null $type
 * @property bool $is_public
 * @property int|null $created_by
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 */
final class Note extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'noteable_type',
        'noteable_id',
        'title',
        'content',
        'type',
        'is_public',
        'created_by',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'is_public' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the parent noteable model (client, project, etc.).
     */
    public function noteable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the user who created this note.
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'created_by');
    }
}
