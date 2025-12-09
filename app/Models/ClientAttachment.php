<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int|null $client_id
 * @property string $name
 * @property string $path
 * @property string|null $mime_type
 * @property int $size
 * @property string|null $type
 * @property string|null $description
 * @property int|null $uploaded_by
 * @property CarbonInterface|null $uploaded_at
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 */
final class ClientAttachment extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'client_id',
        'name',
        'path',
        'mime_type',
        'size',
        'type',
        'description',
        'uploaded_by',
        'uploaded_at',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'size' => 'integer',
        'uploaded_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    /**
     * Get the download URL for the attachment
     */
    public function getDownloadUrlAttribute(): string
    {
        return asset('storage/'.$this->path);
    }

    /**
     * Get the file size in human readable format
     */
    public function getFormattedSizeAttribute(): string
    {
        $bytes = $this->size;

        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2).' GB';
        }

        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2).' MB';
        }

        if ($bytes >= 1024) {
            return number_format($bytes / 1024, 2).' KB';
        }

        return $bytes.' bytes';

    }
}
