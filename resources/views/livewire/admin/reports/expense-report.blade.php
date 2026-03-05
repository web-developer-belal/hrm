<div>
    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">Expense Report</h2>
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
                    <li class="text-xs text-default">HR</li>
                    <li>
                        <span class="text-default">/</span>
                    </li>
                    <li aria-current="page" class="text-xs text-gray-900">Expense Report</li>
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
    <div class="grid grid-cols-1 xxl:grid-cols-12  gap-6 mb-6">
        <!-- Total Exponses -->
        <div class="xxl:col-span-6 flex">
            <div class="grid grid-cols-1 md:grid-cols-12 w-full gap-6">
                <div class="md:col-span-6 flex ">
                    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white flex-1 relative">
                        <span class="absolute start-0 bottom-0">
                            <img src="{{ asset('assets/img/reports-img/total-expense.svg') }}" alt="img" class="img-fluid">
                        </span>
                        <div class="card-body p-5">
                            <div class="flex items-center justify-between mb-2">
                                <div>
                                    <span class="fs-14 font-normal text-truncate mb-1">Total Expense</span>
                                    <h5>$45,221</h5>
                                </div>
                                <a href="#"
                                    class="size-8 rounded-full flex justify-center items-center bg-primary-transparent border border-primary">
                                    <span class="text-primary"><i class="ti ti-brand-shopee"></i></span>
                                </a>
                            </div>
                            <p class="fs-12 font-normal flex items-center text-truncate">
                                <span class="text-success fs-12 flex items-center me-1">
                                    <i class="ti ti-arrow-wave-right-up me-1"></i>+20.01%
                                </span> from last week
                            </p>
                        </div>
                    </div>
                </div>
                <div class="md:col-span-6 flex">
                    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white flex-1 relative">
                        <span class="absolute start-0 bottom-0">
                            <img src="{{ asset('assets/img/reports-img/approved-expense.svg') }}" alt="img" class="img-fluid">
                        </span>
                        <div class="card-body p-5">
                            <div class="flex items-center justify-between mb-2">
                                <div>
                                    <span class="fs-14 font-normal text-truncate mb-1">Approved Expense</span>
                                    <h5>$45,221</h5>
                                </div>
                                <a href="#"
                                    class="size-8 rounded-full flex justify-center items-center bg-success-transparent border border-success">
                                    <span class="text-success"><i class="ti ti-brand-shopee"></i></span>
                                </a>
                            </div>
                            <p class="fs-12 font-normal flex items-center text-truncate">
                                <span class="text-success fs-12 flex items-center me-1">
                                    <i class="ti ti-arrow-wave-right-up me-1"></i>+17.01%
                                </span> from last week
                            </p>
                        </div>
                    </div>
                </div>
                <div class="md:col-span-6 flex">
                    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white flex-1 relative">
                        <span class="absolute start-0 bottom-0">
                            <img src="{{ asset('assets/img/reports-img/pending-expense.svg') }}" alt="img" class="img-fluid">
                        </span>
                        <div class="card-body p-5">
                            <div class="flex items-center justify-between mb-2">
                                <div>
                                    <span class="fs-14 font-normal text-truncate mb-1">Net Pay</span>
                                    <h5>$45,221,45</h5>
                                </div>
                                <a href="#"
                                    class="size-8 rounded-full flex justify-center items-center bg-skyblue-transparent border border-skyblue">
                                    <span class="text-skyblue"><i class="ti ti-brand-shopee"></i></span>
                                </a>
                            </div>
                            <p class="fs-12 font-normal flex items-center text-truncate">
                                <span class="text-success fs-12 flex items-center me-1">
                                    <i class="ti ti-arrow-wave-right-up me-1"></i>+10.13%
                                </span> from last week
                            </p>
                        </div>
                    </div>
                </div>
                <div class="md:col-span-6 flex">
                    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white flex-1 relative">
                        <span class="absolute start-0 bottom-0">
                            <img src="{{ asset('assets/img/reports-img/reject-expense.svg') }}" alt="img" class="img-fluid">
                        </span>
                        <div class="card-body p-5">
                            <div class="flex items-center justify-between mb-2">
                                <div>
                                    <span class="fs-14 font-normal text-truncate mb-1">Allowances</span>
                                    <h5>$45,221,45</h5>
                                </div>
                                <a href="#"
                                    class="size-8 rounded-full flex justify-center items-center bg-danger-transparent border border-danger">
                                    <span class="text-danger"><i class="ti ti-brand-shopee"></i></span>
                                </a>
                            </div>
                            <p class="fs-12 font-normal flex items-center text-truncate">
                                <span class="text-danger fs-12 flex items-center me-1">
                                    <i class="ti ti-arrow-wave-right-up me-1"></i>-10.17%
                                </span> from last week
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Total Exponses -->

        <!-- Total Exponses -->
        <div class="xxl:col-span-6 flex">
            <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white flex-1 ">
                <div class="card-header border-0 pb-0 pt-4 px-5">
                    <div class="flex flex-wrap justify-between items-center">
                        <div class="flex items-center ">
                            <span class="me-2"><i class="ti ti-chart-area-line text-danger"></i></span>
                            <h5>Expense </h5>
                        </div>
                        <a href="javascript:void(0);"
                            class="border rounded p-2 bg-white inline-flex items-center focus:bg-primary focus:border-primary focus:text-white"
                            data-dropdown-toggle="chart-dropdown">
                            This Year<i class="ti ti-chevron-down ml-1"></i>
                        </a>
                        <ul id="chart-dropdown" class="hidden p-4 border rounded bg-white shadow-lg w-40 z-[1]">
                            <li>
                                <a href="javascript:void(0);"
                                    class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">2025</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);"
                                    class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">2024</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);"
                                    class="rounded p-2 flex items-center hover:bg-primary-transparent hover:text-primary">2023</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body py-0 px-5">
                    <div id="expense-analysis"></div>
                </div>
            </div>
        </div>
        <!-- /Total Exponses -->

    </div>
    <!-- Expense List -->
    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white">
        <div
            class="card-header py-4 px-5 border-b border-borderColor flex items-center justify-between flex-wrap gap-3">
            <h5>Expense List</h5>
           
        </div>
        <div class="card-body p-0">
            <div class="overflow-x-auto">
                <table class="w-full table-auto border">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2">#</th>
                            <th class="px-4 py-2">Branch</th>
                            <th class="px-4 py-2">Type</th>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Amount</th>
                            <th class="px-4 py-2">Date</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($expenses as $exp)
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2">{{ $exp->branch->name }}</td>
                                <td class="px-4 py-2">{{ $exp->type->name }}</td>
                                <td class="px-4 py-2">{{ $exp->name }}</td>
                                <td class="px-4 py-2">{{ number_format($exp->amount, 2) }}</td>
                                <td class="px-4 py-2">{{ $exp->date->format('d-M-Y') }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer py-4 px-5 border-t border-borderColor">
            {{ $expenses->links() }}
        </div>
    </div>
    <!-- /Expense List -->
</div>
