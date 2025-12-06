<?php

declare(strict_types=1);

namespace App\Livewire\Payments;

use App\Models\Payment;
use Livewire\Component;

final class PaymentShow extends Component
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

    public function getPaymentStatusBadgeClass(string $status): string
    {
        $paymentStatus = \App\Enums\PaymentStatus::tryFrom($status);
        if ($paymentStatus) {
            return $paymentStatus->getColorClass();
        }

        return 'bg-gray-100 text-gray-800';
    }
}
