<div>
    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">Employee Loan Details</h2>
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}"
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
                <a href="{{ route('admin.loan.index') }}"
                    class="flex items-center bg-primary text-sm font-medium py-2 rounded text-white px-3 hover:bg-primary-900 hover:text-white">
                    <i class="ti ti-circle-plus me-2"></i>Loan List
                </a>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <div class="grid grid-cols-1 gap-6 xl:grid-cols-12" style="transform: none;">
        <div class="xl:col-span-4 "
            style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">



            <div class=""
                style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none;">
                <div class="card mb-5 border border-borderColor rounded-[5px] shadow-xs bg-white">
                    <div
                        class="card-body z-[1] p-0 pt-[50px] relative before:bg-[url({{asset('assets/img/bg/card-bg.png')}})] before:top-0 before:left-0 before:right-0 before:w-full before:h-[90px] before:absolute before:block before:bg-cover before:rounded-defaultradius before:content-[''] before:z-0">
                        <span
                            class="size-[60px] flex items-center justify-center rounded-full border-2 border-white m-auto mb-2  relative z-[1]">
                            <img src="{{asset('assets/img/users/user-13.jpg')}}" class="rounded-full" alt="Img">
                        </span>
                        <div class="text-center px-4 pb-4 border-b border-borderColor relative z-[1]">
                            <h5 class="flex items-center justify-center mb-1">{{$employee->first_name .' '.$employee->last_name}}<i
                                    class="ti ti-discount-check-filled text-success ms-1"></i></h5>

                            <span
                                class="inline-flex items-center py-1 px-2 text-xs font-medium rounded text-dark bg-dark-transparent mb-1">
                                <i class="ti ti-point-filled me-1 "></i>{{$employee->designation->name}}
                            </span>
                            {{-- <span
                                class="inline-flex items-center py-1 px-2 text-xs font-medium rounded text-secondary bg-secondary-transparent">10+
                                years of Experience</span> --}}
                        </div>
                        <div class="p-4 border-b border-borderColor">
                            <div class="flex items-center justify-between mb-2">
                                <span class="inline-flex items-center">
                                    <i class="ti ti-id me-2"></i>
                                    EMP Code
                                </span>
                                <p class="text-dark">{{$employee->employee_code}}</p>
                            </div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="inline-flex items-center">
                                    <i class="ti ti-star me-2"></i>
                                  Department
                                </span>
                                <a href="javascript:void(0);" class="text-dark">{{$employee->department->name}}</a>
                            </div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="inline-flex items-center">
                                    <i class="ti ti-calendar-check me-2"></i>
                                    Date Of Join
                                </span>
                                <p class="text-dark">{{$employee->joining_date->format('d M Y')}}</p>
                            </div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="inline-flex items-center">
                                    <i class="ti ti-calendar-check me-2"></i>
                                    Brach Office
                                </span>
                                <div class="flex items-center">
                                    <span class="size-6 flex items-center justify-center rounded-full me-2">
                                        <img src="{{asset('assets/img/profiles/avatar-12.jpg')}}" class="rounded-full"
                                            alt="Img">
                                    </span>
                                    <p class="text-gray-9 mb-0">{{$employee->branch->name}}</p>
                                </div>
                            </div>

                        </div>
                        <div class="p-4 border-b border-borderColor">
                            <div class="flex items-center justify-between mb-2">
                                <h6>Basic information</h6>

                            </div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="inline-flex items-center">
                                    <i class="ti ti-phone me-2"></i>
                                    Phone
                                </span>
                                <p class="text-dark">{{$employee->contact_number}}</p>
                            </div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="inline-flex items-center">
                                    <i class="ti ti-phone me-2"></i>
                                    Alternative Phone
                                </span>
                                <p class="text-dark">{{$employee->alternative_phone_number}}</p>
                            </div>

                            <div class="flex items-center justify-between mb-2">
                                <span class="inline-flex items-center">
                                    <i class="ti ti-gender-male me-2"></i>
                                    Gender
                                </span>
                                <p class="text-dark text-end">{{ucfirst($employee->gender)}}</p>
                            </div>

                            <div class="flex items-center justify-between">
                                <span class="inline-flex items-center">
                                    <i class="ti ti-map-pin-check me-2"></i>
                                    Address
                                </span>
                                <p class="text-dark text-end">{{$employee->local_address}}</p>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="resize-sensor"
                    style="position: absolute; inset: 0px; overflow: hidden; z-index: -1; visibility: hidden;">
                    <div class="resize-sensor-expand"
                        style="position: absolute; left: 0; top: 0; right: 0; bottom: 0; overflow: hidden; z-index: -1; visibility: hidden;">
                        <div
                            style="position: absolute; left: 0px; top: 0px; transition: all; width: 426px; height: 1058px;">
                        </div>
                    </div>
                    <div class="resize-sensor-shrink"
                        style="position: absolute; left: 0; top: 0; right: 0; bottom: 0; overflow: hidden; z-index: -1; visibility: hidden;">
                        <div style="position: absolute; left: 0; top: 0; transition: 0s; width: 200%; height: 200%">
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                                    @foreach ($installments as $item)
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
