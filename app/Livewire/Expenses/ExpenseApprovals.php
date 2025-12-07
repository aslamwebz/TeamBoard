<?php

declare(strict_types=1);

namespace App\Livewire\Expenses;

use App\Enums\ExpenseStatus;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\Project;
use App\Models\Vendor;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
#[Title('Expense Approvals')]
final class ExpenseApprovals extends Component
{
    use WithPagination;

    public $search = '';

    public $projectId = '';

    public $categoryId = '';

    public $vendorId = '';

    public $dateFrom = '';

    public $dateTo = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'projectId' => ['except' => ''],
        'categoryId' => ['except' => ''],
        'vendorId' => ['except' => ''],
        'dateFrom' => ['except' => ''],
        'dateTo' => ['except' => ''],
    ];

    public function approveExpense($expenseId): void
    {
        $expense = Expense::find($expenseId);
        if ($expense && $expense->status === ExpenseStatus::PENDING->value) {
            $expense->update([
                'status' => ExpenseStatus::APPROVED->value,
                'approver_id' => Auth::id(),
                'approved_at' => now(),
            ]);
            $this->dispatch('expense-approved');
        }
    }

    public function rejectExpense($expenseId): void
    {
        $expense = Expense::find($expenseId);
        if ($expense && $expense->status === ExpenseStatus::PENDING->value) {
            $expense->update([
                'status' => ExpenseStatus::REJECTED->value,
                'approver_id' => Auth::id(),
                'approved_at' => now(),
            ]);
            $this->dispatch('expense-rejected');
        }
    }

    public function getStatusBadgeClass(string $status): string
    {
        $expenseStatus = ExpenseStatus::tryFrom($status);
        if ($expenseStatus) {
            return $expenseStatus->getColorClass();
        }

        return 'bg-gray-100 text-gray-800';
    }

    public function render(): View
    {
        // Only show expenses that are pending approval and the current user has permission to approve
        $expenses = Expense::with(['category', 'project', 'vendor', 'user'])
            ->where('status', Expense::STATUS_PENDING)
            ->where(function ($query) {
                // This is a simplified check - in a real app, you might have specific approval permissions
                $query->where('user_id', '!=', Auth::id());  // Don't show expenses created by current user
            })
            ->when($this->search, function (Builder $query) {
                $query
                    ->where('title', 'like', '%'.$this->search.'%')
                    ->orWhere('description', 'like', '%'.$this->search.'%');
            })
            ->when($this->projectId, function (Builder $query) {
                $query->where('project_id', $this->projectId);
            })
            ->when($this->categoryId, function (Builder $query) {
                $query->where('expense_category_id', $this->categoryId);
            })
            ->when($this->vendorId, function (Builder $query) {
                $query->where('vendor_id', $this->vendorId);
            })
            ->when($this->dateFrom, function (Builder $query) {
                $query->whereDate('expense_date', '>=', $this->dateFrom);
            })
            ->when($this->dateTo, function (Builder $query) {
                $query->whereDate('expense_date', '<=', $this->dateTo);
            })
            ->orderBy('expense_date', 'desc')
            ->paginate(10);

        $projects = Project::orderBy('name')->get();
        $categories = ExpenseCategory::active()->orderBy('name')->get();
        $vendors = Vendor::orderBy('name')->get();

        return view('livewire.expenses.expense-approvals', [
            'expenses' => $expenses,
            'projects' => $projects,
            'categories' => $categories,
            'vendors' => $vendors,
        ]);
    }
}
