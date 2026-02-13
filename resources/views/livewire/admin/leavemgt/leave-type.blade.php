<div>
    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">Leave Type Management</h2>
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
                    <li class="text-xs text-default">Leave Type Management</li>

                </ol>
            </nav>
        </div>
        <div class="flex my-xl-auto right-content items-center flex-wrap ">

            <div class="mb-2">
                <a href="#" wire:click="addLeaveType"
                    class="flex items-center bg-primary text-sm font-medium py-2 rounded text-white px-3 hover:bg-primary-900 hover:text-white"><i
                        class="ti ti-circle-plus me-2"></i>Add Leave Type</a>

            </div>

        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Employees List -->
    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white">
        <div
            class="card-header py-4 px-5 border-b border-borderColor flex items-center justify-between flex-wrap gap-3">
            <h5>Leave Type List</h5>

        </div>
        <div class="card-body p-0">
            <div class="overflow-x-auto">
                <table class="table w-full border-b border-borderColor">
                    <thead class="thead-light">
                        <tr>
                            <th
                                class="no-sort text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor hover:outline-none">
                                SL
                            </th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                               Type Name</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Branch</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Annual Limit</th>

                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                  Is Paid</th>

                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-borderColor">
                        @foreach ($leaveTypes as $type)
                            <tr class="even:bg-white dark:even-bg-white">
                                <td class="px-5 py-2.5 text-gray-500" style="text-align: center">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-5 py-2.5 text-gray-900 items-center" style="text-align: center">{{ $type->name }}</td>
                                <td class="px-5 py-2.5 text-gray-500" style="text-align: center">{{ $type->branch->name ?? 'N/A' }}</td>
                                 <td class="px-5 py-2.5 text-gray-900" style="text-align: center">{{ $type->annual_limit }}</td>


                                <td class="px-5 py-2.5 text-gray-500">

                                    <span wire:click="toggleStatus({{ $type->id }})"
                                        class="bg-{{ $type->status === 'active' ? 'success' : 'warning' }} text-white rounded text-[10px] font-medium leading-4 py-0.5 px-1.5 inline-flex items-center badge-xs cursor-pointer">
                                        <i class="ti ti-point-filled me-1"></i>{{ ucfirst($type->status) }}
                                    </span>

                                </td>
                                <td class="px-5 py-2.5 text-gray-500" style="text-align: center">
                                    <div class="action-icon inline-flex">
                                        <button wire:click="addLeaveType({{$type->id}})"
                                            class="me-2 size-[26px] flex items-center justify-center rounded-[5px] hover:bg-light-900 hover:text-gray-900"><i
                                                class="ti ti-edit"></i></button>
                                        <button wire:confirm="Are you sure to delete this roster?"
                                            class="size-[26px] flex items-center justify-center rounded-[5px] hover:bg-light-900 hover:text-gray-900"
                                            wire:click="deleteLeaveType({{ $type->id }})"><i
                                                class="ti ti-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        @if ($leaveTypes->hasPages())
            <div class="card-footer py-4 px-5 border-t border-borderColor">
                {{ $leaveTypes->links() }}
            </div>
        @endif

    </div>
    <!-- /Employees List -->

