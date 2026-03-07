<div x-data="{
    selectedEmployees: @entangle('selectedEmployees'),
    selectAll: false,
    toggleAll() {
        if (this.selectAll) {
            this.selectedEmployees = @json($employees->pluck('id')->toArray());
        } else {
            this.selectedEmployees = [];
        }
    }
}">
    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">Employee Management</h2>
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
                    <li class="text-xs text-default">Employee Management</li>

                </ol>
            </nav>
        </div>
        <div class="flex my-xl-auto right-content items-center flex-wrap gap-2">
            <div class="mb-2" x-show="selectedEmployees.length > 0" x-cloak>
                <button wire:click="exportEmployees" type="button"
                    class="flex items-center bg-success text-sm font-medium py-2 rounded text-white px-3 hover:bg-success-900 hover:text-white">
                    <i class="ti ti-file-export me-2"></i>Export Selected (<span x-text="selectedEmployees.length"></span>)
                </button>
            </div>
            <div class="mb-2">
                <a href="{{ route('admin.employees.create') }}"
                    class="flex items-center bg-primary text-sm font-medium py-2 rounded text-white px-3 hover:bg-primary-900 hover:text-white"><i
                        class="ti ti-circle-plus me-2"></i>Add Employee</a>
            </div>

        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Employees List -->
    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white">
        <div
            class="card-header py-4 px-5 border-b border-borderColor flex items-center justify-between flex-wrap gap-3 ">
            <h5>Employee List</h5>
            <div class="my-xl-auto right-content grid grid-cols-1 md:grid-cols-3 gap-3">
                <div class="">
                    <x-form.input name="search" placeholder="Search here .." :live="true" />
                </div>
                <div class="">
                    <x-form.select name="branch" placeholder="Select branch" :live="true" :option="$branch_options" :search="true" />
                </div>
                <div class="">
                    <x-form.select name="departments" placeholder="Select department" :live="true"
                        :option="$departments_options" :isMultiple="true" :search="true" />
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="overflow-x-auto">
                <table class="table w-full border-b border-borderColor">
                    <thead class="thead-light">
                        <tr>
                            <th
                                class="no-sort text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor hover:outline-none">
                                <input type="checkbox" x-model="selectAll" @change="toggleAll()"
                                    class="rounded border-gray-300 text-primary focus:ring-primary">
                            </th>
                            <th
                                class="no-sort text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor hover:outline-none">
                                SL
                            </th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Emp ID</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Employee info</th>

                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Branch</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Department</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Joining Date</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Status</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Action
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-borderColor">
                        @foreach ($employees as $emp)
                            <tr class="even:bg-white dark:even-bg-white">
                                <td class="px-5 py-2.5 text-gray-500">
                                    <input type="checkbox" value="{{ $emp->id }}" x-model="selectedEmployees"
                                        class="rounded border-gray-300 text-primary focus:ring-primary">
                                </td>
                                <td class="px-5 py-2.5 text-gray-500">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-5 py-2.5 text-gray-500">
                                    {{ $emp->employee_code }}
                                </td>
                                <td class="px-5 py-2.5 text-gray-500 p-3">
                                    <div class="flex items-center file-name-icon">
                                        <a href="{{ route('admin.employees.details', ['emp' => $emp->id]) }}"
                                            class="size-8 rounded-full border border-borderColor">
                                            <img src="{{ customAsset($emp->photo, true, 'emp', $emp->first_name) }}"
                                                class="rounded-full size-8 img-fluid" alt="img">
                                        </a>
                                        <div class="ms-2 flex flex-col gap-1">
                                            <h6 class="font-medium"><a
                                                    href="{{ route('admin.employees.details', ['emp' => $emp->id]) }}"
                                                    class="text-gray-900 hover:text-primary">{{ $emp->full_name }}</a>
                                            </h6>
                                            <span class="text-xs leading-normal"> {{ $emp->designation->name }}</span>
                                            <span class="text-xs leading-normal"> {{ $emp->email }}</span>
                                            <span class="text-xs leading-normal"> {{ $emp->contact_number }}</span>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-5 py-2.5 text-gray-500">
                                    {{ $emp->branch->name }}
                                </td>
                                <td class="px-5 py-2.5 text-gray-500">
                                    {{ $emp->department->name }}
                                </td>
                                <td class="px-5 py-2.5 text-gray-500">
                                    {{ $emp->joining_date->format('d-M-Y') }}
                                </td>

                                <td class="px-5 py-2.5 text-gray-500">

                                    <span wire:click="statusToggle({{ $emp->id }})"
                                        class="bg-{{ $emp->status == 1 ? 'success' : 'warning' }} text-white rounded text-[10px] font-medium leading-4 py-0.5 px-1.5 inline-flex items-center badge-xs cursor-pointer">
                                        <i class="ti ti-point-filled me-1">
                                            {{ $emp->status == 1 ? 'Active' : 'Deactive' }}</i>
                                    </span>

                                </td>


                                <td class="px-5 py-2.5 text-gray-500">
                                    <div class="action-icon inline-flex">
                                        <a href="{{ route('admin.employees.edit', ['emp' => $emp->id]) }}"
                                            class="me-2 size-[26px] flex items-center justify-center rounded-[5px] hover:bg-light-900 hover:text-gray-900"><i
                                                class="ti ti-edit"></i></a>
                                      
                                        <a href="{{ route('admin.employees.details', ['emp' => $emp->id]) }}"
                                            class="me-2 size-[26px] flex items-center justify-center rounded-[5px] hover:bg-light-900 hover:text-gray-900"><i
                                                class="ti ti-eye"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>
        </div>
        @if ($employees->hasPages())
            <div class="card-footer py-4 px-5 border-t border-borderColor">
                {{ $employees->links() }}
            </div>
        @endif

    </div>
    <!-- /Employees List -->
</div>
