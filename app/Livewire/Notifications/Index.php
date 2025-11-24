<?php

namespace App\Livewire\Notifications;

use App\Models\Notification;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $activeTab = 'all'; // 'all', 'read', 'unread'
    public $perPage = 15;

    public function mount()
    {
        //
    }

    public function getUnreadCountProperty()
    {
        return auth()->user()->notifications()->unread()->count();
    }

    public function getNotificationsQueryProperty()
    {
        $query = auth()->user()->notifications();

        switch ($this->activeTab) {
            case 'unread':
                $query = $query->unread();
                break;
            case 'read':
                $query = $query->read();
                break;
        }

        return $query->latest();
    }

    public function getNotificationsProperty()
    {
        return $this->getNotificationsQueryProperty()->paginate($this->perPage);
    }

    public function markAsRead($notificationId)
    {
        $notification = auth()->user()->notifications()->find($notificationId);

        if ($notification) {
            $notification->markAsRead();
        }

        // Dispatch event to update other components
        $this->dispatch('notificationRead');
    }

    public function markAllAsRead()
    {
        auth()->user()->notifications()->unread()->update(['read_at' => now()]);

        // Dispatch event to update other components
        $this->dispatch('notificationsMarkedAsRead');
    }

    public function render()
    {
        return view('livewire.notifications.index', [
            'notifications' => $this->getNotificationsProperty(),
            'unreadCount' => $this->getUnreadCountProperty(),
        ]);
    }
}