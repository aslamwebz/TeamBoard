<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-foreground">{{ $client->company_name }}</h1>
            @if ($client->name)
                <p class="text-muted-foreground">{{ $client->name }}</p>
            @endif
        </div>
        <div class="flex gap-3">
            <a href="{{ route('clients.index') }}"
                class="px-4 py-2 border border-zinc-200 rounded-lg text-zinc-700 hover:bg-zinc-50 dark:border-zinc-700 dark:text-zinc-300 dark:hover:bg-zinc-700">Back
                to Clients</a>
            <a href="{{ route('clients.edit', $client) }}"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Edit Client</a>
        </div>
    </div>

    <!-- Client Overview Stats -->
    @php
        $projectCount = $client->projects()->count();
        $activeProjects = $client
            ->projects()
            ->whereIn('status', ['planning', 'in_progress'])
            ->count();
        $completedProjects = $client->projects()->where('status', 'completed')->count();
        $totalTasks = $client->projects()->withCount('tasks')->get()->sum('tasks_count');
        $completedTasks = $client
            ->projects()
            ->whereHas('tasks', function ($query) {
                $query->where('status', 'completed');
            })
            ->count();
        $inProgressTasks = $client
            ->projects()
            ->whereHas('tasks', function ($query) {
                $query->where('status', 'in_progress');
            })
            ->count();
    @endphp

    <div class="grid gap-4 md:grid-cols-4">
        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-4">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="h-5 w-5 text-blue-600">
                    <path d="M22 19h-4.5a2.5 2.5 0 0 1-2.5-2.5V12a2.5 2.5 0 0 1 2.5-2.5H22"></path>
                    <path d="M2 19h4.5a2.5 2.5 0 0 0 2.5-2.5V12a2.5 2.5 0 0 0-2.5-2.5H2"></path>
                    <path d="M12 19h0"></path>
                </svg>
                <div>
                    <p class="text-sm text-zinc-500 dark:text-zinc-400">Total Projects</p>
                    <p class="text-2xl font-bold text-foreground">{{ $projectCount }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-4">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="h-5 w-5 text-green-600">
                    <path d="M9 11l3 3L22 4"></path>
                    <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path>
                </svg>
                <div>
                    <p class="text-sm text-zinc-500 dark:text-zinc-400">Total Tasks</p>
                    <p class="text-2xl font-bold text-foreground">{{ $totalTasks }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-4">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="h-5 w-5 text-yellow-600">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
                <div>
                    <p class="text-sm text-zinc-500 dark:text-zinc-400">In Progress</p>
                    <p class="text-2xl font-bold text-foreground">{{ $activeProjects }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-4">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="h-5 w-5 text-purple-600">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
                <div>
                    <p class="text-sm text-zinc-500 dark:text-zinc-400">Completion Rate</p>
                    <p class="text-2xl font-bold text-foreground">
                        {{ $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0 }}%</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-3">
        <!-- Client Information -->
        <div class="lg:col-span-1">
            <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700">
                <div class="p-6">
                    <h2 class="text-lg font-semibold text-foreground mb-4">Client Information</h2>

                    <div class="space-y-4">
                        <div>
                            <h3 class="text-sm font-medium text-muted-foreground">Company Information</h3>
                            <div class="mt-2 space-y-2">
                                @if ($client->company_name)
                                    <div class="flex items-center gap-2 text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="h-4 w-4 text-zinc-500">
                                            <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"></path>
                                        </svg>
                                        <span class="text-foreground">{{ $client->company_name }}</span>
                                    </div>
                                @endif
                                @if ($client->industry)
                                    <div class="flex items-center gap-2 text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="h-4 w-4 text-zinc-500">
                                            <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"></path>
                                            <path d="M9 22V12h6v10"></path>
                                        </svg>
                                        <span class="text-foreground">{{ $client->industry }}</span>
                                    </div>
                                @endif
                                @if ($client->website)
                                    <div class="flex items-center gap-2 text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="h-4 w-4 text-zinc-500">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <path d="M12 16v-4"></path>
                                            <path d="M12 8h.01"></path>
                                        </svg>
                                        <a href="{{ $client->website }}" target="_blank"
                                            class="text-blue-600 hover:text-blue-800 dark:text-blue-400">{{ $client->website }}</a>
                                    </div>
                                @endif
                                @if ($client->description)
                                    <div class="mt-2 text-sm text-foreground">
                                        {{ $client->description }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-muted-foreground">Primary Contact</h3>
                            <div class="mt-2 space-y-2">
                                @if ($client->name)
                                    <div class="flex items-center gap-2 text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="h-4 w-4 text-zinc-500">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="9" cy="7" r="4"></circle>
                                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                        </svg>
                                        <span class="text-foreground">{{ $client->name }}</span>
                                    </div>
                                @endif
                                @if ($client->email)
                                    <div class="flex items-center gap-2 text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="h-4 w-4 text-zinc-500">
                                            <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                                            <path d="m22 7-10 5L2 7"></path>
                                        </svg>
                                        <a href="mailto:{{ $client->email }}"
                                            class="text-blue-600 hover:text-blue-800 dark:text-blue-400">{{ $client->email }}</a>
                                    </div>
                                @endif
                                @if ($client->phone)
                                    <div class="flex items-center gap-2 text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="h-4 w-4 text-zinc-500">
                                            <path
                                                d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                            </path>
                                        </svg>
                                        <a href="tel:{{ $client->phone }}"
                                            class="text-blue-600 hover:text-blue-800 dark:text-blue-400">{{ $client->phone }}</a>
                                    </div>
                                @endif
                            </div>
                        </div>

                        @if ($client->address || $client->city || $client->state || $client->zip_code || $client->country)
                            <div>
                                <h3 class="text-sm font-medium text-muted-foreground">Address</h3>
                                <div class="mt-2 text-sm text-foreground">
                                    @if ($client->address)
                                        <p>{{ $client->address }}</p>
                                    @endif
                                    @if ($client->city || $client->state || $client->zip_code || $client->country)
                                        <p>{{ collect([$client->city, $client->state, $client->zip_code, $client->country])->filter()->implode(', ') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        @endif

                        @if ($client->vat_number)
                            <div>
                                <h3 class="text-sm font-medium text-muted-foreground">VAT Number</h3>
                                <p class="mt-1 text-sm text-foreground">{{ $client->vat_number }}</p>
                            </div>
                        @endif

                        <div>
                            <h3 class="text-sm font-medium text-muted-foreground">Account Details</h3>
                            <div class="mt-2 space-y-1 text-sm text-foreground">
                                <p>Created: {{ $client->created_at->format('M d, Y') }}</p>
                                <p>Updated: {{ $client->updated_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Projects and Tasks -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Projects Section -->
            <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-foreground">Projects</h2>
                        <a href="{{ route('projects.create') }}?client_id={{ $client->id }}"
                            class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400">+ Add Project</a>
                    </div>

                    @php
                        $projects = $client->projects()->latest()->get();
                    @endphp

                    @if ($projects->count() > 0)
                        <div class="space-y-3">
                            @foreach ($projects as $project)
                                @php
                                    $statusColors = [
                                        'planning' => 'bg-yellow-500/10 text-yellow-700 dark:text-yellow-400',
                                        'in_progress' => 'bg-blue-500/10 text-blue-700 dark:text-blue-400',
                                        'completed' => 'bg-green-500/10 text-green-700 dark:text-green-400',
                                        'on_hold' => 'bg-red-500/10 text-red-700 dark:text-red-400',
                                    ];
                                    $taskCount = $project->tasks()->count();
                                    $completedTaskCount = $project->tasks()->where('status', 'completed')->count();
                                @endphp
                                <div
                                    class="border border-zinc-200 dark:border-zinc-700 rounded-lg p-4 hover:bg-zinc-50 dark:hover:bg-zinc-700/50 transition-colors">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <h3 class="font-medium text-foreground mb-1">
                                                <a href="{{ route('projects.show', $project) }}"
                                                    class="hover:text-blue-600 dark:hover:text-blue-400">
                                                    {{ $project->name }}
                                                </a>
                                            </h3>
                                            @if ($project->description)
                                                <p class="text-sm text-zinc-500 dark:text-zinc-400 mb-2">
                                                    {{ Str::limit($project->description, 80) }}</p>
                                            @endif
                                            <div
                                                class="flex items-center gap-4 text-sm text-zinc-500 dark:text-zinc-400">
                                                <div class="flex items-center gap-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="h-4 w-4">
                                                        <path d="M9 11l3 3L22 4"></path>
                                                        <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11">
                                                        </path>
                                                    </svg>
                                                    {{ $taskCount }} tasks
                                                    @if ($taskCount > 0)
                                                        <span
                                                            class="text-green-600 dark:text-green-400">({{ $completedTaskCount }}
                                                            done)</span>
                                                    @endif
                                                </div>
                                                @if ($project->due_date)
                                                    <div class="flex items-center gap-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            class="h-4 w-4">
                                                            <path d="M8 2v4"></path>
                                                            <path d="M16 2v4"></path>
                                                            <rect width="18" height="18" x="3" y="4"
                                                                rx="2"></rect>
                                                            <path d="M3 10h18"></path>
                                                        </svg>
                                                        {{ $project->due_date->format('M d, Y') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <flux:badge
                                            class="{{ $statusColors[$project->status] ?? 'bg-zinc-500/10 text-zinc-700 dark:text-zinc-400' }}">
                                            {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                                        </flux:badge>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="mx-auto h-12 w-12 text-zinc-400">
                                <path d="M5 22h14"></path>
                                <path d="M5 2h14"></path>
                                <path d="M17 22v-4.172a2 2 0 0 0-.586-1.414L12 12l-4.414 4.414A2 2 0 0 0 7 17.828V22">
                                </path>
                                <path d="M7 2v4.172a2 2 0 0 0 .586 1.414L12 12l4.414-4.414A2 2 0 0 0 17 6.172V2"></path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-zinc-900 dark:text-zinc-100">No projects</h3>
                            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">This client doesn't have any
                                projects yet.</p>
                            <div class="mt-4">
                                <a href="{{ route('projects.create') }}?client_id={{ $client->id }}"
                                    class="inline-flex items-center gap-2 px-3 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                                        <path d="M5 12h14"></path>
                                        <path d="M12 5v14"></path>
                                    </svg>
                                    Create First Project
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Recent Tasks Section -->
            @php
                $recentTasks = $client
                    ->projects()
                    ->with([
                        'tasks' => function ($query) {
                            $query->latest()->take(5);
                        },
                    ])
                    ->get()
                    ->pluck('tasks')
                    ->flatten();
            @endphp

            @if ($recentTasks->count() > 0)
                <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-semibold text-foreground">Recent Tasks</h2>
                            <a href="{{ route('tasks.index') }}?client_id={{ $client->id }}"
                                class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400">View All</a>
                        </div>

                        <div class="space-y-3">
                            @foreach ($recentTasks as $task)
                                @php
                                    $statusColors = [
                                        'todo' => 'bg-zinc-500/10 text-zinc-700 dark:text-zinc-400',
                                        'in_progress' => 'bg-blue-500/10 text-blue-700 dark:text-blue-400',
                                        'completed' => 'bg-green-500/10 text-green-700 dark:text-green-400',
                                        'on_hold' => 'bg-red-500/10 text-red-700 dark:text-red-400',
                                    ];
                                @endphp
                                <div
                                    class="flex items-center justify-between p-3 border border-zinc-200 dark:border-zinc-700 rounded-lg">
                                    <div class="flex-1">
                                        <h4 class="font-medium text-foreground mb-1">
                                            <a href="{{ route('tasks.show', $task) }}"
                                                class="hover:text-blue-600 dark:hover:text-blue-400">
                                                {{ $task->title }}
                                            </a>
                                        </h4>
                                        <div class="flex items-center gap-3 text-sm text-zinc-500 dark:text-zinc-400">
                                            <span>{{ $task->project->name }}</span>
                                            @if ($task->due_date)
                                                <span>Due: {{ $task->due_date->format('M d') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <flux:badge
                                        class="{{ $statusColors[$task->status] ?? 'bg-zinc-500/10 text-zinc-700 dark:text-zinc-400' }}">
                                        {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                    </flux:badge>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>