<div class="space-y-6">
    <div>
        <h1 class="text-3xl font-bold text-foreground">{{ __('Client Dashboard') }}</h1>
        <p class="text-muted-foreground">{{ __('Welcome back, ') }}{{ $clientInfo['name'] ?? auth()->user()->name }}! {{ __('Here\'s an overview of your projects and account.') }}</p>
    </div>

    <!-- Client Stats Grid -->
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
        <!-- Active Projects Card -->
        <div class="relative overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-800">
            <div class="flex items-center justify-between p-6 pb-2">
                <h3 class="text-sm font-medium text-zinc-500 dark:text-zinc-400">{{ __('Active Projects') }}</h3>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-blue-600">
                    <path d="M4 20h16a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.93a2 2 0 0 1-1.66-.9l-.82-1.2A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13c0 1.1.9 2 2 2Z"/>
                </svg>
            </div>
            <div class="p-6 pt-0">
                <div class="text-2xl font-bold text-foreground">{{ count($projectProgress) }}</div>
                <p class="text-xs text-zinc-500 dark:text-zinc-400">
                    @if(count($projectProgress) > 0)
                        <span class="text-green-600">{{ number_format(collect($projectProgress)->avg('progress'), 0) }}%</span> {{ __('avg completion') }}
                    @endif
                </p>
            </div>
        </div>

        <!-- Outstanding Invoices Card -->
        <div class="relative overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-800">
            <div class="flex items-center justify-between p-6 pb-2">
                <h3 class="text-sm font-medium text-zinc-500 dark:text-zinc-400">{{ __('Outstanding Invoices') }}</h3>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-green-600">
                    <path d="M12 2v20M5 12h14M5 6h14M5 18h14"/>
                </svg>
            </div>
            <div class="p-6 pt-0">
                <div class="text-2xl font-bold text-foreground">{{ $invoices->where('status', '!=', 'paid')->count() }}</div>
                <p class="text-xs text-zinc-500 dark:text-zinc-400">
                    @php
                        $outstandingAmount = $invoices->where('status', '!=', 'paid')->sum('amount');
                    @endphp
                    <span class="text-red-600">${{ number_format($outstandingAmount, 2) }}</span> {{ __('due') }}
                </p>
            </div>
        </div>

        <!-- Files Shared Card -->
        <div class="relative overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-800">
            <div class="flex items-center justify-between p-6 pb-2">
                <h3 class="text-sm font-medium text-zinc-500 dark:text-zinc-400">{{ __('Files Shared') }}</h3>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-purple-600">
                    <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/>
                    <polyline points="14 2 14 8 20 8"/>
                </svg>
            </div>
            <div class="p-6 pt-0">
                <div class="text-2xl font-bold text-foreground">{{ $files->count() }}</div>
                <p class="text-xs text-zinc-500 dark:text-zinc-400">
                    {{ __('latest: ') }}{{ $files->first()?->created_at?->format('M d') ?? 'N/A' }}
                </p>
            </div>
        </div>

        <!-- Project Requests Card -->
        <div class="relative overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-800">
            <div class="flex items-center justify-between p-6 pb-2">
                <h3 class="text-sm font-medium text-zinc-500 dark:text-zinc-400">{{ __('Project Requests') }}</h3>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-orange-600">
                    <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/>
                </svg>
            </div>
            <div class="p-6 pt-0">
                <div class="text-2xl font-bold text-foreground">{{ $projectRequests->count() }}</div>
                <p class="text-xs text-zinc-500 dark:text-zinc-400">
                    @if($projectRequests->count() > 0)
                        <span class="text-green-600">{{ $projectRequests->where('status', 'pending')->count() }} {{ __('pending') }}</span>
                    @endif
                </p>
            </div>
        </div>
    </div>

    <!-- Project Progress and Invoices Row -->
    <div class="grid gap-6 md:grid-cols-1 lg:grid-cols-2">
        <!-- Project Progress Section -->
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold text-foreground">{{ __('Project Progress') }}</h2>
                    <a href="{{ route('projects') }}" class="text-sm text-blue-600 hover:underline">{{ __('View All') }}</a>
                </div>
                
                @if(count($projectProgress) > 0)
                    <div class="space-y-4">
                        @foreach($projectProgress as $project)
                            <a href="{{ route('projects.show', $project['id']) }}" class="block space-y-2">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="font-medium text-foreground hover:underline">{{ $project['name'] }}</p>
                                        <p class="text-sm text-zinc-500 dark:text-zinc-400">
                                            {{ $project['tasks_completed'] }}/{{ $project['total_tasks'] }} {{ __('tasks completed') }}
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-medium text-foreground">{{ $project['progress'] }}%</p>
                                        <p class="text-xs text-zinc-500 dark:text-zinc-400 capitalize">{{ $project['status'] }}</p>
                                    </div>
                                </div>
                                <div class="h-2 overflow-hidden rounded-full bg-zinc-100 dark:bg-zinc-700">
                                    <div class="h-full bg-blue-500 transition-all" style="width: {{ $project['progress'] }}%"></div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 text-zinc-500 dark:text-zinc-400">
                        {{ __('No projects assigned to you') }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Invoices Section -->
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold text-foreground">{{ __('Recent Invoices') }}</h2>
                    <a href="{{ route('invoices.index') }}" class="text-sm text-blue-600 hover:underline">{{ __('View All') }}</a>
                </div>
                
                @if($invoices->count() > 0)
                    <div class="space-y-4">
                        @foreach($invoices as $invoice)
                            <a href="{{ route('invoices.show', $invoice->id) }}" class="block space-y-2">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="font-medium text-foreground hover:underline">#{{ $invoice->id }} - {{ $invoice->project->name ?? 'Project' }}</p>
                                        <p class="text-sm text-zinc-500 dark:text-zinc-400">
                                            {{ __('Due: ') }}{{ $invoice->due_date?->format('M d, Y') ?? 'N/A' }}
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-medium text-foreground">${{ number_format($invoice->amount, 2) }}</p>
                                        <span class="text-xs font-medium px-2 py-0.5 rounded-full bg-{{ $invoice->status === 'paid' ? 'green' : ($invoice->status === 'overdue' ? 'red' : 'yellow') }}-100 text-{{ $invoice->status === 'paid' ? 'green' : ($invoice->status === 'overdue' ? 'red' : 'yellow') }}-800 dark:bg-{{ $invoice->status === 'paid' ? 'green' : ($invoice->status === 'overdue' ? 'red' : 'yellow') }}-900 dark:text-{{ $invoice->status === 'paid' ? 'green' : ($invoice->status === 'overdue' ? 'red' : 'yellow') }}-200">
                                            {{ ucfirst($invoice->status) }}
                                        </span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 text-zinc-500 dark:text-zinc-400">
                        {{ __('No invoices') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Files/Documents and Project Requests Row -->
    <div class="grid gap-6 md:grid-cols-1 lg:grid-cols-2">
        <!-- Files/Documents Section -->
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold text-foreground">{{ __('Files & Documents') }}</h2>
                    <a href="{{ route('files.index') }}" class="text-sm text-blue-600 hover:underline">{{ __('View All') }}</a>
                </div>
                
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-3 rounded-lg border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-blue-600">
                                    <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/>
                                    <polyline points="14 2 14 8 20 8"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-foreground">Project_Contract.pdf</p>
                                <p class="text-xs text-zinc-500 dark:text-zinc-400">2.4 MB • Updated: Today</p>
                            </div>
                        </div>
                        <div>
                            <a href="#" class="text-sm text-blue-600 hover:underline">
                                {{ __('Download') }}
                            </a>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 rounded-lg border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-green-600">
                                    <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/>
                                    <polyline points="14 2 14 8 20 8"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-foreground">Requirements_Document.docx</p>
                                <p class="text-xs text-zinc-500 dark:text-zinc-400">1.2 MB • Updated: 2 days ago</p>
                            </div>
                        </div>
                        <div>
                            <a href="#" class="text-sm text-blue-600 hover:underline">
                                {{ __('Download') }}
                            </a>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 rounded-lg border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-purple-600">
                                    <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/>
                                    <polyline points="14 2 14 8 20 8"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-foreground">Project_Timeline.pdf</p>
                                <p class="text-xs text-zinc-500 dark:text-zinc-400">3.1 MB • Updated: 1 week ago</p>
                            </div>
                        </div>
                        <div>
                            <a href="#" class="text-sm text-blue-600 hover:underline">
                                {{ __('Download') }}
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4 pt-4 border-t border-zinc-200 dark:border-zinc-700">
                    <a href="{{ route('files.upload') }}" class="w-full block py-2 px-4 rounded-md text-sm font-medium text-zinc-700 dark:text-zinc-200 bg-white dark:bg-zinc-700 hover:bg-zinc-50 dark:hover:bg-zinc-600 border border-zinc-300 dark:border-zinc-600 text-center">
                        {{ __('Upload New File') }}
                    </a>
                </div>
            </div>
        </div>

        <!-- Project Requests Section -->
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-semibold text-foreground">{{ __('Project Requests') }}</h2>
                    <a href="{{ route('discussions.index') }}" class="text-sm text-blue-600 hover:underline">{{ __('View All') }}</a>
                </div>
                
                @if($projectRequests->count() > 0)
                    <div class="space-y-4">
                        @foreach($projectRequests as $request)
                            <div class="p-4 rounded-lg border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800">
                                <div class="flex justify-between">
                                    <div>
                                        <p class="font-medium text-foreground">{{ $request->title ?? $request->name ?? 'Project Request' }}</p>
                                        <p class="text-sm text-zinc-500 dark:text-zinc-400 mt-1">
                                            {{ \Illuminate\Support\Str::limit($request->description ?? $request->message ?? 'No description', 80) }}
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-xs font-medium px-2 py-0.5 rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                            {{ $request->status ?? 'Pending' }}
                                        </span>
                                    </div>
                                </div>
                                <div class="mt-3 flex items-center justify-between">
                                    <span class="text-xs text-zinc-500 dark:text-zinc-400">
                                        {{ $request->created_at?->diffForHumans() ?? 'Unknown date' }}
                                    </span>
                                    <a href="{{ route('discussions.show', $request->id) }}" class="text-sm text-blue-600 hover:underline">
                                        {{ __('View') }}
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 text-zinc-500 dark:text-zinc-400">
                        {{ __('No project requests') }}
                    </div>
                @endif
                
                <div class="mt-4 pt-4 border-t border-zinc-200 dark:border-zinc-700">
                    <a href="{{ route('discussions.create') }}" class="w-full block py-2 px-4 rounded-md text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 text-center">
                        {{ __('Submit New Request') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Team Chat Section -->
    <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800">
        <div class="p-6">
            <h2 class="text-xl font-semibold text-foreground mb-4">{{ __('Team Communication') }}</h2>
            
            <div class="flex flex-col h-96">
                <!-- Chat Messages -->
                <div class="flex-1 overflow-y-auto mb-4 space-y-4">
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-full bg-zinc-200 dark:bg-zinc-700 flex items-center justify-center">
                                <span class="text-sm font-medium text-zinc-700 dark:text-zinc-300">PM</span>
                            </div>
                        </div>
                        <div class="flex-1 bg-zinc-100 dark:bg-zinc-700 rounded-lg p-3">
                            <div class="flex items-center justify-between">
                                <span class="font-medium text-foreground">Project Manager</span>
                                <span class="text-xs text-zinc-500 dark:text-zinc-400">10:30 AM</span>
                            </div>
                            <p class="mt-1 text-sm text-foreground">
                                {{ __('Your project is on track to be completed by the deadline. We\'ve completed the design phase and are moving to development.') }}
                            </p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-3 justify-end">
                        <div class="flex-1 bg-blue-100 dark:bg-blue-900 rounded-lg p-3 max-w-[80%]">
                            <div class="flex items-center justify-between">
                                <span class="font-medium text-foreground">{{ auth()->user()->name }}</span>
                                <span class="text-xs text-zinc-500 dark:text-zinc-400">10:32 AM</span>
                            </div>
                            <p class="mt-1 text-sm text-foreground">
                                {{ __('Great to hear! Please let me know if you need any additional assets from our end.') }}
                            </p>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-full bg-zinc-200 dark:bg-zinc-700 flex items-center justify-center">
                                <span class="text-sm font-medium text-zinc-700 dark:text-zinc-300">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 rounded-full bg-zinc-200 dark:bg-zinc-700 flex items-center justify-center">
                                <span class="text-sm font-medium text-zinc-700 dark:text-zinc-300">DS</span>
                            </div>
                        </div>
                        <div class="flex-1 bg-zinc-100 dark:bg-zinc-700 rounded-lg p-3">
                            <div class="flex items-center justify-between">
                                <span class="font-medium text-foreground">Designer</span>
                                <span class="text-xs text-zinc-500 dark:text-zinc-400">10:45 AM</span>
                            </div>
                            <p class="mt-1 text-sm text-foreground">
                                {{ __('I\'ve uploaded the final mockups to the project folder. Please take a look and let me know if you have any feedback.') }}
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Chat Input -->
                <div class="flex items-center space-x-2">
                    <input 
                        type="text" 
                        placeholder="{{ __('Type your message here...') }}" 
                        class="flex-1 border border-zinc-300 dark:border-zinc-600 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-zinc-700 dark:text-white"
                    >
                    <button class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700">
                        {{ __('Send') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>