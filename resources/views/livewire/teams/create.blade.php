<div>
    <div class="max-w-2xl mx-auto">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-foreground">Create Team</h1>
            <p class="text-muted-foreground">Create a new team to organize your users and projects.</p>
        </div>

        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700">
            <form wire:submit="createTeam" class="p-6">
                <div class="space-y-6">
                    <!-- Team Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                            Team Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="name" wire:model="name" placeholder="Development Team"
                            class="w-full px-3 py-2 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description"
                            class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                            Description
                        </label>
                        <textarea id="description" wire:model="description" rows="4"
                            placeholder="Brief description of the team's purpose and responsibilities..."
                            class="w-full px-3 py-2 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white @error('description') border-red-500 @enderror"></textarea>
                        @error('description')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-zinc-500 mt-1">Optional: Provide a brief description of this team's role.
                        </p>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="mt-8 flex justify-end gap-3">
                    <a href="{{ route('teams.index') }}"
                        class="px-4 py-2 text-sm font-medium text-zinc-700 bg-zinc-100 rounded-md hover:bg-zinc-200 dark:bg-zinc-700 dark:text-zinc-300 dark:hover:bg-zinc-600">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-zinc-900">
                        Create Team
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
