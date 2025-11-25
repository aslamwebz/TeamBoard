<div>
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">{{ $vendor->name }}</h2>
            <p class="text-gray-600">Vendor details and relationships</p>
        </div>
        <div class="flex space-x-3">
            <a 
                href="{{ route('vendors.edit', $vendor->id) }}" 
                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
            >
                Edit
            </a>
            <a 
                href="{{ route('vendors') }}" 
                class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
            >
                Back to Vendors
            </a>
        </div>
    </div>

    <!-- Vendor Summary -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-6">
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Vendor Information</h3>
        </div>
        <div class="px-4 py-5 sm:p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <div class="flex items-center">
                        <div class="text-sm font-medium text-gray-500">Company Name</div>
                        <div class="ml-2 text-sm text-gray-900">{{ $vendor->name }}</div>
                    </div>
                    
                    <div class="mt-2 flex items-center">
                        <div class="text-sm font-medium text-gray-500">Email</div>
                        <div class="ml-2 text-sm text-gray-900">{{ $vendor->email ?? 'N/A' }}</div>
                    </div>
                    
                    <div class="mt-2 flex items-center">
                        <div class="text-sm font-medium text-gray-500">Phone</div>
                        <div class="ml-2 text-sm text-gray-900">{{ $vendor->phone ?? 'N/A' }}</div>
                    </div>
                    
                    <div class="mt-2 flex items-center">
                        <div class="text-sm font-medium text-gray-500">Website</div>
                        <div class="ml-2 text-sm text-gray-900">
                            @if($vendor->website)
                                <a href="{{ $vendor->website }}" target="_blank" class="text-blue-600 hover:text-blue-900">{{ $vendor->website }}</a>
                            @else
                                N/A
                            @endif
                        </div>
                    </div>
                    
                    <div class="mt-2 flex items-center">
                        <div class="text-sm font-medium text-gray-500">Tax ID</div>
                        <div class="ml-2 text-sm text-gray-900">{{ $vendor->tax_id ?? 'N/A' }}</div>
                    </div>
                </div>
                
                <div>
                    <div class="flex items-center">
                        <div class="text-sm font-medium text-gray-500">Status</div>
                        <div class="ml-2 text-sm">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                {{ $this->getVendorStatusBadgeClass($vendor->status) }}">
                                {{ ucfirst($vendor->status) }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="mt-2 flex items-center">
                        <div class="text-sm font-medium text-gray-500">Rating</div>
                        <div class="ml-2 text-sm text-gray-900">
                            <div class="flex items-center">
                                <span class="font-medium">{{ number_format($vendor->rating, 1) }}/5.0</span>
                                <div class="ml-1 flex">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-4 h-4 {{ $i <= round($vendor->rating) ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-2 flex items-center">
                        <div class="text-sm font-medium text-gray-500">Payment Terms</div>
                        <div class="ml-2 text-sm text-gray-900">{{ $vendor->payment_terms ?? 'N/A' }}</div>
                    </div>
                    
                    <div class="mt-2 flex items-center">
                        <div class="text-sm font-medium text-gray-500">Credit Limit</div>
                        <div class="ml-2 text-sm text-gray-900">{{ $vendor->credit_limit ? '$' . number_format($vendor->credit_limit, 2) : 'N/A' }}</div>
                    </div>
                    
                    <div class="mt-2 flex items-center">
                        <div class="text-sm font-medium text-gray-500">Last Transaction</div>
                        <div class="ml-2 text-sm text-gray-900">{{ $vendor->last_transaction_date ? $vendor->last_transaction_date->format('M j, Y') : 'Never' }}</div>
                    </div>
                </div>
            </div>
            
            <div class="mt-4">
                <div class="text-sm font-medium text-gray-500">Address</div>
                <div class="mt-1 text-sm text-gray-900">
                    {{ $vendor->address ?? 'N/A' }}<br>
                    @if($vendor->city || $vendor->state || $vendor->zip_code)
                        {{ $vendor->city ?? '' }}{{ $vendor->city ? ', ' : '' }}{{ $vendor->state ?? '' }} {{ $vendor->zip_code ?? '' }}<br>
                    @endif
                    {{ $vendor->country ?? 'N/A' }}
                </div>
            </div>
            
            @if($vendor->description)
                <div class="mt-4">
                    <div class="text-sm font-medium text-gray-500">Description</div>
                    <div class="mt-1 text-sm text-gray-900">{{ $vendor->description }}</div>
                </div>
            @endif
        </div>
    </div>

    <!-- Tabs for related data -->
    <div class="bg-white shadow sm:rounded-lg">
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8 px-6">
                <a 
                    href="{{ route('vendor.contacts', $vendor->id) }}"
                    class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm"
                >
                    Contacts ({{ $vendor->contacts->count() }})
                </a>
                
                <a 
                    href="{{ route('vendor.services', $vendor->id) }}"
                    class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm"
                >
                    Services ({{ $vendor->services->count() }})
                </a>
                
                <a
                    href="{{ route('vendor.invoices', $vendor->id) }}"
                    class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm"
                >
                    Invoices ({{ $vendor->invoices->count() }})
                </a>

                <a
                    href="{{ route('vendor.projects', $vendor->id) }}"
                    class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm"
                >
                    Projects ({{ $vendor->projects->count() }})
                </a>

                <a
                    href="{{ route('vendor.tasks', $vendor->id) }}"
                    class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm"
                >
                    Tasks ({{ $vendor->tasks->count() }})
                </a>
            </nav>
        </div>
        
        <div class="p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Vendor Contacts</h3>
            @if($vendor->contacts->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Position
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Contact
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Primary
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($vendor->contacts as $contact)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $contact->full_name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $contact->position ?? 'N/A' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $contact->email }}</div>
                                        <div class="text-sm text-gray-500">{{ $contact->phone ?? 'N/A' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $contact->is_primary ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                            {{ $contact->is_primary ? 'Yes' : 'No' }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-4 text-gray-500">
                    No contacts found for this vendor.
                </div>
            @endif

            <h3 class="text-lg font-medium text-gray-900 mt-8 mb-4">Services Offered</h3>
            @if($vendor->services->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Service
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Category
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Unit Price
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($vendor->services as $service)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $service->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $service->description ?: 'No description' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $service->category ?: 'N/A' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $service->unit_price ? '$' . number_format($service->unit_price, 2) : 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                            {{ $service->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                            {{ $service->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-4 text-gray-500">
                    No services found for this vendor.
                </div>
            @endif

            <h3 class="text-lg font-medium text-gray-900 mt-8 mb-4">Recent Invoices</h3>
            @if($vendor->invoices->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Invoice #
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Amount
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($vendor->invoices->take(5) as $invoice)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $invoice->invoice_number }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $invoice->invoice_date->format('M j, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        ${{ number_format($invoice->total_amount, 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                            {{ $this->getInvoiceStatusBadgeClass($invoice->status) }}">
                                            {{ ucfirst($invoice->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-4 text-gray-500">
                    No invoices found for this vendor.
                </div>
            @endif
        </div>
    </div>
</div>