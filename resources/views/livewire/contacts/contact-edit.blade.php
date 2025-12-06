<div class="space-y-6">
    <flux:heading size="lg">{{ __('Edit Contact') }}</flux:heading>

    <form wire:submit="save" class="space-y-6">
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <!-- First Name -->
            <flux:field label="{{ __('First Name') }}" class="space-y-2">
                <flux:input wire:model="contact.first_name" type="text" placeholder="{{ __('Enter first name') }}"
                    :invalid="$errors->has('contact.first_name')" required />
                @error('contact.first_name')
                    <flux:div class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</flux:div>
                @enderror
            </flux:field>

            <!-- Last Name -->
            <flux:field label="{{ __('Last Name') }}" class="space-y-2">
                <flux:input wire:model="contact.last_name" type="text" placeholder="{{ __('Enter last name') }}"
                    :invalid="$errors->has('contact.last_name')" required />
                @error('contact.last_name')
                    <flux:div class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</flux:div>
                @enderror
            </flux:field>

            <!-- Email -->
            <flux:field label="{{ __('Email') }}" class="space-y-2 md:col-span-2">
                <flux:input wire:model="contact.email" type="email" placeholder="{{ __('Enter email address') }}"
                    :invalid="$errors->has('contact.email')" required />
                @error('contact.email')
                    <flux:div class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</flux:div>
                @enderror
            </flux:field>

            <!-- Position -->
            <flux:field label="{{ __('Position') }}" class="space-y-2">
                <flux:input wire:model="contact.position" type="text" placeholder="{{ __('Enter position') }}"
                    :invalid="$errors->has('contact.position')" />
                @error('contact.position')
                    <flux:div class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</flux:div>
                @enderror
            </flux:field>

            <!-- Job Title -->
            <flux:field label="{{ __('Job Title') }}" class="space-y-2">
                <flux:input wire:model="contact.job_title" type="text" placeholder="{{ __('Enter job title') }}"
                    :invalid="$errors->has('contact.job_title')" />
                @error('contact.job_title')
                    <flux:div class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</flux:div>
                @enderror
            </flux:field>

            <!-- Department -->
            <flux:field label="{{ __('Department') }}" class="space-y-2">
                <flux:input wire:model="contact.department" type="text" placeholder="{{ __('Enter department') }}"
                    :invalid="$errors->has('contact.department')" />
                @error('contact.department')
                    <flux:div class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</flux:div>
                @enderror
            </flux:field>

            <!-- Phone -->
            <flux:field label="{{ __('Phone') }}" class="space-y-2">
                <flux:input wire:model="contact.phone" type="text" placeholder="{{ __('Enter phone number') }}"
                    :invalid="$errors->has('contact.phone')" />
                @error('contact.phone')
                    <flux:div class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</flux:div>
                @enderror
            </flux:field>

            <!-- Work Phone -->
            <flux:field label="{{ __('Work Phone') }}" class="space-y-2">
                <flux:input wire:model="contact.work_phone" type="text" placeholder="{{ __('Enter work phone') }}"
                    :invalid="$errors->has('contact.work_phone')" />
                @error('contact.work_phone')
                    <flux:div class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</flux:div>
                @enderror
            </flux:field>

            <!-- Mobile Phone -->
            <flux:field label="{{ __('Mobile Phone') }}" class="space-y-2">
                <flux:input wire:model="contact.mobile_phone" type="text"
                    placeholder="{{ __('Enter mobile phone') }}" :invalid="$errors->has('contact.mobile_phone')" />
                @error('contact.mobile_phone')
                    <flux:div class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</flux:div>
                @enderror
            </flux:field>

            <!-- Notes -->
            <flux:field label="{{ __('Notes') }}" class="space-y-2 md:col-span-2">
                <flux:textarea wire:model="contact.notes" placeholder="{{ __('Enter notes') }}"
                    :invalid="$errors->has('contact.notes')" rows="3" />
                @error('contact.notes')
                    <flux:div class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</flux:div>
                @enderror
            </flux:field>
        </div>

        <!-- Contact Roles -->
        <div class="space-y-4">
            <flux:heading size="sm">{{ __('Contact Roles') }}</flux:heading>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                <flux:checkbox wire:model="contact.is_primary" label="{{ __('Primary Contact') }}"
                    description="{{ __('This contact will be the main point of contact for this client') }}" />

                <flux:checkbox wire:model="contact.is_billing_contact" label="{{ __('Billing Contact') }}"
                    description="{{ __('This contact will receive billing communications') }}" />

                <flux:checkbox wire:model="contact.is_technical_contact" label="{{ __('Technical Contact') }}"
                    description="{{ __('This contact will receive technical communications') }}" />
            </div>
        </div>

        <!-- Communication Preferences -->
        <div class="space-y-4">
            <flux:heading size="sm">{{ __('Communication Preferences') }}</flux:heading>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <flux:checkbox wire:model="contact.communication_preferences.email" label="{{ __('Email') }}" />

                <flux:checkbox wire:model="contact.communication_preferences.phone" label="{{ __('Phone Calls') }}" />

                <flux:checkbox wire:model="contact.communication_preferences.sms" label="{{ __('SMS') }}" />

                <flux:checkbox wire:model="contact.communication_preferences.video" label="{{ __('Video Calls') }}" />
            </div>
        </div>

        <!-- Buttons -->
        <div class="flex justify-end space-x-3 pt-4">
            <flux:button variant="outline" type="button" wire:click="$dispatch('close-modal', 'edit-contact')">
                {{ __('Cancel') }}
            </flux:button>
            <flux:button type="submit" variant="primary">
                {{ __('Update Contact') }}
            </flux:button>
        </div>
    </form>
</div>
