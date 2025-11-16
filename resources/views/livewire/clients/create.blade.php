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
            <div class="grid gap-8 lg:grid-cols-2">
                <!-- Left Column - Personal Information -->
                <div class="space-y-6">
                    <div class="flex items-center gap-2 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="h-5 w-5 text-zinc-500">
                            <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <h3 class="text-lg font-semibold text-foreground">Personal Information</h3>
                    </div>

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                            Name <span class="text-red-500">*</span>
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
                        <input type="email" id="email" wire:model="email" placeholder="john@example.com"
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

                    <!-- Company Name -->
                    <div>
                        <label for="company_name"
                            class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                            Company Name
                        </label>
                        <input type="text" id="company_name" wire:model="company_name" placeholder="Acme Corporation"
                            class="w-full px-3 py-2 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white @error('company_name') border-red-500 @enderror">
                        @error('company_name')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Right Column - Business Information -->
                <div class="space-y-6">
                    <div class="flex items-center gap-2 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="h-5 w-5 text-zinc-500">
                            <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"></path>
                            <polyline points="9,22 9,12 15,12 15,22"></polyline>
                        </svg>
                        <h3 class="text-lg font-semibold text-foreground">Business Information</h3>
                    </div>

                    <!-- Address -->
                    <div>
                        <label for="address" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                            Address
                        </label>
                        <textarea id="address" wire:model="address" rows="3" placeholder="123 Main Street"
                            class="w-full px-3 py-2 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white @error('address') border-red-500 @enderror"></textarea>
                        @error('address')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- City and State -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="city"
                                class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                City
                            </label>
                            <input type="text" id="city" wire:model="city" placeholder="New York"
                                class="w-full px-3 py-2 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white @error('city') border-red-500 @enderror">
                            @error('city')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="state"
                                class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                State
                            </label>
                            <input type="text" id="state" wire:model="state" placeholder="NY"
                                class="w-full px-3 py-2 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white @error('state') border-red-500 @enderror">
                            @error('state')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- ZIP Code and Country -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="zip_code"
                                class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                ZIP Code
                            </label>
                            <input type="text" id="zip_code" wire:model="zip_code" placeholder="10001"
                                class="w-full px-3 py-2 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white @error('zip_code') border-red-500 @enderror">
                            @error('zip_code')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="country"
                                class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                Country
                            </label>
                            <input type="text" id="country" wire:model="country" placeholder="United States"
                                class="w-full px-3 py-2 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white @error('country') border-red-500 @enderror">
                            @error('country')
                                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- VAT Number -->
                    <div>
                        <label for="vat_number"
                            class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                            VAT Number
                        </label>
                        <input type="text" id="vat_number" wire:model="vat_number" placeholder="FR12345678901"
                            class="w-full px-3 py-2 border border-zinc-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white @error('vat_number') border-red-500 @enderror">
                        @error('vat_number')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
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
