<?php

namespace App\Livewire\NotificationList;

use App\Models\Notification;
use Livewire\Component;
use Livewire\WithPagination;

class NotificationList extends Component
{
    use WithPagination;

    public string $activeTab = 'all';  // 'all', 'read', 'unread'
    public int $perPage = 15;

    public $listeners = [
        'switchTab' => 'switchTab'
    ];

    public function getUnreadCountProperty(): int
    {
        return auth()->user()->notifications()->unread()->count();
    }

    public function getNotificationsQueryProperty()
    {
        $query = auth()->user()->notifications();

        switch ($this->activeTab) {
            case 'unread':
                $query = $query->whereNull('read_at');
                break;
            case 'read':
                $query = $query->whereNotNull('read_at');
                break;
        }

        return $query->latest();
    }

    public function getNotificationsProperty()
    {
        return $this->getNotificationsQueryProperty()->paginate($this->perPage);
    }

    public function markAsRead($notificationId): void
    {
        $notification = auth()->user()->notifications()->find($notificationId);

        if ($notification) {
            $notification->markAsRead();
        }

        // Dispatch event to update other components
        $this->dispatch('notificationRead');
    }

    public function switchTab($tab): void
    {
        $this->activeTab = $tab;
    }

    public function markAllAsRead(): void
    {
        auth()->user()->notifications()->unread()->update(['read_at' => now()]);

        // Dispatch event to update other components
        $this->dispatch('notificationsMarkedAsRead');
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        return view('livewire.notificationlist.notification-list', [
            'notifications' => $this->getNotificationsProperty(),
            'unreadCount' => $this->getUnreadCountProperty(),
        ]);
    }
}
