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


        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Employees List -->
    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white">
        <div
            class="card-header py-4 px-5 border-b border-borderColor flex items-center justify-between flex-wrap gap-3">
            <h5>Payroll List</h5>

        </div>
        <div class="card-body p-0">
            <div class="overflow-x-auto">
                <table class="table w-full border-b border-borderColor">
                    <thead>
                        <tr>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">SL</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">Emp ID</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">Name</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">Branch</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">Year</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">Month</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">Total Days</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">Working Days</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">Present</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">Off Days</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">Holidays</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">Absent</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">Late Days</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">Late Penalty Days</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">Per Day Salary</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">Basic Salary</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">Total Salary</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">Basic</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">House Rent</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">Medical Allowance</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">Dear Allowance</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">Transport Allowance</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">Other Allowance</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">Total Days</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">Working Days</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">Present</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">Weekend</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">Holidays</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">CL</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">Absent</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">Late Days</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">Late Penalty Days</th>
                            {{-- <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">Per Day Salary</th> --}}
                            {{-- <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">Basic Salary</th> --}}
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">Attendance Bonus</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">Total OT</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">Late Deduction</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">Loan Deduction</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">+Adjustments</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">-Adjustments</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">Absent Deduction</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">Total Deduction</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">Gross Salary</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">Net Salary</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">Lock</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">Approval Stage</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">Approved By</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">Status</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-borderColor">

                        @foreach ($payrolls as $pay)
                        <tr>
                            <td class="px-5 py-2.5 text-gray-500">{{ $loop->iteration }}</td>
                            <td class="px-5 py-2.5 text-gray-500">{{ $pay->employee->employee_code }}</td>
                            <td class="px-5 py-2.5 text-gray-500 p-3">
                                <div class="flex items-center file-name-icon">
                                    <a href="{{ route('admin.employees.details', ['emp' => $pay->id]) }}" class="size-8 rounded-full border border-borderColor">
                                        <img src="{{ customAsset($pay->employee->photo, true, 'emp', $pay->employee->first_anme) }}" class="rounded-full size-8 img-fluid" alt="img">
                                    </a>
                                    <div class="ms-2">
                                        <h6 class="font-medium"><a href="{{ route('admin.employees.details', ['emp' => $pay->id]) }}" class="text-gray-900 hover:text-primary">{{ $pay->employee->first_name.' '. $pay->employee->last_name }}</a>
                                        </h6>
                                        <span class="text-xs leading-normal">  {{ $pay->employee->designation->name }}</span>
                                    </div>

                                    </div>


                                </div>
                            </td>
                            <td class="px-5 py-2.5 text-gray-500">{{ $pay->branch->name ?? $pay->employee->branch->name }}</td>
                            <td class="px-5 py-2.5 text-gray-500">{{ $pay->year }}</td>
                            <td class="px-5 py-2.5 text-gray-500">{{ \Carbon\Carbon::create()->month($pay->month)->format('F') }}</td>
                            <td class="px-5 py-2.5 text-gray-500">{{ $pay->employee->salaryData->basic_salary + $pay->employee->salaryData->house_rent + $pay->employee->salaryData->medical_allowance+ $pay->employee->salaryData->dear_allowance + $pay->employee->salaryData->transport_allowance + $pay->employee->salaryData->pf_employer_contribution +$pay->employee->salaryData->other_allowance - $pay->employee->salaryData->pf_employee_contribution - $pay->employee->salaryData->welfare_contribution-$pay->employee->salaryData->tax_deduction}}</td>
                            <td class="px-5 py-2.5 text-gray-500">{{ $pay->employee->salaryData->basic_salary }}</td>
                            <td class="px-5 py-2.5 text-gray-500">{{ $pay->employee->salaryData->house_rent }}</td>
                            <td class="px-5 py-2.5 text-gray-500">{{ $pay->employee->salaryData->medical_allowance }}</td>
                            <td class="px-5 py-2.5 text-gray-500">{{ $pay->employee->salaryData->dear_allowance }}</td>
                            <td class="px-5 py-2.5 text-gray-500">{{ $pay->employee->salaryData->transport_allowance }}</td>
                            <td class="px-5 py-2.5 text-gray-500">{{ $pay->employee->salaryData->pf_employer_contribution + $pay->employee->salaryData->other_allowance}} .</td>

                            <td class="px-5 py-2.5 text-gray-500">{{ $pay->total_days }}</td>
                            <td class="px-5 py-2.5 text-gray-500">{{ $pay->total_working_days }}</td>
                            <td class="px-5 py-2.5 text-gray-500">{{ $pay->present_days }}</td>
                            <td class="px-5 py-2.5 text-gray-500">{{ $pay->off_days }}</td>
                            <td class="px-5 py-2.5 text-gray-500">{{ $pay->holy_days }}</td>
                            <td class="px-5 py-2.5 text-gray-500">{{ $pay->absent_days }}</td>
                            <td class="px-5 py-2.5 text-gray-500">{{ $pay->late_days }}</td>
                            <td class="px-5 py-2.5 text-gray-500">{{ $pay->late_penalty_days }}</td>
                            <td class="px-5 py-2.5 text-gray-500">{{ number_format($pay->per_day_salary, 2) }}</td>
                            <td class="px-5 py-2.5 text-gray-500">{{ number_format($pay->basic_salary, 2) }}</td>
                            <td class="px-5 py-2.5 text-gray-500">{{ $pay->leave_days }}</td>
                            <td class="px-5 py-2.5 text-gray-500">{{ $pay->absent_days }}</td>
                            <td class="px-5 py-2.5 text-gray-500">{{ $pay->late_days }}</td>
                            <td class="px-5 py-2.5 text-gray-500">{{ $pay->late_penalty_days }}</td>
                            {{-- <td class="px-5 py-2.5 text-gray-500">{{ number_format($pay->per_day_salary, 2) }}</td> --}}
                            {{-- <td class="px-5 py-2.5 text-gray-500">{{ number_format($pay->basic_salary, 2) }}</td> --}}
                            <td class="px-5 py-2.5 text-gray-500">{{ number_format($pay->attendance_bonus, 2) }}</td>
                            <td class="px-5 py-2.5 text-gray-500">{{ number_format($pay->total_ot, 2) }}</td>
                            <td class="px-5 py-2.5 text-gray-500">{{ number_format($pay->late_deduction, 2) }}</td>
                            <td class="px-5 py-2.5 text-gray-500">{{ number_format($pay->loan_deduction, 2) }}</td>
                            <td class="px-5 py-2.5 text-gray-500">{{ number_format($pay->positive_adjustments, 2) }}</td>
                            <td class="px-5 py-2.5 text-gray-500">{{ number_format($pay->negative_adjustments, 2) }}</td>
                            <td class="px-5 py-2.5 text-gray-500">{{ number_format($pay->absent_deduction, 2) }}</td>
                            <td class="px-5 py-2.5 text-gray-500">{{ number_format($pay->total_deduction, 2) }}</td>
                            <td class="px-5 py-2.5 text-gray-500">{{ number_format($pay->gross_salary, 2) }}</td>
                            <td class="px-5 py-2.5 text-gray-500">{{ number_format($pay->net_salary, 2) }}</td>
                            <td class="px-5 py-2.5 text-gray-500">
                                @if($pay->is_locked)
                                    <span class="badge bg-danger">Locked</span>
                                @else
                                    <span class="badge bg-success">Unlocked</span>
                                @endif
                            </td>
                            <td class="px-5 py-2.5 text-gray-500>
                                @switch($pay->approval_stage)
                                    @case(0) <span class="badge bg-secondary">Pending</span> @break
                                    @case(1) <span class="badge bg-warning">Stage 1</span> @break
                                    @case(2) <span class="badge bg-info">Stage 2</span> @break
                                    @case(3) <span class="badge bg-success">Approved</span> @break
                                    @default <span class="badge bg-secondary">N/A</span>
                                @endswitch
                            </td>
                            <td class="px-5 py-2.5 text-gray-500>
                                @if($pay->approved_by)
                                    {{ $pay->approvedBy->name ?? 'N/A' }}
                                    <br>
                                    <small>{{ $pay->approved_at ? \Carbon\Carbon::parse($pay->approved_at)->format('d M Y') : '' }}</small>
                                @else
                                    <span class="text-muted">Not Approved</span>
                                @endif
                            </td>
                            <td class="px-5 py-2.5 text-gray-500">
                                {{ $pay->status == 1 ? 'Active' : 'Inactive' }}
                            </td>
                            <td>
                                {{-- Action Buttons --}}
                                <button
                                    @if($pay->status === 1) checked @endif
                                    wire:click="statusToggle({{ $pay->id }})"
                                    wire:confirm="Are you sure you want to change the status of this payroll?"
                                    class="size-[26px] flex items-center justify-center rounded-[5px] hover:bg-light-900 hover:text-gray-900"
                                >
                                    <i class="fas fa-toggle-{{ $pay->status === 1 ? 'on text-success' : 'off text-secondary' }}"></i>
                                </button>
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
