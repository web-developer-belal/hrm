<div>
    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">Payslip Report</h2>
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
                    <li aria-current="page" class="text-xs text-gray-900">Payslip Report</li>
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
                <div class="xl:col-span-6 md:col-span-6 flex">
                    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white flex-1">
                        <div class="card-body p-5">
                            <div class="flex items-center justify-between bg-light border rounded p-2 mb-2">
                                <div class="">
                                    <span class="text-[14px] font-normal text-truncate ">Total Payroll</span>
                                    <h5 class="mt-1">${{ number_format($stats['totalPayroll']['amount'], 2) }}</h5>
                                </div>
                                <a href="#"
                                    class="size-8 rounded-full flex items-center justify-center bg-primary-transparent border border-primary">
                                    <span class="text-primary"><i class="ti ti-brand-shopee"></i></span>
                                </a>
                            </div>
                            <p class="text-[12px] font-normal flex items-center text-truncate">
                                <span class="text-[12px] flex items-center me-1 {{ $stats['totalPayroll']['percentage'] >= 0 ? 'text-success' : 'text-danger' }}">
                                    <i class="ti {{ $stats['totalPayroll']['percentage'] >= 0 ? 'ti-arrow-wave-right-up' : 'ti-arrow-wave-right-down' }} me-1"></i>{{ number_format(abs($stats['totalPayroll']['percentage']), 2) }}%
                                </span> from previous period
                            </p>
                        </div>
                    </div>
                </div>
                <div class="xl:col-span-6 md:col-span-6 flex">
                    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white flex-1">
                        <div class="card-body p-5">
                            <div class="flex items-center justify-between bg-light border rounded p-2 mb-2">
                                <div class="">
                                    <span class="text-[14px] font-normal text-truncate mb-1">Deductions</span>
                                    <h5>${{ number_format($stats['totalDeductions']['amount'], 2) }}</h5>
                                </div>
                                <a href="#"
                                    class="size-8 rounded-full flex items-center justify-center bg-danger-transparent border border-danger">
                                    <span class="text-danger"><i class="ti ti-brand-shopee"></i></span>
                                </a>
                            </div>
                            <p class="text-[12px] font-normal flex items-center text-truncate">
                                <span class="text-[12px] flex items-center me-1 {{ $stats['totalDeductions']['percentage'] >= 0 ? 'text-success' : 'text-danger' }}">
                                    <i class="ti {{ $stats['totalDeductions']['percentage'] >= 0 ? 'ti-arrow-wave-right-up' : 'ti-arrow-wave-right-down' }} me-1"></i>{{ number_format(abs($stats['totalDeductions']['percentage']), 2) }}%
                                </span> from previous period
                            </p>
                        </div>
                    </div>
                </div>
                <div class="xl:col-span-6 md:col-span-6 flex">
                    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white flex-1">
                        <div class="card-body p-5">
                            <div class="flex items-center justify-between bg-light border rounded p-2 mb-2">
                                <div class="">
                                    <span class="text-[14px] font-normal text-truncate mb-1">Net Pay</span>
                                    <h5>${{ number_format($stats['netPay']['amount'], 2) }}</h5>
                                </div>
                                <a href="#"
                                    class="size-8 rounded-full flex items-center justify-center bg-success-100 border border-success">
                                    <span class="text-success"><i class="ti ti-brand-shopee"></i></span>
                                </a>
                            </div>
                            <p class="text-[12px] font-normal flex items-center text-truncate">
                                <span class="text-[12px] flex items-center me-1 {{ $stats['netPay']['percentage'] >= 0 ? 'text-success' : 'text-danger' }}">
                                    <i class="ti {{ $stats['netPay']['percentage'] >= 0 ? 'ti-arrow-wave-right-up' : 'ti-arrow-wave-right-down' }} me-1"></i>{{ number_format(abs($stats['netPay']['percentage']), 2) }}%
                                </span> from previous period
                            </p>
                        </div>
                    </div>
                </div>
                <div class="xl:col-span-6 md:col-span-6 flex">
                    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white flex-1">
                        <div class="card-body p-5">
                            <div class="flex items-center justify-between bg-light border rounded p-2 mb-2">
                                <div class="">
                                    <span class="text-[14px] font-normal text-truncate mb-1">Allowances</span>
                                    <h5>${{ number_format($stats['allowances']['amount'], 2) }}</h5>
                                </div>
                                <a href="#"
                                    class="size-8 rounded-full flex items-center justify-center bg-skyblue-transparent border border-skyblue">
                                    <span class="text-skyblue"><i class="ti ti-brand-shopee"></i></span>
                                </a>
                            </div>
                            <p class="text-[12px] font-normal flex items-center text-truncate">
                                <span class="text-[12px] flex items-center me-1 {{ $stats['allowances']['percentage'] >= 0 ? 'text-success' : 'text-danger' }}">
                                    <i class="ti {{ $stats['allowances']['percentage'] >= 0 ? 'ti-arrow-wave-right-up' : 'ti-arrow-wave-right-down' }} me-1"></i>{{ number_format(abs($stats['allowances']['percentage']), 2) }}%
                                </span> from previous period
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /Total Exponses -->

        <!-- Total Exponses -->
        <div class="xxl:col-span-6 flex" 
            x-data="{
                chart: null,
                initChart() {
                    const chartData = @js($chartData);
                    const options = {
                        series: chartData.series,
                        chart: {
                            type: 'line',
                            height: 200,
                        },
                        xaxis: {
                            categories: chartData.categories,
                            labels: {}
                        },
                        stroke: {
                            curve: 'stepline',
                        },
                        dataLabels: {
                            enabled: false
                        },
                        markers: {
                            hover: {
                                sizeOffset: 4
                            }
                        },
                        colors: ['#FF5733'],
                    };
                    this.chart = new ApexCharts(document.querySelector('#my-payslip-chart'), options);
                    this.chart.render();
                }
            }"
            x-init="initChart()"
            @update-chart.window="
                if (chart) {
                    chart.updateOptions({
                        xaxis: { categories: $event.detail.chartData.categories }
                    });
                    chart.updateSeries($event.detail.chartData.series);
                }
            ">
            <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white flex-1">
                <div class="card-header border-0 pb-0 pt-4 px-5">
                    <div class="flex flex-wrap gap-y-2 justify-between items-center">
                        <div class="flex items-center ">
                            <span class="me-2"><i class="ti ti-chart-area-line text-danger"></i></span>
                            <h5>Payroll </h5>
                        </div>

                    </div>
                </div>

                <div class="card-body px-5 pt-0">
                    <div id="my-payslip-chart" class="flex-fill"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Payslip List -->
    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white">
        <div
            class="card-header py-4 px-5 border-b border-borderColor flex items-center justify-between flex-wrap gap-3">
            <h5>Payslip List</h5>
            <div class="">
                <x-form.date-range-picker :startDate="$startDate" :endDate="$endDate" />
            </div>
        </div>
        <div class="card-body p-0">
            <div class="overflow-x-auto">
                <table class="table w-full border-b border-borderColor" wire:loading.class="opacity-50">
                    <thead>
                        <tr>
                            
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                SL</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Emp ID</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Name</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Branch</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Year</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Month</th>

                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-borderColor" wire:loading.class="opacity-50">
                        @foreach ($payslips as $pay)
                            {{-- Main Row --}}
                            <tr class="hover:bg-gray-50 cursor-pointer">
                               
                                <td class="px-5 py-2.5 text-gray-500">{{ $payslips->firstItem() + $loop->index }}</td>
                                <td class="px-5 py-2.5 text-gray-500">{{ $pay->employee->employee_code }}</td>
                                <td class="px-5 py-2.5 text-gray-500 p-3">
                                    <div class="flex items-center file-name-icon">
                                        <a href="{{ route('admin.employees.details', ['emp' => $pay->id]) }}"
                                            class="size-8 rounded-full border border-borderColor">
                                            <img src="{{ customAsset($pay->employee->photo, true, 'emp', $pay->employee->first_name) }}"
                                                class="rounded-full size-8 img-fluid" alt="img">
                                        </a>
                                        <div class="ms-2">
                                            <h6 class="font-medium"><a
                                                    href="{{ route('admin.employees.details', ['emp' => $pay->id]) }}"
                                                    class="text-gray-900 hover:text-primary">{{ $pay->employee->first_name . ' ' . $pay->employee->last_name }}</a>
                                            </h6>
                                            <span class="text-xs leading-normal">
                                                {{ $pay->employee->designation->name }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-2.5 text-gray-500">
                                    {{ $pay->branch->name ?? $pay->employee->branch->name }}</td>
                                <td class="px-5 py-2.5 text-gray-500">{{ $pay->year }}</td>
                                <td class="px-5 py-2.5 text-gray-500">
                                    {{ \Carbon\Carbon::create()->month($pay->month)->format('F') }}</td>

                                <td class="px-5 py-2.5">
                                    <a href="{{ route('admin.payroll.payslips.show', ['payslip' => $pay->id]) }}"
                                        class="me-2 size-[26px] flex items-center justify-center rounded-[5px] hover:bg-light-900 hover:text-gray-900"><i
                                            class="ti ti-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /Payslip List -->
</div>
