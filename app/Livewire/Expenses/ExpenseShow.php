<?php

namespace App\Livewire\Expenses;

use App\Models\Expense;
use Livewire\Component;

class ExpenseShow extends Component
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
}