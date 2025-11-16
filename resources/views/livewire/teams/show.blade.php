<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-foreground">{{ $team->name }}</h1>
            @if ($team->description)
                <p class="text-muted-foreground">{{ $team->description }}</p>
            @endif
        </div>
        <div class="flex gap-3">
            <a href="{{ route('teams.index') }}"
                class="px-4 py-2 border border-zinc-200 rounded-lg text-zinc-700 hover:bg-zinc-50 dark:border-zinc-700 dark:text-zinc-300 dark:hover:bg-zinc-700">Back
                to Teams</a>
            <a href="{{ route('teams.edit', $team) }}"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Edit Team</a>
        </div>
    </div>

    <!-- Team Overview Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="h-6 w-6 text-blue-600 dark:text-blue-400">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                    </svg>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-foreground">{{ $team->users->count() }}</h3>
                    <p class="text-sm text-muted-foreground">Team Members</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-green-100 dark:bg-green-900/30 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="h-6 w-6 text-green-600 dark:text-green-400">
                        <path d="M22 19h-4l-3-3m0 0l-3 3m3-3v8"></path>
                        <path d="M16 3h4l3 3m0 0l-3 3m3-3V3"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-foreground">{{ $team->projects->count() }}</h3>
                    <p class="text-sm text-muted-foreground">Active Projects</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-purple-100 dark:bg-purple-900/30 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="h-6 w-6 text-purple-600 dark:text-purple-400">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-foreground">{{ $team->clients->count() }}</h3>
                    <p class="text-sm text-muted-foreground">Associated Clients</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Team Details -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Team Members -->
        <div class="lg:col-span-2">
            <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-foreground">Team Members</h2>
                        <button class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400">+ Add
                            Member</button>
                    </div>

                    @if ($team->users->count() > 0)
                        <div class="space-y-3">
                            @foreach ($team->users as $user)
                                <div
                                    class="flex items-center justify-between p-3 border border-zinc-200 dark:border-zinc-700 rounded-lg">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 bg-zinc-200 dark:bg-zinc-700 rounded-full flex items-center justify-center">
                                            <span class="text-sm font-medium text-zinc-600 dark:text-zinc-300">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </span>
                                        </div>
                                        <div>
                                            <h4 class="font-medium text-foreground">{{ $user->name }}</h4>
                                            <p class="text-sm text-zinc-500 dark:text-zinc-400">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                                            Active
                                        </span>
                                        <button class="text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="h-4 w-4">
                                                <path d="M12 5v14M5 12h14"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="mx-auto h-12 w-12 text-zinc-400">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-foreground">No team members</h3>
                            <p class="mt-1 text-sm text-muted-foreground">Add users to this team to get started.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Projects -->
            <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 mt-6">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-foreground">Projects</h2>
                        <a href="{{ route('projects.create') }}"
                            class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400">+ Add Project</a>
                    </div>

                    @if ($team->projects->count() > 0)
                        <div class="space-y-3">
                            @foreach ($team->projects as $project)
                                @php
                                    $statusColors = [
                                        'planning' => 'bg-yellow-500/10 text-yellow-700 dark:text-yellow-400',
                                        'in_progress' => 'bg-blue-500/10 text-blue-700 dark:text-blue-400',
                                        'completed' => 'bg-green-500/10 text-green-700 dark:text-green-400',
                                        'on_hold' => 'bg-red-500/10 text-red-700 dark:text-red-400',
                                    ];
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
                                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                                        <circle cx="9" cy="7" r="4"></circle>
                                                    </svg>
                                                    {{ $project->client->name ?? 'No Client' }}
                                                </div>
                                                <div class="flex items-center gap-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="h-4 w-4">
                                                        <path d="M9 11l3 3L22 4"></path>
                                                        <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11">
                                                        </path>
                                                    </svg>
                                                    {{ $project->tasks->count() }} tasks
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColors[$project->status] ?? 'bg-zinc-500/10 text-zinc-700 dark:text-zinc-400' }}">
                                                {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                                            </span>
                                        </div>
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
                                <path d="M22 19h-4l-3 3m0 0l-3-3m3 3V10"></path>
                                <path d="M6 12V2m0 0l3 3m-3-3L3 5"></path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-foreground">No projects</h3>
                            <p class="mt-1 text-sm text-muted-foreground">Create projects to assign to this team.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Team Info Sidebar -->
        <div class="space-y-6">
            <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
                <h3 class="text-lg font-semibold text-foreground mb-4">Team Information</h3>

                <div class="space-y-4">
                    <div>
                        <h3 class="text-sm font-medium text-muted-foreground">Team Details</h3>
                        <div class="mt-2 space-y-2 text-sm text-foreground">
                            <p>Name: {{ $team->name }}</p>
                            @if ($team->description)
                                <p class="text-zinc-600 dark:text-zinc-400">{{ $team->description }}</p>
                            @endif
                        </div>
                    </div>

                    <div>
                        <h3 class="text-sm font-medium text-muted-foreground">Timeline</h3>
                        <div class="mt-2 space-y-1 text-sm text-foreground">
                            <p>Created: {{ $team->created_at->format('M d, Y') }}</p>
                            <p>Updated: {{ $team->updated_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Associated Clients -->
            <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-foreground">Clients</h3>
                    <button class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400">+ Add Client</button>
                </div>

                @if ($team->clients->count() > 0)
                    <div class="space-y-2">
                        @foreach ($team->clients as $client)
                            <div
                                class="flex items-center justify-between p-2 border border-zinc-200 dark:border-zinc-700 rounded">
                                <div>
                                    <h4 class="font-medium text-foreground text-sm">{{ $client->name }}</h4>
                                    @if ($client->company_name)
                                        <p class="text-xs text-zinc-500 dark:text-zinc-400">
                                            {{ $client->company_name }}</p>
                                    @endif
                                </div>
                                <a href="{{ route('clients.show', $client) }}"
                                    class="text-blue-600 hover:text-blue-800 dark:text-blue-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4">
                        <p class="text-sm text-muted-foreground">No clients associated</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
