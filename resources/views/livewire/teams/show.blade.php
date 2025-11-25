<div class="space-y-6">
    @if (session()->has('success'))
        <div
            class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg dark:bg-green-900/30 dark:border-green-800 dark:text-green-400">
            {{ session('success') }}
        </div>
    @endif

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
        <!-- Projects and Tasks -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Projects Section -->
            <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-foreground">Projects</h2>
                        <button type="button" wire:click="$toggle('showAssignProjectModal')"
                            class="inline-flex items-center px-3 py-1.5 border border-blue-300 rounded-md text-sm font-medium text-blue-700 bg-white hover:bg-blue-50 dark:bg-zinc-700 dark:text-blue-400 dark:border-blue-600 dark:hover:bg-blue-900/20">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="h-4 w-4 mr-1">
                                <path d="M12 5v14M5 12h14" />
                            </svg>
                            Assign Project
                        </button>
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
                                            <button wire:click="removeProject({{ $project->id }})"
                                                class="text-red-600 hover:text-red-800 dark:text-red-400">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="h-4 w-4">
                                                    <path d="M18 6L6 18M6 6l12 12"></path>
                                                </svg>
                                            </button>
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
                            <p class="mt-1 text-sm text-muted-foreground">Assign projects to this team to get started.
                            </p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Tasks Section -->
            <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-foreground">Team Tasks</h2>
                        <button type="button" wire:click="$toggle('showAssignTaskModal')"
                            class="inline-flex items-center px-3 py-1.5 border border-blue-300 rounded-md text-sm font-medium text-blue-700 bg-white hover:bg-blue-50 dark:bg-zinc-700 dark:text-blue-400 dark:border-blue-600 dark:hover:bg-blue-900/20">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="h-4 w-4 mr-1">
                                <path d="M12 5v14M5 12h14" />
                            </svg>
                            Assign Task
                        </button>
                    </div>

                    @php
                        $teamTasks = collect();
                        foreach ($team->projects as $project) {
                            $teamTasks = $teamTasks->merge($project->tasks);
                        }
                        $recentTasks = $teamTasks->take(10);
                    @endphp

                    @if ($recentTasks->count() > 0)
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
                    @else
                        <div class="text-center py-8">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="mx-auto h-12 w-12 text-zinc-400">
                                <path d="M9 11l3 3L22 4"></path>
                                <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-foreground">No tasks</h3>
                            <p class="mt-1 text-sm text-muted-foreground">No tasks found in team projects.</p>
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
                    <button type="button" wire:click="$toggle('showAssignClientModal')"
                        class="inline-flex items-center px-3 py-1.5 border border-blue-300 rounded-md text-sm font-medium text-blue-700 bg-white hover:bg-blue-50 dark:bg-zinc-700 dark:text-blue-400 dark:border-blue-600 dark:hover:bg-blue-900/20">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="h-4 w-4 mr-1">
                            <path d="M12 5v14M5 12h14" />
                        </svg>
                        Assign Client
                    </button>
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
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('clients.show', $client) }}"
                                        class="text-blue-600 hover:text-blue-800 dark:text-blue-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="h-4 w-4">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                    </a>
                                    <button wire:click="removeClient({{ $client->id }})"
                                        class="text-red-600 hover:text-red-800 dark:text-red-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="h-4 w-4">
                                            <path d="M18 6L6 18M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4">
                        <p class="text-sm text-muted-foreground">No clients assigned</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- Team Members Table -->
    <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700">
        <div class="p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-foreground">Team Members</h2>
                <button type="button" wire:click="$toggle('showAssignMemberModal')"
                    class="inline-flex items-center px-3 py-1.5 border border-blue-300 rounded-md text-sm font-medium text-blue-700 bg-white hover:bg-blue-50 dark:bg-zinc-700 dark:text-blue-400 dark:border-blue-600 dark:hover:bg-blue-900/20">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="h-4 w-4 mr-1">
                        <path d="M12 5v14M5 12h14" />
                    </svg>
                    Assign Member
                </button>
            </div>

            @if ($team->users->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-zinc-200 dark:divide-zinc-700">
                        <thead class="bg-zinc-50 dark:bg-zinc-900">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                    Name</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                    Email</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                    Projects</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                    Status</th>
                                <th
                                    class="px-6 py-3 text-right text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-zinc-800 divide-y divide-zinc-200 dark:divide-zinc-700">
                            @foreach ($team->users as $user)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <div
                                                    class="h-10 w-10 rounded-full bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center text-white font-medium">
                                                    {{ substr($user->name, 0, 2) }}
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-foreground">{{ $user->name }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-zinc-600 dark:text-zinc-400">{{ $user->email }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-zinc-600 dark:text-zinc-400">
                                            {{ $user->projects->count() }} projects
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-500/10 text-green-700 dark:text-green-400">
                                            Active
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button wire:click="removeMember({{ $user->id }})"
                                            class="text-red-600 hover:text-red-800 dark:text-red-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" viewBox="0 0 16 16">
                                                <path
                                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                <path fill-rule="evenodd"
                                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-zinc-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-foreground">No team members</h3>
                    <p class="mt-1 text-sm text-muted-foreground">Get started by adding team members.</p>
                    <div class="mt-6">
                        <button type="button" wire:click="$toggle('showAssignMemberModal')"
                            class="inline-flex items-center px-3 py-1.5 border border-blue-300 rounded-md text-sm font-medium text-blue-700 bg-white hover:bg-blue-50 dark:bg-zinc-700 dark:text-blue-400 dark:border-blue-600 dark:hover:bg-blue-900/20">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="h-4 w-4 mr-1">
                                <path d="M12 5v14M5 12h14" />
                            </svg>
                            Assign Member
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <x-modal name="assign-member" showProperty="showAssignMemberModal" selectedItemsProperty="selectedUsers"
        title="Assign Team Member" description="Select team members to assign to this team." :items="$allUsers"
        :onSubmit="'assignMembers'" submitLabel="Assign Members" cancelLabel="Cancel" type="assign" />

    <x-modal name="assign-client" showProperty="showAssignClientModal" selectedItemsProperty="selectedClients"
        title="Assign Client" description="Select clients to assign to this team." :items="$allClients" :onSubmit="'assignClients'"
        submitLabel="Assign Clients" cancelLabel="Cancel" type="assign" />



    <x-modal name="assign-project" showProperty="showAssignProjectModal" selectedItemsProperty="selectedProjects"
        title="Assign Project" description="Select projects to assign to this team." :items="$allProjects"
        :onSubmit="'assignProjects'" submitLabel="Assign Projects" cancelLabel="Cancel" type="assign" />

    <x-modal name="assign-task" showProperty="showAssignTaskModal" selectedItemsProperty="selectedTasks"
        title="Assign Task" description="Select tasks to assign to team members." :items="$allTasks" :onSubmit="'assignTasks'"
        submitLabel="Assign Tasks" cancelLabel="Cancel" type="assign" />
</div>
