<?php

namespace App\Livewire\Expenses;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\Project;
use App\Models\Vendor;
use Livewire\Component;

class ExpenseEdit extends Component
{
    public Expense $expense;
    
    public $title;
    public $description;
    public $amount;
    public $currency;
    public $expense_date;
    public $expense_category_id;
    public $project_id;
    public $vendor_id;
    public $payment_method;
    public $notes;
    public $receipt_path;
    public $status;

    public $projects;
    public $categories;
    public $vendors;
    public $payment_methods;

    public function mount(Expense $expense)
    {
        $this->expense = $expense;
        
        $this->title = $expense->title;
        $this->description = $expense->description;
        $this->amount = $expense->amount;
        $this->currency = $expense->currency;
        $this->expense_date = $expense->expense_date->format('Y-m-d');
        $this->expense_category_id = $expense->expense_category_id;
        $this->project_id = $expense->project_id;
        $this->vendor_id = $expense->vendor_id;
        $this->payment_method = $expense->payment_method;
        $this->notes = $expense->notes;
        $this->receipt_path = $expense->receipt_path;
        $this->status = $expense->status;

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

    public function update()
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

        $this->expense->update([
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
        ]);

        return redirect()->route('expenses.show', $this->expense);
    }

    public function render()
    {
        return view('livewire.expenses.expense-edit')->layout('components.layouts.app');
    }
}