<div class="space-y-12">
    <div class="text-center">
        <h1 class="text-4xl font-bold text-foreground mb-4">{{ __('Pricing') }}</h1>
        <p class="text-lg text-zinc-500 dark:text-zinc-400 max-w-2xl mx-auto">
            {{ __('Choose the perfect plan for your team. All plans include a 14-day free trial.') }}
        </p>
    </div>

    <!-- Pricing Toggle -->
    <div class="flex items-center justify-center">
        <div class="relative inline-flex items-center rounded-xl bg-zinc-100 p-1 dark:bg-zinc-800">
            <span class="text-sm font-medium text-zinc-500 dark:text-zinc-400 px-4 py-1.5">{{ __('Monthly') }}</span>
            <button class="relative ml-1 inline-flex h-8 w-14 items-center rounded-lg bg-white shadow-sm transition-transform dark:bg-zinc-700" aria-pressed="false">
                <span class="ml-1 size-6 translate-x-0 rounded-full bg-zinc-900 transition-transform dark:bg-white"></span>
            </button>
            <span class="text-sm font-medium text-zinc-900 dark:text-white px-4 py-1.5">{{ __('Yearly') }}</span>
            <span class="ml-2 rounded-full bg-blue-500 px-2 py-0.5 text-xs text-white">{{ __('Save 20%') }}</span>
        </div>
    </div>

    <!-- Pricing Plans -->
    <div class="grid gap-8 md:grid-cols-3">
        <!-- Basic Plan -->
        <div class="relative overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-800 p-6">
            <h2 class="text-xl font-semibold text-foreground mb-2">{{ __('Basic') }}</h2>
            <p class="text-zinc-500 dark:text-zinc-400 mb-6">{{ __('Perfect for individuals and small teams') }}</p>
            <div class="flex items-baseline gap-2 mb-6">
                <span class="text-4xl font-bold text-foreground">$9</span>
                <span class="text-zinc-500 dark:text-zinc-400">{{ __('per month') }}</span>
            </div>
            <ul class="space-y-3 mb-8">
                <li class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-green-600">
                        <path d="M12 20a8 8 0 1 0 0-16 8 8 0 0 0 0 16Z"></path>
                        <path d="m9 12 2 2 4-4"></path>
                    </svg>
                    <span>{{ __('Up to 5 projects') }}</span>
                </li>
                <li class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-green-600">
                        <path d="M12 20a8 8 0 1 0 0-16 8 8 0 0 0 0 16Z"></path>
                        <path d="m9 12 2 2 4-4"></path>
                    </svg>
                    <span>{{ __('3 team members') }}</span>
                </li>
                <li class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-green-600">
                        <path d="M12 20a8 8 0 1 0 0-16 8 8 0 0 0 0 16Z"></path>
                        <path d="m9 12 2 2 4-4"></path>
                    </svg>
                    <span>{{ __('Basic reporting') }}</span>
                </li>
                <li class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-green-600">
                        <path d="M12 20a8 8 0 1 0 0-16 8 8 0 0 0 0 16Z"></path>
                        <path d="m9 12 2 2 4-4"></path>
                    </svg>
                    <span>{{ __('Email support') }}</span>
                </li>
            </ul>
            <flux:button class="w-full">
                {{ __('Start Free Trial') }}
            </flux:button>
        </div>

        <!-- Professional Plan (Popular) -->
        <div class="relative overflow-hidden rounded-xl border-2 border-blue-500 bg-white dark:bg-zinc-800 p-6">
            <div class="absolute top-0 right-0 rounded-bl-xl rounded-tr-xl bg-blue-500 px-4 py-1.5 text-sm font-medium text-white dark:bg-blue-600">
                {{ __('Most Popular') }}
            </div>
            <h2 class="text-xl font-semibold text-foreground mb-2">{{ __('Professional') }}</h2>
            <p class="text-zinc-500 dark:text-zinc-400 mb-6">{{ __('Ideal for growing teams and businesses') }}</p>
            <div class="flex items-baseline gap-2 mb-6">
                <span class="text-4xl font-bold text-foreground">$29</span>
                <span class="text-zinc-500 dark:text-zinc-400">{{ __('per month') }}</span>
            </div>
            <ul class="space-y-3 mb-8">
                <li class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-green-600">
                        <path d="M12 20a8 8 0 1 0 0-16 8 8 0 0 0 0 16Z"></path>
                        <path d="m9 12 2 2 4-4"></path>
                    </svg>
                    <span>{{ __('Unlimited projects') }}</span>
                </li>
                <li class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-green-600">
                        <path d="M12 20a8 8 0 1 0 0-16 8 8 0 0 0 0 16Z"></path>
                        <path d="m9 12 2 2 4-4"></path>
                    </svg>
                    <span>{{ __('Up to 20 team members') }}</span>
                </li>
                <li class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-green-600">
                        <path d="M12 20a8 8 0 1 0 0-16 8 8 0 0 0 0 16Z"></path>
                        <path d="m9 12 2 2 4-4"></path>
                    </svg>
                    <span>{{ __('Advanced reporting') }}</span>
                </li>
                <li class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-green-600">
                        <path d="M12 20a8 8 0 1 0 0-16 8 8 0 0 0 0 16Z"></path>
                        <path d="m9 12 2 2 4-4"></path>
                    </svg>
                    <span>{{ __('Priority support') }}</span>
                </li>
                <li class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-green-600">
                        <path d="M12 20a8 8 0 1 0 0-16 8 8 0 0 0 0 16Z"></path>
                        <path d="m9 12 2 2 4-4"></path>
                    </svg>
                    <span>{{ __('API access') }}</span>
                </li>
            </ul>
            <flux:button class="w-full bg-blue-600 hover:bg-blue-700 dark:bg-blue-600 dark:hover:bg-blue-700">
                {{ __('Start Free Trial') }}
            </flux:button>
        </div>

        <!-- Enterprise Plan -->
        <div class="relative overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-800 p-6">
            <h2 class="text-xl font-semibold text-foreground mb-2">{{ __('Enterprise') }}</h2>
            <p class="text-zinc-500 dark:text-zinc-400 mb-6">{{ __('For large organizations with custom needs') }}</p>
            <div class="flex items-baseline gap-2 mb-6">
                <span class="text-4xl font-bold text-foreground">$99</span>
                <span class="text-zinc-500 dark:text-zinc-400">{{ __('per month') }}</span>
            </div>
            <ul class="space-y-3 mb-8">
                <li class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-green-600">
                        <path d="M12 20a8 8 0 1 0 0-16 8 8 0 0 0 0 16Z"></path>
                        <path d="m9 12 2 2 4-4"></path>
                    </svg>
                    <span>{{ __('Unlimited projects') }}</span>
                </li>
                <li class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-green-600">
                        <path d="M12 20a8 8 0 1 0 0-16 8 8 0 0 0 0 16Z"></path>
                        <path d="m9 12 2 2 4-4"></path>
                    </svg>
                    <span>{{ __('Unlimited team members') }}</span>
                </li>
                <li class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-green-600">
                        <path d="M12 20a8 8 0 1 0 0-16 8 8 0 0 0 0 16Z"></path>
                        <path d="m9 12 2 2 4-4"></path>
                    </svg>
                    <span>{{ __('Advanced analytics') }}</span>
                </li>
                <li class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-green-600">
                        <path d="M12 20a8 8 0 1 0 0-16 8 8 0 0 0 0 16Z"></path>
                        <path d="m9 12 2 2 4-4"></path>
                    </svg>
                    <span>{{ __('24/7 dedicated support') }}</span>
                </li>
                <li class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-green-600">
                        <path d="M12 20a8 8 0 1 0 0-16 8 8 0 0 0 0 16Z"></path>
                        <path d="m9 12 2 2 4-4"></path>
                    </svg>
                    <span>{{ __('Custom integrations') }}</span>
                </li>
            </ul>
            <flux:button class="w-full">
                {{ __('Contact Sales') }}
            </flux:button>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="bg-zinc-50 dark:bg-zinc-900 rounded-xl p-8">
        <h2 class="text-2xl font-bold text-foreground mb-6 text-center">{{ __('Frequently Asked Questions') }}</h2>
        <div class="grid gap-6 max-w-3xl mx-auto">
            <div>
                <h3 class="text-lg font-semibold text-foreground mb-2">{{ __('Can I change plans later?') }}</h3>
                <p class="text-zinc-500 dark:text-zinc-400">
                    {{ __('Yes, you can upgrade, downgrade, or cancel your plan at any time. Changes will take effect at the start of your next billing cycle.') }}
                </p>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-foreground mb-2">{{ __('Is there a free version?') }}</h3>
                <p class="text-zinc-500 dark:text-zinc-400">
                    {{ __('Yes, we offer a free plan that includes basic features for individuals and small teams. You can upgrade to access more features as you grow.') }}
                </p>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-foreground mb-2">{{ __('Do you offer discounts for non-profits?') }}</h3>
                <p class="text-zinc-500 dark:text-zinc-400">
                    {{ __('Yes, we offer special pricing for non-profit organizations. Please contact our sales team for more information.') }}
                </p>
            </div>
        </div>
    </div>
</div>