<div class="space-y-4">
    @if (session()->has('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-3 py-1.5 rounded-lg dark:bg-green-900/30 dark:border-green-800 dark:text-green-400 text-xs">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-lg font-bold text-foreground">Permissions Management</h1>
            <p class="text-xs text-muted-foreground">Manage individual permissions</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('permissions.create') }}" class="px-2.5 py-1 text-xs bg-blue-600 text-white rounded hover:bg-blue-700">
                Create Permission
            </a>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-2">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2">
            <div class="flex-1">
                <div class="relative">
                    <input
                        wire:model.live="search"
                        type="text"
                        placeholder="Search permissions..."
                        class="w-full px-2 py-1 text-xs border border-zinc-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white"
                    >
                </div>
            </div>
        </div>
    </div>

    <!-- Grouped Permissions Table -->
    <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-zinc-200 dark:divide-zinc-700">
                <thead class="bg-zinc-50 dark:bg-zinc-900">
                    <tr>
                        <th class="px-2 py-1 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                            Model / Permission
                        </th>
                        <th class="px-2 py-1 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                            Guard
                        </th>
                        <th class="px-2 py-1 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                            Created
                        </th>
                        <th class="px-2 py-1 text-right text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-zinc-800 divide-y divide-zinc-200 dark:divide-zinc-700">
                    @forelse($groupedPermissions as $model => $modelPermissions)
                        <!-- Model Group Header -->
                        <tr class="bg-zinc-100 dark:bg-zinc-700/50">
                            <td colspan="4" class="px-2 py-1.5 text-xs font-semibold text-foreground uppercase tracking-wider">
                                {{ $model }}
                            </td>
                        </tr>

                        @foreach($modelPermissions as $permission)
                            <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-700/30">
                                <td class="px-2 py-1 whitespace-nowrap">
                                    <div class="text-xs font-medium text-foreground">{{ $permission->name }}</div>
                                </td>
                                <td class="px-2 py-1 whitespace-nowrap">
                                    <div class="text-xs text-zinc-600 dark:text-zinc-400">{{ $permission->guard_name }}</div>
                                </td>
                                <td class="px-2 py-1 whitespace-nowrap">
                                    <div class="text-xs text-zinc-600 dark:text-zinc-400">{{ $permission->created_at->format('M d, Y') }}</div>
                                </td>
                                <td class="px-2 py-1 whitespace-nowrap text-right text-xs font-medium">
                                    <div class="flex items-center justify-end space-x-0.5">
                                        <a href="{{ route('permissions.edit', $permission) }}"
                                        class="inline-flex items-center px-1.5 py-0.5 border border-zinc-300 rounded text-xs font-medium text-zinc-700 bg-white hover:bg-zinc-50 dark:bg-zinc-700 dark:text-zinc-300 dark:border-zinc-600 dark:hover:bg-zinc-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" class="h-2.5 w-2.5 mr-0.5">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                            </svg>
                                            Edit
                                        </a>
                                        <button
                                            wire:click="deletePermission({{ $permission->id }})"
                                            onclick="confirm('Are you sure you want to delete this permission?') || event.stopImmediatePropagation()"
                                            class="inline-flex items-center px-1.5 py-0.5 border border-red-300 rounded text-xs font-medium text-red-700 bg-white hover:bg-red-50 dark:bg-zinc-700 dark:text-red-400 dark:border-red-600 dark:hover:bg-red-900/20"
                                            title="Delete">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" class="h-2.5 w-2.5 mr-0.5">
                                                <path d="M3 6h18" />
                                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                            </svg>
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="4" class="px-2 py-1.5 text-center text-xs text-zinc-500 dark:text-zinc-400">
                                No permissions found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-2 py-1 border-t border-zinc-200 dark:border-zinc-700">
            {{ $permissions->links() }}
        </div>
    </div>
</div>