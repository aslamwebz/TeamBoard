<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-muted-foreground">Manage your vendor relationships and services</p>
        </div>
        <flux:button :href="route('vendors.create')" class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                <path d="M5 12h14"></path>
                <path d="M12 5v14"></path>
            </svg>
            Add Vendor
        </flux:button>
    </div>

    <!-- Filters -->
    <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-4">
        <div class="grid gap-4 md:grid-cols-3">
            <div class="relative">
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search vendors..."
                    class="w-full pl-10 pr-4 py-2 border border-zinc-300 rounded-lg dark:border-zinc-600 dark:bg-zinc-700 dark:text-zinc-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500">
                <svg class="absolute left-3 top-2.5 h-5 w-5 text-muted-foreground" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>

            <select wire:model.live="status"
                class="w-full px-3 py-2 border border-zinc-300 rounded-lg dark:border-zinc-600 dark:bg-zinc-700 dark:text-zinc-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500">
                <option value="">All Status</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
                <option value="pending">Pending</option>
            </select>
        </div>
    </div>
    <!-- Vendors Table -->
    <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-zinc-50 dark:bg-zinc-700/50 border-b border-zinc-200 dark:border-zinc-600">
                    <tr>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                            Company
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                            Contact
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                            Rating
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                            Status
                        </th>
                        <th
                            class="px-6 py-3 text-right text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 dark:divide-zinc-600">
                    @forelse($vendors as $vendor)
                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-700/50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div>
                                    <div class="text-sm font-medium text-foreground">{{ $vendor->name }}</div>
                                    <div class="text-sm text-muted-foreground">{{ $vendor->email }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-foreground">{{ $vendor->phone }}</div>
                                <div class="text-sm text-muted-foreground">{{ $vendor->city }}, {{ $vendor->country }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <span
                                        class="text-sm font-medium text-foreground">{{ number_format($vendor->rating, 1) }}</span>
                                    <svg class="ml-1 w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $this->getStatusBadgeClass($vendor->status) }}">
                                    {{ ucfirst($vendor->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end gap-2">
                                    <flux:button variant="outline" size="sm"
                                        :href="route('vendors.show', $vendor->id)">
                                        View
                                    </flux:button>
                                    <flux:button variant="outline" size="sm"
                                        :href="route('vendors.edit', $vendor->id)">
                                        Edit
                                    </flux:button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="mx-auto h-12 w-12 text-zinc-400">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="8.5" cy="7" r="4"></circle>
                                    <path d="M20 8v6M23 11h-6"></path>
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-foreground">No vendors found</h3>
                                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Get started by creating a new
                                    vendor.</p>
                                <div class="mt-6">
                                    <flux:button :href="route('vendors.create')" class="inline-flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                                            <path d="M5 12h14"></path>
                                            <path d="M12 5v14"></path>
                                        </svg>
                                        Add Vendor
                                    </flux:button>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if ($vendors->hasPages())
        <div class="mt-6">
            {{ $vendors->links() }}
        </div>
    @endif

</div>
