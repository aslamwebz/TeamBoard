<?php

namespace App\Livewire;

use App\Models\Notification;
use App\Services\NotificationService;
use Livewire\Component;

class NotificationDropdown extends Component
{
    public $unreadCount = 0;
    public $notifications = [];
    public $showDropdown = false;

    protected $listeners = [
        'refreshNotifications' => 'refresh',
        'notificationRead' => 'decrementUnreadCount',
    ];

    public function mount(): void
    {
        $this->loadUnreadCount();
        $this->loadNotifications();
    }

    public function loadUnreadCount(): void
    {
        $this->unreadCount = auth()->user()->notifications()->unread()->count();
    }

    public function loadNotifications(): void
    {
        $this->notifications = auth()->user()
            ->notifications()
            ->latest()
            ->limit(10)
            ->get();
    }

    public function markAsRead($notificationId): void
    {
        $notification = auth()->user()->notifications()
            ->where('id', $notificationId)
            ->first();

        if ($notification && !$notification->isRead()) {
            $notification->markAsRead();
            $this->decrementUnreadCount();
            $this->loadNotifications(); // Reload notifications to update UI

            // Dispatch event to let other components know about the update
            $this->dispatch('notificationRead');
        }
    }

    public function markAllAsRead(): void
    {
        auth()->user()->notifications()->unread()->update(['read_at' => now()]);
        $this->unreadCount = 0;
        $this->loadNotifications(); // Reload notifications

        // Dispatch event to let other components know about the update
        $this->dispatch('notificationsMarkedAsRead');
    }

    public function decrementUnreadCount(): void
    {
        $this->unreadCount = max(0, $this->unreadCount - 1);
    }

    public function refresh(): void
    {
        $this->loadUnreadCount();
        $this->loadNotifications();
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        return view('livewire.notification-dropdown');
    }
}