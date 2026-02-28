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


    <div class="grid grid-cols-1 xxl:grid-cols-12  gap-x-6">

        <!-- Widget Info -->
        <div class="xxl:col-span-8 flex">
            <div class="grid grid-cols-1 md:grid-cols-12 w-full gap-x-6">
                <div class="md:col-span-3 flex mb-6">
                    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white flex-1">
                        <div class="card-body p-5">
                            <span
                                class="size-[42px] flex items-center justify-center text-white rounded-full bg-primary mb-2">
                                <i class="ti ti-calendar-share text-base leading-none"></i>
                            </span>
                            <h6 class="text-[13px] font-medium text-default mb-1">Total employee</h6>
                            <h3 class="mb-4">{{ $state['total_employee'] }}<span
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
                                <i class="ti ti-browser text-base leading-none"></i>
                            </span>
                            <h6 class="text-[13px] font-medium text-default mb-1">Total Present</h6>
                            <h3 class="mb-4">{{ $state['total_present'] }} <span
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
                                <i class="ti ti-users-group text-base leading-none"></i>
                            </span>
                            <h6 class="text-[13px] font-medium text-default mb-1">Total Absent</h6>
                            <h3 class="mb-4">{{ $state['total_absent'] }}<span
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
                                <i class="ti ti-checklist text-base leading-none"></i>
                            </span>
                            <h6 class="text-[13px] font-medium text-default mb-1">Total leave</h6>
                            <h3 class="mb-4">{{ $state['total_leave'] }}<span
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
                                <i class="ti ti-moneybag text-base leading-none"></i>
                            </span>
                            <h6 class="text-[13px] font-medium text-default mb-1">On Time</h6>
                            <h3 class="mb-4">{{ $state['total_on_time'] }} <span
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
                                <i class="ti ti-browser text-base leading-none"></i>
                            </span>
                            <h6 class="text-[13px] font-medium text-default mb-1">Total Late</h6>
                            <h3 class="mb-4">{{ $state['total_late'] }}<span
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
                                <i class="ti ti-users-group text-base leading-none"></i>
                            </span>
                            <h6 class="text-[13px] font-medium text-default mb-1">Today Notice</h6>
                            <h3 class="mb-4">{{ $state['total_notice'] }}<span
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
                                <i class="ti ti-user-star text-base leading-none"></i>
                            </span>
                            <h6 class="text-[13px] font-medium text-default mb-1">Leave Application</h6>
                            <h3 class="mb-4">{{ $state['total_leave_application'] }}<span
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
        <div class="xl:col-span-6 flex">
            <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white w-full mb-6">
                <div
                    class="card-header  pt-4 px-5 pb-2 flex items-center justify-between flex-wrap border-b border-borderColor">
                    <h5 class="mb-2">Attendance Overview</h5>
                    <div class="mb-2">
                        <a href="javascript:void(0);"
                            class="border rounded py-1 px-2 text-xs font-medium bg-white inline-flex items-center focus:bg-primary focus:border-primary focus:text-white text-gray-900"
                            data-dropdown-toggle="today-dropdown">
                            <i class="ti ti-calendar me-1"></i>Today
                        </a>
                        <ul id="today-dropdown" class="hidden p-4 border rounded bg-white shadow-lg w-40 z-[1]">
                            <li>
                                <a href="javascript:void(0);"
                                    class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary text-gray-900">This
                                    Month</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);"
                                    class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary text-gray-900">This
                                    Week</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);"
                                    class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary text-gray-900">Last
                                    Week</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body p-5">
                    <div class="chartjs-wrapper-demo relative mb-4">
                        <div class="w-full h-52">
                            <canvas id="attendance" class="w-full h-full"></canvas>
                        </div>
                        <div
                            class="absolute text-center top-1/2 left-1/2 -translate-x-1/2 transform attendance-canvas">
                            <p class="text-[13px] mb-1">Total Attendance</p>
                            <h3>120</h3>
                        </div>
                    </div>
                    <h6 class="mb-4">Status</h6>
                    <div class="flex items-center justify-between">
                        <p class="text-[13px] mb-2"><i class="ti ti-circle-filled text-success me-1"></i>Present</p>
                        <p class="text-[13px] font-medium text-gray-900 mb-2">59%</p>
                    </div>
                    <div class="flex items-center justify-between">
                        <p class="text-[13px] mb-2"><i class="ti ti-circle-filled text-secondary me-1"></i>Late</p>
                        <p class="text-[13px] font-medium text-gray-900 mb-2">21%</p>
                    </div>
                    <div class="flex items-center justify-between">
                        <p class="text-[13px] mb-2"><i class="ti ti-circle-filled text-warning me-1"></i>Permission
                        </p>
                        <p class="text-[13px] font-medium text-gray-900 mb-2">2%</p>
                    </div>
                    <div class="flex items-center justify-between mb-2">
                        <p class="text-[13px] mb-2"><i class="ti ti-circle-filled text-danger me-1"></i>Absent</p>
                        <p class="text-[13px] font-medium text-gray-900 mb-2">15%</p>
                    </div>
                    <div
                        class="bg-light rounded-defaultradius box-shadow-xs p-2 pb-0 flex items-center justify-between flex-wrap">
                        <div class="flex items-center">
                            <p class="mb-2 me-2">Total Absenties</p>
                            <div class="flex -space-x-2 mb-2">
                                <img class="size-6 border border-white rounded-full hover:-translate-y-[0.188rem] hover:z-[1] transition-transform duration-150 ease-in-out"
                                    src="{{ asset('assets/img/profiles/avatar-27.jpg') }}" alt="">
                                <img class="size-6 border border-white rounded-full  hover:-translate-y-[0.188rem] hover:z-[1] transition-transform duration-150 ease-in-out"
                                    src="{{ asset('assets/img/profiles/avatar-30.jpg') }}" alt="">
                                <img class="size-6 border border-white rounded-full hover:-translate-y-[0.188rem] hover:z-[1] transition-transform duration-150 ease-in-out"
                                    src="{{ asset('assets/img/profiles/avatar-14.jpg') }}" alt="">
                                <img class="size-6 border border-white rounded-full hover:-translate-y-[0.188rem] hover:z-[1] transition-transform duration-150 ease-in-out"
                                    src="{{ asset('assets/img/profiles/avatar-29.jpg') }}" alt="">
                                <a class="flex items-center justify-center size-6 border text-xs font-medium text-white bg-primary border-primary rounded-full hover:primary-900 shrink-0 hover:-translate-y-[0.188rem] hover:z-[1] transition-transform duration-150 ease-in-out"
                                    href="#">+1</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- /Attendance Overview -->
        <!-- Sales Overview -->
        <div class="xl:col-span-6 flex">
            <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white w-full">
                <div
                    class="card-header pt-4 px-5 pb-2 flex items-center justify-between flex-wrap border-b border-borderColorr">
                    <h5 class="mb-2">Attendance Overview</h5>
                    
                </div>
                <div class="card-body p-5 pb-0">
                    <div class="flex items-center justify-between flex-wrap">
                        <div class="flex items-center mb-1">
                            <p class="text-[13px] text-gray-900 me-3 mb-0"><i
                                    class="ti ti-square-filled me-2 text-primary"></i>Income</p>
                            <p class="text-[13px] text-gray-900 mb-0"><i
                                    class="ti ti-square-filled me-2 text-gray-2"></i>Expenses</p>
                        </div>
                        <p class="text-[13px] mb-1">Last Updated at 11:30PM</p>
                    </div>
                    <div id="sales-income"></div>
                </div>
            </div>
        </div>
        <!-- /Sales Overview -->


    </div>



    <div class="grid grid-cols-1 xl:grid-cols-12 gap-6 mb-6">

        <!-- Projects -->
        <div class="xl:col-span-6 flex">
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
                                    <th
                                        class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                        Approved By </th>
                                    <th
                                        class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                        Action
                                    </th>
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
                                        <td class="px-5 py-2.5 text-gray-500">{{ $leave->approved_by }}</td>

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
        <div class="xl:col-span-6 flex">
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
