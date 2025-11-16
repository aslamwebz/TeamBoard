<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-foreground">Edit Report</h1>
            <p class="text-muted-foreground">Update report details</p>
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
                <form wire:submit="updateReport" class="space-y-6">
                    <!-- Basic Information -->
                    <div>
                        <div class="flex items-center gap-2 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="h-5 w-5 text-zinc-500">
                                <path d="M14.5 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V7.5L14.5 2z" />
                                <polyline points="14,2 14,8 20,8" />
                            </svg>
                            <h2 class="text-lg font-semibold text-foreground">Report Information</h2>
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
                                <label for="status" class="block text-sm font-medium text-foreground mb-1">Status
                                    *</label>
                                <select id="status" wire:model="status"
                                    class="w-full px-3 py-2 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white @error('status') border-red-500 @enderror">
                                    <option value="">Select status</option>
                                    <option value="draft">Draft</option>
                                    <option value="generated">Generated</option>
                                    <option value="archived">Archived</option>
                                </select>
                                @error('status')
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
                                <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" />
                                <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                            </svg>
                            Update Report
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Report Status Info -->
            <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
                <div class="flex items-center gap-2 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="h-5 w-5 text-zinc-500">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" y1="16" x2="12" y2="12" />
                        <line x1="12" y1="8" x2="12.01" y2="8" />
                    </svg>
                    <h2 class="text-lg font-semibold text-foreground">Status Information</h2>
                </div>

                <div class="space-y-3 text-sm">
                    <div class="flex items-start gap-2">
                        <div class="w-2 h-2 bg-gray-500 rounded-full mt-1.5 flex-shrink-0"></div>
                        <div>
                            <p class="font-medium text-foreground">Draft</p>
                            <p class="text-muted-foreground">Report is being prepared and not yet finalized</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-2">
                        <div class="w-2 h-2 bg-green-500 rounded-full mt-1.5 flex-shrink-0"></div>
                        <div>
                            <p class="font-medium text-foreground">Generated</p>
                            <p class="text-muted-foreground">Report has been generated and is ready for use</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-2">
                        <div class="w-2 h-2 bg-purple-500 rounded-full mt-1.5 flex-shrink-0"></div>
                        <div>
                            <p class="font-medium text-foreground">Archived</p>
                            <p class="text-muted-foreground">Report is no longer active but preserved for reference</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Report Metadata -->
            <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
                <div class="flex items-center gap-2 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="h-5 w-5 text-zinc-500">
                        <circle cx="12" cy="12" r="10" />
                        <polyline points="12,6 12,12 16,14" />
                    </svg>
                    <h2 class="text-lg font-semibold text-foreground">Report Metadata</h2>
                </div>

                <div class="space-y-4 text-sm">
                    <div>
                        <h3 class="text-sm font-medium text-muted-foreground mb-1">Generated By</h3>
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-zinc-500">
                                <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                                <circle cx="12" cy="7" r="4" />
                            </svg>
                            <span class="text-foreground">{{ $report->user->name }}</span>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-sm font-medium text-muted-foreground mb-1">Generated At</h3>
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-zinc-500">
                                <circle cx="12" cy="12" r="10" />
                                <polyline points="12,6 12,12 16,14" />
                            </svg>
                            <span
                                class="text-foreground">{{ $report->generated_at ? $report->generated_at->format('M d, Y H:i') : 'Not generated' }}</span>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-sm font-medium text-muted-foreground mb-1">Last Updated</h3>
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-zinc-500">
                                <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" />
                                <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                            </svg>
                            <span class="text-foreground">{{ $report->updated_at->format('M d, Y H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
                <div class="flex items-center gap-2 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="h-5 w-5 text-zinc-500">
                        <circle cx="12" cy="12" r="3" />
                        <path
                            d="M12 1v6m0 6v6m4.22-13.22l4.24 4.24M1.54 8.96l4.24 4.24M20.46 15.04l-4.24-4.24M1.54 15.04l4.24-4.24" />
                    </svg>
                    <h2 class="text-lg font-semibold text-foreground">Quick Actions</h2>
                </div>

                <div class="space-y-3">
                    <a href="{{ route('reports.show', $report) }}"
                        class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 border border-zinc-300 rounded-lg text-zinc-700 hover:bg-zinc-50 dark:border-zinc-600 dark:text-zinc-300 dark:hover:bg-zinc-700 font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="h-5 w-5">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                        View Report
                    </a>

                    <button
                        class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 border border-zinc-300 rounded-lg text-zinc-700 hover:bg-zinc-50 dark:border-zinc-600 dark:text-zinc-300 dark:hover:bg-zinc-700 font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="h-5 w-5">
                            <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4" />
                            <polyline points="7,10 12,15 17,10" />
                            <line x1="12" y1="15" x2="12" y2="3" />
                        </svg>
                        Export Report
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
