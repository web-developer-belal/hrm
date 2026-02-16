<!-- Sidebar -->
<div class="sidebar fixed top-0 left-0 bottom-0 w-sidebar bg-white border-r border-borderColor" id="sidebar">
    <!-- Logo -->
    <div class="sidebar-logo fixed h-[50px] w-sidebar pt-3 px-3">
        <a href="{{ route('admin.dashboard') }}" class="logo logo-normal">
            <img src="{{ asset('assets/img/logo.svg') }}" alt="Logo">
        </a>
        <a href="{{ route('admin.dashboard') }}" class="logo-small hidden">
            <img src="{{ asset('assets/img/logo-small.svg') }}" alt="Logo">
        </a>
        <a href="{{ route('admin.dashboard') }}" class="dark-logo hidden">
            <img src="{{ asset('assets/img/logo-white.svg') }}" alt="Logo">
        </a>
    </div>
    <!-- /Logo -->

    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title text-[10px] font-semibold text-gray-400 mb-3">
                    <span>MAIN MENU</span>
                </li>

                <li>
                    <ul class="mb-[19px]">

                        <!-- Dashboard -->
                        <li class="mb-[5px]">
                            <a href="{{ route('admin.dashboard') }}"
                                class="relative flex item-center w-full p-2 text-sm leading-normal font-medium text-gray-900 group hover:bg-dark-transparent transition-all duration-500 ease-in-out rounded-[5px]">
                                <i class="ti ti-smart-home text-gray-500 group-hover:text-gray-900"></i>
                                <span class="ms-2">Dashboard</span>
                            </a>
                        </li>

                        <!-- Attendance -->
                        <li class="submenu mb-[5px]">
                            <a href="javascript:void(0);"
                                class="relative flex item-center w-full p-2 text-sm leading-normal font-medium text-gray-900 group hover:bg-dark-transparent transition-all duration-500 ease-in-out rounded-[5px]">
                                <i class="ti ti-calendar-check text-gray-500 group-hover:text-gray-900"></i>
                                <span class="ms-2">Attendance</span>
                                <span
                                    class="menu-arrow absolute top-1/2 -translate-y-1/2 right-2.5 flex items-center w-4 h-4"></span>
                            </a>
                            <ul
                                class="relative mt-2 before:absolute before:top-0 before:left-3.5 before:w-[1.5px] before:h-full before:bg-gray-100">
                                <li><a href="{{ route('admin.attendance.add.mannual') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 text-gray-500 hover:text-primary">Add
                                        Attendance</a></li>
                                <li><a href="{{ route('admin.attendance.index') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 text-gray-500 hover:text-primary">Attendance
                                        Reports</a></li>
                                <li><a href="overtime.html"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 text-gray-500 hover:text-primary">Overtime</a>
                                </li>
                                <li><a href="attendance-policy.html"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 text-gray-500 hover:text-primary">Attendance
                                        Policy</a></li>
                            </ul>
                        </li>

                        <!-- HR Management -->
                        <li class="submenu mb-[5px]">
                            <a href="javascript:void(0);"
                                class="relative flex item-center w-full p-2 text-sm leading-normal font-medium text-gray-900 group hover:bg-dark-transparent transition-all duration-500 ease-in-out rounded-[5px]">
                                <i class="ti ti-building text-gray-500 group-hover:text-gray-900"></i>
                                <span class="ms-2">HR Management</span>
                                <span
                                    class="menu-arrow absolute top-1/2 -translate-y-1/2 right-2.5 flex items-center w-4 h-4"></span>
                            </a>
                            <ul
                                class="relative mt-2 before:absolute before:top-0 before:left-3.5 before:w-[1.5px] before:h-full before:bg-gray-100">
                                <li><a href="{{ route('admin.branches.index') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 text-gray-500 hover:text-primary">Branch</a>
                                </li>
                                <li><a href="{{ route('admin.departments.index') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 text-gray-500 hover:text-primary">Department</a>
                                </li>
                                <li><a href="{{ route('admin.shifts.index') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 text-gray-500 hover:text-primary">Shift</a>
                                </li>
                                <li><a href="{{ route('admin.rosters.index') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 text-gray-500 hover:text-primary">Roster</a>
                                </li>
                                <li><a href="{{ route('admin.designations.index') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 text-gray-500 hover:text-primary">Designation</a>
                                </li>
                                <li><a href="{{ route('admin.transfer.new') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 text-gray-500 hover:text-primary">Transfer New</a>
                                </li>
                                <li><a href="{{ route('admin.transfer.index') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 text-gray-500 hover:text-primary">Transfer List</a>
                                </li>
                                <li><a href="complain.html"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 text-gray-500 hover:text-primary">Complain</a>
                                </li>
                            </ul>
                        </li>

                        <!-- Employees -->
                        <li class="submenu mb-[5px]">
                            <a href="javascript:void(0);"
                                class="relative flex item-center w-full p-2 text-sm leading-normal font-medium text-gray-900 group hover:bg-dark-transparent transition-all duration-500 ease-in-out rounded-[5px]">
                                <i class="ti ti-users text-gray-500 group-hover:text-gray-900"></i>
                                <span class="ms-2">Employees</span>
                                <span
                                    class="menu-arrow absolute top-1/2 -translate-y-1/2 right-2.5 flex items-center w-4 h-4"></span>
                            </a>
                            <ul
                                class="relative mt-2 before:absolute before:top-0 before:left-3.5 before:w-[1.5px] before:h-full before:bg-gray-100">
                                <li><a href="{{ route('admin.employees.create') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 text-gray-500 hover:text-primary">Add
                                        Employee</a></li>
                                <li><a href="{{ route('admin.employees.index') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 text-gray-500 hover:text-primary">Employees</a>
                                </li>
                            </ul>
                        </li>

                        <!-- Leave Management -->
                        <li class="submenu mb-[5px]">
                            <a href="javascript:void(0);"
                                class="relative flex item-center w-full p-2 text-sm leading-normal font-medium text-gray-900 group hover:bg-dark-transparent transition-all duration-500 ease-in-out rounded-[5px]">
                                <i class="ti ti-calendar-off text-gray-500 group-hover:text-gray-900"></i>
                                <span class="ms-2">Leave Management</span>
                                <span
                                    class="menu-arrow absolute top-1/2 -translate-y-1/2 right-2.5 flex items-center w-4 h-4"></span>
                            </a>
                            <ul
                                class="relative mt-2 before:absolute before:top-0 before:left-3.5 before:w-[1.5px] before:h-full before:bg-gray-100">
                                <li><a href="{{ route('admin.leavemgt.leave.types') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 text-gray-500 hover:text-primary">Leave
                                        Types</a></li>
                                <li><a href="{{ route('admin.leavemgt.leave.list') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 text-gray-500 hover:text-primary">Leave
                                        Management</a></li>
                            </ul>
                        </li>

                        <!-- Payroll -->
                        <li class="submenu mb-[5px]">
                            <a href="javascript:void(0);"
                                class="relative flex item-center w-full p-2 text-sm leading-normal font-medium text-gray-900 group hover:bg-dark-transparent transition-all duration-500 ease-in-out rounded-[5px]">
                                <i class="ti ti-cash text-gray-500 group-hover:text-gray-900"></i>
                                <span class="ms-2">Payroll</span>
                                <span
                                    class="menu-arrow absolute top-1/2 -translate-y-1/2 right-2.5 flex items-center w-4 h-4"></span>
                            </a>
                            <ul
                                class="relative mt-2 before:absolute before:top-0 before:left-3.5 before:w-[1.5px] before:h-full before:bg-gray-100">
                                <li><a href="salary-setup.html"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 text-gray-500 hover:text-primary">Salary
                                        Setup</a></li>
                                <li><a href="{{ route('admin.adjustment.index') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 text-gray-500 hover:text-primary">Advance
                                       </a></li>
                                <li><a href="payroll-generate.html"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 text-gray-500 hover:text-primary">Payroll
                                        Generate</a></li>
                                <li><a href="payslips.html"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 text-gray-500 hover:text-primary">Payslips</a>
                                </li>
                            </ul>
                        </li>

                        <!-- Single links -->
                        <li class="mb-[5px]"><a href="expense.html"
                                class="relative flex item-center w-full p-2 text-sm font-medium text-gray-900 group hover:bg-dark-transparent rounded-[5px]"><i
                                    class="ti ti-receipt text-gray-500"></i><span class="ms-2">Expense
                                    Management</span></a></li>
                        <li class="mb-[5px]"><a href="performance.html"
                                class="relative flex item-center w-full p-2 text-sm font-medium text-gray-900 group hover:bg-dark-transparent rounded-[5px]"><i
                                    class="ti ti-chart-bar text-gray-500"></i><span class="ms-2">Performance
                                    (PMS)</span></a></li>
                        <li class="mb-[5px]"><a href="{{ route('admin.loan.index') }}"
                                class="relative flex item-center w-full p-2 text-sm font-medium text-gray-900 group hover:bg-dark-transparent rounded-[5px]"><i
                                    class="ti ti-wallet text-gray-500"></i><span class="ms-2">Loan Management</span></a></li>
                        <li class="mb-[5px]"><a href="notice.html"
                                class="relative flex item-center w-full p-2 text-sm font-medium text-gray-900 group hover:bg-dark-transparent rounded-[5px]"><i
                                    class="ti ti-speakerphone text-gray-500"></i><span class="ms-2">Notice
                                    Board</span></a></li>
                        <li class="mb-[5px]"><a href="calendar.html"
                                class="relative flex item-center w-full p-2 text-sm font-medium text-gray-900 group hover:bg-dark-transparent rounded-[5px]"><i
                                    class="ti ti-calendar-event text-gray-500"></i><span class="ms-2">Calendar &
                                    Events</span></a></li>
                        <li class="mb-[5px]"><a href="reports.html"
                                class="relative flex item-center w-full p-2 text-sm font-medium text-gray-900 group hover:bg-dark-transparent rounded-[5px]"><i
                                    class="ti ti-file-analytics text-gray-500"></i><span class="ms-2">Reports &
                                    Analytics</span></a></li>
                        <li class="mb-[5px]"><a href="settings.html"
                                class="relative flex item-center w-full p-2 text-sm font-medium text-gray-900 group hover:bg-dark-transparent rounded-[5px]"><i
                                    class="ti ti-settings text-gray-500"></i><span class="ms-2">Settings</span></a>
                        </li>

                    </ul>
                </li>
            </ul>

        </div>
    </div>
</div>
<!-- /Sidebar -->
