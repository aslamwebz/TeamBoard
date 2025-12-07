<?php declare(strict_types=1);

namespace App\Models;

use App\Enums\ReportStatus;
use App\Helpers\TenantHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

final class Report extends Model
{
    use HasFactory;

    public const TYPE_FINANCIAL = 'financial';

    public const TYPE_PROJECT = 'project';

    public const TYPE_INVOICE = 'invoice';

    public const TYPE_CLIENT = 'client';

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
