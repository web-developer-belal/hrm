<div>
    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">Admin Dashboard</h2>
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
                    <li aria-current="page" class="text-xs text-gray-900">Admin Dashboard</li>
                </ol>
            </nav>
        </div>
        <div class="my-xl-auto right-content grid grid-cols-1 md:grid-cols-2 gap-2">

            <div class="">
                <x-form.date-range-picker :startDate="$startDate" :endDate="$endDate" />
            </div>
            <div class="">
                <x-form.select name="branch" :live="true" :search="true" :options="$branch_options"
                    placeholder="Select Branch" />
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->


    <div class="grid grid-cols-1 xxl:grid-cols-12  gap-x-6">

        <!-- Widget Info -->
        <div class="xxl:col-span-8 flex">
            <div class="grid grid-cols-1 md:grid-cols-12 w-full gap-x-6">
                <div class="md:col-span-3 flex mb-6">
                    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white flex-1">
                        <div class="card-body p-5">
                            <span
                                class="size-[42px] flex items-center justify-center text-white rounded-full bg-primary mb-2">
                                <i class="ti ti-users text-base leading-none"></i>
                            </span>
                            <h6 class="text-[13px] font-medium text-default mb-1">Total employee</h6>
                            <h3 class="flex gap-2 items-center">{{ $state['total_employee'] }}<span
                                    class="text-xs leading-normal font-medium text-success"><i
                                        class="fa-solid fa-caret-up me-1"></i>+2.1%</span></h3>

                        </div>
                    </div>
                </div>
                <div class="md:col-span-3 flex mb-6">
                    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white flex-1">
                        <div class="card-body p-5">
                            <span
                                class="size-[42px] flex items-center justify-center text-white rounded-full bg-secondary mb-2">
                                <i class="ti ti-fingerprint text-base leading-none"></i>
                            </span>
                            <h6 class="text-[13px] font-medium text-default mb-1">Total Present</h6>
                            <h3 class="flex gap-2 items-center">{{ $state['total_present'] }} <span
                                    class="text-xs leading-normal font-medium text-danger"><i
                                        class="fa-solid fa-caret-down me-1"></i>-2.1%</span></h3>
                        </div>
                    </div>
                </div>
                <div class="md:col-span-3 flex mb-6">
                    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white flex-1">
                        <div class="card-body p-5">
                            <span
                                class="size-[42px] flex items-center justify-center text-white rounded-full bg-info mb-2">
                                <i class="ti ti-fingerprint-off text-base leading-none"></i>
                            </span>
                            <h6 class="text-[13px] font-medium text-default mb-1">Total Absent</h6>
                            <h3 class="flex gap-2 items-center">{{ $state['total_absent'] }}<span
                                    class="text-xs leading-normal font-medium text-danger"><i
                                        class="fa-solid fa-caret-down me-1"></i>-11.2%</span></h3>
                        </div>
                    </div>
                </div>
                <div class="md:col-span-3 flex mb-6">
                    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white flex-1">
                        <div class="card-body p-5">
                            <span
                                class="size-[42px] flex items-center justify-center text-white rounded-full bg-pink mb-2">
                                <i class="ti ti-door-exit text-base leading-none"></i>
                            </span>
                            <h6 class="text-[13px] font-medium text-default mb-1">Total leave</h6>
                            <h3 class="flex gap-2 items-center">{{ $state['total_leave'] }}<span
                                    class="text-xs leading-normal font-medium text-success"><i
                                        class="fa-solid fa-caret-down me-1"></i>+11.2%</span></h3>
                        </div>
                    </div>
                </div>
                <div class="md:col-span-3 flex mb-6">
                    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white flex-1">
                        <div class="card-body p-5">
                            <span
                                class="size-[42px] flex items-center justify-center text-white rounded-full bg-purple mb-2">
                                <i class="ti ti-stopwatch text-base leading-none"></i>
                            </span>
                            <h6 class="text-[13px] font-medium text-default mb-1">On Time</h6>
                            <h3 class="flex gap-2 items-center">{{ $state['total_on_time'] }} <span
                                    class="text-xs leading-normal font-medium text-success"><i
                                        class="fa-solid fa-caret-up me-1"></i>+10.2%</span></h3>
                        </div>
                    </div>
                </div>
                <div class="md:col-span-3 flex mb-6">
                    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white flex-1">
                        <div class="card-body p-5">
                            <span
                                class="size-[42px] flex items-center justify-center text-white rounded-full bg-danger mb-2">
                                <i class="ti ti-alarm-off text-base leading-none"></i>
                            </span>
                            <h6 class="text-[13px] font-medium text-default mb-1">Total Late</h6>
                            <h3 class="flex gap-2 items-center">{{ $state['total_late'] }}<span
                                    class="text-xs leading-normal font-medium text-success"><i
                                        class="fa-solid fa-caret-up me-1"></i>+2.1%</span></h3>
                        </div>
                    </div>
                </div>
                <div class="md:col-span-3 flex mb-6">
                    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white flex-1">
                        <div class="card-body p-5">
                            <span
                                class="size-[42px] flex items-center justify-center text-white rounded-full bg-success mb-2">
                                <i class="ti ti-mail text-base leading-none"></i>
                            </span>
                            <h6 class="text-[13px] font-medium text-default mb-1">Today Notice</h6>
                            <h3 class="flex gap-2 items-center">{{ $state['total_notice'] }}<span
                                    class="text-xs leading-normal font-medium text-success"><i
                                        class="fa-solid fa-caret-up me-1"></i>+2.1%</span></h3>
                        </div>
                    </div>
                </div>
                <div class="md:col-span-3 flex mb-6">
                    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white flex-1">
                        <div class="card-body p-5">
                            <span
                                class="size-[42px] flex items-center justify-center text-white rounded-full bg-dark mb-2">
                                <i class="ti ti-clipboard-list text-base leading-none"></i>
                            </span>
                            <h6 class="text-[13px] font-medium text-default mb-1">Leave Application</h6>
                            <h3 class="flex gap-2 items-center">{{ $state['total_leave_application'] }}<span
                                    class="text-xs leading-normal font-medium text-danger"><i
                                        class="fa-solid fa-caret-down me-1"></i>-11.2%</span></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Widget Info -->

    </div>

    <div class="grid grid-cols-1 xxl:grid-cols-12 xl:grid-cols-12 gap-x-6">


        <!-- Attendance Overview -->
        <div class="xl:col-span-6 flex" x-data="{
            chart: null,
            initChart() {
                const ctx = document.getElementById('attendanceChart').getContext('2d');
        
                // Destroy existing chart if exists
                if (this.chart) this.chart.destroy();
        
                this.chart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Late', 'Present', 'On Time', 'Absent'],
                        datasets: [{
                            label: 'Attendance',
                            data: [
                                {{ (int)$attendance['late'] }},
                                {{ (int)$attendance['present'] }},
                                {{ (int)$attendance['on_time'] }},
                                {{ (int)$attendance['absent'] }}
                            ],
                            backgroundColor: ['#03C95A', '#0C4B5E', '#FFC107', '#E70D0D'],
                            borderWidth: 5,
                            borderColor: '#fff',
                            cutout: '60%'
                        }]
                    },
                    options: {
                        rotation: -100,
                        circumference: 200,
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } }
                    }
                });
            }
        }" x-init="initChart()"
            x-on:livewire:load.window="initChart()" x-on:update-chart.window="initChart()">
            <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white w-full mb-6">
                <div class="card-header pt-4 px-5 pb-2 flex items-center justify-between border-b border-borderColor">
                    <h5 class="mb-2">Attendance Overview</h5>
                </div>
                <div class="card-body p-5">
                    <div class="w-full h-52 relative">
                        <canvas id="attendanceChart" class="w-full h-full"></canvas>
                        <div class="absolute text-center top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
                            <p class="text-[13px] mb-1">Total Attendance</p>
                            <h3>{{ $attendance['total_attendance'] }}</h3>
                        </div>
                    </div>

                    <h6 class="mb-4">Status</h6>
                    <div class="flex justify-between text-[13px] mb-2">
                        <span><i class="ti ti-circle-filled text-success me-1"></i>Present</span>
                        <span>{{ round(($attendance['present'] / max($attendance['total_attendance'], 1)) * 100) }}%</span>
                    </div>
                    <div class="flex justify-between text-[13px] mb-2">
                        <span><i class="ti ti-circle-filled text-secondary me-1"></i>Late</span>
                        <span>{{ round(($attendance['late'] / max($attendance['total_attendance'], 1)) * 100) }}%</span>
                    </div>
                    <div class="flex justify-between text-[13px] mb-2">
                        <span><i class="ti ti-circle-filled text-warning me-1"></i>On Time</span>
                        <span>{{ round(($attendance['on_time'] / max($attendance['total_attendance'], 1)) * 100) }}%</span>
                    </div>
                    <div class="flex justify-between text-[13px] mb-2">
                        <span><i class="ti ti-circle-filled text-danger me-1"></i>Absent</span>
                        <span>{{ round(($attendance['absent'] / max($attendance['total_attendance'], 1)) * 100) }}%</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Leave Overview -->
        <div class="xl:col-span-6 flex" x-data x-init="const options = {
            chart: { height: 290, type: 'bar', stacked: true, toolbar: { show: false } },
            colors: ['#FF6F28', '#F8F9FA'],
            plotOptions: { bar: { borderRadius: 5, borderRadiusWhenStacked: 'all', horizontal: false, endingShape: 'rounded' } },
            series: [
                { name: 'Approved Leave', data: {{ json_encode($approvedLeave) }} },
                { name: 'Pending Leave', data: {{ json_encode($pendingLeave) }} }
            ],
            xaxis: { categories: {{ json_encode($leaveMonths) }}, labels: { style: { colors: '#6B7280', fontSize: '13px' } } },
            yaxis: { labels: { offsetX: -15, style: { colors: '#6B7280', fontSize: '13px' } } },
            grid: { borderColor: '#E5E7EB', strokeDashArray: 5, padding: { left: -8 } },
            legend: { show: false },
            dataLabels: { enabled: false },
            fill: { opacity: 1 }
        };
        new ApexCharts(document.querySelector('#leaveChart'), options).render();">
            <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white w-full mb-6">
                <div class="card-header pt-4 px-5 pb-2 flex items-center justify-between border-b border-borderColor">
                    <h5 class="mb-2">Leave Overview</h5>
                </div>
                <div class="card-body p-5 pb-0">
                    <div id="leaveChart"></div>
                </div>
            </div>
        </div>


    </div>



    <div class="grid grid-cols-1 gap-6 mb-6">

        <!-- Projects -->
        <div class="flex">
            <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white w-full overflow-x-auto">
                <div
                    class="card-header pt-4 px-5 pb-2 flex items-center justify-between flex-wrap border-b border-borderColor">
                    <h5 class="mb-2">Leave application</h5>

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
                                        No of Days</th>
                                    <th
                                        class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                        Status</th>


                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-borderColor">
                                @foreach ($leaves as $leave)
                                    <tr class="even:bg-white dark:even-bg-white">
                                        <td class="px-5 py-2.5 text-gray-500">
                                            {{ $loop->index + 1 }}
                                        </td>
                                        <td class="px-5 py-2.5 text-gray-900">{{ $leave->employee->first_name }}</td>
                                        <td class="px-5 py-2.5 text-gray-900">{{ $leave->type->name }}</td>
                                        <td class="px-5 py-2.5 text-gray-500">{{ $leave->from_date }}</td>
                                        <td class="px-5 py-2.5 text-gray-500">{{ $leave->to_date }}</td>
                                        <td class="px-5 py-2.5 text-gray-500">{{ $leave->total_days }}</td>

                                        <td class="px-5 py-2.5 text-gray-500 p-3">
                                            <div>
                                                <a href="javascript:void(0);"
                                                    class="border rounded p-2 bg-white inline-flex items-center focus:bg-primary focus:border-primary focus:text-white text-gray-900"
                                                    data-dropdown-toggle="designation-dropdown-{{ $leave->id }}">
                                                    <span
                                                        class="rounded-full bg-transparent-success flex justify-center items-center me-2"><i
                                                            class="ti ti-point-filled bg-success-100 rounded-full text-success me-1"></i>
                                                        {{ ucfirst($leave->status) }}<i
                                                            class="ti ti-chevron-down ml-1"></i>
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

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Projects -->
        <!-- Projects -->
        <div class=" flex">
            <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white w-full overflow-x-auto">
                <div
                    class="card-header pt-4 px-5 pb-2 flex items-center justify-between flex-wrap border-b border-borderColor">
                    <h5 class="mb-2">Recent Notices</h5>

                </div>
                <div class="card-body p-0">
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

                                                <a href="{{ route('admin.notice.edit', ['notice' => $item->id]) }}"
                                                    class="me-2 size-[26px] flex items-center justify-center rounded-[5px] hover:bg-light-900 hover:text-gray-900"><i
                                                        class="ti ti-edit"></i></a>

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
        <!-- /Projects -->



    </div>


</div>
