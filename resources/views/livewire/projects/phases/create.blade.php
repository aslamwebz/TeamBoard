<div class="max-w-3xl mx-auto p-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-foreground">Create Phase</h1>
        <flux:button :href="route('projects.show', $project)" variant="outline">
            Back to Project
        </flux:button>
    </div>

    <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
        <form wire:submit="createPhase" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div>
                        <flux:field label="Phase Name" for="name" required>
                            <flux:input wire:model="name" id="name" placeholder="Enter phase name" />
                        </flux:field>
                        @error('name')
                            <div class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <flux:field label="Start Date" for="start_date">
                            <flux:input type="date" wire:model="start_date" id="start_date" />
                        </flux:field>
                        @error('start_date')
                            <div class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <flux:field label="End Date" for="end_date">
                            <flux:input type="date" wire:model="end_date" id="end_date" />
                        </flux:field>
                        @error('end_date')
                            <div class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <flux:field label="Order" for="order">
                            <flux:input type="number" wire:model="order" id="order" min="0" />
                        </flux:field>
                        @error('order')
                            <div class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <flux:field label="Status" for="status" required>
                            <flux:select wire:model="status" id="status">
                                <option value="not_started">Not Started</option>
                                <option value="in_progress">In Progress</option>
                                <option value="completed">Completed</option>
                                <option value="on_hold">On Hold</option>
                            </flux:select>
                        </flux:field>
                        @error('status')
                            <div class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <flux:field label="Description" for="description">
                            <flux:textarea wire:model="description" id="description" rows="4" placeholder="Enter phase description" />
                        </flux:field>
                        @error('description')
                            <div class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-3">
                <flux:button :href="route('projects.show', $project)" variant="outline">
                    Cancel
                </flux:button>
                <flux:button type="submit">
                    Create Phase
                </flux:button>
            </div>
        </form>
    </div>
</div>