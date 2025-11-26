<div class="space-y-6">
    @if (session()->has('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg dark:bg-green-900/30 dark:border-green-800 dark:text-green-400">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-foreground">
                {{ $role ? 'Edit Role' : 'Create Role' }}
            </h1>
            <p class="text-muted-foreground">
                {{ $role ? 'Update the role details and permissions' : 'Create a new role with specific permissions' }}
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
                        Role Name
                    </label>
                    <input
                        type="text"
                        id="name"
                        wire:model="name"
                        class="w-full px-4 py-2 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white"
                        placeholder="Enter role name"
                    />
                    @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-foreground mb-1">
                        Permissions
                    </label>
                    <p class="text-sm text-muted-foreground mb-3">
                        Select the permissions to assign to this role
                    </p>

                    <!-- Debug information -->
                    @if($role)
                        <div class="mb-3 p-3 bg-blue-50 dark:bg-blue-900/20 text-sm">
                            <strong>Debug:</strong>
                            Current permissions IDs: {{ implode(', ', $permissions) }}
                            | Role permissions count: {{ $role->permissions->count() }}
                        </div>
                    @endif

                    <!-- Categorized Permissions -->
                    @foreach($this->groupedPermissions as $category => $permissionGroup)
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-foreground mb-3 border-b border-zinc-200 dark:border-zinc-700 pb-1">
                                {{ $category }}
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                                @foreach($permissionGroup as $permission)
                                    <label class="flex items-start space-x-2 p-3 border border-zinc-200 rounded-lg hover:bg-zinc-50 dark:border-zinc-700 dark:hover:bg-zinc-700 cursor-pointer">
                                        <input
                                            type="checkbox"
                                            value="{{ $permission->id }}"
                                            wire:model.live="permissions"
                                            wire:key="permission-{{ $permission->id }}"
                                            class="mt-1 h-4 w-4 text-blue-600 border-zinc-300 rounded focus:ring-blue-500"
                                        />
                                        <div>
                                            <span class="block text-sm font-medium text-foreground">{{ $permission->name }}</span>
                                            <span class="block text-xs text-muted-foreground">{{ ucfirst(str_replace('_', ' ', $permission->name)) }}</span>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                    @error('permissions') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="pt-4">
                <button
                    type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                >
                    {{ $role ? 'Update Role' : 'Create Role' }}
                </button>
            </div>
        </form>
    </div>
</div>
