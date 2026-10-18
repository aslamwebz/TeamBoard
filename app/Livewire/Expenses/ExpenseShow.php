<?php

declare(strict_types=1);

namespace App\Livewire\Expenses;

use App\Enums\ExpenseStatus;
use App\Models\Expense;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Expense Show')]
final class ExpenseShow extends Component
{
    public Expense $expense;

    public function mount(Expense $expense): void
    {
        $this->expense = $expense->load([
            'category', 'project', 'vendor', 'user', 'approver', 'attachments',
        ]);
    }

    public function getExpenseStatusBadgeClass(string $status): string
    {
        $expenseStatus = ExpenseStatus::tryFrom($status);
        if ($expenseStatus) {
            return $expenseStatus->getColorClass();
        }

        return 'bg-gray-100 text-gray-800';
    }

    public function render(): View
    {
        return view('livewire.expenses.expense-show');
    }
}
