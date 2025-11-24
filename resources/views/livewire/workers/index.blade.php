<div>
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Workers</h2>
        <p class="text-gray-600">Manage your workforce and employee profiles</p>
    </div>

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <div class="flex flex-wrap gap-3">
            <div>
                <input 
                    wire:model.live="search" 
                    type="text" 
                    placeholder="Search workers..." 
                    class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white text-gray-900"
                />
            </div>
            
            <select 
                wire:model.live="status" 
                class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white text-gray-900"
            >
                <option value="">All Statuses</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
                <option value="on_leave">On Leave</option>
                <option value="terminated">Terminated</option>
            </select>
            
            <select 
                wire:model.live="department" 
                class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white text-gray-900"
            >
                <option value="">All Departments</option>
                @foreach($departments as $dept)
                    <option value="{{ $dept }}">{{ $dept }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Worker
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Job Title
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Department
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Rate
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
                    @forelse($workers as $worker)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                            <span class="text-gray-600 font-medium">{{ $worker->user->initials() }}</span>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $worker->user->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $worker->user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $worker->job_title ?: 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $worker->department ?: 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $worker->hourly_rate ? '$' . number_format($worker->hourly_rate, 2) . '/hr' : 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $worker->status === 'active' ? 'bg-green-100 text-green-800' :
                                       ($worker->status === 'inactive' ? 'bg-gray-100 text-gray-800' :
                                          ($worker->status === 'on_leave' ? 'bg-yellow-100 text-yellow-800' :
                                             ($worker->status === 'terminated' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800'))) }}">
                                    {{ ucfirst(str_replace('_', ' ', $worker->status)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('workers.show', $worker->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">View</a>
                                <a href="{{ route('workers.edit', $worker->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                                No workers found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
            {{ $workers->links() }}
        </div>
    </div>
</div>