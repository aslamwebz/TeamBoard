<?php

namespace App\Livewire\Notifications;

use App\Models\Notification;
use App\Services\NotificationService;
use Livewire\Component;
use Livewire\Attributes\On;

class NotificationCenter extends Component
{
    public $unreadCount = 0;
    public $notifications = [];
    public $showDropdown = false;
    public $activeTab = 'all'; // all, unread
    
    protected $notificationService;

    public function boot(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function mount()
    {
        $this->loadNotifications();
    }

    #[On('refresh-notifications')]
    public function refreshNotifications()
    {
        $this->loadNotifications();
    }

    public function loadNotifications()
    {
        $user = auth()->user();
        if (!$user) {
            return;
        }
        
        // Get the unread count
        $this->unreadCount = $this->notificationService->getUnreadNotifications($user)->count();
        
        // Get the notifications based on the active tab
        if ($this->activeTab === 'unread') {
            $this->notifications = $this->notificationService->getUnreadNotifications($user);
        } else {
            $this->notifications = $this->notificationService->getAllNotifications($user, 10);
        }
    }

    public function markAsRead($notificationId)
    {
        $this->notificationService->markAsRead($notificationId, auth()->id());
        $this->loadNotifications(); // Reload to update counts
        
        // Refresh the notification dropdown after marking as read
        $this->dispatch('refresh-notification-count');
    }

    public function markAllAsRead()
    {
        $this->notificationService->markAllAsRead(auth()->user());
        $this->loadNotifications(); // Reload to update counts
        
        // Refresh the notification dropdown after marking all as read
        $this->dispatch('refresh-notification-count');
    }

    public function toggleDropdown()
    {
        $this->showDropdown = !$this->showDropdown;
        
        if ($this->showDropdown) {
            // Load notifications when dropdown opens
            $this->loadNotifications();
        }
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
        $this->loadNotifications(); // Reload based on new tab
    }

    public function render()
    {
        return view('livewire.notifications.notification-center', [
            'unreadCount' => $this->unreadCount,
            'notifications' => $this->notifications,
            'showDropdown' => $this->showDropdown,
            'activeTab' => $this->activeTab,
        ]);
    }
}