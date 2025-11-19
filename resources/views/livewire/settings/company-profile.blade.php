<div class="space-y-8">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-foreground">{{ __('Company Profile') }}</h1>
            <p class="text-muted-foreground">{{ __('Manage your company information and settings') }}</p>
        </div>
    </div>

    @if(session()->has('message'))
        <div class="bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-md p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800 dark:text-green-200">
                        {{ session('message') }}
                    </p>
                </div>
            </div>
        </div>
    @endif

    <!-- Company Profile Form -->
    <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden">
        <div class="px-6 py-5 border-b border-zinc-200 dark:border-zinc-700">
            <h2 class="text-lg font-medium text-foreground">{{ __('Company Information') }}</h2>
            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">{{ __('Update your company details and branding') }}</p>
        </div>

        <div class="p-6">
            <form wire:submit.prevent="save">
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <!-- Legal Name -->
                    <div class="md:col-span-2">
                        <flux:field label="{{ __('Company Legal Name') }}" class="space-y-2">
                            <flux:input
                                wire:model="legal_name"
                                type="text"
                                placeholder="{{ __('Enter company legal name') }}"
                                :invalid="$this->isFieldInvalid('legal_name')"
                                class="w-full" />
                            @error('legal_name')
                                <div class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </flux:field>
                    </div>

                    <!-- Logo -->
                    <div class="md:col-span-2 space-y-2">
                        <flux:label>{{ __('Company Logo') }}</flux:label>
                        <div class="flex items-center gap-4">
                            @if($logoPreview)
                                <img src="{{ $logoPreview }}" class="h-16 w-16 rounded-lg object-cover" alt="Logo Preview">
                            @elseif($currentLogoUrl)
                                <img src="{{ $currentLogoUrl }}" class="h-16 w-16 rounded-lg object-cover" alt="Current Logo">
                            @endif

                            <div class="flex-1">
                                <flux:input
                                    type="file"
                                    wire:model="logo"
                                    accept="image/*"
                                    :invalid="$this->isFieldInvalid('logo')" />
                                @error('logo')
                                    <div class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        @if($currentLogoUrl)
                            <div class="pt-2">
                                <flux:button
                                    type="button"
                                    variant="outline"
                                    color="red"
                                    size="sm"
                                    wire:click="removeLogo">
                                    {{ __('Remove Logo') }}
                                </flux:button>
                            </div>
                        @endif
                    </div>

                    <!-- Address -->
                    <div class="md:col-span-2">
                        <flux:field label="{{ __('Address') }}" class="space-y-2">
                            <flux:textarea
                                wire:model="address"
                                placeholder="{{ __('Enter company address') }}"
                                :invalid="$this->isFieldInvalid('address')"
                                rows="3" />
                            @error('address')
                                <div class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </flux:field>
                    </div>

                    <!-- Phone -->
                    <div>
                        <flux:field label="{{ __('Phone') }}" class="space-y-2">
                            <flux:input
                                wire:model="phone"
                                type="text"
                                placeholder="{{ __('Enter phone number') }}"
                                :invalid="$this->isFieldInvalid('phone')" />
                            @error('phone')
                                <div class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </flux:field>
                    </div>

                    <!-- Email -->
                    <div>
                        <flux:field label="{{ __('Email') }}" class="space-y-2">
                            <flux:input
                                wire:model="email"
                                type="email"
                                placeholder="{{ __('Enter company email') }}"
                                :invalid="$this->isFieldInvalid('email')" />
                            @error('email')
                                <div class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </flux:field>
                    </div>

                    <!-- Tax/VAT Number -->
                    <div>
                        <flux:field label="{{ __('Tax/VAT Number') }}" class="space-y-2">
                            <flux:input
                                wire:model="tax_vat_number"
                                type="text"
                                placeholder="{{ __('Enter tax/VAT number') }}"
                                :invalid="$this->isFieldInvalid('tax_vat_number')" />
                            @error('tax_vat_number')
                                <div class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </flux:field>
                    </div>

                    <!-- Industry -->
                    <div>
                        <flux:field label="{{ __('Industry') }}" class="space-y-2">
                            <flux:input
                                wire:model="industry"
                                type="text"
                                placeholder="{{ __('Enter industry type') }}"
                                :invalid="$this->isFieldInvalid('industry')" />
                            @error('industry')
                                <div class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </flux:field>
                    </div>

                    <!-- Currency -->
                    <div>
                        <flux:field label="{{ __('Default Currency') }}" class="space-y-2">
                            <flux:select
                                wire:model="currency"
                                :invalid="$this->isFieldInvalid('currency')"
                                class="w-full">
                                <option value="USD">USD - US Dollar</option>
                                <option value="EUR">EUR - Euro</option>
                                <option value="GBP">GBP - British Pound</option>
                                <option value="CAD">CAD - Canadian Dollar</option>
                                <option value="AUD">AUD - Australian Dollar</option>
                                <option value="JPY">JPY - Japanese Yen</option>
                                <option value="INR">INR - Indian Rupee</option>
                                <option value="CNY">CNY - Chinese Yuan</option>
                                <option value="CHF">CHF - Swiss Franc</option>
                                <option value="SEK">SEK - Swedish Krona</option>
                                <option value="NOK">NOK - Norwegian Krone</option>
                                <option value="MXN">MXN - Mexican Peso</option>
                                <option value="BRL">BRL - Brazilian Real</option>
                                <option value="other">{{ __('Other') }}</option>
                            </flux:select>
                            @error('currency')
                                <div class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </flux:field>
                    </div>

                    <!-- Timezone -->
                    <div>
                        <flux:field label="{{ __('Timezone') }}" class="space-y-2">
                            <flux:select
                                wire:model="timezone"
                                :invalid="$this->isFieldInvalid('timezone')"
                                class="w-full">
                                <option value="UTC">UTC</option>
                                <option value="America/New_York">Eastern Time (US & Canada)</option>
                                <option value="America/Chicago">Central Time (US & Canada)</option>
                                <option value="America/Denver">Mountain Time (US & Canada)</option>
                                <option value="America/Los_Angeles">Pacific Time (US & Canada)</option>
                                <option value="Europe/London">London</option>
                                <option value="Europe/Paris">Paris</option>
                                <option value="Europe/Berlin">Berlin</option>
                                <option value="Asia/Tokyo">Tokyo</option>
                                <option value="Asia/Shanghai">Shanghai</option>
                                <option value="Asia/Kolkata">Kolkata</option>
                                <option value="Australia/Sydney">Sydney</option>
                                <option value="Pacific/Auckland">Auckland</option>
                            </flux:select>
                            @error('timezone')
                                <div class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </flux:field>
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <flux:button type="submit" variant="solid">
                        {{ __('Save') }}
                    </flux:button>
                </div>
            </form>
        </div>
    </div>
</div>