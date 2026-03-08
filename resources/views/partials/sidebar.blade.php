<!-- Sidebar -->
<div class="sidebar fixed top-0 left-0 bottom-0 w-sidebar bg-white border-r border-borderColor" id="sidebar">
    <!-- Logo -->
    <div class="sidebar-logo fixed h-[50px] w-sidebar pt-3 px-3">
        <a href="{{ route('admin.dashboard') }}" class="logo logo-normal">
            <img src="{{ customAsset(settingData('company_logo_path')) }}" class="my-logo" alt="Logo">
        </a>
        <a href="{{ route('admin.dashboard') }}" class="logo-small hidden">
            <img src="{{ customAsset(settingData('company_logo_path')) }}" class="my-logo" alt="Logo">
        </a>
        <a href="{{ route('admin.dashboard') }}" class="dark-logo hidden">
            <img src="{{ customAsset(settingData('company_logo_path')) }}" class="my-logo" alt="Logo">
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

                        {{-- Dashboard --}}
                        @if(auth()->user()->hasPermission('dashboard.show'))
                        <li class="mb-[5px]">
                            <a href="{{ route('admin.dashboard') }}"
                                class="relative flex item-center w-full p-2 text-sm leading-normal font-medium {{ request()->routeIs('admin.dashboard') ? 'text-primary bg-dark-transparent' : 'text-gray-900 group hover:bg-dark-transparent hover:text-gray-900' }} transition-all duration-500 ease-in-out rounded-[5px]">
                                <i class="ti ti-smart-home {{ request()->routeIs('admin.dashboard') ? 'text-primary' : 'text-gray-500 group-hover:text-gray-900' }}"></i>
                                <span class="ms-2">Dashboard</span>
                            </a>
                        </li>
                        @endif

                        {{-- Attendance --}}
                        @php
                            $attendanceRoutes = [
                                'admin.attendance.add.manual' => 'attendance.add',
                                'admin.attendance.index' => 'attendance.show',
                                'admin.attendance-policy.index' => 'attendance-policy.show',
                            ];
                            $showAttendance = false;
                            foreach ($attendanceRoutes as $route => $perm) {
                                if (auth()->user()->hasPermission($perm)) {
                                    $showAttendance = true;
                                    break;
                                }
                            }
                            $isAttendanceActive = request()->routeIs(array_keys($attendanceRoutes));
                        @endphp
                        @if($showAttendance)
                        <li class="submenu mb-[5px]">
                            <a href="javascript:void(0);"
                                class="relative flex item-center w-full p-2 text-sm leading-normal font-medium {{ $isAttendanceActive ? 'text-primary bg-dark-transparent' : 'text-gray-900 group hover:bg-dark-transparent hover:text-gray-900' }} transition-all duration-500 ease-in-out rounded-[5px]">
                                <i class="ti ti-calendar-check {{ $isAttendanceActive ? 'text-primary' : 'text-gray-500 group-hover:text-gray-900' }}"></i>
                                <span class="ms-2">Attendance</span>
                                <span class="menu-arrow absolute top-1/2 -translate-y-1/2 right-2.5 flex items-center w-4 h-4"></span>
                            </a>
                            <ul class="relative mt-2 before:absolute before:top-0 before:left-3.5 before:w-[1.5px] before:h-full before:bg-gray-100"
                                style="display: {{ $isAttendanceActive ? 'block' : 'none' }};">
                                @if(auth()->user()->hasPermission('attendance.add'))
                                <li><a href="{{ route('admin.attendance.add.manual') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 {{ request()->routeIs('admin.attendance.add.manual') ? 'text-primary font-medium' : 'text-gray-500 hover:text-primary' }}">Add Attendance</a></li>
                                @endif
                                @if(auth()->user()->hasPermission('attendance.show'))
                                <li><a href="{{ route('admin.attendance.index') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 {{ request()->routeIs('admin.attendance.index') ? 'text-primary font-medium' : 'text-gray-500 hover:text-primary' }}">Attendance Reports</a></li>
                                @endif
                                {{-- Overtime link has no route, keep as is (no permission) --}}
                                <li><a href=""
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 text-gray-500 hover:text-primary">Overtime</a>
                                </li>
                                @if(auth()->user()->hasPermission('attendance-policy.show'))
                                <li><a href="{{ route('admin.attendance-policy.index') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 {{ request()->routeIs('admin.attendance-policy.index') ? 'text-primary font-medium' : 'text-gray-500 hover:text-primary' }}">Attendance Policy</a></li>
                                @endif
                            </ul>
                        </li>
                        @endif

                        {{-- HR Management --}}
                        @php
                            $hrRoutes = [
                                'admin.branches.index' => 'branches.show',
                                'admin.departments.index' => 'departments.show',
                                'admin.shifts.index' => 'shifts.show',
                                'admin.rosters.index' => 'rosters.show',
                                'admin.designations.index' => 'designations.show',
                                'admin.transfer.new' => 'transfer.create',
                                'admin.transfer.index' => 'transfer.show',
                                'admin.complain.index' => 'complains.show',
                            ];
                            $showHr = false;
                            foreach ($hrRoutes as $route => $perm) {
                                if (auth()->user()->hasPermission($perm)) {
                                    $showHr = true;
                                    break;
                                }
                            }
                            $isHrActive = request()->routeIs(array_keys($hrRoutes));
                        @endphp
                        @if($showHr)
                        <li class="submenu mb-[5px]">
                            <a href="javascript:void(0);"
                                class="relative flex item-center w-full p-2 text-sm leading-normal font-medium {{ $isHrActive ? 'text-primary bg-dark-transparent' : 'text-gray-900 group hover:bg-dark-transparent hover:text-gray-900' }} transition-all duration-500 ease-in-out rounded-[5px]">
                                <i class="ti ti-building {{ $isHrActive ? 'text-primary' : 'text-gray-500 group-hover:text-gray-900' }}"></i>
                                <span class="ms-2">HR Management</span>
                                <span class="menu-arrow absolute top-1/2 -translate-y-1/2 right-2.5 flex items-center w-4 h-4"></span>
                            </a>
                            <ul class="relative mt-2 before:absolute before:top-0 before:left-3.5 before:w-[1.5px] before:h-full before:bg-gray-100"
                                style="display: {{ $isHrActive ? 'block' : 'none' }};">
                                @if(auth()->user()->hasPermission('branches.show'))
                                <li><a href="{{ route('admin.branches.index') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 {{ request()->routeIs('admin.branches.index') ? 'text-primary font-medium' : 'text-gray-500 hover:text-primary' }}">Branch</a></li>
                                @endif
                                @if(auth()->user()->hasPermission('departments.show'))
                                <li><a href="{{ route('admin.departments.index') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 {{ request()->routeIs('admin.departments.index') ? 'text-primary font-medium' : 'text-gray-500 hover:text-primary' }}">Department</a></li>
                                @endif
                                @if(auth()->user()->hasPermission('shifts.show'))
                                <li><a href="{{ route('admin.shifts.index') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 {{ request()->routeIs('admin.shifts.index') ? 'text-primary font-medium' : 'text-gray-500 hover:text-primary' }}">Shift</a></li>
                                @endif
                                @if(auth()->user()->hasPermission('rosters.show'))
                                <li><a href="{{ route('admin.rosters.index') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 {{ request()->routeIs('admin.rosters.index') ? 'text-primary font-medium' : 'text-gray-500 hover:text-primary' }}">Roster</a></li>
                                @endif
                                @if(auth()->user()->hasPermission('designations.show'))
                                <li><a href="{{ route('admin.designations.index') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 {{ request()->routeIs('admin.designations.index') ? 'text-primary font-medium' : 'text-gray-500 hover:text-primary' }}">Designation</a></li>
                                @endif
                                @if(auth()->user()->hasPermission('transfer.create'))
                                <li><a href="{{ route('admin.transfer.new') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 {{ request()->routeIs('admin.transfer.new') ? 'text-primary font-medium' : 'text-gray-500 hover:text-primary' }}">Transfer New</a></li>
                                @endif
                                @if(auth()->user()->hasPermission('transfer.show'))
                                <li><a href="{{ route('admin.transfer.index') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 {{ request()->routeIs('admin.transfer.index') ? 'text-primary font-medium' : 'text-gray-500 hover:text-primary' }}">Transfer List</a></li>
                                @endif
                                @if(auth()->user()->hasPermission('complains.show'))
                                <li><a href="{{ route('admin.complain.index') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 {{ request()->routeIs('admin.complain.index') ? 'text-primary font-medium' : 'text-gray-500 hover:text-primary' }}">Complain</a></li>
                                @endif
                            </ul>
                        </li>
                        @endif

                        {{-- Employees --}}
                        @php
                            $employeeRoutes = [
                                'admin.employees.create' => 'employees.create',
                                'admin.employees.index' => 'employees.show',
                            ];
                            $showEmployees = false;
                            foreach ($employeeRoutes as $route => $perm) {
                                if (auth()->user()->hasPermission($perm)) {
                                    $showEmployees = true;
                                    break;
                                }
                            }
                            $isEmployeeActive = request()->routeIs(array_keys($employeeRoutes));
                        @endphp
                        @if($showEmployees)
                        <li class="submenu mb-[5px]">
                            <a href="javascript:void(0);"
                                class="relative flex item-center w-full p-2 text-sm leading-normal font-medium {{ $isEmployeeActive ? 'text-primary bg-dark-transparent' : 'text-gray-900 group hover:bg-dark-transparent hover:text-gray-900' }} transition-all duration-500 ease-in-out rounded-[5px]">
                                <i class="ti ti-users {{ $isEmployeeActive ? 'text-primary' : 'text-gray-500 group-hover:text-gray-900' }}"></i>
                                <span class="ms-2">Employees</span>
                                <span class="menu-arrow absolute top-1/2 -translate-y-1/2 right-2.5 flex items-center w-4 h-4"></span>
                            </a>
                            <ul class="relative mt-2 before:absolute before:top-0 before:left-3.5 before:w-[1.5px] before:h-full before:bg-gray-100"
                                style="display: {{ $isEmployeeActive ? 'block' : 'none' }};">
                                @if(auth()->user()->hasPermission('employees.create'))
                                <li><a href="{{ route('admin.employees.create') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 {{ request()->routeIs('admin.employees.create') ? 'text-primary font-medium' : 'text-gray-500 hover:text-primary' }}">Add Employee</a></li>
                                @endif
                                @if(auth()->user()->hasPermission('employees.show'))
                                <li><a href="{{ route('admin.employees.index') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 {{ request()->routeIs('admin.employees.index') ? 'text-primary font-medium' : 'text-gray-500 hover:text-primary' }}">Employees</a></li>
                                @endif
                            </ul>
                        </li>
                        @endif

                        {{-- Leave Management --}}
                        @php
                            $leaveRoutes = [
                                'admin.leavemgt.leave.types' => 'leave-types.show',
                                'admin.leavemgt.leave.list' => 'leave-list.show',
                                'admin.holiday.index' => 'holiday.show',
                            ];
                            $showLeave = false;
                            foreach ($leaveRoutes as $route => $perm) {
                                if (auth()->user()->hasPermission($perm)) {
                                    $showLeave = true;
                                    break;
                                }
                            }
                            $isLeaveActive = request()->routeIs(array_keys($leaveRoutes));
                        @endphp
                        @if($showLeave)
                        <li class="submenu mb-[5px]">
                            <a href="javascript:void(0);"
                                class="relative flex item-center w-full p-2 text-sm leading-normal font-medium {{ $isLeaveActive ? 'text-primary bg-dark-transparent' : 'text-gray-900 group hover:bg-dark-transparent hover:text-gray-900' }} transition-all duration-500 ease-in-out rounded-[5px]">
                                <i class="ti ti-calendar-off {{ $isLeaveActive ? 'text-primary' : 'text-gray-500 group-hover:text-gray-900' }}"></i>
                                <span class="ms-2">Leave Management</span>
                                <span class="menu-arrow absolute top-1/2 -translate-y-1/2 right-2.5 flex items-center w-4 h-4"></span>
                            </a>
                            <ul class="relative mt-2 before:absolute before:top-0 before:left-3.5 before:w-[1.5px] before:h-full before:bg-gray-100"
                                style="display: {{ $isLeaveActive ? 'block' : 'none' }};">
                                @if(auth()->user()->hasPermission('leave-types.show'))
                                <li><a href="{{ route('admin.leavemgt.leave.types') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 {{ request()->routeIs('admin.leavemgt.leave.types') ? 'text-primary font-medium' : 'text-gray-500 hover:text-primary' }}">Leave Types</a></li>
                                @endif
                                @if(auth()->user()->hasPermission('leave-list.show'))
                                <li><a href="{{ route('admin.leavemgt.leave.list') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 {{ request()->routeIs('admin.leavemgt.leave.list') ? 'text-primary font-medium' : 'text-gray-500 hover:text-primary' }}">Leave Management</a></li>
                                @endif
                                @if(auth()->user()->hasPermission('holiday.show'))
                                <li><a href="{{ route('admin.holiday.index') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 {{ request()->routeIs('admin.holiday.index') ? 'text-primary font-medium' : 'text-gray-500 hover:text-primary' }}">Holiday Management</a></li>
                                @endif
                            </ul>
                        </li>
                        @endif

                        {{-- Payroll --}}
                        @php
                            $payrollRoutes = [
                                'admin.adjustment.index' => 'adjustment.show',
                                'admin.payroll.index' => 'payroll.show',
                                'admin.payroll.list' => 'payroll.list.show',
                                'admin.payroll.payslips' => 'payroll.show', // uses same permission
                            ];
                            $showPayroll = false;
                            foreach ($payrollRoutes as $route => $perm) {
                                if (auth()->user()->hasPermission($perm)) {
                                    $showPayroll = true;
                                    break;
                                }
                            }
                            $isPayrollActive = request()->routeIs(array_keys($payrollRoutes));
                        @endphp
                        @if($showPayroll)
                        <li class="submenu mb-[5px]">
                            <a href="javascript:void(0);"
                                class="relative flex item-center w-full p-2 text-sm leading-normal font-medium {{ $isPayrollActive ? 'text-primary bg-dark-transparent' : 'text-gray-900 group hover:bg-dark-transparent hover:text-gray-900' }} transition-all duration-500 ease-in-out rounded-[5px]">
                                <i class="ti ti-cash {{ $isPayrollActive ? 'text-primary' : 'text-gray-500 group-hover:text-gray-900' }}"></i>
                                <span class="ms-2">Payroll</span>
                                <span class="menu-arrow absolute top-1/2 -translate-y-1/2 right-2.5 flex items-center w-4 h-4"></span>
                            </a>
                            <ul class="relative mt-2 before:absolute before:top-0 before:left-3.5 before:w-[1.5px] before:h-full before:bg-gray-100"
                                style="display: {{ $isPayrollActive ? 'block' : 'none' }};">
                                @if(auth()->user()->hasPermission('adjustment.show'))
                                <li><a href="{{ route('admin.adjustment.index') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 {{ request()->routeIs('admin.adjustment.index') ? 'text-primary font-medium' : 'text-gray-500 hover:text-primary' }}">Advance</a></li>
                                @endif
                                @if(auth()->user()->hasPermission('payroll.show'))
                                <li><a href="{{ route('admin.payroll.index') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 {{ request()->routeIs('admin.payroll.index') ? 'text-primary font-medium' : 'text-gray-500 hover:text-primary' }}">Generate</a></li>
                                @endif
                                @if(auth()->user()->hasPermission('payroll.list.show'))
                                <li><a href="{{ route('admin.payroll.list') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 {{ request()->routeIs('admin.payroll.list') ? 'text-primary font-medium' : 'text-gray-500 hover:text-primary' }}">Payroll List</a></li>
                                @endif
                                @if(auth()->user()->hasPermission('payroll.show'))
                                <li><a href="{{ route('admin.payroll.payslips') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 {{ request()->routeIs('admin.payroll.payslips') ? 'text-primary font-medium' : 'text-gray-500 hover:text-primary' }}">Payslips</a></li>
                                @endif
                            </ul>
                        </li>
                        @endif

                        {{-- Single links --}}
                        @if(auth()->user()->hasPermission('expenses.show'))
                        <li class="mb-[5px]"><a href="{{ route('admin.expenses.index') }}"
                                class="relative flex item-center w-full p-2 text-sm font-medium {{ request()->routeIs('admin.expenses.index') ? 'text-primary bg-dark-transparent' : 'text-gray-900 group hover:bg-dark-transparent hover:text-gray-900' }} rounded-[5px]"><i
                                    class="ti ti-receipt {{ request()->routeIs('admin.expenses.index') ? 'text-primary' : 'text-gray-500 group-hover:text-gray-900' }}"></i><span
                                    class="ms-2">Expense Management</span></a></li>
                        @endif
                        @if(auth()->user()->hasPermission('loan.show'))
                        <li class="mb-[5px]"><a href="{{ route('admin.loan.index') }}"
                                class="relative flex item-center w-full p-2 text-sm font-medium {{ request()->routeIs('admin.loan.index') ? 'text-primary bg-dark-transparent' : 'text-gray-900 group hover:bg-dark-transparent hover:text-gray-900' }} rounded-[5px]"><i
                                    class="ti ti-wallet {{ request()->routeIs('admin.loan.index') ? 'text-primary' : 'text-gray-500 group-hover:text-gray-900' }}"></i><span
                                    class="ms-2">Loan Management</span></a></li>
                        @endif
                        @if(auth()->user()->hasPermission('notices.show'))
                        <li class="mb-[5px]"><a href="{{ route('admin.notice.index') }}"
                                class="relative flex item-center w-full p-2 text-sm font-medium {{ request()->routeIs('admin.notice.index') ? 'text-primary bg-dark-transparent' : 'text-gray-900 group hover:bg-dark-transparent hover:text-gray-900' }} rounded-[5px]"><i
                                    class="ti ti-speakerphone {{ request()->routeIs('admin.notice.index') ? 'text-primary' : 'text-gray-500 group-hover:text-gray-900' }}"></i><span
                                    class="ms-2">Notice Board</span></a></li>
                        @endif
                        {{-- Calendar – no permission middleware, show always or add condition if needed --}}
                        <li class="mb-[5px]"><a href="{{ route('admin.calendar.index') }}"
                                class="relative flex item-center w-full p-2 text-sm font-medium {{ request()->routeIs('admin.calendar.index') ? 'text-primary bg-dark-transparent' : 'text-gray-900 group hover:bg-dark-transparent hover:text-gray-900' }} rounded-[5px]"><i
                                    class="ti ti-calendar-event {{ request()->routeIs('admin.calendar.index') ? 'text-primary' : 'text-gray-500 group-hover:text-gray-900' }}"></i><span
                                    class="ms-2">Calendar & Events</span></a></li>

                        {{-- Reports --}}
                        @php
                            $reportsRoutes = [
                                'admin.reports.attendance' => 'reports.attendance.show',
                                'admin.reports.expense' => 'reports.expense.show',
                                'admin.reports.leave' => 'reports.leave.show',
                                'admin.reports.payslips' => 'reports.payslips.show',
                            ];
                            $showReports = false;
                            foreach ($reportsRoutes as $route => $perm) {
                                if (auth()->user()->hasPermission($perm)) {
                                    $showReports = true;
                                    break;
                                }
                            }
                            $isReportsActive = request()->routeIs(array_keys($reportsRoutes));
                        @endphp
                        @if($showReports)
                        <li class="submenu mb-[5px]">
                            <a href="javascript:void(0);"
                                class="relative flex item-center w-full p-2 text-sm leading-normal font-medium {{ $isReportsActive ? 'text-primary bg-dark-transparent' : 'text-gray-900 group hover:bg-dark-transparent hover:text-gray-900' }} transition-all duration-500 ease-in-out rounded-[5px]">
                                <i class="ti ti-file-analytics {{ $isReportsActive ? 'text-primary' : 'text-gray-500 group-hover:text-gray-900' }}"></i>
                                <span class="ms-2">Reports</span>
                                <span class="menu-arrow absolute top-1/2 -translate-y-1/2 right-2.5 flex items-center w-4 h-4"></span>
                            </a>
                            <ul class="relative mt-2 before:absolute before:top-0 before:left-3.5 before:w-[1.5px] before:h-full before:bg-gray-100"
                                style="display: {{ $isReportsActive ? 'block' : 'none' }};">
                                @if(auth()->user()->hasPermission('reports.attendance.show'))
                                <li><a href="{{ route('admin.reports.attendance') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 {{ request()->routeIs('admin.reports.attendance') ? 'text-primary font-medium' : 'text-gray-500 hover:text-primary' }}">Attendance</a></li>
                                @endif
                                @if(auth()->user()->hasPermission('reports.expense.show'))
                                <li><a href="{{ route('admin.reports.expense') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 {{ request()->routeIs('admin.reports.expense') ? 'text-primary font-medium' : 'text-gray-500 hover:text-primary' }}">Expense</a></li>
                                @endif
                                @if(auth()->user()->hasPermission('reports.leave.show'))
                                <li><a href="{{ route('admin.reports.leave') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 {{ request()->routeIs('admin.reports.leave') ? 'text-primary font-medium' : 'text-gray-500 hover:text-primary' }}">Leave Report</a></li>
                                @endif
                                @if(auth()->user()->hasPermission('reports.payslips.show'))
                                <li><a href="{{ route('admin.reports.payslips') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 {{ request()->routeIs('admin.reports.payslips') ? 'text-primary font-medium' : 'text-gray-500 hover:text-primary' }}">Payslips</a></li>
                                @endif
                            </ul>
                        </li>
                        @endif

                        {{-- Roles & Permissions --}}
                        @php
                            $rolesRoute = [
                                'admin.users' => 'users.show',
                                'admin.user.create' => 'users.create',
                                'admin.user.edit' => 'users.edit',
                                'admin.roles' => 'roles.show',
                                'admin.role.create' => 'roles.create',
                                'admin.role.edit' => 'roles.edit',
                            ];
                            $showRoles = false;
                            foreach ($rolesRoute as $route => $perm) {
                                if (auth()->user()->hasPermission($perm)) {
                                    $showRoles = true;
                                    break;
                                }
                            }
                            $isRolesActive = request()->routeIs(array_keys($rolesRoute));
                        @endphp
                        @if($showRoles)
                        <li class="submenu mb-[5px]">
                            <a href="javascript:void(0);"
                                class="relative flex item-center w-full p-2 text-sm leading-normal font-medium {{ $isRolesActive ? 'text-primary bg-dark-transparent' : 'text-gray-900 group hover:bg-dark-transparent hover:text-gray-900' }} transition-all duration-500 ease-in-out rounded-[5px]">
                                <i class="ti ti-file-analytics {{ $isRolesActive ? 'text-primary' : 'text-gray-500 group-hover:text-gray-900' }}"></i>
                                <span class="ms-2">Roles & Permissions</span>
                                <span class="menu-arrow absolute top-1/2 -translate-y-1/2 right-2.5 flex items-center w-4 h-4"></span>
                            </a>
                            <ul class="relative mt-2 before:absolute before:top-0 before:left-3.5 before:w-[1.5px] before:h-full before:bg-gray-100"
                                style="display: {{ $isRolesActive ? 'block' : 'none' }};">
                                @if(auth()->user()->hasPermission('users.show'))
                                <li><a href="{{ route('admin.users') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 {{ request()->routeIs('admin.users') ? 'text-primary font-medium' : 'text-gray-500 hover:text-primary' }}">Users</a></li>
                                @endif
                                @if(auth()->user()->hasPermission('roles.show'))
                                <li><a href="{{ route('admin.roles') }}"
                                        class="relative flex items-center w-full text-xs leading-normal p-2 ps-8 {{ request()->routeIs('admin.roles') ? 'text-primary font-medium' : 'text-gray-500 hover:text-primary' }}">Roles</a></li>
                                @endif
                            </ul>
                        </li>
                        @endif

                        {{-- Activity Log --}}
                        @if(auth()->user()->hasPermission('activity-log.show'))
                        <li class="mb-[5px]"><a href="{{ route('admin.activity-log') }}"
                                class="relative flex item-center w-full p-2 text-sm font-medium {{ request()->routeIs('admin.activity-log') ? 'text-primary bg-dark-transparent' : 'text-gray-900 group hover:bg-dark-transparent hover:text-gray-900' }} rounded-[5px]"><i
                                    class="ti ti-user {{ request()->routeIs('admin.activity-log') ? 'text-primary' : 'text-gray-500 group-hover:text-gray-900' }}"></i><span
                                    class="ms-2">Activity Log</span></a>
                        </li>
                        @endif

                        {{-- Settings --}}
                        @if(auth()->user()->hasPermission('settings.show'))
                        <li class="mb-[5px]"><a href="{{ route('admin.settings.index') }}"
                                class="relative flex item-center w-full p-2 text-sm font-medium {{ request()->routeIs('admin.settings.index') ? 'text-primary bg-dark-transparent' : 'text-gray-900 group hover:bg-dark-transparent hover:text-gray-900' }} rounded-[5px]"><i
                                    class="ti ti-settings {{ request()->routeIs('admin.settings.index') ? 'text-primary' : 'text-gray-500 group-hover:text-gray-900' }}"></i><span
                                    class="ms-2">Settings</span></a>
                        </li>
                        @endif

                    </ul>
                </li>
            </ul>

        </div>
    </div>
</div>
<!-- /Sidebar -->