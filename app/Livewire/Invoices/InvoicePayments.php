<?php declare(strict_types=1);

namespace App\Livewire\Invoices;

use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
final class InvoicePayments extends Component
{
    public Invoice $invoice;

    public $paymentAmount;

    public $paymentMethod;

    public $transactionReference;

    public $paymentDate;

    public $notes;

    public $paymentMethods;

    public function mount(Invoice $invoice): void
    {
        $this->invoice = $invoice;
        $this->paymentAmount = $invoice->getRemainingBalance();
        $this->paymentDate = now()->format('Y-m-d');
        $this->paymentMethods = PaymentMethod::toArray();
    }

    public function addPayment(): void
    {
        $this->validate([
            'paymentAmount' => 'required|numeric|min:0.01|max:' . $this->invoice->getRemainingBalance(),
            'paymentDate' => 'required|date',
            'paymentMethod' => 'required|string|max:255',
        ]);

        Payment::create([
            'invoice_id' => $this->invoice->id,
            'amount' => $this->paymentAmount,
            'payment_method' => $this->paymentMethod,
            'transaction_reference' => $this->transactionReference,
            'payment_date' => $this->paymentDate,
            'notes' => $this->notes,
            'status' => PaymentStatus::COMPLETED->value,
            'currency' => $this->invoice->getDefaultCurrency(),
            'user_id' => auth()->id(),
        ]);

        // Update invoice status based on payments
        $this->invoice->updateStatusFromPayment();

        // Reset form
        $this->paymentAmount = $this->invoice->getRemainingBalance();
        $this->transactionReference = '';
        $this->notes = '';

        $this->dispatch('payment-added');
    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $payments = $this->invoice->payments()->orderBy('payment_date', 'desc')->get();

        return view('livewire.invoices.invoice-payments', [
            'payments' => $payments,
        ]);
    }

    public function getPaymentStatusBadgeClass(string $status): string
    {
        $paymentStatus = \App\Enums\PaymentStatus::tryFrom($status);
        if ($paymentStatus) {
            return $paymentStatus->getColorClass();
        }

        return 'bg-gray-100 text-gray-800';
    }
}
