<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

final class SendPushNotification implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(
        public ?User $user = null,
        public ?Notification $notification = null
    ) {}

    /**
     * Execute the job when dispatched to queue.
     */
    public function handle(): void
    {
        if ($this->user && $this->notification) {
            $this->execute($this->user, $this->notification);
        }
    }

    /**
     * Execute the push notification logic.
     */
    public function execute(User $user, Notification $notification): void
    {
        Log::info(sprintf('Push notification would be sent to user %s for notification %d', $user->id, $notification->id));

        // Mark the push as sent in the database
        $notification->update(['push_sent_at' => now()]);
    }
}
