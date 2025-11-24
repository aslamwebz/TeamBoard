<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PaymentFailedNotification
{
    use Dispatchable, SerializesModels;

    public $user;
    public $paymentDetails;

    /**
     * Create a new event instance.
     */
    public function __construct(User $user, $paymentDetails = null)
    {
        $this->user = $user;
        $this->paymentDetails = $paymentDetails;
    }
}