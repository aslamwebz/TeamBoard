<div>
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">Invoice Payments</h1>
            <p class="mt-2 text-sm text-gray-700">Manage payments for invoice {{ $invoice->invoice_number }}.</p>
        </div>
    </div>

    <!-- Invoice Summary -->
    <div class="mt-6 bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                <div class="text-center">
                    <p class="text-sm font-medium text-gray-500">Total Amount</p>
                    <p class="mt-1 text-xl font-semibold text-gray-900">{{ $invoice->getDefaultCurrency() }} {{ number_format($invoice->total, 2) }}</p>
                </div>
                <div class="text-center">
                    <p class="text-sm font-medium text-gray-500">Total Paid</p>
                    <p class="mt-1 text-xl font-semibold text-gray-900">{{ $invoice->getDefaultCurrency() }} {{ number_format($invoice->getTotalPaidAmount(), 2) }}</p>
                </div>
                <div class="text-center">
                    <p class="text-sm font-medium text-gray-500">Remaining Balance</p>
                    <p class="mt-1 text-xl font-semibold text-gray-900">{{ $invoice->getDefaultCurrency() }} {{ number_format($invoice->getRemainingBalance(), 2) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Payment Form -->
    <div class="mt-6 bg-white shadow sm:rounded-lg">
        <div class="border-b border-gray-200 px-4 py-5 sm:px-6">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Add Payment</h3>
        </div>
        <div class="px-4 py-5 sm:p-6">
            <form class="space-y-6" wire:submit="addPayment">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label for="paymentAmount" class="block text-sm font-medium leading-6 text-gray-900">Amount</label>
                        <div class="mt-2">
                            <input type="number" step="0.01" wire:model="paymentAmount" id="paymentAmount" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @error('paymentAmount') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                            <p class="mt-1 text-sm text-gray-500">Maximum: {{ $invoice->getDefaultCurrency() }} {{ number_format($invoice->getRemainingBalance(), 2) }}</p>
                        </div>
                    </div>

                    <div>
                        <label for="paymentMethod" class="block text-sm font-medium leading-6 text-gray-900">Payment Method</label>
                        <div class="mt-2">
                            <select wire:model="paymentMethod" id="paymentMethod" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="">Select payment method</option>
                                @foreach($payment_methods as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('paymentMethod') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label for="paymentDate" class="block text-sm font-medium leading-6 text-gray-900">Date</label>
                        <div class="mt-2">
                            <input type="date" wire:model="paymentDate" id="paymentDate" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @error('paymentDate') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label for="transactionReference" class="block text-sm font-medium leading-6 text-gray-900">Transaction Reference</label>
                        <div class="mt-2">
                            <input type="text" wire:model="transactionReference" id="transactionReference" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                </div>

                <div>
                    <label for="notes" class="block text-sm font-medium leading-6 text-gray-900">Notes</label>
                    <div class="mt-2">
                        <textarea wire:model="notes" id="notes" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Add Payment
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Payment History -->
    <div class="mt-6 bg-white shadow sm:rounded-lg">
        <div class="border-b border-gray-200 px-4 py-5 sm:px-6">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Payment History</h3>
        </div>
        <div class="px-4 py-5 sm:p-6">
            @if($payments->count() > 0)
                <div class="overflow-hidden bg-white shadow sm:rounded-md">
                    <ul role="list" class="divide-y divide-gray-200">
                        @foreach($payments as $payment)
                            <li>
                                <div class="px-4 py-4 sm:px-6">
                                    <div class="flex items-center justify-between">
                                        <div class="text-sm font-medium text-indigo-600 truncate">
                                            {{ $payment->payment_method ? ucfirst(str_replace('_', ' ', $payment->payment_method)) : 'N/A' }}
                                        </div>
                                        <div class="flex items-center">
                                            <div class="ml-2 flex-shrink-0">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                    @if($payment->status === 'pending' || $payment->status === 'processing') bg-yellow-100 text-yellow-800
                                                    @elseif($payment->status === 'completed') bg-green-100 text-green-800
                                                    @elseif($payment->status === 'failed' || $payment->status === 'cancelled') bg-red-100 text-red-800
                                                    @elseif($payment->status === 'refunded') bg-blue-100 text-blue-800
                                                    @else bg-gray-100 text-gray-800
                                                    @endif">
                                                    {{ ucfirst(str_replace('_', ' ', $payment->status)) }}
                                                </span>
                                            </div>
                                            <div class="ml-4 text-sm text-gray-500">
                                                {{ $payment->payment_date->format('M d, Y') }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2 sm:flex sm:justify-between">
                                        <div class="sm:flex">
                                            <div class="text-sm text-gray-900">
                                                <p class="truncate">{{ $payment->currency }} {{ number_format($payment->amount, 2) }}</p>
                                                <p class="mt-1 flex items-center text-xs text-gray-500">
                                                    Ref: {{ $payment->transaction_reference ?: 'N/A' }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                                            <p>{{ $payment->notes ?: 'No notes' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @else
                <p class="text-sm text-gray-500">No payments recorded for this invoice yet.</p>
            @endif
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('invoices.show', $invoice) }}" class="rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">
            Back to Invoice
        </a>
    </div>
</div>