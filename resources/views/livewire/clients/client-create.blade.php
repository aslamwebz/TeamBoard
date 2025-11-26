<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-foreground">Create Client</h1>
            <p class="text-muted-foreground">Add a new client to your system</p>
        </div>
        <a href="{{ route('clients.index') }}"
            class="px-4 py-2 border border-zinc-200 rounded-lg text-zinc-700 hover:bg-zinc-50 dark:border-zinc-700 dark:text-zinc-300 dark:hover:bg-zinc-700">
            Cancel
        </a>
    </div>

    <!-- Client Form -->
    <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700">
        <form wire:submit="createClient" class="p-6">
            <div class="space-y-8">
                <!-- Company Information Section -->
                <div class="space-y-6">
                    <div class="flex items-center gap-2 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="h-5 w-5 text-zinc-500">
                            <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"></path>
                            <polyline points="9,22 9,12 15,12 15,22"></polyline>
                        </svg>
                        <h3 class="text-lg font-semibold text-foreground">Company Information</h3>
                    </div>

                    <div class="grid gap-6 lg:grid-cols-2">
                        <!-- Company Name -->
                        <div>
                            <label for="company_name" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                Company Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="company_name" wire:model="company_name" placeholder="Acme Corporation"
                                class="w-full px-3 py-2 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white @error('company_name') border-red-500 @enderror">
                            @error('company_name')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Contact Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                Contact Name
                            </label>
                            <input type="text" id="name" wire:model="name" placeholder="John Doe"
                                class="w-full px-3 py-2 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white @error('name') border-red-500 @enderror">
                            @error('name')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input type="email" id="email" wire:model="email" placeholder="john@company.com"
                                class="w-full px-3 py-2 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white @error('email') border-red-500 @enderror">
                            @error('email')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                Phone
                            </label>
                            <input type="text" id="phone" wire:model="phone" placeholder="+1 (555) 123-4567"
                                class="w-full px-3 py-2 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white @error('phone') border-red-500 @enderror">
                            @error('phone')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Industry -->
                        <div>
                            <label for="industry" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                Industry
                            </label>
                            <input type="text" id="industry" wire:model="industry" placeholder="Technology"
                                class="w-full px-3 py-2 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white @error('industry') border-red-500 @enderror">
                            @error('industry')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Website -->
                        <div>
                            <label for="website" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                Website
                            </label>
                            <input type="url" id="website" wire:model="website" placeholder="https://acmecorp.com"
                                class="w-full px-3 py-2 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white @error('website') border-red-500 @enderror">
                            @error('website')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Registration Number -->
                        <div>
                            <label for="registration_number" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                Registration Number
                            </label>
                            <input type="text" id="registration_number" wire:model="registration_number" placeholder="AB12345678"
                                class="w-full px-3 py-2 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white @error('registration_number') border-red-500 @enderror">
                            @error('registration_number')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tax ID -->
                        <div>
                            <label for="tax_id" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                Tax ID
                            </label>
                            <input type="text" id="tax_id" wire:model="tax_id" placeholder="12-3456789"
                                class="w-full px-3 py-2 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white @error('tax_id') border-red-500 @enderror">
                            @error('tax_id')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- VAT Number -->
                        <div>
                            <label for="vat_number" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                VAT Number
                            </label>
                            <input type="text" id="vat_number" wire:model="vat_number" placeholder="FR12345678901"
                                class="w-full px-3 py-2 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white @error('vat_number') border-red-500 @enderror">
                            @error('vat_number')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Billing Plan -->
                        <div>
                            <label for="billing_plan" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                Billing Plan
                            </label>
                            <input type="text" id="billing_plan" wire:model="billing_plan" placeholder="Premium"
                                class="w-full px-3 py-2 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white @error('billing_plan') border-red-500 @enderror">
                            @error('billing_plan')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                            Description
                        </label>
                        <textarea id="description" wire:model="description" rows="3" placeholder="Brief description of the company..."
                            class="w-full px-3 py-2 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white @error('description') border-red-500 @enderror"></textarea>
                        @error('description')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Business Address Section -->
                <div class="space-y-6">
                    <div class="flex items-center gap-2 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="h-5 w-5 text-zinc-500">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                        <h3 class="text-lg font-semibold text-foreground">Business Address</h3>
                    </div>

                    <div class="grid gap-6 lg:grid-cols-2">
                        <!-- Address -->
                        <div class="lg:col-span-2">
                            <label for="address" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                Address
                            </label>
                            <textarea id="address" wire:model="address" rows="3" placeholder="123 Main Street, Suite 100"
                                class="w-full px-3 py-2 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white @error('address') border-red-500 @enderror"></textarea>
                            @error('address')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- City -->
                        <div>
                            <label for="city" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                City
                            </label>
                            <input type="text" id="city" wire:model="city" placeholder="New York"
                                class="w-full px-3 py-2 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white @error('city') border-red-500 @enderror">
                            @error('city')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- State -->
                        <div>
                            <label for="state" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                State/Province
                            </label>
                            <input type="text" id="state" wire:model="state" placeholder="NY"
                                class="w-full px-3 py-2 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white @error('state') border-red-500 @enderror">
                            @error('state')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- ZIP Code -->
                        <div>
                            <label for="zip_code" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                ZIP/Postal Code
                            </label>
                            <input type="text" id="zip_code" wire:model="zip_code" placeholder="10001"
                                class="w-full px-3 py-2 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white @error('zip_code') border-red-500 @enderror">
                            @error('zip_code')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Country -->
                        <div>
                            <label for="country" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                Country
                            </label>
                            <input type="text" id="country" wire:model="country" placeholder="United States"
                                class="w-full px-3 py-2 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white @error('country') border-red-500 @enderror">
                            @error('country')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Subscription Information Section -->
                <div class="space-y-6">
                    <div class="flex items-center gap-2 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="h-5 w-5 text-zinc-500">
                            <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                            <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                        </svg>
                        <h3 class="text-lg font-semibold text-foreground">Subscription Information</h3>
                    </div>

                    <div class="grid gap-6 lg:grid-cols-2">
                        <!-- Billing Plan -->
                        <div>
                            <label for="billing_plan" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                Billing Plan
                            </label>
                            <input type="text" id="billing_plan" wire:model="billing_plan" placeholder="Premium"
                                class="w-full px-3 py-2 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white @error('billing_plan') border-red-500 @enderror">
                            @error('billing_plan')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Subscription Status -->
                        <div>
                            <label for="subscription_status" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                Subscription Status
                            </label>
                            <select id="subscription_status" wire:model="subscription_status"
                                class="w-full px-3 py-2 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white @error('subscription_status') border-red-500 @enderror">
                                <option value="">Select Status</option>
                                <option value="active">Active</option>
                                <option value="trial">Trial</option>
                                <option value="suspended">Suspended</option>
                                <option value="cancelled">Cancelled</option>
                                <option value="expired">Expired</option>
                            </select>
                            @error('subscription_status')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Subscription Start Date -->
                        <div>
                            <label for="subscription_start_date" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                Start Date
                            </label>
                            <input type="date" id="subscription_start_date" wire:model="subscription_start_date"
                                class="w-full px-3 py-2 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white @error('subscription_start_date') border-red-500 @enderror">
                            @error('subscription_start_date')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Subscription End Date -->
                        <div>
                            <label for="subscription_end_date" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                End Date
                            </label>
                            <input type="date" id="subscription_end_date" wire:model="subscription_end_date"
                                class="w-full px-3 py-2 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white @error('subscription_end_date') border-red-500 @enderror">
                            @error('subscription_end_date')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end gap-3 pt-6 border-t border-zinc-200 dark:border-zinc-700">
                <a href="{{ route('clients.index') }}"
                    class="px-4 py-2 border border-zinc-300 rounded-lg text-zinc-700 hover:bg-zinc-50 dark:border-zinc-600 dark:text-zinc-300 dark:hover:bg-zinc-700">
                    Cancel
                </a>
                <button type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                    Create Client
                </button>
            </div>
        </form>
    </div>
</div>
