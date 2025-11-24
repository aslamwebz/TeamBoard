<x-layouts.app>
    <div class="container mx-auto px-4 py-8">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-foreground">Notifications</h1>
            <p class="text-muted-foreground">Manage and view all your notifications</p>
        </div>

        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden">
            <!-- Tabs and actions -->
            <div class="border-b border-zinc-200 dark:border-zinc-700 p-4 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div class="flex space-x-4">
                    <button 
                        wire:click="$set('activeTab', 'all')"
                        class="px-4 py-2 text-sm font-medium rounded-md {{ $activeTab === 'all' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400' : 'text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-zinc-700' }}"
                    >
                        All Notifications
                    </button>
                    <button 
                        wire:click="$set('activeTab', 'unread')"
                        class="px-4 py-2 text-sm font-medium rounded-md {{ $activeTab === 'unread' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400' : 'text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-zinc-700' }}"
                    >
                        Unread
                        @php
                            $unreadCount = auth()->user()->notifications()->whereNull('read_at')->count();
                        @endphp
                        @if($unreadCount > 0)
                            <span class="ml-2 inline-flex items-center justify-center px-2 py-0.5 text-xs font-bold leading-none text-white transform translate-x-0.5 -translate-y-0.5 bg-red-600 rounded-full">
                                {{ $unreadCount }}
                            </span>
                        @endif
                    </button>
                    <button 
                        wire:click="$set('activeTab', 'read')"
                        class="px-4 py-2 text-sm font-medium rounded-md {{ $activeTab === 'read' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400' : 'text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-zinc-700' }}"
                    >
                        Read
                    </button>
                </div>
                
                @if($activeTab !== 'read')
                    <button 
                        wire:click="markAllAsRead"
                        class="px-4 py-2 text-sm bg-blue-600 text-white rounded-md hover:bg-blue-700"
                    >
                        Mark All as Read
                    </button>
                @endif
            </div>

            <!-- Notifications list -->
            <div class="divide-y divide-zinc-200 dark:divide-zinc-700">
                @forelse($notifications as $notification)
                    <div class="p-4 {{ $notification->read_at ? 'bg-white dark:bg-zinc-800' : 'bg-blue-50 dark:bg-zinc-700/50' }}">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-1">
                                @switch($notification->type)
                                    @case('task_assigned')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7.5L14.5 2z"/>
                                            <polyline points="14 2 14 8 20 8"/>
                                        </svg>
                                        @break
                                    @case('new_invoice')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        @break
                                    @case('project_updated')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                        </svg>
                                        @break
                                    @case('mentioned_in_comment')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                        </svg>
                                        @break
                                    @case('client_added')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                        @break
                                    @case('payment_failed')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                        </svg>
                                        @break
                                    @default
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                @endswitch
                            </div>
                            <div class="ml-3 flex-1 min-w-0">
                                <p class="text-sm font-medium text-foreground">{{ $notification->message }}</p>
                                <p class="text-xs text-muted-foreground">{{ $notification->created_at->diffForHumans() }}</p>
                                
                                @if(!empty($notification->data))
                                    @if(isset($notification->data['project_name']))
                                        <p class="text-xs text-blue-600 dark:text-blue-400 mt-1">Project: {{ $notification->data['project_name'] }}</p>
                                    @elseif(isset($notification->data['client_name']))
                                        <p class="text-xs text-blue-600 dark:text-blue-400 mt-1">Client: {{ $notification->data['client_name'] }}</p>
                                    @elseif(isset($notification->data['task_title']))
                                        <p class="text-xs text-blue-600 dark:text-blue-400 mt-1">Task: {{ $notification->data['task_title'] }}</p>
                                    @endif
                                @endif
                            </div>
                            <div class="ml-4 flex flex-shrink-0">
                                @if(!$notification->read_at)
                                    <button 
                                        wire:click="markAsRead({{ $notification->id }})"
                                        class="text-xs text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300"
                                    >
                                        Mark as read
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.009 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-foreground">No notifications</h3>
                        <p class="mt-1 text-sm text-muted-foreground">You're all caught up!</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($notifications->hasPages())
                <div class="p-4 border-t border-zinc-200 dark:border-zinc-700">
                    {{ $notifications->links() }}
                </div>
            @endif>
        </div>
    </div>
</x-layouts.app>