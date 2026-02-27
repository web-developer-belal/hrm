<!-- Header -->
<div class="header fixed top-0 left-0 right-0 bg-white h-[50px] border-b border-gray-200 lg:left-vertical-w">
    <div class="main-header h-[50px]">

        <div class="header-left hidden relative float-left text-center h-[50px] z-[1] media-max-md:flex">
            <a href="{{ route('admin.dashboard') }}" class="logo">
                <img src="{{ asset('assets/img/logo.svg') }}" alt="Logo">
            </a>
            <a href="{{ route('admin.dashboard') }}" class="dark-logo">
                <img src="{{ asset('assets/img/logo-white.svg') }}" alt="Logo">
            </a>
        </div>

        <a id="mobile_btn" class="mobile_btn" href="#sidebar">
            <span class="bar-icon">
                <span></span>
                <span></span>
                <span></span>
            </span>
        </a>

        <div class="header-user px-[15px] py-4">
            <div class="nav user-menu nav-list flex items-center justify-center h-full px-6 'media-max-md:hidden">

                <div class="me-auto flex items-center" id="header-search">
                    <a id="toggle_btn" href="javascript:void(0);"
                        class="btn btn-menubar size-[30px] flex items-center justify-center text-gray-500 text-lg leading-normal rounded-[5px] hover:text-gray-900 hover:bg-dark-transparent me-1">
                        <i class="ti ti-arrow-bar-to-left"></i>
                    </a>
                    <!-- Search -->
                    <div class="flex w-[259px] relative me-1">
                        <span
                            class="absolute inset-y-0 start-0 flex items-center ps-2.5 pointer-events-none text-gray-400"><i
                                class="ti ti-search"></i></span>
                        <input type="text"
                            class="block flex-1 border border-borderColor bg-white rounded-[5px] py-1.5 pl-7 pr-12 text-gray-900 placeholder:text-gray-400 focus:ring-0 focus:border-borderColor h-[30px] text-xs"
                            placeholder="Search in HRMS">
                        <span class="absolute inset-y-1/2 end-0 flex items-center me-2.5 pointer-events-none "><kbd
                                class="bg-dark-transparent text-[10px] font-medium text-gray-500 px-[3px] py-0.5 rounded">CTRL
                                + / </kbd></span>
                    </div>
                    <!-- /Search -->

                  
                </div>

                <div class="flex items-center">
                    
                  
                    <div class="me-1 notification_item">
                        <button data-dropdown-toggle="noti-dropdown"
                            class="btn btn-menubar size-[30px] flex items-center justify-center text-gray-500 rounded-[5px] hover:text-gray-900 hover:bg-dark-transparent focus:bg-dark-transparent focus:text-gray-900 relative"
                            type="button">
                            <i class="ti ti-bell"></i>
                            <span
                                class="right-[5px] top-[5px] absolute w-[6px] h-[6px] text-[6px] flex items-center justify-center bg-danger text-white rounded-full notification-status-dot"></span>
                        </button>
                        <div id="noti-dropdown"
                            class="z-10 hidden bg-white rounded-[5px] shadow p-6 w-55 dark:bg-gray-700">
                            <div class="flex items-center justify-between border-b border-borderColor p-0 pb-4 mb-4">
                                <h4 class="notification-title">Notifications (2)</h4>
                                <div class="flex items-center">
                                    <a href="#" class="text-primary text-nowrap text-[15px] me-3 lh-1">Mark all
                                        as read</a>
                                    <button id="doubleDropdownButton" data-dropdown-toggle="doubleDropdown"
                                        data-dropdown-placement="right-start" type="button"
                                        class="flex items-center w-full text-gray-900 hover:text-primary"><i
                                            class="ti ti-calendar-due me-1"></i>Today</button>
                                    <div id="doubleDropdown"
                                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                                        <ul class="p-2 text-sm text-gray-900" aria-labelledby="doubleDropdownButton">
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
                            </div>
                            <div class="text-gray-900 noti-content scroll-smooth h-[270px] overflow-y-auto">
                                <div class="border-b border-borderColor mb-4 pb-4">
                                    <a href="">
                                        <div class="flex">
                                            <span class="flex items-center size-[45px] me-2 shrink-0">
                                                <img src="{{ asset('assets/img/profiles/avatar-27.jpg') }}" alt="Profile"
                                                    class="rounded">
                                            </span>
                                            <div class="grow">
                                                <p class="mb-1"><span class="text-title font-semibold">Shawn</span>
                                                    performance in Math is below the threshold.</p>
                                                <span>Just Now</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="border-b border-borderColor mb-4 pb-4">
                                    <a href="" class="pb-0">
                                        <div class="flex">
                                            <span class="flex items-center size-[45px] me-2 shrink-0">
                                                <img src="{{ asset('assets/img/profiles/avatar-23.jpg') }}" alt="Profile"
                                                    class="rounded">
                                            </span>
                                            <div class="grow">
                                                <p class="mb-1"><span class="text-title font-semibold">Sylvia</span>
                                                    added appointment on 02:00 PM</p>
                                                <span>10 mins ago</span>
                                                <div class="flex justify-start items-center mt-1">
                                                    <span
                                                        class="btn bg-light border border-light text-gray-900 text-center py-1 px-2 hover:bg-light-900 hover:text-gray-900 text-xs leading-normal me-2">Deny</span>
                                                    <span
                                                        class="btn bg-primary border border-primary text-white text-center py-1 px-2 hover:bg-primary-900 hover:text-white text-xs leading-normal">Approve</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="border-b border-borderColor mb-4 pb-4">
                                    <a href="">
                                        <div class="flex">
                                            <span class="flex items-center size-[45px] me-2 shrink-0">
                                                <img src="{{ asset('assets/img/profiles/avatar-25.jpg') }}" alt="Profile"
                                                    class="rounded">
                                            </span>
                                            <div class="grow">
                                                <p class="mb-1">New student record <span
                                                        class="text-title font-semibold"> George</span> is created by
                                                    <span class="text-title font-semibold">Teressa</span></p>
                                                <span>2 hrs ago</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="border-0 mb-4 pb-0">
                                    <a href="">
                                        <div class="flex">
                                            <span class="flex items-center size-[45px] me-2 shrink-0">
                                                <img src="{{ asset('assets/img/profiles/avatar-01.jpg') }}" alt="Profile"
                                                    class="rounded">
                                            </span>
                                            <div class="grow">
                                                <p class="mb-1">A new teacher record for <span
                                                        class="text-title font-semibold">Elisa</span> </p>
                                                <span>09:45 AM</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="flex p-0 gap-2">
                                <a href="#"
                                    class="btn bg-light border border-light text-gray-900 text-center hover:bg-light-900 hover:text-gray-900 w-full">Cancel</a>
                                <a href=""
                                    class="btn bg-primary border border-primary text-white text-center hover:bg-primary-900 hover:text-white w-full">View
                                    All</a>
                            </div>
                        </div>
                    </div>
                    <div class="me-1">
                        <button data-dropdown-toggle="profile-dropdown" class="flex items-center justify-center"
                            type="button">
                            <span class="relative">
                                <img src="{{ customAsset(Auth::user()->photo,true,'user') }}" alt="Img"
                                    class="size-6 rounded-full">
                                <span
                                    class="right-0 bottom-0 absolute  w-2 h-2 bg-success border-2 border-white  rounded-full"></span>
                            </span>
                        </button>
                        <div id="profile-dropdown"
                            class="z-10 hidden bg-white divide-y divide-borderColor rounded-[5px] shadow w-55">
                            <div class="px-[20px] py-4">
                                <div class="flex items-center">
                                    <span class="size-[45px] me-2">
                                        <img src="{{ customAsset(Auth::user()->photo,true,'user') }}" alt="img"
                                            class="rounded-full border-2 border-gray-100">
                                    </span>
                                    <div>
                                        <h5 class="mb-0">{{ Auth::user()->full_name }}</h5>
                                        <p class="text-xs leading-normal text-gray-900 font-medium mb-0">{{ Auth::user()->email }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <ul class="p-[20px]">
                                <li>
                                    <a class="inline-flex items-center text-gray-900 py-2 hover:text-primary"
                                        href="">
                                        <i class="ti ti-user-circle me-1"></i>My Profile
                                    </a>
                                </li>
                                <li>
                                    <a class="inline-flex items-center text-gray-900 py-2 hover:text-primary"
                                        href="bussiness-settings.html">
                                        <i class="ti ti-settings me-1"></i>Settings
                                    </a>
                                </li>
                                <li>
                                    <a class="inline-flex items-center text-gray-900 py-2 hover:text-primary"
                                        href="security-settings.html">
                                        <i class="ti ti-status-change me-1"></i>Status
                                    </a>
                                </li>
                                <li>
                                    <a class="inline-flex items-center text-gray-900 py-2 hover:text-primary"
                                        href="">
                                        <i class="ti ti-circle-arrow-up me-1"></i>My Account
                                    </a>
                                </li>
                                <li>
                                    <a class="inline-flex items-center text-gray-900 py-2 hover:text-primary"
                                        href="knowledgebase.html">
                                        <i class="ti ti-question-mark me-1"></i>Knowledge Base
                                    </a>
                                </li>
                            </ul>
                            <div class="px-[20px] py-4">
                                <a class="inline-flex items-center text-gray-900 py-2 hover:text-primary"
                                    href="">
                                    <i class="ti ti-login me-2"></i>Logout
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="dropdown mobile-user-menu">
            <a href="javascript:void(0);" data-dropdown-toggle="mobile-dropdown"><i class="fa fa-ellipsis-v"></i></a>
            <ul id="mobile-dropdown" class="hidden p-1 border rounded bg-white shadow-lg w-40 z-[1]">
                <li><a class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary text-gray-900"
                        href="{{ route('employee.profile') }}">My Profile</a></li>
                <li><a class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary text-gray-900"
                        href="">Settings</a></li>
                <li><a class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary text-gray-900"
                        href="">Logout</a></li>
            </ul>
        </div>
        <!-- /Mobile Menu -->

    </div>

</div>
<!-- /Header -->
