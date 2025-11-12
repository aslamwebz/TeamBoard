<div class="space-y-12">
    <div class="text-center">
        <h1 class="text-4xl font-bold text-foreground mb-4">{{ __('Features') }}</h1>
        <p class="text-lg text-zinc-500 dark:text-zinc-400 max-w-2xl mx-auto">
            {{ __('Discover all the powerful features that help you manage projects efficiently and collaborate with your team') }}
        </p>
    </div>

    <!-- Feature Grid -->
    <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
        <!-- Feature 1 -->
        <div class="relative overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-800 p-6">
            <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center mb-4 dark:bg-blue-900/30">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-blue-600">
                    <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"></path>
                    <path d="M3 6h18"></path>
                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-foreground mb-2">{{ __('Project Management') }}</h3>
            <p class="text-zinc-500 dark:text-zinc-400">
                {{ __('Create, organize, and track your projects with our intuitive interface. Set deadlines, assign tasks, and monitor progress in real-time.') }}
            </p>
        </div>

        <!-- Feature 2 -->
        <div class="relative overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-800 p-6">
            <div class="w-12 h-12 rounded-lg bg-green-100 flex items-center justify-center mb-4 dark:bg-green-900/30">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-green-600">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-foreground mb-2">{{ __('Team Collaboration') }}</h3>
            <p class="text-zinc-500 dark:text-zinc-400">
                {{ __('Invite team members, assign roles, and collaborate seamlessly. Share files, discuss tasks, and stay aligned on project goals.') }}
            </p>
        </div>

        <!-- Feature 3 -->
        <div class="relative overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-800 p-6">
            <div class="w-12 h-12 rounded-lg bg-purple-100 flex items-center justify-center mb-4 dark:bg-purple-900/30">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-purple-600">
                    <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-foreground mb-2">{{ __('Advanced Analytics') }}</h3>
            <p class="text-zinc-500 dark:text-zinc-400">
                {{ __('Gain insights into your project performance with detailed reports and visualizations. Track metrics and make data-driven decisions.') }}
            </p>
        </div>

        <!-- Feature 4 -->
        <div class="relative overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-800 p-6">
            <div class="w-12 h-12 rounded-lg bg-yellow-100 flex items-center justify-center mb-4 dark:bg-yellow-900/30">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-yellow-600">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-foreground mb-2">{{ __('Secure Access') }}</h3>
            <p class="text-zinc-500 dark:text-zinc-400">
                {{ __('Keep your projects safe with industry-leading security measures. Role-based access control ensures the right people have the right permissions.') }}
            </p>
        </div>

        <!-- Feature 5 -->
        <div class="relative overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-800 p-6">
            <div class="w-12 h-12 rounded-lg bg-red-100 flex items-center justify-center mb-4 dark:bg-red-900/30">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-red-600">
                    <path d="M4.5 9.5 3 3h18l-1.5 6.5"></path>
                    <path d="M6.5 16.5 5 23h14l-1.5-6.5"></path>
                    <path d="M12 10v5"></path>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-foreground mb-2">{{ __('Task Automation') }}</h3>
            <p class="text-zinc-500 dark:text-zinc-400">
                {{ __('Automate repetitive tasks and workflows to save time. Set triggers and actions to streamline your project management process.') }}
            </p>
        </div>

        <!-- Feature 6 -->
        <div class="relative overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-800 p-6">
            <div class="w-12 h-12 rounded-lg bg-indigo-100 flex items-center justify-center mb-4 dark:bg-indigo-900/30">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 text-indigo-600">
                    <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <path d="M16 13H8"></path>
                    <path d="M16 17H8"></path>
                    <path d="M10 9H8"></path>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-foreground mb-2">{{ __('Custom Reporting') }}</h3>
            <p class="text-zinc-500 dark:text-zinc-400">
                {{ __('Generate custom reports tailored to your needs. Export data in multiple formats and create visual dashboards to track key metrics.') }}
            </p>
        </div>
    </div>

    <!-- Feature Section -->
    <div class="bg-zinc-50 dark:bg-zinc-900 rounded-xl p-8">
        <div class="grid gap-8 lg:grid-cols-2 items-center">
            <div>
                <h2 class="text-3xl font-bold text-foreground mb-4">{{ __('Comprehensive Dashboard') }}</h2>
                <p class="text-lg text-zinc-500 dark:text-zinc-400 mb-6">
                    {{ __('Get a complete overview of all your projects with our powerful dashboard. Monitor progress, track deadlines, and manage resources in one place.') }}
                </p>
                <ul class="space-y-3">
                    <li class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-green-600">
                            <path d="M12 20a8 8 0 1 0 0-16 8 8 0 0 0 0 16Z"></path>
                            <path d="m9 12 2 2 4-4"></path>
                        </svg>
                        <span class="text-foreground">{{ __('Real-time project tracking') }}</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-green-600">
                            <path d="M12 20a8 8 0 1 0 0-16 8 8 0 0 0 0 16Z"></path>
                            <path d="m9 12 2 2 4-4"></path>
                        </svg>
                        <span class="text-foreground">{{ __('Customizable widgets') }}</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-green-600">
                            <path d="M12 20a8 8 0 1 0 0-16 8 8 0 0 0 0 16Z"></path>
                            <path d="m9 12 2 2 4-4"></path>
                        </svg>
                        <span class="text-foreground">{{ __('Team performance insights') }}</span>
                    </li>
                </ul>
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-zinc-200 dark:border-zinc-700">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 flex items-center justify-center">
                    <div class="grid gap-4 w-full h-full p-6">
                        <div class="h-4 bg-zinc-200 rounded dark:bg-zinc-700 w-3/4 mx-auto"></div>
                        <div class="grid grid-cols-4 gap-4">
                            <div class="h-20 bg-zinc-200 rounded dark:bg-zinc-700 col-span-1"></div>
                            <div class="h-20 bg-zinc-200 rounded dark:bg-zinc-700 col-span-1"></div>
                            <div class="h-20 bg-zinc-200 rounded dark:bg-zinc-700 col-span-1"></div>
                            <div class="h-20 bg-zinc-200 rounded dark:bg-zinc-700 col-span-1"></div>
                        </div>
                        <div class="h-12 bg-zinc-200 rounded dark:bg-zinc-700"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>