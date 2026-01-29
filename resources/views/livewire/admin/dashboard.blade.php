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
            <div class="me-2 mb-2">
                <div>
                    <a href="javascript:void(0);"
                        class="border rounded p-2 bg-white inline-flex items-center focus:bg-primary focus:border-primary focus:text-white text-gray-900"
                        data-dropdown-toggle="export-dropdown">
                        <i class="ti ti-file-export me-1"></i>Export<i class="ti ti-chevron-down ml-1"></i>
                    </a>
                    <ul id="export-dropdown" class="hidden p-4 border rounded bg-white shadow-lg">
                        <li>
                            <a href="javascript:void(0);"
                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary text-gray-900"><i
                                    class="ti ti-file-type-pdf me-1"></i>Export as PDF</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);"
                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary text-gray-900"><i
                                    class="ti ti-file-type-xls me-1"></i>Export as Excel </a>
                        </li>
                    </ul>
                </div>
            </div>
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

    <!-- Welcome Wrap -->
    <div class="card rounded-[5px] shadow-xs bg-white border-0 mb-6">
        <div class="card-body flex items-center justify-between flex-wrap p-5 pb-1">
            <div class="flex items-center mb-4">
                <span class="flex items-center justify-center shrink-0 size-[60px]">
                    <img src="assets/img/profiles/avatar-31.jpg" class="rounded-full" alt="img">
                </span>
                <div class="ms-4">
                    <h3 class="mb-2">Welcome Back, Adrian <a href="javascript:void(0);"
                            class="size-[22px] inline-flex items-center justify-center bg-dark-transparent text-gray-500 hover:bg-gray-300 hover:text-gray-500 rounded-full"><i
                                class="ti ti-edit text-sm leading-none"></i></a></h3>
                    <p>You have <span class="text-primary underline">21</span> Pending Approvals & <span
                            class="text-primary underline">14</span> Leave Requests</p>
                </div>
            </div>
            <div class="flex items-center flex-wrap mb-1">
                <a href="#"
                    class="btn bg-secondary border border-secondary text-white text-center py-1.5 px-3 hover:bg-secondary-900 hover:text-white text-xs inline-flex items-center me-2 mb-2"
                    data-modal-toggle="add_project" data-modal-target="add_project"><i
                        class="ti ti-square-rounded-plus me-1"></i>Add Project</a>
                <a href="#"
                    class="btn bg-primary border border-primary text-white text-center py-1.5 px-3 hover:bg-primary-900 hover:text-white text-xs inline-flex items-center mb-2"
                    data-modal-target="add_leaves" data-modal-toggle="add_leaves"><i
                        class="ti ti-square-rounded-plus me-1"></i>Add Requests</a>
            </div>
        </div>
    </div>
    <!-- /Welcome Wrap -->

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
                            <h6 class="text-[13px] font-medium text-default mb-1">Attendance Overview</h6>
                            <h3 class="mb-4">120/154 <span class="text-xs leading-normal font-medium text-success"><i
                                        class="fa-solid fa-caret-up me-1"></i>+2.1%</span></h3>
                            <a href="attendance-employee.html" class="text-default hover:text-primary">View Details</a>
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
                            <h6 class="text-[13px] font-medium text-default mb-1">Total No of Project's</h6>
                            <h3 class="mb-4">90/125 <span class="text-xs leading-normal font-medium text-danger"><i
                                        class="fa-solid fa-caret-down me-1"></i>-2.1%</span></h3>
                            <a href="projects.html" class="text-default hover:text-primary">View All</a>
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
                            <h6 class="text-[13px] font-medium text-default mb-1">Total No of Clients</h6>
                            <h3 class="mb-4">69/86 <span class="text-xs leading-normal font-medium text-danger"><i
                                        class="fa-solid fa-caret-down me-1"></i>-11.2%</span></h3>
                            <a href="clients.html" class="text-default hover:text-primary">View All</a>
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
                            <h6 class="text-[13px] font-medium text-default mb-1">Total No of Tasks</h6>
                            <h3 class="mb-4">225/28 <span class="text-xs leading-normal font-medium text-success"><i
                                        class="fa-solid fa-caret-down me-1"></i>+11.2%</span></h3>
                            <a href="tasks.html" class="text-default hover:text-primary">View All</a>
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
                            <h6 class="text-[13px] font-medium text-default mb-1">Earnings</h6>
                            <h3 class="mb-4">$21445 <span class="text-xs leading-normal font-medium text-success"><i
                                        class="fa-solid fa-caret-up me-1"></i>+10.2%</span></h3>
                            <a href="expenses.html" class="text-default hover:text-primary">View All</a>
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
                            <h6 class="text-[13px] font-medium text-default mb-1">Profit This Week</h6>
                            <h3 class="mb-4">$5,544 <span class="text-xs leading-normal font-medium text-success"><i
                                        class="fa-solid fa-caret-up me-1"></i>+2.1%</span></h3>
                            <a href="purchase-transaction.html" class="text-default hover:text-primary">View All</a>
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
                            <h6 class="text-[13px] font-medium text-default mb-1">Job Applicants</h6>
                            <h3 class="mb-4">98 <span class="text-xs leading-normal font-medium text-success"><i
                                        class="fa-solid fa-caret-up me-1"></i>+2.1%</span></h3>
                            <a href="job-list.html" class="text-default hover:text-primary">View All</a>
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
                            <h6 class="text-[13px] font-medium text-default mb-1">New Hire</h6>
                            <h3 class="mb-4">45/48 <span class="text-xs leading-normal font-medium text-danger"><i
                                        class="fa-solid fa-caret-down me-1"></i>-11.2%</span></h3>
                            <a href="candidates.html" class="text-default hover:text-primary">View All</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Widget Info -->

        <!-- Employees By Department -->
        <div class="xxl:col-span-4 flex">
            <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white w-full mb-6">
                <div
                    class="card-header px-5 pt-4 pb-2 flex items-center justify-between flex-wrap border-b border-borderColor">
                    <h5 class="mb-2">Employees By Department</h5>
                    <div class="mb-2">
                        <a href="javascript:void(0);"
                            class="border rounded py-1 px-2 text-xs font-medium bg-white inline-flex items-center focus:bg-primary focus:border-primary focus:text-white text-gray-900"
                            data-dropdown-toggle="week-dropdown">
                            <i class="ti ti-calendar me-1"></i>This Week
                        </a>
                        <ul id="week-dropdown" class="hidden p-4 border rounded bg-white shadow-lg w-40 z-[1]">
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
                    <div id="emp-department"></div>
                    <p class="text-[13px]"><i class="ti ti-circle-filled me-2 text-[8px] text-primary"></i>No of
                        Employees increased by <span class="text-success font-bold">+20%</span> from last Week
                    </p>
                </div>
            </div>
        </div>
        <!-- /Employees By Department -->

    </div>

    <div class="grid grid-cols-1 xxl:grid-cols-12 xl:grid-cols-12 gap-x-6">

        <!-- Total Employee -->
        <div class="xxl:col-span-4 xl:col-span-12 flex">
            <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white w-full mb-6">
                <div
                    class="card-header pt-4 px-5 pb-2 flex items-center justify-between flex-wrap border-b border-borderColor">
                    <h5 class="mb-2">Employee Status</h5>
                    <div class="mb-2">
                        <a href="javascript:void(0);"
                            class="border rounded py-1 px-2 text-xs font-medium bg-white inline-flex items-center focus:bg-primary focus:border-primary focus:text-white text-gray-900"
                            data-dropdown-toggle="emp-dropdown">
                            <i class="ti ti-calendar me-1"></i>This Week
                        </a>
                        <ul id="emp-dropdown" class="hidden p-4 border rounded bg-white shadow-lg w-40 z-[1]">
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
                    <div class="flex items-center justify-between mb-1">
                        <p class="text-[13px] mb-4">Total Employee</p>
                        <h3 class="mb-4">154</h3>
                    </div>
                    <div class="w-full bg-light-900 rounded flex h-6 mb-4">
                        <div class="bg-warning h-6 rounded-s" style="width: 40%"></div>
                        <div class="bg-secondary h-6" style="width: 20%"></div>
                        <div class="bg-danger h-6" style="width: 10%"></div>
                        <div class="bg-pink h-6 rounded-e" style="width: 30%"></div>
                    </div>
                    <div class="border border-borderColor mb-4">
                        <div class="grid grid-cols-2 gx-0">
                            <div>
                                <div class="p-2 flex-1 border-e border-b border-borderColor">
                                    <p class="text-[13px] mb-2"><i
                                            class="ti ti-square-filled text-primary text-xs leading-normal me-2"></i>Fulltime
                                        <span class="text-gray-900">(48%)</span></p>
                                    <h2 class="display-1">112</h2>
                                </div>
                            </div>
                            <div>
                                <div class="p-2 flex-1 border-b border-borderColor text-end">
                                    <p class="text-[13px] mb-2"><i
                                            class="ti ti-square-filled me-2 text-secondary text-xs leading-normal"></i>Contract
                                        <span class="text-gray-900">(20%)</span></p>
                                    <h2 class="display-1">112</h2>
                                </div>
                            </div>
                            <div>
                                <div class="p-2 flex-1 border-e">
                                    <p class="text-[13px] mb-2"><i
                                            class="ti ti-square-filled me-2 text-danger text-xs leading-normal"></i>Probation
                                        <span class="text-gray-900">(22%)</span></p>
                                    <h2 class="display-1">12</h2>
                                </div>
                            </div>
                            <div>
                                <div class="p-2 flex-1 text-end">
                                    <p class="text-[13px] mb-2"><i
                                            class="ti ti-square-filled text-pink me-2 text-xs leading-normal"></i>WFH
                                        <span class="text-gray-900">(20%)</span></p>
                                    <h2 class="display-1">04</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h6 class="mb-2">Top Performer</h6>
                    <div
                        class="p-2 flex items-center justify-between border border-primary bg-primary-100 rounded-defaultradius mb-6">
                        <div class="flex items-center overflow-hidden">
                            <span class="me-2">
                                <i class="ti ti-award-filled text-primary text-2xl leading-none"></i>
                            </span>
                            <a href="employee-details.html" class="size-8 me-2">
                                <img src="assets/img/profiles/avatar-24.jpg" class="rounded-full border border-white"
                                    alt="img">
                            </a>
                            <div>
                                <h6 class="truncate mb-1 fs-14 font-medium"><a href="employee-details.html"
                                        class="hover:text-primary">Daniel Esbella</a></h6>
                                <p class="text-[13px]">IOS Developer</p>
                            </div>
                        </div>
                        <div class="text-end">
                            <p class="text-[13px] mb-1">Performance</p>
                            <h5 class="text-primary">99%</h5>
                        </div>
                    </div>
                    <a href="employees.html"
                        class="btn bg-light border border-light text-gray-900 text-center py-1.5 px-2 hover:bg-light-900 hover:text-gray-900 text-xs leading-normal w-full">View
                        All Employees</a>
                </div>
            </div>
        </div>
        <!-- /Total Employee -->

        <!-- Attendance Overview -->
        <div class="xxl:col-span-4 xl:col-span-6 flex">
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
                                    src="assets/img/profiles/avatar-27.jpg" alt="">
                                <img class="size-6 border border-white rounded-full  hover:-translate-y-[0.188rem] hover:z-[1] transition-transform duration-150 ease-in-out"
                                    src="assets/img/profiles/avatar-30.jpg" alt="">
                                <img class="size-6 border border-white rounded-full hover:-translate-y-[0.188rem] hover:z-[1] transition-transform duration-150 ease-in-out"
                                    src="assets/img/profiles/avatar-14.jpg" alt="">
                                <img class="size-6 border border-white rounded-full hover:-translate-y-[0.188rem] hover:z-[1] transition-transform duration-150 ease-in-out"
                                    src="assets/img/profiles/avatar-29.jpg" alt="">
                                <a class="flex items-center justify-center size-6 border text-xs font-medium text-white bg-primary border-primary rounded-full hover:primary-900 shrink-0 hover:-translate-y-[0.188rem] hover:z-[1] transition-transform duration-150 ease-in-out"
                                    href="#">+1</a>
                            </div>
                        </div>
                        <a href="leaves.html"
                            class="text-[13px] text-primary hover:text-primary-900 underline mb-2">View Details</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Attendance Overview -->

        <!-- Clock-In/Out -->
        <div class="xxl:col-span-4 xl:col-span-6 flex">
            <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white w-full mb-6">
                <div
                    class="card-header pt-4 px-5 pb-2 flex items-center justify-between flex-wrap border-b border-borderColor">
                    <h5 class="mb-2">Clock-In/Out</h5>
                    <div class="flex items-center">
                        <div class="me-2 mb-2">
                            <a href="javascript:void(0);"
                                class="border border-white rounded py-1 px-2 text-[13px] font-normal bg-white inline-flex items-center focus:bg-primary focus:border-primary focus:text-white text-gray-900"
                                data-dropdown-toggle="dept-dropdown">
                                All Departments
                            </a>
                            <ul id="dept-dropdown" class="hidden p-4 border rounded bg-white shadow-lg w-40 z-[1]">
                                <li>
                                    <a href="javascript:void(0);"
                                        class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary text-gray-900">Finance</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);"
                                        class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary text-gray-900">Development</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);"
                                        class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary text-gray-900">Marketing</a>
                                </li>
                            </ul>
                        </div>
                        <div class="mb-2">
                            <a href="javascript:void(0);"
                                class="border rounded py-1 px-2 text-xs font-medium bg-white inline-flex items-center focus:bg-primary focus:border-primary focus:text-white text-gray-900"
                                data-dropdown-toggle="today-dropdown1">
                                <i class="ti ti-calendar me-1"></i>Today
                            </a>
                            <ul id="today-dropdown1" class="hidden p-4 border rounded bg-white shadow-lg w-40 z-[1]">
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
                </div>
                <div class="card-body p-5">
                    <div>
                        <div
                            class="flex items-center justify-between mb-4 p-2 border border-dashed rounded-defaultradius">
                            <div class="flex items-center">
                                <a href="javascript:void(0);"
                                    class="size-[42px] flex items-center justify-center rounded-full shrink-0">
                                    <img src="assets/img/profiles/avatar-24.jpg"
                                        class="rounded-full border border-borderColor" alt="img">
                                </a>
                                <div class="ms-2">
                                    <h6 class="fs-14 font-medium truncate">Daniel Esbella</h6>
                                    <p class="text-[13px]">UI/UX Designer</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <a href="javascript:void(0);" class="text-default hover:text-primary me-2"><i
                                        class="ti ti-clock-share"></i></a>
                                <span
                                    class="text-[10px] font-medium inline-flex items-center py-1 px-2 rounded bg-success text-white leading-none"><i
                                        class="ti ti-circle-filled text-[5px] me-1"></i>09:15</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between mb-3 p-2 border rounded-defaultradius">
                            <div class="flex items-center">
                                <a href="javascript:void(0);"
                                    class="size-[42px] flex items-center justify-center rounded-full shrink-0">
                                    <img src="assets/img/profiles/avatar-23.jpg"
                                        class="rounded-full border border-borderColor" alt="img">
                                </a>
                                <div class="ms-2">
                                    <h6 class="fs-14 font-medium">Doglas Martini</h6>
                                    <p class="text-[13px]">Project Manager</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <a href="javascript:void(0);" class="text-default hover:text-primary me-2"><i
                                        class="ti ti-clock-share"></i></a>
                                <span
                                    class="text-[10px] font-medium inline-flex items-center py-1 px-2 rounded bg-success text-white leading-none"><i
                                        class="ti ti-circle-filled text-[5px] me-1"></i>09:36</span>
                            </div>
                        </div>
                        <div class="mb-4 p-2 border rounded-defaultradius">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <a href="javascript:void(0);"
                                        class="size-[42px] flex items-center justify-center rounded-full shrink-0">
                                        <img src="assets/img/profiles/avatar-27.jpg"
                                            class="rounded-full border-borderColor border-2" alt="img">
                                    </a>
                                    <div class="ms-2">
                                        <h6 class="fs-14 font-medium truncate">Brian Villalobos</h6>
                                        <p class="text-[13px]">PHP Developer</p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <a href="javascript:void(0);" class="text-default hover:text-primary me-2"><i
                                            class="ti ti-clock-share"></i></a>
                                    <span
                                        class="text-[10px] font-medium inline-flex items-center py-1 px-2 rounded bg-success text-white leading-none"><i
                                            class="ti ti-circle-filled text-[5px] me-1"></i>09:15</span>
                                </div>
                            </div>
                            <div
                                class="flex items-center justify-between flex-wrap mt-2 border rounded-defaultradius p-2 pb-0">
                                <div>
                                    <p class="mb-1 inline-flex items-center"><i
                                            class="ti ti-circle-filled text-success text-[5px] me-1"></i>Clock In</p>
                                    <h6 class="text-[13px] font-normal mb-2">10:30 AM</h6>
                                </div>
                                <div>
                                    <p class="mb-1 inline-flex items-center"><i
                                            class="ti ti-circle-filled text-danger text-[5px] me-1"></i>Clock Out</p>
                                    <h6 class="text-[13px] font-normal mb-2">09:45 AM</h6>
                                </div>
                                <div>
                                    <p class="mb-1 inline-flex items-center"><i
                                            class="ti ti-circle-filled text-warning text-[5px] me-1"></i>Production</p>
                                    <h6 class="text-[13px] font-normal mb-2">09:21 Hrs</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h6 class="mb-2">Late</h6>
                    <div class="flex items-center justify-between mb-4 p-2 border border-dashed rounded-defaultradius">
                        <div class="flex items-center overflow-hidden">
                            <span class="size-[42px] flex items-center justify-center rounded-full shrink-0">
                                <img src="assets/img/profiles/avatar-29.jpg"
                                    class="rounded-full border-borderColor border-2" alt="img">
                            </span>
                            <div class="ms-2 overflow-hidden">
                                <h6 class="fs-14 font-medium truncate">Anthony Lewis <span
                                        class="text-[10px] font-medium inline-flex items-center py-1 px-2 rounded bg-success text-white leading-none"><i
                                            class="ti ti-clock-hour-11 me-1"></i>30 Min</span></h6>
                                <p class="text-[13px]">Marketing Head</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <a href="javascript:void(0);" class="text-default hover:text-primary me-2"><i
                                    class="ti ti-clock-share"></i></a>
                            <span
                                class="text-[10px] font-medium inline-flex items-center py-1 px-2 rounded bg-danger text-white leading-none"><i
                                    class="ti ti-circle-filled text-[5px] me-1"></i>08:35</span>
                        </div>
                    </div>
                    <a href="attendance-report.html"
                        class="btn bg-light border border-light text-gray-900 text-center py-1.5 px-3.5 hover:bg-light-900 hover:text-gray-900 text-[13px] leading-normal w-full">View
                        All Attendance</a>
                </div>
            </div>
        </div>
        <!-- /Clock-In/Out -->

    </div>

    <div class="grid grid-cols-1 xxl:grid-cols-12 xl:grid-cols-12 gap-6 mb-6">

        <!-- Jobs Applicants -->
        <div class="xxl:col-span-4 xl:col-span-12 flex">
            <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white w-full">
                <div
                    class="card-header pt-4 px-5 pb-2 flex items-center justify-between flex-wrap border-b border-borderColor">
                    <h5 class="mb-2">Jobs Applicants</h5>
                    <a href="job-list.html"
                        class="btn bg-light border border-light text-gray-900 text-center py-1.5 px-3.5 hover:bg-light-900 hover:text-gray-900 text-[13px] leading-normal mb-2">View
                        All</a>
                </div>
                <div class="card-body p-5">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center bg-gray-200 rounded-defaultradius mb-6"
                        data-tabs-toggle="#job-tab-content"
                        data-tabs-active-classes="bg-primary text-white hover:text-primary"
                        data-tabs-inactive-classes="text-gray-900 hover:text-primary" role="tablist">
                        <li role="presentation" class="flex-1">
                            <button class="block py-1.5 px-3 rounded-defaultradius w-full"
                                data-tabs-target="#openings" type="button" role="tab"
                                aria-selected="false">Openings</button>
                        </li>
                        <li role="presentation" class="flex-1">
                            <button class="block py-1.5 px-3 rounded-defaultradius w-full"
                                data-tabs-target="#applicants" type="button" role="tab"
                                aria-selected="false">Applicants</button>
                        </li>
                    </ul>
                    <div id="job-tab-content">
                        <div class="hidden " id="openings" role="tabpanel">
                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center">
                                    <a href="#"
                                        class="size-[42px] flex items-center justify-center rounded overflow-hidden shrink-0 bg-gray-100">
                                        <img src="assets/img/icons/apple.svg" class="img-fluid w-auto h-auto"
                                            alt="img">
                                    </a>
                                    <div class="ms-2 overflow-hidden">
                                        <p class="text-title font-medium truncate mb-0"><a
                                                href="javascript:void(0);">Senior IOS Developer</a></p>
                                        <span class="text-xs leading-normal">No of Openings : 25 </span>
                                    </div>
                                </div>
                                <a href="javascript:void(0);"
                                    class="size-7 rounded-defaultradius flex items-center justify-center border border-light bg-light text-gray-900 hover:bg-primary hover:text-white hover:border-primary"><i
                                        class="ti ti-edit"></i></a>
                            </div>
                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center">
                                    <a href="#"
                                        class="size-[42px] flex items-center justify-center rounded overflow-hidden shrink-0 bg-gray-100">
                                        <img src="assets/img/icons/php.svg" class="img-fluid w-auto h-auto"
                                            alt="img">
                                    </a>
                                    <div class="ms-2 overflow-hidden">
                                        <p class="text-title font-medium truncate mb-0"><a
                                                href="javascript:void(0);">Junior PHP Developer</a></p>
                                        <span class="text-xs leading-normal">No of Openings : 20 </span>
                                    </div>
                                </div>
                                <a href="javascript:void(0);"
                                    class="size-7 rounded-defaultradius flex items-center justify-center border border-light bg-light text-gray-900 hover:bg-primary hover:text-white hover:border-primary"><i
                                        class="ti ti-edit"></i></a>
                            </div>
                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center">
                                    <a href="#"
                                        class="size-[42px] flex items-center justify-center rounded overflow-hidden shrink-0 bg-gray-100">
                                        <img src="assets/img/icons/react.svg" class="img-fluid w-auto h-auto"
                                            alt="img">
                                    </a>
                                    <div class="ms-2 overflow-hidden">
                                        <p class="text-title font-medium truncate mb-0"><a
                                                href="javascript:void(0);">Junior React Developer </a></p>
                                        <span class="text-xs leading-normal">No of Openings : 30 </span>
                                    </div>
                                </div>
                                <a href="javascript:void(0);"
                                    class="size-7 rounded-defaultradius flex items-center justify-center border border-light bg-light text-gray-900 hover:bg-primary hover:text-white hover:border-primary"><i
                                        class="ti ti-edit"></i></a>
                            </div>
                            <div class="flex items-center justify-between mb-0">
                                <div class="flex items-center">
                                    <a href="#"
                                        class="size-[42px] flex items-center justify-center rounded overflow-hidden shrink-0 bg-gray-100">
                                        <img src="assets/img/icons/laravel-icon.svg" class="img-fluid w-auto h-auto"
                                            alt="img">
                                    </a>
                                    <div class="ms-2 overflow-hidden">
                                        <p class="text-title font-medium truncate mb-0"><a
                                                href="javascript:void(0);">Senior Laravel Developer</a></p>
                                        <span class="text-xs leading-normal">No of Openings : 40 </span>
                                    </div>
                                </div>
                                <a href="javascript:void(0);"
                                    class="size-7 rounded-defaultradius flex items-center justify-center border border-light bg-light text-gray-900 hover:bg-primary hover:text-white hover:border-primary"><i
                                        class="ti ti-edit"></i></a>
                            </div>
                        </div>
                        <div class="hidden " id="applicants" role="tabpanel">
                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center">
                                    <a href="#"
                                        class="size-[42px] flex items-center justify-center overflow-hidden shrink-0">
                                        <img src="assets/img/users/user-09.jpg" class="rounded-full" alt="img">
                                    </a>
                                    <div class="ms-2 overflow-hidden">
                                        <p class="text-title font-medium truncate mb-0"><a href="#">Brian
                                                Villalobos</a></p>
                                        <span class="text-[13px] inline-flex items-center">Exp : 5+ Years<i
                                                class="ti ti-circle-filled text-[4px] mx-2 text-primary"></i>USA</span>
                                    </div>
                                </div>
                                <span
                                    class="bg-secondary text-white text-[10px] font-medium px-[5px] leading-4 rounded">UI/UX
                                    Designer</span>
                            </div>
                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center">
                                    <a href="#"
                                        class="size-[42px] flex items-center justify-center overflow-hidden shrink-0">
                                        <img src="assets/img/users/user-32.jpg" class="rounded-full" alt="img">
                                    </a>
                                    <div class="ms-2 overflow-hidden">
                                        <p class="text-title font-medium truncate mb-0"><a href="#">Anthony
                                                Lewis</a></p>
                                        <span class="text-[13px] inline-flex items-center">Exp : 4+ Years<i
                                                class="ti ti-circle-filled text-[4px] mx-2 text-primary"></i>USA</span>
                                    </div>
                                </div>
                                <span
                                    class="bg-info text-white text-[10px] font-medium px-[5px] leading-4 rounded">Python
                                    Developer</span>
                            </div>
                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center">
                                    <a href="#"
                                        class="size-[42px] flex items-center justify-center overflow-hidden shrink-0">
                                        <img src="assets/img/users/user-32.jpg" class="rounded-full" alt="img">
                                    </a>
                                    <div class="ms-2 overflow-hidden">
                                        <p class="text-title font-medium truncate mb-0"><a href="#">Stephan
                                                Peralt</a></p>
                                        <span class="text-[13px] inline-flex items-center">Exp : 6+ Years<i
                                                class="ti ti-circle-filled text-[4px] mx-2 text-primary"></i>USA</span>
                                    </div>
                                </div>
                                <span
                                    class="bg-pink text-white text-[10px] font-medium px-[5px] leading-4 rounded">Android
                                    Developer</span>
                            </div>
                            <div class="flex items-center justify-between mb-0">
                                <div class="flex items-center">
                                    <a href="javascript:void(0);"
                                        class="size-[42px] flex items-center justify-center overflow-hidden shrink-0">
                                        <img src="assets/img/users/user-34.jpg" class="rounded-full" alt="img">
                                    </a>
                                    <div class="ms-2 overflow-hidden">
                                        <p class="text-title font-medium truncate mb-0"><a
                                                href="javascript:void(0);">Doglas Martini</a></p>
                                        <span class="text-[13px] inline-flex items-center">Exp : 2+ Years<i
                                                class="ti ti-circle-filled text-[4px] mx-2 text-primary"></i>USA</span>
                                    </div>
                                </div>
                                <span
                                    class="bg-purple text-white text-[10px] font-medium px-[5px] leading-4 rounded">React
                                    Developer</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Jobs Applicants -->

        <!-- Employees -->
        <div class="xxl:col-span-4 xl:col-span-6 flex">
            <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white w-full overflow-x-auto">
                <div class="card-header pt-4 px-5 pb-2 flex items-center justify-between flex-wrap">
                    <h5 class="mb-2">Employees</h5>
                    <a href="employees.html"
                        class="btn bg-light border border-light text-gray-900 text-center py-1.5 px-3.5 hover:bg-light-900 hover:text-gray-900 text-[13px] leading-normal mb-2">View
                        All</a>
                </div>
                <div class="card-body p-0">
                    <div class="overflow-x-auto">
                        <table class="table w-full text-default mb-0">
                            <thead>
                                <tr>
                                    <th
                                        class="font-semibold text-left py-2 px-5 bg-light-900 text-gray-900 border-b border-borderColor">
                                        Name</th>
                                    <th
                                        class="font-semibold text-left py-2 px-5 bg-light-900 text-gray-900 border-b border-borderColor">
                                        Department</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b border-borderColor">
                                    <td class="py-2 px-5">
                                        <div class="flex items-center">
                                            <a href="javascript:void(0);"
                                                class="size-[42px] flex items-center justify-center rounded-full">
                                                <img src="assets/img/users/user-32.jpg" class="rounded-full"
                                                    alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="font-medium"><a href="javascript:void(0);">Anthony
                                                        Lewis</a></h6>
                                                <span class="text-xs leading-normal">Finance</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-2 px-5">
                                        <span
                                            class="inline-block bg-secondary-transparent text-secondary text-[10px] font-medium px-[5px] leading-4 rounded">
                                            Finance
                                        </span>
                                    </td>
                                </tr>
                                <tr class="border-b border-borderColor">
                                    <td class="py-2 px-5">
                                        <div class="flex items-center">
                                            <a href="#"
                                                class="size-[42px] flex items-center justify-center rounded-full">
                                                <img src="assets/img/users/user-09.jpg" class="rounded-full"
                                                    alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="font-medium"><a href="#">Brian Villalobos</a></h6>
                                                <span class="text-xs leading-normal">PHP Developer</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-2 px-5">
                                        <span
                                            class="inline-block bg-danger-transparent text-danger text-[10px] font-medium px-[5px] leading-4 rounded">Development</span>
                                    </td>
                                </tr>
                                <tr class="border-b border-borderColor">
                                    <td class="py-2 px-5">
                                        <div class="flex items-center">
                                            <a href="#"
                                                class="size-[42px] flex items-center justify-center rounded-full">
                                                <img src="assets/img/users/user-01.jpg" class="rounded-full"
                                                    alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="font-medium"><a href="#">Stephan Peralt</a></h6>
                                                <span class="text-xs leading-normal">Executive</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-2 px-5">
                                        <span
                                            class="inline-block bg-info-transparent text-info text-[10px] font-medium px-[5px] leading-4 rounded">Marketing</span>
                                    </td>
                                </tr>
                                <tr class="border-b border-borderColor">
                                    <td class="py-2 px-5">
                                        <div class="flex items-center">
                                            <a href="javascript:void(0);"
                                                class="size-[42px] flex items-center justify-center rounded-full">
                                                <img src="assets/img/users/user-34.jpg" class="rounded-full"
                                                    alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="font-medium"><a href="javascript:void(0);">Doglas
                                                        Martini</a></h6>
                                                <span class="text-xs leading-normal">Project Manager</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-2 px-5">
                                        <span
                                            class="inline-block bg-purple-transparent text-purple text-[10px] font-medium px-[5px] leading-4 rounded">Manager</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-5">
                                        <div class="flex items-center">
                                            <a href="javascript:void(0);"
                                                class="size-[42px] flex items-center justify-center rounded-full">
                                                <img src="assets/img/users/user-37.jpg" class="rounded-full"
                                                    alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="font-medium"><a href="javascript:void(0);">Anthony
                                                        Lewis</a></h6>
                                                <span class="text-xs leading-normal">UI/UX Designer</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-2 px-5">
                                        <span
                                            class="inline-block bg-pink-transparent text-pink text-[10px] font-medium px-[5px] leading-4 rounded">UI/UX
                                            Design</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Employees -->

        <!-- Todo -->
        <div class="xxl:col-span-4 xl:col-span-6 flex">
            <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white w-full">
                <div
                    class="card-header pt-4 px-5 pb-2 flex items-center justify-between flex-wrap border-b border-borderColor">
                    <h5 class="mb-2">Todo</h5>
                    <div class="flex items-center">
                        <div class="me-2 mb-2">
                            <a href="javascript:void(0);"
                                class="border rounded py-1 px-2 text-xs font-medium bg-white inline-flex items-center focus:bg-primary focus:border-primary focus:text-white text-gray-900"
                                data-dropdown-toggle="todo-dropdown">
                                <i class="ti ti-calendar me-1"></i>Today
                            </a>
                            <ul id="todo-dropdown" class="hidden p-4 border rounded bg-white shadow-lg w-40 z-[1]">
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
                                        class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary text-gray-900">Today</a>
                                </li>
                            </ul>
                        </div>
                        <a href="#"
                            class="size-6 bg-primary text-white rounded-full flex items-center justify-center hover:bg-primary-900 hover:text-white p-0 mb-2"
                            data-modal-toggle="add_todo" data-modal-target="add_todo"><i
                                class="ti ti-plus fs-16"></i></a>
                    </div>
                </div>
                <div class="card-body p-5">
                    <div class="flex items-center todo-item border p-2 rounded-defaultradius mb-2">
                        <i class="ti ti-grid-dots me-2"></i>
                        <div class="flex items-center">
                            <input class="size-4 bg-white border border-borderColor rounded text-primary focus:ring-0"
                                type="checkbox" id="todo1">
                            <label class="text-gray-900 font-medium ms-2" for="todo1">Add Holidays</label>
                        </div>
                    </div>
                    <div class="flex items-center todo-item border p-2 rounded-defaultradius mb-2">
                        <i class="ti ti-grid-dots me-2"></i>
                        <div class="flex items-center">
                            <input class="size-4 bg-white border border-borderColor rounded text-primary focus:ring-0"
                                type="checkbox" id="todo1">
                            <label class="text-gray-900 font-medium ms-2" for="todo12">Add Meeting to Client</label>
                        </div>
                    </div>
                    <div class="flex items-center todo-item border p-2 rounded-defaultradius mb-2">
                        <i class="ti ti-grid-dots me-2"></i>
                        <div class="flex items-center">
                            <input class="size-4 bg-white border border-borderColor rounded text-primary focus:ring-0"
                                type="checkbox" id="todo3">
                            <label class="text-gray-900 font-medium ms-2" for="todo3">Chat with Adrian</label>
                        </div>
                    </div>
                    <div class="flex items-center todo-item border p-2 rounded-defaultradius mb-2">
                        <i class="ti ti-grid-dots me-2"></i>
                        <div class="flex items-center">
                            <input class="size-4 bg-white border border-borderColor rounded text-primary focus:ring-0"
                                type="checkbox" id="todo4">
                            <label class="text-gray-900 font-medium ms-2" for="todo4">Management Call</label>
                        </div>
                    </div>
                    <div class="flex items-center todo-item border p-2 rounded-defaultradius mb-2">
                        <i class="ti ti-grid-dots me-2"></i>
                        <div class="flex items-center">
                            <input class="size-4 bg-white border border-borderColor rounded text-primary focus:ring-0"
                                type="checkbox" id="todo5">
                            <label class="text-gray-900 font-medium ms-2" for="todo5">Add Payroll</label>
                        </div>
                    </div>
                    <div class="flex items-center todo-item border p-2 rounded-defaultradius mb-0">
                        <i class="ti ti-grid-dots me-2"></i>
                        <div class="flex items-center">
                            <input class="size-4 bg-white border border-borderColor rounded text-primary focus:ring-0"
                                type="checkbox" id="todo6">
                            <label class="text-gray-900 font-medium ms-2" for="todo6">Add Policy for
                                Increment</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Todo -->

    </div>

    <div class="grid grid-cols-1 xl:grid-cols-12 gap-6 mb-6">

        <!-- Sales Overview -->
        <div class="xl:col-span-7 flex">
            <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white w-full">
                <div
                    class="card-header pt-4 px-5 pb-2 flex items-center justify-between flex-wrap border-b border-borderColorr">
                    <h5 class="mb-2">Sales Overview</h5>
                    <div class="flex items-center">
                        <div class="mb-2">
                            <a href="javascript:void(0);"
                                class="border rounded py-1 px-2 text-xs font-medium bg-white inline-flex items-center focus:bg-primary focus:border-primary focus:text-white text-gray-900"
                                data-dropdown-toggle="sale-dropdown">
                                All Departments
                            </a>
                            <ul id="sale-dropdown" class="hidden p-4 border rounded bg-white shadow-lg w-40 z-[1]">
                                <li>
                                    <a href="javascript:void(0);"
                                        class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary text-gray-900">UI/UX
                                        Designer</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);"
                                        class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary text-gray-900">HR
                                        Manager</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);"
                                        class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary text-gray-900">Junior
                                        Tester</a>
                                </li>
                            </ul>
                        </div>
                    </div>
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

        <!-- Invoices -->
        <div class="xl:col-span-5 flex">
            <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white w-full overflow-x-auto">
                <div
                    class="card-header pt-4 px-5 pb-2 flex items-center justify-between flex-wrap border-b border-borderColor">
                    <h5 class="mb-2">Invoices</h5>
                    <div class="flex items-center">
                        <div class="me-2 mb-2">
                            <a href="javascript:void(0);"
                                class="border-0 rounded py-1 px-2 bg-white inline-flex items-center focus:bg-primary focus:text-white text-gray-900"
                                data-dropdown-toggle="invoice-dropdown">
                                Invoices<i class="ti ti-chevron-down ml-1"></i>
                            </a>
                            <ul id="invoice-dropdown" class="hidden p-4 border rounded bg-white shadow-lg w-40 z-[1]">
                                <li>
                                    <a href="javascript:void(0);"
                                        class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary text-gray-900">Invoices</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);"
                                        class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary text-gray-900">Paid</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);"
                                        class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary text-gray-900">Unpaid</a>
                                </li>
                            </ul>
                        </div>
                        <div class="mb-2">
                            <a href="javascript:void(0);"
                                class="border rounded py-1 px-2 text-xs font-medium bg-white inline-flex items-center focus:bg-primary focus:border-primary focus:text-white text-gray-900"
                                data-dropdown-toggle="invoiceday-dropdown">
                                <i class="ti ti-calendar me-1"></i>This Week
                            </a>
                            <ul id="invoiceday-dropdown"
                                class="hidden p-4 border rounded bg-white shadow-lg w-40 z-[1]">
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
                                        class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary text-gray-900">Today</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body p-5 pt-2">
                    <div class="overflow-x-auto pt-1">
                        <table class="table w-full mb-0">
                            <tbody>
                                <tr>
                                    <td class="py-2 px-0 text-default">
                                        <div class="flex items-center">
                                            <a href="invoice-details.html"
                                                class="size-[42px] flex items-center justify-center rounded-full">
                                                <img src="assets/img/users/user-39.jpg" class="rounded-full"
                                                    alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="font-medium"><a href="invoice-details.html">Redesign
                                                        Website</a></h6>
                                                <span class="text-[13px] inline-flex items-center">#INVOO2<i
                                                        class="ti ti-circle-filled text-[4px] mx-1 text-primary"></i>Logistics</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-2 px-5 text-default">
                                        <p class="text-[13px] mb-1">Payment</p>
                                        <h6 class="font-medium">$3560</h6>
                                    </td>
                                    <td class="py-2 px-0 text-end text-default">
                                        <span
                                            class="bg-danger-transparent text-danger text-[10px] font-medium px-[5px] leading-4 rounded inline-flex items-center"><i
                                                class="ti ti-circle-filled text-[5px] me-1"></i>Unpaid</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-0 text-default">
                                        <div class="flex items-center">
                                            <a href="invoice-details.html"
                                                class="size-[42px] flex items-center justify-center rounded-full">
                                                <img src="assets/img/users/user-40.jpg" class="rounded-full"
                                                    alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="font-medium"><a href="invoice-details.html">Module
                                                        Completion</a></h6>
                                                <span class="text-[13px] inline-flex items-center">#INVOO5<i
                                                        class="ti ti-circle-filled text-[4px] mx-1 text-primary"></i>Yip
                                                    Corp</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-2 px-5 text-default">
                                        <p class="text-[13px] mb-1">Payment</p>
                                        <h6 class="font-medium">$4175</h6>
                                    </td>
                                    <td class="py-2 px-0 text-end text-default">
                                        <span
                                            class="bg-danger-transparent text-danger text-[10px] font-medium px-[5px] leading-4 rounded inline-flex items-center"><i
                                                class="ti ti-circle-filled text-[5px] me-1"></i>Unpaid</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-0 text-default">
                                        <div class="flex items-center">
                                            <a href="invoice-details.html"
                                                class="size-[42px] flex items-center justify-center rounded-full">
                                                <img src="assets/img/users/user-55.jpg" class="rounded-full"
                                                    alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="font-medium"><a href="invoice-details.html">Change on Emp
                                                        Module</a></h6>
                                                <span class="text-[13px] inline-flex items-center">#INVOO3<i
                                                        class="ti ti-circle-filled text-[4px] mx-1 text-primary"></i>Ignis
                                                    LLP</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-2 px-5 text-default">
                                        <p class="text-[13px] mb-1">Payment</p>
                                        <h6 class="font-medium">$6985</h6>
                                    </td>
                                    <td class="py-2 px-0 text-end text-default">
                                        <span
                                            class="bg-danger-transparent text-danger text-[10px] font-medium px-[5px] leading-4 rounded inline-flex items-center"><i
                                                class="ti ti-circle-filled text-[5px] me-1"></i>Unpaid</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-0 text-default">
                                        <div class="flex items-center">
                                            <a href="invoice-details.html"
                                                class="size-[42px] flex items-center justify-center rounded-full">
                                                <img src="assets/img/users/user-42.jpg" class="rounded-full"
                                                    alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="font-medium"><a href="invoice-details.html">Changes on the
                                                        Board</a></h6>
                                                <span class="text-[13px] inline-flex items-center">#INVOO2<i
                                                        class="ti ti-circle-filled text-[4px] mx-1 text-primary"></i>Ignis
                                                    LLP</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-2 px-5 text-default">
                                        <p class="text-[13px] mb-1">Payment</p>
                                        <h6 class="font-medium">$1457</h6>
                                    </td>
                                    <td class="px-0 text-end text-default">
                                        <span
                                            class="bg-danger-transparent text-danger text-[10px] font-medium px-[5px] leading-4 rounded inline-flex items-center"><i
                                                class="ti ti-circle-filled text-[5px] me-1"></i>Unpaid</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-0 text-default">
                                        <div class="flex items-center">
                                            <a href="invoice-details.html"
                                                class="size-[42px] flex items-center justify-center rounded-full">
                                                <img src="assets/img/users/user-44.jpg" class="rounded-full"
                                                    alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="font-medium"><a href="invoice-details.html">Hospital
                                                        Management</a></h6>
                                                <span class="text-[13px] inline-flex items-center">#INVOO6<i
                                                        class="ti ti-circle-filled text-[4px] mx-1 text-primary"></i>HCL
                                                    Corp</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-2 px-5 text-default">
                                        <p class="text-[13px] mb-1">Payment</p>
                                        <h6 class="font-medium">$6458</h6>
                                    </td>
                                    <td class="px-0 text-end text-default">
                                        <span
                                            class="bg-success-transparent text-success text-[10px] font-medium px-[5px] leading-4 rounded inline-flex items-center"><i
                                                class="ti ti-circle-filled text-[5px] me-1"></i>Paid</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <a href="invoice.html"
                        class="btn bg-light border border-light text-gray-900 text-center py-1.5 px-3.5 hover:bg-light-900 hover:text-gray-900 text-[13px] leading-normal w-full mt-2">View
                        All</a>
                </div>
            </div>
        </div>
        <!-- /Invoices -->

    </div>

    <div class="grid grid-cols-1 xl:grid-cols-12 gap-6 mb-6">

        <!-- Projects -->
        <div class="xl:col-span-7 flex">
            <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white w-full overflow-x-auto">
                <div
                    class="card-header pt-4 px-5 pb-2 flex items-center justify-between flex-wrap border-b border-borderColor">
                    <h5 class="mb-2">Projects</h5>
                    <div class="flex items-center">
                        <div class="mb-2">
                            <a href="javascript:void(0);"
                                class="border rounded py-1 px-2 text-xs font-medium bg-white inline-flex items-center focus:bg-primary focus:border-primary focus:text-white text-gray-900"
                                data-dropdown-toggle="pro-dropdown">
                                <i class="ti ti-calendar me-1"></i>This Week
                            </a>
                            <ul id="pro-dropdown" class="hidden p-4 border rounded bg-white shadow-lg w-40 z-[1]">
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
                                        class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary text-gray-900">Today</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="overflow-x-auto">
                        <table class="table w-full text-default bg-white mb-0">
                            <thead class="bg-light-900 text-gray-900 text-left">
                                <tr>
                                    <th class="font-semibold py-2 px-5">ID</th>
                                    <th class="font-semibold py-2 px-5">Name</th>
                                    <th class="font-semibold py-2 px-5">Team</th>
                                    <th class="font-semibold py-2 px-5">Hours</th>
                                    <th class="font-semibold py-2 px-5">Deadline</th>
                                    <th class="font-semibold py-2 px-5">Priority</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b border-borderColor">
                                    <td class="py-2 px-5 text-nowrap"><a href="project-details.html"
                                            class="text-default hover:text-primary">PRO-001</a></td>
                                    <td class="py-2 px-5 text-nowrap">
                                        <h6 class="font-medium"><a href="project-details.html">Office Management
                                                App</a></h6>
                                    </td>
                                    <td class="py-2 px-5 text-nowrap">
                                        <div class="flex -space-x-2 rtl:space-x-reverse">
                                            <img class="size-6 border border-white rounded-full hover:-translate-y-[0.188rem] hover:z-[1] transition-transform duration-150 ease-in-out"
                                                src="assets/img/profiles/avatar-02.jpg" alt="img">
                                            <img class="size-6 border border-white rounded-full hover:-translate-y-[0.188rem] hover:z-[1] transition-transform duration-150 ease-in-out"
                                                src="assets/img/profiles/avatar-03.jpg" alt="img">
                                            <img class="size-6 border border-white rounded-full hover:-translate-y-[0.188rem] hover:z-[1] transition-transform duration-150 ease-in-out"
                                                src="assets/img/profiles/avatar-05.jpg" alt="img">
                                        </div>
                                    </td>
                                    <td class="py-2 px-5 text-nowrap">
                                        <p class="mb-1">15/255 Hrs</p>
                                        <div class="progress progress-xs w-full" role="progressbar"
                                            aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar bg-primary" style="width: 40%"></div>
                                        </div>
                                    </td>
                                    <td class="py-2 px-5 text-nowrap">12/09/2024</td>
                                    <td class="py-2 px-5 text-nowrap">
                                        <span
                                            class="bg-danger text-white inline-flex items-center text-[10px] font-medium px-[5px] leading-4 rounded">
                                            <i class="ti ti-point-filled me-1"></i>High
                                        </span>
                                    </td>
                                </tr>
                                <tr class="border-b border-borderColor">
                                    <td class="py-2 px-5 text-nowrap"><a href="project-details.html"
                                            class="text-default hover:text-primary">PRO-002</a></td>
                                    <td class="py-2 px-5 text-nowrap">
                                        <h6 class="font-medium"><a href="project-details.html">Clinic Management </a>
                                        </h6>
                                    </td>
                                    <td class="py-2 px-5 text-nowrap">
                                        <div class="flex -space-x-2 rtl:space-x-reverse">
                                            <img class="size-6 border border-white rounded-full hover:-translate-y-[0.188rem] hover:z-[1] transition-transform duration-150 ease-in-out"
                                                src="assets/img/profiles/avatar-06.jpg" alt="img">
                                            <img class="size-6 border border-white rounded-full hover:-translate-y-[0.188rem] hover:z-[1] transition-transform duration-150 ease-in-out"
                                                src="assets/img/profiles/avatar-07.jpg" alt="img">
                                            <img class="size-6 border border-white rounded-full hover:-translate-y-[0.188rem] hover:z-[1] transition-transform duration-150 ease-in-out"
                                                src="assets/img/profiles/avatar-08.jpg" alt="img">
                                            <a class="size-6 bg-primary rounded-full text-white text-[10px] font-medium flex items-center justify-center hover:-translate-y-[0.188rem] hover:z-[1] transition-transform duration-150 ease-in-out shrink-0"
                                                href="javascript:void(0);">
                                                +1
                                            </a>
                                        </div>
                                    </td>
                                    <td class="py-2 px-5 text-nowrap">
                                        <p class="mb-1">15/255 Hrs</p>
                                        <div class="progress progress-xs w-full" role="progressbar"
                                            aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar bg-primary" style="width: 40%"></div>
                                        </div>
                                    </td>
                                    <td class="py-2 px-5 text-nowrap">24/10/2024</td>
                                    <td class="py-2 px-5 text-nowrap">
                                        <span
                                            class="bg-success text-white inline-flex items-center text-[10px] font-medium px-[5px] leading-4 rounded">
                                            <i class="ti ti-point-filled me-1"></i>Low
                                        </span>
                                    </td>
                                </tr>
                                <tr class="border-b border-borderColor">
                                    <td class="py-2 px-5 text-nowrap"><a href="project-details.html"
                                            class="text-default hover:text-primary">PRO-003</a></td>
                                    <td class="py-2 px-5 text-nowrap">
                                        <h6 class="font-medium"><a href="project-details.html">Educational
                                                Platform</a></h6>
                                    </td>
                                    <td class="py-2 px-5 text-nowrap">
                                        <div class="flex -space-x-2 rtl:space-x-reverse">
                                            <img class="size-6 border border-white rounded-full hover:-translate-y-[0.188rem] hover:z-[1] transition-transform duration-150 ease-in-out"
                                                src="assets/img/profiles/avatar-06.jpg" alt="img">
                                            <img class="size-6 border border-white rounded-full hover:-translate-y-[0.188rem] hover:z-[1] transition-transform duration-150 ease-in-out"
                                                src="assets/img/profiles/avatar-08.jpg" alt="img">
                                            <img class="size-6 border border-white rounded-full hover:-translate-y-[0.188rem] hover:z-[1] transition-transform duration-150 ease-in-out"
                                                src="assets/img/profiles/avatar-09.jpg" alt="img">
                                        </div>
                                    </td>
                                    <td class="py-2 px-5 text-nowrap">
                                        <p class="mb-1">40/255 Hrs</p>
                                        <div class="progress progress-xs w-full" role="progressbar"
                                            aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar bg-primary" style="width: 50%"></div>
                                        </div>
                                    </td>
                                    <td class="py-2 px-5 text-nowrap">18/02/2024</td>
                                    <td class="py-2 px-5 text-nowrap">
                                        <span
                                            class="bg-pink text-white inline-flex items-center text-[10px] font-medium px-[5px] leading-4 rounded">
                                            <i class="ti ti-point-filled me-1"></i>Medium
                                        </span>
                                    </td>
                                </tr>
                                <tr class="border-b border-borderColor">
                                    <td class="py-2 px-5 text-nowrap"><a href="project-details.html"
                                            class="text-default hover:text-primary">PRO-004</a></td>
                                    <td class="py-2 px-5 text-nowrap">
                                        <h6 class="font-medium"><a href="project-details.html">Chat & Call Mobile
                                                App</a></h6>
                                    </td>
                                    <td class="py-2 px-5 text-nowrap">
                                        <div class="flex -space-x-2 rtl:space-x-reverse">
                                            <img class="size-6 border border-white rounded-full hover:-translate-y-[0.188rem] hover:z-[1] transition-transform duration-150 ease-in-out"
                                                src="assets/img/profiles/avatar-11.jpg" alt="img">
                                            <img class="size-6 border border-white rounded-full hover:-translate-y-[0.188rem] hover:z-[1] transition-transform duration-150 ease-in-out"
                                                src="assets/img/profiles/avatar-12.jpg" alt="img">
                                            <img class="size-6 border border-white rounded-full hover:-translate-y-[0.188rem] hover:z-[1] transition-transform duration-150 ease-in-out"
                                                src="assets/img/profiles/avatar-13.jpg" alt="img">
                                        </div>
                                    </td>
                                    <td class="py-2 px-5 text-nowrap">
                                        <p class="mb-1">35/155 Hrs</p>
                                        <div class="progress progress-xs w-full" role="progressbar"
                                            aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar bg-primary" style="width: 50%"></div>
                                        </div>
                                    </td>
                                    <td class="py-2 px-5 text-nowrap">19/02/2024</td>
                                    <td class="py-2 px-5 text-nowrap">
                                        <span
                                            class="bg-danger text-white inline-flex items-center text-[10px] font-medium px-[5px] leading-4 rounded">
                                            <i class="ti ti-point-filled me-1"></i>High
                                        </span>
                                    </td>
                                </tr>
                                <tr class="border-b border-borderColor">
                                    <td class="py-2 px-5 text-nowrap"><a href="project-details.html"
                                            class="text-default hover:text-primary">PRO-005</a></td>
                                    <td class="py-2 px-5 text-nowrap">
                                        <h6 class="font-medium"><a href="project-details.html">Travel Planning
                                                Website</a></h6>
                                    </td>
                                    <td class="py-2 px-5 text-nowrap">
                                        <div class="flex -space-x-2 rtl:space-x-reverse">
                                            <img class="size-6 border border-white rounded-full hover:-translate-y-[0.188rem] hover:z-[1] transition-transform duration-150 ease-in-out"
                                                src="assets/img/profiles/avatar-17.jpg" alt="img">
                                            <img class="size-6 border border-white rounded-full hover:-translate-y-[0.188rem] hover:z-[1] transition-transform duration-150 ease-in-out"
                                                src="assets/img/profiles/avatar-18.jpg" alt="img">
                                            <img class="size-6 border border-white rounded-full hover:-translate-y-[0.188rem] hover:z-[1] transition-transform duration-150 ease-in-out"
                                                src="assets/img/profiles/avatar-19.jpg" alt="img">
                                        </div>
                                    </td>
                                    <td class="py-2 px-5 text-nowrap">
                                        <p class="mb-1">50/235 Hrs</p>
                                        <div class="progress progress-xs w-full" role="progressbar"
                                            aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar bg-primary" style="width: 50%"></div>
                                        </div>
                                    </td>
                                    <td class="py-2 px-5 text-nowrap">18/02/2024</td>
                                    <td class="py-2 px-5 text-nowrap">
                                        <span
                                            class="bg-pink text-white inline-flex items-center text-[10px] font-medium px-[5px] leading-4 rounded">
                                            <i class="ti ti-point-filled me-1"></i>Medium
                                        </span>
                                    </td>
                                </tr>
                                <tr class="border-b border-borderColor">
                                    <td class="py-2 px-5 text-nowrap"><a href="project-details.html"
                                            class="text-default hover:text-primary">PRO-006</a></td>
                                    <td class="py-2 px-5 text-nowrap">
                                        <h6 class="font-medium"><a href="project-details.html">Service Booking
                                                Software</a></h6>
                                    </td>
                                    <td class="py-2 px-5 text-nowrap">
                                        <div class="flex -space-x-2 rtl:space-x-reverse">
                                            <img class="size-6 border border-white rounded-full hover:-translate-y-[0.188rem] hover:z-[1] transition-transform duration-150 ease-in-out"
                                                src="assets/img/profiles/avatar-06.jpg" alt="img">
                                            <img class="size-6 border border-white rounded-full hover:-translate-y-[0.188rem] hover:z-[1] transition-transform duration-150 ease-in-out"
                                                src="assets/img/profiles/avatar-08.jpg" alt="img">
                                            <img class="size-6 border border-white rounded-full hover:-translate-y-[0.188rem] hover:z-[1] transition-transform duration-150 ease-in-out"
                                                src="assets/img/profiles/avatar-09.jpg" alt="img">
                                        </div>
                                    </td>
                                    <td class="py-2 px-5 text-nowrap">
                                        <p class="mb-1">40/255 Hrs</p>
                                        <div class="progress progress-xs w-full" role="progressbar"
                                            aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar bg-primary" style="width: 50%"></div>
                                        </div>
                                    </td>
                                    <td class="py-2 px-5 text-nowrap">20/02/2024</td>
                                    <td class="py-2 px-5 text-nowrap">
                                        <span
                                            class="bg-success text-white inline-flex items-center text-[10px] font-medium px-[5px] leading-4 rounded">
                                            <i class="ti ti-point-filled me-1"></i>Low
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 px-5 text-nowrap"><a href="project-details.html"
                                            class="text-default hover:text-primary">PRO-008</a></td>
                                    <td class="py-2 px-5 text-nowrap">
                                        <h6 class="font-medium"><a href="project-details.html">Travel Planning
                                                Website</a></h6>
                                    </td>
                                    <td class="py-2 px-5 text-nowrap">
                                        <div class="flex -space-x-2 rtl:space-x-reverse">
                                            <img class="size-6 border border-white rounded-full hover:-translate-y-[0.188rem] hover:z-[1] transition-transform duration-150 ease-in-out"
                                                src="assets/img/profiles/avatar-15.jpg" alt="img">
                                            <img class="size-6 border border-white rounded-full hover:-translate-y-[0.188rem] hover:z-[1] transition-transform duration-150 ease-in-out"
                                                src="assets/img/profiles/avatar-16.jpg" alt="img">
                                            <img class="size-6 border border-white rounded-full hover:-translate-y-[0.188rem] hover:z-[1] transition-transform duration-150 ease-in-out"
                                                src="assets/img/profiles/avatar-17.jpg" alt="img">
                                            <a class="size-6 bg-primary rounded-full text-white text-[10px] font-medium flex items-center justify-center hover:-translate-y-[0.188rem] hover:z-[1] transition-transform duration-150 ease-in-out shrink-0"
                                                href="javascript:void(0);">
                                                +2
                                            </a>
                                        </div>
                                    </td>
                                    <td class="py-2 px-5 text-nowrap">
                                        <p class="mb-1">15/255 Hrs</p>
                                        <div class="progress progress-xs w-full" role="progressbar"
                                            aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar bg-primary" style="width: 45%"></div>
                                        </div>
                                    </td>
                                    <td class="py-2 px-5 text-nowrap">17/10/2024</td>
                                    <td class="py-2 px-5 text-nowrap">
                                        <span
                                            class="bg-pink text-white inline-flex items-center text-[10px] font-medium px-[5px] leading-4 rounded">
                                            <i class="ti ti-point-filled me-1"></i>Medium
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Projects -->

        <!-- Tasks Statistics -->
        <div class="xl:col-span-5 flex">
            <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white w-full">
                <div
                    class="card-header pt-4 px-5 pb-2 flex items-center justify-between flex-wrap border-b border-borderColor">
                    <h5 class="mb-2">Tasks Statistics</h5>
                    <div class="flex items-center">
                        <div class="mb-2">
                            <a href="javascript:void(0);"
                                class="border rounded py-1 px-2 text-xs font-medium bg-white inline-flex items-center focus:bg-primary focus:border-primary focus:text-white text-gray-900"
                                data-dropdown-toggle="task-dropdown">
                                <i class="ti ti-calendar me-1"></i>This Week
                            </a>
                            <ul id="task-dropdown" class="hidden p-4 border rounded bg-white shadow-lg w-40 z-[1]">
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
                                        class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary text-gray-900">Today</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body p-5">
                    <div class="chartjs-wrapper-demo relative mb-6">
                        <div class="w-full h-48">
                            <canvas id="mySemiDonutChart" class="w-full h-full"></canvas>
                        </div>
                        <div
                            class="absolute text-center top-1/2 left-1/2 -translate-x-1/2 transform attendance-canvas">
                            <p class="text-[13px] mb-1">Total Tasks</p>
                            <h3>124/165</h3>
                        </div>
                    </div>
                    <div class="flex items-center flex-wrap">
                        <div class="border-e border-borderColor text-center me-2 pe-2 mb-4">
                            <p class="text-[13px] inline-flex items-center mb-1"><i
                                    class="ti ti-circle-filled fs-10 me-1 text-warning"></i>Ongoing</p>
                            <h5>24%</h5>
                        </div>
                        <div class="border-e border-borderColor text-center me-2 pe-2 mb-4">
                            <p class="text-[13px] inline-flex items-center mb-1"><i
                                    class="ti ti-circle-filled fs-10 me-1 text-info"></i>On Hold </p>
                            <h5>10%</h5>
                        </div>
                        <div class="border-e border-borderColor text-center me-2 pe-2 mb-4">
                            <p class="text-[13px] inline-flex items-center mb-1"><i
                                    class="ti ti-circle-filled fs-10 me-1 text-danger"></i>Overdue</p>
                            <h5>16%</h5>
                        </div>
                        <div class="text-center me-2 pe-2 mb-4">
                            <p class="text-[13px] inline-flex items-center mb-1"><i
                                    class="ti ti-circle-filled fs-10 me-1 text-success"></i>Ongoing</p>
                            <h5>40%</h5>
                        </div>
                    </div>
                    <div class="bg-dark text-white rounded-defaultradius p-4 pb-0 flex items-center justify-between">
                        <div class="mb-2">
                            <h4 class="text-success">389/689 hrs</h4>
                            <p class="text-[13px] mb-0">Spent on Overall Tasks This Week</p>
                        </div>
                        <a href="tasks.html"
                            class="btn bg-light border border-light text-xs text-gray-900 text-center py-1 px-2 hover:bg-light-900 hover:text-gray-900 text-[13px] leading-normal mb-2 text-nowrap">View
                            All</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Tasks Statistics -->

    </div>

    <div class="grid grid-cols-1 xxl:grid-cols-12 xl:grid-cols-12 gap-6 mb-6">

        <!-- Schedules -->
        <div class="xxl:col-span-4 xl:col-span-12 flex">
            <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white w-full">
                <div
                    class="card-header pt-4 px-5 pb-2 flex items-center justify-between flex-wrap border-b border-borderColor">
                    <h5 class="mb-2">Schedules</h5>
                    <a href="candidates.html"
                        class="btn bg-light border border-light text-gray-900 text-center py-1.5 px-3.5 hover:bg-light-900 hover:text-gray-900 text-[13px] leading-normal mb-2">View
                        All</a>
                </div>
                <div class="card-body p-5">
                    <div class="bg-light p-4 rounded-defaultradius mb-6">
                        <span
                            class="bg-secondary text-white text-[10px] font-medium px-[5px] leading-4 inline-block rounded mb-1">UI/
                            UX Designer</span>
                        <h6 class="mb-2 truncate">Interview Candidates - UI/UX Designer</h6>
                        <div class="flex items-center flex-wrap">
                            <p class="text-[13px] mb-1 me-2"><i class="ti ti-calendar-event me-2"></i>Thu, 15 Feb
                                2025</p>
                            <p class="text-[13px] mb-1"><i class="ti ti-clock-hour-11 me-2"></i>01:00 PM - 02:20 PM
                            </p>
                        </div>
                        <div class="flex items-center justify-between border-t border-borderColor mt-2 pt-4">
                            <div class="flex -space-x-2 rtl:space-x-reverse">
                                <img class="size-6 border border-white rounded-full hover:-translate-y-[0.188rem] hover:z-[1] transition-transform duration-150 ease-in-out"
                                    src="assets/img/users/user-49.jpg" alt="img">
                                <img class="size-6 border border-white rounded-full hover:-translate-y-[0.188rem] hover:z-[1] transition-transform duration-150 ease-in-out"
                                    src="assets/img/users/user-13.jpg" alt="img">
                                <img class="size-6 border border-white rounded-full hover:-translate-y-[0.188rem] hover:z-[1] transition-transform duration-150 ease-in-out"
                                    src="assets/img/users/user-11.jpg" alt="img">
                                <img class="size-6 border border-white rounded-full hover:-translate-y-[0.188rem] hover:z-[1] transition-transform duration-150 ease-in-out"
                                    src="assets/img/users/user-22.jpg" alt="img">
                                <img class="size-6 border border-white rounded-full hover:-translate-y-[0.188rem] hover:z-[1] transition-transform duration-150 ease-in-out"
                                    src="assets/img/users/user-58.jpg" alt="img">
                                <a class="size-6 bg-primary rounded-full text-white text-[10px] font-medium flex items-center justify-center hover:-translate-y-[0.188rem] hover:z-[1] transition-transform duration-150 ease-in-out shrink-0"
                                    href="javascript:void(0);">
                                    +3
                                </a>
                            </div>
                            <a href="#"
                                class="btn bg-primary border border-primary text-white text-center py-1 px-2 hover:bg-primary-900 hover:text-white text-[10px] leading-normal">Join
                                Meeting</a>
                        </div>
                    </div>
                    <div class="bg-light p-4 rounded-defaultradius mb-0">
                        <span
                            class="bg-dark text-white text-[10px] font-medium px-[5px] leading-4 inline-block rounded mb-1">IOS
                            Developer</span>
                        <h6 class="mb-2 truncate">Interview Candidates - IOS Developer</h6>
                        <div class="flex items-center flex-wrap">
                            <p class="text-[13px] mb-1 me-2"><i class="ti ti-calendar-event me-2"></i>Thu, 15 Feb
                                2025</p>
                            <p class="text-[13px] mb-1"><i class="ti ti-clock-hour-11 me-2"></i>02:00 PM - 04:20 PM
                            </p>
                        </div>
                        <div class="flex items-center justify-between border-t border-borderColor mt-2 pt-4">
                            <div class="flex -space-x-2 rtl:space-x-reverse">
                                <img class="size-6 border border-white rounded-full hover:-translate-y-[0.188rem] hover:z-[1] transition-transform duration-150 ease-in-out"
                                    src="assets/img/users/user-49.jpg" alt="img">
                                <img class="size-6 border border-white rounded-full hover:-translate-y-[0.188rem] hover:z-[1] transition-transform duration-150 ease-in-out"
                                    src="assets/img/users/user-13.jpg" alt="img">
                                <img class="size-6 border border-white rounded-full hover:-translate-y-[0.188rem] hover:z-[1] transition-transform duration-150 ease-in-out"
                                    src="assets/img/users/user-11.jpg" alt="img">
                                <img class="size-6 border border-white rounded-full hover:-translate-y-[0.188rem] hover:z-[1] transition-transform duration-150 ease-in-out"
                                    src="assets/img/users/user-22.jpg" alt="img">
                                <img class="size-6 border border-white rounded-full hover:-translate-y-[0.188rem] hover:z-[1] transition-transform duration-150 ease-in-out"
                                    src="assets/img/users/user-58.jpg" alt="img">
                                <a class="size-6 bg-primary rounded-full text-white text-[10px] font-medium flex items-center justify-center hover:-translate-y-[0.188rem] hover:z-[1] transition-transform duration-150 ease-in-out shrink-0"
                                    href="javascript:void(0);">
                                    +3
                                </a>
                            </div>
                            <a href="#"
                                class="btn bg-primary border border-primary text-white text-center py-1 px-2 hover:bg-primary-900 hover:text-white text-[10px] leading-normal">Join
                                Meeting</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Schedules -->

        <!-- Recent Activities -->
        <div class="xxl:col-span-4 xl:col-span-6 flex">
            <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white w-full">
                <div
                    class="card-header pt-4 px-5 pb-2 flex items-center justify-between flex-wrap border-b border-borderColor">
                    <h5 class="mb-2">Recent Activities</h5>
                    <a href="activity.html"
                        class="btn bg-light border border-light text-gray-900 text-center py-1.5 px-3.5 hover:bg-light-900 hover:text-gray-900 text-[13px] leading-normal mb-2">View
                        All</a>
                </div>
                <div class="card-body p-5">
                    <div class="mb-5">
                        <div class="flex justify-between">
                            <div class="flex items-center w-full">
                                <a href="javscript:void(0);"
                                    class="size-[42px] flex items-center justify-center rounded-full shrink-0">
                                    <img src="assets/img/users/user-38.jpg" class="rounded-full" alt="img">
                                </a>
                                <div class="ms-2 flex-1">
                                    <div class="flex items-center justify-between">
                                        <h6 class="font-medium truncate"><a href="javscript:void(0);">Matt
                                                Morgan</a></h6>
                                        <p class="text-[13px]">05:30 PM</p>
                                    </div>
                                    <p class="text-[13px]">Added New Project <span class="text-primary">HRMS
                                            Dashboard</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-5">
                        <div class="flex justify-between">
                            <div class="flex items-center w-full">
                                <a href="javscript:void(0);"
                                    class="size-[42px] flex items-center justify-center rounded-full shrink-0">
                                    <img src="assets/img/users/user-01.jpg" class="rounded-full" alt="img">
                                </a>
                                <div class="ms-2 flex-1">
                                    <div class="flex items-center justify-between">
                                        <h6 class="font-medium truncate"><a href="javscript:void(0);">Jay Ze</a>
                                        </h6>
                                        <p class="text-[13px]">05:00 PM</p>
                                    </div>
                                    <p class="text-[13px]">Commented on Uploaded Document</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-5">
                        <div class="flex justify-between">
                            <div class="flex items-center w-full">
                                <a href="javscript:void(0);"
                                    class="size-[42px] flex items-center justify-center rounded-full shrink-0">
                                    <img src="assets/img/users/user-19.jpg" class="rounded-full" alt="img">
                                </a>
                                <div class="ms-2 flex-1">
                                    <div class="flex items-center justify-between">
                                        <h6 class="font-medium truncate"><a href="javscript:void(0);">Mary
                                                Donald</a></h6>
                                        <p class="text-[13px]">05:30 PM</p>
                                    </div>
                                    <p class="text-[13px]">Approved Task Projects</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-5">
                        <div class="flex justify-between">
                            <div class="flex items-center w-full">
                                <a href="javscript:void(0);"
                                    class="size-[42px] flex items-center justify-center rounded-full shrink-0">
                                    <img src="assets/img/users/user-11.jpg" class="rounded-full" alt="img">
                                </a>
                                <div class="ms-2 flex-1">
                                    <div class="flex items-center justify-between">
                                        <h6 class="font-medium truncate"><a href="javscript:void(0);">George
                                                David</a></h6>
                                        <p class="text-[13px]">06:00 PM</p>
                                    </div>
                                    <p class="text-[13px]">Requesting Access to Module Tickets</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-5">
                        <div class="flex justify-between">
                            <div class="flex items-center w-full">
                                <a href="javscript:void(0);"
                                    class="size-[42px] flex items-center justify-center rounded-full shrink-0">
                                    <img src="assets/img/users/user-20.jpg" class="rounded-full" alt="img">
                                </a>
                                <div class="ms-2 flex-1">
                                    <div class="flex items-center justify-between">
                                        <h6 class="font-medium truncate"><a href="javscript:void(0);">Aaron Zeen</a>
                                        </h6>
                                        <p class="text-[13px]">06:30 PM</p>
                                    </div>
                                    <p class="text-[13px]">Downloaded App Reportss</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-0">
                        <div class="flex justify-between">
                            <div class="flex items-center w-full">
                                <a href="javscript:void(0);"
                                    class="size-[42px] flex items-center justify-center rounded-full shrink-0">
                                    <img src="assets/img/users/user-08.jpg" class="rounded-full" alt="img">
                                </a>
                                <div class="ms-2 flex-1">
                                    <div class="flex items-center justify-between">
                                        <h6 class="font-medium truncate"><a href="javscript:void(0);">Hendry
                                                Daniel</a></h6>
                                        <p class="text-[13px]">05:30 PM</p>
                                    </div>
                                    <p class="text-[13px]">Completed New Project <span>HMS</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Recent Activities -->

        <!-- Birthdays -->
        <div class="xxl:col-span-4 xl:col-span-6 flex">
            <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white w-full">
                <div
                    class="card-header py-4 px-5 pb-2 flex items-center justify-between flex-wrap border-b border-borderColor">
                    <h5 class="mb-2">Birthdays</h5>
                    <a href="javascript:void(0);"
                        class="btn bg-light border border-light text-gray-900 text-center py-1.5 px-3.5 hover:bg-light-900 hover:text-gray-900 text-[13px] leading-normal mb-2">View
                        All</a>
                </div>
                <div class="card-body p-5 pb-1">
                    <h6 class="mb-2">Today</h6>
                    <div class="bg-light p-2 border border-borderColor border-dashed rounded-t mb-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <a href="javascript:void(0);"
                                    class="size-[42px] flex items-center justify-center rounded-full">
                                    <img src="assets/img/users/user-38.jpg" class="rounded-full" alt="img">
                                </a>
                                <div class="ms-2 overflow-hidden">
                                    <h6 class="font-medium ">Andrew Jermia</h6>
                                    <p class="text-[13px]">IOS Developer</p>
                                </div>
                            </div>
                            <a href="javascript:void(0);"
                                class="btn bg-secondary border border-secondary text-white text-center py-1 px-2 hover:bg-secondary-900 hover:text-white text-[10px] leading-normal"><i
                                    class="ti ti-cake me-1"></i>Send</a>
                        </div>
                    </div>
                    <h6 class="mb-2">Tomorow</h6>
                    <div class="bg-light p-2 border border-borderColor border-dashed rounded-t mb-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <a href="javascript:void(0);"
                                    class="size-[42px] flex items-center justify-center rounded-full">
                                    <img src="assets/img/users/user-10.jpg" class="rounded-full" alt="img">
                                </a>
                                <div class="ms-2 overflow-hidden">
                                    <h6 class="font-medium"><a href="javascript:void(0);">Mary Zeen</a></h6>
                                    <p class="text-[13px]">UI/UX Designer</p>
                                </div>
                            </div>
                            <a href="javascript:void(0);"
                                class="btn bg-secondary border border-secondary text-white text-center py-1 px-2 hover:bg-secondary-900 hover:text-white text-[10px] leading-normal"><i
                                    class="ti ti-cake me-1"></i>Send</a>
                        </div>
                    </div>
                    <div class="bg-light p-2 border border-borderColor border-dashed rounded-t mb-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <a href="javascript:void(0);"
                                    class="size-[42px] flex items-center justify-center rounded-full">
                                    <img src="assets/img/users/user-09.jpg" class="rounded-full" alt="img">
                                </a>
                                <div class="ms-2 overflow-hidden">
                                    <h6 class="font-medium "><a href="javascript:void(0);">Antony Lewis</a></h6>
                                    <p class="text-[13px]">Android Developer</p>
                                </div>
                            </div>
                            <a href="javascript:void(0);"
                                class="btn bg-secondary border border-secondary text-white text-center py-1 px-2 hover:bg-secondary-900 hover:text-white text-[10px] leading-normal"><i
                                    class="ti ti-cake me-1"></i>Send</a>
                        </div>
                    </div>
                    <h6 class="mb-2">25 Jan 2025</h6>
                    <div class="bg-light p-2 border border-borderColor border-dashed rounded-t mb-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <span class="size-[42px] flex items-center justify-center rounded-full">
                                    <img src="assets/img/users/user-12.jpg" class="rounded-full" alt="img">
                                </span>
                                <div class="ms-2 overflow-hidden">
                                    <h6 class="font-medium ">Doglas Martini</h6>
                                    <p class="text-[13px]">.Net Developer</p>
                                </div>
                            </div>
                            <a href="javascript:void(0);"
                                class="btn bg-secondary border border-secondary text-white text-center py-1 px-2 hover:bg-secondary-900 hover:text-white text-[10px] leading-normal"><i
                                    class="ti ti-cake me-1"></i>Send</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Birthdays -->

    </div>
</div>
