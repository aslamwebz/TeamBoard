<div class="relative" x-data="{ show: @entangle('showDropdown') }" @click.outside="show = false">
    <!-- Notification Trigger -->
    <button 
        @click="show = !show" 
        class="relative p-2 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-200 focus:outline-none"
        aria-label="Notifications"
    >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
        </svg>
        
        @if($unreadCount > 0)
            <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">
                {{ $unreadCount }}
            </span>
        @endif
    </button>

    <!-- Notification Dropdown -->
    <div 
        x-show="show" 
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="absolute right-0 z-50 mt-2 w-80 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 dark:bg-zinc-800"
        style="display: none;"
    >
        <div class="border-b border-zinc-200 dark:border-zinc-700 p-4">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-medium text-foreground">Notifications</h3>
                <div class="flex space-x-2">
                    <button 
                        wire:click="setActiveTab('all')" 
                        class="text-sm {{ $activeTab === 'all' ? 'text-blue-600 font-medium' : 'text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300' }}"
                    >
                        All
                    </button>
                    <button 
                        wire:click="setActiveTab('unread')" 
                        class="text-sm {{ $activeTab === 'unread' ? 'text-blue-600 font-medium' : 'text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300' }}"
                    >
                        Unread
                    </button>
                </div>
            </div>
        </div>

        <div class="max-h-96 overflow-y-auto">
            @if($notifications->count() > 0)
                <ul class="divide-y divide-zinc-200 dark:divide-zinc-700">
                    @foreach($notifications as $notification)
                        <li class="px-4 py-3 {{ $notification->isRead() ? 'bg-white dark:bg-zinc-800' : 'bg-blue-50 dark:bg-zinc-700' }}">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 pt-0.5">
                                    @switch($notification->type)
                                        @case('task_assigned')
                                            <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                                </svg>
                                            </div>
                                            @break
                                        @case('new_invoice')
                                            <div class="h-8 w-8 rounded-full bg-green-100 flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                            @break
                                        @case('project_updated')
                                            <div class="h-8 w-8 rounded-full bg-yellow-100 flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                                </svg>
                                            </div>
                                            @break
                                        @case('mentioned_in_comment')
                                            <div class="h-8 w-8 rounded-full bg-purple-100 flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                                </svg>
                                            </div>
                                            @break
                                        @case('client_added')
                                            <div class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                                </svg>
                                            </div>
                                            @break
                                        @case('payment_failed')
                                            <div class="h-8 w-8 rounded-full bg-red-100 flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                </svg>
                                            </div>
                                            @break
                                        @default
                                            <div class="h-8 w-8 rounded-full bg-gray-100 flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                                </svg>
                                            </div>
                                    @endswitch
                                </div>
                                <div class="ml-3 flex-1">
                                    <p class="text-sm font-medium text-foreground">
                                        {{ $notification->message }}
                                    </p>
                                    <p class="mt-1 text-xs text-muted-foreground">
                                        {{ $notification->created_at->diffForHumans() }}
                                    </p>
                                    <div class="mt-2">
                                        @if($notification->data)
                                            @if($notification->type === 'task_assigned' && isset($notification->data['project_name']))
                                                <p class="text-xs text-muted-foreground">Project: {{ $notification->data['project_name'] }}</p>
                                            @elseif($notification->type === 'new_invoice' && isset($notification->data['client_name']))
                                                <p class="text-xs text-muted-foreground">Client: {{ $notification->data['client_name'] }}</p>
                                            @elseif($notification->type === 'mentioned_in_comment' && isset($notification->data['discussion_title']))
                                                <p class="text-xs text-muted-foreground">Discussion: {{ $notification->data['discussion_title'] }}</p>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                @if(!$notification->isRead())
                                    <button 
                                        wire:click="markAsRead({{ $notification->id }})"
                                        class="ml-2 text-xs text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300"
                                    >
                                        Mark as read
                                    </button>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="p-6 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-foreground">No notifications</h3>
                    <p class="mt-1 text-sm text-muted-foreground">You're all caught up!</p>
                </div>
            @endif
        </div>

        @if($notifications->count() > 0)
            <div class="border-t border-zinc-200 dark:border-zinc-700 p-4">
                <button 
                    wire:click="markAllAsRead"
                    class="w-full text-center text-sm font-medium text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300"
                >
                    Mark all as read
                </button>
            </div>
        @endif
    </div>
</div>