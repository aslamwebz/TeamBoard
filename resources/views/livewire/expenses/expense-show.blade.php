<div>
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">{{ $expense->title }}</h1>
            <p class="mt-2 text-sm text-gray-700">Expense details and information.</p>
        </div>
        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            <a href="{{ route('expenses.edit', $expense) }}" type="button" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Edit Expense
            </a>
        </div>
    </div>

    <div class="mt-8 bg-white shadow sm:rounded-lg">
        <div class="px-4 py-6 sm:p-8">
            <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-3">
                    <h3 class="text-base font-semibold leading-7 text-gray-900">Expense Information</h3>
                    
                    <div class="mt-4 space-y-4">
                        <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
                            <label class="block text-sm font-medium text-gray-900 sm:mt-px sm:pt-2">Title</label>
                            <div class="mt-1 sm:col-span-2 sm:mt-0">
                                <p class="block max-w-lg rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 sm:max-w-xs sm:text-sm sm:leading-6">
                                    {{ $expense->title }}
                                </p>
                            </div>
                        </div>

                        <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
                            <label class="block text-sm font-medium text-gray-900 sm:mt-px sm:pt-2">Description</label>
                            <div class="mt-1 sm:col-span-2 sm:mt-0">
                                <p class="block max-w-lg rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 sm:max-w-xs sm:text-sm sm:leading-6">
                                    {{ $expense->description ?: 'N/A' }}
                                </p>
                            </div>
                        </div>

                        <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
                            <label class="block text-sm font-medium text-gray-900 sm:mt-px sm:pt-2">Amount</label>
                            <div class="mt-1 sm:col-span-2 sm:mt-0">
                                <p class="block max-w-lg rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 sm:max-w-xs sm:text-sm sm:leading-6">
                                    {{ $expense->currency }} {{ number_format($expense->amount, 2) }}
                                </p>
                            </div>
                        </div>

                        <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
                            <label class="block text-sm font-medium text-gray-900 sm:mt-px sm:pt-2">Date</label>
                            <div class="mt-1 sm:col-span-2 sm:mt-0">
                                <p class="block max-w-lg rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 sm:max-w-xs sm:text-sm sm:leading-6">
                                    {{ $expense->expense_date->format('M d, Y') }}
                                </p>
                            </div>
                        </div>

                        <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
                            <label class="block text-sm font-medium text-gray-900 sm:mt-px sm:pt-2">Status</label>
                            <div class="mt-1 sm:col-span-2 sm:mt-0">
                                <p class="block max-w-lg rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 sm:max-w-xs sm:text-sm sm:leading-6">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($expense->status === 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($expense->status === 'approved') bg-green-100 text-green-800
                                        @elseif($expense->status === 'rejected') bg-red-100 text-red-800
                                        @elseif($expense->status === 'paid') bg-blue-100 text-blue-800
                                        @else bg-gray-100 text-gray-800
                                        @endif">
                                        {{ ucfirst(str_replace('_', ' ', $expense->status)) }}
                                    </span>
                                </p>
                            </div>
                        </div>

                        <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
                            <label class="block text-sm font-medium text-gray-900 sm:mt-px sm:pt-2">Payment Method</label>
                            <div class="mt-1 sm:col-span-2 sm:mt-0">
                                <p class="block max-w-lg rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 sm:max-w-xs sm:text-sm sm:leading-6">
                                    {{ $expense->payment_method ? ucfirst(str_replace('_', ' ', $expense->payment_method)) : 'N/A' }}
                                </p>
                            </div>
                        </div>

                        <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
                            <label class="block text-sm font-medium text-gray-900 sm:mt-px sm:pt-2">Category</label>
                            <div class="mt-1 sm:col-span-2 sm:mt-0">
                                <p class="block max-w-lg rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 sm:max-w-xs sm:text-sm sm:leading-6">
                                    {{ $expense->category?->name ?: 'Uncategorized' }}
                                </p>
                            </div>
                        </div>

                        <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
                            <label class="block text-sm font-medium text-gray-900 sm:mt-px sm:pt-2">Project</label>
                            <div class="mt-1 sm:col-span-2 sm:mt-0">
                                <p class="block max-w-lg rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 sm:max-w-xs sm:text-sm sm:leading-6">
                                    {{ $expense->project?->name ?: 'No Project' }}
                                </p>
                            </div>
                        </div>

                        <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
                            <label class="block text-sm font-medium text-gray-900 sm:mt-px sm:pt-2">Vendor</label>
                            <div class="mt-1 sm:col-span-2 sm:mt-0">
                                <p class="block max-w-lg rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 sm:max-w-xs sm:text-sm sm:leading-6">
                                    {{ $expense->vendor?->name ?: 'No Vendor' }}
                                </p>
                            </div>
                        </div>

                        <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
                            <label class="block text-sm font-medium text-gray-900 sm:mt-px sm:pt-2">Created By</label>
                            <div class="mt-1 sm:col-span-2 sm:mt-0">
                                <p class="block max-w-lg rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 sm:max-w-xs sm:text-sm sm:leading-6">
                                    {{ $expense->user?->name ?: 'Unknown' }}
                                </p>
                            </div>
                        </div>

                        @if($expense->approver)
                        <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
                            <label class="block text-sm font-medium text-gray-900 sm:mt-px sm:pt-2">Approved By</label>
                            <div class="mt-1 sm:col-span-2 sm:mt-0">
                                <p class="block max-w-lg rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 sm:max-w-xs sm:text-sm sm:leading-6">
                                    {{ $expense->approver->name }} on {{ $expense->approved_at?->format('M d, Y H:i') }}
                                </p>
                            </div>
                        </div>
                        @endif

                        <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
                            <label class="block text-sm font-medium text-gray-900 sm:mt-px sm:pt-2">Notes</label>
                            <div class="mt-1 sm:col-span-2 sm:mt-0">
                                <p class="block max-w-lg rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 sm:max-w-xs sm:text-sm sm:leading-6">
                                    {{ $expense->notes ?: 'N/A' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="sm:col-span-3 border-l border-gray-200 pl-6">
                    <h3 class="text-base font-semibold leading-7 text-gray-900">Attachments & Receipts</h3>
                    
                    <div class="mt-4">
                        @if($expense->receipt_path)
                            <div class="mb-4">
                                <h4 class="text-sm font-medium text-gray-900">Receipt</h4>
                                <div class="mt-2">
                                    <a href="{{ $expense->getReceiptUrl() }}" target="_blank" class="text-indigo-600 hover:text-indigo-900">
                                        View Receipt
                                    </a>
                                </div>
                            </div>
                        @endif
                        
                        @if($expense->attachments->count() > 0)
                            <div>
                                <h4 class="text-sm font-medium text-gray-900">Other Attachments</h4>
                                <ul class="mt-2 space-y-2">
                                    @foreach($expense->attachments as $attachment)
                                        <li class="flex items-center justify-between">
                                            <a href="{{ $attachment->getUrl() }}" target="_blank" class="text-indigo-600 hover:text-indigo-900 truncate max-w-xs">
                                                {{ $attachment->original_name }}
                                            </a>
                                            <span class="text-sm text-gray-500">{{ number_format($attachment->size / 1024, 2) }} KB</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @else
                            <p class="text-sm text-gray-500">No additional attachments.</p>
                        @endif
                    </div>
                    
                    <h3 class="mt-6 text-base font-semibold leading-7 text-gray-900">Payment Information</h3>
                    
                    <div class="mt-4 space-y-4">
                        <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
                            <label class="block text-sm font-medium text-gray-900 sm:mt-px sm:pt-2">Total Amount</label>
                            <div class="mt-1 sm:col-span-2 sm:mt-0">
                                <p class="block max-w-lg rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 sm:max-w-xs sm:text-sm sm:leading-6">
                                    {{ $expense->currency }} {{ number_format($expense->amount, 2) }}
                                </p>
                            </div>
                        </div>
                        
                        <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
                            <label class="block text-sm font-medium text-gray-900 sm:mt-px sm:pt-2">Total Paid</label>
                            <div class="mt-1 sm:col-span-2 sm:mt-0">
                                <p class="block max-w-lg rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 sm:max-w-xs sm:text-sm sm:leading-6">
                                    {{ $expense->currency }} {{ number_format($expense->getTotalPaidAmount(), 2) }}
                                </p>
                            </div>
                        </div>
                        
                        <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4">
                            <label class="block text-sm font-medium text-gray-900 sm:mt-px sm:pt-2">Remaining Balance</label>
                            <div class="mt-1 sm:col-span-2 sm:mt-0">
                                <p class="block max-w-lg rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 sm:max-w-xs sm:text-sm sm:leading-6">
                                    {{ $expense->currency }} {{ number_format($expense->getRemainingBalance(), 2) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>