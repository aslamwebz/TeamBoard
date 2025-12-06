<?php

declare(strict_types=1);

namespace App\Livewire\Expenses;

use App\Models\Expense;
use Livewire\Component;

final class ExpenseShow extends Component
{
    public Expense $expense;

    public function mount(Expense $expense)
    {
        $this->expense = $expense->load(['category', 'project', 'vendor', 'user', 'approver', 'attachments']);
    }

    public function render()
    {
        return view('livewire.expenses.expense-show')->layout('components.layouts.app');
    }

    public function getExpenseStatusBadgeClass(string $status): string
    {
        $expenseStatus = \App\Enums\ExpenseStatus::tryFrom($status);
        if ($expenseStatus) {
            return $expenseStatus->getColorClass();
        }

        return 'bg-gray-100 text-gray-800';
    }
}
