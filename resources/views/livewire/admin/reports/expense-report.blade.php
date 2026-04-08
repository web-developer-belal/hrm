<div>
    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">Expense Report</h2>
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-xs text-gray-500 hover:text-primary">
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
                                    <h5>${{ number_format($stats['totalExpense']['amount'], 2) }}</h5>
                                </div>
                                <a href="#"
                                    class="size-8 rounded-full flex justify-center items-center bg-primary-transparent border border-primary">
                                    <span class="text-primary"><i class="ti ti-brand-shopee"></i></span>
                                </a>
                            </div>
                            <p class="fs-12 font-normal flex items-center text-truncate">
                                <span class="text-{{ $stats['totalExpense']['percentage'] >= 0 ? 'success' : 'danger' }} fs-12 flex items-center me-1">
                                    <i class="ti ti-arrow-wave-right-{{ $stats['totalExpense']['percentage'] >= 0 ? 'up' : 'down' }} me-1"></i>
                                    {{ $stats['totalExpense']['percentage'] >= 0 ? '+' : '' }}{{ $stats['totalExpense']['percentage'] }}%
                                </span> from last period
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
                                    <span class="fs-14 font-normal text-truncate mb-1">Total Transactions</span>
                                    <h5>{{ $stats['totalCount']['count'] }}</h5>
                                </div>
                                <a href="#"
                                    class="size-8 rounded-full flex justify-center items-center bg-success-transparent border border-success">
                                    <span class="text-success"><i class="ti ti-brand-shopee"></i></span>
                                </a>
                            </div>
                            <p class="fs-12 font-normal flex items-center text-truncate">
                                <span class="text-{{ $stats['totalCount']['percentage'] >= 0 ? 'success' : 'danger' }} fs-12 flex items-center me-1">
                                    <i class="ti ti-arrow-wave-right-{{ $stats['totalCount']['percentage'] >= 0 ? 'up' : 'down' }} me-1"></i>
                                    {{ $stats['totalCount']['percentage'] >= 0 ? '+' : '' }}{{ $stats['totalCount']['percentage'] }}%
                                </span> from last period
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
                                    <span class="fs-14 font-normal text-truncate mb-1">Average Expense</span>
                                    <h5>${{ number_format($stats['averageExpense']['amount'], 2) }}</h5>
                                </div>
                                <a href="#"
                                    class="size-8 rounded-full flex justify-center items-center bg-skyblue-transparent border border-skyblue">
                                    <span class="text-skyblue"><i class="ti ti-brand-shopee"></i></span>
                                </a>
                            </div>
                            <p class="fs-12 font-normal flex items-center text-truncate">
                                <span class="text-{{ $stats['averageExpense']['percentage'] >= 0 ? 'success' : 'danger' }} fs-12 flex items-center me-1">
                                    <i class="ti ti-arrow-wave-right-{{ $stats['averageExpense']['percentage'] >= 0 ? 'up' : 'down' }} me-1"></i>
                                    {{ $stats['averageExpense']['percentage'] >= 0 ? '+' : '' }}{{ $stats['averageExpense']['percentage'] }}%
                                </span> from last period
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
                                    <span class="fs-14 font-normal text-truncate mb-1">Highest Expense</span>
                                    <h5>${{ number_format($stats['highestExpense']['amount'], 2) }}</h5>
                                </div>
                                <a href="#"
                                    class="size-8 rounded-full flex justify-center items-center bg-danger-transparent border border-danger">
                                    <span class="text-danger"><i class="ti ti-brand-shopee"></i></span>
                                </a>
                            </div>
                            <p class="fs-12 font-normal flex items-center text-truncate">
                                <span class="text-{{ $stats['highestExpense']['percentage'] >= 0 ? 'danger' : 'success' }} fs-12 flex items-center me-1">
                                    <i class="ti ti-arrow-wave-right-{{ $stats['highestExpense']['percentage'] >= 0 ? 'up' : 'down' }} me-1"></i>
                                    {{ $stats['highestExpense']['percentage'] >= 0 ? '+' : '' }}{{ $stats['highestExpense']['percentage'] }}%
                                </span> from last period
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Total Exponses -->

        <!-- Expense Chart -->
        <div class="xxl:col-span-6 flex" 
            x-data="{
                chart: null,
                chartData: @js($chartData),
                
                initChart() {
                    const options = {
                        series: [{
                            name: 'Expense Amount',
                            data: this.chartData.expenses
                        }],
                        chart: {
                            height: 190,
                            type: 'area',
                            zoom: {
                                enabled: false
                            }
                        },
                        colors: ['#FF9F43'],
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            curve: 'smooth'
                        },
                        title: {
                            text: '',
                            align: 'left'
                        },
                        xaxis: {
                            categories: this.chartData.categories,
                        },
                        yaxis: {
                            labels: {
                                offsetX: -15,
                                formatter: (val) => {
                                    return '$' + val.toFixed(0)
                                }
                            }
                        },
                        legend: {
                            position: 'top',
                            horizontalAlign: 'left'
                        }
                    };

                    this.chart = new ApexCharts(document.querySelector('#my-expense-analysis'), options);
                    this.chart.render();
                },
                
                updateChart(event) {
                    if (event.detail && event.detail.chartData) {
                        this.chartData = event.detail.chartData;
                        
                        if (this.chart) {
                            this.chart.updateOptions({
                                xaxis: {
                                    categories: this.chartData.categories
                                }
                            });
                            
                            this.chart.updateSeries([{
                                name: 'Expense Amount',
                                data: this.chartData.expenses
                            }]);
                        }
                    }
                }
            }"
            x-init="initChart()"
            @update-chart.window="updateChart($event)">
            <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white flex-1 ">
                <div class="card-header border-0 pb-0 pt-4 px-5">
                    <div class="flex flex-wrap justify-between items-center">
                        <div class="flex items-center ">
                            <span class="me-2"><i class="ti ti-chart-area-line text-danger"></i></span>
                            <h5>Expense </h5>
                        </div>
                       
                    </div>
                </div>
                <div class="card-body py-0 px-5">
                    <div id="my-expense-analysis"></div>
                </div>
            </div>
        </div>
        <!-- /Expense Chart -->

    </div>
    <!-- Expense List -->
    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white">
        <div
            class="card-header py-4 px-5 border-b border-borderColor flex items-center justify-between flex-wrap gap-3">
            <h5>Expense List</h5>
            <div class="flex-1 grid grid-cols-1 md:grid-cols-4 gap-3">
                <div>
                    <x-form.select name="branch" :options="$branch_options" :live="true" :search="true" placeholder="Select Branch" />
                </div>
                <div class="flex justify-end">
                    <x-form.date-range-picker :startDate="$startDate" :endDate="$endDate" />
                </div>
            </div>
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
