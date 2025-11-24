<div>
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Purchase Order: {{ $purchaseOrder->po_number }}</h2>
            <p class="text-gray-600">Details for purchase order from {{ $purchaseOrder->vendor->name }}</p>
        </div>
        <div class="flex space-x-3">
            <a 
                href="{{ route('purchase-orders.edit', $purchaseOrder->id) }}" 
                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
            >
                Edit
            </a>
            <a 
                href="{{ route('purchase-orders') }}" 
                class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
            >
                Back to POs
            </a>
        </div>
    </div>

    <!-- PO Summary -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-6">
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Purchase Order Information</h3>
        </div>
        <div class="px-4 py-5 sm:p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <div class="flex items-center">
                        <div class="text-sm font-medium text-gray-500">PO Number</div>
                        <div class="ml-2 text-sm text-gray-900">{{ $purchaseOrder->po_number }}</div>
                    </div>
                    
                    <div class="mt-2 flex items-center">
                        <div class="text-sm font-medium text-gray-500">Vendor</div>
                        <div class="ml-2 text-sm text-gray-900">{{ $purchaseOrder->vendor->name }}</div>
                    </div>
                    
                    <div class="mt-2 flex items-center">
                        <div class="text-sm font-medium text-gray-500">Order Date</div>
                        <div class="ml-2 text-sm text-gray-900">{{ $purchaseOrder->order_date->format('M j, Y') }}</div>
                    </div>
                    
                    <div class="mt-2 flex items-center">
                        <div class="text-sm font-medium text-gray-500">Required Date</div>
                        <div class="ml-2 text-sm text-gray-900">{{ $purchaseOrder->required_date ? $purchaseOrder->required_date->format('M j, Y') : 'N/A' }}</div>
                    </div>
                    
                    <div class="mt-2 flex items-center">
                        <div class="text-sm font-medium text-gray-500">Expected Delivery</div>
                        <div class="ml-2 text-sm text-gray-900">{{ $purchaseOrder->expected_delivery_date ? $purchaseOrder->expected_delivery_date->format('M j, Y') : 'N/A' }}</div>
                    </div>
                </div>
                
                <div>
                    <div class="flex items-center">
                        <div class="text-sm font-medium text-gray-500">Status</div>
                        <div class="ml-2 text-sm">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                {{ $this->getStatusBadgeClass($purchaseOrder->status) }}">
                                {{ ucfirst(str_replace('_', ' ', $purchaseOrder->status)) }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="mt-2 flex items-center">
                        <div class="text-sm font-medium text-gray-500">Subtotal</div>
                        <div class="ml-2 text-sm text-gray-900">${{ number_format($purchaseOrder->subtotal, 2) }}</div>
                    </div>
                    
                    <div class="mt-2 flex items-center">
                        <div class="text-sm font-medium text-gray-500">Tax Amount</div>
                        <div class="ml-2 text-sm text-gray-900">${{ number_format($purchaseOrder->tax_amount, 2) }}</div>
                    </div>
                    
                    <div class="mt-2 flex items-center">
                        <div class="text-sm font-medium text-gray-500">Total Amount</div>
                        <div class="ml-2 text-sm text-gray-900 font-medium">${{ number_format($purchaseOrder->total_amount, 2) }}</div>
                    </div>
                    
                    <div class="mt-2 flex items-center">
                        <div class="text-sm font-medium text-gray-500">Created By</div>
                        <div class="ml-2 text-sm text-gray-900">{{ $purchaseOrder->creator->name }}</div>
                    </div>
                    
                    <div class="mt-2 flex items-center">
                        <div class="text-sm font-medium text-gray-500">Approved By</div>
                        <div class="ml-2 text-sm text-gray-900">{{ $purchaseOrder->approver ? $purchaseOrder->approver->name : 'N/A' }}</div>
                    </div>
                </div>
            </div>
            
            @if($purchaseOrder->delivery_address)
                <div class="mt-4">
                    <div class="text-sm font-medium text-gray-500">Delivery Address</div>
                    <div class="mt-1 text-sm text-gray-900">{{ $purchaseOrder->delivery_address }}</div>
                </div>
            @endif
            
            @if($purchaseOrder->shipping_method)
                <div class="mt-4">
                    <div class="text-sm font-medium text-gray-500">Shipping Method</div>
                    <div class="mt-1 text-sm text-gray-900">{{ $purchaseOrder->shipping_method }}</div>
                </div>
            @endif
            
            @if($purchaseOrder->payment_terms)
                <div class="mt-4">
                    <div class="text-sm font-medium text-gray-500">Payment Terms</div>
                    <div class="mt-1 text-sm text-gray-900">{{ $purchaseOrder->payment_terms }}</div>
                </div>
            @endif
            
            @if($purchaseOrder->notes)
                <div class="mt-4">
                    <div class="text-sm font-medium text-gray-500">Notes</div>
                    <div class="mt-1 text-sm text-gray-900">{{ $purchaseOrder->notes }}</div>
                </div>
            @endif
        </div>
    </div>

    <!-- PO Items -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Purchase Order Items</h3>
        </div>
        <div class="px-4 py-5 sm:p-6">
            @if($purchaseOrder->items->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Item
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Description
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Unit Price
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Quantity
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Total Price
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Received
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($purchaseOrder->items as $item)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $item->name }}</div>
                                        @if($item->service_code)
                                            <div class="text-sm text-gray-500">Code: {{ $item->service_code }}</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">{{ $item->description ?: 'N/A' }}</div>
                                        @if($item->unit_of_measure)
                                            <div class="text-sm text-gray-500">{{ $item->unit_of_measure }}</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        ${{ number_format($item->unit_price, 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $item->quantity }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        ${{ number_format($item->total_price, 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $item->received_quantity }} / {{ $item->quantity }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $item->isFullyReceived() ? 'bg-green-100 text-green-800' :
                                               ($item->isPartiallyReceived() ? 'bg-yellow-100 text-yellow-800' :
                                                  ($item->isNotReceived() ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800')) }}">
                                            {{ $item->isFullyReceived() ? 'Received' :
                                               ($item->isPartiallyReceived() ? 'Partial' : 'Not Received') }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-4 text-gray-500">
                    No items found for this purchase order.
                </div>
            @endif
        </div>
    </div>
</div>