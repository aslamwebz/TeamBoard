<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\PaymentFailedNotification as PaymentFailedEvent;
use App\Services\NotificationService;

final class SendPaymentFailedNotification
{
    private $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function handle(PaymentFailedEvent $event): void
    {
        $this->notificationService->notifyPaymentFailed(
            $event->user,
            $event->paymentDetails
        );
    }
}
