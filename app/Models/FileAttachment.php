<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $filename
 * @property string $original_name
 * @property string|null $mime_type
 * @property int $size
 * @property string $attachable_type
 * @property int $attachable_id
 * @property int|null $user_id
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 */
final class FileAttachment extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'filename',
        'original_name',
        'mime_type',
        'size',
        'attachable_type',  // Polymorphic relationship - can be Project, Task, Invoice, etc.
        'attachable_id',    // The ID of the related model
        'user_id',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'size' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the owning model (project, task, client, invoice, etc.)
     */
    public function attachable()
    {
        return $this->morphTo();
    }

    /**
     * Get the user who uploaded the file
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the file path for this attachment
     */
    public function getFilePath(): string
    {
        return storage_path('app/files/'.$this->filename);
    }

    /**
     * Get the public URL for this attachment
     */
    public function getUrl(): string
    {
        return asset('storage/files/'.$this->filename);
    }

    /**
     * Check if the file is an image
     */
    public function isImage(): bool
    {
        return str_starts_with((string) $this->mime_type, 'image/');
    }

    /**
     * Check if the file is a document
     */
    public function isDocument(): bool
    {
        return in_array($this->mime_type, [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'text/plain',
        ]);
    }

    /**
     * Get a formatted file size
     */
    public function getFormattedSize(): string
    {
        $bytes = $this->size;
        $units = ['B', 'KB', 'MB', 'GB'];

        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2).' '.$units[$i];
    }

    /**
     * Get the file extension
     */
    public function getExtension(): string
    {
        return pathinfo($this->original_name, PATHINFO_EXTENSION);
    }
}
