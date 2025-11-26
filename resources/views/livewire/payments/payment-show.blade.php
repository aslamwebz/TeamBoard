<div>
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">Payment Details</h1>
            <p class="mt-2 text-sm text-gray-700">Details of the payment transaction.</p>
        </div>
        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            <a href="{{ route('payments.edit', $payment) }}" type="button" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Edit Payment
            </a>
        </div>
    </div>

    <div class="mt-8 bg-white shadow sm:rounded-lg">
        <div class="px-4 py-6 sm:p-8">
            <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-3">
                    <h3 class="text-base font-semibold leading-7 text-gray-900">Payment Information</h3>
                    
                    <div class="mt-4 space-y-4">
                        <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
                            <label class="block text-sm font-medium text-gray-900 sm:mt-px sm:pt-2">Transaction ID</label>
                            <div class="mt-1 sm:col-span-2 sm:mt-0">
                                <p class="block max-w-lg rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 sm:max-w-xs sm:text-sm sm:leading-6">
                                    {{ $payment->id }}
                                </p>
                            </div>
                        </div>

                        <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
                            <label class="block text-sm font-medium text-gray-900 sm:mt-px sm:pt-2">Amount</label>
                            <div class="mt-1 sm:col-span-2 sm:mt-0">
                                <p class="block max-w-lg rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 sm:max-w-xs sm:text-sm sm:leading-6">
                                    {{ $payment->currency }} {{ number_format($payment->amount, 2) }}
                                </p>
                            </div>
                        </div>

                        <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
                            <label class="block text-sm font-medium text-gray-900 sm:mt-px sm:pt-2">Date</label>
                            <div class="mt-1 sm:col-span-2 sm:mt-0">
                                <p class="block max-w-lg rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 sm:max-w-xs sm:text-sm sm:leading-6">
                                    {{ $payment->payment_date->format('M d, Y') }}
                                </p>
                            </div>
                        </div>

                        <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
                            <label class="block text-sm font-medium text-gray-900 sm:mt-px sm:pt-2">Status</label>
                            <div class="mt-1 sm:col-span-2 sm:mt-0">
                                <p class="block max-w-lg rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 sm:max-w-xs sm:text-sm sm:leading-6">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($payment->status === 'pending' || $payment->status === 'processing') bg-yellow-100 text-yellow-800
                                        @elseif($payment->status === 'completed') bg-green-100 text-green-800
                                        @elseif($payment->status === 'failed' || $payment->status === 'cancelled') bg-red-100 text-red-800
                                        @elseif($payment->status === 'refunded') bg-blue-100 text-blue-800
                                        @else bg-gray-100 text-gray-800
                                        @endif">
                                        {{ ucfirst(str_replace('_', ' ', $payment->status)) }}
                                    </span>
                                </p>
                            </div>
                        </div>

                        <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
                            <label class="block text-sm font-medium text-gray-900 sm:mt-px sm:pt-2">Payment Method</label>
                            <div class="mt-1 sm:col-span-2 sm:mt-0">
                                <p class="block max-w-lg rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 sm:max-w-xs sm:text-sm sm:leading-6">
                                    {{ $payment->payment_method ? ucfirst(str_replace('_', ' ', $payment->payment_method)) : 'N/A' }}
                                </p>
                            </div>
                        </div>

                        <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
                            <label class="block text-sm font-medium text-gray-900 sm:mt-px sm:pt-2">Transaction Reference</label>
                            <div class="mt-1 sm:col-span-2 sm:mt-0">
                                <p class="block max-w-lg rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 sm:max-w-xs sm:text-sm sm:leading-6">
                                    {{ $payment->transaction_reference ?: 'N/A' }}
                                </p>
                            </div>
                        </div>

                        <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
                            <label class="block text-sm font-medium text-gray-900 sm:mt-px sm:pt-2">Processed By</label>
                            <div class="mt-1 sm:col-span-2 sm:mt-0">
                                <p class="block max-w-lg rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 sm:max-w-xs sm:text-sm sm:leading-6">
                                    {{ $payment->user?->name ?: 'System' }}
                                </p>
                            </div>
                        </div>

                        <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
                            <label class="block text-sm font-medium text-gray-900 sm:mt-px sm:pt-2">Notes</label>
                            <div class="mt-1 sm:col-span-2 sm:mt-0">
                                <p class="block max-w-lg rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 sm:max-w-xs sm:text-sm sm:leading-6">
                                    {{ $payment->notes ?: 'N/A' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="sm:col-span-3 border-l border-gray-200 pl-6">
                    <h3 class="text-base font-semibold leading-7 text-gray-900">Related Records</h3>
                    
                    <div class="mt-4 space-y-4">
                        @if($payment->isForInvoice() && $payment->invoice)
                        <div>
                            <h4 class="text-sm font-medium text-gray-900">Invoice</h4>
                            <div class="mt-2 space-y-2">
                                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
                                    <label class="block text-sm font-medium text-gray-900 sm:mt-px sm:pt-2">Number</label>
                                    <div class="mt-1 sm:col-span-2 sm:mt-0">
                                        <a href="{{ route('invoices.show', $payment->invoice) }}" class="text-indigo-600 hover:text-indigo-900">
                                            {{ $payment->invoice->invoice_number }}
                                        </a>
                                    </div>
                                </div>
                                
                                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
                                    <label class="block text-sm font-medium text-gray-900 sm:mt-px sm:pt-2">Client</label>
                                    <div class="mt-1 sm:col-span-2 sm:mt-0">
                                        <p class="block max-w-lg rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 sm:max-w-xs sm:text-sm sm:leading-6">
                                            {{ $payment->invoice->client->name }}
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
                                    <label class="block text-sm font-medium text-gray-900 sm:mt-px sm:pt-2">Total Amount</label>
                                    <div class="mt-1 sm:col-span-2 sm:mt-0">
                                        <p class="block max-w-lg rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 sm:max-w-xs sm:text-sm sm:leading-6">
                                            {{ $payment->invoice->currency ?? 'USD' }} {{ number_format($payment->invoice->total, 2) }}
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
                                    <label class="block text-sm font-medium text-gray-900 sm:mt-px sm:pt-2">Remaining Balance</label>
                                    <div class="mt-1 sm:col-span-2 sm:mt-0">
                                        <p class="block max-w-lg rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 sm:max-w-xs sm:text-sm sm:leading-6">
                                            {{ $payment->invoice->currency ?? 'USD' }} {{ number_format($payment->invoice->getRemainingBalance(), 2) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        @if($payment->isForExpense() && $payment->expense)
                        <div>
                            <h4 class="text-sm font-medium text-gray-900">Expense</h4>
                            <div class="mt-2 space-y-2">
                                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
                                    <label class="block text-sm font-medium text-gray-900 sm:mt-px sm:pt-2">Title</label>
                                    <div class="mt-1 sm:col-span-2 sm:mt-0">
                                        <a href="{{ route('expenses.show', $payment->expense) }}" class="text-indigo-600 hover:text-indigo-900">
                                            {{ $payment->expense->title }}
                                        </a>
                                    </div>
                                </div>
                                
                                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
                                    <label class="block text-sm font-medium text-gray-900 sm:mt-px sm:pt-2">Vendor</label>
                                    <div class="mt-1 sm:col-span-2 sm:mt-0">
                                        <p class="block max-w-lg rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 sm:max-w-xs sm:text-sm sm:leading-6">
                                            {{ $payment->expense->vendor?->name ?: 'No Vendor' }}
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
                                    <label class="block text-sm font-medium text-gray-900 sm:mt-px sm:pt-2">Total Amount</label>
                                    <div class="mt-1 sm:col-span-2 sm:mt-0">
                                        <p class="block max-w-lg rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 sm:max-w-xs sm:text-sm sm:leading-6">
                                            {{ $payment->expense->currency }} {{ number_format($payment->expense->amount, 2) }}
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
                                    <label class="block text-sm font-medium text-gray-900 sm:mt-px sm:pt-2">Remaining Balance</label>
                                    <div class="mt-1 sm:col-span-2 sm:mt-0">
                                        <p class="block max-w-lg rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 sm:max-w-xs sm:text-sm sm:leading-6">
                                            {{ $payment->expense->currency }} {{ number_format($payment->expense->getRemainingBalance(), 2) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>