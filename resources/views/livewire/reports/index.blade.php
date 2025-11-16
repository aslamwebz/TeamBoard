<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-foreground">Reports</h1>
            <p class="text-muted-foreground">Generate and manage reports</p>
        </div>
        <a href="{{ route('reports.create') }}"
            class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                <path d="M12 5v14M5 12h14" />
            </svg>
            Create Report
        </a>
    </div>

    <!-- Filters -->
    <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-4">
        <div class="flex flex-col lg:flex-row gap-4">
            <div class="flex-1">
                <div class="relative">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="absolute left-3 top-2.5 h-5 w-5 text-zinc-400">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                    <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search reports..."
                        class="w-full pl-10 pr-4 py-2 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white">
                </div>
            </div>

            <div class="flex gap-3">
                <select wire:model.live="typeFilter"
                    class="px-3 py-2 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white">
                    <option value="">All Types</option>
                    @foreach ($reportTypes as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>

                <select wire:model.live="statusFilter"
                    class="px-3 py-2 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white">
                    <option value="">All Statuses</option>
                    @foreach ($statuses as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <!-- Reports Grid -->
    @if ($reports->count() > 0)
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($reports as $report)
                <div
                    class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 hover:shadow-lg transition-shadow">
                    <div class="p-6">
                        <!-- Header -->
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-zinc-500">
                                    <path d="M14.5 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V7.5L14.5 2z" />
                                    <polyline points="14,2 14,8 20,8" />
                                </svg>
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-zinc-100 text-zinc-800 dark:bg-zinc-700 dark:text-zinc-300">
                                    {{ ucfirst($report->report_type) }}
                                </span>
                            </div>
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                @if ($report->status === 'draft') bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300
                                @elseif($report->status === 'generated') bg-green-100 text-green-800 dark:bg-green-700 dark:text-green-300
                                @elseif($report->status === 'archived') bg-purple-100 text-purple-800 dark:bg-purple-700 dark:text-purple-300 @endif
                            ">
                                {{ ucfirst($report->status) }}
                            </span>
                        </div>

                        <!-- Title and Description -->
                        <div class="mb-4">
                            <h3 class="text-lg font-semibold text-foreground mb-2">{{ $report->title }}</h3>
                            @if ($report->description)
                                <p class="text-sm text-muted-foreground">{{ Str::limit($report->description, 80) }}</p>
                            @endif
                        </div>

                        <!-- Meta Information -->
                        <div class="space-y-2 text-sm text-muted-foreground mb-4">
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                                    <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                                    <circle cx="12" cy="7" r="4" />
                                </svg>
                                <span>{{ $report->user->name }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                                    <circle cx="12" cy="12" r="10" />
                                    <polyline points="12,6 12,12 16,14" />
                                </svg>
                                <span>{{ $report->generated_at ? $report->generated_at->format('M d, Y H:i') : 'Not generated' }}</span>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex gap-2 pt-4 border-t border-zinc-200 dark:border-zinc-700">
                            <a href="{{ route('reports.show', $report) }}"
                                class="flex-1 text-center px-3 py-2 text-sm text-blue-600 hover:text-blue-700 font-medium">
                                View
                            </a>
                            <a href="{{ route('reports.edit', $report) }}"
                                class="flex-1 text-center px-3 py-2 text-sm text-zinc-600 hover:text-zinc-700 font-medium">
                                Edit
                            </a>
                            <button wire:click="deleteReport({{ $report->id }})"
                                class="flex-1 text-center px-3 py-2 text-sm text-red-600 hover:text-red-700 font-medium">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="flex justify-center">
            {{ $reports->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-12 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="mx-auto h-12 w-12 text-zinc-400 mb-4">
                <path d="M14.5 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V7.5L14.5 2z" />
                <polyline points="14,2 14,8 20,8" />
                <line x1="16" y1="13" x2="8" y2="13" />
                <line x1="16" y1="17" x2="8" y2="17" />
                <polyline points="10,9 9,9 8,9" />
            </svg>
            <h3 class="text-lg font-medium text-foreground mb-2">No reports found</h3>
            <p class="text-muted-foreground mb-6">Get started by creating your first report.</p>
            <a href="{{ route('reports.create') }}"
                class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="h-5 w-5">
                    <path d="M12 5v14M5 12h14" />
                </svg>
                Create Report
            </a>
        </div>
    @endif

    <!-- Delete Confirmation Modal -->
    @if ($showDeleteModal)
        <div class="fixed inset-0 bg-black/50 flex items-center justify-center p-4 z-50">
            <div
                class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 max-w-md w-full p-6">
                <h3 class="text-lg font-medium text-foreground mb-2">Delete Report</h3>
                <p class="text-sm text-muted-foreground mb-6">Are you sure you want to delete this report? This action
                    cannot be undone.</p>
                <div class="flex justify-end gap-3">
                    <button wire:click="cancelDelete"
                        class="px-4 py-2 border border-zinc-300 rounded-lg text-zinc-700 hover:bg-zinc-50 dark:border-zinc-600 dark:text-zinc-300 dark:hover:bg-zinc-700">
                        Cancel
                    </button>
                    <button wire:click="confirmDelete"
                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
