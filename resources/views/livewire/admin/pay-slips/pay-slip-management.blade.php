<div>
    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">Payslips Management</h2>
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
                    <li class="text-xs text-default">Payslips Management</li>

                </ol>
            </nav>
        </div>
        <div class="flex my-xl-auto right-content items-center flex-wrap ">


        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Payslips List -->
    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white">
        <div
            class="card-header py-4 px-5 border-b border-borderColor flex items-center justify-between flex-wrap gap-3">
            <h5>Payslips List</h5>
            <div class="flex my-xl-auto right-content items-center flex-wrap gap-3">
                <div class="me-3">
                    <x-form.input name="search" placeholder="Search here" :live="true" />
                </div>
                <div class="me-3">
                    <x-form.select name="branch" placeholder="Select branch" :live="true" :options="$branch_options"
                        :search="true" />
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="overflow-x-auto">
                <table class="table w-full border-b border-borderColor" wire:loading.class="opacity-50">
                    <thead>
                        <tr>
                            
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
                                Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-borderColor" wire:loading.class="opacity-50">
                        @foreach ($payslips as $pay)
                            {{-- Main Row --}}
                            <tr class="hover:bg-gray-50 cursor-pointer">
                               
                                <td class="px-5 py-2.5 text-gray-500">{{ $payslips->firstItem() + $loop->index }}</td>
                                <td class="px-5 py-2.5 text-gray-500">{{ $pay->employee->employee_code }}</td>
                                <td class="px-5 py-2.5 text-gray-500 p-3">
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
                                <td class="px-5 py-2.5 text-gray-500">
                                    {{ $pay->branch->name ?? $pay->employee->branch->name }}</td>
                                <td class="px-5 py-2.5 text-gray-500">{{ $pay->year }}</td>
                                <td class="px-5 py-2.5 text-gray-500">
                                    {{ \Carbon\Carbon::create()->month((int)$pay->month)->format('F') }}</td>

                                <td class="px-5 py-2.5">
                                    <a href="{{ route('admin.payroll.payslips.show', ['payslip' => $pay->id]) }}"
                                        class="me-2 size-[26px] flex items-center justify-center rounded-[5px] hover:bg-light-900 hover:text-gray-900"><i
                                            class="ti ti-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @if ($payslips->hasPages())
            <div class="card-footer py-4 px-5 border-t border-borderColor">
                {{ $payslips->links() }}
            </div>
        @endif

    </div>
    <!-- /Employees List -->
</div>
