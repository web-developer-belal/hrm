<div>

    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">Employee Attendance</h2>
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
                    <li class="text-xs text-default">Employee</li>
                    <li>
                        <span class="text-default">/</span>
                    </li>
                    <li aria-current="page" class="text-xs text-gray-900">Leaves</li>
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
            <div class="mb-2">
                <a href="#" data-modal-target="attendance_report" data-modal-toggle="attendance_report"
                    class="flex items-center bg-primary text-sm font-medium py-2 rounded text-white px-3 hover:bg-primary-900 hover:text-white"><i
                        class="ti ti-file-analytics me-2"></i>Report</a>
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

    <!-- Employee Attendance  View -->
    <div class="grid grid-cols-1 xl:grid-cols-12 gap-3">
        <div class="md:col-span-4 flex">
            <div class="card border-borderColor border rounded-[5px] bg-white shadow-xs w-full">
                <div class="card-body p-5">
                    <div class="text-center mb-3">
                        <h6 class="text-gray-500 mb-2 font-medium">Good Morning, Adrian</h6>
                        <h3>08:35 AM, 11 Mar 2025</h3>
                    </div>
                    <div class="text-center mb-3">
                        <div class="flex justify-center">
                            <img src="{{ asset('assets/img/profiles/avatar-27.jpg') }}" alt="images"
                                class="p-1  rounded-full w-[125px]">
                        </div>
                        <div>
                            <span
                                class="bg-primary text-white text-xs font-medium me-2 px-2.5 py-0.5 rounded ">Production
                                : 3.45 hrs</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-center">
                        <span class="font-medium"><i class="ti ti-fingerprint text-primary me-2"></i>Punch In at 10.00
                            AM</span>
                    </div>
                    <div class="w-full">
                        <button type="button"
                            class="text-white bg-dark  font-medium rounded-[5px] text-sm px-5 py-2.5 me-2 mt-2 w-full">Punch
                            Out</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-8 md:col-span-8 flex">
            <div class="grid grid-cols-12 gap-x-6 w-full">
                <div class="col-span-3 flex mb-6">
                    <div class="flex items-center justify-center gap-3 w-full">
                        <div class="card border-borderColor border bg-white shadow-xs rounded-[5px] w-full">
                            <div class="card-body p-5">
                                <div class="pb-3  border-b border-borderColor">
                                    <span class="p-1 rounded-[5px] bg-primary mb-2">
                                        <i class="ti ti-clock-stop text-white"></i>
                                    </span>
                                    <div class="mt-2">
                                        <h2>8.36 <span class="text-lg text-gray-500">/ 9</span></h2>
                                        <p class="font-medium truncate">Total Hours Today</p>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <span class="flex items-center text-xs truncate"><i
                                            class="ti ti-arrow-up me-2 filled p-1 bg-success text-white rounded-full"></i>15%
                                        by Yesterday</span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-3 flex mb-6">
                    <div class="flex items-center justify-center gap-3 w-full">
                        <div class="card border-borderColor border bg-white shadow-xs rounded-[5px] w-full">
                            <div class="card-body p-5">
                                <div class="pb-3 border-b border-borderColor">
                                    <span class="p-1 rounded-[5px] bg-dark mb-2">
                                        <i class="ti ti-clock-up text-white"></i>
                                    </span>
                                    <div class="mt-2">
                                        <h2>8.36 <span class="text-lg text-gray-500">/ 40</span></h2>
                                        <p class="font-medium truncate">Total Hours Week</p>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <span class="flex items-center text-xs truncate"><i
                                            class="ti ti-arrow-up me-2 filled p-1 bg-success text-white rounded-full"></i>15%
                                        by Last Week</span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-3 flex mb-6">
                    <div class="flex items-center justify-center gap-3 w-full">
                        <div class="card border-borderColor border bg-white shadow-xs rounded-[5px] w-full">
                            <div class="card-body p-5">
                                <div class="pb-3 border-b border-borderColor">
                                    <span class="p-1 rounded-[5px] bg-info mb-2">
                                        <i class="ti ti-calendar-up text-white"></i>
                                    </span>
                                    <div class="mt-2">
                                        <h2>126 <span class="text-lg text-gray-500">/ 160</span></h2>
                                        <p class="font-medium truncate">Total Hours Month</p>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <span
                                        class="flex items-center text-xs overflow-hidden text-ellipsis whitespace-nowrap"><i
                                            class="ti ti-arrow-down me-2 filled p-1 bg-danger text-white rounded-full"></i>21%
                                        by Last Month</span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-3 flex mb-6">
                    <div class="flex items-center justify-center gap-3 w-full">
                        <div class="card border-borderColor border bg-white shadow-xs rounded-[5px] w-full">
                            <div class="card-body p-5">
                                <div class="pb-3 border-b border-borderColor">
                                    <span class="p-1 rounded-[5px] bg-pink mb-2">
                                        <i class="ti ti-calendar-star text-white"></i>
                                    </span>
                                    <div class="mt-2">
                                        <h2>16 <span class="text-lg text-gray-500">/ 28</span></h2>
                                        <p class="font-medium overflow-hidden text-ellipsis whitespace-nowrap">Overtime
                                            this Month</p>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <span
                                        class="flex items-center text-xs overflow-hidden text-ellipsis whitespace-nowrap"><i
                                            class="ti ti-arrow-down me-2 filled p-1 bg-danger text-white rounded-full"></i>21%
                                        by Last Month</span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 flex">
                    <div class="card border-bordercolor bg-white rounded-[5px] shadow-xs w-full">
                        <div class="card-body p-5">
                            <div class="flex items-center justify-center mb-4">
                                <div class="w-full">
                                    <span class="flex items-center mb-1"><i class="ti ti-point-filled me-1"></i>Total
                                        Working hours</span>
                                    <h3>12h 36m</h3>
                                </div>
                                <div class="w-full">
                                    <span class="flex items-center mb-1"><i
                                            class="ti ti-point-filled text-success me-1"></i>Productive Hours</span>
                                    <h3>08h 36m</h3>
                                </div>
                                <div class="w-full">
                                    <span class="flex items-center mb-1"><i
                                            class="ti ti-point-filled text-warning me-1"></i>Break hours</span>
                                    <h3>22m 15s</h3>
                                </div>
                                <div class="w-full">
                                    <span class="flex items-center mb-1"><i
                                            class="ti ti-point-filled text-info me-1"></i>Overtime</span>
                                    <h3>22m 15s</h3>
                                </div>
                            </div>
                            <div class="flex item-center justify-center mb-3">
                                <div class="h-6 bg-white rounded-[5px]" style="width: 20%"></div>
                                <div class="h-6 bg-success rounded-[5px]" style="width: 10%"></div>
                                <div class="h-6 bg-gray-200 rounded-[5px]" style="width: 2%"></div>
                                <div class="h-6 bg-warning rounded-[5px]" style="width: 5%"></div>
                                <div class="h-6 bg-gray-200 rounded-[5px]" style="width: 2%"></div>
                                <div class="h-6 bg-success rounded-[5px]" style="width: 10%"></div>
                                <div class="h-6 bg-gray-200 rounded-[5px]" style="width: 2%"></div>
                                <div class="h-6 bg-warning rounded-[5px]" style="width: 10%"></div>
                                <div class="h-6 bg-gray-200 rounded-[5px]" style="width: 2%"></div>
                                <div class="h-6 bg-success rounded-[5px]" style="width: 20%"></div>
                                <div class="h-6 bg-gray-200 rounded-[5px]" style="width: 2%"></div>
                                <div class="h-6 bg-warning rounded-[5px]" style="width: 2%"></div>
                                <div class="h-6 bg-gray-200 rounded-[5px]" style="width: 2%"></div>
                                <div class="h-6 bg-info rounded-[5px]" style="width: 2%"></div>
                                <div class="h-6 bg-gray-200 rounded-[5px]" style="width: 1%"></div>
                                <div class="h-6 bg-info rounded-[5px]" style="width: 1%"></div>
                            </div>
                            <div class="flex items-center justify-center gap-2 flex-wrap ">
                                <span class="text-xs">06:00</span>
                                <span class="text-xs">07:00</span>
                                <span class="text-xs">08:00</span>
                                <span class="text-xs">09:00</span>
                                <span class="text-xs">10:00</span>
                                <span class="text-xs">11:00</span>
                                <span class="text-xs">12:00</span>
                                <span class="text-xs">01:00</span>
                                <span class="text-xs">02:00</span>
                                <span class="text-xs">03:00</span>
                                <span class="text-xs">04:00</span>
                                <span class="text-xs">05:00</span>
                                <span class="text-xs">06:00</span>
                                <span class="text-xs">07:00</span>
                                <span class="text-xs">08:00</span>
                                <span class="text-xs">09:00</span>
                                <span class="text-xs">10:00</span>
                                <span class="text-xs">11:00</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-4">
        <div class="flex gap-4">
            <div>

            </div>
            <div>


            </div>

        </div>
    </div>
    <!-- /Employee Attendance  View -->

    <!-- Employee Attendance List -->
    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white">
        <div
            class="card-header py-4 px-5 border-b border-borderColor flex items-center justify-between flex-wrap gap-3">

            <h5 class="me-2">Employee Attendance</h5>
            <div class="flex my-xl-auto right-content items-center flex-wrap gap-3">
                <div class="me-3">
                    <div class="relative">
                        <input type="text"
                            class="block flex-1 border border-borderColor bg-white rounded-[5px] py-1.5 pl-2.5 pr-8 text-gray-900 placeholder:text-gray-400 focus:ring-0 focus:border-borderColor h-[38px] text-sm date-range bookingrange"
                            placeholder="dd/mm/yyyy - dd/mm/yyyy">
                        <span class="absolute inset-y-1/2 end-0 flex items-center me-2.5 pointer-events-none">
                            <i class="ti ti-chevron-down"></i>
                        </span>
                    </div>
                </div>
                <div class="me-3">
                    <a href="javascript:void(0);"
                        class="border rounded p-2 bg-white inline-flex items-center focus:bg-primary focus:border-primary focus:text-white"
                        data-dropdown-toggle="leave_type-dropdown">
                        Select Status<i class="ti ti-chevron-down ml-1"></i>
                    </a>
                    <ul id="leave_type-dropdown" class="hidden p-4 border rounded bg-white shadow-lg w-40 z-[1]">
                        <li>
                            <a href="javascript:void(0);"
                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">Present</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);"
                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">Absent</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <a href="javascript:void(0);"
                        class="border rounded p-2 bg-white inline-flex items-center focus:bg-primary focus:border-primary focus:text-white"
                        data-dropdown-toggle="days-dropdown">
                        Sort By : Last 7 Days<i class="ti ti-chevron-down ml-1"></i>
                    </a>
                    <ul id="days-dropdown" class="hidden p-4 border rounded bg-white shadow-lg w-40 z-[1]">
                        <li>
                            <a href="javascript:void(0);"
                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">Recently
                                Added</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);"
                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">Ascending</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);"
                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">Desending</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);"
                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">Last
                                Month</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);"
                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">Last
                                7 Days</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="custom-datatable-filter">
                <table class="table datatable w-full border-b border-borderColor">
                    <thead class="thead-light">
                        <tr>
                            <th
                                class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Date</th>
                            <th
                                class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Check In </th>
                            <th
                                class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Status</th>
                            <th
                                class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Check Out</th>
                            <th
                                class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Break</th>
                            <th
                                class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Late</th>
                            <th
                                class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Overtime</th>
                            <th
                                class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Production Hours</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-borderColor">
                        @foreach ($attendances as $item)
                            <tr class="even:bg-white dark:even:bg-white">

                                {{-- Date --}}
                                <td class="px-5 py-2.5 text-gray-500">
                                    {{ $item->date->format('d M Y') }}
                                </td>

                                {{-- Shift Start Time --}}
                                <td class="px-5 py-2.5 text-gray-500">
                                    {{ \Carbon\Carbon::parse($item->shift_start_time)->format('h:i A') }}
                                </td>

                                {{-- Status Badge --}}
                                <td class="px-5 py-2.5 text-gray-500">
                                    @php
                                        $statusClasses = match ($item->status) {
                                            'present' => 'bg-success-100 text-success',
                                            'late' => 'bg-warning-100 text-warning',
                                            'absent' => 'bg-danger-100 text-danger',
                                            'leave' => 'bg-info-100 text-info',
                                            'holiday' => 'bg-primary-100 text-primary',
                                            'offday' => 'bg-gray-200 text-gray-600',
                                            default => 'bg-gray-100 text-gray-600',
                                        };
                                    @endphp

                                    <span
                                        class="{{ $statusClasses }} rounded text-[10px] font-medium leading-4 py-0.5 px-1.5 inline-flex items-center badge-xs">
                                        <i class="ti ti-point-filled me-1"></i>
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>

                                {{-- Clock In --}}
                                <td class="px-5 py-2.5 text-gray-500">
                                    {{ $item->clock_in ? $item->clock_in->format('h:i A') : '-' }}
                                </td>

                                {{-- Late Minutes --}}
                                <td class="px-5 py-2.5 text-gray-500">
                                    {{ $item->late_minutes ?? 0 }} Min
                                </td>

                                {{-- Overtime --}}
                                <td class="px-5 py-2.5 text-gray-500">
                                    {{ $item->overtime_minutes ?? 0 }} Min
                                </td>

                                {{-- Early Exit --}}
                                <td class="px-5 py-2.5 text-gray-500">
                                    {{ $item->early_exit_minutes ?? 0 }} Min
                                </td>

                                {{-- Total Working Hours --}}
                                <td class="px-5 py-2.5 text-gray-500">
                                    @php
                                        $totalMinutes = 0;

                                        if ($item->clock_in && $item->clock_out) {
                                            $totalMinutes = $item->clock_in->diffInMinutes($item->clock_out);
                                        }

                                        $hours = floor($totalMinutes / 60);
                                        $minutes = $totalMinutes % 60;
                                    @endphp

                                    <span
                                        class="bg-success text-white rounded text-[10px] font-medium leading-4 py-0.5 px-1.5 inline-flex items-center badge-xs">
                                        <i class="ti ti-clock-hour-11 me-1"></i>
                                        {{ $totalMinutes ? $hours . 'h ' . $minutes . 'm' : '-' }}
                                    </span>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $attendances->links() }}
        </div>
    </div>
    <!-- /Employee Attendance List -->
    <!-- Attendance Report -->
    <div id="attendance_report"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[1055] justify-center items-center flex-wrap w-full md:inset-0 h-[calc(100%-1rem)] max-h-full  transition-all duration-300 ease-in-out modal p-4">
        <div class="relative p-4 w-full max-w-[800px] max-h-full">
            <div class="relative bg-white rounded-defaultradius">
                <div class="flex items-center justify-between p-4 border-b border-borderColor">
                    <h4 class="font-semibold">Attendance</h4>
                    <button type="button"
                        class="end-2.5 text-white bg-gray-500 hover:bg-danger hover:text-white rounded-full text-xs leading-normal size-5 ms-auto inline-flex justify-center items-center"
                        data-modal-hide="attendance_report">
                        <i class="ti ti-x"></i>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <form action="attendance-employee.htmlaa">
                    <div class="p-[20px]">
                        <div class="p-4 bg-light mb-4 rounded-[5px]">
                            <div class="grid grid-cols-1 md:grid-cols-12 gap-y-4 gap-x-6">
                                <div class="md:col-span-3">
                                    <div class="mb-3">
                                        <span>Date</span>
                                        <p class="text-dark font-medium">15 Apr 2025</p>
                                    </div>
                                </div>
                                <div class="md:col-span-3">
                                    <div class="mb-3">
                                        <span>Punch in at</span>
                                        <p class="text-dark font-medium">09:00 AM</p>
                                    </div>
                                </div>
                                <div class="md:col-span-3">
                                    <div class="mb-3">
                                        <span>Punch out at</span>
                                        <p class="text-dark font-medium">06:45 PM</p>
                                    </div>
                                </div>
                                <div class="md:col-span-3">
                                    <div class="mb-3">
                                        <span>Status</span>
                                        <p class="text-dark font-medium">Present</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-4 border border-borderColor rounded-[5px]">
                            <div class="grid grid-cols-1 md:grid-cols-12 gap-y-4 gap-x-6">
                                <div class="md:col-span-3">
                                    <div class="mb-4">
                                        <p class="flex items-center mb-1"><i
                                                class="ti ti-point-filled text-dark-transparent me-1"></i>Total Working
                                            hours</p>
                                        <h3>12h 36m</h3>
                                    </div>
                                </div>
                                <div class="md:col-span-3">
                                    <div class="mb-4">
                                        <p class="flex items-center mb-1"><i
                                                class="ti ti-point-filled text-success me-1"></i>Productive Hours</p>
                                        <h3>08h 36m</h3>
                                    </div>
                                </div>
                                <div class="md:col-span-3">
                                    <div class="mb-4">
                                        <p class="flex items-center mb-1"><i
                                                class="ti ti-point-filled text-warning me-1"></i>Break hours</p>
                                        <h3>22m 15s</h3>
                                    </div>
                                </div>
                                <div class="md:col-span-3">
                                    <div class="mb-4">
                                        <p class="flex items-center mb-1"><i
                                                class="ti ti-point-filled text-info me-1"></i>Overtime</p>
                                        <h3>02h 15m</h3>
                                    </div>
                                </div>
                                <div class="md:col-span-12">
                                    <div class="grid md:grid-cols-1 gap-4">
                                        <div class="col-span-1">
                                            <div class="relative w-full bg-gray-200 rounded mb-3 m-auto"
                                                style="height: 24px; width: 500px;">
                                                <div class="absolute top-0  h-full bg-success rounded"
                                                    style="width: 16%;"></div>
                                                <div class="absolute top-0 h-full bg-warning rounded"
                                                    style="width: 5%; left: 86px;"></div>
                                                <div class="absolute top-0 h-full bg-success rounded"
                                                    style="width: 26%; left: 119px;"></div>
                                                <div class="absolute top-0 h-full bg-warning rounded"
                                                    style="width: 15%; left: 256px;"></div>
                                                <div class="absolute top-0 h-full bg-success rounded"
                                                    style="width: 20%; left: 336px;"></div>
                                                <div class="absolute top-0 h-full bg-warning rounded"
                                                    style="width: 5%; right: 34px;"></div>
                                                <div class="absolute top-0 h-full bg-blue-500 rounded"
                                                    style="width: 3%; right: 12px;"></div>
                                                <div class="absolute top-0 h-full bg-blue-500 rounded"
                                                    style="width: 1%; right: 0;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="md:col-span-12">
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs">06:00</span>
                                        <span class="text-xs">07:00</span>
                                        <span class="text-xs">08:00</span>
                                        <span class="text-xs">09:00</span>
                                        <span class="text-xs">10:00</span>
                                        <span class="text-xs">11:00</span>
                                        <span class="text-xs">12:00</span>
                                        <span class="text-xs">01:00</span>
                                        <span class="text-xs">02:00</span>
                                        <span class="text-xs">03:00</span>
                                        <span class="text-xs">04:00</span>
                                        <span class="text-xs">05:00</span>
                                        <span class="text-xs">06:00</span>
                                        <span class="text-xs">07:00</span>
                                        <span class="text-xs">08:00</span>
                                        <span class="text-xs">09:00</span>
                                        <span class="text-xs">10:00</span>
                                        <span class="text-xs">11:00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Attendance Report -->
</div>
