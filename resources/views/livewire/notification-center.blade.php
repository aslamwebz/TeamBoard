<div class="relative" x-data="{ show: @entangle('showDropdown') }">
    <!-- Notification Trigger -->
    <button 
        @click="show = !show" 
        class="relative p-2 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-200 focus:outline-none"
        aria-label="Notifications"
    >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.009 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
        </svg>
        
        @if($this->getUnreadCountProperty() > 0)
            <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">
                {{ $this->getUnreadCountProperty() }}
            </span>
        @endif
    </button>

    <!-- Notification Dropdown -->
    <div 
        x-show="show" 
        @click.away="show = false"
        class="absolute right-0 mt-2 w-80 max-h-96 overflow-y-auto bg-white dark:bg-zinc-800 rounded-lg shadow-lg border border-zinc-200 dark:border-zinc-700 z-50"
        style="display: none;"
    >
        <div class="p-1">
            <!-- Header -->
            <div class="flex items-center justify-between p-3 border-b border-zinc-200 dark:border-zinc-700">
                <h3 class="text-lg font-medium text-foreground">Notifications</h3>
                @if($this->getUnreadCountProperty() > 0)
                    <button 
                        wire:click="markAllAsRead" 
                        class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300"
                    >
                        Mark all as read
                    </button>
                @endif
            </div>

            <!-- Tabs -->
            <div class="flex border-b border-zinc-200 dark:border-zinc-700">
                <button 
                    wire:click="$set('activeTab', 'all')" 
                    class="flex-1 py-2 text-sm font-medium {{ $activeTab === 'all' ? 'text-foreground border-b-2 border-blue-500' : 'text-muted-foreground hover:text-foreground' }}"
                >
                    All ({{ $this->getNotificationsProperty()->count() }})
                </button>
                <button 
                    wire:click="$set('activeTab', 'unread')" 
                    class="flex-1 py-2 text-sm font-medium {{ $activeTab === 'unread' ? 'text-foreground border-b-2 border-blue-500' : 'text-muted-foreground hover:text-foreground' }}"
                >
                    Unread ({{ $this->getUnreadCountProperty() }})
                </button>
            </div>

            <!-- Notifications List -->
            <div>
                @forelse($this->getNotificationsProperty() as $notification)
                    <div class="border-b border-zinc-200 dark:border-zinc-700 last:border-0 {{ $notification->isRead() ? 'bg-white dark:bg-zinc-800' : 'bg-blue-50 dark:bg-zinc-700' }}">
                        <div class="p-3">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 pt-0.5">
                                    @switch($notification->type)
                                        @case('task_assigned')
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 17h.01" />
                                            </svg>
                                            @break
                                        @case('new_invoice')
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            @break
                                        @case('project_updated')
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                            </svg>
                                            @break
                                        @case('mentioned_in_comment')
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                            </svg>
                                            @break
                                        @case('client_added')
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                            @break
                                        @case('payment_failed')
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                            </svg>
                                            @break
                                        @default
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2H8l-4 4z" />
                                            </svg>
                                    @endswitch
                                </div>
                                <div class="ml-3 flex-1">
                                    <p class="text-sm font-medium text-foreground">{{ $notification->message }}</p>
                                    <p class="text-xs text-muted-foreground">{{ $notification->created_at->diffForHumans() }}</p>
                                    
                                    @if(!empty($notification->data))
                                        @if(isset($notification->data['project_name']))
                                            <p class="text-xs text-blue-600 dark:text-blue-400">Project: {{ $notification->data['project_name'] }}</p>
                                        @elseif(isset($notification->data['client_name']))
                                            <p class="text-xs text-blue-600 dark:text-blue-400">Client: {{ $notification->data['client_name'] }}</p>
                                        @endif
                                    @endif
                                </div>
                                @unless($notification->isRead())
                                    <button
                                        wire:click="markAsRead({{ $notification->id }})"
                                        class="ml-2 text-xs text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300"
                                    >
                                        Mark as read
                                    </button>
                                @endunless
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-6 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.009 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-foreground">No notifications</h3>
                        <p class="mt-1 text-sm text-muted-foreground">You're all caught up!</p>
                    </div>
                @endforelse
            </div>
            
            <!-- View All Link -->
            <div class="p-3 border-t border-zinc-200 dark:border-zinc-700 text-center">
                <a href="{{ route('notifications.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                    View all notifications
                </a>
            </div>
        </div>
    </div>
</div>