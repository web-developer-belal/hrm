<div>

    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">Employee Dashboard</h2>
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
                    <li class="text-xs text-default">Dashboard</li>
                    <li>
                        <span class="text-default">/</span>
                    </li>
                    <li aria-current="page" class="text-xs text-gray-900">Employee Dashboard</li>
                </ol>
            </nav>
        </div>
        <div class="flex my-xl-auto right-content items-center flex-wrap ">

            <div class="mb-2">
                <div class="relative w-[120px]">
                    <div class="absolute inset-y-0 start-2 flex items-center pointer-events-none">
                        <i class="ti ti-calendar text-gray-900 text-base leading-normal"></i>
                    </div>
                    <input type="text"
                        class="flatpickr-input flat-monthpickr bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 ps-6 px-2.5 h-[38px] placeholder:text-gray-400">
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

    <!-- Welcome Wrap -->
    <div id="alert-1" class="flex items-center p-4 mb-4 text-secondary rounded-lg bg-secondary-transparent"
        role="alert">
        <p>Your Leave Request on“24th April 2024”has been Approved!!!</p>
        <button type="button" class="ms-auto text-gray-900 " data-dismiss-target="#alert-1" aria-label="Close">
            <span class="sr-only">Close</span>
            <i class="ti ti-x"></i>
        </button>
    </div>
    <!-- /Welcome Wrap -->
    <div class="grid grid-cols-1 xl:grid-cols-12 gap-6 pb-5">
        <div class="col-span-8 flex">
            <div class="grid grid-cols-1 xl:grid-cols-12 gap-x-6 w-full">
                <div class="xl:col-span-3 flex mb-6">
                    <div class="md:flex items-center justify-center gap-3 w-full">
                        <div class="card border-borderColor border bg-white shadow-xs rounded-[5px] w-full">
                            <div class="card-body p-5">
                                <div class="pb-3  border-b border-borderColor">
                                    <span class="p-1 rounded-[5px] bg-primary mb-2">
                                        <i class="ti ti-clock-stop text-white"></i>
                                    </span>
                                    <div class="mt-2">
                                        <h2>{{ $attendanceData['present'] }}</h2>
                                        <p class="font-medium truncate">Total Present</p>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <span class="flex items-center text-xs truncate"><i
                                            class="ti ti-arrow-up me-2 filled p-1 bg-success text-white rounded-full"></i>5%
                                        This Week</span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="xl:col-span-3 flex mb-6">
                    <div class="flex items-center justify-center gap-3 w-full">
                        <div class="card border-borderColor border bg-white shadow-xs rounded-[5px] w-full">
                            <div class="card-body p-5">
                                <div class="pb-3 border-b border-borderColor">
                                    <span class="p-1 rounded-[5px] bg-dark mb-2">
                                        <i class="ti ti-clock-up text-white"></i>
                                    </span>
                                    <div class="mt-2">
                                        <h2>{{ $attendanceData['absent'] }}</h2>
                                        <p class="font-medium truncate">Total Absent</p>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <span class="flex items-center text-xs truncate"><i
                                            class="ti ti-arrow-up me-2 filled p-1 bg-success text-white rounded-full"></i>7%
                                        Last Week</span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="xl:col-span-3 flex mb-6">
                    <div class="flex items-center justify-center gap-3 w-full">
                        <div class="card border-borderColor border bg-white shadow-xs rounded-[5px] w-full">
                            <div class="card-body p-5">
                                <div class="pb-3 border-b border-borderColor">
                                    <span class="p-1 rounded-[5px] bg-info mb-2">
                                        <i class="ti ti-calendar-up text-white"></i>
                                    </span>
                                    <div class="mt-2">
                                        <h2>{{ $attendanceData['on_time'] }}</h2>
                                        <p class="font-medium truncate">Total On time</p>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <span
                                        class="flex items-center text-xs overflow-hidden text-ellipsis whitespace-nowrap"><i
                                            class="ti ti-arrow-down me-2 filled p-1 bg-danger text-white rounded-full"></i>8%
                                        Last Month</span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="xl:col-span-3 flex mb-6">
                    <div class="flex items-center justify-center gap-3 w-full">
                        <div class="card border-borderColor border bg-white shadow-xs rounded-[5px] w-full">
                            <div class="card-body p-5">
                                <div class="pb-3 border-b border-borderColor">
                                    <span class="p-1 rounded-[5px] bg-pink mb-2">
                                        <i class="ti ti-calendar-star text-white"></i>
                                    </span>
                                    <div class="mt-2">
                                        <h2>{{ $attendanceData['late'] }}</h2>
                                        <p class="font-medium overflow-hidden text-ellipsis whitespace-nowrap">Total
                                            Late</p>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <span
                                        class="flex items-center text-xs overflow-hidden text-ellipsis whitespace-nowrap"><i
                                            class="ti ti-arrow-down me-2 filled p-1 bg-danger text-white rounded-full"></i>6%
                                        Last Month</span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="xl:col-span-12 flex">
                    <div class="card border-bordercolor bg-white rounded-[5px] shadow-xs w-full">
                        <div class="card-body p-5">
                            <div class="flex items-center justify-center mb-4">
                                <div class="w-full">
                                    <span class="flex items-center mb-1"><i class="ti ti-point-filled me-1"></i>Total
                                        Working hours</span>
                                    <h3>{{ $attendanceData['working_hours'] }}</h3>
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
                                    <h3>{{ $attendanceData['overtime'] }}</h3>
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
        <div class="col-span-4 flex">
            <div
                class="card border-borderColor border-primary bg-custom-gradient border rounded-[5px] bg-white shadow-xs w-full">
                <div class="card-body p-5">

                    {{-- Current Date Time --}}
                    <div class="text-center mb-4">
                        <h6 class="text-gray-500 mb-2 font-medium">Attendance</h6>
                        <h4>{{ now()->format('h:i A, d M Y') }}</h4>
                    </div>

                    {{-- Circular Total Hours --}}
                    @php
                        $workedSeconds = 0;

                        if ($todayAttendance && $todayAttendance->clock_in) {
                            $endTime = $todayAttendance->clock_out ?? now();
                            $workedSeconds = \Carbon\Carbon::parse($todayAttendance->clock_in)->diffInSeconds(
                                \Carbon\Carbon::parse($endTime),
                            );
                        }

                        $hours = floor($workedSeconds / 3600);
                        $minutes = floor(($workedSeconds % 3600) / 60);
                        $seconds = $workedSeconds % 60;

                        $formattedTime = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);

                        // Shift duration for percentage (assuming 9 hours shift)
                        $shiftSeconds = 9 * 3600;
                        $percentage = min(100, ($workedSeconds / $shiftSeconds) * 100);
                        $rotation = ($percentage / 100) * 180;
                    @endphp

                    <div class="w-[130px] h-[130px] bg-white rounded-full leading-[38px] relative mx-auto mb-3"
                        data-value="{{ round($percentage) }}">

                        <span class="left-0 w-[50%] h-[100%] overflow-hidden absolute top-0 z-[1]">
                            <span style="transform: rotate({{ $rotation }}deg);"
                                class="left-[100%] rounded-tr-[80px] rounded-br-[80px] border-success border-l-0 origin-left
                        w-full h-full bg-transparent border-4 border-solid absolute top-0">
                            </span>
                        </span>

                        <span class="right-0 w-[50%] h-[100%] overflow-hidden absolute top-0 z-[1]">
                            <span
                                class="transform rotate-[180deg] absolute left-[-100%] rounded-tl-[80px] rounded-bl-[80px] border-success border-r-0 origin-right
                        w-full h-full bg-transparent border-4 border-solid absolute top-0">
                            </span>
                        </span>

                        <div
                            class="absolute left-[50%] top-[50%] transform -translate-x-1/2 -translate-y-1/2 leading-normal text-center w-100">
                            <span class="text-[13px] block mb-1">Total Hours</span>
                            <h6>{{ $formattedTime }}</h6>
                        </div>
                    </div>

                    <div class="text-center">

                        {{-- Production Time --}}
                        <div
                            class="text-white font-medium inline-flex items-center py-1 px-2 rounded bg-dark leading-none mb-3">
                            Production : {{ $hours }}h {{ $minutes }}m
                        </div>

                        {{-- Punch In Info --}}
                        @if ($todayAttendance && $todayAttendance->clock_in)
                            <h6 class="fw-medium flex items-center justify-center mb-4">
                                <i class="ti ti-fingerprint text-primary me-1"></i>
                                Punch In at {{ \Carbon\Carbon::parse($todayAttendance->clock_in)->format('h:i A') }}
                            </h6>
                        @endif

                        {{-- Button Toggle --}}
                        <div>
                            @if (!$todayAttendance || !$todayAttendance->clock_in)
                                <button wire:click="punchIn" type="button"
                                    class="btn btn-primary font-medium me-2 mt-2 w-full">
                                    Punch In
                                </button>
                            @elseif(!$todayAttendance->clock_out)
                                <button wire:click="punchOut" type="button"
                                    class="btn btn-primary font-medium me-2 mt-2 w-full">
                                    Punch Out
                                </button>
                            @else
                                <button type="button" class="btn btn-secondary font-medium me-2 mt-2 w-full"
                                    disabled>
                                    Completed
                                </button>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-12 gap-6 pb-5">
        <div class="xl:col-span-9 flex">
            <div class="card  border border-borderColor rounded-[5px] shadow-xs bg-white flex-1">
                <div
                    class="card-header py-4 px-5 flex items-center justify-between flex-wrap border-b border-borderColor gap-2">
                    <h5>
                        Notices
                    </h5>
                </div>
                <div class="card-body p-5">
                    <div class="overflow-x-auto">
                        <table class="table  w-full border-b border-borderColor">
                            <thead class="thead-light">
                                <tr>
                                    <th
                                        class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                        SL</th>
                                    <th
                                        class="text-sm text-start leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                        Title</th>
                                    <th
                                        class="text-sm text-start leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                        Date</th>

                                    <th
                                        class="text-sm text-start leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-borderColor">
                                @foreach ($notices as $item)
                                    <tr class="even:bg-white dark:even:bg-white">

                                        {{-- Sl --}}
                                        <td class="px-5 py-2.5 text-gray-500">
                                            {{ $loop->index + 1 }}
                                        </td>
                                        {{-- title --}}
                                        <td class="px-5 py-2.5 text-gray-500">
                                            {{ $item->title }}
                                        </td>

                                        {{-- Date --}}
                                        <td class="px-5 py-2.5 text-gray-500">
                                            {{ $item->created_at->format('d M Y') }}
                                        </td>

                                        <td class="px-5 py-2.5 text-gray-500">
                                            <div class="action-icon inline-flex">

                                                <a href="{{ route('employee.notices.view', ['notice' => $item->id]) }}"
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
            </div>
        </div>

        <div class="xl:col-span-3 flex">
            <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white flex-1">
                <div
                    class="card-header py-4 px-5 flex items-center justify-between flex-wrap border-b border-borderColor gap-2">
                    <h5>Leave Details</h5>
                    <div>
                        <a href="javascript:void(0);"
                            class="border rounded py-1 px-2 text-xs font-medium bg-white inline-flex items-center focus:bg-primary focus:border-primary focus:text-white text-gray-900"
                            data-dropdown-toggle="week-dropdown1">
                            <i class="ti ti-calendar me-1"></i>2024
                        </a>
                        <ul id="week-dropdown1" class="hidden p-4 border rounded bg-white shadow-lg w-40 z-[1]">
                            <li>
                                <a href="javascript:void(0);"
                                    class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary text-gray-900">2024</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);"
                                    class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary text-gray-900">2023</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);"
                                    class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary text-gray-900">2022</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body p-5">
                    <div class="grid grid-cols-1 sm:grid-cols-12 gap-x-4">
                        <div class="sm:col-span-6">
                            <div class="mb-6">
                                <span class="block mb-1">Total Leaves</span>
                                <h4>{{ $leaveData['total'] }}</h4>
                            </div>
                        </div>
                        <div class="sm:col-span-6">
                            <div class="mb-6">
                                <span class="block mb-1">Taken</span>
                                <h4>{{ $leaveData['taken'] }}</h4>
                            </div>
                        </div>
                        <div class="sm:col-span-6">
                            <div class="mb-6">
                                <span class="block mb-1">Absent</span>
                                <h4>{{ $leaveData['absent'] }}</h4>
                            </div>
                        </div>
                        <div class="sm:col-span-6">
                            <div class="mb-6">
                                <span class="block mb-1">Request</span>
                                <h4>{{ $leaveData['request'] }}</h4>
                            </div>
                        </div>
                        <div class="sm:col-span-6">
                            <div class="mb-6">
                                <span class="block mb-1">Worked Days</span>
                                <h4>{{ $leaveData['workingDays'] }}</h4>
                            </div>
                        </div>
                        <div class="sm:col-span-6">
                            <div class="mb-6">
                                <span class="block mb-1">Loss of Pay</span>
                                <h4>{{ $leaveData['lossOfPay'] }}</h4>
                            </div>
                        </div>
                        <div class="sm:col-span-12">
                            <div>
                                <a href="#"
                                    class="flex items-center justify-center bg-dark text-sm font-medium py-2 rounded text-white px-3"
                                    data-modal-toggle="add_leaves" data-modal-target="add_leaves">Apply New Leave</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-12 gap-x-6 gap-y-4 pb-5">
        <div class="xl:col-span-9 flex">
            <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white flex-1">
                <div
                    class="card-header py-4 px-5 flex items-center justify-between flex-wrap border-b border-borderColor">
                    <h5>Performance</h5>
                    <div>
                        <a href="javascript:void(0);"
                            class="border rounded p-1 bg-white inline-flex items-center focus:bg-primary focus:border-primary focus:text-white text-gray-900"
                            data-dropdown-toggle="emp-dropdown">
                            <i class="ti ti-calendar me-1"></i>2024
                        </a>
                        <ul id="emp-dropdown" class="hidden z-[9] p-4 border rounded bg-white shadow-lg">
                            <li>
                                <a href="javascript:void(0);"
                                    class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary text-gray-900">2024</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);"
                                    class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary text-gray-900">2023
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);"
                                    class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary text-gray-900">2022
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body p-5">
                    <div>
                        <div class="bg-light flex items-center rounded p-2">
                            <h3 class="me-2">98%</h3>
                            <span
                                class="badge badge-outline-success bg-success-transparent rounded-pill me-1">12%</span>
                            <span>vs last years</span>
                        </div>
                        <div id="performance_chart2"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="xl:col-span-3">
            <div class="flex-fill">
                <div class="card bg-dark mb-3 relative">
                    <span class="absolute	w-full top-0 left-0 z-10 right-0">
                        <img src="{{ asset('assets/img/bg/card-bg-05.png') }}" alt="">
                    </span>
                    <div class="card-body p-5">
                        <div class="text-center">
                            <h5 class="text-white mb-4">Team Birthday</h5>
                            <span class="inline-flex items-center justify-center size-[57.6px] mb-2">
                                <img src="{{ asset('assets/img/users/user-35.jpg') }}" class="rounded-full"
                                    alt="Img">
                            </span>
                            <div class="mb-4">
                                <h6 class="text-white font-medium mb-1">Andrew Jermia</h6>
                                <p>IOS Developer</p>
                            </div>
                            <a href="#" class="btn btn-sm btn-primary">Send Wishes</a>
                        </div>
                    </div>
                </div>
                <div class="card bg-secondary border border-borderColor rounded mb-3">
                    <div class="card-body flex items-center justify-between p-3">
                        <div>
                            <h5 class="text-white mb-1">Leave Policy</h5>
                            <p class="text-white">Last Updated : Today</p>
                        </div>
                        <a href="#" class="btn bg-white btn-sm px-3">View All</a>
                    </div>
                </div>
                <div class="card bg-warning border border-borderColor rounded">
                    <div class="card-body flex items-center justify-between p-3">
                        <div>
                            <h5 class="mb-1">Next Holiday</h5>
                            <p class="text-gray-900">Diwali, 15 Sep 2025</p>
                        </div>
                        <a href="" class="btn bg-white btn-sm px-3">View All</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
