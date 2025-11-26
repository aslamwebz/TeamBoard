<div>
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">{{ $workerProfile->user->name }}</h2>
            <p class="text-gray-600">Employee Profile and Workforce Management</p>
        </div>
        <div class="flex space-x-3">
            <a 
                href="{{ route('workers.edit', $workerProfile->id) }}" 
                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
            >
                Edit Profile
            </a>
            <a 
                href="{{ route('workers') }}" 
                class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
            >
                Back to Workers
            </a>
        </div>
    </div>

    <!-- Worker Summary -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-6">
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Worker Information</h3>
        </div>
        <div class="px-4 py-5 sm:p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <div class="flex items-center">
                        <div class="text-sm font-medium text-gray-500">Employee ID</div>
                        <div class="ml-2 text-sm text-gray-900">{{ $workerProfile->employee_id ?: 'N/A' }}</div>
                    </div>
                    
                    <div class="mt-2 flex items-center">
                        <div class="text-sm font-medium text-gray-500">Job Title</div>
                        <div class="ml-2 text-sm text-gray-900">{{ $workerProfile->job_title ?: 'N/A' }}</div>
                    </div>
                    
                    <div class="mt-2 flex items-center">
                        <div class="text-sm font-medium text-gray-500">Department</div>
                        <div class="ml-2 text-sm text-gray-900">{{ $workerProfile->department ?: 'N/A' }}</div>
                    </div>
                    
                    <div class="mt-2 flex items-center">
                        <div class="text-sm font-medium text-gray-500">Email</div>
                        <div class="ml-2 text-sm text-gray-900">{{ $workerProfile->user->email }}</div>
                    </div>
                    
                    <div class="mt-2 flex items-center">
                        <div class="text-sm font-medium text-gray-500">Phone</div>
                        <div class="ml-2 text-sm text-gray-900">{{ $workerProfile->phone ?: 'N/A' }}</div>
                    </div>
                </div>
                
                <div>
                    <div class="flex items-center">
                        <div class="text-sm font-medium text-gray-500">Status</div>
                        <div class="ml-2 text-sm">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $workerProfile->status === 'active' ? 'bg-green-100 text-green-800' :
                                   ($workerProfile->status === 'inactive' ? 'bg-gray-100 text-gray-800' :
                                      ($workerProfile->status === 'on_leave' ? 'bg-yellow-100 text-yellow-800' :
                                         ($workerProfile->status === 'terminated' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800'))) }}">
                                {{ ucfirst(str_replace('_', ' ', $workerProfile->status)) }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="mt-2 flex items-center">
                        <div class="text-sm font-medium text-gray-500">Employment Type</div>
                        <div class="ml-2 text-sm text-gray-900">{{ $workerProfile->employment_type ? ucfirst(str_replace('_', ' ', $workerProfile->employment_type)) : 'N/A' }}</div>
                    </div>
                    
                    <div class="mt-2 flex items-center">
                        <div class="text-sm font-medium text-gray-500">Hourly Rate</div>
                        <div class="ml-2 text-sm text-gray-900">{{ $workerProfile->hourly_rate ? '$' . number_format($workerProfile->hourly_rate, 2) . '/hr' : 'N/A' }}</div>
                    </div>
                    
                    <div class="mt-2 flex items-center">
                        <div class="text-sm font-medium text-gray-500">Hire Date</div>
                        <div class="ml-2 text-sm text-gray-900">{{ $workerProfile->hire_date ? $workerProfile->hire_date->format('M j, Y') : 'N/A' }}</div>
                    </div>
                    
                    <div class="mt-2 flex items-center">
                        <div class="text-sm font-medium text-gray-500">Manager</div>
                        <div class="ml-2 text-sm text-gray-900">{{ $workerProfile->manager_id ? $workerProfile->manager_id : 'N/A' }}</div>
                    </div>
                </div>
            </div>
            
            @if($workerProfile->bio)
                <div class="mt-4">
                    <div class="text-sm font-medium text-gray-500">Bio</div>
                    <div class="mt-1 text-sm text-gray-900">{{ $workerProfile->bio }}</div>
                </div>
            @endif
            
            @if($workerProfile->address || $workerProfile->city || $workerProfile->state || $workerProfile->zip_code)
                <div class="mt-4">
                    <div class="text-sm font-medium text-gray-500">Address</div>
                    <div class="mt-1 text-sm text-gray-900">
                        {{ $workerProfile->address ?? 'N/A' }}<br>
                        @if($workerProfile->city || $workerProfile->state || $workerProfile->zip_code)
                            {{ $workerProfile->city ?? '' }}{{ $workerProfile->city ? ', ' : '' }}{{ $workerProfile->state ?? '' }} {{ $workerProfile->zip_code ?? '' }}<br>
                        @endif
                        {{ $workerProfile->country ?? 'N/A' }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Tabs for related data -->
    <div class="bg-white shadow sm:rounded-lg">
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8 px-6">
                <a 
                    href="{{ route('worker.skills', $workerProfile->id) }}"
                    class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm"
                >
                    Skills ({{ $workerProfile->skills->count() }})
                </a>
                
                <a 
                    href="{{ route('worker.certifications', $workerProfile->id) }}"
                    class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm"
                >
                    Certifications ({{ $workerProfile->certifications->count() }})
                </a>
                
                <a 
                    href="{{ route('worker.timesheets', $workerProfile->id) }}"
                    class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm"
                >
                    Timesheets ({{ $workerProfile->timesheets->count() }})
                </a>
            </nav>
        </div>
        
        <div class="p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Skills</h3>
            @if($workerProfile->skills->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Skill
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Category
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Proficiency
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Notes
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($workerProfile->skills as $skill)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $skill->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $skill->description ?: 'No description' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $skill->category ?: 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <span class="text-sm font-medium text-gray-900">{{ $skill->pivot->proficiency_level }}/5</span>
                                            <div class="ml-1 flex">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= $skill->pivot->proficiency_level)
                                                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                    @else
                                                        <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                    @endif
                                                @endfor
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ $skill->pivot->notes ?: 'N/A' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-4 text-gray-500">
                    No skills found for this worker.
                </div>
            @endif

            <h3 class="text-lg font-medium text-gray-900 mt-8 mb-4">Certifications</h3>
            @if($workerProfile->certifications->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Certification
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Organization
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Dates
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($workerProfile->certifications->take(5) as $certification)
                                <tr>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $certification->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $certification->license_number ?: 'N/A' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $certification->issuing_organization ?: 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div class="text-gray-900">{{ $certification->pivot->date_obtained->format('M j, Y') }}</div>
                                        @if($certification->pivot->expiry_date)
                                            <div class="text-gray-500">Expires: {{ $certification->pivot->expiry_date->format('M j, Y') }}</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $certification->pivot->status === 'active' ? 'bg-green-100 text-green-800' :
                                               ($certification->pivot->status === 'expired' ? 'bg-red-100 text-red-800' :
                                                  ($certification->pivot->status === 'suspended' ? 'bg-yellow-100 text-yellow-800' :
                                                     ($certification->pivot->status === 'pending_verification' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800'))) }}">
                                            {{ ucfirst(str_replace('_', ' ', $certification->pivot->status)) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-4 text-gray-500">
                    No certifications found for this worker.
                </div>
            @endif

            <h3 class="text-lg font-medium text-gray-900 mt-8 mb-4">Recent Timesheet Entries</h3>
            @if($workerProfile->timesheets->count() > 0)
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
                                    Project/Task
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($workerProfile->timesheets->take(5) as $timesheet)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $timesheet->date->format('M j, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $timesheet->hours_worked }} hrs
                                        <span class="text-xs text-gray-500">({{ ucfirst(str_replace('_', ' ', $timesheet->entry_type)) }})</span>
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-4 text-gray-500">
                    No timesheet entries found for this worker.
                </div>
            @endif
        </div>
    </div>
</div>