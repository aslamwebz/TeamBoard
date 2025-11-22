<div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700">
    <div class="p-4 border-b border-zinc-200 dark:border-zinc-700">
        <h3 class="text-lg font-semibold text-foreground">Activity Feed</h3>
    </div>

    @if(isset($activities) && $activities->count() > 0)
        <div class="divide-y divide-zinc-200 dark:divide-zinc-700">
            @foreach($activities as $activity)
                <div class="p-4 hover:bg-zinc-50 dark:hover:bg-zinc-800/50">
                    <div class="flex items-start gap-3">
                        <img
                            src="{{ $activity->user->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($activity->user->name ?? 'User') }}"
                            alt="{{ $activity->user->name ?? 'User' }}"
                            class="w-8 h-8 rounded-full flex-shrink-0"
                        >

                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2">
                                <span class="font-medium text-foreground">{{ $activity->user->name ?? 'System' }}</span>
                                <span class="text-xs text-muted-foreground">{{ $activity->created_at->diffForHumans() }}</span>
                            </div>
                            
                            <p class="text-sm text-foreground mt-1">
                                {{ $activity->getHumanDescription() }}
                            </p>
                            
                            @if(isset($activity->metadata['comment_content']))
                                <p class="text-sm text-muted-foreground mt-1 pl-5 border-l-2 border-zinc-200 dark:border-zinc-700">
                                    "{{ Str::limit($activity->metadata['comment_content'], 100) }}"
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="p-8 text-center text-muted-foreground">
            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h3 class="mt-2 text-sm font-medium">No activity yet</h3>
            <p class="mt-1 text-sm">Activities will appear here when team members interact.</p>
        </div>
    @endif
</div>