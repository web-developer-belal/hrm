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
    <div class="grid grid-cols-1 xl:grid-cols-12 gap-3">
        <div class="md:col-span-4 flex">
            <div class="card border-borderColor border rounded-[5px] bg-white shadow-xs w-full">
                <div class="card-body p-5">
                    <div class="text-center mb-3">
                        <h6 class="text-gray-500 mb-2 font-medium">
                            Good {{ now()->format('A') == 'AM' ? 'Morning' : 'Evening' }}, {{ $employee->name }}
                        </h6>
                        <h3>{{ now()->format('h:i A, d M Y') }}</h3>
                    </div>

                    <div class="text-center mb-3">
                        <div class="flex justify-center">
                            <img src="{{ customAsset($employee->photo,true,'user') }}"
                                class="p-1 rounded-full w-[125px]">
                        </div>
                        <div>
                            <span class="bg-primary text-white text-xs font-medium px-2.5 py-0.5 rounded">
                                Production : {{ $productivityHours ?? '0h 0m' }}
                            </span>
                        </div>
                    </div>

                    <div class="flex items-center justify-center">
                        <span class="font-medium">
                            <i class="ti ti-fingerprint text-primary me-2"></i>
                            @if ($todayAttendance && $todayAttendance->clock_in)
                                Punch In at
                                {{ \Carbon\Carbon::parse($todayAttendance->clock_in)->format('h:i A') }}
                            @else
                                Not Punched In Yet
                            @endif
                        </span>
                    </div>

                    <div class="w-full">
                        @if (!$todayAttendance || !$todayAttendance->clock_in)
                            <button wire:click="punchIn"
                                class="text-white bg-success font-medium rounded-[5px] text-sm px-5 py-2.5 mt-2 w-full">
                                Punch In
                            </button>
                        @elseif(!$todayAttendance->clock_out)
                            <button wire:click="punchOut"
                                class="text-white bg-dark font-medium rounded-[5px] text-sm px-5 py-2.5 mt-2 w-full">
                                Punch Out
                            </button>
                        @else
                            <button disabled
                                class="text-white bg-gray-400 font-medium rounded-[5px] text-sm px-5 py-2.5 mt-2 w-full">
                                Completed
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-8 md:col-span-8 flex">
            <div class="grid grid-cols-12 gap-x-6 w-full">

                <!-- TOTAL PRESENT -->
                <div class="col-span-3 flex mb-6">
                    <div class="card border-borderColor border bg-white shadow-xs rounded-[5px] w-full">
                        <div class="card-body p-5">
                            <div class="pb-3 border-b border-borderColor">
                                <span class="p-1 rounded-[5px] bg-primary mb-2">
                                    <i class="ti ti-clock-stop text-white"></i>
                                </span>
                                <div class="mt-2">
                                    <h2>{{ $totalPresent }}</h2>
                                    <p class="font-medium truncate">Total Present</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TOTAL ABSENT -->
                <div class="col-span-3 flex mb-6">
                    <div class="card border-borderColor border bg-white shadow-xs rounded-[5px] w-full">
                        <div class="card-body p-5">
                            <div class="pb-3 border-b border-borderColor">
                                <span class="p-1 rounded-[5px] bg-dark mb-2">
                                    <i class="ti ti-clock-up text-white"></i>
                                </span>
                                <div class="mt-2">
                                    <h2>{{ $totalAbsent }}</h2>
                                    <p class="font-medium truncate">Total Absent</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TOTAL ON TIME -->
                <div class="col-span-3 flex mb-6">
                    <div class="card border-borderColor border bg-white shadow-xs rounded-[5px] w-full">
                        <div class="card-body p-5">
                            <div class="pb-3 border-b border-borderColor">
                                <span class="p-1 rounded-[5px] bg-info mb-2">
                                    <i class="ti ti-calendar-up text-white"></i>
                                </span>
                                <div class="mt-2">
                                    <h2>
                                        {{ $totalOnTime }}
                                        <span class="text-lg text-gray-500">/ {{ $totalWorkingDays }}</span>
                                    </h2>
                                    <p class="font-medium truncate">Total On Time</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TOTAL LATE -->
                <div class="col-span-3 flex mb-6">
                    <div class="card border-borderColor border bg-white shadow-xs rounded-[5px] w-full">
                        <div class="card-body p-5">
                            <div class="pb-3 border-b border-borderColor">
                                <span class="p-1 rounded-[5px] bg-pink mb-2">
                                    <i class="ti ti-calendar-star text-white"></i>
                                </span>
                                <div class="mt-2">
                                    <h2>
                                        {{ $totalLate }}
                                        <span class="text-lg text-gray-500">/ {{ $totalWorkingDays }}</span>
                                    </h2>
                                    <p class="font-medium truncate">Total Late</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- WORKING HOURS SECTION -->
                <div class="col-span-12 flex">
                    <div class="card border-bordercolor bg-white rounded-[5px] shadow-xs w-full">
                        <div class="card-body p-5">
                            <div class="flex items-center justify-center mb-4">
                                <div class="w-full">
                                    <span class="flex items-center mb-1">
                                        <i class="ti ti-point-filled me-1"></i>Total Working hours
                                    </span>
                                    <h3>{{ $totalWorkingHours ?? '0h 0m' }}</h3>
                                </div>
                                <div class="w-full">
                                    <span class="flex items-center mb-1">
                                        <i class="ti ti-point-filled text-success me-1"></i>Productive Hours
                                    </span>
                                    <h3>{{ $productivityHours ?? '0h 0m' }}</h3>
                                </div>
                                <div class="w-full">
                                    <span class="flex items-center mb-1">
                                        <i class="ti ti-point-filled text-warning me-1"></i>Break hours
                                    </span>
                                    <h3>{{ $breakHours ?? '0m' }}</h3>
                                </div>
                                <div class="w-full">
                                    <span class="flex items-center mb-1">
                                        <i class="ti ti-point-filled text-info me-1"></i>Overtime
                                    </span>
                                    <h3>{{ $overtimeHours ?? '0m' }}</h3>
                                </div>
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
            <div class="p-3">

                {{ $attendances->links() }}
            </div>
        </div>
    </div>
    <!-- /Employee Attendance List -->

</div>