{{-- @if($typeModalshow)
    <div id="new_custom_policy" class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[1055] justify-center items-center flex-wrap w-full md:inset-0 h-[calc(100%-1rem)] max-h-full transition-all duration-300 ease-in-out modal p-4 flex" aria-modal="true" role="dialog">
			<div class="relative p-4 w-full max-w-[500px] max-h-full" data-select2-id="select2-data-83-85h8">
			  <div class="relative bg-white rounded-defaultradius" data-select2-id="select2-data-82-we2y">
				  <div class="flex items-center justify-between p-4 border-b border-borderColor">
					  <h4 class="font-semibold">New Leave Type</h4>
					  <button type="button" class="end-2.5 text-white bg-gray-500 hover:bg-danger hover:text-white rounded-full text-xs leading-normal size-5 ms-auto inline-flex justify-center items-center" data-modal-hide="new_custom_policy">
						  <i class="ti ti-x" wire:click="closeModal"></i>
						  <span class="sr-only" wire:click="closeModal">Close modal</span>
					  </button>
				  </div>
				  <form wire:submit="saveType">
					  <div class="p-4">

                          <!-- Branch -->
                    <x-form.select
                        label="Select Branch"
                        name="branch_id"
                        :is_required="true"
                        :error="true"
                        :options="$branches" />

                                  <x-form.input
                        label="Name"
                        name="name"
                        :is_required="true"
                        :error="true"
                        type="text" />
                                  <x-form.input
                        label="Annual Limit"
                        name="annual_limit"
                        :is_required="true"
                        :error="true"
                        type="text" />

                           <!-- Status -->
                    <x-form.select
                        label="Status"
                        name="is_paid"
                        :is_required="true"
                        :error="true"
                        :options="['0' => 'Unpaid', '1' => 'Paid']" />

					  </div>
					  <div class="flex items-center justify-end p-4 border-t border-borderColor">
						  <button wire:click="closeModal" data-modal-hide="new_custom_policy" type="button" class="btn bg-light border border-light text-gray-900 text-center hover:bg-light-900 hover:text-gray-900 font-medium me-2">Cancel</button>
						  <button type="submit" class="btn bg-primary border border-primary text-white text-center hover:bg-primary-900 hover:text-white font-medium">Add Leaves</button>
					  </div>
				  </form>
			  </div>
		  </div>
	  </div>

    @endif --}}

      <!-- MODAL -->
    @if($typeModalshow)
    <div
        class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[1055] justify-center items-center flex-wrap w-full md:inset-0 h-[calc(100%-1rem)] max-h-full transition-all duration-300 ease-in-out modal p-4 flex bg-black bg-opacity-50"
        aria-modal="true"
        role="dialog"
        x-data
        x-on:keydown.escape.window="Livewire.emit('closeModal')"
    >
        <div class="relative p-4 w-full max-w-[500px] max-h-full">
            <div class="relative bg-white rounded-defaultradius shadow-lg">
                <!-- Header -->
                <div class="flex items-center justify-between p-4 border-b border-borderColor">
                    <h4 class="font-semibold text-lg">
                        {{ $leaveTypeId ? 'Edit Leave Type' : 'New Leave Type' }}
                    </h4>
                    <button
                        type="button"
                        wire:click="closeModal"
                        class="end-2.5 text-gray-500 hover:bg-danger hover:text-white rounded-full text-xs leading-normal size-5 ms-auto inline-flex justify-center items-center"
                        aria-label="Close modal">
                        <i class="ti ti-x"></i>
                    </button>
                </div>

                <!-- Form -->
                <form wire:submit.prevent="saveType">
                    <div class="p-4 space-y-4">
                        <!-- Branch -->
                        <x-form.select
                            label="Select Branch"
                            name="branch_id"
                            :is_required="true"
                            :error="true"
                            :options="$branches"
                            wire:model="branch_id" />

                        <!-- Name -->
                        <x-form.input
                            label="Name"
                            name="name"
                            :is_required="true"
                            :error="true"
                            type="text"
                            wire:model="name"
                            placeholder="e.g., Annual Leave, Sick Leave" />

                        <!-- Annual Limit -->
                        <x-form.input
                            label="Annual Limit (Days)"
                            name="annual_limit"
                            :is_required="true"
                            :error="true"
                            type="number"
                            min="0"
                            max="365"
                            wire:model="annual_limit"
                            placeholder="e.g., 14" />

                        <!-- Status -->
                        <x-form.select
                            label="Type"
                            name="is_paid"
                            :is_required="true"
                            :error="true"
                            :options="['0' => 'Unpaid', '1' => 'Paid']"
                            wire:model="is_paid" />
                    </div>

                    <!-- Footer -->
                    <div class="flex items-center justify-end p-4 border-t border-borderColor space-x-2">
                        <button
                            wire:click="closeModal"
                            type="button"
                            class="btn bg-light border border-light text-gray-900 text-center hover:bg-light-900 hover:text-gray-900 font-medium">
                            Cancel
                        </button>
                        <button
                            type="submit"
                            class="btn bg-primary border border-primary text-white text-center hover:bg-primary-900 hover:text-white font-medium"
                            wire:loading.attr="disabled">
                            <span wire:loading.remove>
                                {{ $leaveTypeId ? 'Update' : 'Add' }}
                            </span>
                            <span wire:loading>
                                <i class="ti ti-loader animate-spin me-1"></i> Saving...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    <!-- Flash Messages -->
    @if (session()->has('success'))
        <div class="fixed top-4 right-4 z-[1100] bg-green-500 text-white px-6 py-3 rounded shadow-lg">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="fixed top-4 right-4 z-[1100] bg-red-500 text-white px-6 py-3 rounded shadow-lg">
            {{ session('error') }}
        </div>
    @endif
</div>
