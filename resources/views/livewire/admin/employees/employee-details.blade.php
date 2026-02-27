<div>
    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">Employee Details</h2>
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
                        Employee Details
                    </li>
                </ol>
            </nav>
        </div>

        <div class="flex my-xl-auto right-content items-center flex-wrap ">
            <div class="mb-2">
                <a href="#" wire:click="addOrUpdateSalary"
                    class="flex items-center bg-primary text-sm font-medium py-2 rounded text-white px-3 hover:bg-primary-900 hover:text-white">
                    <i class="ti ti-circle-plus me-2"></i>Salary
                </a>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <div class="grid grid-cols-1 gap-6 xl:grid-cols-12" style="transform: none;">
        <div class="xl:col-span-4 "
            style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">



            <div class="" style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none;">
                <div class="card mb-5 border border-borderColor rounded-[5px] shadow-xs bg-white">
                    <div
                        class="card-body z-[1] p-0 pt-[50px] relative before:bg-[url({{ asset('assets/img/bg/card-bg.png') }})] before:top-0 before:left-0 before:right-0 before:w-full before:h-[90px] before:absolute before:block before:bg-cover before:rounded-defaultradius before:content-[''] before:z-0">
                        <span
                            class="size-[60px] flex items-center justify-center rounded-full border-2 border-white m-auto mb-2  relative z-[1]">
                            <img src="{{ customAsset($employee->photo, true, 'emp', $employee->first_anme) }}"
                                class="rounded-full" alt="Img">
                        </span>
                        <div class="text-center px-4 pb-4 border-b border-borderColor relative z-[1]">
                            <h5 class="flex items-center justify-center mb-1">
                                {{ $employee->first_name . ' ' . $employee->last_name }}<i
                                    class="ti ti-discount-check-filled text-success ms-1"></i></h5>

                            <span
                                class="inline-flex items-center py-1 px-2 text-xs font-medium rounded text-dark bg-dark-transparent mb-1">
                                <i class="ti ti-point-filled me-1 "></i>{{ $employee->designation->name }}
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
                                <p class="text-dark">{{ $employee->employee_code }}</p>
                            </div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="inline-flex items-center">
                                    <i class="ti ti-star me-2"></i>
                                    Department
                                </span>
                                <a href="javascript:void(0);" class="text-dark">{{ $employee->department->name }}</a>
                            </div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="inline-flex items-center">
                                    <i class="ti ti-calendar-check me-2"></i>
                                    Date Of Join
                                </span>
                                <p class="text-dark">{{ $employee->joining_date->format('d M Y') }}</p>
                            </div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="inline-flex items-center">
                                    <i class="ti ti-calendar-check me-2"></i>
                                    Brach Office
                                </span>
                                <div class="flex items-center">
                                    <span class="size-6 flex items-center justify-center rounded-full me-2">
                                        <img src="{{ asset('assets/img/profiles/avatar-12.jpg') }}" class="rounded-full"
                                            alt="Img">
                                    </span>
                                    <p class="text-gray-9 mb-0">{{ $employee->branch->name }}</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-2">
                                <a href="javascript:void(0);" data-modal-toggle="edit_employee"
                                    data-modal-target="edit_employee"
                                    class="flex items-center justify-center btn bg-dark text-sm font-medium py-2 rounded text-white px-3 hover:bg-black hover:text-white">
                                    <i class="ti ti-edit me-1"></i>Edit Info
                                </a>
                                <a href="chat.html"
                                    class="flex items-center justify-center btn bg-primary text-sm font-medium py-2 rounded text-white px-3 hover:bg-primary-900 hover:text-white">
                                    <i class="ti ti-message-heart me-1"></i>Message
                                </a>
                            </div>
                        </div>
                        <div class="p-4 border-b border-borderColor">
                            <div class="flex items-center justify-between mb-2">
                                <h6>Basic information</h6>
                                {{-- <a href="javascript:void(0);" data-modal-toggle="edit_employee"
                                    data-modal-target="edit_employee"
                                    class="size-6 flex items-center justify-center rounded-defaultradius text-xs leading-normal text-gray-900 hover:bg-dark-transparent hover:text-dark"><i
                                        class="ti ti-edit"></i></a> --}}
                            </div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="inline-flex items-center">
                                    <i class="ti ti-phone me-2"></i>
                                    Phone
                                </span>
                                <p class="text-dark">{{ $employee->contact_number }}</p>
                            </div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="inline-flex items-center">
                                    <i class="ti ti-phone me-2"></i>
                                    Alternative Phone
                                </span>
                                <p class="text-dark">{{ $employee->alternative_phone_number }}</p>
                            </div>
                            {{-- <div class="flex items-center justify-between mb-2">
                                <span class="inline-flex items-center">
                                    <i class="ti ti-mail-check me-2"></i>
                                    Email
                                </span>
                                <a href="javascript:void(0);" class="text-info inline-flex items-center"><span
                                        class="__cf_email__"
                                        data-cfemail="7505100707141901444735100d14180519105b161a18">[email&nbsp;protected]</span><i
                                        class="ti ti-copy text-dark ms-2"></i></a>
                            </div> --}}
                            <div class="flex items-center justify-between mb-2">
                                <span class="inline-flex items-center">
                                    <i class="ti ti-gender-male me-2"></i>
                                    Gender
                                </span>
                                <p class="text-dark text-end">{{ ucfirst($employee->gender) }}</p>
                            </div>
                            {{-- <div class="flex items-center justify-between">
                                <span class="inline-flex items-center">
                                    <i class="ti ti-cake me-2"></i>
                                    Birdthday
                                </span>
                                <p class="text-dark text-end">{{$employee->alternative_phone_number}}</p>
                            </div> --}}
                            <div class="flex items-center justify-between">
                                <span class="inline-flex items-center">
                                    <i class="ti ti-map-pin-check me-2"></i>
                                    Address
                                </span>
                                <p class="text-dark text-end">{{ $employee->local_address }}</p>
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
                <div class="tab-content custom-accordion-items">
                    <div class="tab-pane active show" id="bottom-justified-tab1" role="tabpanel">
                        <div class="accordion accordions-items-seperate" id="accordionExample"
                            data-accordion="collapse">

                            <div class="accordion-item bg-white rounded mb-5">
                                <div class="accordion-header" id="headingTwo">
                                    <div class="accordion-button border-b p-5">
                                        <div class="flex items-center flex-fill">
                                            <h5>Bank Information</h5>

                                            <a href="#"
                                                class="ms-auto flex items-center bg-white collapsearrow text-gray-500 dark:text-gray-400"
                                                data-accordion-toggle="primaryBorderTwo"
                                                data-accordion-target="#primaryBorderTwo" aria-expanded="true"
                                                aria-controls="primaryBorderTwo">
                                                <i class="ti ti-chevron-down fs-18"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div id="primaryBorderTwo" class="hidden text-dark" aria-labelledby="headingTwo">
                                    <div class="accordion-body p-5">
                                        <div class="grid grid-cols-1 md:grid-cols-12 gap-y-4 gap-x-6">
                                            <div class="md:col-span-3">
                                                <span class="inline-flex items-center">
                                                    Bank Name
                                                </span>
                                                <h6 class="flex items-center fw-medium mt-1">
                                                    {{ $employee->bank_name }}
                                                </h6>
                                            </div>
                                            <div class="md:col-span-3">
                                                <span class="inline-flex items-center">
                                                    Bank account no
                                                </span>
                                                <h6 class="flex items-center fw-medium mt-1">
                                                    {{ $employee->account_number }}</h6>
                                            </div>
                                            <div class="md:col-span-3">
                                                <span class="inline-flex items-center">
                                                    Routing No
                                                </span>
                                                <h6 class="flex items-center fw-medium mt-1">
                                                    {{ $employee->routing_number }}</h6>
                                            </div>
                                            {{-- <div class="md:col-span-3">
                                                <span class="inline-flex items-center">
                                                    Branch
                                                </span>
                                                <h6 class="flex items-center fw-medium mt-1">{{$employee->bank_name}}</h6>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="tab-pane " id="bottom-justified-tab1" role="tabpanel">
                        <div class="accordion accordions-items-seperate" id="accordionExample"
                            data-accordion="collapse">

                            <div class="accordion-item bg-white rounded mb-5">
                                <div class="accordion-header" id="headingTwo">
                                    <div class="accordion-button border-b p-5">
                                        <div class="flex items-center flex-fill">
                                            <h5>Document</h5>

                                            <a href="#"
                                                class="ms-auto flex items-center bg-white collapsearrow text-gray-500 dark:text-gray-400"
                                                data-accordion-toggle="empDocument"
                                                data-accordion-target="#empDocument" aria-expanded="true"
                                                aria-controls="empDocument">
                                                <i class="ti ti-chevron-down fs-18"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div id="empDocument" class="hidden text-dark" aria-labelledby="headingTwo">
                                    <div class="accordion-body p-5">
                                        <div class="grid grid-cols-1 md:grid-cols-12 gap-y-4 gap-x-6">

                                            @php
                                                use Illuminate\Support\Facades\File;

                                                $resume = File::extension($employee->resume);
                                                $offerletter = File::extension($employee->offer_letter);
                                                $Joingletter = File::extension($employee->joining_letter);
                                                $Contract = File::extension($employee->contract_agreement);
                                                $idproof = File::extension($employee->Id_proof);

                                            @endphp
                                            <div class="md:col-span-2">
                                                <span class="inline-flex items-center">
                                                    Resume
                                                </span>
                                                <h6 class="flex items-center fw-medium mt-1">
                                                    <a href="{{ documentAsset($employee->resume) }}" target="_blank"
                                                        class="btn btn-info"> View {{ getDocumentIcon($resume) }}</a>

                                                </h6>
                                            </div>
                                            <div class="md:col-span-2">
                                                <span class="inline-flex items-center">
                                                    Offer Letter
                                                </span>
                                                <h6 class="flex items-center fw-medium mt-1">
                                                    <a href="{{ documentAsset($employee->offer_letter) }}"
                                                        target="_blank" class="btn btn-info"> View
                                                        {{ getDocumentIcon($offerletter) }}</a>

                                                </h6>
                                            </div>
                                            <div class="md:col-span-2">
                                                <span class="inline-flex items-center">
                                                    joining Letter
                                                </span>
                                                <h6 class="flex items-center fw-medium mt-1">
                                                    <a href="{{ documentAsset($employee->joining_letter) }}"
                                                        target="_blank" class="btn btn-info"> View
                                                        {{ getDocumentIcon($Joingletter) }}</a>

                                                </h6>
                                            </div>
                                            <div class="md:col-span-2">
                                                <span class="inline-flex items-center">
                                                    Contract
                                                </span>
                                                <h6 class="flex items-center fw-medium mt-1">
                                                    <a href="{{ documentAsset($employee->contract_agreement) }}"
                                                        target="_blank" class="btn btn-info"> View
                                                        {{ getDocumentIcon($Contract) }}</a>

                                                </h6>
                                            </div>
                                            <div class="md:col-span-2">
                                                <span class="inline-flex items-center">
                                                    ID Proof
                                                </span>
                                                <h6 class="flex items-center fw-medium mt-1">
                                                    <a href="{{ documentAsset($employee->Id_proof) }}"
                                                        target="_blank" class="btn btn-info"> View
                                                        {{ getDocumentIcon($idproof) }}</a>

                                                </h6>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- modal On --}}

    @if ($salaryModalshow)
        <div class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[1055] justify-center items-center flex-wrap w-full md:inset-0 h-[calc(100%-1rem)] max-h-full transition-all duration-300 ease-in-out modal p-4 flex"
            data-select2-id="select2-data-add_bank_satutory" aria-modal="true" role="dialog">
            <div class="relative p-4 w-full max-w-[800px] max-h-full" data-select2-id="select2-data-32-9dal">
                <div class="relative bg-white rounded-defaultradius">
                    <div class="flex items-center justify-between p-4 border-b border-borderColor">
                        <h4 class="font-semibold">Bank &amp; Statutory</h4>
                        <button type="button"
                            class="end-2.5 text-white bg-gray-500 hover:bg-danger hover:text-white rounded-full text-xs leading-normal size-5 ms-auto inline-flex justify-center items-center"
                            data-modal-hide="add_bank_satutory">
                            <i class="ti ti-x" wire:click="closeModal"></i>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <form wire:submit="addOrUpdateSalarySubmit">
                        <div class="p-4" data-select2-id="select2-data-30-25jf">
                            <div class="border-b mb-4">
                                <h5 class="mb-3">Salary Information (Addition)</h5>
                                <div class="grid grid-cols-1 md:grid-cols-12 gap-y-4 gap-x-6 mb-2">

                                    <div class="md:col-span-4">


                                        <div class="mb-3">
                                            <label
                                                class="block mb-1 text-sm leading-normal font-medium text-title">Salary
                                                basic</label>
                                            <input type="text" wire:model.live="basicSalary"
                                                class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
                                            @error('basicSalary')
                                                <span>{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="md:col-span-4">
                                        <div class="mb-3">
                                            <label
                                                class="block mb-1 text-sm leading-normal font-medium text-title">Percent
                                                %</label>

                                        </div>
                                    </div>
                                    <div class="md:col-span-4">
                                        <div class="mb-3">
                                            <label
                                                class="block mb-1 text-sm leading-normal font-medium text-title">Fixed
                                                Amount</label>

                                        </div>
                                    </div>

                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-12 gap-y-4 gap-x-6 mb-2">

                                    <div class="md:col-span-4">
                                        <div class="mb-3">
                                            <label
                                                class="block mb-1 text-sm leading-normal font-medium text-title">House
                                                Rent</label>

                                        </div>
                                    </div>
                                    <div class="md:col-span-4">
                                        <div class="mb-3">
                                            <input type="text" wire:model.live="houseRentPercent"
                                                class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
                                            @error('houseRentPercent')
                                                <span>{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="md:col-span-4">
                                        <div class="mb-3">
                                            <input type="text" wire:model.live="houseRentAmount"
                                                class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
                                            @error('houseRentAmount')
                                                <span>{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-12 gap-y-4 gap-x-6 mb-2">

                                    <div class="md:col-span-4">
                                        <div class="mb-3">
                                            <label
                                                class="block mb-1 text-sm leading-normal font-medium text-title">Medical
                                                Allowance</label>

                                        </div>
                                    </div>
                                    <div class="md:col-span-4">
                                        <div class="mb-3">

                                            <input type="text" wire:model.live="medicalAllowancePercent"
                                                class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
                                            @error('medicalAllowancePercent')
                                                <span>{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="md:col-span-4">
                                        <div class="mb-3">

                                            <input type="text" wire:model.live="medicalAllowanceAmount"
                                                class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
                                            @error('medicalAllowanceAmount')
                                                <span>{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-12 gap-y-4 gap-x-6 mb-2">

                                    <div class="md:col-span-4">
                                        <div class="mb-3">
                                            <label
                                                class="block mb-1 text-sm leading-normal font-medium text-title">Dear
                                                Allowance</label>

                                        </div>
                                    </div>
                                    <div class="md:col-span-4">
                                        <div class="mb-3">

                                            <input type="text" wire:model.live="dearAllowancePercent"
                                                class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
                                            @error('dearAllowancePercent')
                                                <span>{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="md:col-span-4">
                                        <div class="mb-3">

                                            <input type="text" wire:model.live="dearAllowanceAmout"
                                                class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
                                            @error('dearAllowanceAmout')
                                                <span>{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-12 gap-y-4 gap-x-6 mb-2">

                                    <div class="md:col-span-4">
                                        <div class="mb-3">
                                            <label
                                                class="block mb-1 text-sm leading-normal font-medium text-title">Transport
                                                Allowance</label>

                                        </div>
                                    </div>
                                    <div class="md:col-span-4">
                                        <div class="mb-3">

                                            <input type="text" wire:model.live="transportAllowancePercent"
                                                class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
                                            @error('transportAllowancePercent')
                                                <span>{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="md:col-span-4">
                                        <div class="mb-3">

                                            <input type="text" wire:model.live="transportAllowanceAmount"
                                                class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
                                            @error('transportAllowanceAmount')
                                                <span>{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-12 gap-y-4 gap-x-6 mb-2">

                                    <div class="md:col-span-4">
                                        <div class="mb-3">
                                            <label
                                                class="block mb-1 text-sm leading-normal font-medium text-title">Provident
                                                Fund</label>

                                        </div>
                                    </div>
                                    <div class="md:col-span-4">
                                        <div class="mb-3">

                                            <input type="text" wire:model.live="pfEployerContributionPercent"
                                                class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
                                            @error('pfEployerContributionPercent')
                                                <span>{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="md:col-span-4">
                                        <div class="mb-3">

                                            <input type="text" wire:model.live="pfEployerContributionAmount"
                                                class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
                                            @error('pfEployerContributionAmount')
                                                <span>{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-12 gap-y-4 gap-x-6 mb-2">

                                    <div class="md:col-span-4">
                                        <div class="mb-3">
                                            <label
                                                class="block mb-1 text-sm leading-normal font-medium text-title">Other
                                                Allowance</label>

                                        </div>
                                    </div>
                                    <div class="md:col-span-4">
                                        <div class="mb-3">

                                            <input type="text" wire:model.live="otherAllowancePercent"
                                                class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
                                            @error('otherAllowancePercent')
                                                <span>{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="md:col-span-4">
                                        <div class="mb-3">

                                            <input type="text" wire:model.live="otherAllowanceAmount"
                                                class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">

                                            @error('otherAllowanceAmount')
                                                <span>{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="border-bottom mb-4">
                                <h5 class="mb-3">Salary Deduction</h5>
                                <div class="row mb-2">
                                    <div class="grid grid-cols-1 md:grid-cols-12 gap-y-4 gap-x-6 mb-2">

                                        <div class="md:col-span-4">
                                            <div class="mb-3">
                                                <label
                                                    class="block mb-1 text-sm leading-normal font-medium text-title">PF
                                                    Employee Contributon</label>

                                            </div>
                                        </div>
                                        <div class="md:col-span-4">
                                            <div class="mb-3">

                                                <input type="text" wire:model.live="pfEmployeeContributionPercent"
                                                    class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">

                                                @error('pfEmployeeContributionPercent')
                                                    <span>{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="md:col-span-4">
                                            <div class="mb-3">

                                                <input type="text" wire:model.live="pfEmployeeContributionAmount"
                                                    class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
                                                @error('pfEmployeeContributionAmount')
                                                    <span>{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-12 gap-y-4 gap-x-6 mb-2">

                                        <div class="md:col-span-4">
                                            <div class="mb-3">
                                                <label
                                                    class="block mb-1 text-sm leading-normal font-medium text-title">Welface
                                                    Contributon</label>

                                            </div>
                                        </div>
                                        <div class="md:col-span-4">
                                            <div class="mb-3">

                                                <input type="text" wire:model.live="welfareContributionPercnet"
                                                    class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
                                                @error('welfareContributionPercnet')
                                                    <span>{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="md:col-span-4">
                                            <div class="mb-3">

                                                <input type="text" wire:model.live="welfareContributionAmount"
                                                    class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
                                                @error('welfareContributionAmount')
                                                    <span>{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-12 gap-y-4 gap-x-6 mb-2">

                                        <div class="md:col-span-4">
                                            <div class="mb-3">
                                                <label
                                                    class="block mb-1 text-sm leading-normal font-medium text-title">Tax
                                                    Deduction</label>

                                            </div>
                                        </div>
                                        <div class="md:col-span-4">
                                            <div class="mb-3">

                                                <input type="text" wire:model.live="taxDeductionPercent"
                                                    class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
                                                @error('taxDeductionPercent')
                                                    <span>{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="md:col-span-4">
                                            <div class="mb-3">

                                                <input type="text" wire:model.live="taxDeductionAmount"
                                                    class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
                                                @error('taxDeductionAmount')
                                                    <span>{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>



                                </div>
                            </div>
                            <h5 class="mb-3">Total Salary</h5>
                            <div class="row">
                                <div class="grid grid-cols-1 md:grid-cols-12 gap-y-4 gap-x-6 mb-2">

                                    <div class="md:col-span-2">
                                        <div class="mb-3">
                                            <label
                                                class="block mb-1 text-sm leading-normal font-medium text-title">Basic</label>
                                            <input type="text" readonly wire:model="basic_salary"
                                                class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
                                        </div>
                                    </div>
                                    <div class="md:col-span-2">
                                        <div class="mb-3">
                                            <label
                                                class="block mb-1 text-sm leading-normal font-medium text-title">House
                                                Rent</label>
                                            <input type="text" readonly wire:model="house_rent"
                                                class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
                                        </div>
                                    </div>
                                    <div class="md:col-span-2">
                                        <div class="mb-3">
                                            <label
                                                class="block mb-1 text-sm leading-normal font-medium text-title">Med.
                                                Allow</label>
                                            <input type="text" readonly wire:model="medical_allowance"
                                                class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
                                        </div>
                                    </div>
                                    <div class="md:col-span-2">
                                        <div class="mb-3">
                                            <label
                                                class="block mb-1 text-sm leading-normal font-medium text-title">Dear
                                                Allow.</label>
                                            <input type="text" readonly wire:model="dear_allowance"
                                                class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
                                        </div>
                                    </div>
                                    <div class="md:col-span-2">
                                        <div class="mb-3">
                                            <label
                                                class="block mb-1 text-sm leading-normal font-medium text-title">TA</label>
                                            <input type="text" readonly wire:model="transport_allowance"
                                                class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
                                        </div>
                                    </div>
                                    <div class="md:col-span-2">
                                        <div class="mb-3">
                                            <label
                                                class="block mb-1 text-sm leading-normal font-medium text-title">PF</label>
                                            <input type="text" readonly wire:model="pf_employer_contribution"
                                                class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
                                        </div>
                                    </div>
                                    <div class="md:col-span-2">
                                        <div class="mb-3">
                                            <label
                                                class="block mb-1 text-sm leading-normal font-medium text-title">Other
                                                Allow</label>
                                            <input type="text" readonly wire:model="other_allowance"
                                                class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
                                        </div>
                                    </div>
                                    <div class="md:col-span-2">
                                        <div class="mb-3">
                                            <label class="block mb-1 text-sm leading-normal font-medium text-title">PF
                                                E (-)</label>
                                            <input type="text" readonly wire:model="pf_employee_contribution"
                                                class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
                                        </div>
                                    </div>
                                    <div class="md:col-span-2">
                                        <div class="mb-3">
                                            <label
                                                class="block mb-1 text-sm leading-normal font-medium text-title">Welfare(-)</label>
                                            <input type="text" readonly wire:model="welfare_contribution"
                                                class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
                                        </div>
                                    </div>
                                    <div class="md:col-span-2">
                                        <div class="mb-3">
                                            <label
                                                class="block mb-1 text-sm leading-normal font-medium text-title">Tax(-)
                                            </label>
                                            <input type="text" readonly wire:model="tax_deduction"
                                                class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
                                        </div>
                                    </div>
                                    <div class="md:col-span-2">
                                        <div class="mb-3">
                                            <label class="block mb-1 text-sm leading-normal font-medium text-title">Net
                                                Salary</label>
                                            <input type="text" readonly wire:model="totalSalary"
                                                class="bg-white border-borderColor text-gray-900 text-sm rounded-input  block w-full py-2 px-2.5 h-[38px] placeholder:text-gray-400">
                                        </div>
                                    </div>


                                </div>

                            </div>
                        </div>
                        <div class="flex items-center justify-end p-4 border-t border-borderColor">
                            <button data-modal-hide="add_bank_satutory" type="button"
                                class="btn bg-light border border-light text-gray-900 text-center hover:bg-light-900 hover:text-gray-900 font-medium me-2"
                                wire:click="closeModal">Cancel</button>
                            <button type="submit"
                                class="btn bg-primary border border-primary text-white text-center hover:bg-primary-900 hover:text-white font-medium">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

</div>
