<div class="space-y-6">
    <div>
        <h1 class="text-3xl font-bold text-foreground">{{ __('Worker Dashboard') }}</h1>
        <p class="text-muted-foreground">{{ __('Welcome back, ') }}{{ auth()->user()->name }}! {{ __('Here\'s what you need to focus on today.') }}</p>
    </div>

    <!-- Worker Stats Grid -->
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
        <!-- My Tasks Card -->
        <div class="relative overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-800">
            <div class="flex items-center justify-between p-6 pb-2">
                <h3 class="text-sm font-medium text-zinc-500 dark:text-zinc-400">{{ __('My Tasks') }}</h3>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-blue-600">
                    <path d="M12 2v20M5 12h14M5 6h14M5 18h14"/>
                </svg>
            </div>
            <div class="p-6 pt-0">
                <div class="text-2xl font-bold text-foreground">{{ $myTasks->count() }}</div>
                <p class="text-xs text-zinc-500 dark:text-zinc-400">
                    @if($myTasks->where('status', 'completed')->count() > 0)
                        <span class="text-green-600">+{{ $myTasks->where('status', 'completed')->count() }} {{ __('completed') }}</span>
                    @endif
                    {{ __('this week') }}
                </p>
            </div>
        </div>

        <!-- My Projects Card -->
        <div class="relative overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-800">
            <div class="flex items-center justify-between p-6 pb-2">
                <h3 class="text-sm font-medium text-zinc-500 dark:text-zinc-400">{{ __('My Projects') }}</h3>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-purple-600">
                    <path d="M4 20h16a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.93a2 2 0 0 1-1.66-.9l-.82-1.2A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13c0 1.1.9 2 2 2Z"/>
                </svg>
            </div>
            <div class="p-6 pt-0">
                <div class="text-2xl font-bold text-foreground">{{ $myProjects->count() }}</div>
                <p class="text-xs text-zinc-500 dark:text-zinc-400">
                    @if($myProjects->count() > 0)
                        @php
                            $total = 0;
                            foreach($myProjects as $project) {
                                $total += $project->getCompletionPercentage();
                            }
                            $avg = $myProjects->count() > 0 ? $total / $myProjects->count() : 0;
                        @endphp
                        <span class="text-green-600">{{ number_format($avg, 0) }}%</span> {{ __('avg completion') }}
                    @endif
                </p>
            </div>
        </div>

        <!-- My Timesheets Card -->
        <div class="relative overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-800">
            <div class="flex items-center justify-between p-6 pb-2">
                <h3 class="text-sm font-medium text-zinc-500 dark:text-zinc-400">{{ __('Hours This Week') }}</h3>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-green-600">
                    <circle cx="12" cy="12" r="10"/>
                    <polyline points="12 6 12 12 16 14"/>
                </svg>
            </div>
            <div class="p-6 pt-0">
                <div class="text-2xl font-bold text-foreground">42</div>
                <p class="text-xs text-zinc-500 dark:text-zinc-400">
                    <span class="text-green-600">+5</span> {{ __('from last week') }}
                </p>
            </div>
        </div>

        <!-- Upcoming Deadlines Card -->
        <div class="relative overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-800">
            <div class="flex items-center justify-between p-6 pb-2">
                <h3 class="text-sm font-medium text-zinc-500 dark:text-zinc-400">{{ __('Upcoming') }}</h3>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-orange-600">
                    <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                    <line x1="16" x2="16" y1="2" y2="6"/>
                    <line x1="8" x2="8" y1="2" y2="6"/>
                    <line x1="3" x2="21" y1="10" y2="10"/>
                </svg>
            </div>
            <div class="p-6 pt-0">
                <div class="text-2xl font-bold text-foreground">{{ $upcomingDeadlines->count() }}</div>
                <p class="text-xs text-zinc-500 dark:text-zinc-400">
                    @if($upcomingDeadlines->where('due_date', '<', now()->addDays(1))->count() > 0)
                        <span class="text-red-600">{{ $upcomingDeadlines->where('due_date', '<', now()->addDays(1))->count() }} {{ __('overdue') }}</span>
                    @endif
                </p>
            </div>
        </div>
    </div>

    <!-- My Tasks and Projects Row -->
    <div class="grid gap-6 md:grid-cols-1 lg:grid-cols-2">
        <!-- My Tasks Section -->
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold text-foreground">{{ __('My Tasks') }}</h2>
                    <a href="{{ route('tasks') }}" class="text-sm text-blue-600 hover:underline">{{ __('View All') }}</a>
                </div>
                
                @if($myTasks->count() > 0)
                    <div class="space-y-4">
                        @foreach($myTasks->take(5) as $task)
                            <div class="space-y-2">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="font-medium text-foreground">{{ $task->title }}</p>
                                        <p class="text-sm text-zinc-500 dark:text-zinc-400">
                                            {{ $task->project->name ?? __('No Project') }} • 
                                            @if($task->due_date)
                                                {{ __('Due: ') }}{{ $task->due_date->format('M d') }}
                                            @else
                                                {{ __('No due date') }}
                                            @endif
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-medium text-foreground capitalize">{{ $task->status }}</p>
                                        <p class="text-xs text-zinc-500 dark:text-zinc-400">{{ $task->due_date ? $task->due_date->diffForHumans() : __('No due date') }}</p>
                                    </div>
                                </div>
                                <div class="h-2 overflow-hidden rounded-full bg-zinc-100 dark:bg-zinc-700">
                                    <div class="h-full bg-{{ $task->status === 'completed' ? 'green' : ($task->status === 'in_progress' ? 'blue' : 'yellow') }}-500 transition-all" style="width: {{ $task->status === 'completed' ? '100' : ($task->status === 'in_progress' ? '50' : '25') }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 text-zinc-500 dark:text-zinc-400">
                        {{ __('No tasks assigned to you') }}
                    </div>
                @endif
            </div>
        </div>

        <!-- My Projects Section -->
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold text-foreground">{{ __('My Projects') }}</h2>
                    <a href="{{ route('projects') }}" class="text-sm text-blue-600 hover:underline">{{ __('View All') }}</a>
                </div>
                
                @if($myProjects->count() > 0)
                    <div class="space-y-4">
                        @foreach($myProjects->take(5) as $project)
                            <div class="space-y-2">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="font-medium text-foreground">{{ $project->name }}</p>
                                        <p class="text-sm text-zinc-500 dark:text-zinc-400">
                                            @if($project->due_date)
                                                {{ __('Due: ') }}{{ $project->due_date->format('M d') }}
                                            @else
                                                {{ __('No due date') }}
                                            @endif
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-medium text-foreground">{{ $project->getCompletionPercentage() }}%</p>
                                        <p class="text-xs text-zinc-500 dark:text-zinc-400 capitalize">{{ $project->status }}</p>
                                    </div>
                                </div>
                                <div class="h-2 overflow-hidden rounded-full bg-zinc-100 dark:bg-zinc-700">
                                    <div class="h-full bg-blue-500 transition-all" style="width: {{ $project->getCompletionPercentage() }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 text-zinc-500 dark:text-zinc-400">
                        {{ __('No projects assigned to you') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Upcoming Deadlines and Team Activity Row -->
    <div class="grid gap-6 md:grid-cols-1 lg:grid-cols-2">
        <!-- Upcoming Deadlines Section -->
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold text-foreground">{{ __('Upcoming Deadlines') }}</h2>
                    <a href="{{ route('tasks') }}" class="text-sm text-blue-600 hover:underline">{{ __('View All') }}</a>
                </div>
                
                @if($upcomingDeadlines->count() > 0)
                    <div class="space-y-4">
                        @foreach($upcomingDeadlines->take(5) as $task)
                            @php
                                $isOverdue = $task->due_date->isBefore(now()->startOfDay());
                                $dateClass = $isOverdue ? 'text-red-600 dark:text-red-400' : ($task->due_date->isToday() ? 'text-amber-600 dark:text-amber-400' : 'text-zinc-500 dark:text-zinc-400');
                                $bgClass = $isOverdue ? 'bg-red-50 dark:bg-red-900/20' : ($task->due_date->isToday() ? 'bg-amber-50 dark:bg-amber-900/20' : 'bg-blue-50 dark:bg-blue-900/20');
                            @endphp
                            <div class="p-4 rounded-lg {{ $bgClass }}">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <p class="font-medium text-foreground">{{ $task->title }}</p>
                                        <p class="text-sm {{ $dateClass }}">{{ $task->project->name ?? __('No Project') }}</p>
                                    </div>
                                    <span class="text-sm font-medium {{ $dateClass }}">
                                        {{ $task->due_date->format('M d') }}
                                        @if($isOverdue)({{ $task->due_date->diffForHumans() }})@endif
                                    </span>
                                </div>
                                @if($isOverdue)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                        {{ __('Overdue') }}
                                    </span>
                                @elseif($task->due_date->isToday())
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-900 dark:text-amber-200">
                                        {{ __('Due Today') }}
                                    </span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 text-zinc-500 dark:text-zinc-400">
                        {{ __('No upcoming deadlines') }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Team Activity Section -->
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-foreground mb-4">{{ __('Team Activity') }}</h2>
                
                @if($teamActivity->count() > 0)
                    <div class="space-y-4">
                        @foreach($teamActivity->take(5) as $activity)
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="h-8 w-8 rounded-full bg-zinc-200 dark:bg-zinc-700 flex items-center justify-center">
                                        <span class="text-sm font-medium text-zinc-700 dark:text-zinc-300">
                                            {{ strtoupper(substr($activity['user'], 0, 1)) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-foreground">
                                        <span class="font-medium">{{ $activity['user'] }}</span> 
                                        {{ $activity['message'] }}
                                    </p>
                                    <p class="text-xs text-zinc-500 dark:text-zinc-400">{{ $activity['time']->diffForHumans() }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 text-zinc-500 dark:text-zinc-400">
                        {{ __('No recent activity') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Quick Actions Section -->
    <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800">
        <div class="p-6">
            <h2 class="text-xl font-semibold text-foreground mb-4">{{ __('Quick Actions') }}</h2>
            
            <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
                @foreach($quickActions as $action)
                    @if(isset($action['params']))
                        <a href="{{ route($action['route'], $action['params']) }}" class="block">
                    @else
                        <a href="{{ route($action['route']) }}" class="block">
                    @endif
                        <div class="p-4 rounded-lg border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 hover:shadow-md transition-shadow duration-150">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 rounded-full bg-{{ $action['color'] }}-100 dark:bg-{{ $action['color'] }}-900 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-{{ $action['color'] }}-600 dark:text-{{ $action['color'] }}-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-sm font-medium text-foreground">{{ $action['title'] }}</h3>
                                    <p class="text-sm text-zinc-500 dark:text-zinc-400">{{ $action['description'] }}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>