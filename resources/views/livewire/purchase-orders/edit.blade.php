<div>
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Edit Purchase Order</h2>
        <p class="text-gray-600">Update details for {{ $purchaseOrder->po_number }}</p>
    </div>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <form wire:submit="update" class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="vendor_id" class="block text-sm font-medium text-gray-700">Vendor *</label>
                    <select 
                        id="vendor_id" 
                        wire:model="vendor_id" 
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    >
                        <option value="">Select a vendor</option>
                        @foreach($vendors as $vendor)
                            <option value="{{ $vendor->id }}" {{ $vendor->id == $purchaseOrder->vendor_id ? 'selected' : '' }}>
                                {{ $vendor->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('vendor_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="po_number" class="block text-sm font-medium text-gray-700">PO Number *</label>
                    <input 
                        type="text" 
                        id="po_number" 
                        wire:model="po_number" 
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    />
                    @error('po_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="order_date" class="block text-sm font-medium text-gray-700">Order Date *</label>
                    <input 
                        type="date" 
                        id="order_date" 
                        wire:model="order_date" 
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    />
                    @error('order_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="required_date" class="block text-sm font-medium text-gray-700">Required Date</label>
                    <input 
                        type="date" 
                        id="required_date" 
                        wire:model="required_date" 
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    />
                    @error('required_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="expected_delivery_date" class="block text-sm font-medium text-gray-700">Expected Delivery Date</label>
                    <input 
                        type="date" 
                        id="expected_delivery_date" 
                        wire:model="expected_delivery_date" 
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    />
                    @error('expected_delivery_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select 
                        id="status" 
                        wire:model="status" 
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    >
                        <option value="draft">Draft</option>
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="sent">Sent</option>
                        <option value="partially_received">Partially Received</option>
                        <option value="received">Received</option>
                        <option value="closed">Closed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                    @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="subtotal" class="block text-sm font-medium text-gray-700">Subtotal *</label>
                    <input 
                        type="number" 
                        id="subtotal" 
                        wire:model="subtotal" 
                        step="0.01" 
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    />
                    @error('subtotal') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="tax_amount" class="block text-sm font-medium text-gray-700">Tax Amount *</label>
                    <input 
                        type="number" 
                        id="tax_amount" 
                        wire:model="tax_amount" 
                        step="0.01" 
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    />
                    @error('tax_amount') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="total_amount" class="block text-sm font-medium text-gray-700">Total Amount *</label>
                    <input 
                        type="number" 
                        id="total_amount" 
                        wire:model="total_amount" 
                        step="0.01" 
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    />
                    @error('total_amount') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="delivery_address" class="block text-sm font-medium text-gray-700">Delivery Address</label>
                    <textarea 
                        id="delivery_address" 
                        wire:model="delivery_address" 
                        rows="3" 
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    ></textarea>
                    @error('delivery_address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="shipping_method" class="block text-sm font-medium text-gray-700">Shipping Method</label>
                    <input 
                        type="text" 
                        id="shipping_method" 
                        wire:model="shipping_method" 
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    />
                    @error('shipping_method') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="payment_terms" class="block text-sm font-medium text-gray-700">Payment Terms</label>
                    <input 
                        type="text" 
                        id="payment_terms" 
                        wire:model="payment_terms" 
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    />
                    @error('payment_terms') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                    <textarea 
                        id="notes" 
                        wire:model="notes" 
                        rows="4" 
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    ></textarea>
                    @error('notes') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-3">
                <a href="{{ route('purchase-orders.show', $purchaseOrder->id) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Cancel
                </a>
                <button 
                    type="submit" 
                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                >
                    Update Purchase Order
                </button>
            </div>
        </form>
    </div>
</div>