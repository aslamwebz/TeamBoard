<flux:sidebar sticky collapsible
    class="in-data-flux-sidebar-on-desktop:not-in-data-flux-sidebar-collapsed-desktop:-mr-2 border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
    <flux:sidebar.header>
        <flux:sidebar.brand href="#" logo="https://fluxui.dev/img/demo/logo.png"
            logo:dark="https://fluxui.dev/img/demo/dark-mode-logo.png" name="Acme Inc." />
        <flux:sidebar.collapse
            class="in-data-flux-sidebar-on-desktop:not-in-data-flux-sidebar-collapsed-desktop:-mr-2" />
    </flux:sidebar.header>

    <flux:sidebar.nav>
        <flux:sidebar.item icon="home" href="{{ route('dashboard') }}" :current="request()->routeIs('dashboard')"
            wire:navigate.hover @mouseenter="preloadLink('{{ route('dashboard') }}')">
            {{ __('Dashboard') }}
        </flux:sidebar.item>

        <flux:sidebar.item icon="bell-alert" href="{{ route('notifications.index') }}"
            :current="request()->routeIs('notifications*')" wire:navigate.hover
            @mouseenter="preloadLink('{{ route('notifications.index') }}')">
            {{ __('Notifications') }}
            @php
                $unreadCount = auth()->user()?->notifications()->unread()->count() ?? 0;
            @endphp
            @if ($unreadCount > 0)
                <flux:badge slot="badge" variant="danger">{{ $unreadCount }}</flux:badge>
            @endif
        </flux:sidebar.item>

        <flux:sidebar.group expandable expanded="false" icon="folder-open" heading="WORK" class="grid">

            <flux:sidebar.item icon="briefcase" href="{{ route('projects') }}" :current="request()->routeIs('projects')"
                wire:navigate.hover @mouseenter="preloadLink('{{ route('projects') }}')">
                {{ __('Projects') }}
            </flux:sidebar.item>
            <flux:sidebar.item icon="list-bullet" href="{{ route('tasks') }}" :current="request()->routeIs('tasks')"
                wire:navigate.hover @mouseenter="preloadLink('{{ route('tasks') }}')">
                {{ __('Tasks') }}
            </flux:sidebar.item>

            <flux:sidebar.item icon="user-group" href="{{ route('teams.index') }}"
                :current="request()->routeIs('teams*')" wire:navigate.hover
                @mouseenter="preloadLink('{{ route('teams.index') }}')">
                {{ __('Teams') }}
            </flux:sidebar.item>

            <flux:sidebar.item icon="chat-bubble-left-right" href="{{ route('discussions.index') }}"
                :current="request()->routeIs('discussions*')" wire:navigate.hover
                @mouseenter="preloadLink('{{ route('discussions.index') }}')">
                {{ __('Discussions') }}
            </flux:sidebar.item>

            <flux:sidebar.item icon="folder-open" href="{{ route('files.index') }}"
                :current="request()->routeIs('files*')" wire:navigate.hover
                @mouseenter="preloadLink('{{ route('files.index') }}')">
                {{ __('Files') }}
            </flux:sidebar.item>
        </flux:sidebar.group>
        <flux:sidebar.group expandable expanded="false" icon="user-group" heading="CLIENTS" class="grid">
            <flux:sidebar.item icon="user-circle" href="{{ route('clients.index') }}"
                :current="request()->routeIs('clients*')" wire:navigate.hover
                @mouseenter="preloadLink('{{ route('clients.index') }}')">
                {{ __('Clients') }}
            </flux:sidebar.item>
        </flux:sidebar.group>
        <flux:sidebar.group expandable expanded="false" icon="user-circle" heading="USERS" class="grid">
            @canany(['view users', 'view roles', 'view permissions'])
                @can('view users')
                    <flux:sidebar.item icon="identification" href="{{ route('users') }}" :current="request()->routeIs('users')"
                        wire:navigate.hover @mouseenter="preloadLink('{{ route('users') }}')">
                        {{ __('Users') }}
                    </flux:sidebar.item>
                @endcan

                @can('view roles')
                    <flux:sidebar.item icon="shield-check" href="{{ route('roles.index') }}"
                        :current="request()->routeIs('roles*')" wire:navigate.hover
                        @mouseenter="preloadLink('{{ route('roles.index') }}')">
                        {{ __('Roles') }}
                    </flux:sidebar.item>
                @endcan

                @can('view permissions')
                    <flux:sidebar.item icon="key" href="{{ route('permissions.index') }}"
                        :current="request()->routeIs('permissions*')" wire:navigate.hover
                        @mouseenter="preloadLink('{{ route('permissions.index') }}')">
                        {{ __('Permissions') }}
                    </flux:sidebar.item>
                @endcan

            @endcanany
        </flux:sidebar.group>
        <flux:sidebar.group expandable expanded="false" icon="currency-dollar" heading="FINANCE" class="grid">
            @can('view invoices')
                <flux:sidebar.item icon="document-currency-dollar" href="{{ route('invoices.index') }}"
                    :current="request()->routeIs('invoices*')" wire:navigate.hover
                    @mouseenter="preloadLink('{{ route('invoices.index') }}')">
                    {{ __('Invoices') }}
                </flux:sidebar.item>
            @endcan

            <flux:sidebar.item icon="receipt-percent" href="{{ route('expenses.index') }}"
                :current="request()->routeIs('expenses*')" wire:navigate.hover
                @mouseenter="preloadLink('{{ route('expenses.index') }}')">
                {{ __('Expenses') }}
            </flux:sidebar.item>

            <flux:sidebar.item icon="credit-card" href="{{ route('payments.index') }}"
                :current="request()->routeIs('payments*')" wire:navigate.hover
                @mouseenter="preloadLink('{{ route('payments.index') }}')">
                {{ __('Payments') }}
            </flux:sidebar.item>

            <flux:sidebar.item icon="bell-alert" href="{{ route('payment-reminders.index') }}"
                :current="request()->routeIs('payment-reminders*')" wire:navigate.hover
                @mouseenter="preloadLink('{{ route('payment-reminders.index') }}')">
                {{ __('Payment Reminders') }}
            </flux:sidebar.item>
        </flux:sidebar.group>
        <flux:sidebar.group expandable expanded="false" icon="shopping-cart" heading="PROCUREMENT" class="grid">

            <flux:sidebar.item icon="building-office" href="{{ route('vendors') }}"
                :current="request()->routeIs('vendors*')" wire:navigate.hover
                @mouseenter="preloadLink('{{ route('vendors') }}')">
                {{ __('Vendors') }}
            </flux:sidebar.item>

            <flux:sidebar.item icon="clipboard-document-list" href="{{ route('purchase-orders') }}"
                :current="request()->routeIs('purchase-orders*')" wire:navigate.hover
                @mouseenter="preloadLink('{{ route('purchase-orders') }}')">
                {{ __('Purchase Orders') }}
            </flux:sidebar.item>
        </flux:sidebar.group>
        <flux:sidebar.group expandable expanded="false" icon="chart-bar" heading="REPORTS" class="grid">
            @can('view reports')
                <flux:sidebar.item icon="chart-pie" href="{{ route('reports.index') }}"
                    :current="request()->routeIs('reports*')" wire:navigate.hover
                    @mouseenter="preloadLink('{{ route('reports.index') }}')">
                    {{ __('Reports') }}
                </flux:sidebar.item>
            @endcan
        </flux:sidebar.group>

    </flux:sidebar.nav>

    <flux:sidebar.spacer />

    <flux:sidebar.nav>
        @auth
            <!-- Desktop User Menu -->
            <flux:dropdown position="bottom" align="top" class="max-lg:hidden">
                <flux:sidebar.profile avatar="https://fluxui.dev/img/demo/user.png" name="{{ auth()->user()->name }}" />
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
                    <flux:menu.item :href="route('settings.profile')" icon="cog">{{ __('Personal Settings') }}
                    </flux:menu.item>
                    <flux:menu.item icon="arrow-right-start-on-rectangle">Logout</flux:menu.item>
                </flux:menu>
            </flux:dropdown>
            <flux:header class="lg:hidden">
                <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
                <flux:spacer />
                <flux:dropdown position="top" align="start">
                    <flux:profile avatar="/img/demo/user.png" />
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
                        <flux:menu.item :href="route('settings.profile')" icon="cog">{{ __('Personal Settings') }}
                        </flux:menu.item>
                        <flux:menu.item icon="arrow-right-start-on-rectangle">Logout</flux:menu.item>
                    </flux:menu>
                </flux:dropdown>
            </flux:header>
        @endauth
    </flux:sidebar.nav>
</flux:sidebar>
