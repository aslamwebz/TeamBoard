<flux:sidebar sticky stashable class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
    <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

    <!-- Logo -->
    <div class="flex-shrink-0 mb-4">
        <a href="{{ route('dashboard') }}" class="flex items-center">
            <x-application-logo class="h-8 w-auto" />
        </a>
    </div>

    <!-- Groups are now handled by individual Flux sidebar groups with collapsible functionality -->

    <!-- Core Navigation -->
    <flux:sidebar.group label="Core" :current="request()->routeIs('dashboard') || request()->routeIs('notifications*') || request()->routeIs('tasks') || request()->routeIs('projects')">
        <flux:navlist variant="outline">
            <flux:navlist.item icon="home" href="{{ route('dashboard') }}" :current="request()->routeIs('dashboard')"
                wire:navigate.hover @mouseenter="preloadLink('{{ route('dashboard') }}')">
                {{ __('Dashboard') }}
            </flux:navlist.item>

            <!-- Notifications -->
            <flux:navlist.item icon="bell-alert" href="{{ route('notifications.index') }}" :current="request()->routeIs('notifications*')"
                wire:navigate.hover @mouseenter="preloadLink('{{ route('notifications.index') }}')">
                {{ __('Notifications') }}
                @php
                    $unreadCount = auth()->user()?->notifications()->unread()->count() ?? 0;
                @endphp
                @if($unreadCount > 0)
                    <flux:badge slot="badge" variant="danger">{{ $unreadCount }}</flux:badge>
                @endif
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
        </flux:navlist>
    </flux:sidebar.group>

    <!-- Collaboration -->
    <flux:sidebar.group label="Collaboration" :current="request()->routeIs('teams*') || request()->routeIs('discussions*') || request()->routeIs('files*')">
        <flux:navlist variant="outline">
            <flux:navlist.item icon="user-group" href="{{ route('teams.index') }}"
                :current="request()->routeIs('teams*')" wire:navigate.hover
                @mouseenter="preloadLink('{{ route('teams.index') }}')">
                {{ __('Teams') }}
            </flux:navlist.item>

            <flux:navlist.item icon="chat-bubble-left-right" href="{{ route('discussions.index') }}" :current="request()->routeIs('discussions*')"
                wire:navigate.hover @mouseenter="preloadLink('{{ route('discussions.index') }}')">
                {{ __('Discussions') }}
            </flux:navlist.item>

            <flux:navlist.item icon="folder-open" href="{{ route('files.index') }}" :current="request()->routeIs('files*')"
                wire:navigate.hover @mouseenter="preloadLink('{{ route('files.index') }}')">
                {{ __('Files') }}
            </flux:navlist.item>
        </flux:navlist>
    </flux:sidebar.group>

    <!-- Business Operations -->
    <flux:sidebar.group label="Business Operations" :current="request()->routeIs('clients*') || request()->routeIs('vendors*') || request()->routeIs('purchase-orders*')">
        <flux:navlist variant="outline">
            <flux:navlist.item icon="user-group" href="{{ route('clients.index') }}"
                :current="request()->routeIs('clients*')" wire:navigate.hover
                @mouseenter="preloadLink('{{ route('clients.index') }}')">
                {{ __('Clients') }}
            </flux:navlist.item>

            <flux:navlist.item icon="building-office" href="{{ route('vendors') }}"
                :current="request()->routeIs('vendors*')" wire:navigate.hover
                @mouseenter="preloadLink('{{ route('vendors') }}')">
                {{ __('Vendors') }}
            </flux:navlist.item>

            <flux:navlist.item icon="clipboard-document-list" href="{{ route('purchase-orders') }}"
                :current="request()->routeIs('purchase-orders*')" wire:navigate.hover
                @mouseenter="preloadLink('{{ route('purchase-orders') }}')">
                {{ __('Purchase Orders') }}
            </flux:navlist.item>
        </flux:navlist>
    </flux:sidebar.group>

    <!-- Financial Management -->
    <flux:sidebar.group label="Financial Management" :current="request()->routeIs('invoices*') || request()->routeIs('expenses*') || request()->routeIs('payments*') || request()->routeIs('payment-reminders*')">
        <flux:navlist variant="outline">
            @can('view invoices')
            <flux:navlist.item icon="document-currency-dollar" href="{{ route('invoices.index') }}"
                :current="request()->routeIs('invoices*')" wire:navigate.hover
                @mouseenter="preloadLink('{{ route('invoices.index') }}')">
                {{ __('Invoices') }}
            </flux:navlist.item>
            @endcan

            <flux:navlist.item icon="receipt-percent" href="{{ route('expenses.index') }}"
                :current="request()->routeIs('expenses*')" wire:navigate.hover
                @mouseenter="preloadLink('{{ route('expenses.index') }}')">
                {{ __('Expenses') }}
            </flux:navlist.item>

            <flux:navlist.item icon="credit-card" href="{{ route('payments.index') }}"
                :current="request()->routeIs('payments*')" wire:navigate.hover
                @mouseenter="preloadLink('{{ route('payments.index') }}')">
                {{ __('Payments') }}
            </flux:navlist.item>

            <flux:navlist.item icon="bell-alert" href="{{ route('payment-reminders.index') }}"
                :current="request()->routeIs('payment-reminders*')" wire:navigate.hover
                @mouseenter="preloadLink('{{ route('payment-reminders.index') }}')">
                {{ __('Payment Reminders') }}
            </flux:navlist.item>
        </flux:navlist>
    </flux:sidebar.group>

    <!-- Users section - Only for users with user/role/permission permissions -->
    @canany(['view users', 'view roles', 'view permissions'])
    <flux:sidebar.group label="User Management" :current="request()->routeIs('users') || request()->routeIs('roles*') || request()->routeIs('permissions*')">
        <flux:navlist variant="outline">
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
        </flux:navlist>
    </flux:sidebar.group>
    @endcanany

    <!-- Analytics -->
    @can('view reports')
    <flux:sidebar.group label="Analytics" :current="request()->routeIs('reports*')">
        <flux:navlist variant="outline">
            <flux:navlist.item icon="chart-bar" href="{{ route('reports.index') }}"
                :current="request()->routeIs('reports*')" wire:navigate.hover
                @mouseenter="preloadLink('{{ route('reports.index') }}')">
                {{ __('Reports') }}
            </flux:navlist.item>
        </flux:navlist>
    </flux:sidebar.group>
    @endcan

    <flux:spacer />

    @auth
        <!-- Desktop User Menu -->
        <flux:dropdown class="hidden lg:block" position="top" align="start">
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
