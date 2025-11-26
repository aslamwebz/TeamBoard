<?php

namespace App\Livewire\Expenses;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\Project;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ExpenseIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $projectId = '';
    public $categoryId = '';
    public $vendorId = '';
    public $status = '';
    public $dateFrom = '';
    public $dateTo = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'projectId' => ['except' => ''],
        'categoryId' => ['except' => ''],
        'vendorId' => ['except' => ''],
        'status' => ['except' => ''],
        'dateFrom' => ['except' => ''],
        'dateTo' => ['except' => ''],
    ];

    public function render()
    {
        $expenses = Expense::with(['category', 'project', 'vendor', 'user'])
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
            ->when($this->status, function (Builder $query) {
                $query->where('status', $this->status);
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
        $statuses = [
            Expense::STATUS_PENDING => 'Pending',
            Expense::STATUS_APPROVED => 'Approved',
            Expense::STATUS_REJECTED => 'Rejected',
            Expense::STATUS_PAID => 'Paid',
            Expense::STATUS_CANCELLED => 'Cancelled',
        ];

        return view('livewire.expenses.expense-index', [
            'expenses' => $expenses,
            'projects' => $projects,
            'categories' => $categories,
            'vendors' => $vendors,
            'statuses' => $statuses,
        ])->layout('components.layouts.app');
    }

    public function deleteExpense($expenseId)
    {
        $expense = Expense::find($expenseId);
        if ($expense) {
            $expense->delete();
            $this->dispatch('expense-deleted');
        }
    }

    public function approveExpense($expenseId)
    {
        $expense = Expense::find($expenseId);
        if ($expense && auth()->user()->can('approve_expense', $expense)) {
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
        if ($expense && auth()->user()->can('approve_expense', $expense)) {
            $expense->update([
                'status' => Expense::STATUS_REJECTED,
                'approver_id' => auth()->id(),
                'approved_at' => now(),
            ]);
            $this->dispatch('expense-rejected');
        }
    }
}