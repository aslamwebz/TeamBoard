<div>
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Edit Worker Profile</h2>
        <p class="text-gray-600">Update employee information and HR details</p>
    </div>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <form wire:submit="update" class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="user_id" class="block text-sm font-medium text-gray-700">User *</label>
                    <select 
                        id="user_id" 
                        wire:model="user_id" 
                        disabled
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-gray-100 text-gray-700"
                    >
                        <option value="{{ $workerProfile->user_id }}">{{ $workerProfile->user->name }} ({{ $workerProfile->user->email }})</option>
                    </select>
                    @error('user_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="employee_id" class="block text-sm font-medium text-gray-700">Employee ID</label>
                    <input 
                        type="text" 
                        id="employee_id" 
                        wire:model="employee_id" 
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white text-gray-900"
                        placeholder="e.g., EMP001"
                    />
                    @error('employee_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="job_title" class="block text-sm font-medium text-gray-700">Job Title</label>
                    <input 
                        type="text" 
                        id="job_title" 
                        wire:model="job_title" 
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white text-gray-900"
                        placeholder="e.g., Software Engineer"
                    />
                    @error('job_title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="department" class="block text-sm font-medium text-gray-700">Department</label>
                    <input 
                        type="text" 
                        id="department" 
                        wire:model="department" 
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white text-gray-900"
                        placeholder="e.g., Engineering"
                    />
                    @error('department') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="hourly_rate" class="block text-sm font-medium text-gray-700">Hourly Rate ($)</label>
                    <input 
                        type="number" 
                        id="hourly_rate" 
                        wire:model="hourly_rate" 
                        step="0.01" 
                        min="0" 
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white text-gray-900"
                        placeholder="0.00"
                    />
                    @error('hourly_rate') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="employment_type" class="block text-sm font-medium text-gray-700">Employment Type</label>
                    <select 
                        id="employment_type" 
                        wire:model="employment_type" 
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white text-gray-900"
                    >
                        <option value="">Select employment type</option>
                        <option value="full_time">Full Time</option>
                        <option value="part_time">Part Time</option>
                        <option value="contract">Contract</option>
                        <option value="freelance">Freelance</option>
                        <option value="intern">Intern</option>
                    </select>
                    @error('employment_type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select 
                        id="status" 
                        wire:model="status" 
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white text-gray-900"
                    >
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="on_leave">On Leave</option>
                        <option value="terminated">Terminated</option>
                    </select>
                    @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="hire_date" class="block text-sm font-medium text-gray-700">Hire Date</label>
                    <input 
                        type="date" 
                        id="hire_date" 
                        wire:model="hire_date" 
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white text-gray-900"
                    />
                    @error('hire_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="manager_id" class="block text-sm font-medium text-gray-700">Manager ID</label>
                    <input 
                        type="text" 
                        id="manager_id" 
                        wire:model="manager_id" 
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white text-gray-900"
                        placeholder="e.g., EMP002"
                    />
                    @error('manager_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="bio" class="block text-sm font-medium text-gray-700">Bio/Description</label>
                    <textarea 
                        id="bio" 
                        wire:model="bio" 
                        rows="4" 
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white text-gray-900"
                        placeholder="Enter a brief bio or description of the worker"
                    ></textarea>
                    @error('bio') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                    <input 
                        type="text" 
                        id="address" 
                        wire:model="address" 
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white text-gray-900"
                        placeholder="Street address"
                    />
                    @error('address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                        <input 
                            type="text" 
                            id="city" 
                            wire:model="city" 
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white text-gray-900"
                        />
                        @error('city') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="state" class="block text-sm font-medium text-gray-700">State/Province</label>
                        <input 
                            type="text" 
                            id="state" 
                            wire:model="state" 
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white text-gray-900"
                        />
                        @error('state') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="zip_code" class="block text-sm font-medium text-gray-700">ZIP/Postal Code</label>
                        <input 
                            type="text" 
                            id="zip_code" 
                            wire:model="zip_code" 
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white text-gray-900"
                        />
                        @error('zip_code') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div>
                    <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                    <input 
                        type="text" 
                        id="country" 
                        wire:model="country" 
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white text-gray-900"
                    />
                    @error('country') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                    <input 
                        type="text" 
                        id="phone" 
                        wire:model="phone" 
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white text-gray-900"
                        placeholder="e.g., +1-234-567-8900"
                    />
                    @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="md:col-span-2">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Emergency Contact</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="emergency_contact" class="block text-sm font-medium text-gray-700">Emergency Contact Name</label>
                            <input 
                                type="text" 
                                id="emergency_contact" 
                                wire:model="emergency_contact" 
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white text-gray-900"
                                placeholder="e.g., Jane Doe"
                            />
                            @error('emergency_contact') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="emergency_contact_phone" class="block text-sm font-medium text-gray-700">Emergency Contact Phone</label>
                            <input 
                                type="text" 
                                id="emergency_contact_phone" 
                                wire:model="emergency_contact_phone" 
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white text-gray-900"
                                placeholder="e.g., +1-234-567-8900"
                            />
                            @error('emergency_contact_phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="md:col-span-2">
                    <label for="availability" class="block text-sm font-medium text-gray-700">Availability (JSON Format)</label>
                    <textarea 
                        id="availability" 
                        wire:model="availability" 
                        rows="3" 
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white text-gray-900 font-mono text-sm"
                        placeholder='e.g., {"monday": "9:00-17:00", "tuesday": "9:00-17:00", ...}'
                    ></textarea>
                    <p class="mt-1 text-sm text-gray-500">Define working hours per day in JSON format</p>
                    @error('availability') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-3">
                <a href="{{ route('workers.show', $workerProfile->id) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Cancel
                </a>
                <button 
                    type="submit" 
                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                >
                    Update Worker Profile
                </button>
            </div>
        </form>
    </div>
</div>