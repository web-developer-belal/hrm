<div>
    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">Leave Report</h2>
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
                    <li aria-current="page" class="text-xs text-gray-900">Leave Report</li>
                </ol>
            </nav>
        </div>
        <div class="flex my-xl-auto right-content items-center flex-wrap ">
            <div class="me-2 mb-2">
                <div>
                    <a href="javascript:void(0);" class="border rounded p-2 bg-white inline-flex items-center"
                        data-dropdown-toggle="export-dropdown">
                        <i class="ti ti-file-export me-1"></i>Export<i class="ti ti-chevron-down ml-1"></i>
                    </a>
                    <ul id="export-dropdown" class="hidden p-4 border rounded bg-white shadow-lg">
                        <li>
                            <a href="javascript:void(0);"
                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary"><i
                                    class="ti ti-file-type-pdf me-1"></i>Export as PDF</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);"
                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary"><i
                                    class="ti ti-file-type-xls me-1"></i>Export as Excel </a>
                        </li>
                    </ul>
                </div>
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

    <div class="grid grid-cols-1 xxl:grid-cols-12  gap-6 mb-6">

        <!-- Total Exponses -->
        <div class="xxl:col-span-6 flex">
            <div class="grid grid-cols-1 md:grid-cols-12 w-full gap-6">
                <div class="xl:col-span-6 md:col-span-6 flex">
                    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white flex-1">
                        <div class="card-body p-5">
                            <div class="flex items-center justify-between mb-2 overflow-hidden">
                                <div>
                                    <p class="text-[12px] font-normal mb-1 text-truncate">Total Leaves</p>
                                    <h4>15</h4>
                                </div>
                                <div class="leave-report-icon">
                                    <a href="#"><span
                                            class="p-2 border border-primary bg-primary-transparent rounded-full flex items-center justify-center"><i
                                                class="ti ti-calendar-x text-[18px] text-primary"></i></span></a>
                                </div>
                            </div>
                            <div class="p-2 bg-gray-100 rounded">
                                <div class="flex items-center justify-between">
                                    <p class="text-[12px] font-normal mb-0">Last Month</p>
                                    <span class="text-[12px] font-normal text-success flex items-center"><i
                                            class="ti ti-arrow-wave-right-up text-success me-1"></i>+17.02%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="xl:col-span-6 md:col-span-6 flex">
                    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white flex-1">
                        <div class="card-body p-5">
                            <div class="flex items-center justify-between mb-2 overflow-hidden">
                                <div>
                                    <p class="text-[12px] font-normal mb-1 text-truncate">Approved Leaves</p>
                                    <h4>15</h4>
                                </div>
                                <div class="leave-report-icon">
                                    <a href="#"><span
                                            class="p-2 border border-success bg-success-transparent rounded-full flex items-center justify-center"><i
                                                class="ti ti-calendar-x text-[18px] text-success"></i></span></a>
                                </div>
                            </div>
                            <div class="p-2 bg-gray-100 rounded">
                                <div class="flex items-center justify-between">
                                    <p class="text-[12px] font-normal mb-0">Last Month</p>
                                    <span class="text-[12px] font-normal text-success flex items-center"><i
                                            class="ti ti-arrow-wave-right-up text-success me-1"></i>+17.02%</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="xl:col-span-6 md:col-span-6 flex">
                    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white flex-1">
                        <div class="card-body p-5">
                            <div class="flex items-center justify-between mb-2 overflow-hidden">
                                <div>
                                    <p class="text-[12px] font-normal mb-1 text-truncate">Pending Requests</p>
                                    <h4>5</h4>
                                </div>
                                <div class="leave-report-icon">
                                    <a href="#"><span
                                            class="p-2 border border-skyblue bg-skyblue-transparent rounded-full flex items-center justify-center"><i
                                                class="ti ti-calendar-x text-[18px] text-skyblue"></i></span></a>
                                </div>
                            </div>
                            <div class="p-2 bg-gray-100 rounded">
                                <div class="flex items-center justify-between">
                                    <p class="text-[12px] font-normal mb-0">Last Month</p>
                                    <span class="text-[12px] font-normal text-success flex items-center"><i
                                            class="ti ti-arrow-wave-right-up text-success me-1"></i>+17.02%</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="xl:col-span-6 md:col-span-6 flex">
                    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white flex-1">
                        <div class="card-body p-5">
                            <div class="flex items-center justify-between mb-2 overflow-hidden">
                                <div>
                                    <p class="text-[12px] font-normal mb-1 text-truncate">Rejected Leaves</p>
                                    <h4>5</h4>
                                </div>
                                <div class="leave-report-icon">
                                    <a href="#"><span
                                            class="p-2 border border-danger bg-danger-transparent rounded-full flex items-center justify-center"><i
                                                class="ti ti-calendar-x text-[18px] text-danger"></i></span></a>
                                </div>
                            </div>
                            <div class="p-2 bg-gray-100 rounded">
                                <div class="flex items-center justify-between">
                                    <p class="text-[12px] font-normal mb-0">Last Month</p>
                                    <span class="text-[12px] font-normal text-success flex items-center"><i
                                            class="ti ti-arrow-wave-right-up text-success me-1"></i>+17.02%</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /Total Exponses -->

        <!-- Total Exponses -->
        <div class="xxl:col-span-6 flex">
            <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white flex-1">
                <div class="card-header border-0 pb-0 pt-4 px-5">
                    <div class="flex flex-wrap gap-y-2 justify-between items-center">
                        <div class="flex items-center ">
                            <span class="me-2"><i class="ti ti-chart-bar text-danger"></i></span>
                            <h5>Leaves </h5>
                        </div>
                        <div class="flex items-center">
                            <p class="inline-flex items-center me-2 mb-0">
                                <i class="ti ti-square-filled text-[12px] text-success me-2"></i>
                                Annual
                            </p>
                            <p class="inline-flex items-center me-2 mb-0">
                                <i class="ti ti-square-filled text-[12px] text-warning me-2"></i>
                                Casual
                            </p>
                            <p class="inline-flex items-center me-2 mb-0">
                                <i class="ti ti-square-filled text-[12px] text-dark me-2"></i>
                                Medical
                            </p>
                            <p class="inline-flex items-center mb-0 me-2">
                                <i class="ti ti-square-filled text-[12px] text-primary me-2"></i>
                                Others
                            </p>
                        </div>
                        <a href="javascript:void(0);"
                            class="border rounded p-2 bg-white inline-flex items-center focus:bg-primary focus:border-primary focus:text-white"
                            data-dropdown-toggle="chart-dropdown">
                            This Year<i class="ti ti-chevron-down ml-1"></i>
                        </a>
                        <ul id="chart-dropdown" class="hidden p-4 border rounded bg-white shadow-lg w-40 z-[1]">
                            <li>
                                <a href="javascript:void(0);"
                                    class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">2025</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);"
                                    class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">2024</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);"
                                    class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">2023</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card-body  px-5 pt-0">
                    <div id="leave-report" class="flex-fill"></div>



                </div>
            </div>
        </div>
    </div>

    <!-- Leave List -->
    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white">
        <div
            class="card-header py-4 px-5 border-b border-borderColor flex items-center justify-between flex-wrap gap-3">
            <h5>Leave List</h5>

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
                            <th
                                class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Name</th>
                            <th
                                class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Leave Type </th>
                            <th
                                class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                From</th>

                            <th
                                class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                To</th>
                            <th
                                class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Days</th>
                            <th
                                class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Status</th>
                            <th
                                class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Approved By </th>

                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-borderColor">
                        @foreach ($leaves as $leave)
                            <tr class="even:bg-white dark:even-bg-white">
                                <td class="px-5 py-2.5 text-gray-500">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-5 py-2.5 text-gray-900">{{ $leave->employee->full_name }}</td>
                                <td class="px-5 py-2.5 text-gray-900">{{ $leave->type->name }}</td>
                                <td class="px-5 py-2.5 text-gray-500">{{ $leave->from_date->format('d-M-Y') }}</td>
                                <td class="px-5 py-2.5 text-gray-500">{{ $leave->to_date->format('d-M-Y') }}</td>
                                <td class="px-5 py-2.5 text-gray-500">{{ $leave->total_days }}</td>

                                <td class="px-5 py-2.5 text-gray-500 p-3">
                                    <div>
                                        <a href="javascript:void(0);"
                                            class="border rounded p-2 bg-white inline-flex items-center focus:bg-primary focus:border-primary focus:text-white text-gray-900"
                                            data-dropdown-toggle="designation-dropdown-{{ $leave->id }}">
                                            <span
                                                class="rounded-full bg-transparent-success flex justify-center items-center me-2"><i
                                                    class="ti ti-point-filled bg-success-100 rounded-full text-success me-1"></i>
                                                {{ ucfirst($leave->status) }}<i class="ti ti-chevron-down ml-1"></i>
                                            </span></a>
                                        <ul id="designation-dropdown-{{ $leave->id }}"
                                            class="hidden p-4 border rounded bg-white shadow-lg w-40 z-[1]"
                                            data-popper-placement="bottom"
                                            style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(1597px, 398px);">
                                            <li>
                                                <a href="javascript:void(0);"
                                                    wire:click="statusChange({{ $leave->id }}, 'approved')"
                                                    class="rounded p-2 flex items-center hover:bg-primary-100 hover:text-primary">Approved</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);"
                                                    wire:click="statusChange({{ $leave->id }},'rejected')"
                                                    class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">Declined</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);"
                                                    wire:click="statusChange({{ $leave->id }},'pending')"
                                                    class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">Pending</a>
                                            </li>

                                        </ul>
                                    </div>
                                </td>
                                <td class="px-5 py-2.5 text-gray-500">{{ $leave->approved_by ?? '--' }}</td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $leaves->links() }}
            </div>
        </div>
    </div>
</div>
<!-- /Invoice List -->
</div>
