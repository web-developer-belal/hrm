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

            <div class="mb-2">
                <a href="{{ route('employee.leave.create') }}"
                    class="flex items-center bg-primary text-sm font-medium py-2 rounded text-white px-3 hover:bg-primary-900 hover:text-white"><i
                        class="ti ti-circle-plus me-2"></i>New Leave</a>
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
               
            </div>
            <div class="flex my-xl-auto right-content items-center flex-wrap gap-3">
                <div class="me-3">
                    <div class="relative">
                        <input type="search" wire:model.live.debounce.500s='search'
                            class="block flex-1 border border-borderColor bg-white rounded-[5px] py-1.5 pl-2.5 pr-8 text-gray-900 placeholder:text-gray-400 focus:ring-0 focus:border-borderColor h-[38px] text-sm date-range"
                            placeholder="Search notice">
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

            </div>
        </div>
        <div class="card-body p-0">
            <div class="">
                <table class="table w-full border-b border-borderColor">
                    <thead class="thead-light">
                        <tr>
                            <th
                                class="no-sort text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor hover:outline-none">
                                SL
                            </th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Leave Type </th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                From</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Approved By </th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                To</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                No of Days</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Status</th>

                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-borderColor">
                        @foreach ($leaves as $item)
                            <tr class="even:bg-white dark:even-bg-white">
                                <td class="px-5 py-2.5 text-gray-500">
                                    {{ $leaves->firstItem() + $loop->index }}
                                </td>

                                <td class="px-5 py-2.5 text-gray-500 font-medium">
                                    <p class="text-500 font-medium">{{ $item->type?->name }}
                                        <a href="#" data-tooltip-target="tooltip-right-01"
                                            data-tooltip-placement="right" class=""><i
                                                class="ti ti-info-circle text-info"></i></a>
                                        {{-- <div id="tooltip-right-01" role="tooltip"
                                        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                        I am currently experiencing <br> a fever and design & Development
                                        <div class="tooltip-arrow" data-popper-arrow=""></div>
                                    </div> --}}

                                </td>
                                <td class="px-5 py-2.5 text-gray-500">{{ $item->from_date->format('d M Y') }}</td>
                                <td class="px-5 py-2.5 text-gray-500">
                                    <div class="flex items-center file-name-icon">
                                        <a href="#" class="size-8 rounded-full border border-borderColor">
                                            <img src="{{ customAsset($item->employee->photo, true, 'user') }}"
                                                class="rounded-full size-8 img-fluid" alt="img">
                                        </a>
                                        <div class="ms-2">
                                            <h6 class="font-medium"><a href="#"
                                                    class="text-gray-900 hover:text-primary">{{ $item->employee->full_name }}</a>
                                            </h6>
                                            <span
                                                class="text-xs leading-normal">{{ $item->employee->designation?->name }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-2.5 text-gray-500">{{ $item->from_date->format('d M Y') }}</td>
                                <td class="px-5 py-2.5 text-gray-500">{{ $item->total_days }} Days</td>
                                <td class="px-5 py-2.5 text-gray-500">
                                    {{ ucfirst($item->status) }}
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-3 py-4">
                {{ $leaves->links() }}
            </div>
        </div>
    </div>
    <!-- /Leave List -->

</div>
