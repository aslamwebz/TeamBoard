<?php declare(strict_types=1);

namespace App\Livewire\Payments;

use App\Enums\ExpenseStatus;
use App\Enums\PaymentMethod;
use App\Models\Expense;
use App\Models\Invoice;
use App\Models\Payment;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
final class PaymentEdit extends Component
{
    public Payment $payment;

    public $invoice_id;

    public $expense_id;

    public $amount;

    public $payment_method;

    public $transaction_reference;

    public $payment_date;

    public $notes;

    public $status;

    public $currency;

    public $invoices;

    public $expenses;

    public $payment_methods;

    public function mount(Payment $payment): void
    {
        $this->payment = $payment;

        $this->invoice_id = $payment->invoice_id;
        $this->expense_id = $payment->expense_id;
        $this->amount = $payment->amount;
        $this->payment_method = $payment->payment_method;
        $this->transaction_reference = $payment->transaction_reference;
        $this->payment_date = $payment->payment_date->format('Y-m-d');
        $this->notes = $payment->notes;
        $this->status = $payment->status;
        $this->currency = $payment->currency;

        $this->invoices = Invoice::orderBy('invoice_number')->get();
        $this->expenses = Expense::orderBy('title')->get();
        $this->payment_methods = PaymentMethod::toArray();
    }

    public function update()
    {
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

        $this->payment->update([
            'invoice_id' => $this->invoice_id,
            'expense_id' => $this->expense_id,
            'amount' => $this->amount,
            'payment_method' => $this->payment_method,
            'transaction_reference' => $this->transaction_reference,
            'payment_date' => $this->payment_date,
            'notes' => $this->notes,
            'status' => $this->status,
            'currency' => $this->currency,
        ]);

        // Update the status of the related invoice or expense if payment is completed
        if ($this->payment->isCompleted()) {
            if ($this->payment->isForInvoice() && $this->payment->invoice) {
                $this->payment->invoice->updateStatusFromPayment();
            } elseif ($this->payment->isForExpense() && $this->payment->expense) {
                $this->payment->expense->update(['status' => ExpenseStatus::PAID->value]);
            }
        }

        return redirect()->route('payments.show', $this->payment);
    }

    public function render()
    {
        return view('livewire.payments.payment-edit')->layout('components.layouts.app');
    }
}
