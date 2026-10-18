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
        $this->authorize('update', $invoice);

        $this->invoice = $invoice;
        $this->paymentAmount = $invoice->getRemainingBalance();
        $this->paymentDate = now()->format('Y-m-d');
        $this->paymentMethods = PaymentMethod::toArray();
    }

    public function addPayment(): void
    {
        $this->authorize('update', $this->invoice);

        $remaining = $this->invoice->getRemainingBalance();

        $this->validate([
            'paymentAmount' => 'required|numeric|min:0.01|max:' . max(0.01, $remaining),
            'paymentDate' => 'required|date',
            'paymentMethod' => 'required|string|max:255',
        ]);

        \Illuminate\Support\Facades\DB::transaction(function (): void {
            $lockedInvoice = Invoice::where('id', $this->invoice->id)->lockForUpdate()->firstOrFail();
            $lockedRemaining = $lockedInvoice->getRemainingBalance();

            if ((float) $this->paymentAmount > $lockedRemaining) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'paymentAmount' => 'Payment amount exceeds remaining balance of ' . number_format($lockedRemaining, 2),
                ]);
            }

            Payment::create([
                'invoice_id' => $lockedInvoice->id,
                'amount' => $this->paymentAmount,
                'payment_method' => $this->paymentMethod,
                'transaction_reference' => $this->transactionReference,
                'payment_date' => $this->paymentDate,
                'notes' => $this->notes,
                'status' => PaymentStatus::COMPLETED->value,
                'currency' => $lockedInvoice->getDefaultCurrency(),
                'user_id' => auth()->id(),
            ]);

            // Update invoice status based on payments
            $lockedInvoice->updateStatusFromPayment();

            $this->invoice = $lockedInvoice->fresh();
        });

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
