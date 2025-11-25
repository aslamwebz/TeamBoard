<?php

namespace App\Models;

use App\Models\Vendor;
use App\Models\ExpenseCategory;
use App\Models\Project;
use App\Models\ExpenseAttachment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'category_id',
        'name',
        'description',
        'amount',
        'expense_date',
        'status',
        'receipt_url',
        'notes',
        'project_id',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'expense_date' => 'date',
    ];

    /**
     * Get the vendor associated with this expense.
     */
    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    /**
     * Get the category of this expense.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(ExpenseCategory::class, 'category_id');
    }

    /**
     * Get the project associated with this expense.
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Get the attachments for this expense.
     */
    public function attachments()
    {
        return $this->hasMany(ExpenseAttachment::class);
    }
}