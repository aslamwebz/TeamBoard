<div class="space-y-6 max-w-3xl mx-auto">
    @if (session()->has('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg dark:bg-green-900/30 dark:border-green-800 dark:text-green-400">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-foreground">
                Create Permission
            </h1>
            <p class="text-muted-foreground">
                Define a new permission for your application
            </p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('roles.index') }}" class="px-4 py-2 border border-zinc-200 rounded-lg text-zinc-700 hover:bg-zinc-50 dark:border-zinc-700 dark:text-zinc-300 dark:hover:bg-zinc-700">
                Cancel
            </a>
        </div>
    </div>

    <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
        <form wire:submit="save" class="space-y-6">
            <div class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-foreground mb-1">
                        Permission Name
                    </label>
                    <input
                        type="text"
                        id="name"
                        wire:model="name"
                        class="w-full px-4 py-2 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white"
                        placeholder="Enter permission name (e.g., view reports, create invoices)"
                    />
                    @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="guard_name" class="block text-sm font-medium text-foreground mb-1">
                        Guard Name
                    </label>
                    <input
                        type="text"
                        id="guard_name"
                        wire:model="guard_name"
                        class="w-full px-4 py-2 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white"
                        placeholder="Guard name (default: web)"
                    />
                    @error('guard_name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="pt-4">
                <button
                    type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                >
                    Create Permission
                </button>
            </div>
        </form>
    </div>
</div>