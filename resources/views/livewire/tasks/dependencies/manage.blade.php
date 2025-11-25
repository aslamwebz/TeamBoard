<div class="mt-6">
    <h3 class="text-lg font-medium text-foreground mb-4">Task Dependencies</h3>
    <p class="text-sm text-muted-foreground mb-4">Set up dependencies for this task. This task can only be started when all selected dependencies are completed.</p>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Available Tasks -->
        <div>
            <h4 class="font-medium text-foreground mb-2">Available Tasks</h4>
            @if(count($availableTasks) > 0)
                <div class="space-y-2 max-h-60 overflow-y-auto">
                    @foreach($availableTasks as $availableTask)
                        @if(!in_array($availableTask->id, $selectedDependencies))
                            <div class="flex items-center justify-between p-3 bg-white dark:bg-zinc-700 rounded-lg border border-zinc-200 dark:border-zinc-600">
                                <span class="text-sm text-foreground">{{ $availableTask->title }}</span>
                                <flux:button size="sm" variant="outline" type="button" wire:click="addDependency({{ $availableTask->id }})">
                                    Add
                                </flux:button>
                            </div>
                        @endif
                    @endforeach
                </div>
            @else
                <p class="text-sm text-muted-foreground">No tasks available in this project.</p>
            @endif
        </div>
        
        <!-- Selected Dependencies -->
        <div>
            <h4 class="font-medium text-foreground mb-2">Selected Dependencies</h4>
            @if(count($selectedDependencies) > 0)
                <div class="space-y-2 max-h-60 overflow-y-auto">
                    @foreach($availableTasks as $availableTask)
                        @if(in_array($availableTask->id, $selectedDependencies))
                            <div class="flex items-center justify-between p-3 bg-blue-50 dark:bg-blue-900/30 rounded-lg border border-blue-200 dark:border-blue-800">
                                <span class="text-sm text-foreground">{{ $availableTask->title }}</span>
                                <flux:button size="sm" variant="outline" color="red" type="button" wire:click="removeDependency({{ $availableTask->id }})">
                                    Remove
                                </flux:button>
                            </div>
                        @endif
                    @endforeach
                </div>
            @else
                <p class="text-sm text-muted-foreground">No dependencies selected yet.</p>
            @endif
        </div>
    </div>
</div>