<div>
    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">Attendance Report</h2>
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="index.html" class="inline-flex items-center text-xs text-gray-500 hover:text-primary">
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
                    <li aria-current="page" class="text-xs text-gray-900">Attendance Report</li>
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
        <div class="xxl:col-span-6 md:col-span-6 ">
            <div class="grid grid-cols-1 xxl:grid-cols-12  gap-6 flex-fill">
                <div class="xxl:col-span-6 md:col-span-6 flex">
                    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white flex-1">
                        <div class="card-body p-5 ">
                            <div>
                                <div class="flex items-center overflow-hidden mb-2">
                                    <div class="attendence-icon">
                                        <span><i class="ti ti-calendar text-[40px] text-primary"></i></span>
                                    </div>
                                    <div class="ms-2 overflow-hidden">
                                        <p class="text-[12px] font-normal mb-1 text-truncate">Total Working Days</p>
                                        <h4>25</h4>
                                    </div>
                                </div>
                                <div class="w-full bg-light-900 rounded-full h-1" role="progressbar"
                                    aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                                    style="width: 100%;height: 5px;">
                                    <div class="h-1 rounded-full bg-pink" style="width: 70%"></div>
                                </div>
                            </div>
                            <div class="flex mt-2">
                                <p class="text-[12px] font-normal flex items-center text-truncate"><span
                                        class="text-success text-[12px] flex items-center me-1"><i
                                            class="ti ti-arrow-wave-right-up me-1"></i>+10.54%</span>from last month</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="xxl:col-span-6 md:col-span-6 flex">
                    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white flex-1">
                        <div class="card-body p-5 ">
                            <div>
                                <div class="flex items-center overflow-hidden mb-2">
                                    <div class="attendence-icon">
                                        <span><i class="ti ti-calendar text-[40px] text-info"></i></span>
                                    </div>
                                    <div class="ms-2 overflow-hidden">
                                        <p class="text-[12px] font-normal mb-1 text-truncate">Total Leave Taken</p>
                                        <h4>12</h4>
                                    </div>
                                </div>
                                <div class="w-full bg-light-900 rounded-full h-1" role="progressbar"
                                    aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                                    style="width: 100%;height: 5px;">
                                    <div class="h-1 rounded-full bg-success" style="width: 80%"></div>
                                </div>
                            </div>
                            <div class="flex mt-2">
                                <p class="text-[12px] font-normal flex items-center text-truncate"><span
                                        class="text-success text-[12px] flex items-center me-1"><i
                                            class="ti ti-arrow-wave-right-up me-1"></i>+12.84%</span>from last month</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="xxl:col-span-6 md:col-span-6 flex">
                    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white flex-1">
                        <div class="card-body p-5 ">
                            <div>
                                <div class="flex items-center overflow-hidden mb-2">
                                    <div class="attendence-icon">
                                        <span><i class="ti ti-calendar text-[40px] text-pink"></i></span>
                                    </div>
                                    <div class="ms-2 overflow-hidden">
                                        <p class="text-[12px] font-normal mb-1 text-truncate">Total Holidays</p>
                                        <h4>6</h4>
                                    </div>
                                </div>
                                <div class="w-full bg-light-900 rounded-full h-1" role="progressbar"
                                    aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                                    style="width: 100%;height: 5px;">
                                    <div class="h-1 rounded-full bg-danger" style="width: 20%"></div>
                                </div>
                            </div>
                            <div class="flex mt-2">
                                <p class="text-[12px] font-normal flex items-center text-truncate"><span
                                        class="text-danger text-[12px] flex items-center me-1"><i
                                            class="ti ti-arrow-wave-right-up me-1"></i>-10.75%</span>from last month
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="xxl:col-span-6 md:col-span-6 flex">
                    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white flex-1">
                        <div class="card-body p-5 ">
                            <div>
                                <div class="flex items-center overflow-hidden mb-2">
                                    <div class="attendence-icon">
                                        <span><i class="ti ti-calendar text-[40px] text-warning"></i></span>
                                    </div>
                                    <div class="ms-2 overflow-hidden">
                                        <p class="text-[12px] font-normal mb-1 text-truncate">Total Halfdays</p>
                                        <h4>5</h4>
                                    </div>
                                </div>
                                <div class="w-full bg-light-900 rounded-full h-1" role="progressbar"
                                    aria-label="Basic example" aria-valuenow="0" aria-valuemin="0"
                                    aria-valuemax="100" style="width: 100%;height: 5px;">
                                    <div class="h-1 rounded-full bg-purple" style="width: 60%"></div>
                                </div>
                            </div>
                            <div class="flex mt-2">
                                <p class="text-[12px] font-normal flex items-center text-truncate"><span
                                        class="text-success text-[12px] flex items-center me-1"><i
                                            class="ti ti-arrow-wave-right-up me-1"></i>+15.74%</span>from last month
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /Total Exponses -->

        <!-- Total Exponses -->
        <div class="col-span-6 flex">
            <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white flex-1">
                <div class="card-header border-0 pb-0 pt-4 px-5">
                    <div class="flex flex-wrap gap-y-2 justify-between items-center">
                        <div class="flex items-center ">
                            <span class="me-2"><i class="ti ti-chart-line text-danger"></i></span>
                            <h5>Attendance </h5>
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
                    <div id="attendance-report" class="flex-fill"></div>
                </div>
            </div>
        </div>
        <!-- /Total Exponses -->


    </div>

    <!-- Employee Attendance List -->
    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white">
        <div
            class="card-header py-4 px-5 border-b border-borderColor flex items-center justify-between flex-wrap gap-3">
            <h5>Employee Attendance</h5>

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
                                Employee</th>
                            <th
                                class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Status</th>
                            <th
                                class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Check IN</th>
                            <th
                                class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Check Out</th>

                            <th
                                class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Late</th>
                            <th
                                class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Early Exit</th>
                            <th
                                class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Over Times</th>

                            <th
                                class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-borderColor" wire:loading.class="opacity-50">
                        @foreach ($attendanceRecords as $attendance)
                            <tr class="even:bg-white dark:even-bg-white">
                                <td class="px-5 py-2.5 text-gray-500">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-5 py-2.5 text-gray-500 font-medium p-3">
                                    <div class="flex items-center file-name-icon">
                                        <a href="#" class="size-8 rounded-full border border-borderColor">
                                            <img src="{{ customAsset($attendance->employee->photo, true, 'user') }}"
                                                class="rounded-full size-8 img-fluid" alt="img">
                                        </a>
                                        <div class="ms-2">
                                            <h6 class="font-medium"><a
                                                    href="{{ route('admin.employees.details', ['emp' => $attendance->id]) }}"
                                                    class="text-gray-900 hover:text-primary">{{ $attendance->employee->full_name }}</a>
                                            </h6>
                                            <span
                                                class="text-xs leading-normal">{{ $attendance->employee->designation->name }}</span>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-5 py-2.5 text-gray-500 p-3">
                                    <span
                                        class="bg-success-100 text-success rounded text-[10px] font-medium leading-4 py-0.5 px-1.5 inline-flex items-center badge-xs">
                                        <i class="ti ti-point-filled me-1"></i>{{ ucFirst($attendance->status) }}
                                    </span>
                                </td>

                                <td class="px-5 py-2.5 text-gray-500 p-3">
                                    {{-- {{ $attendance->clock_in->format('h:i A') ?? '' }} --}}
                                    {{ $attendance?->clock_in?->format('h:i A') ?? '' }}
                                </td>
                                <td class="px-5 py-2.5 text-gray-500 p-3">
                                    {{ $attendance->clock_out?->format('h:i A') ?? '' }}</td>

                                <td class="px-5 py-2.5 text-gray-500 p-3">


                                    {{ formatDuration($attendance->late_minutes) ?? '' }}
                                </td>

                                <td class="px-5 py-2.5 text-gray-500 p-3">

                                    {{ formatDuration($attendance?->early_exit_minutes) ?? '' }}
                                </td>
                                <td class="px-5 py-2.5 text-gray-500 p-3">

                                    {{ formatDuration($attendance->overtime_minutes) ?? '' }}
                                </td>

                                <td class="px-5 py-2.5 text-gray-500">
                                    <div class="action-icon inline-flex">
                                        <a href="#"
                                            class="me-2 size-[26px] flex items-center justify-center rounded-[5px] hover:bg-light-900 hover:text-gray-900"><i
                                                class="ti ti-edit"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            @if ($attendanceRecords->hasPages())
                <div class="card-footer py-4 px-5 border-t border-borderColor">
                    {{ $attendanceRecords->links() }}
                </div>
            @endif
        </div>
    </div>
    <!-- /Employee Attendance List -->
</div>
