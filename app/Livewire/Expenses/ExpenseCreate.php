<?php

namespace App\Livewire\Expenses;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\Project;
use App\Models\Vendor;
use Livewire\Component;

class ExpenseCreate extends Component
{
    public $title;
    public $description;
    public $amount;
    public $currency = 'USD';
    public $expense_date;
    public $expense_category_id;
    public $project_id;
    public $vendor_id;
    public $payment_method;
    public $notes;
    public $receipt_path;
    public $status = Expense::STATUS_PENDING;

    public $projects;
    public $categories;
    public $vendors;
    public $payment_methods;

    public function mount()
    {
        $this->expense_date = now()->format('Y-m-d');
        $this->projects = Project::orderBy('name')->get();
        $this->categories = ExpenseCategory::active()->orderBy('name')->get();
        $this->vendors = Vendor::orderBy('name')->get();
        $this->payment_methods = [
            Expense::PAYMENT_CASH => 'Cash',
            Expense::PAYMENT_CREDIT_CARD => 'Credit Card',
            Expense::PAYMENT_DEBIT_CARD => 'Debit Card',
            Expense::PAYMENT_BANK_TRANSFER => 'Bank Transfer',
            Expense::PAYMENT_CHECK => 'Check',
            Expense::PAYMENT_PAYPAL => 'PayPal',
            Expense::PAYMENT_OTHER => 'Other',
        ];
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'expense_date' => 'required|date',
            'expense_category_id' => 'nullable|exists:expense_categories,id',
            'project_id' => 'nullable|exists:projects,id',
            'vendor_id' => 'nullable|exists:vendors,id',
            'payment_method' => 'nullable|string|max:255',
        ]);

        $expense = Expense::create([
            'title' => $this->title,
            'description' => $this->description,
            'amount' => $this->amount,
            'currency' => $this->currency,
            'expense_date' => $this->expense_date,
            'expense_category_id' => $this->expense_category_id,
            'project_id' => $this->project_id,
            'vendor_id' => $this->vendor_id,
            'payment_method' => $this->payment_method,
            'notes' => $this->notes,
            'receipt_path' => $this->receipt_path,
            'status' => $this->status,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('expenses.show', $expense);
    }

    public function render()
    {
        return view('livewire.expenses.expense-create')->layout('components.layouts.app');
    }
}