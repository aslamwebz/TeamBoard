<div class="space-y-6">
    <div>
        <p class="text-muted-foreground">{{ __('Manage your subscription and payment methods') }}</p>
    </div>

    <!-- Subscription Status & Plans -->
    <div class="space-y-6">
        @if ($currentSubscription && $currentSubscription->onGracePeriod())
            <div class="rounded-xl border border-yellow-200 bg-yellow-50 dark:border-yellow-900/50 dark:bg-yellow-900/20 p-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-yellow-600 dark:text-yellow-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                        </svg>
                        <div>
                            <h3 class="font-medium text-yellow-900 dark:text-yellow-400">{{ __('Subscription Canceled') }}</h3>
                            <p class="text-sm text-yellow-700 dark:text-yellow-500">
                                {{ __('Your access will end on') }} {{ $currentSubscription->ends_at->format('M d, Y') }}.
                            </p>
                        </div>
                    </div>
                    <flux:button wire:click="resume" variant="primary" size="sm">
                        {{ __('Resume Subscription') }}
                    </flux:button>
                </div>
            </div>
        @endif

        @if ($currentSubscription)
            @php
                $currentPlanId = $currentSubscription->stripe_price;
                $currentPlan = collect($this->plans)->firstWhere('id', $currentPlanId);
            @endphp
            <div class="rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-800 p-6 shadow-sm">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h2 class="text-xl font-semibold text-foreground">{{ __('Your Subscription') }}</h2>
                        <div class="mt-2 flex items-baseline gap-2">
                            <span class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">
                                {{ $currentPlan['name'] ?? 'Unknown Plan' }}
                            </span>
                            <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20 dark:bg-green-500/10 dark:text-green-400 dark:ring-green-500/20">
                                @if($currentSubscription->ended())
                                    {{ __('Expired') }}
                                @elseif($currentSubscription->onGracePeriod())
                                    {{ __('Canceled') }}
                                @else
                                    {{ __('Active') }}
                                @endif
                            </span>
                        </div>
                        <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                            @if($currentSubscription->ended())
                                {{ __('Subscription ended on') }} {{ $currentSubscription->ends_at->format('F j, Y') }}
                            @elseif($currentSubscription->onGracePeriod())
                                {{ __('Access available until') }} {{ $currentSubscription->ends_at->format('F j, Y') }}
                            @else
                                {{ __('Renews on') }} {{ $currentSubscription->asStripeSubscription()->current_period_end_date->format('F j, Y') }}
                            @endif
                        </p>
                    </div>
                    <div class="flex items-center gap-3">
                        @if(!$showPlans && !$currentSubscription->ended())
                            <flux:button wire:click="showPlans" variant="primary">
                                {{ __('Upgrade / Change Plan') }}
                            </flux:button>
                        @endif

                        @if($currentSubscription->ended())
                             <flux:button wire:click="showPlans" variant="primary">
                                {{ __('Re-subscribe') }}
                            </flux:button>
                        @elseif($currentSubscription->onGracePeriod())
                             <flux:button wire:click="resume" variant="primary">
                                {{ __('Resume Subscription') }}
                            </flux:button>
                        @elseif(!$currentSubscription->canceled())
                            <flux:button wire:click="portal">
                                {{ __('Manage Billing') }}
                            </flux:button>
                        @endif
                    </div>
                </div>
            </div>
        @endif

        @if($showPlans)
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4 animate-in fade-in slide-in-from-top-4 duration-300">
                @foreach ($this->plans as $plan)
                    @php
                        $isCurrentPlan = $currentSubscription && $currentSubscription->stripe_price === $plan['id'];
                    @endphp
                    <div class="relative flex flex-col overflow-hidden rounded-xl border {{ $isCurrentPlan ? 'border-indigo-500 ring-1 ring-indigo-500' : 'border-zinc-200 dark:border-zinc-700' }} bg-white dark:bg-zinc-800 p-6 shadow-sm hover:shadow-md transition-shadow">
                        
                        @if($isCurrentPlan)
                            <div class="absolute top-0 right-0 bg-indigo-500 text-white text-xs font-bold px-2 py-1 rounded-bl-lg">
                                {{ __('Current') }}
                            </div>
                        @endif

                        <div class="mb-4">
                            <h2 class="text-lg font-semibold text-foreground">{{ $plan['name'] }}</h2>
                            <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1 h-8">{{ $plan['description'] }}</p>
                        </div>

                        <div class="flex items-baseline gap-1 mb-6">
                            <span class="text-3xl font-bold text-foreground">{{ $plan['price'] }}</span>
                            <span class="text-sm text-zinc-500 dark:text-zinc-400">{{ __('/mo') }}</span>
                        </div>

                        <ul class="space-y-3 mb-8 flex-1">
                            @foreach ($plan['features'] as $feature)
                                <div class="flex items-start gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="h-4 w-4 text-green-500 mt-0.5 shrink-0">
                                        <path d="M12 20a8 8 0 1 0 0-16 8 8 0 0 0 0 16Z"></path>
                                        <path d="m9 12 2 2 4-4"></path>
                                    </svg>
                                    <span class="text-sm text-zinc-600 dark:text-zinc-300 leading-tight">{{ $feature }}</span>
                                </div>
                            @endforeach
                        </ul>

                        <div class="mt-auto">
                            @if ($currentSubscription)
                                @if ($isCurrentPlan)
                                    <flux:button disabled class="w-full bg-zinc-100 dark:bg-zinc-700 text-zinc-400">
                                        {{ __('Active') }}
                                    </flux:button>
                                @else
                                    <flux:button wire:click="swap('{{ $plan['id'] }}')" 
                                        wire:confirm="{{ __('Are you sure you want to switch to the :plan plan?', ['plan' => $plan['name']]) }}"
                                        class="w-full" variant="outline">
                                        {{ __('Switch to :plan', ['plan' => $plan['name']]) }}
                                    </flux:button>
                                @endif
                            @else
                                <flux:button wire:click="checkout('{{ $plan['id'] }}')" class="w-full" variant="primary">
                                    {{ __('Subscribe') }}
                                </flux:button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            
            @if($currentSubscription)
                <div class="flex justify-center">
                    <flux:button wire:click="cancelPlans" variant="ghost" size="sm">
                        {{ __('Cancel / Hide Plans') }}
                    </flux:button>
                </div>
            @endif
        @endif

        @if(!$currentSubscription && !$showPlans)
            <!-- Fallback if logic misses - User has no sub but plans hidden -->
             <div class="text-center py-10">
                 <flux:button wire:click="showPlans" variant="primary">
                    {{ __('View Plans') }}
                </flux:button>
             </div>
        @endif

        <div class="flex justify-end border-t pt-4 border-zinc-200 dark:border-zinc-700">
             <flux:button wire:click="portal" variant="ghost">
                {{ __('Manage Payment Methods & History') }}
            </flux:button>
        </div>
    </div>

    <!-- Invoices List -->
    @if ($invoices->count() > 0)
        <div class="rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-800 p-6 mt-6">
            <h3 class="text-lg font-medium text-foreground mb-3">{{ __('Invoices') }}</h3>
            <div class="space-y-3">
                @foreach ($invoices as $invoice)
                    <div class="flex items-center justify-between p-3 border border-zinc-200 rounded-lg dark:border-zinc-700">
                        <span class="text-foreground">{{ $invoice->date()->toFormattedDateString() }}</span>
                        <div class="flex items-center gap-4">
                            <span class="text-foreground">{{ $invoice->total() }}</span>
                            <flux:badge color="{{ $invoice->paid ? 'green' : 'red' }}">
                                {{ $invoice->status }}
                            </flux:badge>
                            <a href="{{ $invoice->hosted_invoice_url }}" target="_blank" class="text-sm text-blue-500 hover:underline">
                                {{ __('Download') }}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
