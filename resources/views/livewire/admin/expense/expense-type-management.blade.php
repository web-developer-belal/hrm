<div x-data="{ modalOpen: false }">
    <div class="flex justify-between mb-4">
        <h2 class="font-bold text-lg">Expense Types</h2>
        <button @click="modalOpen = true; $wire.resetForm()" class="btn btn-primary">Add Expense Type</button>
    </div>

    @if (session()->has('success'))
        <div class="text-green-600 mb-2">{{ session('success') }}</div>
    @endif

    <table class="w-full table-auto border">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2">#</th>
                <th class="px-4 py-2">Branch</th>
                <th class="px-4 py-2">Type Name</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($types as $type)
            <tr class="border-b">
                <td class="px-4 py-2">{{ $loop->iteration }}</td>
                <td class="px-4 py-2">{{ $type->branch->name }}</td>
                <td class="px-4 py-2">{{ $type->name }}</td>
                <td class="px-4 py-2 space-x-2">
                    <button wire:click="editType({{ $type->id }})" @click="modalOpen = true" class="btn btn-sm btn-warning">Edit</button>
                    <button wire:click="deleteType({{ $type->id }})" onclick="confirm('Are you sure?') || event.stopImmediatePropagation()" class="btn btn-sm btn-danger">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-2">
        {{ $types->links() }}
    </div>

    <!-- Modal -->
    <div x-show="modalOpen" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
        <div class="bg-white rounded p-6 w-full max-w-md" @click.away="modalOpen = false">
            <h3 class="text-lg font-semibold mb-4">{{ $isEditMode ? 'Edit Expense Type' : 'Add Expense Type' }}</h3>
            <div class="space-y-2">
                <label>Branch</label>
                <select wire:model="branch_id" class="w-full border p-2">
                    @foreach($branches as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
                @error('branch_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                <label>Type Name</label>
                <input type="text" wire:model="name" class="w-full border p-2"/>
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mt-4 flex justify-end space-x-2">
                <button type="button" @click="modalOpen = false" class="btn btn-light">Close</button>
                <button wire:click="saveType" class="btn btn-primary">{{ $isEditMode ? 'Update' : 'Save' }}</button>
            </div>
        </div>
    </div>
</div>