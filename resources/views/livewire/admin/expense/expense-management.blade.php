<div x-data="{ modalOpen: false }">
    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">Expense</h2>
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}"
                            class="inline-flex items-center text-xs text-gray-500 hover:text-primary">
                            <i class="ti ti-smart-home"></i>
                        </a>
                    </li>
                    <li>
                        <span class="text-default">/</span>
                    </li>
                    <li class="text-xs text-default">Expense</li>

                </ol>
            </nav>
        </div>
        <div class="flex my-xl-auto right-content items-center flex-wrap gap-2">
            <div class="mb-2">
                <a href="{{ route('admin.expenses.type') }}"
                    class="flex items-center bg-primary text-sm font-medium py-2 rounded text-white px-3 hover:bg-primary-900 hover:text-white">Expense Type</a>
            </div>
            <div class="mb-2">
                <button @click="modalOpen = true; $wire.resetForm()" class="btn btn-primary"><i
                        class="ti ti-circle-plus me-2"></i> Add Expense </button>
            </div>

        </div>
    </div>

    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white">
        <div
            class="card-header py-4 px-5 border-b border-borderColor flex items-center justify-between flex-wrap gap-3">
            <h5>Expense List</h5>
        </div>
        <div class="card-body p-0">
            <div class="overflow-x-auto">

                <table class="w-full table-auto border">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2">#</th>
                            <th class="px-4 py-2">Branch</th>
                            <th class="px-4 py-2">Type</th>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Amount</th>
                            <th class="px-4 py-2">Date</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($expenses as $exp)
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2">{{ $exp->branch->name }}</td>
                                <td class="px-4 py-2">{{ $exp->type->name }}</td>
                                <td class="px-4 py-2">{{ $exp->name }}</td>
                                <td class="px-4 py-2">{{ number_format($exp->amount, 2) }}</td>
                                <td class="px-4 py-2">{{ $exp->date->format('d-M-Y') }}</td>
                                <td class="px-4 py-2 space-x-2">
                                    <button wire:click="editExpense({{ $exp->id }})" @click="modalOpen = true"
                                        class="btn btn-warning btn-sm">Edit</button>
                                    <button wire:click="deleteExpense({{ $exp->id }})"
                                        onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                                        class="btn btn-danger btn-sm">Delete</button>
                                    <a href="{{ route('admin.expenses.show', $exp->id) }}"
                                        class="btn btn-info btn-sm">Details</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-2">
                    {{ $expenses->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div x-show="modalOpen" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50" x-cloak>
        <div class="bg-white rounded p-6 w-full max-w-md" @click.away="modalOpen = false">
            <h3 class="text-lg font-semibold mb-4">{{ $isEditMode ? 'Edit Expense' : 'Add Expense' }}</h3>
            <div class="space-y-2">

                <x-form.select label="Select Expense Type" name="expense_type_id" :isRequired="true" :options="$types"
                    placeholder="Select Expense Type" :live="true" />

                <x-form.input label="Expense Name" name="name" :isRequired="true" placeholder="Enter Expense Name" />

                <x-form.input label="Amount" name="amount" :isRequired="true" type="number"
                    placeholder="Enter Amount" />

                <x-form.textarea label="Note/Add Comment" name="note" :isRequired="false" type="text"
                    placeholder="Note/Comment" />

                <x-form.input label="Date" name="date" :isRequired="true" type="date"
                    placeholder="Select Date" />
            </div>

            <div class="mt-4 flex justify-end space-x-2">
                <button type="button" @click="modalOpen = false" class="btn btn-light">Close</button>
                <button wire:click="saveExpense" class="btn btn-primary">{{ $isEditMode ? 'Update' : 'Save' }}</button>
            </div>
        </div>
    </div>
</div>
