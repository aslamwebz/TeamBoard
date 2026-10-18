<?php

declare(strict_types=1);

namespace App\Models;

use App\Helpers\TenantHelper;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int|null $user_id
 * @property string $title
 * @property string|null $description
 * @property string $report_type
 * @property array|null $data
 * @property CarbonInterface|null $generated_at
 * @property string $status
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 */
final class Report extends Model
{
    use HasFactory;

    public const string TYPE_FINANCIAL = 'financial';

    public const string TYPE_PROJECT = 'project';

    public const string TYPE_INVOICE = 'invoice';

    public const string TYPE_CLIENT = 'client';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'report_type',
        'data',
        'generated_at',
        'status',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'data' => 'array',
        'generated_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the company name for the report
     */
    public function getCompanyName(): string
    {
        return TenantHelper::getCompanyName() ?? config('app.name', 'App Name');
    }

    /**
     * Get the company address for the report
     */
    public function getCompanyAddress(): ?string
    {
        return TenantHelper::getCompanyAddress();
    }

    /**
     * Get the default currency for the report
     */
    public function getDefaultCurrency(): string
    {
        return TenantHelper::getDefaultCurrency();
    }

    /**
     * Get the monthly reports for this report template.
     */
    public function monthlyReports()
    {
        return $this->hasMany(MonthlyReport::class);
    }
}
