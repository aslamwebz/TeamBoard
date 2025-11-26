<?php

namespace App\Livewire\Expenses;

use App\Models\Expense;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class ExpenseApprovals extends Component
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

    public function render()
    {
        // Only show expenses that are pending approval and the current user has permission to approve
        $expenses = Expense::with(['category', 'project', 'vendor', 'user'])
            ->where('status', Expense::STATUS_PENDING)
            ->where(function ($query) {
                // This is a simplified check - in a real app, you might have specific approval permissions
                $query->where('user_id', '!=', auth()->id()); // Don't show expenses created by current user
            })
            ->when($this->search, function (Builder $query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%');
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

        $projects = \App\Models\Project::orderBy('name')->get();
        $categories = \App\Models\ExpenseCategory::active()->orderBy('name')->get();
        $vendors = \App\Models\Vendor::orderBy('name')->get();

        return view('livewire.expenses.expense-approvals', [
            'expenses' => $expenses,
            'projects' => $projects,
            'categories' => $categories,
            'vendors' => $vendors,
        ])->layout('components.layouts.app');
    }

    public function approveExpense($expenseId)
    {
        $expense = Expense::find($expenseId);
        if ($expense && $expense->status === Expense::STATUS_PENDING) {
            $expense->update([
                'status' => Expense::STATUS_APPROVED,
                'approver_id' => auth()->id(),
                'approved_at' => now(),
            ]);
            $this->dispatch('expense-approved');
        }
    }

    public function rejectExpense($expenseId)
    {
        $expense = Expense::find($expenseId);
        if ($expense && $expense->status === Expense::STATUS_PENDING) {
            $expense->update([
                'status' => Expense::STATUS_REJECTED,
                'approver_id' => auth()->id(),
                'approved_at' => now(),
            ]);
            $this->dispatch('expense-rejected');
        }
    }
}