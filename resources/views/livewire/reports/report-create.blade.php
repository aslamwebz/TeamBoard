<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-foreground">Create Report</h1>
            <p class="text-muted-foreground">Generate a new report</p>
        </div>
        <a href="{{ route('reports.index') }}"
            class="inline-flex items-center gap-2 px-4 py-2 border border-zinc-300 rounded-lg text-zinc-700 hover:bg-zinc-50 dark:border-zinc-600 dark:text-zinc-300 dark:hover:bg-zinc-700 font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                <path d="M19 12H5M12 19l-7-7 7-7" />
            </svg>
            Cancel
        </a>
    </div>

    <!-- Form Container -->
    <div class="grid gap-6 lg:grid-cols-3">
        <!-- Main Form -->
        <div class="lg:col-span-2">
            <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
                <form wire:submit="createReport" class="space-y-6">
                    <!-- Basic Information -->
                    <div>
                        <div class="flex items-center gap-2 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="h-5 w-5 text-zinc-500">
                                <path d="M14.5 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V7.5L14.5 2z" />
                                <polyline points="14,2 14,8 20,8" />
                            </svg>
                            <h2 class="text-lg font-semibold text-foreground">Basic Information</h2>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label for="title" class="block text-sm font-medium text-foreground mb-1">Title
                                    *</label>
                                <input type="text" id="title" wire:model="title" placeholder="Enter report title"
                                    class="w-full px-3 py-2 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white @error('title') border-red-500 @enderror">
                                @error('title')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="report_type" class="block text-sm font-medium text-foreground mb-1">Report
                                    Type *</label>
                                <select id="report_type" wire:model="report_type"
                                    class="w-full px-3 py-2 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white @error('report_type') border-red-500 @enderror">
                                    <option value="">Select report type</option>
                                    <option value="financial">Financial</option>
                                    <option value="project">Project</option>
                                    <option value="invoice">Invoice</option>
                                    <option value="client">Client</option>
                                </select>
                                @error('report_type')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="description"
                                    class="block text-sm font-medium text-foreground mb-1">Description</label>
                                <textarea id="description" wire:model="description" rows="4" placeholder="Enter report description (optional)"
                                    class="w-full px-3 py-2 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white @error('description') border-red-500 @enderror"></textarea>
                                @error('description')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end pt-6 border-t border-zinc-200 dark:border-zinc-700">
                        <button type="submit"
                            class="inline-flex items-center gap-2 px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="h-5 w-5">
                                <path d="M12 5v14M5 12h14" />
                            </svg>
                            Create Report
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Report Types Info -->
            <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
                <div class="flex items-center gap-2 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="h-5 w-5 text-zinc-500">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" y1="16" x2="12" y2="12" />
                        <line x1="12" y1="8" x2="12.01" y2="8" />
                    </svg>
                    <h2 class="text-lg font-semibold text-foreground">Report Types</h2>
                </div>

                <div class="space-y-3 text-sm">
                    <div class="flex items-start gap-2">
                        <div class="w-2 h-2 bg-blue-500 rounded-full mt-1.5 flex-shrink-0"></div>
                        <div>
                            <p class="font-medium text-foreground">Financial</p>
                            <p class="text-muted-foreground">Revenue, expenses, and financial summaries</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-2">
                        <div class="w-2 h-2 bg-green-500 rounded-full mt-1.5 flex-shrink-0"></div>
                        <div>
                            <p class="font-medium text-foreground">Project</p>
                            <p class="text-muted-foreground">Project progress, timelines, and deliverables</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-2">
                        <div class="w-2 h-2 bg-purple-500 rounded-full mt-1.5 flex-shrink-0"></div>
                        <div>
                            <p class="font-medium text-foreground">Invoice</p>
                            <p class="text-muted-foreground">Billing, payments, and invoice analytics</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-2">
                        <div class="w-2 h-2 bg-orange-500 rounded-full mt-1.5 flex-shrink-0"></div>
                        <div>
                            <p class="font-medium text-foreground">Client</p>
                            <p class="text-muted-foreground">Client activity, engagement, and satisfaction</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tips -->
            <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
                <div class="flex items-center gap-2 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="h-5 w-5 text-zinc-500">
                        <path
                            d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                    </svg>
                    <h2 class="text-lg font-semibold text-foreground">Tips</h2>
                </div>

                <div class="space-y-3 text-sm text-muted-foreground">
                    <div class="flex items-start gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="h-4 w-4 text-blue-500 mt-0.5 flex-shrink-0">
                            <circle cx="12" cy="12" r="10" />
                            <path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3" />
                            <line x1="12" y1="17" x2="12.01" y2="17" />
                        </svg>
                        <p>Choose a descriptive title to easily identify reports later</p>
                    </div>
                    <div class="flex items-start gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="h-4 w-4 text-blue-500 mt-0.5 flex-shrink-0">
                            <circle cx="12" cy="12" r="10" />
                            <path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3" />
                            <line x1="12" y1="17" x2="12.01" y2="17" />
                        </svg>
                        <p>Add a detailed description to provide context for the report</p>
                    </div>
                    <div class="flex items-start gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="h-4 w-4 text-blue-500 mt-0.5 flex-shrink-0">
                            <circle cx="12" cy="12" r="10" />
                            <path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3" />
                            <line x1="12" y1="17" x2="12.01" y2="17" />
                        </svg>
                        <p>Reports can be edited after creation if needed</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
