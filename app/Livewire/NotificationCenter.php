<?php

namespace App\Livewire;

use App\Models\Notification;
use App\Services\NotificationService;
use Livewire\Component;

class NotificationCenter extends Component
{
    public $showDropdown = false;
    public $previewFileId = null;

    public function mount(): void
    {
        //
    }

    public function openPreview($fileId): void
    {
        $this->previewFileId = $fileId;
        $this->showDropdown = false; // Close dropdown when opening preview

        // Dispatch event to open file preview in a modal or new page
        $this->dispatch('openFilePreview', fileId: $fileId);
    }

    public function closePreview(): void
    {
        $this->previewFileId = null;
    }

    public function getUnreadCountProperty(): int
    {
        return auth()->user()->notifications()->unread()->count();
    }

    public function getNotificationsProperty(): \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
    {
        // Always return the most recent 10 notifications for the quick preview dropdown
        return auth()->user()->notifications()->latest()->limit(10)->get();
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

    public function markAllAsRead(): void
    {
        auth()->user()->notifications()->unread()->update(['read_at' => now()]);

        // Dispatch event to update other components
        $this->dispatch('notificationsMarkedAsRead');
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        return view('livewire.notification-center', [
            'unreadCount' => $this->getUnreadCountProperty(),
            'notifications' => $this->getNotificationsProperty(),
        ]);
    }
}