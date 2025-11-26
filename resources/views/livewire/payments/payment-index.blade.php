<div>
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">Payments</h1>
            <p class="mt-2 text-sm text-gray-700">A list of all payments in the system.</p>
        </div>
        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            <a href="{{ route('payments.create') }}" type="button" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Add payment
            </a>
        </div>
    </div>

    <!-- Filters -->
    <div class="mt-8 grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-6">
        <div>
            <label for="search" class="block text-sm font-medium leading-6 text-gray-900">Search</label>
            <div class="mt-2">
                <input type="text" wire:model.live="search" id="search" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
        </div>

        <div>
            <label for="invoiceId" class="block text-sm font-medium leading-6 text-gray-900">Invoice</label>
            <div class="mt-2">
                <select wire:model.live="invoiceId" id="invoiceId" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    <option value="">All Invoices</option>
                    @foreach($invoices as $invoice)
                        <option value="{{ $invoice->id }}">{{ $invoice->invoice_number }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div>
            <label for="expenseId" class="block text-sm font-medium leading-6 text-gray-900">Expense</label>
            <div class="mt-2">
                <select wire:model.live="expenseId" id="expenseId" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    <option value="">All Expenses</option>
                    @foreach($expenses as $expense)
                        <option value="{{ $expense->id }}">{{ $expense->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div>
            <label for="userId" class="block text-sm font-medium leading-6 text-gray-900">User</label>
            <div class="mt-2">
                <select wire:model.live="userId" id="userId" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    <option value="">All Users</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div>
            <label for="status" class="block text-sm font-medium leading-6 text-gray-900">Status</label>
            <div class="mt-2">
                <select wire:model.live="status" id="status" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    <option value="">All Statuses</option>
                    @foreach($statuses as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div>
            <label for="paymentMethod" class="block text-sm font-medium leading-6 text-gray-900">Method</label>
            <div class="mt-2">
                <select wire:model.live="paymentMethod" id="paymentMethod" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    <option value="">All Methods</option>
                    @foreach($paymentMethods as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div>
            <label for="dateFrom" class="block text-sm font-medium leading-6 text-gray-900">From Date</label>
            <div class="mt-2">
                <input type="date" wire:model.live="dateFrom" id="dateFrom" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
        </div>

        <div>
            <label for="dateTo" class="block text-sm font-medium leading-6 text-gray-900">To Date</label>
            <div class="mt-2">
                <input type="date" wire:model.live="dateTo" id="dateTo" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
        </div>
    </div>

    <!-- Payment Table -->
    <div class="mt-8 flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead>
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Transaction ID</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Amount</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Type</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Reference</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Date</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($payments as $payment)
                        <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">
                                {{ $payment->id }}
                                @if($payment->isForInvoice())
                                    <div class="text-gray-500 text-xs">Invoice: {{ $payment->invoice?->invoice_number ?: 'N/A' }}</div>
                                @elseif($payment->isForExpense())
                                    <div class="text-gray-500 text-xs">Expense: {{ $payment->expense?->title ?: 'N/A' }}</div>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                {{ $payment->currency }} {{ number_format($payment->amount, 2) }}
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                @if($payment->isForInvoice())
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        Invoice
                                    </span>
                                @elseif($payment->isForExpense())
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Expense
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        Other
                                    </span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                {{ $payment->transaction_reference ?: 'N/A' }}
                                <div class="text-gray-500 text-xs">{{ $payment->payment_method ? ucfirst(str_replace('_', ' ', $payment->payment_method)) : 'N/A' }}</div>
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                {{ $payment->payment_date->format('M d, Y') }}
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($payment->status === 'pending' || $payment->status === 'processing') bg-yellow-100 text-yellow-800
                                    @elseif($payment->status === 'completed') bg-green-100 text-green-800
                                    @elseif($payment->status === 'failed' || $payment->status === 'cancelled') bg-red-100 text-red-800
                                    @elseif($payment->status === 'refunded') bg-blue-100 text-blue-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    {{ ucfirst(str_replace('_', ' ', $payment->status)) }}
                                </span>
                            </td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                                <div class="flex space-x-2">
                                    <a href="{{ route('payments.show', $payment) }}" class="text-indigo-600 hover:text-indigo-900">View</a>
                                    <a href="{{ route('payments.edit', $payment) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    <button wire:click="deletePayment({{ $payment->id }})" class="text-red-600 hover:text-red-900" 
                                        onclick="confirm('Are you sure you want to delete this payment?') || event.stopImmediatePropagation()">Delete</button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="py-4 text-center text-sm text-gray-500">No payments found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $payments->links() }}
    </div>
</div>