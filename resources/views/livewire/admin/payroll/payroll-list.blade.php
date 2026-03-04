<div>
    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">Payroll Management</h2>
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
                    <li class="text-xs text-default">Payroll Management</li>

                </ol>
            </nav>
        </div>
        <div class="flex my-xl-auto right-content items-center flex-wrap ">
            <div class="mb-2">
                <button wire:click="exportSelected" wire:loading.attr="disabled"
                    class="flex items-center bg-primary text-sm font-medium py-2 rounded text-white px-3 hover:bg-primary-900 hover:text-white"><i
                        class="ti ti-circle-plus me-2"></i>Export</button>
            </div>

        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Employees List -->
    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white">
        <div
            class="card-header py-4 px-5 border-b border-borderColor flex items-center justify-between flex-wrap gap-3">
            <h5>Payroll List</h5>
            <div class="flex my-xl-auto right-content items-center flex-wrap gap-3">
                <div class="me-3">
                    <x-form.input name="search" placeholder="Search here" :live="true" />
                </div>
                <div class="me-3">
                    <x-form.select name="branch" placeholder="Select branch" :live="true" :option="$branch_options"
                        :search="true" />
                </div>
                <div class="me-3">
                    <x-form.select class="w-fit" name="perPage" :live="true" :options="['10' => '10', '25' => '25', '50' => '50', '100' => '100']" />
                </div>
            </div>
        </div>
        <div class="card-body p-0" x-data="{ expandedRows: [], selectedPayroll: @entangle('selectedPayroll').live }">
            <div class="px-5 py-3 bg-primary-50 border-b border-borderColor" x-show="selectedPayroll.length > 0" x-cloak>
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-primary">
                        <i class="fas fa-check-circle mr-2"></i>
                        <span x-text="selectedPayroll.length"></span> payroll(s) selected
                    </span>
                    <button @click="selectedPayroll = []" class="text-sm text-danger hover:text-danger-dark">
                        <i class="fas fa-times-circle mr-1"></i> Clear Selection
                    </button>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="table w-full border-b border-borderColor" wire:loading.class="opacity-50">
                    <thead>
                        <tr>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                            </th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                <input type="checkbox" 
                                    @change="$event.target.checked ? selectedPayroll = @js($payrolls->pluck('id')->toArray()) : selectedPayroll = []"
                                    :checked="selectedPayroll.length === {{ $payrolls->count() }} && {{ $payrolls->count() }} > 0"
                                    class="rounded border-gray-300 text-primary focus:ring-primary">
                            </th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                SL</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Emp ID</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Name</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Branch</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Year</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Month</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Gross Salary</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Net Salary</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Lock</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Approval</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Status</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-borderColor" wire:loading.class="opacity-50" >
                        @foreach ($payrolls as $pay)
                            {{-- Main Row --}}
                            <tr class="hover:bg-gray-50" :class="{ 'bg-primary-50': selectedPayroll.includes({{ $pay->id }}) }">
                                <td class="px-5 py-2.5 text-gray-500">
                                    <button type="button" @click="expandedRows.includes({{ $pay->id }}) ? expandedRows = expandedRows.filter(id => id !== {{ $pay->id }}) : expandedRows.push({{ $pay->id }})"
                                        class="text-gray-600 hover:text-primary">
                                        <i class="fas" :class="expandedRows.includes({{ $pay->id }}) ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                                    </button>
                                </td>
                                <td class="px-5 py-2.5 text-gray-500" @click.stop>
                                    <input type="checkbox" 
                                        :value="{{ $pay->id }}" 
                                        x-model="selectedPayroll"
                                        class="rounded border-gray-300 text-primary focus:ring-primary">
                                </td>
                                <td class="px-5 py-2.5 text-gray-500 cursor-pointer" @click="expandedRows.includes({{ $pay->id }}) ? expandedRows = expandedRows.filter(id => id !== {{ $pay->id }}) : expandedRows.push({{ $pay->id }})">{{ $payrolls->firstItem() + $loop->index }}</td>
                                <td class="px-5 py-2.5 text-gray-500 cursor-pointer" @click="expandedRows.includes({{ $pay->id }}) ? expandedRows = expandedRows.filter(id => id !== {{ $pay->id }}) : expandedRows.push({{ $pay->id }})">{{ $pay->employee->employee_code }}</td>
                                <td class="px-5 py-2.5 text-gray-500 p-3 cursor-pointer" @click="expandedRows.includes({{ $pay->id }}) ? expandedRows = expandedRows.filter(id => id !== {{ $pay->id }}) : expandedRows.push({{ $pay->id }})">
                                    <div class="flex items-center file-name-icon">
                                        <a href="{{ route('admin.employees.details', ['emp' => $pay->id]) }}"
                                            class="size-8 rounded-full border border-borderColor">
                                            <img src="{{ customAsset($pay->employee->photo, true, 'emp', $pay->employee->first_name) }}"
                                                class="rounded-full size-8 img-fluid" alt="img">
                                        </a>
                                        <div class="ms-2">
                                            <h6 class="font-medium"><a
                                                    href="{{ route('admin.employees.details', ['emp' => $pay->id]) }}"
                                                    class="text-gray-900 hover:text-primary">{{ $pay->employee->first_name . ' ' . $pay->employee->last_name }}</a>
                                            </h6>
                                            <span class="text-xs leading-normal">
                                                {{ $pay->employee->designation->name }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-2.5 text-gray-500 cursor-pointer" @click="expandedRows.includes({{ $pay->id }}) ? expandedRows = expandedRows.filter(id => id !== {{ $pay->id }}) : expandedRows.push({{ $pay->id }})">
                                    {{ $pay->branch->name ?? $pay->employee->branch->name }}</td>
                                <td class="px-5 py-2.5 text-gray-500 cursor-pointer" @click="expandedRows.includes({{ $pay->id }}) ? expandedRows = expandedRows.filter(id => id !== {{ $pay->id }}) : expandedRows.push({{ $pay->id }})">{{ $pay->year }}</td>
                                <td class="px-5 py-2.5 text-gray-500 cursor-pointer" @click="expandedRows.includes({{ $pay->id }}) ? expandedRows = expandedRows.filter(id => id !== {{ $pay->id }}) : expandedRows.push({{ $pay->id }})">
                                    {{ \Carbon\Carbon::create()->month($pay->month)->format('F') }}</td>
                                <td class="px-5 py-2.5 text-gray-500 font-semibold cursor-pointer" @click="expandedRows.includes({{ $pay->id }}) ? expandedRows = expandedRows.filter(id => id !== {{ $pay->id }}) : expandedRows.push({{ $pay->id }})">
                                    {{ number_format($pay->gross_salary, 2) }}</td>
                                <td class="px-5 py-2.5 text-primary font-semibold cursor-pointer" @click="expandedRows.includes({{ $pay->id }}) ? expandedRows = expandedRows.filter(id => id !== {{ $pay->id }}) : expandedRows.push({{ $pay->id }})">
                                    {{ number_format($pay->net_salary, 2) }}</td>
                                <td class="px-5 py-2.5 text-gray-500 cursor-pointer" @click="expandedRows.includes({{ $pay->id }}) ? expandedRows = expandedRows.filter(id => id !== {{ $pay->id }}) : expandedRows.push({{ $pay->id }})">
                                    @if ($pay->is_locked)
                                        <span
                                            class="inline-flex items-center py-1 px-2 rounded text-xs leading-none font-semibold bg-danger-100 text-danger">Locked</span>
                                    @else
                                        <span
                                            class="inline-flex items-center py-1 px-2 rounded text-xs leading-none font-semibold bg-success-100 text-success">Unlocked</span>
                                    @endif
                                </td>
                                <td class="px-5 py-2.5 text-gray-500 cursor-pointer" @click="expandedRows.includes({{ $pay->id }}) ? expandedRows = expandedRows.filter(id => id !== {{ $pay->id }}) : expandedRows.push({{ $pay->id }})">
                                    @switch($pay->approval_stage)
                                        @case(0)
                                            <span
                                                class="inline-flex items-center py-1 px-2 rounded text-xs leading-none font-semibold bg-secondary-100 text-secondary">Pending</span>
                                        @break

                                        @case(1)
                                            <span
                                                class="inline-flex items-center py-1 px-2 rounded text-xs leading-none font-semibold bg-warning-100 text-warning">Stage
                                                1</span>
                                        @break

                                        @case(2)
                                            <span
                                                class="inline-flex items-center py-1 px-2 rounded text-xs leading-none font-semibold bg-info-100 text-info">Stage
                                                2</span>
                                        @break

                                        @case(3)
                                            <span
                                                class="inline-flex items-center py-1 px-2 rounded text-xs leading-none font-semibold bg-success-100 text-success">Approved</span>
                                        @break

                                        @default
                                            <span
                                                class="inline-flex items-center py-1 px-2 rounded text-xs leading-none font-semibold bg-secondary-100 text-secondary">N/A</span>
                                    @endswitch
                                </td>
                                <td class="px-5 py-2.5 text-gray-500 cursor-pointer" @click="expandedRows.includes({{ $pay->id }}) ? expandedRows = expandedRows.filter(id => id !== {{ $pay->id }}) : expandedRows.push({{ $pay->id }})">
                                    {{ $pay->status == 1 ? 'Active' : 'Inactive' }}
                                </td>
                                <td class="px-5 py-2.5" @click.stop>
                                    <button @if ($pay->status === 1) checked @endif
                                        wire:click="statusToggle({{ $pay->id }})"
                                        wire:confirm="Are you sure you want to change the status of this payroll?"
                                        class="size-[26px] flex items-center justify-center rounded-[5px] hover:bg-light-900 hover:text-gray-900">
                                        <i
                                            class="fas fa-toggle-{{ $pay->status === 1 ? 'on text-success' : 'off text-secondary' }}"></i>
                                    </button>
                                </td>
                            </tr>

                            {{-- Expandable Detail Row --}}
                            <tr x-show="expandedRows.includes({{ $pay->id }})" x-transition class="bg-gray-50">
                                <td colspan="14" class="px-5 py-4">
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                                        {{-- Salary Components --}}
                                        <div class="bg-white p-4 rounded-lg shadow-sm border border-borderColor">
                                            <h6 class="font-semibold text-gray-800 mb-3 pb-2 border-b">💰 Salary
                                                Components</h6>
                                            <div class="space-y-2 text-sm">
                                                <div class="flex justify-between">
                                                    <span class="text-gray-600">Basic Salary:</span>
                                                    <span
                                                        class="font-medium">{{ number_format($pay->employee->salaryData->basic_salary ?? 0, 2) }}</span>
                                                </div>
                                                <div class="flex justify-between">
                                                    <span class="text-gray-600">House Rent:</span>
                                                    <span
                                                        class="font-medium">{{ number_format($pay->employee->salaryData->house_rent ?? 0, 2) }}</span>
                                                </div>
                                                <div class="flex justify-between">
                                                    <span class="text-gray-600">Medical Allowance:</span>
                                                    <span
                                                        class="font-medium">{{ number_format($pay->employee->salaryData->medical_allowance ?? 0, 2) }}</span>
                                                </div>
                                                <div class="flex justify-between">
                                                    <span class="text-gray-600">Dear Allowance:</span>
                                                    <span
                                                        class="font-medium">{{ number_format($pay->employee->salaryData->dear_allowance ?? 0, 2) }}</span>
                                                </div>
                                                <div class="flex justify-between">
                                                    <span class="text-gray-600">Transport Allowance:</span>
                                                    <span
                                                        class="font-medium">{{ number_format($pay->employee->salaryData->transport_allowance ?? 0, 2) }}</span>
                                                </div>
                                                <div class="flex justify-between">
                                                    <span class="text-gray-600">Other Allowance:</span>
                                                    <span
                                                        class="font-medium">{{ number_format(($pay->employee->salaryData->pf_employer_contribution ?? 0) + ($pay->employee->salaryData->other_allowance ?? 0), 2) }}</span>
                                                </div>
                                                <div class="flex justify-between pt-2 border-t font-semibold">
                                                    <span class="text-gray-600">Per Day Salary:</span>
                                                    <span
                                                        class="text-primary">{{ number_format($pay->per_day_salary, 2) }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Attendance Details --}}
                                        <div class="bg-white p-4 rounded-lg shadow-sm border border-borderColor">
                                            <h6 class="font-semibold text-gray-800 mb-3 pb-2 border-b">📅 Attendance
                                                Details</h6>
                                            <div class="space-y-2 text-sm">
                                                <div class="flex justify-between">
                                                    <span class="text-gray-600">Total Days:</span>
                                                    <span class="font-medium">{{ $pay->total_days }}</span>
                                                </div>
                                                <div class="flex justify-between">
                                                    <span class="text-gray-600">Working Days:</span>
                                                    <span class="font-medium">{{ $pay->total_working_days }}</span>
                                                </div>
                                                <div class="flex justify-between">
                                                    <span class="text-gray-600">Present Days:</span>
                                                    <span
                                                        class="font-medium text-success">{{ $pay->present_days }}</span>
                                                </div>
                                                <div class="flex justify-between">
                                                    <span class="text-gray-600">Off Days:</span>
                                                    <span class="font-medium">{{ $pay->off_days }}</span>
                                                </div>
                                                <div class="flex justify-between">
                                                    <span class="text-gray-600">Holidays:</span>
                                                    <span class="font-medium">{{ $pay->holy_days }}</span>
                                                </div>
                                                <div class="flex justify-between">
                                                    <span class="text-gray-600">Leave Days (CL):</span>
                                                    <span class="font-medium">{{ $pay->leave_days }}</span>
                                                </div>
                                                <div class="flex justify-between">
                                                    <span class="text-gray-600">Absent Days:</span>
                                                    <span
                                                        class="font-medium text-danger">{{ $pay->absent_days }}</span>
                                                </div>
                                                <div class="flex justify-between">
                                                    <span class="text-gray-600">Late Days:</span>
                                                    <span
                                                        class="font-medium text-warning">{{ $pay->late_days }}</span>
                                                </div>
                                                <div class="flex justify-between">
                                                    <span class="text-gray-600">Late Penalty Days:</span>
                                                    <span
                                                        class="font-medium text-danger">{{ $pay->late_penalty_days }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Earnings & Deductions --}}
                                        <div class="bg-white p-4 rounded-lg shadow-sm border border-borderColor">
                                            <h6 class="font-semibold text-gray-800 mb-3 pb-2 border-b">➕ Earnings & ➖
                                                Deductions</h6>
                                            <div class="space-y-2 text-sm">
                                                <div class="mb-3">
                                                    <p class="text-xs text-gray-500 uppercase mb-2">Earnings</p>
                                                    <div class="flex justify-between">
                                                        <span class="text-gray-600">Attendance Bonus:</span>
                                                        <span
                                                            class="font-medium text-success">{{ number_format($pay->attendance_bonus, 2) }}</span>
                                                    </div>
                                                    <div class="flex justify-between">
                                                        <span class="text-gray-600">Total OT:</span>
                                                        <span
                                                            class="font-medium text-success">{{ number_format($pay->total_ot, 2) }}</span>
                                                    </div>
                                                    <div class="flex justify-between">
                                                        <span class="text-gray-600">+ Adjustments:</span>
                                                        <span
                                                            class="font-medium text-success">{{ number_format($pay->positive_adjustments, 2) }}</span>
                                                    </div>
                                                </div>
                                                <div class="pt-2 border-t">
                                                    <p class="text-xs text-gray-500 uppercase mb-2">Deductions</p>
                                                    <div class="flex justify-between">
                                                        <span class="text-gray-600">Late Deduction:</span>
                                                        <span
                                                            class="font-medium text-danger">{{ number_format($pay->late_deduction, 2) }}</span>
                                                    </div>
                                                    <div class="flex justify-between">
                                                        <span class="text-gray-600">Absent Deduction:</span>
                                                        <span
                                                            class="font-medium text-danger">{{ number_format($pay->absent_deduction, 2) }}</span>
                                                    </div>
                                                    <div class="flex justify-between">
                                                        <span class="text-gray-600">Loan Deduction:</span>
                                                        <span
                                                            class="font-medium text-danger">{{ number_format($pay->loan_deduction, 2) }}</span>
                                                    </div>
                                                    <div class="flex justify-between">
                                                        <span class="text-gray-600">- Adjustments:</span>
                                                        <span
                                                            class="font-medium text-danger">{{ number_format($pay->negative_adjustments, 2) }}</span>
                                                    </div>
                                                    <div class="flex justify-between pt-2 border-t font-semibold">
                                                        <span class="text-gray-600">Total Deduction:</span>
                                                        <span
                                                            class="text-danger">{{ number_format($pay->total_deduction, 2) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Approval Information --}}
                                        <div
                                            class="bg-white p-4 rounded-lg shadow-sm border border-borderColor md:col-span-3">
                                            <h6 class="font-semibold text-gray-800 mb-3 pb-2 border-b">✅ Approval
                                                Information</h6>
                                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                                                <div>
                                                    <span class="text-gray-600">Approved By:</span>
                                                    <span class="font-medium ml-2">
                                                        @if ($pay->approved_by)
                                                            {{ $pay->approvedBy->name ?? 'N/A' }}
                                                        @else
                                                            <span class="text-muted">Not Approved</span>
                                                        @endif
                                                    </span>
                                                </div>
                                                <div>
                                                    <span class="text-gray-600">Approved At:</span>
                                                    <span class="font-medium ml-2">
                                                        {{ $pay->approved_at ? \Carbon\Carbon::parse($pay->approved_at)->format('d-M-Y h:i A') : 'N/A' }}
                                                    </span>
                                                </div>
                                                <div>
                                                    <span class="text-gray-600">Approval Stage:</span>
                                                    <span class="font-medium ml-2">
                                                        @switch($pay->approval_stage)
                                                            @case(0)
                                                                Pending
                                                            @break

                                                            @case(1)
                                                                Stage 1
                                                            @break

                                                            @case(2)
                                                                Stage 2
                                                            @break

                                                            @case(3)
                                                                Approved
                                                            @break

                                                            @default
                                                                N/A
                                                        @endswitch
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @if ($payrolls->hasPages())
            <div class="card-footer py-4 px-5 border-t border-borderColor">
                {{ $payrolls->links() }}
            </div>
        @endif

    </div>
    <!-- /Employees List -->
</div>
