<?php declare(strict_types=1);

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
#[Title('Expense Index')]
final class ExpenseIndex extends Component
{
    use WithPagination;

    public $search = '';

    public $projectId = '';

    public $categoryId = '';

    public $vendorId = '';

    public $status = '';

    public $dateFrom = '';

    public $dateTo = '';

    private array $queryString = [
        'search' => ['except' => ''],
        'projectId' => ['except' => ''],
        'categoryId' => ['except' => ''],
        'vendorId' => ['except' => ''],
        'status' => ['except' => ''],
        'dateFrom' => ['except' => ''],
        'dateTo' => ['except' => ''],
    ];

    public function deleteExpense(int $expenseId): void
    {
        $expense = Expense::find($expenseId);
        if ($expense) {
            $expense->delete();
            $this->dispatch('expense-deleted');
        }
    }

    public function approveExpense(int $expenseId): void
    {
        $expense = Expense::find($expenseId);
        if ($expense && Auth::user()->can('approve_expense', $expense)) {
            $expense->update([
                'status' => ExpenseStatus::APPROVED->value,
                'approver_id' => Auth::id(),
                'approved_at' => now(),
            ]);
            $this->dispatch('expense-approved');
        }
    }

    public function rejectExpense(int $expenseId): void
    {
        $expense = Expense::find($expenseId);
        if ($expense && Auth::user()->can('approve_expense', $expense)) {
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
        $expenses = Expense::with(['category', 'project', 'vendor', 'user'])
            ->when($this->search, function (Builder $query): void {
                $query
                    ->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->when($this->projectId, function (Builder $query): void {
                $query->where('project_id', $this->projectId);
            })
            ->when($this->categoryId, function (Builder $query): void {
                $query->where('expense_category_id', $this->categoryId);
            })
            ->when($this->vendorId, function (Builder $query): void {
                $query->where('vendor_id', $this->vendorId);
            })
            ->when($this->status, function (Builder $query): void {
                $query->where('status', $this->status);
            })
            ->when($this->dateFrom, function (Builder $query): void {
                $query->whereDate('expense_date', '>=', $this->dateFrom);
            })
            ->when($this->dateTo, function (Builder $query): void {
                $query->whereDate('expense_date', '<=', $this->dateTo);
            })
            ->orderBy('expense_date', 'desc')
            ->paginate(10);

        $projects = Project::orderBy('name')->get();
        $categories = ExpenseCategory::active()->orderBy('name')->get();
        $vendors = Vendor::orderBy('name')->get();
        $statuses = ExpenseStatus::toArray();

        return view('livewire.expenses.expense-index', [
            'expenses' => $expenses,
            'projects' => $projects,
            'categories' => $categories,
            'vendors' => $vendors,
            'statuses' => $statuses,
        ]);
    }
}
