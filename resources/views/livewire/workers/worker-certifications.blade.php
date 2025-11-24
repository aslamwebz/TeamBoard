<div>
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Worker Certifications</h2>
            <p class="text-gray-600">Manage certifications for {{ $worker->user->name }}</p>
        </div>
        <a 
            href="{{ route('workers.show', $workerId) }}" 
            class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
        >
            Back to Worker
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Add Certification</h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div>
                        <label for="certification_id" class="block text-sm font-medium text-gray-700">Certification</label>
                        <select 
                            id="certification_id" 
                            wire:model="certification_id"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white text-gray-900"
                        >
                            <option value="">Select a certification</option>
                            @foreach($allCertifications as $cert)
                                <option value="{{ $cert->id }}">{{ $cert->name }} ({{ $cert->issuing_organization }})</option>
                            @endforeach
                        </select>
                        @error('certification_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="date_obtained" class="block text-sm font-medium text-gray-700">Date Obtained</label>
                            <input 
                                type="date" 
                                id="date_obtained" 
                                wire:model="date_obtained" 
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white text-gray-900"
                            />
                            @error('date_obtained') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="expiry_date" class="block text-sm font-medium text-gray-700">Expiry Date (Optional)</label>
                            <input 
                                type="date" 
                                id="expiry_date" 
                                wire:model="expiry_date" 
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white text-gray-900"
                            />
                            @error('expiry_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label for="attachment" class="block text-sm font-medium text-gray-700">Certification Document (Optional)</label>
                        <input 
                            type="file" 
                            id="attachment" 
                            wire:model="attachment"
                            accept=".pdf,.jpg,.jpeg,.png"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        />
                        @error('attachment') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        @if($attachment)
                            <span class="text-sm text-gray-500">File selected: {{ $attachment->getClientOriginalName() }}</span>
                        @endif
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select 
                            id="status" 
                            wire:model="status"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white text-gray-900"
                        >
                            <option value="active">Active</option>
                            <option value="expired">Expired</option>
                            <option value="suspended">Suspended</option>
                            <option value="pending_verification">Pending Verification</option>
                        </select>
                        @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                        <textarea 
                            id="notes" 
                            wire:model="notes" 
                            rows="3" 
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white text-gray-900"
                            placeholder="Add notes about this certification..."
                        ></textarea>
                        @error('notes') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mt-4">
                        <button 
                            wire:click="addCertification"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                        >
                            Add Certification
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Current Certifications</h3>
            </div>
            @if($worker->certifications->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Certification
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Dates
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
                            @foreach($worker->certifications as $cert)
                                <tr>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $cert->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $cert->issuing_organization }}</div>
                                        @if($cert->license_number)
                                            <div class="text-sm text-gray-500">License: {{ $cert->license_number }}</div>
                                        @endif
                                        @if($cert->pivot->notes)
                                            <div class="text-sm text-gray-500 mt-1">{{ $cert->pivot->notes }}</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div class="text-gray-900">{{ $cert->pivot->date_obtained->format('M j, Y') }}</div>
                                        @if($cert->pivot->expiry_date)
                                            <div class="text-gray-500">Expires: {{ $cert->pivot->expiry_date->format('M j, Y') }}</div>
                                        @else
                                            <div class="text-gray-500">No expiry</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $cert->pivot->status === 'active' ? 'bg-green-100 text-green-800' :
                                               ($cert->pivot->status === 'expired' ? 'bg-red-100 text-red-800' :
                                                  ($cert->pivot->status === 'suspended' ? 'bg-yellow-100 text-yellow-800' :
                                                     ($cert->pivot->status === 'pending_verification' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800'))) }}">
                                            {{ ucfirst(str_replace('_', ' ', $cert->pivot->status)) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        @if($cert->pivot->attachment_path)
                                            <a href="{{ Storage::url($cert->pivot->attachment_path) }}" target="_blank" class="text-indigo-600 hover:text-indigo-900 mr-3">View</a>
                                        @endif
                                        <button 
                                            wire:click="removeCertification({{ $cert->id }})"
                                            class="text-red-600 hover:text-red-900"
                                        >
                                            Remove
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-6 text-center text-gray-500">
                    No certifications assigned yet.
                </div>
            @endif
        </div>
    </div>
</div>