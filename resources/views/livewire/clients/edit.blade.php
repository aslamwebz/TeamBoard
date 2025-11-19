<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-foreground">Edit Client</h1>
            <p class="text-muted-foreground">Update client information and contact details</p>
        </div>
        <a href="{{ route('clients.show', $client) }}"
            class="px-4 py-2 border border-zinc-200 rounded-lg text-zinc-700 hover:bg-zinc-50 dark:border-zinc-700 dark:text-zinc-300 dark:hover:bg-zinc-700">View
            Client</a>
    </div>

    <div class="grid gap-6 lg:grid-cols-3">
        <!-- Main Form -->
        <div class="lg:col-span-2">
            <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700">
                <form wire:submit="updateClient" class="p-6 space-y-6">
                    <!-- Basic Information -->
                    <div>
                        <h3 class="text-base font-semibold text-foreground mb-4 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="h-5 w-5 text-blue-600">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            Basic Information
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <flux:field label="Contact Name *" for="name">
                                    <input type="text" id="name" wire:model="name"
                                        placeholder="Enter contact name"
                                        class="w-full px-4 py-2 border border-zinc-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300"
                                        required>
                                    @error('name')
                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </flux:field>
                            </div>

                            <div>
                                <flux:field label="Company Name" for="company_name">
                                    <input type="text" id="company_name" wire:model="company_name"
                                        placeholder="Enter company name"
                                        class="w-full px-4 py-2 border border-zinc-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300">
                                    @error('company_name')
                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </flux:field>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div>
                        <h3 class="text-base font-semibold text-foreground mb-4 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="h-5 w-5 text-green-600">
                                <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                                <path d="m22 7-10 5L2 7"></path>
                            </svg>
                            Contact Information
                        </h3>
                        <div class="space-y-4">
                            <div>
                                <flux:field label="Email *" for="email">
                                    <input type="email" id="email" wire:model="email"
                                        placeholder="contact@company.com"
                                        class="w-full px-4 py-2 border border-zinc-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300"
                                        required>
                                    @error('email')
                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </flux:field>
                            </div>

                            <div>
                                <flux:field label="Phone" for="phone">
                                    <input type="tel" id="phone" wire:model="phone"
                                        placeholder="+1 (555) 123-4567"
                                        class="w-full px-4 py-2 border border-zinc-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300">
                                    @error('phone')
                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </flux:field>
                            </div>
                        </div>
                    </div>

                    <!-- Address Information -->
                    <div>
                        <h3 class="text-base font-semibold text-foreground mb-4 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="h-5 w-5 text-purple-600">
                                <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                            Address Information
                        </h3>
                        <div class="space-y-4">
                            <div>
                                <flux:field label="Street Address" for="address">
                                    <textarea id="address" wire:model="address" rows="2" placeholder="123 Main Street"
                                        class="w-full px-4 py-2 border border-zinc-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300"></textarea>
                                    @error('address')
                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </flux:field>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <flux:field label="City" for="city">
                                        <input type="text" id="city" wire:model="city" placeholder="New York"
                                            class="w-full px-4 py-2 border border-zinc-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300">
                                        @error('city')
                                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                        @enderror
                                    </flux:field>
                                </div>

                                <div>
                                    <flux:field label="State/Province" for="state">
                                        <input type="text" id="state" wire:model="state" placeholder="NY"
                                            class="w-full px-4 py-2 border border-zinc-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300">
                                        @error('state')
                                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                        @enderror
                                    </flux:field>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <flux:field label="ZIP/Postal Code" for="zip_code">
                                        <input type="text" id="zip_code" wire:model="zip_code"
                                            placeholder="10001"
                                            class="w-full px-4 py-2 border border-zinc-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300">
                                        @error('zip_code')
                                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                        @enderror
                                    </flux:field>
                                </div>

                                <div>
                                    <flux:field label="Country" for="country">
                                        <input type="text" id="country" wire:model="country"
                                            placeholder="United States"
                                            class="w-full px-4 py-2 border border-zinc-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300">
                                        @error('country')
                                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                        @enderror
                                    </flux:field>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Business Information -->
                    <div>
                        <h3 class="text-base font-semibold text-foreground mb-4 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-orange-600">
                                <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                            </svg>
                            Business Information
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <flux:field label="Industry" for="industry">
                                    <input type="text" id="industry" wire:model="industry"
                                        placeholder="Technology"
                                        class="w-full px-4 py-2 border border-zinc-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300">
                                    @error('industry')
                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </flux:field>
                            </div>

                            <div>
                                <flux:field label="Website" for="website">
                                    <input type="url" id="website" wire:model="website"
                                        placeholder="https://company.com"
                                        class="w-full px-4 py-2 border border-zinc-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300">
                                    @error('website')
                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </flux:field>
                            </div>

                            <div>
                                <flux:field label="Registration Number" for="registration_number">
                                    <input type="text" id="registration_number" wire:model="registration_number"
                                        placeholder="AB12345678"
                                        class="w-full px-4 py-2 border border-zinc-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300">
                                    @error('registration_number')
                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </flux:field>
                            </div>

                            <div>
                                <flux:field label="Tax ID" for="tax_id">
                                    <input type="text" id="tax_id" wire:model="tax_id"
                                        placeholder="12-3456789"
                                        class="w-full px-4 py-2 border border-zinc-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300">
                                    @error('tax_id')
                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </flux:field>
                            </div>

                            <div>
                                <flux:field label="VAT Number" for="vat_number">
                                    <input type="text" id="vat_number" wire:model="vat_number"
                                        placeholder="US123456789"
                                        class="w-full px-4 py-2 border border-zinc-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300">
                                    @error('vat_number')
                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </flux:field>
                            </div>

                            <div>
                                <flux:field label="Billing Plan" for="billing_plan">
                                    <input type="text" id="billing_plan" wire:model="billing_plan"
                                        placeholder="Premium"
                                        class="w-full px-4 py-2 border border-zinc-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300">
                                    @error('billing_plan')
                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </flux:field>
                            </div>
                        </div>

                        <div class="mt-4">
                            <flux:field label="Description" for="description">
                                <textarea id="description" wire:model="description" rows="3"
                                    placeholder="Brief description of the company..."
                                    class="w-full px-4 py-2 border border-zinc-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300"></textarea>
                                @error('description')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror>
                            </flux:field>
                        </div>
                    </div>

                    <!-- Subscription Information -->
                    <div>
                        <h3 class="text-base font-semibold text-foreground mb-4 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="h-5 w-5 text-blue-600">
                                <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                                <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                            </svg>
                            Subscription Information
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <flux:field label="Status" for="subscription_status">
                                    <select id="subscription_status" wire:model="subscription_status"
                                        class="w-full px-4 py-2 border border-zinc-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300">
                                        <option value="">Select Status</option>
                                        <option value="active">Active</option>
                                        <option value="trial">Trial</option>
                                        <option value="suspended">Suspended</option>
                                        <option value="cancelled">Cancelled</option>
                                        <option value="expired">Expired</option>
                                    </select>
                                    @error('subscription_status')
                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </flux:field>
                            </div>

                            <div>
                                <flux:field label="Start Date" for="subscription_start_date">
                                    <input type="date" id="subscription_start_date" wire:model="subscription_start_date"
                                        class="w-full px-4 py-2 border border-zinc-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300">
                                    @error('subscription_start_date')
                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </flux:field>
                            </div>

                            <div>
                                <flux:field label="End Date" for="subscription_end_date">
                                    <input type="date" id="subscription_end_date" wire:model="subscription_end_date"
                                        class="w-full px-4 py-2 border border-zinc-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300">
                                    @error('subscription_end_date')
                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </flux:field>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex justify-end gap-3 pt-4 border-t border-zinc-200 dark:border-zinc-700">
                        <a href="{{ route('clients.index') }}"
                            class="px-6 py-2 border border-zinc-200 rounded-lg text-zinc-700 hover:bg-zinc-50 dark:border-zinc-700 dark:text-zinc-300 dark:hover:bg-zinc-700 transition-colors">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                                <polyline points="17 21 17 13 7 13 7 21"></polyline>
                                <polyline points="7 3 7 8 15 8"></polyline>
                            </svg>
                            Update Client
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
                <h3 class="text-base font-semibold text-foreground mb-4">Quick Actions</h3>
                <div class="space-y-3">
                    <a href="{{ route('clients.show', $client) }}"
                        class="block w-full px-4 py-2 text-center border border-zinc-200 rounded-lg text-zinc-700 hover:bg-zinc-50 dark:border-zinc-700 dark:text-zinc-300 dark:hover:bg-zinc-700 transition-colors">
                        View Client Details
                    </a>
                    <a href="{{ route('clients.index') }}"
                        class="block w-full px-4 py-2 text-center border border-zinc-200 rounded-lg text-zinc-700 hover:bg-zinc-50 dark:border-zinc-700 dark:text-zinc-300 dark:hover:bg-zinc-700 transition-colors">
                        Back to Clients
                    </a>
                </div>
            </div>

            @if ($client->projects()->count() > 0)
                <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6 mt-6">
                    <h3 class="text-base font-semibold text-foreground mb-4">Client Statistics</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-sm text-zinc-500 dark:text-zinc-400">Total Projects</span>
                            <span
                                class="text-sm font-medium text-foreground">{{ $client->projects()->count() }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-zinc-500 dark:text-zinc-400">Active Projects</span>
                            <span
                                class="text-sm font-medium text-foreground">{{ $client->projects()->whereIn('status', ['planning', 'in_progress'])->count() }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-zinc-500 dark:text-zinc-400">Total Tasks</span>
                            <span
                                class="text-sm font-medium text-foreground">{{ $client->projects()->withCount('tasks')->get()->sum('tasks_count') }}</span>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
