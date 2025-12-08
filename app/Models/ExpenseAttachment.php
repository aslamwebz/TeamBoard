<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Storage;

/**
 * @property int $id
 * @property int|null $expense_id
 * @property string $filename
 * @property string $original_name
 * @property string $file_path
 * @property string|null $mime_type
 * @property int $size
 * @property string|null $description
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 */
final class ExpenseAttachment extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'expense_id',
        'filename',
        'original_name',
        'file_path',
        'mime_type',
        'size',
        'description',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'size' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function expense(): BelongsTo
    {
        return $this->belongsTo(Expense::class);
    }

    /**
     * Get the full URL for the attachment
     */
    public function getUrl()
    {
        return Storage::url($this->file_path);
    }
}
