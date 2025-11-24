<?php

namespace App\Livewire;

use App\Models\Notification;
use App\Services\NotificationService;
use Livewire\Component;

class NotificationCenter extends Component
{
    public $showDropdown = false;
    public $activeTab = 'all'; // 'all', 'read', 'unread'
    public $previewFileId = null;

    public function mount()
    {
        //
    }

    public function openPreview($fileId)
    {
        $this->previewFileId = $fileId;
        $this->showDropdown = false; // Close dropdown when opening preview

        // Dispatch event to open file preview in a modal or new page
        $this->dispatch('openFilePreview', fileId: $fileId);
    }

    public function closePreview()
    {
        $this->previewFileId = null;
    }

    public function getUnreadCountProperty()
    {
        return auth()->user()->notifications()->unread()->count();
    }

    public function getNotificationsProperty()
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

        return $query->latest()->limit(10)->get();
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
        return view('livewire.notification-center', [
            'unreadCount' => $this->getUnreadCountProperty(),
            'notifications' => $this->getNotificationsProperty(),
        ]);
    }
}