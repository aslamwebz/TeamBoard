<?php

namespace App\Livewire\Invoices;

use App\Models\Invoice;
use App\Models\Payment;
use Livewire\Component;

class InvoicePayments extends Component
{
    public Invoice $invoice;
    public $paymentAmount;
    public $paymentMethod;
    public $transactionReference;
    public $paymentDate;
    public $notes;

    public $payment_methods;

    public function mount(Invoice $invoice)
    {
        $this->invoice = $invoice;
        $this->paymentAmount = $invoice->getRemainingBalance();
        $this->paymentDate = now()->format('Y-m-d');
        $this->payment_methods = [
            Payment::PAYMENT_CASH => 'Cash',
            Payment::PAYMENT_CREDIT_CARD => 'Credit Card',
            Payment::PAYMENT_DEBIT_CARD => 'Debit Card',
            Payment::PAYMENT_BANK_TRANSFER => 'Bank Transfer',
            Payment::PAYMENT_CHECK => 'Check',
            Payment::PAYMENT_PAYPAL => 'PayPal',
            Payment::PAYMENT_STRIPE => 'Stripe',
            Payment::PAYMENT_OTHER => 'Other',
        ];
    }

    public function addPayment()
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
            'status' => Payment::STATUS_COMPLETED,
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

    public function render()
    {
        $payments = $this->invoice->payments()->orderBy('payment_date', 'desc')->get();
        
        return view('livewire.invoices.invoice-payments', [
            'payments' => $payments,
        ])->layout('components.layouts.app');
    }
}