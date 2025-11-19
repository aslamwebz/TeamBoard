<div class="space-y-6">
    <flux:heading size="lg">{{ __('Activity Timeline') }}</flux:heading>
    
    @if($activities->count() > 0)
        <div class="space-y-6">
            @foreach($activities as $activity)
                <div class="relative pl-8 pb-6">
                    <!-- Vertical line -->
                    <div class="absolute left-0 top-0 h-full w-0.5 bg-zinc-200 dark:bg-zinc-700 -translate-x-1/2"></div>
                    
                    <!-- Activity marker -->
                    <div class="absolute left-0 top-1 h-4 w-4 rounded-full bg-blue-500 border-4 border-white dark:border-zinc-800"></div>
                    
                    <div class="ml-6">
                        <div class="flex items-center gap-2">
                            <flux:badge>
                                {{ $activity->type_label }}
                            </flux:badge>
                            <span class="text-sm text-zinc-500 dark:text-zinc-400">
                                {{ $activity->activity_date->format('M j, Y \a\t g:i A') }}
                            </span>
                        </div>
                        
                        <div class="mt-2">
                            <p class="text-foreground">
                                <span class="font-medium">{{ $activity->contact->full_name }}</span>
                                - {{ $activity->description }}
                            </p>
                            
                            @if($activity->creator)
                                <p class="text-sm text-zinc-500 dark:text-zinc-400 mt-1">
                                    Added by {{ $activity->creator->name }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-12 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-auto h-12 w-12 text-zinc-400">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-foreground">{{ __('No activities') }}</h3>
            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                {{ __('No activity records for this client yet.') }}</p>
        </div>
    @endif
</div>