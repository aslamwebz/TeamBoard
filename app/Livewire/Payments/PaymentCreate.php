<?php declare(strict_types=1);

namespace App\Livewire\Payments;

use App\Enums\ExpenseStatus;
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Models\Expense;
use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
final class PaymentCreate extends Component
{
    public $invoice_id;

    public $expense_id;

    public $amount;

    public $payment_method;

    public $transaction_reference;

    public $payment_date;

    public $notes;

    public $status = PaymentStatus::COMPLETED->value;

    public $currency = 'USD';

    public $invoices;

    public $expenses;

    public $payment_methods;

    public function mount(): void
    {
        abort_unless(auth()->user()?->hasRole(['admin', 'manager', 'accountant']), 403);

        $this->payment_date = now()->format('Y-m-d');
        $this->invoices = Invoice::orderBy('invoice_number')->get();
        $this->expenses = Expense::orderBy('title')->get();
        $this->payment_methods = PaymentMethod::toArray();
    }

    public function save()
    {
        abort_unless(auth()->user()?->hasRole(['admin', 'manager', 'accountant']), 403);

        $this->validate([
            'amount' => 'required|numeric|min:0.01',
            'payment_date' => 'required|date',
            'payment_method' => 'required|string|max:255',
        ]);

        // Either invoice_id or expense_id must be provided
        if (!$this->invoice_id && !$this->expense_id) {
            $this->addError('invoice_id', 'Either Invoice or Expense must be selected');
            $this->addError('expense_id', 'Either Invoice or Expense must be selected');

            return;
        }

        $payment = \Illuminate\Support\Facades\DB::transaction(function () {
            if ($this->invoice_id) {
                $invoice = Invoice::where('id', $this->invoice_id)->lockForUpdate()->firstOrFail();
                $remaining = $invoice->getRemainingBalance();
                if ((float) $this->amount > $remaining) {
                    throw \Illuminate\Validation\ValidationException::withMessages([
                        'amount' => 'Payment amount exceeds invoice remaining balance of ' . number_format($remaining, 2),
                    ]);
                }
            }

            $payment = Payment::create([
                'invoice_id' => $this->invoice_id,
                'expense_id' => $this->expense_id,
                'amount' => $this->amount,
                'payment_method' => $this->payment_method,
                'transaction_reference' => $this->transaction_reference,
                'payment_date' => $this->payment_date,
                'notes' => $this->notes,
                'status' => $this->status,
                'currency' => $this->currency,
                'user_id' => auth()->id(),
            ]);

            // Update the status of the related invoice or expense if payment is completed
            if ($payment->isCompleted()) {
                if ($payment->isForInvoice() && $payment->invoice) {
                    $payment->invoice->updateStatusFromPayment();
                } elseif ($payment->isForExpense() && $payment->expense) {
                    $payment->expense->update(['status' => ExpenseStatus::PAID->value]);
                }
            }

            return $payment;
        });

        return redirect()->route('payments.show', $payment);
    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('livewire.payments.payment-create');
    }
}
