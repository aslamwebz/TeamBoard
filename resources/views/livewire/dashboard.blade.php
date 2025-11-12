<div class="space-y-6">
    <div>
        <h1 class="text-3xl font-bold text-foreground">{{ __('Dashboard') }}</h1>
        <p class="text-muted-foreground">{{ __('Welcome back! Here\'s an overview of your workspace.') }}</p>
    </div>

        <!-- Stats Grid -->
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
            <!-- Total Projects Card -->
            <div class="relative overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-800">
                <div class="flex items-center justify-between p-6 pb-2">
                    <h3 class="text-sm font-medium text-zinc-500 dark:text-zinc-400">{{ __('Total Projects') }}</h3>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-blue-600">
                        <path d="M4 20h16a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.93a2 2 0 0 1-1.66-.9l-.82-1.2A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13c0 1.1.9 2 2 2Z"/>
                    </svg>
                </div>
                <div class="p-6 pt-0">
                    <div class="text-2xl font-bold text-foreground">24</div>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400">
                        <span class="text-green-600">+12%</span> {{ __('from last month') }}
                    </p>
                </div>
            </div>

            <!-- Active Tasks Card -->
            <div class="relative overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-800">
                <div class="flex items-center justify-between p-6 pb-2">
                    <h3 class="text-sm font-medium text-zinc-500 dark:text-zinc-400">{{ __('Active Tasks') }}</h3>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-green-600">
                        <path d="M12 2v20M5 12h14M5 6h14M5 18h14"/>
                    </svg>
                </div>
                <div class="p-6 pt-0">
                    <div class="text-2xl font-bold text-foreground">142</div>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400">
                        <span class="text-green-600">+8%</span> {{ __('from last month') }}
                    </p>
                </div>
            </div>

            <!-- Team Members Card -->
            <div class="relative overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-800">
                <div class="flex items-center justify-between p-6 pb-2">
                    <h3 class="text-sm font-medium text-zinc-500 dark:text-zinc-400">{{ __('Team Members') }}</h3>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-purple-600">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
                <div class="p-6 pt-0">
                    <div class="text-2xl font-bold text-foreground">18</div>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400">
                        <span class="text-green-600">+3</span> {{ __('from last month') }}
                    </p>
                </div>
            </div>

            <!-- Completion Rate Card -->
            <div class="relative overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-800">
                <div class="flex items-center justify-between p-6 pb-2">
                    <h3 class="text-sm font-medium text-zinc-500 dark:text-zinc-400">{{ __('Completion Rate') }}</h3>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-orange-600">
                        <path d="M12 2v20M5 12h14M5 6h14M5 18h14"/>
                    </svg>
                </div>
                <div class="p-6 pt-0">
                    <div class="text-2xl font-bold text-foreground">87%</div>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400">
                        <span class="text-green-600">+5%</span> {{ __('from last month') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Recent Projects Section -->
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-foreground mb-4">{{ __('Recent Projects') }}</h2>
                <div class="space-y-4">
                    <!-- Project 1 -->
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-medium text-foreground">{{ __('Website Redesign') }}</p>
                                <p class="text-sm text-zinc-500 dark:text-zinc-400">{{ __('Due: 2024-02-15') }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-medium text-foreground">75%</p>
                                <p class="text-xs text-zinc-500 dark:text-zinc-400">{{ __('In Progress') }}</p>
                            </div>
                        </div>
                        <div class="h-2 overflow-hidden rounded-full bg-zinc-100 dark:bg-zinc-700">
                            <div class="h-full bg-blue-500 transition-all" style="width: 75%"></div>
                        </div>
                    </div>

                    <!-- Project 2 -->
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-medium text-foreground">{{ __('Mobile App Development') }}</p>
                                <p class="text-sm text-zinc-500 dark:text-zinc-400">{{ __('Due: 2024-03-20') }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-medium text-foreground">45%</p>
                                <p class="text-xs text-zinc-500 dark:text-zinc-400">{{ __('In Progress') }}</p>
                            </div>
                        </div>
                        <div class="h-2 overflow-hidden rounded-full bg-zinc-100 dark:bg-zinc-700">
                            <div class="h-full bg-blue-500 transition-all" style="width: 45%"></div>
                        </div>
                    </div>

                    <!-- Project 3 -->
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-medium text-foreground">{{ __('Marketing Campaign') }}</p>
                                <p class="text-sm text-zinc-500 dark:text-zinc-400">{{ __('Due: 2024-02-28') }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-medium text-foreground">20%</p>
                                <p class="text-xs text-zinc-500 dark:text-zinc-400">{{ __('Planning') }}</p>
                            </div>
                        </div>
                        <div class="h-2 overflow-hidden rounded-full bg-zinc-100 dark:bg-zinc-700">
                            <div class="h-full bg-yellow-500 transition-all" style="width: 20%"></div>
                        </div>
                    </div>

                    <!-- Project 4 -->
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-medium text-foreground">{{ __('API Integration') }}</p>
                                <p class="text-sm text-zinc-500 dark:text-zinc-400">{{ __('Due: 2024-02-10') }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-medium text-foreground">60%</p>
                                <p class="text-xs text-zinc-500 dark:text-zinc-400">{{ __('In Progress') }}</p>
                            </div>
                        </div>
                        <div class="h-2 overflow-hidden rounded-full bg-zinc-100 dark:bg-zinc-700">
                            <div class="h-full bg-blue-500 transition-all" style="width: 60%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>