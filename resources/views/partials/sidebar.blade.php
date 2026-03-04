<!-- Sidebar -->
<div class="sidebar fixed top-0 left-0 bottom-0 w-sidebar bg-white border-r border-borderColor" id="sidebar">
    <!-- Logo -->
    <div class="sidebar-logo fixed h-[50px] w-sidebar pt-3 px-3">
        <a href="{{ route('admin.dashboard') }}" class="logo logo-normal">
            <img src="{{ asset('assets/img/Logo-Babyshop.png') }}" class="my-logo" alt="Logo">
        </a>
        <a href="{{ route('admin.dashboard') }}" class="logo-small hidden">
            <img src="{{ asset('assets/img/Logo-Babyshop.png') }}" class="my-logo" alt="Logo">
        </a>
        <a href="{{ route('admin.dashboard') }}" class="dark-logo hidden">
            <img src="{{ asset('assets/img/Logo-Babyshop.png') }}" class="my-logo" alt="Logo">
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
                                class="relative flex item-center w-full p-2 text-sm leading-normal font-medium {{ request()->routeIs('admin.dashboard') ? 'text-primary bg-dark-transparent' : 'text-gray-900 group hover:bg-dark-transparent hover:text-gray-900' }} transition-all duration-500 ease-in-out rounded-[5px]">
                                <i class="ti ti-smart-home {{ request()->routeIs('admin.dashboard') ? 'text-primary' : 'text-gray-500 group-hover:text-gray-900' }}"></i>
                                <span class="ms-2">Dashboard</span>
                            </a>
                        </li>

                        <!-- Attendance -->
                        @php
                            $attendanceRoutes = [
                                'admin.attendance.add.mannual',
                                'admin.attendance.index',
                                'admin.device.index',
                                'admin.device.history'
                            ];
                            $isAttendanceActive = request()->routeIs($attendanceRoutes);
                        @endphp
                        <li class="submenu mb-[5px]">
                            <a href="javascript:void(0);"
                                class="relative flex item-center w-full p-2 text-sm leading-normal font-medium {{ $isAttendanceActive ? 'text-primary bg-dark-transparent' : 'text-gray-900 group hover:bg-dark-transparent hover:text-gray-900' }} transition-all duration-500 ease-in-out rounded-[5px]">
                                <i class="ti ti-calendar-check {{ $isAttendanceActive ? 'text-primary' : 'text-gray-500 group-hover:text-gray-900' }}"></i>
                                <span class="ms-2">Attendance</span>
                                <span
                                    class="menu-arrow absolute top-1/2 -translate-y-1/2 right-2.5 flex items-center w-4 h-4"></span>
                            </a>
                            <ul class="relative mt-2 before:absolute before:top-0 before:left-3.5 before:w-[1.5px] before:h-full before:bg-gray-100"
                                style="display: {{ $isAttendanceActive ? 'block' : 'none' }};">
                                <li><a href="{{ route('admin.attendance.add.mannual') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 {{ request()->routeIs('admin.attendance.add.mannual') ? 'text-primary font-medium' : 'text-gray-500 hover:text-primary' }}">Add
                                        Attendance</a></li>
                                <li><a href="{{ route('admin.attendance.index') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 {{ request()->routeIs('admin.attendance.index') ? 'text-primary font-medium' : 'text-gray-500 hover:text-primary' }}">Attendance
                                        Reports</a></li>
                                <li><a href="{{ route('admin.device.index') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 {{ request()->routeIs('admin.device.index') ? 'text-primary font-medium' : 'text-gray-500 hover:text-primary' }}">Device</a>
                                </li>
                                <li><a href="{{ route('admin.device.history') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 {{ request()->routeIs('admin.device.history') ? 'text-primary font-medium' : 'text-gray-500 hover:text-primary' }}">Device
                                        Sync History</a>
                                </li>
                                <li><a href=""
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 text-gray-500 hover:text-primary">Overtime</a>
                                </li>
                                <li><a href="{{ route('admin.attendance-policy.index') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 text-gray-500 hover:text-primary">Attendance
                                        Policy</a></li>
                            </ul>
                        </li>

                        <!-- HR Management -->
                        @php
                            $hrRoutes = [
                                'admin.branches.index',
                                'admin.departments.index',
                                'admin.shifts.index',
                                'admin.rosters.index',
                                'admin.designations.index',
                                'admin.transfer.new',
                                'admin.transfer.index',
                                'admin.complain.index'
                            ];
                            $isHrActive = request()->routeIs($hrRoutes);
                        @endphp
                        <li class="submenu mb-[5px]">
                            <a href="javascript:void(0);"
                                class="relative flex item-center w-full p-2 text-sm leading-normal font-medium {{ $isHrActive ? 'text-primary bg-dark-transparent' : 'text-gray-900 group hover:bg-dark-transparent hover:text-gray-900' }} transition-all duration-500 ease-in-out rounded-[5px]">
                                <i class="ti ti-building {{ $isHrActive ? 'text-primary' : 'text-gray-500 group-hover:text-gray-900' }}"></i>
                                <span class="ms-2">HR Management</span>
                                <span
                                    class="menu-arrow absolute top-1/2 -translate-y-1/2 right-2.5 flex items-center w-4 h-4"></span>
                            </a>
                            <ul class="relative mt-2 before:absolute before:top-0 before:left-3.5 before:w-[1.5px] before:h-full before:bg-gray-100"
                                style="display: {{ $isHrActive ? 'block' : 'none' }};">
                                <li><a href="{{ route('admin.branches.index') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 {{ request()->routeIs('admin.branches.index') ? 'text-primary font-medium' : 'text-gray-500 hover:text-primary' }}">Branch</a>
                                </li>
                                <li><a href="{{ route('admin.departments.index') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 {{ request()->routeIs('admin.departments.index') ? 'text-primary font-medium' : 'text-gray-500 hover:text-primary' }}">Department</a>
                                </li>
                                <li><a href="{{ route('admin.shifts.index') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 {{ request()->routeIs('admin.shifts.index') ? 'text-primary font-medium' : 'text-gray-500 hover:text-primary' }}">Shift</a>
                                </li>
                                <li><a href="{{ route('admin.rosters.index') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 {{ request()->routeIs('admin.rosters.index') ? 'text-primary font-medium' : 'text-gray-500 hover:text-primary' }}">Roster</a>
                                </li>
                                <li><a href="{{ route('admin.designations.index') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 {{ request()->routeIs('admin.designations.index') ? 'text-primary font-medium' : 'text-gray-500 hover:text-primary' }}">Designation</a>
                                </li>
                                <li><a href="{{ route('admin.transfer.new') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 {{ request()->routeIs('admin.transfer.new') ? 'text-primary font-medium' : 'text-gray-500 hover:text-primary' }}">Transfer
                                        New</a>
                                </li>
                                <li><a href="{{ route('admin.transfer.index') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 {{ request()->routeIs('admin.transfer.index') ? 'text-primary font-medium' : 'text-gray-500 hover:text-primary' }}">Transfer
                                        List</a>
                                </li>
                                <li><a href="{{ route('admin.complain.index') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 {{ request()->routeIs('admin.complain.index') ? 'text-primary font-medium' : 'text-gray-500 hover:text-primary' }}">Complain</a>
                                </li>
                            </ul>
                        </li>

                        <!-- Employees -->
                        @php
                            $employeeRoutes = [
                                'admin.employees.create',
                                'admin.employees.index'
                            ];
                            $isEmployeeActive = request()->routeIs($employeeRoutes);
                        @endphp
                        <li class="submenu mb-[5px]">
                            <a href="javascript:void(0);"
                                class="relative flex item-center w-full p-2 text-sm leading-normal font-medium {{ $isEmployeeActive ? 'text-primary bg-dark-transparent' : 'text-gray-900 group hover:bg-dark-transparent hover:text-gray-900' }} transition-all duration-500 ease-in-out rounded-[5px]">
                                <i class="ti ti-users {{ $isEmployeeActive ? 'text-primary' : 'text-gray-500 group-hover:text-gray-900' }}"></i>
                                <span class="ms-2">Employees</span>
                                <span
                                    class="menu-arrow absolute top-1/2 -translate-y-1/2 right-2.5 flex items-center w-4 h-4"></span>
                            </a>
                            <ul class="relative mt-2 before:absolute before:top-0 before:left-3.5 before:w-[1.5px] before:h-full before:bg-gray-100"
                                style="display: {{ $isEmployeeActive ? 'block' : 'none' }};">
                                <li><a href="{{ route('admin.employees.create') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 {{ request()->routeIs('admin.employees.create') ? 'text-primary font-medium' : 'text-gray-500 hover:text-primary' }}">Add
                                        Employee</a></li>
                                <li><a href="{{ route('admin.employees.index') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 {{ request()->routeIs('admin.employees.index') ? 'text-primary font-medium' : 'text-gray-500 hover:text-primary' }}">Employees</a>
                                </li>
                            </ul>
                        </li>

                        <!-- Leave Management -->
                        @php
                            $leaveRoutes = [
                                'admin.leavemgt.leave.types',
                                'admin.leavemgt.leave.list',
                                'admin.holiday.index'
                            ];
                            $isLeaveActive = request()->routeIs($leaveRoutes);
                        @endphp
                        <li class="submenu mb-[5px]">
                            <a href="javascript:void(0);"
                                class="relative flex item-center w-full p-2 text-sm leading-normal font-medium {{ $isLeaveActive ? 'text-primary bg-dark-transparent' : 'text-gray-900 group hover:bg-dark-transparent hover:text-gray-900' }} transition-all duration-500 ease-in-out rounded-[5px]">
                                <i class="ti ti-calendar-off {{ $isLeaveActive ? 'text-primary' : 'text-gray-500 group-hover:text-gray-900' }}"></i>
                                <span class="ms-2">Leave Management</span>
                                <span
                                    class="menu-arrow absolute top-1/2 -translate-y-1/2 right-2.5 flex items-center w-4 h-4"></span>
                            </a>
                            <ul class="relative mt-2 before:absolute before:top-0 before:left-3.5 before:w-[1.5px] before:h-full before:bg-gray-100"
                                style="display: {{ $isLeaveActive ? 'block' : 'none' }};">
                                <li><a href="{{ route('admin.leavemgt.leave.types') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 {{ request()->routeIs('admin.leavemgt.leave.types') ? 'text-primary font-medium' : 'text-gray-500 hover:text-primary' }}">Leave
                                        Types</a></li>
                                <li><a href="{{ route('admin.leavemgt.leave.list') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 {{ request()->routeIs('admin.leavemgt.leave.list') ? 'text-primary font-medium' : 'text-gray-500 hover:text-primary' }}">Leave
                                        Management</a></li>
                                <li><a href="{{ route('admin.holiday.index') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 {{ request()->routeIs('admin.holiday.index') ? 'text-primary font-medium' : 'text-gray-500 hover:text-primary' }}">Holiday Management</a></li>
                            </ul>
                        </li>

                        <!-- Payroll -->
                        @php
                            $payrollRoutes = [
                                'admin.adjustment.index',
                                'admin.payroll.index',
                                'admin.payroll.list'
                            ];
                            $isPayrollActive = request()->routeIs($payrollRoutes);
                        @endphp
                        <li class="submenu mb-[5px]">
                            <a href="javascript:void(0);"
                                class="relative flex item-center w-full p-2 text-sm leading-normal font-medium {{ $isPayrollActive ? 'text-primary bg-dark-transparent' : 'text-gray-900 group hover:bg-dark-transparent hover:text-gray-900' }} transition-all duration-500 ease-in-out rounded-[5px]">
                                <i class="ti ti-cash {{ $isPayrollActive ? 'text-primary' : 'text-gray-500 group-hover:text-gray-900' }}"></i>
                                <span class="ms-2">Payroll</span>
                                <span
                                    class="menu-arrow absolute top-1/2 -translate-y-1/2 right-2.5 flex items-center w-4 h-4"></span>
                            </a>
                            <ul class="relative mt-2 before:absolute before:top-0 before:left-3.5 before:w-[1.5px] before:h-full before:bg-gray-100"
                                style="display: {{ $isPayrollActive ? 'block' : 'none' }};">
                               
                                <li><a href="{{ route('admin.adjustment.index') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 {{ request()->routeIs('admin.adjustment.index') ? 'text-primary font-medium' : 'text-gray-500 hover:text-primary' }}">Advance
                                    </a></li>
                                <li><a href="{{ route('admin.payroll.index') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 {{ request()->routeIs('admin.payroll.index') ? 'text-primary font-medium' : 'text-gray-500 hover:text-primary' }}">
                                        Generate</a></li>
                                <li><a href="{{ route('admin.payroll.list') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 {{ request()->routeIs('admin.payroll.list') ? 'text-primary font-medium' : 'text-gray-500 hover:text-primary' }}">Payroll
                                        List</a></li>
                                <li><a href="{{ route('admin.payroll.payslips') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 text-gray-500 hover:text-primary">Payslips</a>
                                </li>
                            </ul>
                        </li>

                        <!-- Single links -->
                        <li class="mb-[5px]"><a href="{{ route('admin.expenses.index') }}"
                                class="relative flex item-center w-full p-2 text-sm font-medium {{ request()->routeIs('admin.expenses.index') ? 'text-primary bg-dark-transparent' : 'text-gray-900 group hover:bg-dark-transparent hover:text-gray-900' }} rounded-[5px]"><i
                                    class="ti ti-receipt {{ request()->routeIs('admin.expenses.index') ? 'text-primary' : 'text-gray-500 group-hover:text-gray-900' }}"></i><span class="ms-2">Expense
                                    Management</span></a></li>
                        <li class="mb-[5px]"><a href="performance.html"
                                class="relative flex item-center w-full p-2 text-sm font-medium text-gray-900 group hover:bg-dark-transparent rounded-[5px]"><i
                                    class="ti ti-chart-bar text-gray-500"></i><span class="ms-2">Performance
                                    (PMS)</span></a></li>
                        <li class="mb-[5px]"><a href="{{ route('admin.loan.index') }}"
                                class="relative flex item-center w-full p-2 text-sm font-medium {{ request()->routeIs('admin.loan.index') ? 'text-primary bg-dark-transparent' : 'text-gray-900 group hover:bg-dark-transparent hover:text-gray-900' }} rounded-[5px]"><i
                                    class="ti ti-wallet {{ request()->routeIs('admin.loan.index') ? 'text-primary' : 'text-gray-500 group-hover:text-gray-900' }}"></i><span class="ms-2">Loan
                                    Management</span></a></li>
                        <li class="mb-[5px]"><a href="{{ route('admin.notice.index') }}"
                                class="relative flex item-center w-full p-2 text-sm font-medium {{ request()->routeIs('admin.notice.index') ? 'text-primary bg-dark-transparent' : 'text-gray-900 group hover:bg-dark-transparent hover:text-gray-900' }} rounded-[5px]"><i
                                    class="ti ti-speakerphone {{ request()->routeIs('admin.notice.index') ? 'text-primary' : 'text-gray-500 group-hover:text-gray-900' }}"></i><span class="ms-2">Notice
                                    Board</span></a></li>
                        <li class="mb-[5px]"><a href="calendar.html"
                                class="relative flex item-center w-full p-2 text-sm font-medium text-gray-900 group hover:bg-dark-transparent rounded-[5px]"><i
                                    class="ti ti-calendar-event text-gray-500"></i><span class="ms-2">Calendar &
                                    Events</span></a></li>
                        <li class="mb-[5px]"><a href="reports.html"
                                class="relative flex item-center w-full p-2 text-sm font-medium text-gray-900 group hover:bg-dark-transparent rounded-[5px]"><i
                                    class="ti ti-file-analytics text-gray-500"></i><span class="ms-2">Reports &
                                    Analytics</span></a></li>
                        <li class="mb-[5px]"><a href="{{ route('admin.settings.index') }}"
                                class="relative flex item-center w-full p-2 text-sm font-medium {{ request()->routeIs('admin.settings.index') ? 'text-primary bg-dark-transparent' : 'text-gray-900 group hover:bg-dark-transparent hover:text-gray-900' }} rounded-[5px]"><i
                                    class="ti ti-settings {{ request()->routeIs('admin.settings.index') ? 'text-primary' : 'text-gray-500 group-hover:text-gray-900' }}"></i><span class="ms-2">Settings</span></a>
                        </li>

                    </ul>
                </li>
            </ul>

        </div>
    </div>
</div>
<!-- /Sidebar -->