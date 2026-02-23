<div>

    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">Leaves</h2>
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
                    <li aria-current="page" class="text-xs text-gray-900">Leaves</li>
                </ol>
            </nav>
        </div>
        <div class="flex my-xl-auto right-content items-center flex-wrap ">
            <div class="me-2 mb-2">
                <div>
                    <a href="javascript:void(0);" class="border rounded p-2 bg-white inline-flex items-center"
                        data-dropdown-toggle="export-dropdown">
                        <i class="ti ti-file-export me-1"></i>Export<i class="ti ti-chevron-down ml-1"></i>
                    </a>
                    <ul id="export-dropdown" class="hidden p-4 border rounded bg-white shadow-lg">
                        <li>
                            <a href="javascript:void(0);"
                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary"><i
                                    class="ti ti-file-type-pdf me-1"></i>Export as PDF</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);"
                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary"><i
                                    class="ti ti-file-type-xls me-1"></i>Export as Excel </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="mb-2">
                <a href="#" data-modal-target="add_leaves" data-modal-toggle="add_leaves"
                    class="flex items-center bg-primary text-sm font-medium py-2 rounded text-white px-3 hover:bg-primary-900 hover:text-white"><i
                        class="ti ti-circle-plus me-2"></i>Add Leave</a>
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

    <!-- Leave List -->
    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white">
        <div
            class="card-header py-4 px-5 border-b border-borderColor flex items-center justify-between flex-wrap gap-3">
            <div class="flex">
                <h5 class="me-2">Leave List</h5>
                <span class=" bg-primary-100 py-0.5 px-1.5 rounded text-[10px] font-medium text-primary me-2">Total
                    Leaves : 48</span>
                <span class="bg-secondary-100 py-0.5 px-1.5 rounded text-[10px] font-medium text-secondary me-2">Total
                    Remaining Leaves : 23</span>
            </div>
            <div class="flex my-xl-auto right-content items-center flex-wrap gap-3">
                <div class="me-3">
                    <div class="relative">
                        <input type="text"
                            class="block flex-1 border border-borderColor bg-white rounded-[5px] py-1.5 pl-2.5 pr-8 text-gray-900 placeholder:text-gray-400 focus:ring-0 focus:border-borderColor h-[38px] text-sm date-range bookingrange"
                            placeholder="dd/mm/yyyy - dd/mm/yyyy">
                        <span class="absolute inset-y-1/2 end-0 flex items-center me-2.5 pointer-events-none">
                            <i class="ti ti-chevron-down"></i>
                        </span>
                    </div>
                </div>
                <div class="me-3">
                    <a href="javascript:void(0);"
                        class="border rounded p-2 bg-white inline-flex items-center focus:bg-primary focus:border-primary focus:text-white text-gray-900"
                        data-dropdown-toggle="leave_type-dropdown2">
                        Leave Type<i class="ti ti-chevron-down ml-1"></i>
                    </a>
                    <ul id="leave_type-dropdown2" class="hidden p-4 border rounded bg-white shadow-lg w-40 z-[1]">
                        <li>
                            <a href="javascript:void(0);"
                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">Medical
                                Leave</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);"
                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">Casual
                                Leave</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);"
                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">Annual
                                Leave</a>
                        </li>
                    </ul>
                </div>
                <div class="me-3">
                    <a href="javascript:void(0);"
                        class="border rounded p-2 bg-white inline-flex items-center focus:bg-primary focus:border-primary focus:text-white"
                        data-dropdown-toggle="leave_type-dropdown">
                        Approved By<i class="ti ti-chevron-down ml-1"></i>
                    </a>
                    <ul id="leave_type-dropdown" class="hidden p-4 border rounded bg-white shadow-lg w-40 z-[1]">
                        <li>
                            <a href="javascript:void(0);"
                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">Doglas
                                Martini</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);"
                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">Warren
                                Morales</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);"
                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">Doglas
                                Martini</a>
                        </li>
                    </ul>
                </div>
                <div class="me-3">
                    <a href="javascript:void(0);"
                        class="border rounded p-2 bg-white inline-flex items-center focus:bg-primary focus:border-primary focus:text-white"
                        data-dropdown-toggle="status-dropdown">
                        <span class="rounded-circle bg-transparent-success flex justify-center items-center me-2">
                            Select Status<i class="ti ti-chevron-down ml-1"></i>
                        </span></a>
                    <ul id="status-dropdown" class="hidden p-4 border rounded bg-white shadow-lg w-40 z-[1]">
                        <li>
                            <a href="javascript:void(0);"
                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary"><i
                                    class="ti ti-point-filled text-success me-2"></i>Approved</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);"
                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary"><i
                                    class="ti ti-point-filled text-danger me-2"></i>Declined</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);"
                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary"><i
                                    class="ti ti-point-filled text-purple me-2"></i>New</a>
                        </li>

                    </ul>
                </div>
                <div>
                    <a href="javascript:void(0);"
                        class="border rounded p-2 bg-white inline-flex items-center focus:bg-primary focus:border-primary focus:text-white text-gray-900"
                        data-dropdown-toggle="days-dropdown">
                        Sort By : Last 7 Days<i class="ti ti-chevron-down ml-1"></i>
                    </a>
                    <ul id="days-dropdown" class="hidden p-4 border rounded bg-white shadow-lg w-40 z-[1]">
                        <li>
                            <a href="javascript:void(0);"
                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">Recently
                                Added</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);"
                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">Ascending</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);"
                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">Desending</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);"
                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">Last
                                Month</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);"
                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">Last
                                7 Days</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="custom-datatable-filter">
                <table class="table datatable w-full border-b border-borderColor">
                    <thead class="thead-light">
                        <tr>
                            <th
                                class="no-sort text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor hover:outline-none">
                                <div class="flex items-center">
                                    <input
                                        class="size-4 bg-white border border-borderColor rounded text-primary focus:ring-0"
                                        type="checkbox" id="select-all">
                                </div>
                            </th>
                            <th
                                class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Leave Type </th>
                            <th
                                class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                From</th>
                            <th
                                class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Approved By </th>
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
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-borderColor">
                        <tr class="even:bg-white dark:even-bg-white">
                            <td class="px-5 py-2.5 text-gray-500">
                                <div class="flex items-center">
                                    <input
                                        class="size-4 bg-white border border-borderColor rounded text-primary focus:ring-0"
                                        type="checkbox">
                                </div>
                            </td>

                            <td class="px-5 py-2.5 text-gray-500 font-medium">
                                <p class="text-500 font-medium">Medical Leave
                                    <a href="#" data-tooltip-target="tooltip-right-01"
                                        data-tooltip-placement="right" class=""><i
                                            class="ti ti-info-circle text-info"></i></a>
                                <div id="tooltip-right-01" role="tooltip"
                                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                    I am currently experiencing <br> a fever and design & Development
                                    <div class="tooltip-arrow" data-popper-arrow=""></div>
                                </div>

                            </td>
                            <td class="px-5 py-2.5 text-gray-500">14/01/2024</td>
                            <td class="px-5 py-2.5 text-gray-500">
                                <div class="flex items-center file-name-icon">
                                    <a href="#" class="size-8 rounded-full border border-borderColor">
                                        <img src="assets/img/users/user-34.jpg" class="rounded-full size-8 img-fluid"
                                            alt="img">
                                    </a>
                                    <div class="ms-2">
                                        <h6 class="font-medium"><a href="#"
                                                class="text-gray-900 hover:text-primary">Doglas Martini</a>
                                        </h6>
                                        <span class="text-xs leading-normal">Manager</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-2.5 text-gray-500">15/01/2024</td>
                            <td class="px-5 py-2.5 text-gray-500">2 Days</td>
                            <td class="px-5 py-2.5 text-gray-500">
                                <div>
                                    <a href="javascript:void(0);"
                                        class="border rounded p-2 bg-white inline-flex items-center focus:bg-primary focus:border-primary focus:text-white text-gray-900"
                                        data-dropdown-toggle="designation-dropdown-01">
                                        <span
                                            class="rounded-full bg-transparent-success flex justify-center items-center me-2"><i
                                                class="ti ti-point-filled bg-success-100 rounded-full text-success me-1"></i>
                                            Approved<i class="ti ti-chevron-down ml-1"></i>
                                        </span></a>
                                    <ul id="designation-dropdown-01"
                                        class="hidden p-4 border rounded bg-white shadow-lg w-40 z-[1]">
                                        <li>
                                            <a href="javascript:void(0);"
                                                class="rounded p-2 flex items-center hover:bg-primary-100 hover:text-primary">Approved</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"
                                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">Declined</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"
                                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">New</a>
                                        </li>

                                    </ul>
                                </div>
                            </td>
                            <td class="px-5 py-2.5 text-gray-500">
                                <div class="action-icon inline-flex">
                                    <a href="#"
                                        class="me-2 size-[26px] flex items-center justify-center rounded-[5px] hover:bg-light-900 hover:text-gray-900"
                                        data-bs-toggle="modal" data-modal-target="edit_leaves"
                                        data-modal-toggle="edit_leaves"><i class="ti ti-edit"></i></a>
                                    <a href="#"
                                        class="size-[26px] flex items-center justify-center rounded-[5px] hover:bg-light-900 hover:text-gray-900"
                                        data-bs-toggle="modal" data-modal-target="delete_modal"
                                        data-modal-toggle="delete_modal"><i class="ti ti-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        <tr class="even:bg-white dark:even-bg-white">
                            <td class="px-5 py-2.5 text-gray-500 ">
                                <div class="flex items-center">
                                    <input
                                        class="size-4 bg-white border border-borderColor rounded text-primary focus:ring-0"
                                        type="checkbox">
                                </div>
                            </td>

                            <td class="px-5 py-2.5 text-gray-500 font-medium">
                                <p class="text-500 font-medium">Annual Leave
                                    <a href="#" data-tooltip-target="tooltip-right-02"
                                        data-tooltip-placement="right" class=""><i
                                            class="ti ti-info-circle text-info"></i></a>
                                <div id="tooltip-right-02" role="tooltip"
                                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                    I am currently experiencing <br> a fever and design & Development
                                    <div class="tooltip-arrow" data-popper-arrow=""></div>
                                </div>

                            </td>
                            <td class="px-5 py-2.5 text-gray-500">21/01/2024</td>
                            <td class="px-5 py-2.5 text-gray-500">
                                <div class="flex items-center file-name-icon">
                                    <a href="#" class="size-8 rounded-full border border-borderColor">
                                        <img src="assets/img/users/user-34.jpg" class="rounded-full size-8 img-fluid"
                                            alt="img">
                                    </a>
                                    <div class="ms-2">
                                        <h6 class="font-medium"><a href="#"
                                                class="text-gray-900 hover:text-primary">Doglas Martini</a>
                                        </h6>
                                        <span class="text-xs leading-normal">Manager</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-2.5 text-gray-500">25/01/2024</td>
                            <td class="px-5 py-2.5 text-gray-500">5 Days</td>
                            <td class="px-5 py-2.5 text-gray-500">
                                <div>
                                    <a href="javascript:void(0);"
                                        class="border rounded p-2 bg-white inline-flex items-center focus:bg-primary focus:border-primary focus:text-white text-gray-900"
                                        data-dropdown-toggle="designation-dropdown-02">
                                        <span
                                            class="rounded-circle bg-transparent-success flex justify-center items-center me-2"><i
                                                class="ti ti-point-filled text-success bg-success-100 rounded-full me-1"></i>
                                            Approved<i class="ti ti-chevron-down ml-1"></i>
                                        </span></a>
                                    <ul id="designation-dropdown-02"
                                        class="hidden p-4 border rounded bg-white shadow-lg w-40 z-[1]">
                                        <li>
                                            <a href="javascript:void(0);"
                                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">Approved</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"
                                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">Declined</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"
                                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">New</a>
                                        </li>

                                    </ul>
                                </div>
                            </td>
                            <td class="px-5 py-2.5 text-gray-500">
                                <div class="action-icon inline-flex">
                                    <a href="#"
                                        class="me-2 size-[26px] flex items-center justify-center rounded-[5px] hover:bg-light-900 hover:text-gray-900"
                                        data-bs-toggle="modal" data-modal-target="edit_leaves"
                                        data-modal-toggle="edit_leaves"><i class="ti ti-edit"></i></a>
                                    <a href="#"
                                        class="size-[26px] flex items-center justify-center rounded-[5px] hover:bg-light-900 hover:text-gray-900"
                                        data-bs-toggle="modal" data-modal-target="delete_modal"
                                        data-modal-toggle="delete_modal"><i class="ti ti-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        <tr class="even:bg-white dark:even-bg-white">
                            <td class="px-5 py-2.5 text-gray-500 ">
                                <div class="flex items-center">
                                    <input
                                        class="size-4 bg-white border border-borderColor rounded text-primary focus:ring-0"
                                        type="checkbox">
                                </div>
                            </td>

                            <td class="px-5 py-2.5 text-gray-500 font-medium">
                                <p class="text-500 font-medium">Medical Leave
                                    <a href="#" data-tooltip-target="tooltip-right-03"
                                        data-tooltip-placement="right" class=""><i
                                            class="ti ti-info-circle text-info"></i></a>
                                <div id="tooltip-right-03" role="tooltip"
                                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                    I am currently experiencing <br> a fever and design & Development
                                    <div class="tooltip-arrow" data-popper-arrow=""></div>
                                </div>

                            </td>
                            <td class="px-5 py-2.5 text-gray-500">20/02/2024</td>
                            <td class="px-5 py-2.5 text-gray-500">
                                <div class="flex items-center file-name-icon">
                                    <a href="#" class="size-8 rounded-full border border-borderColor">
                                        <img src="assets/img/users/user-58.jpg" class="rounded-full size-8 img-fluid"
                                            alt="img">
                                    </a>
                                    <div class="ms-2">
                                        <h6 class="font-medium"><a href="#"
                                                class="text-gray-900 hover:text-primary">Warren Morales</a>
                                        </h6>
                                        <span class="text-xs leading-normal">Admin</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-2.5 text-gray-500">22/02/2024</td>
                            <td class="px-5 py-2.5 text-gray-500">3 Days</td>
                            <td class="px-5 py-2.5 text-gray-500">
                                <div>
                                    <a href="javascript:void(0);"
                                        class="border rounded p-2 bg-white inline-flex items-center focus:bg-primary focus:border-primary focus:text-white text-gray-900"
                                        data-dropdown-toggle="designation-dropdown-03">
                                        <span
                                            class="rounded-circle bg-transparent-success flex justify-center items-center me-2"><i
                                                class="ti ti-point-filled text-success bg-success-100 rounded-full me-1"></i>
                                            Approved<i class="ti ti-chevron-down ml-1"></i>
                                        </span></a>
                                    <ul id="designation-dropdown-03"
                                        class="hidden p-4 border rounded bg-white shadow-lg w-40 z-[1]">
                                        <li>
                                            <a href="javascript:void(0);"
                                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">Approved</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"
                                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">Declined</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"
                                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">New</a>
                                        </li>

                                    </ul>
                                </div>
                            </td>
                            <td class="px-5 py-2.5 text-gray-500">
                                <div class="action-icon inline-flex">
                                    <a href="#"
                                        class="me-2 size-[26px] flex items-center justify-center rounded-[5px] hover:bg-light-900 hover:text-gray-900"
                                        data-bs-toggle="modal" data-modal-target="edit_leaves"
                                        data-modal-toggle="edit_leaves"><i class="ti ti-edit"></i></a>
                                    <a href="#"
                                        class="size-[26px] flex items-center justify-center rounded-[5px] hover:bg-light-900 hover:text-gray-900"
                                        data-bs-toggle="modal" data-modal-target="delete_modal"
                                        data-modal-toggle="delete_modal"><i class="ti ti-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        <tr class="even:bg-white dark:even-bg-white">
                            <td class="px-5 py-2.5 text-gray-500 ">
                                <div class="flex items-center">
                                    <input
                                        class="size-4 bg-white border border-borderColor rounded text-primary focus:ring-0"
                                        type="checkbox">
                                </div>
                            </td>

                            <td class="px-5 py-2.5 text-gray-500 font-medium">
                                <p class="text-500 font-medium">Annual Leave
                                    <a href="#" data-tooltip-target="tooltip-right-04"
                                        data-tooltip-placement="right" class=""><i
                                            class="ti ti-info-circle text-info"></i></a>
                                <div id="tooltip-right-04" role="tooltip"
                                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                    I am currently experiencing <br> a fever and design & Development
                                    <div class="tooltip-arrow" data-popper-arrow=""></div>
                                </div>

                            </td>
                            <td class="px-5 py-2.5 text-gray-500">15/03/2024</td>
                            <td class="px-5 py-2.5 text-gray-500">
                                <div class="flex items-center file-name-icon">
                                    <a href="#" class="size-8 rounded-full border border-borderColor">
                                        <img src="assets/img/users/user-34.jpg" class="rounded-full size-8 img-fluid"
                                            alt="img">
                                    </a>
                                    <div class="ms-2">
                                        <h6 class="font-medium"><a href="#"
                                                class="text-gray-900 hover:text-primary">Doglas Martini</a></h6>
                                        <span class="text-xs leading-normal">Manager</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-2.5 text-gray-500">17/03/2024</td>
                            <td class="px-5 py-2.5 text-gray-500">3 Days</td>
                            <td class="px-5 py-2.5 text-gray-500">
                                <div>
                                    <a href="javascript:void(0);"
                                        class="border rounded p-2 bg-white inline-flex items-center focus:bg-primary focus:border-primary focus:text-white text-gray-900"
                                        data-dropdown-toggle="designation-dropdown-04">
                                        <span
                                            class="rounded-circle bg-transparent-success flex justify-center items-center me-2"><i
                                                class="ti ti-point-filled text-success bg-success-100 rounded-full me-1"></i>
                                            Approved</span><i class="ti ti-chevron-down ml-1"></i>
                                    </a>
                                    <ul id="designation-dropdown-04"
                                        class="hidden p-4 border rounded bg-white shadow-lg w-40 z-[1]">
                                        <li>
                                            <a href="javascript:void(0);"
                                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">Approved</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"
                                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">Declined</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"
                                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">New</a>
                                        </li>

                                    </ul>
                                </div>
                            </td>
                            <td class="px-5 py-2.5 text-gray-500">
                                <div class="action-icon inline-flex">
                                    <a href="#"
                                        class="me-2 size-[26px] flex items-center justify-center rounded-[5px] hover:bg-light-900 hover:text-gray-900"
                                        data-bs-toggle="modal" data-modal-target="edit_leaves"
                                        data-modal-toggle="edit_leaves"><i class="ti ti-edit"></i></a>
                                    <a href="#"
                                        class="size-[26px] flex items-center justify-center rounded-[5px] hover:bg-light-900 hover:text-gray-900"
                                        data-bs-toggle="modal" data-modal-target="delete_modal"
                                        data-modal-toggle="delete_modal"><i class="ti ti-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        <tr class="even:bg-white dark:even-bg-white">
                            <td class="px-5 py-2.5 text-gray-500 ">
                                <div class="flex items-center">
                                    <input
                                        class="size-4 bg-white border border-borderColor rounded text-primary focus:ring-0"
                                        type="checkbox">
                                </div>
                            </td>

                            <td class="px-5 py-2.5 text-gray-500 font-medium">
                                <p class="text-500 font-medium">Casual Leave
                                    <a href="#" data-tooltip-target="tooltip-right-05"
                                        data-tooltip-placement="right" class=""><i
                                            class="ti ti-info-circle text-info"></i></a>
                                <div id="tooltip-right-05" role="tooltip"
                                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                    I am currently experiencing <br> a fever and design & Development
                                    <div class="tooltip-arrow" data-popper-arrow=""></div>
                                </div>

                            </td>
                            <td class="px-5 py-2.5 text-gray-500">12/04/2024</td>
                            <td class="px-5 py-2.5 text-gray-500">
                                <div class="flex items-center file-name-icon">
                                    <a href="#" class="size-8 rounded-full border border-borderColor">
                                        <img src="assets/img/users/user-34.jpg" class="rounded-full size-8 img-fluid"
                                            alt="img">
                                    </a>
                                    <div class="ms-2">
                                        <h6 class="font-medium"><a href="#"
                                                class="text-gray-900 hover:text-primary">Doglas Martini</a>
                                        </h6>
                                        <span class="text-xs leading-normal">Manager</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-2.5 text-gray-500">16/04/2024</td>
                            <td class="px-5 py-2.5 text-gray-500">5 Days</td>
                            <td class="px-5 py-2.5 text-gray-500">
                                <div>
                                    <a href="javascript:void(0);"
                                        class="border rounded p-2 bg-white inline-flex items-center focus:bg-primary focus:border-primary focus:text-white text-gray-900"
                                        data-dropdown-toggle="designation-dropdown-05">
                                        <span
                                            class="rounded-circle bg-transparent-success flex justify-center items-center me-2"><i
                                                class="ti ti-point-filled text-danger bg-danger-100 rounded-full me-1"></i>
                                            Declined</span><i class="ti ti-chevron-down ml-1"></i>
                                    </a>
                                    <ul id="designation-dropdown-05"
                                        class="hidden p-4 border rounded bg-white shadow-lg w-40 z-[1]">
                                        <li>
                                            <a href="javascript:void(0);"
                                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">Approved</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"
                                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">Declined</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"
                                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">New</a>
                                        </li>

                                    </ul>
                                </div>
                            </td>
                            <td class="px-5 py-2.5 text-gray-500">
                                <div class="action-icon inline-flex">
                                    <a href="#"
                                        class="me-2 size-[26px] flex items-center justify-center rounded-[5px] hover:bg-light-900 hover:text-gray-900"
                                        data-bs-toggle="modal" data-modal-target="edit_leaves"
                                        data-modal-toggle="edit_leaves"><i class="ti ti-edit"></i></a>
                                    <a href="#"
                                        class="size-[26px] flex items-center justify-center rounded-[5px] hover:bg-light-900 hover:text-gray-900"
                                        data-bs-toggle="modal" data-modal-target="delete_modal"
                                        data-modal-toggle="delete_modal"><i class="ti ti-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        <tr class="even:bg-white dark:even-bg-white">
                            <td class="px-5 py-2.5 text-gray-500 ">
                                <div class="flex items-center">
                                    <input
                                        class="size-4 bg-white border border-borderColor rounded text-primary focus:ring-0"
                                        type="checkbox">
                                </div>
                            </td>

                            <td class="px-5 py-2.5 text-gray-500 font-medium">
                                <p class="text-500 font-medium">Medical Leave
                                    <a href="#" data-tooltip-target="tooltip-right-06"
                                        data-tooltip-placement="right" class=""><i
                                            class="ti ti-info-circle text-info"></i></a>
                                <div id="tooltip-right-06" role="tooltip"
                                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                    I am currently experiencing <br> a fever and design & Development
                                    <div class="tooltip-arrow" data-popper-arrow=""></div>
                                </div>

                            </td>
                            <td class="px-5 py-2.5 text-gray-500">20/05/2024</td>
                            <td class="px-5 py-2.5 text-gray-500">
                                <div class="flex items-center file-name-icon">
                                    <a href="#" class="size-8 rounded-full border border-borderColor">
                                        <img src="assets/img/users/user-58.jpg" class="rounded-full size-8 img-fluid"
                                            alt="img">
                                    </a>
                                    <div class="ms-2">
                                        <h6 class="font-medium"><a href="#"
                                                class="text-gray-900 hover:text-primary">Warren Morales</a>
                                        </h6>
                                        <span class="text-xs leading-normal">Admin</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-2.5 text-gray-500">21/05/2024</td>
                            <td class="px-5 py-2.5 text-gray-500">2 Days</td>
                            <td class="px-5 py-2.5 text-gray-500">
                                <div>
                                    <a href="javascript:void(0);"
                                        class="border rounded p-2 bg-white inline-flex items-center focus:bg-primary focus:border-primary focus:text-white text-gray-900"
                                        data-dropdown-toggle="designation-dropdown-06">
                                        <span
                                            class="rounded-circle bg-transparent-success flex justify-center items-center me-2"><i
                                                class="ti ti-point-filled text-danger bg-danger-100 rounded-full me-1"></i>
                                            Declined</span>
                                        <i class="ti ti-chevron-down ml-1"></i>
                                    </a>
                                    <ul id="designation-dropdown-06"
                                        class="hidden p-4 border rounded bg-white shadow-lg w-40 z-[1]">
                                        <li>
                                            <a href="javascript:void(0);"
                                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">Approved</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"
                                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">Declined</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"
                                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">New</a>
                                        </li>

                                    </ul>
                                </div>
                            </td>
                            <td class="px-5 py-2.5 text-gray-500">
                                <div class="action-icon inline-flex">
                                    <a href="#"
                                        class="me-2 size-[26px] flex items-center justify-center rounded-[5px] hover:bg-light-900 hover:text-gray-900"
                                        data-bs-toggle="modal" data-modal-target="edit_leaves"
                                        data-modal-toggle="edit_leaves"><i class="ti ti-edit"></i></a>
                                    <a href="#"
                                        class="size-[26px] flex items-center justify-center rounded-[5px] hover:bg-light-900 hover:text-gray-900"
                                        data-bs-toggle="modal" data-modal-target="delete_modal"
                                        data-modal-toggle="delete_modal"><i class="ti ti-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        <tr class="even:bg-white dark:even-bg-white">
                            <td class="px-5 py-2.5 text-gray-500 ">
                                <div class="flex items-center">
                                    <input
                                        class="size-4 bg-white border border-borderColor rounded text-primary focus:ring-0"
                                        type="checkbox">
                                </div>
                            </td>

                            <td class="px-5 py-2.5 text-gray-500 font-medium">
                                <p class="text-500 font-medium">Casual Leave
                                    <a href="#" data-tooltip-target="tooltip-right-07"
                                        data-tooltip-placement="right" class=""><i
                                            class="ti ti-info-circle text-info"></i></a>
                                <div id="tooltip-right-07" role="tooltip"
                                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                    I am currently experiencing <br> a fever and design & Development
                                    <div class="tooltip-arrow" data-popper-arrow=""></div>
                                </div>

                            </td>
                            <td class="px-5 py-2.5 text-gray-500">06/07/2024</td>
                            <td class="px-5 py-2.5 text-gray-500">
                                <div class="flex items-center file-name-icon">
                                    <a href="#" class="size-8 rounded-full border border-borderColor">
                                        <img src="assets/img/users/user-34.jpg" class="rounded-full size-8 img-fluid"
                                            alt="img">
                                    </a>
                                    <div class="ms-2">
                                        <h6 class="font-medium"><a href="#"
                                                class="text-gray-900 hover:text-primary">Doglas Martini</a>
                                        </h6>
                                        <span class="text-xs leading-normal">Manager</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-2.5 text-gray-500">06/07/2024</td>
                            <td class="px-5 py-2.5 text-gray-500">1 Days</td>
                            <td class="px-5 py-2.5 text-gray-500">
                                <div>
                                    <a href="javascript:void(0);"
                                        class="border rounded p-2 bg-white inline-flex items-center focus:bg-primary focus:border-primary focus:text-white text-gray-900"
                                        data-dropdown-toggle="designation-dropdown-07">
                                        <span
                                            class="rounded-circle bg-transparent-success flex justify-center items-center me-2"><i
                                                class="ti ti-point-filled text-success bg-success-100 rounded-full me-1"></i>
                                            Approved</span><i class="ti ti-chevron-down ml-1"></i>
                                    </a>
                                    <ul id="designation-dropdown-07"
                                        class="hidden p-4 border rounded bg-white shadow-lg w-40 z-[1]">
                                        <li>
                                            <a href="javascript:void(0);"
                                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">Approved</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"
                                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">Declined</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"
                                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">New</a>
                                        </li>

                                    </ul>
                                </div>
                            </td>
                            <td class="px-5 py-2.5 text-gray-500">
                                <div class="action-icon inline-flex">
                                    <a href="#"
                                        class="me-2 size-[26px] flex items-center justify-center rounded-[5px] hover:bg-light-900 hover:text-gray-900"
                                        data-bs-toggle="modal" data-modal-target="edit_leaves"
                                        data-modal-toggle="edit_leaves"><i class="ti ti-edit"></i></a>
                                    <a href="#"
                                        class="size-[26px] flex items-center justify-center rounded-[5px] hover:bg-light-900 hover:text-gray-900"
                                        data-bs-toggle="modal" data-modal-target="delete_modal"
                                        data-modal-toggle="delete_modal"><i class="ti ti-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        <tr class="even:bg-white dark:even-bg-white">
                            <td class="px-5 py-2.5 text-gray-500 ">
                                <div class="flex items-center">
                                    <input
                                        class="size-4 bg-white border border-borderColor rounded text-primary focus:ring-0"
                                        type="checkbox">
                                </div>
                            </td>

                            <td class="px-5 py-2.5 text-gray-500 font-medium">
                                <p class="text-500 font-medium">Medical Leave
                                    <a href="#" data-tooltip-target="tooltip-right-08"
                                        data-tooltip-placement="right" class=""><i
                                            class="ti ti-info-circle text-info"></i></a>
                                <div id="tooltip-right-08" role="tooltip"
                                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                    I am currently experiencing <br> a fever and design & Development
                                    <div class="tooltip-arrow" data-popper-arrow=""></div>
                                </div>

                            </td>
                            <td class="px-5 py-2.5 text-gray-500">02/09/2024</td>
                            <td class="px-5 py-2.5 text-gray-500">
                                <div class="flex items-center file-name-icon">
                                    <a href="#" class="size-8 rounded-full border border-borderColor">
                                        <img src="assets/img/users/user-34.jpg" class="rounded-full size-8 img-fluid"
                                            alt="img">
                                    </a>
                                    <div class="ms-2">
                                        <h6 class="font-medium"><a href="#"
                                                class="text-gray-900 hover:text-primary">Doglas Martini</a>
                                        </h6>
                                        <span class="text-xs leading-normal">Manager</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-2.5 text-gray-500">04/09/2024</td>
                            <td class="px-5 py-2.5 text-gray-500">3 Days</td>
                            <td class="px-5 py-2.5 text-gray-500">
                                <div>
                                    <a href="javascript:void(0);"
                                        class="border rounded p-2 bg-white inline-flex items-center focus:bg-primary focus:border-primary focus:text-white text-gray-900"
                                        data-dropdown-toggle="designation-dropdown-08">
                                        <span
                                            class="rounded-circle bg-transparent-success flex justify-center items-center me-2"><i
                                                class="ti ti-point-filled text-purple bg-purple-100 rounded-full me-1"></i>
                                            New</span><i class="ti ti-chevron-down ml-1"></i>
                                    </a>
                                    <ul id="designation-dropdown-08"
                                        class="hidden p-4 border rounded bg-white shadow-lg w-40 z-[1]">
                                        <li>
                                            <a href="javascript:void(0);"
                                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">Approved</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"
                                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">Declined</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"
                                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">New</a>
                                        </li>

                                    </ul>
                                </div>
                            </td>
                            <td class="px-5 py-2.5 text-gray-500">
                                <div class="action-icon inline-flex">
                                    <a href="#"
                                        class="me-2 size-[26px] flex items-center justify-center rounded-[5px] hover:bg-light-900 hover:text-gray-900"
                                        data-bs-toggle="modal" data-modal-target="edit_leaves"
                                        data-modal-toggle="edit_leaves"><i class="ti ti-edit"></i></a>
                                    <a href="#"
                                        class="size-[26px] flex items-center justify-center rounded-[5px] hover:bg-light-900 hover:text-gray-900"
                                        data-bs-toggle="modal" data-modal-target="delete_modal"
                                        data-modal-toggle="delete_modal"><i class="ti ti-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        <tr class="even:bg-white dark:even-bg-white">
                            <td class="px-5 py-2.5 text-gray-500 ">
                                <div class="flex items-center">
                                    <input
                                        class="size-4 bg-white border border-borderColor rounded text-primary focus:ring-0"
                                        type="checkbox">
                                </div>
                            </td>

                            <td class="px-5 py-2.5 text-gray-500 font-medium">
                                <p class="text-500 font-medium">Annual Leave
                                    <a href="#" data-tooltip-target="tooltip-right-09"
                                        data-tooltip-placement="right" class=""><i
                                            class="ti ti-info-circle text-info"></i></a>
                                <div id="tooltip-right-09" role="tooltip"
                                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                    I am currently experiencing <br> a fever and design & Development
                                    <div class="tooltip-arrow" data-popper-arrow=""></div>
                                </div>

                            </td>
                            <td class="px-5 py-2.5 text-gray-500">15/11/2024</td>
                            <td class="px-5 py-2.5 text-gray-500">
                                <div class="flex items-center file-name-icon">
                                    <a href="#" class="size-8 rounded-full border border-borderColor">
                                        <img src="assets/img/users/user-58.jpg" class="rounded-full size-8 img-fluid"
                                            alt="img">
                                    </a>
                                    <div class="ms-2">
                                        <h6 class="font-medium"><a href="#"
                                                class="text-gray-900 hover:text-primary">Warren Morales</a>
                                        </h6>
                                        <span class="text-xs leading-normal">Admin</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-2.5 text-gray-500">15/11/2024</td>
                            <td class="px-5 py-2.5 text-gray-500">1 Days</td>
                            <td class="px-5 py-2.5 text-gray-500">
                                <div>
                                    <a href="javascript:void(0);"
                                        class="border rounded p-2 bg-white inline-flex items-center focus:bg-primary focus:border-primary focus:text-white text-gray-900"
                                        data-dropdown-toggle="designation-dropdown-09">
                                        <span
                                            class="rounded-circle bg-transparent-success flex justify-center items-center me-2"><i
                                                class="ti ti-point-filled text-purple bg-purple-100 rounded-full me-1"></i>
                                            New</span><i class="ti ti-chevron-down ml-1"></i>
                                    </a>
                                    <ul id="designation-dropdown-09"
                                        class="hidden p-4 border rounded bg-white shadow-lg w-40 z-[1]">
                                        <li>
                                            <a href="javascript:void(0);"
                                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">Approved</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"
                                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">Declined</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"
                                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">New</a>
                                        </li>

                                    </ul>
                                </div>
                            </td>
                            <td class="px-5 py-2.5 text-gray-500">
                                <div class="action-icon inline-flex">
                                    <a href="#"
                                        class="me-2 size-[26px] flex items-center justify-center rounded-[5px] hover:bg-light-900 hover:text-gray-900"
                                        data-bs-toggle="modal" data-modal-target="edit_leaves"
                                        data-modal-toggle="edit_leaves"><i class="ti ti-edit"></i></a>
                                    <a href="#"
                                        class="size-[26px] flex items-center justify-center rounded-[5px] hover:bg-light-900 hover:text-gray-900"
                                        data-bs-toggle="modal" data-modal-target="delete_modal"
                                        data-modal-toggle="delete_modal"><i class="ti ti-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        <tr class="even:bg-white dark:even-bg-white">
                            <td class="px-5 py-2.5 text-gray-500 ">
                                <div class="flex items-center">
                                    <input
                                        class="size-4 bg-white border border-borderColor rounded text-primary focus:ring-0"
                                        type="checkbox">
                                </div>
                            </td>

                            <td class="px-5 py-2.5 text-gray-500 font-medium">
                                <p class="text-500 font-medium">Casual Leave
                                    <a href="#" data-tooltip-target="tooltip-right-10"
                                        data-tooltip-placement="right" class=""><i
                                            class="ti ti-info-circle text-info"></i></a>
                                <div id="tooltip-right-10" role="tooltip"
                                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                    I am currently experiencing <br> a fever and design & Development
                                    <div class="tooltip-arrow" data-popper-arrow=""></div>
                                </div>

                            </td>
                            <td class="px-5 py-2.5 text-gray-500">10/12/2024</td>
                            <td class="px-5 py-2.5 text-gray-500">
                                <div class="flex items-center file-name-icon">
                                    <a href="#" class="size-8 rounded-full border border-borderColor">
                                        <img src="assets/img/users/user-34.jpg" class="rounded-full size-8 img-fluid"
                                            alt="img">
                                    </a>
                                    <div class="ms-2">
                                        <h6 class="font-medium"><a href="#"
                                                class="text-gray-900 hover:text-primary">Doglas Martini</a>
                                        </h6>
                                        <span class="text-xs leading-normal">Manager</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-2.5 text-gray-500">11/12/2024</td>
                            <td class="px-5 py-2.5 text-gray-500">2 Days</td>
                            <td class="px-5 py-2.5 text-gray-500">
                                <div>
                                    <a href="javascript:void(0);"
                                        class="border rounded p-2 bg-white inline-flex items-center focus:bg-primary focus:border-primary focus:text-white text-gray-900"
                                        data-dropdown-toggle="designation-dropdown-10">
                                        <span
                                            class="rounded-circle bg-transparent-success flex justify-center items-center me-2"><i
                                                class="ti ti-point-filled text-purple bg-purple-100 rounded-full me-1"></i>
                                            New</span><i class="ti ti-chevron-down ml-1"></i>
                                    </a>
                                    <ul id="designation-dropdown-10"
                                        class="hidden p-4 border rounded bg-white shadow-lg w-40 z-[1]">
                                        <li>
                                            <a href="javascript:void(0);"
                                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">Approved</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"
                                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">Declined</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"
                                                class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">New</a>
                                        </li>

                                    </ul>
                                </div>
                            </td>
                            <td class="px-5 py-2.5 text-gray-500">
                                <div class="action-icon inline-flex">
                                    <a href="#"
                                        class="me-2 size-[26px] flex items-center justify-center rounded-[5px] hover:bg-light-900 hover:text-gray-900"
                                        data-bs-toggle="modal" data-modal-target="edit_leaves"
                                        data-modal-toggle="edit_leaves"><i class="ti ti-edit"></i></a>
                                    <a href="#"
                                        class="size-[26px] flex items-center justify-center rounded-[5px] hover:bg-light-900 hover:text-gray-900"
                                        data-bs-toggle="modal" data-modal-target="delete_modal"
                                        data-modal-toggle="delete_modal"><i class="ti ti-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /Leave List -->

</div>
