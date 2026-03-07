<div>
    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">Payslip</h2>
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-xs text-gray-500 hover:text-primary">
                            <i class="ti ti-smart-home"></i>
                        </a>
                    </li>
                    <li>
                        <span class="text-default">/</span>
                    </li>
                    <li class="text-xs text-default">HR</li>
                    <li>
                        <span class="text-default">/</span>
                    </li>
                    <li aria-current="page" class="text-xs text-gray-900">Payslip</li>
                </ol>
            </nav>
        </div>
        <div class="flex my-xl-auto right-content items-center flex-wrap ">
            <div class="mb-2">
                <a href="#" class="btn btn-dark flex items-center"><i class="ti ti-download me-2"></i>Download</a>
            </div>
            <div class="head-icons ml-2 mb-2">
                <a href="javascript:void(0);"
                    class="border flex items-center justify-center rounded bg-white w-9 h-9 hover:bg-primary hover:text-white hover:border-primary"
                    data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Collapse"
                    id="collapse-header">
                    <i class="ti ti-chevrons-up"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Invoices -->
    <div>
        <div class="grid grid-cols-1 xl:grid-cols-4 gap-y-4 gap-x-6">
            <div class="xl:col-span-12">
                <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white p-5">
                    <div class="card-body">
                        <div class="grid md:grid-cols-12 justify-between items-center border-b mb-3">
                            <div class="md:col-span-6">
                                <div class="mb-3">
                                    <div class="mb-2">
                                        <img src="{{ customAsset(settingData('company_logo_path')) }}" class="img-fluid" alt="logo">
                                    </div>
                                    <p>3099 Kennedy Court Framingham, MA 01702</p>
                                </div>
                            </div>
                            <div class="md:col-span-6">
                                <div class=" text-end mb-3">
                                    <h5 class="text-gray mb-1">Payslip No <span class="text-primary"> #{{ $paySlip->id }}</span>
                                    </h5>
                                    <p class="font-medium">Salary Month : <span class="text-dark">{{ \Carbon\Carbon::createFromDate((int)$paySlip->year, (int)$paySlip->month, 1)->format('F Y') }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="grid md:grid-cols-12 border-b flex mb-3">
                            <div class="md:col-span-6">
                                <div class="mb-3">
                                    <p class="text-dark mb-2 font-semibold">From</p>
                                    <div>
                                        <h4 class="mb-1">XYZ Technologies</h4>
                                        <p class="mb-1">2077 Chicago Avenue Orosi, CA 93647</p>
                                        <p class="mb-1">Email : <span class="text-dark"><a
                                                    href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                                    data-cfemail="770f0e0d0312141f37120f161a071b125914181a">[email&#160;protected]</a></span>
                                        </p>
                                        <p>Phone : <span class="text-dark">+1 987 654 3210</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="md:col-span-6">
                                <div class="mb-3">
                                    <p class="text-dark mb-2 font-semibold">To</p>
                                    <div>
                                        <h4 class="mb-1">{{ $paySlip->employee->first_name . ' ' . $paySlip->employee->last_name }}</h4>
                                        <p class="mb-1">{{ $paySlip->employee->designation->name ?? 'N/A' }}</p>
                                        <p class="mb-1">Email : <span class="text-dark">{{ $paySlip->employee->email }}</span>
                                        </p>
                                        <p>Phone : <span class="text-dark">{{ $paySlip->employee->contact_number }}</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h5 class="text-center mb-4">Payslip for the month of {{ \Carbon\Carbon::createFromDate($paySlip->year, $paySlip->month, 1)->format('F Y') }}</h5>
                            <div class="grid grid-cols-1 md:grid-cols-12 gap-y-4 gap-x-6">
                                <div class="md:col-span-6">
                                    <div class="list-group mb-3 border border-borderColor rounded">
                                        <div class="list-group-item bg-light p-4 border-b">
                                            <h6>Earnings</h6>
                                        </div>
                                        <div class="list-group-item px-4 py-2 border-b">
                                            <div class="flex items-center justify-between">
                                                <p class="mb-0">Basic Salary</p>
                                                <h6 class="font-medium">৳ {{ number_format($paySlip->employee->salaryData->basic_salary ?? 0, 2) }}</h6>
                                            </div>
                                        </div>
                                        <div class="list-group-item px-4 py-2 border-b">
                                            <div class="flex items-center justify-between">
                                                <p class="mb-0">House Rent</p>
                                                <h6 class="font-medium">৳ {{ number_format($paySlip->employee->salaryData->house_rent ?? 0, 2) }}</h6>
                                            </div>
                                        </div>
                                        <div class="list-group-item px-4 py-2 border-b">
                                            <div class="flex items-center justify-between">
                                                <p class="mb-0">Medical Allowance</p>
                                                <h6 class="font-medium">৳ {{ number_format($paySlip->employee->salaryData->medical_allowance ?? 0, 2) }}</h6>
                                            </div>
                                        </div>
                                        <div class="list-group-item px-4 py-2 border-b">
                                            <div class="flex items-center justify-between">
                                                <p class="mb-0">Transport Allowance</p>
                                                <h6 class="font-medium">৳ {{ number_format($paySlip->employee->salaryData->transport_allowance ?? 0, 2) }}</h6>
                                            </div>
                                        </div>
                                        <div class="list-group-item px-4 py-2 border-b">
                                            <div class="flex items-center justify-between">
                                                <p class="mb-0">Dear Allowance</p>
                                                <h6 class="font-medium">৳ {{ number_format($paySlip->employee->salaryData->dear_allowance ?? 0, 2) }}</h6>
                                            </div>
                                        </div>
                                        <div class="list-group-item px-4 py-2 border-b">
                                            <div class="flex items-center justify-between">
                                                <p class="mb-0">Other Allowance</p>
                                                <h6 class="font-medium">৳ {{ number_format(($paySlip->employee->salaryData->pf_employer_contribution ?? 0) + ($paySlip->employee->salaryData->other_allowance ?? 0), 2) }}</h6>
                                            </div>
                                        </div>
                                        <div class="list-group-item px-4 py-2 border-b">
                                            <div class="flex items-center justify-between">
                                                <p class="mb-0">Attendance Bonus</p>
                                                <h6 class="font-medium">৳ {{ number_format($paySlip->attendance_bonus, 2) }}</h6>
                                            </div>
                                        </div>
                                        <div class="list-group-item px-4 py-2 border-b">
                                            <div class="flex items-center justify-between">
                                                <p class="mb-0">Overtime (OT)</p>
                                                <h6 class="font-medium">৳ {{ number_format($paySlip->total_ot, 2) }}</h6>
                                            </div>
                                        </div>
                                        <div class="list-group-item px-4 py-2 border-b">
                                            <div class="flex items-center justify-between">
                                                <p class="mb-0">Positive Adjustments</p>
                                                <h6 class="font-medium">৳ {{ number_format($paySlip->positive_adjustments, 2) }}</h6>
                                            </div>
                                        </div>
                                        <div class="list-group-item px-4 py-2 border-b bg-success-50">
                                            <div class="flex items-center justify-between">
                                                <p class="mb-0 font-semibold">Gross Salary</p>
                                                <h6 class="font-semibold text-success">৳ {{ number_format($paySlip->gross_salary, 2) }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="md:col-span-6">
                                    <div class="list-group mb-3 border border-borderColor rounded">
                                        <div class="list-group-item bg-light p-4 border-b">
                                            <h6>Deductions</h6>
                                        </div>
                                        <div class="list-group-item px-4 py-2 border-b">
                                            <div class="flex items-center justify-between">
                                                <p class="mb-0">Tax Deduction</p>
                                                <h6 class="font-medium">৳ {{ number_format($paySlip->employee->salaryData->tax_deduction ?? 0, 2) }}</h6>
                                            </div>
                                        </div>
                                        <div class="list-group-item px-4 py-2 border-b">
                                            <div class="flex items-center justify-between">
                                                <p class="mb-0">Provident Fund (Employee)</p>
                                                <h6 class="font-medium">৳ {{ number_format($paySlip->employee->salaryData->pf_employee_contribution ?? 0, 2) }}</h6>
                                            </div>
                                        </div>
                                        <div class="list-group-item px-4 py-2 border-b">
                                            <div class="flex items-center justify-between">
                                                <p class="mb-0">Welfare Contribution</p>
                                                <h6 class="font-medium">৳ {{ number_format($paySlip->employee->salaryData->welfare_contribution ?? 0, 2) }}</h6>
                                            </div>
                                        </div>
                                        <div class="list-group-item px-4 py-2 border-b">
                                            <div class="flex items-center justify-between">
                                                <p class="mb-0">Absent Deduction</p>
                                                <h6 class="font-medium">৳ {{ number_format($paySlip->absent_deduction, 2) }}</h6>
                                            </div>
                                        </div>
                                        <div class="list-group-item px-4 py-2 border-b">
                                            <div class="flex items-center justify-between">
                                                <p class="mb-0">Late Deduction</p>
                                                <h6 class="font-medium">৳ {{ number_format($paySlip->late_deduction, 2) }}</h6>
                                            </div>
                                        </div>
                                        <div class="list-group-item px-4 py-2 border-b">
                                            <div class="flex items-center justify-between">
                                                <p class="mb-0">Loan Deduction</p>
                                                <h6 class="font-medium">৳ {{ number_format($paySlip->loan_deduction, 2) }}</h6>
                                            </div>
                                        </div>
                                        <div class="list-group-item px-4 py-2 border-b">
                                            <div class="flex items-center justify-between">
                                                <p class="mb-0">Negative Adjustments</p>
                                                <h6 class="font-medium">৳ {{ number_format($paySlip->negative_adjustments, 2) }}</h6>
                                            </div>
                                        </div>
                                        <div class="list-group-item px-4 py-2 border-b bg-danger-50">
                                            <div class="flex items-center justify-between">
                                                <p class="mb-0 font-semibold">Total Deductions</p>
                                                <h6 class="font-semibold text-danger">৳ {{ number_format($paySlip->total_deduction, 2) }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="border-t pt-3">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <h6 class="mb-3 text-dark">Attendance Summary</h6>
                                        <div class="space-y-1 text-sm">
                                            <div class="flex justify-between">
                                                <span class="text-gray-600">Total Days:</span>
                                                <span class="font-medium">{{ $paySlip->total_days }}</span>
                                            </div>
                                            <div class="flex justify-between">
                                                <span class="text-gray-600">Working Days:</span>
                                                <span class="font-medium">{{ $paySlip->total_working_days }}</span>
                                            </div>
                                            <div class="flex justify-between">
                                                <span class="text-gray-600">Present Days:</span>
                                                <span class="font-medium text-success">{{ $paySlip->present_days }}</span>
                                            </div>
                                            <div class="flex justify-between">
                                                <span class="text-gray-600">Off Days:</span>
                                                <span class="font-medium">{{ $paySlip->off_days }}</span>
                                            </div>
                                            <div class="flex justify-between">
                                                <span class="text-gray-600">Holidays:</span>
                                                <span class="font-medium">{{ $paySlip->holy_days }}</span>
                                            </div>
                                            <div class="flex justify-between">
                                                <span class="text-gray-600">Leave Days:</span>
                                                <span class="font-medium">{{ $paySlip->leave_days }}</span>
                                            </div>
                                            <div class="flex justify-between">
                                                <span class="text-gray-600">Absent Days:</span>
                                                <span class="font-medium text-danger">{{ $paySlip->absent_days }}</span>
                                            </div>
                                            <div class="flex justify-between">
                                                <span class="text-gray-600">Late Days:</span>
                                                <span class="font-medium text-warning">{{ $paySlip->late_days }}</span>
                                            </div>
                                            <div class="flex justify-between">
                                                <span class="text-gray-600">Late Penalty Days:</span>
                                                <span class="font-medium text-danger">{{ $paySlip->late_penalty_days }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="mb-3 text-dark">Salary Calculation</h6>
                                        <div class="space-y-1 text-sm">
                                            <div class="flex justify-between">
                                                <span class="text-gray-600">Per Day Salary:</span>
                                                <span class="font-medium">৳ {{ number_format($paySlip->per_day_salary, 2) }}</span>
                                            </div>
                                            <div class="flex justify-between">
                                                <span class="text-gray-600">Gross Salary:</span>
                                                <span class="font-medium text-success">৳ {{ number_format($paySlip->gross_salary, 2) }}</span>
                                            </div>
                                            <div class="flex justify-between">
                                                <span class="text-gray-600">Total Deduction:</span>
                                                <span class="font-medium text-danger">৳ {{ number_format($paySlip->total_deduction, 2) }}</span>
                                            </div>
                                            <div class="flex justify-between pt-2 border-t">
                                                <span class="text-dark font-semibold">Net Salary:</span>
                                                <span class="font-semibold text-primary">৳ {{ number_format($paySlip->net_salary, 2) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-primary-50 p-3 rounded mt-3">
                                    <p class="mb-0"><span class="font-semibold text-dark">Net Salary in Words:</span> <span class="text-primary font-medium">{{ ucwords(app('App\Helper\NumberToWords')::convert($paySlip->net_salary)) }} Taka Only</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Invoices -->
</div>
