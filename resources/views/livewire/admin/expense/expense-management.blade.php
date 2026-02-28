<div x-data="{ modalOpen: false }">
    <div class="flex justify-between mb-4">
        <h2 class="font-bold text-lg">Expenses</h2>
        <div class="flex gap-2">

       
        <a href="{{ route('admin.expenses.type') }}"  class="btn btn-secondary"> Expense Type</a>
        <button @click="modalOpen = true; $wire.resetForm()" class="btn btn-primary">Add Expense</button>
         </div>
    </div>

    @if(session()->has('success'))
        <div class="text-green-600 mb-2">{{ session('success') }}</div>
    @endif

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
            @foreach($expenses as $exp)
            <tr class="border-b">
                <td class="px-4 py-2">{{ $loop->iteration }}</td>
                <td class="px-4 py-2">{{ $exp->branch->name }}</td>
                <td class="px-4 py-2">{{ $exp->type->name }}</td>
                <td class="px-4 py-2">{{ $exp->name }}</td>
                <td class="px-4 py-2">{{ number_format($exp->amount,2) }}</td>
                <td class="px-4 py-2">{{ $exp->date->format('d M Y') }}</td>
                <td class="px-4 py-2 space-x-2">
                    <button wire:click="editExpense({{ $exp->id }})" @click="modalOpen = true" class="btn btn-warning btn-sm">Edit</button>
                    <button wire:click="deleteExpense({{ $exp->id }})" onclick="confirm('Are you sure?') || event.stopImmediatePropagation()" class="btn btn-danger btn-sm">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-2">
        {{ $expenses->links() }}
    </div>

    <!-- Modal -->
    <div x-show="modalOpen" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50" x-cloak>
        <div class="bg-white rounded p-6 w-full max-w-md" @click.away="modalOpen = false">
            <h3 class="text-lg font-semibold mb-4">{{ $isEditMode ? 'Edit Expense' : 'Add Expense' }}</h3>
            <div class="space-y-2">
                <label>Branch</label>
                <select wire:model.live="branch_id" class="w-full border p-2">
                    @foreach($branches as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
                @error('branch_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                <label>Expense Type</label>
                <select wire:model="expense_type_id" class="w-full border p-2">
                    @foreach($types as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
                @error('expense_type_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                <label>Name</label>
                <input type="text" wire:model="name" class="w-full border p-2"/>
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                <label>Amount</label>
                <input type="number" wire:model="amount" class="w-full border p-2"/>
                @error('amount') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                <label>Date</label>
                <input type="date" wire:model="date" class="w-full border p-2"/>
                @error('date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mt-4 flex justify-end space-x-2">
                <button type="button" @click="modalOpen = false" class="btn btn-light">Close</button>
                <button wire:click="saveExpense" class="btn btn-primary">{{ $isEditMode ? 'Update' : 'Save' }}</button>
            </div>
        </div>
    </div>
</div>