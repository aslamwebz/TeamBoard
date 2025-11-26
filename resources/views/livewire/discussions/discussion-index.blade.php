<div class="max-w-6xl mx-auto p-6">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold text-foreground">Discussions</h1>
            <p class="text-muted-foreground">Engage in conversations and collaborate with your team</p>
        </div>
        <flux:button :href="route('discussions.create')" variant="primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 mr-2">
                <path d="M5 12h14"></path>
                <path d="M12 5v14"></path>
            </svg>
            New Discussion
        </flux:button>
    </div>

    <!-- Search and Filters -->
    <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-4 mb-6">
        <div class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <flux:input 
                    wire:model.live="search" 
                    placeholder="Search discussions..." 
                    icon="magnifying-glass" 
                />
            </div>
            <div>
                <flux:select 
                    wire:model.live="sortBy" 
                    label="Sort by"
                >
                    <option value="latest">Latest</option>
                    <option value="oldest">Oldest</option>
                    <option value="popular">Most Popular</option>
                </flux:select>
            </div>
        </div>
    </div>

    <!-- Discussions List -->
    @if($discussions->count() > 0)
        <div class="space-y-4">
            @foreach($discussions as $discussion)
                <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6 hover:shadow-md transition-shadow">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                <h3 class="text-lg font-semibold text-foreground">
                                    <a href="{{ route('discussions.show', $discussion) }}" class="hover:text-blue-600 dark:hover:text-blue-400">
                                        {{ $discussion->title }}
                                    </a>
                                </h3>
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400">
                                    {{ ucfirst($discussion->type) }}
                                </span>
                            </div>
                            
                            <p class="text-sm text-muted-foreground mb-3 line-clamp-2">
                                {{ Str::limit(strip_tags($discussion->content), 150) }}
                            </p>
                            
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-4 text-sm text-muted-foreground">
                                    <div class="flex items-center gap-1">
                                        <img src="{{ $discussion->user->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($discussion->user->name) }}" 
                                             alt="{{ $discussion->user->name }}" 
                                             class="w-6 h-6 rounded-full">
                                        <span>{{ $discussion->user->name }}</span>
                                    </div>
                                    <span>{{ $discussion->created_at->diffForHumans() }}</span>
                                    <span>{{ $discussion->getCommentCount() }} comments</span>
                                </div>
                                
                                @if($discussion->attachments->count() > 0)
                                    <div class="flex items-center gap-1 text-sm text-muted-foreground">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                                            <path d="M21.2 8.4c.4-.4.4-1 0-1.4l-7-7a1 1 0 0 0-1.4 0L3 9.8V14a1 1 0 0 0 1 1h4.2l9.8-9.8c.4-.4 1-.4 1.4 0s.4 1 0 1.4L9.6 19.2H5a1 1 0 0 1-1-1v-4.2L13.8 5.2l4.8 4.8 1.4-1.4-4.8-4.8z"/>
                                        </svg>
                                        {{ $discussion->attachments->count() }} attachment(s)
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="mt-6">
            {{ $discussions->links() }}
        </div>
    @else
        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-12 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-foreground">No discussions</h3>
            <p class="mt-1 text-sm text-muted-foreground">Get started by creating a new discussion.</p>
            <div class="mt-6">
                <flux:button :href="route('discussions.create')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Create Discussion
                </flux:button>
            </div>
        </div>
    @endif
</div>