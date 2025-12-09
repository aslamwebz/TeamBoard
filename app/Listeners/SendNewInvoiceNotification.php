<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\NewInvoiceNotification as NewInvoiceEvent;
use App\Services\NotificationService;

final readonly class SendNewInvoiceNotification
{
    public function __construct(private \App\Services\NotificationService $notificationService)
    {
    }

    public function handle(NewInvoiceEvent $event): void
    {
        $this->notificationService->notifyNewInvoice(
            $event->invoice,
            $event->user
        );
    }
}
