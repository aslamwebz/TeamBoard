<flux:sidebar sticky stashable class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
    <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

    <!-- Logo -->
    <div class="flex-shrink-0 mb-4">
        <a href="{{ route('dashboard') }}" class="flex items-center">
            <x-application-logo class="h-8 w-auto" />
        </a>
    </div>

    <flux:navlist variant="outline">
        <flux:navlist.group class="grid">
            <flux:navlist.item icon="home" href="{{ route('dashboard') }}" :current="request()->routeIs('dashboard')"
                wire:navigate.hover @mouseenter="preloadLink('{{ route('dashboard') }}')">
                {{ __('Dashboard') }}
            </flux:navlist.item>

            <!-- Tasks - Available to all authenticated users -->
            <flux:navlist.item icon="list-bullet" href="{{ route('tasks') }}" :current="request()->routeIs('tasks')"
                wire:navigate.hover @mouseenter="preloadLink('{{ route('tasks') }}')">
                {{ __('Tasks') }}
            </flux:navlist.item>

            <!-- Projects - Available to all authenticated users -->
            <flux:navlist.item icon="folder" href="{{ route('projects') }}" :current="request()->routeIs('projects')"
                wire:navigate.hover @mouseenter="preloadLink('{{ route('projects') }}')">
                {{ __('Projects') }}
            </flux:navlist.item>

            <!-- Teams - Available to all authenticated users -->
            <flux:navlist.item icon="user-group" href="{{ route('teams.index') }}"
                :current="request()->routeIs('teams*')" wire:navigate.hover
                @mouseenter="preloadLink('{{ route('teams.index') }}')">
                {{ __('Teams') }}
            </flux:navlist.item>

        </flux:navlist.group>

        <!-- Users section - Only for users with user/role/permission permissions -->
        @canany(['view users', 'view roles', 'view permissions'])
        <flux:navlist.group label="Users" class="grid mt-4">
            @can('view users')
            <flux:navlist.item icon="user" href="{{ route('users') }}" :current="request()->routeIs('users')"
                wire:navigate.hover @mouseenter="preloadLink('{{ route('users') }}')">
                {{ __('Users') }}
            </flux:navlist.item>
            @endcan

            @can('view roles')
            <flux:navlist.item icon="shield-check" href="{{ route('roles.index') }}" :current="request()->routeIs('roles*')"
                wire:navigate.hover @mouseenter="preloadLink('{{ route('roles.index') }}')">
                {{ __('Roles') }}
            </flux:navlist.item>
            @endcan

            @can('view permissions')
            <flux:navlist.item icon="key" href="{{ route('permissions.index') }}" :current="request()->routeIs('permissions*')"
                wire:navigate.hover @mouseenter="preloadLink('{{ route('permissions.index') }}')">
                {{ __('Permissions') }}
            </flux:navlist.item>
            @endcan
        </flux:navlist.group>
        @endcanany

        <!-- CRM & Finance Section - Only for users with client/invoice permissions -->
        @canany(['view clients', 'view invoices', 'view reports'])
        <flux:navlist.group label="CRM & Finance" class="grid mt-4">
            @can('view clients')
            <flux:navlist.item icon="user-group" href="{{ route('clients.index') }}"
                :current="request()->routeIs('clients*')" wire:navigate.hover
                @mouseenter="preloadLink('{{ route('clients.index') }}')">
                {{ __('Clients') }}
            </flux:navlist.item>
            @endcan

            @can('view invoices')
            <flux:navlist.item icon="document-currency-dollar" href="{{ route('invoices.index') }}"
                :current="request()->routeIs('invoices*')" wire:navigate.hover
                @mouseenter="preloadLink('{{ route('invoices.index') }}')">
                {{ __('Invoices') }}
            </flux:navlist.item>
            @endcan

            @can('view reports')
            <flux:navlist.item icon="chart-bar" href="{{ route('reports.index') }}"
                :current="request()->routeIs('reports*')" wire:navigate.hover
                @mouseenter="preloadLink('{{ route('reports.index') }}')">
                {{ __('Reports') }}
            </flux:navlist.item>
            @endcan
        </flux:navlist.group>
        @endcanany
    </flux:navlist>

    <flux:spacer />

    @auth
        <!-- Desktop User Menu -->
        <flux:dropdown class="hidden lg:block" position="bottom" align="start">
            <flux:profile :initials="auth()->user()->initials()" icon-trailing="chevron-down" class="w-full" />

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
                    <flux:menu.item :href="route('settings.profile')" icon="cog">{{ __('Personal Settings') }}
                    </flux:menu.item>
                    <flux:menu.item :href="route('settings.company-profile')" icon="building-office-2">{{ __('Company Profile') }}
                    </flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full justify-start">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    @endauth
</flux:sidebar>

<!-- Mobile User Menu -->
@auth
    <flux:header class="lg:hidden">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <flux:spacer />

        <flux:dropdown position="top" align="end">
            <flux:profile :initials="auth()->user()->initials()" icon-trailing="chevron-down" />

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
                    <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Personal Settings') }}
                    </flux:menu.item>
                    <flux:menu.item :href="route('settings.company-profile')" icon="building-office-2" wire:navigate>{{ __('Company Profile') }}
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
@endauth
