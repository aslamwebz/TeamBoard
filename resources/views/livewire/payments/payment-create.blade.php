<div>
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">Create Payment</h1>
            <p class="mt-2 text-sm text-gray-700">Add a new payment to the system.</p>
        </div>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-2xl">
        <div class="bg-white px-4 py-8 shadow sm:rounded-lg sm:px-10">
            <form class="space-y-6" wire:submit="save">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label for="invoice_id" class="block text-sm font-medium leading-6 text-gray-900">Invoice</label>
                        <div class="mt-2">
                            <select wire:model="invoice_id" id="invoice_id" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="">Select an invoice</option>
                                @foreach($invoices as $invoice)
                                    <option value="{{ $invoice->id }}">{{ $invoice->invoice_number }} - {{ $invoice->client->name }} ({{ $invoice->total }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="expense_id" class="block text-sm font-medium leading-6 text-gray-900">Expense</label>
                        <div class="mt-2">
                            <select wire:model="expense_id" id="expense_id" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="">Select an expense</option>
                                @foreach($expenses as $expense)
                                    <option value="{{ $expense->id }}">{{ $expense->title }} - {{ $expense->vendor?->name ?: 'No Vendor' }} ({{ $expense->amount }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="amount" class="block text-sm font-medium leading-6 text-gray-900">Amount</label>
                        <div class="mt-2">
                            <input type="number" step="0.01" wire:model="amount" id="amount" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @error('amount') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label for="currency" class="block text-sm font-medium leading-6 text-gray-900">Currency</label>
                        <div class="mt-2">
                            <select wire:model="currency" id="currency" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="USD">USD</option>
                                <option value="EUR">EUR</option>
                                <option value="GBP">GBP</option>
                                <option value="CAD">CAD</option>
                                <option value="AUD">AUD</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="payment_method" class="block text-sm font-medium leading-6 text-gray-900">Payment Method</label>
                        <div class="mt-2">
                            <select wire:model="payment_method" id="payment_method" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="">Select payment method</option>
                                @foreach($payment_methods as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('payment_method') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label for="payment_date" class="block text-sm font-medium leading-6 text-gray-900">Date</label>
                        <div class="mt-2">
                            <input type="date" wire:model="payment_date" id="payment_date" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            @error('payment_date') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium leading-6 text-gray-900">Status</label>
                        <div class="mt-2">
                            <select wire:model="status" id="status" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="{{ \App\Models\Payment::STATUS_PENDING }}">Pending</option>
                                <option value="{{ \App\Models\Payment::STATUS_PROCESSING }}">Processing</option>
                                <option value="{{ \App\Models\Payment::STATUS_COMPLETED }}">Completed</option>
                                <option value="{{ \App\Models\Payment::STATUS_FAILED }}">Failed</option>
                                <option value="{{ \App\Models\Payment::STATUS_REFUNDED }}">Refunded</option>
                                <option value="{{ \App\Models\Payment::STATUS_CANCELLED }}">Cancelled</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="transaction_reference" class="block text-sm font-medium leading-6 text-gray-900">Transaction Reference</label>
                        <div class="mt-2">
                            <input type="text" wire:model="transaction_reference" id="transaction_reference" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                </div>

                <div>
                    <label for="notes" class="block text-sm font-medium leading-6 text-gray-900">Notes</label>
                    <div class="mt-2">
                        <textarea wire:model="notes" id="notes" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                    </div>
                </div>

                <div class="flex justify-end space-x-3">
                    <a href="{{ route('payments.index') }}" class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Cancel</a>
                    <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Save Payment
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>