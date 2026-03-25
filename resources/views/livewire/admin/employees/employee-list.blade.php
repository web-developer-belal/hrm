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
            <div class="mb-2 flex gap-2 items-center">
                <div x-data="{ openOtDropdown: false }" class="relative inline-block">
                    <button x-bind:disabled="selectedEmployees.length === 0" type="button" @click="openOtDropdown = !openOtDropdown"
                        class="flex items-center bg-warning text-sm font-medium py-2 rounded text-white px-3 hover:bg-warning-900 hover:text-white">
                        <i class="ti ti-user-cog me-2"></i>Update OT
                        <i class="ti ti-chevron-down ms-1"></i>
                    </button>

                    <div x-show="openOtDropdown" @click.outside="openOtDropdown = false" x-transition
                        class="absolute left-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-borderColor z-10">
                        <button wire:click="updateOt(1)" @click="openOtDropdown = false"
                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="ti ti-check me-2 text-success"></i>Add To OT
                        </button>
                        <button wire:click="updateOt(0)" @click="openOtDropdown = false"
                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 border-t border-borderColor">
                            <i class="ti ti-x me-2 text-danger"></i>Remove From OT
                        </button>
                    </div>
                </div>
                <button wire:click="exportEmployees" x-bind:disabled="selectedEmployees.length === 0" type="button"
                    class="flex items-center bg-success text-sm font-medium py-2 rounded text-white px-3 hover:bg-success-900 hover:text-white">
                    <i class="ti ti-file-export me-2"></i>Export Selected (<span
                        x-text="selectedEmployees.length"></span>)
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
                    <x-form.select name="branch" placeholder="Select branch" :live="true" :option="$branch_options"
                        :search="true" />
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
                                Has Ot</th>
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
                                            <span class="bg-success text-white rounded text-[10px] font-medium leading-4 py-0.5 px-1.5 inline-flex items-center badge-xs w-fit"> {{ $emp->designation->name }}</span>
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

                                    <span wire:click="otToggle({{ $emp->id }})"
                                        class="bg-{{ $emp->has_ot ? 'success' : 'warning' }} text-white rounded text-[10px] font-medium leading-4 py-0.5 px-1.5 inline-flex items-center badge-xs cursor-pointer">
                                        <i class="ti ti-point-filled me-1">
                                            {{ $emp->has_ot ? 'Yes' : 'No' }}</i>
                                    </span>

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
                                        <button type="button" wire:click="openSalaryModal({{ $emp->id }})"
                                            class="me-2 size-6.5 flex items-center justify-center rounded-[5px] hover:bg-light-900 hover:text-gray-900"
                                            title="Setup Salary">
                                            <i class="ti ti-cash"></i>
                                        </button>

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

    <!-- Salary Setup Modal -->
    <div id="salarySetupModal"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 opacity-0 pointer-events-none transition-opacity duration-200">
        <div data-modal-overlay class="absolute inset-0 bg-black/50"></div>

        <div id="salarySetupPanel"
            class="relative bg-white rounded-lg shadow-xl w-full max-w-4xl salary-modal-panel-max overflow-hidden transform scale-95 translate-y-3 transition-all duration-200">
            @include('livewire.admin.employees.partials.salary-modal-content', [
                'submitAction' => 'saveSalary',
                'cancelAction' => 'closeSalaryModal',
                'employeeName' => $salaryEmployeeName ?: 'Select an employee',
            ])
        </div>
    </div>

    <script>
        (function() {
            if (window.__employeeSalaryModalInit) {
                return;
            }
            window.__employeeSalaryModalInit = true;

            var modal = document.getElementById('salarySetupModal');
            var panel = document.getElementById('salarySetupPanel');
            if (!modal || !panel) {
                return;
            }

            var isOpen = false;

            function openModal() {
                if (isOpen) {
                    return;
                }
                isOpen = true;

                modal.classList.remove('pointer-events-none', 'opacity-0');
                requestAnimationFrame(function() {
                    panel.classList.remove('scale-95', 'translate-y-3');
                });
                document.body.classList.add('overflow-hidden');
            }

            function closeModal() {
                if (!isOpen) {
                    return;
                }

                panel.classList.add('scale-95', 'translate-y-3');
                modal.classList.add('opacity-0');

                window.setTimeout(function() {
                    modal.classList.add('pointer-events-none');
                    isOpen = false;
                    document.body.classList.remove('overflow-hidden');
                }, 200);
            }

            modal.addEventListener('click', function(event) {
                if (event.target.hasAttribute('data-modal-overlay') || event.target.hasAttribute('data-close-modal')) {
                    closeModal();
                }
            });

            window.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    closeModal();
                }
            });

            window.addEventListener('open-salary-modal', openModal);
            window.addEventListener('close-salary-modal', closeModal);
        })();
    </script>
</div>
@push('css')
    <style>
        .salary-modal-panel-max {
            max-height: 90vh;
        }

        .salary-modal-form-scroll {
            max-height: calc(90vh - 130px);
        }
    </style>
@endpush
