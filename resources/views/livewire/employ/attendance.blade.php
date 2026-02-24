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
                    <li aria-current="page" class="text-xs text-gray-900">Attendance</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Employee Attendance  View -->
    <div class="grid grid-cols-1 xl:grid-cols-12 gap-6 pb-5">
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
                        <input type="search" wire:model.live.debounce.500s='search'
                            class="block flex-1 border border-borderColor bg-white rounded-[5px] py-1.5 pl-2.5 pr-8 text-gray-900 placeholder:text-gray-400 focus:ring-0 focus:border-borderColor h-[38px] text-sm date-range"
                            placeholder="Search here...">
                    </div>
                </div>

            </div>
        </div>
        <div class="card-body p-0">
            <div class="overflow-x-auto">
                <table class="table w-full border-b border-borderColor">
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
                                    {{ \Carbon\Carbon::parse($item->clock_in)->format('h:i A') }}
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
                                    {{ $item->clock_out ? $item->clock_out->format('h:i A') : '-' }}
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
            <div class="p-3">

                {{ $attendances->links() }}
            </div>
        </div>
    </div>
    <!-- /Employee Attendance List -->

</div>
