<div x-data="{ modalOpen: false }" @close-modal.window="modalOpen = false">
    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">Groups</h2>
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
                    <li class="text-xs text-default">Groups</li>

                </ol>
            </nav>
        </div>
        <div class="flex my-xl-auto right-content items-center flex-wrap gap-2">

            <div class="mb-2">
                <button @click="modalOpen = true; $wire.resetForm()" class="btn btn-primary"><i
                        class="ti ti-circle-plus me-2"></i> Create Group</button>
            </div>

        </div>
    </div>

    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white">
        <div
            class="card-header py-4 px-5 border-b border-borderColor flex items-center justify-between flex-wrap gap-3">
            <h5>Group List</h5>
        </div>
        <div class="card-body p-0">
            <div class="overflow-x-auto">
                <table class="w-full table-auto border">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2">#</th>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Branch</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($groups as $group)
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2">{{ $group->name }}</td>
                                <td class="px-4 py-2">
                                    <div class="flex gap-2">

                                        @foreach ($group->branches->take(3) as $branch)
                                            <span
                                                class="inline-block bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded mb-1">{{ $branch->name }}</span>
                                        @endforeach
                                        @if ($group->branches->count() > 3)
                                            <span class="text-xs text-gray-500">+{{ $group->branches->count() - 3 }}
                                                more</span>
                                        @endif

                                    </div>
                                </td>
                                <td class="px-4 py-2 space-x-2">
                                    <div class="flex">
                                        <button wire:click="editGroup({{ $group->id }})" @click="modalOpen = true"
                                            class="me-2 size-[26px] flex items-center justify-center rounded-[5px] hover:bg-light-900 hover:text-gray-900"><i
                                                class="ti ti-edit"></i></button>
                                        <button wire:confirm="Are you sure to delete this group?"
                                            class="size-[26px] flex items-center justify-center rounded-[5px] hover:bg-light-900 hover:text-gray-900"
                                            wire:click="deleteGroup({{ $group->id }})"><i
                                                class="ti ti-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-2">
                    {{ $groups->links() }}
                </div>
            </div>
        </div>

       
    </div>
 <!-- Modal -->
        <div x-show="modalOpen" class="fixed inset-0 flex items-center justify-center z-50 bg-black/50">
            <div class="bg-white rounded p-6 w-full max-w-md" @click.away="modalOpen = false">
                <h3 class="text-lg font-semibold mb-4">
                    {{ $isEditMode ? 'Edit Group' : 'Add Group' }}</h3>
                <div class="space-y-2">
                    <x-form.select label="Select Branch" name="branches" :isMultiple="true" :search="true"
                        :options="$branches_options" placeholder="Select Branch" />

                    <x-form.input label="Group Name" name="name" :isRequired="true" placeholder="Enter Group Name" />
                </div>

                <div class="mt-4 flex justify-end space-x-2">
                    <button type="button" @click="modalOpen = false" class="btn btn-light">Close</button>
                    <button wire:click="saveGroup"
                        class="btn btn-primary">{{ $isEditMode ? 'Update' : 'Save' }}</button>
                </div>
            </div>
        </div>
</div>
