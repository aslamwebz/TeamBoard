<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\PaymentFailedNotification as PaymentFailedEvent;
use App\Services\NotificationService;

final readonly class SendPaymentFailedNotification
{
    public function __construct(private \App\Services\NotificationService $notificationService)
    {
    }

    public function handle(PaymentFailedEvent $event): void
    {
        $this->notificationService->notifyPaymentFailed(
            $event->user,
            $event->paymentDetails
        );
    }
}
