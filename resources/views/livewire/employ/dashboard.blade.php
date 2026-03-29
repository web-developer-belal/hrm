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
                    <x-form.date-range-picker />
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
    {{-- <div id="alert-1" class="flex items-center p-4 mb-4 text-secondary rounded-lg bg-secondary-transparent"
        role="alert">
        <p>Your Leave Request on“24th April 2024”has been Approved!!!</p>
        <button type="button" class="ms-auto text-gray-900 " data-dismiss-target="#alert-1" aria-label="Close">
            <span class="sr-only">Close</span>
            <i class="ti ti-x"></i>
        </button>
    </div> --}}
    <!-- /Welcome Wrap -->

    @php
        $chg = fn(string $key, bool $goodWhenUp = true): array => [
            'color' => ($attendanceData[$key] >= 0) === $goodWhenUp ? 'text-success' : 'text-danger',
            'icon'  => $attendanceData[$key] >= 0 ? 'fa-caret-up' : 'fa-caret-down',
            'label' => ($attendanceData[$key] >= 0 ? '+' : '') . $attendanceData[$key] . '%',
        ];
    @endphp
    
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
                                        <h2 class="flex gap-2 items-center">{{ $attendanceData['present'] }}
                                            @php $c = $chg('present_change', true); @endphp
                                            <span class="text-xs leading-normal font-medium {{ $c['color'] }}"><i
                                                    class="fa-solid {{ $c['icon'] }} me-1"></i>{{ $c['label'] }}</span>
                                        </h2>
                                        <p class="font-medium truncate">Total Present</p>
                                    </div>
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
                                        <h2 class="flex gap-2 items-center">{{ $attendanceData['absent'] }}
                                            @php $c = $chg('absent_change', false); @endphp
                                            <span class="text-xs leading-normal font-medium {{ $c['color'] }}"><i
                                                    class="fa-solid {{ $c['icon'] }} me-1"></i>{{ $c['label'] }}</span>
                                        </h2>
                                        <p class="font-medium truncate">Total Absent</p>
                                    </div>
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
                                        <h2 class="flex gap-2 items-center">{{ $attendanceData['on_time'] }}
                                            @php $c = $chg('on_time_change', true); @endphp
                                            <span class="text-xs leading-normal font-medium {{ $c['color'] }}"><i
                                                    class="fa-solid {{ $c['icon'] }} me-1"></i>{{ $c['label'] }}</span>
                                        </h2>
                                        <p class="font-medium truncate">Total On time</p>
                                    </div>
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
                                        <h2 class="flex gap-2 items-center">{{ $attendanceData['late'] }}
                                            @php $c = $chg('late_change', false); @endphp
                                            <span class="text-xs leading-normal font-medium {{ $c['color'] }}"><i
                                                    class="fa-solid {{ $c['icon'] }} me-1"></i>{{ $c['label'] }}</span>
                                        </h2>
                                        <p class="font-medium overflow-hidden text-ellipsis whitespace-nowrap">Total
                                            Late</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="xl:col-span-12 flex">
                    <x-attendance.today-work-distribution :attendance="$todayAttendanceForCircle" />
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
                        <h4 id="live-time-display">{{ now()->format('h:i A, d-M-Y') }}</h4>
                    </div>

                    {{-- Circular Total Hours --}}
                    <div id="attendance-circle">
                        <div class="w-32.5 h-32.5 bg-white rounded-full relative mx-auto mb-3"
                            id="circle-container"
                            style="width: 130px; height: 130px; line-height: 38px;">
                            <svg
                                class="absolute inset-0 -rotate-90"
                                viewBox="0 0 130 130"
                                role="progressbar"
                                aria-valuemin="0"
                                aria-valuemax="100"
                                aria-valuenow="0">
                                <circle
                                    cx="65"
                                    cy="65"
                                    r="56"
                                    fill="none"
                                    stroke="#e5e7eb"
                                    stroke-width="6">
                                </circle>
                                <circle
                                    id="circle-progress"
                                    cx="65"
                                    cy="65"
                                    r="56"
                                    fill="none"
                                    stroke="#10b981"
                                    stroke-width="6"
                                    stroke-linecap="round"
                                    stroke-dasharray="351.858"
                                    stroke-dashoffset="351.858">
                                </circle>
                            </svg>

                            <div class="absolute rounded-full bg-white" style="inset: 11px; z-index: 1;"></div>

                            <div class="absolute leading-normal text-center" 
                                style="left: 50%; top: 50%; transform: translate(-50%, -50%); width: 100%; z-index: 2;">
                                <span class="text-xs block mb-1">Total Hours</span>
                                <h6 id="time-display">00:00:00</h6>
                            </div>
                        </div>

                        <div class="text-center">

                            {{-- Production Time --}}
                            <div
                                class="text-white font-medium inline-flex items-center py-1 px-2 rounded bg-dark leading-none mb-3">
                                Production : <span id="production-display">0h 0m</span>
                            </div>

                            {{-- Punch In Info --}}
                            @if ($todayAttendanceForCircle && $todayAttendanceForCircle->clock_in)
                                <h6 class="fw-medium flex items-center justify-center mb-4">
                                    <i class="ti ti-fingerprint text-primary me-1"></i>
                                    Punch In at {{ \Carbon\Carbon::parse($todayAttendanceForCircle->clock_in)->format('h:i A') }}
                                </h6>
                            @endif

                            {{-- Button Toggle --}}
                            <div>
                                @if (!$todayAttendanceForCircle || !$todayAttendanceForCircle->clock_in)
                                    <button wire:click="punchIn" type="button"
                                        class="btn btn-primary font-medium me-2 mt-2 w-full">
                                        <span wire:loading wire:target="punchIn">
                                            <i class="ti ti-loader animate-spin"></i>
                                        </span>
                                        Punch In
                                    </button>
                                @elseif(!$todayAttendanceForCircle->clock_out)
                                    <button wire:click="punchOut" type="button"
                                        class="btn btn-primary font-medium me-2 mt-2 w-full">
                                        <span wire:loading wire:target="punchOut">
                                            <i class="ti ti-loader animate-spin"></i>
                                        </span>
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

                    <script>
                    (function() {
                        const clockInTimestamp = @js($todayAttendanceForCircle?->clock_in?->timestamp);
                        const clockOutTimestamp = @js($todayAttendanceForCircle?->clock_out?->timestamp);
                        const shiftSeconds = {{ $shiftSeconds }};
                        const circleCircumference = 2 * Math.PI * 56;
                        const dhakaTimeFormatter = new Intl.DateTimeFormat('en-US', {
                            timeZone: 'Asia/Dhaka',
                            hour: '2-digit',
                            minute: '2-digit',
                            second: '2-digit',
                            hour12: true,
                        });
                        const dhakaDateFormatter = new Intl.DateTimeFormat('en-US', {
                            timeZone: 'Asia/Dhaka',
                            year: 'numeric',
                            month: 'short',
                            day: '2-digit',
                        });
                        const liveTimeDisplay = document.getElementById('live-time-display');
                        const timeDisplay = document.getElementById('time-display');
                        const productionDisplay = document.getElementById('production-display');
                        const circleProgress = document.getElementById('circle-progress');
                        const circleContainer = document.getElementById('circle-container');

                        function setCircleProgress(percentage) {
                            if (!circleProgress || !circleContainer) {
                                return;
                            }

                            const safePercentage = Math.max(0, Math.min(100, percentage));
                            const dashOffset = circleCircumference - ((safePercentage / 100) * circleCircumference);

                            circleProgress.style.strokeDasharray = String(circleCircumference);
                            circleProgress.style.strokeDashoffset = String(dashOffset);
                            circleContainer.setAttribute('aria-valuenow', Math.round(safePercentage));
                        }

                        function updateLiveTime() {
                            const now = new Date();
                            if (liveTimeDisplay) {
                                liveTimeDisplay.textContent = dhakaTimeFormatter.format(now) + ', ' + dhakaDateFormatter.format(now);
                            }
                        }

                        function updateCircle() {
                            if (!clockInTimestamp) {
                                timeDisplay.textContent = '00:00:00';
                                productionDisplay.textContent = '0h 0m';
                                setCircleProgress(0);
                                return;
                            }

                            const nowTimestamp = Math.floor(Date.now() / 1000);
                            const activeEndTimestamp = clockOutTimestamp ?? nowTimestamp;
                            const workedSeconds = Math.max(0, activeEndTimestamp - clockInTimestamp);

                            const hours = Math.floor(workedSeconds / 3600);
                            const minutes = Math.floor((workedSeconds % 3600) / 60);
                            const seconds = workedSeconds % 60;

                            const percentage = shiftSeconds > 0 ? (workedSeconds / shiftSeconds) * 100 : 0;

                            const timeStr = String(hours).padStart(2, '0') + ':' + 
                                           String(minutes).padStart(2, '0') + ':' + 
                                           String(seconds).padStart(2, '0');
                            timeDisplay.textContent = timeStr;
                            productionDisplay.textContent = hours + 'h ' + minutes + 'm';
                            setCircleProgress(percentage);
                        }

                        if (window.attendanceDashboardLiveTimer) {
                            clearInterval(window.attendanceDashboardLiveTimer);
                        }

                        if (window.attendanceDashboardProgressTimer) {
                            clearInterval(window.attendanceDashboardProgressTimer);
                        }

                        updateLiveTime();
                        updateCircle();
                        window.attendanceDashboardLiveTimer = setInterval(updateLiveTime, 1000);
                        window.attendanceDashboardProgressTimer = setInterval(updateCircle, 1000);
                    })();
                    </script>
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
                                            {{ $item->created_at->format('d-M-Y') }}
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
                                <a href="{{ route('employee.leave.create') }}"
                                    class="flex items-center justify-center bg-dark text-sm font-medium py-2 rounded text-white px-3"
                                    >Apply New Leave</a>
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

                </div>
                <div class="card-body p-5"
                    x-data="window.attendancePerformanceChart(@js($performanceChartData['categories']), @js($performanceChartData['series']))"
                    x-init="render()">
                    <div>
                        <div x-ref="chartEl" id="my-performance_chart2" style="min-height: 220px;"></div>
                    </div>
                </div>
            </div>
        </div>

        @once
            <script>
                window.attendancePerformanceChart = window.attendancePerformanceChart || function(categories, series) {
                    return {
                        chart: null,
                        render() {
                            if (!this.$refs.chartEl || typeof ApexCharts === 'undefined') {
                                return;
                            }

                            if (this.chart) {
                                this.chart.destroy();
                            }

                            const options = {
                                series: [{
                                    name: 'Worked Hours',
                                    data: series,
                                }],
                                chart: {
                                    height: 220,
                                    type: 'area',
                                    zoom: {
                                        enabled: false,
                                    },
                                    toolbar: {
                                        show: false,
                                    },
                                },
                                colors: ['#03C95A'],
                                dataLabels: {
                                    enabled: false,
                                },
                                stroke: {
                                    curve: 'straight',
                                },
                                xaxis: {
                                    categories: categories,
                                },
                                yaxis: {
                                    min: 0,
                                    tickAmount: 5,
                                    labels: {
                                        formatter: function(val) {
                                            return val.toFixed(1) + 'h';
                                        },
                                    },
                                },
                                legend: {
                                    position: 'top',
                                    horizontalAlign: 'left',
                                },
                            };

                            this.chart = new ApexCharts(this.$refs.chartEl, options);
                            this.chart.render();
                        },
                    };
                };
            </script>
        @endonce

        <div class="xl:col-span-3">
            <div class="flex-fill">
                {{-- Team Birthday Card --}}
                @if ($todayBirthdayEmployees->count() > 0)
                    <div class="card bg-dark mb-3 relative" x-data="{ currentIndex: 0, total: {{ $todayBirthdayEmployees->count() }} }">
                        <span class="absolute w-full top-0 left-0 z-10 right-0">
                            <img src="{{ asset('assets/img/bg/card-bg-05.png') }}" alt="">
                        </span>
                        <div class="card-body p-5">
                            <div class="text-center">
                                <div class="flex items-center justify-between mb-4">
                                    <h5 class="text-white flex-1">Team Birthday 🎂</h5>
                                    @if ($todayBirthdayEmployees->count() > 1)
                                        <span class="text-white text-xs"
                                            x-text="`${currentIndex + 1}/${total}`"></span>
                                    @endif
                                </div>

                                @foreach ($todayBirthdayEmployees as $index => $birthdayEmployee)
                                    <div x-show="currentIndex === {{ $index }}" x-transition>
                                        <span class="inline-flex items-center justify-center size-[57.6px] mb-2">

                                            <img src="{{ customAsset($birthdayEmployee->photo, true, 'user') }}"
                                                class="rounded-full size-[57.6px] object-cover"
                                                alt="{{ $birthdayEmployee->full_name }}">

                                        </span>
                                        <div class="mb-4">
                                            <h6 class="text-white font-medium mb-1">{{ $birthdayEmployee->full_name }}
                                            </h6>
                                            <p class="text-gray-300 text-sm">
                                                {{ $birthdayEmployee->designation->name ?? 'Employee' }}</p>
                                        </div>
                                        <a href="mailto:{{ $birthdayEmployee->email }}"
                                            class="btn btn-sm btn-primary">Send Wishes</a>
                                    </div>
                                @endforeach

                                @if ($todayBirthdayEmployees->count() > 1)
                                    <div class="flex items-center justify-center gap-2 mt-3">
                                        <button @click="currentIndex = (currentIndex - 1 + total) % total"
                                            class="btn btn-sm bg-white/10 text-white hover:bg-white/20 px-2">
                                            <i class="ti ti-chevron-left"></i>
                                        </button>
                                        <button @click="currentIndex = (currentIndex + 1) % total"
                                            class="btn btn-sm bg-white/10 text-white hover:bg-white/20 px-2">
                                            <i class="ti ti-chevron-right"></i>
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @else
                    <div class="card bg-dark mb-3 relative">
                        <span class="absolute w-full top-0 left-0 z-10 right-0">
                            <img src="{{ asset('assets/img/bg/card-bg-05.png') }}" alt="">
                        </span>
                        <div class="card-body p-5">
                            <div class="text-center">
                                <h5 class="text-white mb-4">Team Birthday 🎂</h5>
                                <div class="mb-4">
                                    <p class="text-gray-300">No birthdays today</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Next Holiday Card --}}
                @if ($holidays->count() > 0)
                    <div class="card bg-warning border border-borderColor rounded" x-data="{ currentIndex: 0, total: {{ $holidays->count() }} }">
                        <div class="card-body flex items-center justify-between p-3">
                            <div class="flex-1">
                                @foreach ($holidays as $index => $holiday)
                                    <div x-show="currentIndex === {{ $index }}" x-transition>
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <h5 class="mb-1">
                                                    {{ $index === 0 ? 'Next Holiday' : 'Upcoming Holiday' }}</h5>
                                                <p class="text-gray-900 font-medium">{{ $holiday->name }}</p>
                                                <p class="text-gray-700 text-sm">
                                                    {{ \Carbon\Carbon::parse($holiday->date)->format('d M Y') }}</p>
                                            </div>
                                            @if ($holidays->count() > 1)
                                                <button @click="currentIndex = (currentIndex + 1) % total"
                                                    class="btn bg-white btn-sm px-3 ml-2">
                                                    Next
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @else
                    <div class="card bg-warning border border-borderColor rounded">
                        <div class="card-body flex items-center justify-between p-3">
                            <div>
                                <h5 class="mb-1">Next Holiday</h5>
                                <p class="text-gray-900">No upcoming holidays</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>
