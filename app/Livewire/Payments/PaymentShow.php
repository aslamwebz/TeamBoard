<?php

namespace App\Livewire\Payments;

use App\Models\Payment;
use Livewire\Component;

class PaymentShow extends Component
{
    public Payment $payment;

    public function mount(Payment $payment)
    {
        $this->payment = $payment->load(['invoice', 'expense', 'user']);
    }

    public function render()
    {
        return view('livewire.payments.payment-show')->layout('components.layouts.app');
    }
}