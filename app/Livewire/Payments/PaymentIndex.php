<?php

namespace App\Livewire\Payments;

use App\Models\Payment;
use App\Models\Invoice;
use App\Models\Expense;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class PaymentIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $invoiceId = '';
    public $expenseId = '';
    public $userId = '';
    public $status = '';
    public $dateFrom = '';
    public $dateTo = '';
    public $paymentMethod = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'invoiceId' => ['except' => ''],
        'expenseId' => ['except' => ''],
        'userId' => ['except' => ''],
        'status' => ['except' => ''],
        'dateFrom' => ['except' => ''],
        'dateTo' => ['except' => ''],
        'paymentMethod' => ['except' => ''],
    ];

    public function render()
    {
        $payments = Payment::with(['invoice', 'expense', 'user'])
            ->when($this->search, function (Builder $query) {
                $query->where('transaction_reference', 'like', '%' . $this->search . '%')
                      ->orWhere('notes', 'like', '%' . $this->search . '%');
            })
            ->when($this->invoiceId, function (Builder $query) {
                $query->where('invoice_id', $this->invoiceId);
            })
            ->when($this->expenseId, function (Builder $query) {
                $query->where('expense_id', $this->expenseId);
            })
            ->when($this->userId, function (Builder $query) {
                $query->where('user_id', $this->userId);
            })
            ->when($this->status, function (Builder $query) {
                $query->where('status', $this->status);
            })
            ->when($this->paymentMethod, function (Builder $query) {
                $query->where('payment_method', $this->paymentMethod);
            })
            ->when($this->dateFrom, function (Builder $query) {
                $query->whereDate('payment_date', '>=', $this->dateFrom);
            })
            ->when($this->dateTo, function (Builder $query) {
                $query->whereDate('payment_date', '<=', $this->dateTo);
            })
            ->orderBy('payment_date', 'desc')
            ->paginate(10);

        $invoices = Invoice::orderBy('invoice_number')->get();
        $expenses = Expense::orderBy('title')->get();
        $users = User::orderBy('name')->get();
        $statuses = [
            Payment::STATUS_PENDING => 'Pending',
            Payment::STATUS_PROCESSING => 'Processing',
            Payment::STATUS_COMPLETED => 'Completed',
            Payment::STATUS_FAILED => 'Failed',
            Payment::STATUS_REFUNDED => 'Refunded',
            Payment::STATUS_CANCELLED => 'Cancelled',
        ];
        $paymentMethods = [
            Payment::PAYMENT_CASH => 'Cash',
            Payment::PAYMENT_CREDIT_CARD => 'Credit Card',
            Payment::PAYMENT_DEBIT_CARD => 'Debit Card',
            Payment::PAYMENT_BANK_TRANSFER => 'Bank Transfer',
            Payment::PAYMENT_CHECK => 'Check',
            Payment::PAYMENT_PAYPAL => 'PayPal',
            Payment::PAYMENT_STRIPE => 'Stripe',
            Payment::PAYMENT_OTHER => 'Other',
        ];

        return view('livewire.payments.payment-index', [
            'payments' => $payments,
            'invoices' => $invoices,
            'expenses' => $expenses,
            'users' => $users,
            'statuses' => $statuses,
            'paymentMethods' => $paymentMethods,
        ])->layout('components.layouts.app');
    }

    public function deletePayment($paymentId)
    {
        $payment = Payment::find($paymentId);
        if ($payment) {
            $payment->delete();
            $this->dispatch('payment-deleted');
        }
    }
}