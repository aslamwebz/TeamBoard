<div>
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-foreground">Create Client</h2>
        <p class="text-muted-foreground">Add a new client to your system</p>
    </div>

    <div class="bg-card border rounded-lg shadow-sm max-w-2xl">
        <form wire:submit="createClient" class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-foreground mb-1">Name *</label>
                        <input 
                            type="text" 
                            id="name" 
                            wire:model="name" 
                            class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('name') border-destructive @enderror"
                        >
                        @error('name')
                            <p class="text-sm text-destructive mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-foreground mb-1">Email *</label>
                        <input 
                            type="email" 
                            id="email" 
                            wire:model="email" 
                            class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('email') border-destructive @enderror"
                        >
                        @error('email')
                            <p class="text-sm text-destructive mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-foreground mb-1">Phone</label>
                        <input 
                            type="text" 
                            id="phone" 
                            wire:model="phone" 
                            class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('phone') border-destructive @enderror"
                        >
                        @error('phone')
                            <p class="text-sm text-destructive mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="company_name" class="block text-sm font-medium text-foreground mb-1">Company Name</label>
                        <input 
                            type="text" 
                            id="company_name" 
                            wire:model="company_name" 
                            class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('company_name') border-destructive @enderror"
                        >
                        @error('company_name')
                            <p class="text-sm text-destructive mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label for="address" class="block text-sm font-medium text-foreground mb-1">Address</label>
                        <textarea 
                            id="address" 
                            wire:model="address" 
                            rows="3" 
                            class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('address') border-destructive @enderror"
                        ></textarea>
                        @error('address')
                            <p class="text-sm text-destructive mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="city" class="block text-sm font-medium text-foreground mb-1">City</label>
                            <input 
                                type="text" 
                                id="city" 
                                wire:model="city" 
                                class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('city') border-destructive @enderror"
                            >
                            @error('city')
                                <p class="text-sm text-destructive mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="state" class="block text-sm font-medium text-foreground mb-1">State</label>
                            <input 
                                type="text" 
                                id="state" 
                                wire:model="state" 
                                class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('state') border-destructive @enderror"
                            >
                            @error('state')
                                <p class="text-sm text-destructive mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="zip_code" class="block text-sm font-medium text-foreground mb-1">ZIP Code</label>
                            <input 
                                type="text" 
                                id="zip_code" 
                                wire:model="zip_code" 
                                class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('zip_code') border-destructive @enderror"
                            >
                            @error('zip_code')
                                <p class="text-sm text-destructive mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="country" class="block text-sm font-medium text-foreground mb-1">Country</label>
                            <input 
                                type="text" 
                                id="country" 
                                wire:model="country" 
                                class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('country') border-destructive @enderror"
                            >
                            @error('country')
                                <p class="text-sm text-destructive mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="vat_number" class="block text-sm font-medium text-foreground mb-1">VAT Number</label>
                        <input 
                            type="text" 
                            id="vat_number" 
                            wire:model="vat_number" 
                            class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('vat_number') border-destructive @enderror"
                        >
                        @error('vat_number')
                            <p class="text-sm text-destructive mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-3">
                <a href="{{ route('clients.index') }}" class="px-4 py-2 border border-input rounded-lg text-foreground hover:bg-muted">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-primary text-primary-foreground rounded-lg hover:bg-primary/90">Create Client</button>
            </div>
        </form>
    </div>
</div>