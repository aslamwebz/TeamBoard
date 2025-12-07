<?php

declare(strict_types=1);

namespace App\Livewire\Expenses;

use App\Enums\ExpenseStatus;
use App\Enums\PaymentMethod;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\Project;
use App\Models\Vendor;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Expense Create')]
final class ExpenseCreate extends Component
{
    public Expense $expense;

    public $projects;

    public $categories;

    public $vendors;

    public $payment_methods;

    public $statuses;

    public function rules(): array
    {
        return [
            'expense.title' => 'required|string|max:255',
            'expense.amount' => 'required|numeric|min:0.01',
            'expense.expense_date' => 'required|date',
            'expense.expense_category_id' => 'nullable|exists:expense_categories,id',
            'expense.project_id' => 'nullable|exists:projects,id',
            'expense.vendor_id' => 'nullable|exists:vendors,id',
            'expense.payment_method' => 'nullable|in:'.implode(',', array_keys(PaymentMethod::toArray())),
            'expense.status' => 'required|in:'.implode(',', array_keys(ExpenseStatus::toArray())),
        ];
    }

    public function mount(): void
    {
        $this->expense = new Expense([
            'currency' => 'USD',
            'expense_date' => now()->format('Y-m-d'),
            'status' => ExpenseStatus::PENDING->value,
        ]);

        $this->projects = Project::orderBy('name')->get();
        $this->categories = ExpenseCategory::active()->orderBy('name')->get();
        $this->vendors = Vendor::orderBy('name')->get();
        $this->payment_methods = PaymentMethod::toArray();
        $this->statuses = ExpenseStatus::toArray();
    }

    public function save(): RedirectResponse
    {
        $this->validate($this->rules());

        $this->expense->user_id = Auth::id();
        $this->expense->save();

        return redirect()->route('expenses.show', $this->expense);
    }

    public function render(): View
    {
        return view('livewire.expenses.expense-create');
    }
}
