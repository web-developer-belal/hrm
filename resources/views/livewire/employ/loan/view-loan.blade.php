<div>
    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">Employee Loan Details</h2>
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('employee.dashboard') }}"
                            class="inline-flex items-center text-xs text-gray-500 hover:text-primary">
                            <i class="ti ti-smart-home"></i>
                        </a>
                    </li>
                    <li>
                        <span class="text-default">/</span>
                    </li>
                    <li class="text-xs text-default">
                        Employee Loan Details
                    </li>
                </ol>
            </nav>
        </div>

        <div class="flex my-xl-auto right-content items-center flex-wrap ">
            <div class="mb-2">
                <a href="{{ route('employee.loan') }}"
                    class="flex items-center bg-primary text-sm font-medium py-2 rounded text-white px-3 hover:bg-primary-900 hover:text-white">
                    <i class="ti ti-circle-plus me-2"></i>Loan List
                </a>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <div class="grid grid-cols-1" style="transform: none;">
       
        <div class="xl:col-span-8">
            <div>
                <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white mb-6">
                    <div class="card-header justify-between py-4 px-5 flex items-center justify-between flex-wrap border-b border-borderColor">
                        <div class="card-title">
                            Loan Details
                        </div>

                    </div>
                    <div class="card-body p-5">
                        <div class="table-responsive">
                            <table class="table-auto text-nowrap table-striped-columns">
                                <thead class="table-head">
                                    <tr>
                                        <th scope="col">SL</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($loan->installments_data as $item)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ \Carbon\Carbon::createFromFormat('n', $item->month)->format('M') }},
                                            {{ $item->year }}</td>
                                        <td>{{ $item->amount }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-{{ $item->is_paid==0 ? 'danger':'success' }} btn-wave waves-effect waves-light">
                                                <i class="feather-trash align-middle me-2 inline-block"></i>{{ $item->is_paid==0 ? 'Upaid':'Paid' }}
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach



                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>



</div>
