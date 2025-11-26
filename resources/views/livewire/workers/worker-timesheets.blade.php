<div>
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Timesheets</h2>
            <p class="text-gray-600">Track work hours for {{ $worker->user->name }}</p>
        </div>
        <a 
            href="{{ route('workers.show', $workerId) }}" 
            class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
        >
            Back to Worker
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-1 bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Add Timesheet Entry</h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div>
                        <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                        <input 
                            type="date" 
                            id="date" 
                            wire:model="date" 
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white text-gray-900"
                        />
                        @error('date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="hours_worked" class="block text-sm font-medium text-gray-700">Hours Worked</label>
                        <input 
                            type="number" 
                            id="hours_worked" 
                            wire:model="hours_worked" 
                            step="0.01" 
                            min="0.01" 
                            max="24" 
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white text-gray-900"
                            placeholder="e.g., 8.5"
                        />
                        @error('hours_worked') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="entry_type" class="block text-sm font-medium text-gray-700">Entry Type</label>
                        <select 
                            id="entry_type" 
                            wire:model="entry_type"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white text-gray-900"
                        >
                            <option value="regular">Regular Hours</option>
                            <option value="overtime">Overtime</option>
                            <option value="vacation">Vacation</option>
                            <option value="sick_leave">Sick Leave</option>
                            <option value="holiday">Holiday</option>
                        </select>
                        @error('entry_type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="project_id" class="block text-sm font-medium text-gray-700">Project (Optional)</label>
                        <select 
                            id="project_id" 
                            wire:model="project_id"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white text-gray-900"
                        >
                            <option value="">Select a project</option>
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                            @endforeach
                        </select>
                        @error('project_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="task_id" class="block text-sm font-medium text-gray-700">Task (Optional)</label>
                        <select 
                            id="task_id" 
                            wire:model="task_id"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white text-gray-900"
                        >
                            <option value="">Select a task</option>
                            @foreach($tasks as $task)
                                <option value="{{ $task->id }}">{{ $task->title }}</option>
                            @endforeach
                        </select>
                        @error('task_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select 
                            id="status" 
                            wire:model="status"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white text-gray-900"
                        >
                            <option value="pending">Pending Approval</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                        </select>
                        @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="activity_description" class="block text-sm font-medium text-gray-700">Activity Description</label>
                        <textarea 
                            id="activity_description" 
                            wire:model="activity_description" 
                            rows="3" 
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white text-gray-900"
                            placeholder="Describe the work done..."
                        ></textarea>
                        @error('activity_description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="notes" class="block text-sm font-medium text-gray-700">Notes (Optional)</label>
                        <textarea 
                            id="notes" 
                            wire:model="notes" 
                            rows="2" 
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white text-gray-900"
                            placeholder="Add additional notes..."
                        ></textarea>
                        @error('notes') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mt-4">
                        <button 
                            wire:click="addTimesheet"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                        >
                            Add Timesheet Entry
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-6">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Timesheet Summary</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <div class="text-sm font-medium text-blue-700">Regular Hours</div>
                            <div class="mt-1 text-2xl font-semibold text-blue-900">{{ number_format($totalRegularHours, 2) }}</div>
                        </div>
                        <div class="bg-purple-50 p-4 rounded-lg">
                            <div class="text-sm font-medium text-purple-700">Overtime Hours</div>
                            <div class="mt-1 text-2xl font-semibold text-purple-900">{{ number_format($totalOvertimeHours, 2) }}</div>
                        </div>
                        <div class="bg-yellow-50 p-4 rounded-lg">
                            <div class="text-sm font-medium text-yellow-700">Leave Hours</div>
                            <div class="mt-1 text-2xl font-semibold text-yellow-900">{{ number_format($totalLeaveHours, 2) }}</div>
                        </div>
                        <div class="bg-green-50 p-4 rounded-lg">
                            <div class="text-sm font-medium text-green-700">Total Hours</div>
                            <div class="mt-1 text-2xl font-semibold text-green-900">{{ number_format($totalHours, 2) }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Timesheet Entries</h3>
                    <div class="flex space-x-2">
                        <input 
                            wire:model.live="search" 
                            type="text" 
                            placeholder="Search activities..." 
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white text-gray-900"
                        />
                    </div>
                </div>
                
                <div class="p-6">
                    <div class="flex flex-wrap gap-3 mb-4">
                        <select 
                            wire:model.live="entryTypeFilter" 
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white text-gray-900"
                        >
                            <option value="">All Entry Types</option>
                            <option value="regular">Regular</option>
                            <option value="overtime">Overtime</option>
                            <option value="vacation">Vacation</option>
                            <option value="sick_leave">Sick Leave</option>
                            <option value="holiday">Holiday</option>
                        </select>
                        
                        <select 
                            wire:model.live="statusFilter" 
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white text-gray-900"
                        >
                            <option value="">All Statuses</option>
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                        </select>
                        
                        <input 
                            wire:model.live="startDate" 
                            type="date" 
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white text-gray-900"
                        />
                        
                        <input 
                            wire:model.live="endDate" 
                            type="date" 
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white text-gray-900"
                        />
                    </div>
                    
                    @if($timesheets->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Date
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Hours
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Activity
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Project/Task
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($timesheets as $timesheet)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $timesheet->date->format('M j, Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $timesheet->hours_worked }} hrs
                                                <span class="text-xs text-gray-500 ml-1">({{ ucfirst(str_replace('_', ' ', $timesheet->entry_type)) }})</span>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm text-gray-900 max-w-xs truncate" title="{{ $timesheet->activity_description }}">
                                                    {{ $timesheet->activity_description }}
                                                </div>
                                                @if($timesheet->notes)
                                                    <div class="text-xs text-gray-500 mt-1" title="{{ $timesheet->notes }}">Notes: {{ Str::limit($timesheet->notes, 50) }}</div>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                @if($timesheet->project)
                                                    <span class="inline-flex items-center">
                                                        <span class="mr-1">💼</span>
                                                        {{ $timesheet->project->name }}
                                                    </span>
                                                @endif
                                                @if($timesheet->task)
                                                    <br>
                                                    <span class="inline-flex items-center">
                                                        <span class="mr-1">✅</span>
                                                        {{ $timesheet->task->title }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    {{ $timesheet->isApproved() ? 'bg-green-100 text-green-800' :
                                                       ($timesheet->isPending() ? 'bg-yellow-100 text-yellow-800' :
                                                          ($timesheet->isRejected() ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800')) }}">
                                                    {{ ucfirst(str_replace('_', ' ', $timesheet->status)) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <button 
                                                    wire:click="deleteTimesheet({{ $timesheet->id }})"
                                                    class="text-red-600 hover:text-red-900"
                                                >
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6 mt-4">
                            {{ $timesheets->links() }}
                        </div>
                    @else
                        <div class="text-center py-4 text-gray-500">
                            No timesheet entries found.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>