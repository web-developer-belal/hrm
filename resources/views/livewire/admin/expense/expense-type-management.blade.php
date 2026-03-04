<div x-data="{ modalOpen: false }" x-window:close-modal="modalOpen = false">
    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">Expense Types</h2>
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
                    <li class="text-xs text-default">Expense Types</li>

                </ol>
            </nav>
        </div>
        <div class="flex my-xl-auto right-content items-center flex-wrap gap-2">
            <div class="mb-2">
                <button @click="modalOpen = true; $wire.resetForm()" class="btn btn-primary">Add Expense Type</button>
            </div>

        </div>
    </div>

    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white">
        <div
            class="card-header py-4 px-5 border-b border-borderColor flex items-center justify-between flex-wrap gap-3">
            <h5>Expense Type List</h5>
        </div>
        <div class="card-body p-0">
            <div class="overflow-x-auto">
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
                        @foreach ($types as $type)
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2">{{ $type->branch->name }}</td>
                                <td class="px-4 py-2">{{ $type->name }}</td>
                                <td class="px-4 py-2 space-x-2">
                                    <button wire:click="editType({{ $type->id }})" @click="modalOpen = true"
                                        class="btn btn-sm btn-warning">Edit</button>
                                    <button wire:click="deleteType({{ $type->id }})"
                                        onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                                        class="btn btn-sm btn-danger">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-2">
                    {{ $types->links() }}
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div x-show="modalOpen" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
            <div class="bg-white rounded p-6 w-full max-w-md" @click.away="modalOpen = false">
                <h3 class="text-lg font-semibold mb-4">
                    {{ $isEditMode ? 'Edit Expense Type' : 'Add Expense Type' }}</h3>
                <div class="space-y-2">
                    <x-form.select label="Select Branch" name="branch_id" :isRequired="true" :live="true"
                        :search="true" :options="$branch_id_options" placeholder="Select Branch" />

                    <x-form.input label="Type Name" name="name" :isRequired="true" placeholder="Enter Type Name" />
                </div>

                <div class="mt-4 flex justify-end space-x-2">
                    <button type="button" @click="modalOpen = false" class="btn btn-light">Close</button>
                    <button wire:click="saveType" class="btn btn-primary">{{ $isEditMode ? 'Update' : 'Save' }}</button>
                </div>
            </div>
        </div>
    </div>

</div>
