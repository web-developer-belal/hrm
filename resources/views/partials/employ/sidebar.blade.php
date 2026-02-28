<!-- Sidebar -->
<div class="sidebar fixed top-0 left-0 bottom-0 w-sidebar bg-white border-r border-borderColor" id="sidebar">
    <!-- Logo -->
    <div class="sidebar-logo fixed h-[50px] w-sidebar pt-3 px-3">
        <a href="{{ route('employee.dashboard') }}" class="logo logo-normal">
            <img src="{{ asset('assets/img/Logo-Babyshop.png') }}" class="my-logo" alt="Logo">
        </a>
        <a href="{{ route('employee.dashboard') }}" class="logo-small hidden">
            <img src="{{ asset('assets/img/Logo-Babyshop.png') }}" class="my-logo" alt="Logo">
        </a>
        <a href="{{ route('employee.dashboard') }}" class="dark-logo hidden">
            <img src="{{ asset('assets/img/Logo-Babyshop.png') }}" class="my-logo" alt="Logo">
        </a>
    </div>
    <!-- /Logo -->

    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">

            <ul>
                <li>
                    <ul class="mb-[19px]">

                        <!-- Dashboard -->
                        <li class="mb-[5px]">
                            <a href="{{ route('employee.dashboard') }}"
                                class="relative flex items-center w-full p-2 text-sm font-medium rounded-[5px] transition-all duration-300
                   {{ request()->routeIs('employee.dashboard') ? 'bg-dark-transparent text-gray-900 active' : 'text-gray-900 hover:bg-dark-transparent' }}">

                                <i
                                    class="ti ti-layout-dashboard 
                       {{ request()->routeIs('employee.dashboard') ? 'text-gray-900' : 'text-gray-500 group-hover:text-gray-900' }}"></i>
                                <span class="ms-2">Dashboard</span>
                            </a>
                        </li>

                        <!-- Attendance -->
                        <li class="mb-[5px]">
                            <a href="{{ route('employee.attendance') }}"
                                class="relative flex items-center w-full p-2 text-sm font-medium rounded-[5px] transition-all duration-300
                   {{ request()->routeIs('employee.attendance') ? 'bg-dark-transparent text-gray-900 active' : 'text-gray-900 hover:bg-dark-transparent' }}">

                                <i
                                    class="ti ti-calendar-time 
                       {{ request()->routeIs('employee.attendance') ? 'text-gray-900' : 'text-gray-500 group-hover:text-gray-900' }}"></i>
                                <span class="ms-2">Attendance</span>
                            </a>
                        </li>

                        <!-- Payslips -->
                        <li class="mb-[5px]">
                            <a href="{{ route('employee.payslips') }}"
                                class="relative flex items-center w-full p-2 text-sm font-medium rounded-[5px] transition-all duration-300
                   {{ request()->routeIs('employee.payslips') ? 'bg-dark-transparent text-gray-900 active' : 'text-gray-900 hover:bg-dark-transparent' }}">

                                <i
                                    class="ti ti-receipt 
                       {{ request()->routeIs('employee.payslips') ? 'text-gray-900' : 'text-gray-500 group-hover:text-gray-900' }}"></i>
                                <span class="ms-2">Payslips</span>
                            </a>
                        </li>

                        <!-- Leave -->
                        <li class="mb-[5px]">
                            <a href="{{ route('employee.leave') }}"
                                class="relative flex items-center w-full p-2 text-sm font-medium rounded-[5px] transition-all duration-300
                   {{ request()->routeIs('employee.leave') ? 'bg-dark-transparent text-gray-900 active' : 'text-gray-900 hover:bg-dark-transparent' }}">

                                <i
                                    class="ti ti-calendar-event 
                       {{ request()->routeIs('employee.leave') ? 'text-gray-900' : 'text-gray-500 group-hover:text-gray-900' }}"></i>
                                <span class="ms-2">Leave</span>
                            </a>
                        </li>

                        <!-- Notices -->
                        <li class="mb-[5px]">
                            <a href="{{ route('employee.notices') }}"
                                class="relative flex items-center w-full p-2 text-sm font-medium rounded-[5px] transition-all duration-300
                   {{ request()->routeIs('employee.notices') ? 'bg-dark-transparent text-gray-900 active' : 'text-gray-900 hover:bg-dark-transparent' }}">

                                <i
                                    class="ti ti-bell 
                       {{ request()->routeIs('employee.notices') ? 'text-gray-900' : 'text-gray-500 group-hover:text-gray-900' }}"></i>
                                <span class="ms-2">Notices</span>
                            </a>
                        </li>
                        <!-- Complain -->
                        <li class="mb-[5px]">
                            <a href="{{ route('employee.complain') }}"
                                class="relative flex items-center w-full p-2 text-sm font-medium rounded-[5px] transition-all duration-300
        {{ request()->routeIs('employee.complain') ? 'bg-dark-transparent text-gray-900 active' : 'text-gray-900 hover:bg-dark-transparent' }}">

                                <i
                                    class="ti ti-message-report
            {{ request()->routeIs('employee.complain') ? 'text-gray-900' : 'text-gray-500 group-hover:text-gray-900' }}">
                                </i>
                                <span class="ms-2">Complain</span>
                            </a>
                        </li>

                        <!-- Loan -->
                        <li class="mb-[5px]">
                            <a href="{{ route('employee.loan') }}"
                                class="relative flex items-center w-full p-2 text-sm font-medium rounded-[5px] transition-all duration-300
        {{ request()->routeIs('employee.loan') ? 'bg-dark-transparent text-gray-900 active' : 'text-gray-900 hover:bg-dark-transparent' }}">

                                <i
                                    class="ti ti-cash
            {{ request()->routeIs('employee.loan') ? 'text-gray-900' : 'text-gray-500 group-hover:text-gray-900' }}">
                                </i>
                                <span class="ms-2">Loan</span>
                            </a>
                        </li>

                        <!-- Profile -->
                        <li class="mb-[5px]">
                            <a href="{{ route('employee.profile') }}"
                                class="relative flex items-center w-full p-2 text-sm font-medium rounded-[5px] transition-all duration-300
                   {{ request()->routeIs('employee.profile') ? 'bg-dark-transparent text-gray-900 active' : 'text-gray-900 hover:bg-dark-transparent' }}">

                                <i
                                    class="ti ti-user 
                       {{ request()->routeIs('employee.profile') ? 'text-gray-900' : 'text-gray-500 group-hover:text-gray-900' }}"></i>
                                <span class="ms-2">Profile</span>
                            </a>
                        </li>

                    </ul>
                </li>
            </ul>

        </div>
    </div>
</div>
<!-- /Sidebar -->
