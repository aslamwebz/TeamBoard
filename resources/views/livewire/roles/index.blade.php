<div class="space-y-6">
    @if (session()->has('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg dark:bg-green-900/30 dark:border-green-800 dark:text-green-400">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-foreground">Roles & Permissions</h1>
            <p class="text-muted-foreground">Manage user roles and permissions</p>
        </div>
        <div class="flex gap-3">
            @if($activeTab === 'roles')
                <a href="{{ route('roles.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Create Role
                </a>
            @else
                <a href="{{ route('permissions.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Create Permission
                </a>
            @endif
        </div>
    </div>

    <!-- Tab Navigation -->
    <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700">
        <div class="border-b border-zinc-200 dark:border-zinc-700">
            <nav class="flex -mb-px">
                <button
                    type="button"
                    wire:click="switchTab('roles')"
                    class="whitespace-nowrap py-4 px-4 border-b-2 font-medium text-sm w-1/2 text-center
                        {{ $activeTab === 'roles'
                            ? 'border-blue-500 text-blue-600 dark:text-blue-400 dark:border-blue-400'
                            : 'border-transparent text-zinc-500 hover:text-zinc-700 hover:border-zinc-300 dark:text-zinc-400 dark:hover:text-zinc-300' }}"
                >
                    Roles
                </button>
                <button
                    type="button"
                    wire:click="switchTab('permissions')"
                    class="whitespace-nowrap py-4 px-4 border-b-2 font-medium text-sm w-1/2 text-center
                        {{ $activeTab === 'permissions'
                            ? 'border-blue-500 text-blue-600 dark:text-blue-400 dark:border-blue-400'
                            : 'border-transparent text-zinc-500 hover:text-zinc-700 hover:border-zinc-300 dark:text-zinc-400 dark:hover:text-zinc-300' }}"
                >
                    Permissions
                </button>
            </nav>
        </div>

        <!-- Search and Filter -->
        <div class="p-6 border-b border-zinc-200 dark:border-zinc-700">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="flex-1">
                    <div class="relative">
                        <input
                            wire:model.live="search"
                            type="text"
                            placeholder="{{ $activeTab === 'roles' ? 'Search roles...' : 'Search permissions...' }}"
                            class="w-full px-4 py-2 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white"
                        >
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab Content -->
        @if($activeTab === 'roles')
            <!-- Roles Table -->
            <div class="overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-zinc-200 dark:divide-zinc-700">
                        <thead class="bg-zinc-50 dark:bg-zinc-900">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                    Role
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                    Permissions
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-zinc-800 divide-y divide-zinc-200 dark:divide-zinc-700">
                            @forelse($roles as $role)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-foreground">{{ $role->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-zinc-600 dark:text-zinc-400">
                                            @if($role->permissions->count() > 0)
                                                <div class="flex flex-wrap gap-1">
                                                    @foreach($role->permissions->take(5) as $permission)
                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400">
                                                            {{ $permission->name }}
                                                        </span>
                                                    @endforeach
                                                    @if($role->permissions->count() > 5)
                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-zinc-100 text-zinc-800 dark:bg-zinc-700 dark:text-zinc-400">
                                                            +{{ $role->permissions->count() - 5 }} more
                                                        </span>
                                                    @endif
                                                </div>
                                            @else
                                                <span class="text-xs text-zinc-500 dark:text-zinc-400">No permissions</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex items-center justify-end space-x-2">
                                            <a href="{{ route('roles.edit', $role) }}"
                                            class="inline-flex items-center px-3 py-1.5 border border-zinc-300 rounded-md text-sm font-medium text-zinc-700 bg-white hover:bg-zinc-50 dark:bg-zinc-700 dark:text-zinc-300 dark:border-zinc-600 dark:hover:bg-zinc-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" class="h-4 w-4 mr-1">
                                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                                </svg>
                                                Edit
                                            </a>
                                            <button
                                                wire:click="deleteRole({{ $role->id }})"
                                                onclick="confirm('Are you sure you want to delete this role?') || event.stopImmediatePropagation()"
                                                class="inline-flex items-center px-3 py-1.5 border border-red-300 rounded-md text-sm font-medium text-red-700 bg-white hover:bg-red-50 dark:bg-zinc-700 dark:text-red-400 dark:border-red-600 dark:hover:bg-red-900/20">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" class="h-4 w-4 mr-1">
                                                    <path d="M3 6h18" />
                                                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                                </svg>
                                                Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-center text-sm text-zinc-500 dark:text-zinc-400">
                                        No roles found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-4 border-t border-zinc-200 dark:border-zinc-700">
                    {{ $roles->links() }}
                </div>
            </div>
        @else
            <!-- Permissions Table -->
            <div class="overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-zinc-200 dark:divide-zinc-700">
                        <thead class="bg-zinc-50 dark:bg-zinc-900">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                    Name
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                    Guard
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                    Created
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-zinc-800 divide-y divide-zinc-200 dark:divide-zinc-700">
                            @forelse($permissions as $permission)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-foreground">{{ $permission->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-zinc-600 dark:text-zinc-400">{{ $permission->guard_name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-zinc-600 dark:text-zinc-400">{{ $permission->created_at->format('M d, Y') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex items-center justify-end space-x-2">
                                            <a href="{{ route('permissions.edit', $permission) }}"
                                            class="inline-flex items-center px-3 py-1.5 border border-zinc-300 rounded-md text-sm font-medium text-zinc-700 bg-white hover:bg-zinc-50 dark:bg-zinc-700 dark:text-zinc-300 dark:border-zinc-600 dark:hover:bg-zinc-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" class="h-4 w-4 mr-1">
                                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                                </svg>
                                                Edit
                                            </a>
                                            <button
                                                wire:click="deletePermission({{ $permission->id }})"
                                                onclick="confirm('Are you sure you want to delete this permission?') || event.stopImmediatePropagation()"
                                                class="inline-flex items-center px-3 py-1.5 border border-red-300 rounded-md text-sm font-medium text-red-700 bg-white hover:bg-red-50 dark:bg-zinc-700 dark:text-red-400 dark:border-red-600 dark:hover:bg-red-900/20"
                                                title="Delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" class="h-4 w-4 mr-1">
                                                    <path d="M3 6h18" />
                                                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                                </svg>
                                                Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-sm text-zinc-500 dark:text-zinc-400">
                                        No permissions found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-4 border-t border-zinc-200 dark:border-zinc-700">
                    {{ $permissions->links() }}
                </div>
            </div>
        @endif
    </div>
</div>
