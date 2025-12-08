<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int|null $report_id
 * @property CarbonInterface $period_start
 * @property CarbonInterface $period_end
 * @property array|null $data
 * @property CarbonInterface|null $generated_at
 * @property int|null $generated_by
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 */
final class MonthlyReport extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'report_id',
        'period_start',
        'period_end',
        'data',
        'generated_at',
        'generated_by',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'period_start' => 'date',
        'period_end' => 'date',
        'data' => 'array',
        'generated_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the report that this monthly report belongs to.
     */
    public function report(): BelongsTo
    {
        return $this->belongsTo(Report::class);
    }

    /**
     * Get the user who generated this report.
     */
    public function generatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'generated_by');
    }
}
