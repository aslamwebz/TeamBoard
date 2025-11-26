<div class="space-y-6">
    <div>
        <h1 class="text-3xl font-bold text-foreground">{{ __('Billing') }}</h1>
        <p class="text-muted-foreground">{{ __('Manage your subscription and payment methods') }}</p>
    </div>

    <!-- Current Plan -->
    <div class="grid gap-6 md:grid-cols-2">
        <div class="relative overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-800 p-6">
            <h2 class="text-xl font-semibold text-foreground mb-4">{{ __('Current Plan') }}</h2>
            <div class="flex items-baseline gap-2">
                <span class="text-3xl font-bold text-foreground">$29</span>
                <span class="text-zinc-500 dark:text-zinc-400">{{ __('per month') }}</span>
            </div>
            <p class="text-sm text-zinc-500 dark:text-zinc-400 mt-2">{{ __('Pro plan with unlimited projects and team members') }}</p>
            <div class="mt-4 space-y-2">
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-green-600">
                        <path d="M12 20a8 8 0 1 0 0-16 8 8 0 0 0 0 16Z"></path>
                        <path d="m9 12 2 2 4-4"></path>
                    </svg>
                    <span class="text-sm">{{ __('Unlimited Projects') }}</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-green-600">
                        <path d="M12 20a8 8 0 1 0 0-16 8 8 0 0 0 0 16Z"></path>
                        <path d="m9 12 2 2 4-4"></path>
                    </svg>
                    <span class="text-sm">{{ __('Up to 20 Team Members') }}</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-green-600">
                        <path d="M12 20a8 8 0 1 0 0-16 8 8 0 0 0 0 16Z"></path>
                        <path d="m9 12 2 2 4-4"></path>
                    </svg>
                    <span class="text-sm">{{ __('Advanced Reporting') }}</span>
                </div>
            </div>
            <flux:button class="mt-4 w-full">
                {{ __('Upgrade Plan') }}
            </flux:button>
        </div>

        <!-- Payment Method -->
        <div class="relative overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-800 p-6">
            <h2 class="text-xl font-semibold text-foreground mb-4">{{ __('Payment Method') }}</h2>
            <div class="flex items-center justify-between p-4 border border-zinc-200 rounded-lg dark:border-zinc-700">
                <div class="flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-8 w-8">
                        <rect width="20" height="14" x="2" y="5" rx="2"></rect>
                        <line x1="2" x2="22" y1="10" y2="10"></line>
                    </svg>
                    <div>
                        <p class="font-medium text-foreground">**** **** **** 1234</p>
                        <p class="text-sm text-zinc-500 dark:text-zinc-400">{{ __('Expires 12/2028') }}</p>
                    </div>
                </div>
                <flux:button variant="outline" size="sm">
                    {{ __('Change') }}
                </flux:button>
            </div>
            <h3 class="text-lg font-medium text-foreground mt-6 mb-3">{{ __('Recent Invoices') }}</h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between p-3 border border-zinc-200 rounded-lg dark:border-zinc-700">
                    <span class="text-foreground">{{ __('January 2024') }}</span>
                    <div class="flex items-center gap-2">
                        <span class="text-foreground">$29.00</span>
                        <flux:badge class="bg-green-500/10 text-green-700 dark:text-green-400">{{ __('Paid') }}</flux:badge>
                    </div>
                </div>
                <div class="flex items-center justify-between p-3 border border-zinc-200 rounded-lg dark:border-zinc-700">
                    <span class="text-foreground">{{ __('December 2023') }}</span>
                    <div class="flex items-center gap-2">
                        <span class="text-foreground">$29.00</span>
                        <flux:badge class="bg-green-500/10 text-green-700 dark:text-green-400">{{ __('Paid') }}</flux:badge>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Usage -->
    <div class="relative overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-800">
        <div class="p-6">
            <h2 class="text-xl font-semibold text-foreground mb-4">{{ __('Usage This Billing Period') }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <div class="flex justify-between mb-1">
                        <span class="text-sm text-zinc-500 dark:text-zinc-400">{{ __('Projects') }}</span>
                        <span class="text-sm text-foreground">12/20</span>
                    </div>
                    <div class="h-2 overflow-hidden rounded-full bg-zinc-100 dark:bg-zinc-700">
                        <div class="h-full bg-blue-500 transition-all" style="width: 60%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between mb-1">
                        <span class="text-sm text-zinc-500 dark:text-zinc-400">{{ __('Team Members') }}</span>
                        <span class="text-sm text-foreground">8/20</span>
                    </div>
                    <div class="h-2 overflow-hidden rounded-full bg-zinc-100 dark:bg-zinc-700">
                        <div class="h-full bg-green-500 transition-all" style="width: 40%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between mb-1">
                        <span class="text-sm text-zinc-500 dark:text-zinc-400">{{ __('Storage') }}</span>
                        <span class="text-sm text-foreground">2.4/5 GB</span>
                    </div>
                    <div class="h-2 overflow-hidden rounded-full bg-zinc-100 dark:bg-zinc-700">
                        <div class="h-full bg-purple-500 transition-all" style="width: 48%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>