<flux:header class="[grid-area:header] z-10 min-h-14 flex items-center px-6 pt-4 lg:px-8" data-flux-header="">
    <flux:sidebar.toggle class="lg:hidden" icon="bars-2" />

    <!-- Logo - Hidden on mobile, visible on large screens -->
    <div class="hidden lg:flex lg:items-center lg:mr-6">
        <a href="{{ route('dashboard') }}" class="flex items-center">
            <x-application-logo class="h-8 w-auto" />
        </a>
    </div>

    <!-- Spacer to push notification and profile to the right -->
    <flux:spacer />

    <!-- Notification Bell -->
    <div class="mr-4 hidden lg:block">
        <livewire:notification-center />
    </div>

    <flux:dropdown position="top end">
        <flux:profile :initials="auth()->user()->initials()" />

        <flux:menu>
            <flux:menu.radio.group>
                <div class="p-0 text-sm font-normal">
                    <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                        <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                            <span
                                class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                {{ auth()->user()->initials() }}
                            </span>
                        </span>

                        <div class="grid flex-1 text-start text-sm leading-tight">
                            <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                            <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                        </div>
                    </div>
                </div>
            </flux:menu.radio.group>

            <flux:menu.separator />

            <flux:menu.radio.group>
                <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>
                    {{ __('Personal Settings') }}
                </flux:menu.item>
                <flux:menu.item :href="route('settings.company-profile')" icon="building-office-2" wire:navigate>
                    {{ __('Company Profile') }}
                </flux:menu.item>
            </flux:menu.radio.group>

            <flux:menu.separator />

            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                    {{ __('Log Out') }}
                </flux:menu.item>
            </form>
        </flux:menu>
    </flux:dropdown>
</flux:header>