<div class="flex-grow min-h-full">
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
                            <img src="{{ customAsset($employee->photo, true, 'emp', $employee->first_name) }}"
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
                        @if ($isEdit)
                        <div class="p-4">
                            <form wire:submit.prevent="save">

                                {{-- Basic Information --}}
                                <div class="border-b mb-3 pb-3">
                                    <h6 class="mb-3">Basic Information</h6>

                                    {{-- First Name --}}
                                    <div class="mb-3">
                                        <label>First Name</label>
                                        <input type="text" wire:model="first_name" class="form-control">
                                        @error('first_name')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- Last Name --}}
                                    <div class="mb-3">
                                        <label>Last Name</label>
                                        <input type="text" wire:model="last_name" class="form-control">
                                        @error('last_name')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- Email --}}
                                    <div class="mb-3">
                                        <label>Email</label>
                                        <input type="email" wire:model="email" class="form-control">
                                        @error('email')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- Phone Number --}}
                                    <div class="mb-3">
                                        <label>Phone Number</label>
                                        <input type="text" wire:model="contact_number" class="form-control">
                                        @error('contact_number')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- local_address --}}
                                    <div class="mb-3">
                                        <label>local_address</label>
                                        <input type="text" wire:model="local_address" class="form-control">
                                        @error('local_address')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- Photo --}}
                                    <div class="mb-3">
                                        <label>Profile Photo</label>
                                        <input type="file" wire:model="photo" class="form-control">
                                        @error('photo')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                        {{-- Preview --}}
                                        @if (!empty(Auth::guard('employee')->user()->photo))
                                            <div class="mt-2">
                                                <img src="{{ customAsset(Auth::guard('employee')->user()->photo, true, 'user') }}"
                                                    width="80">
                                            </div>
                                        @endif
                                        @if ($photo)
                                            <div class="mt-2">
                                                <img src="{{ $photo->temporaryUrl() }}" width="80">
                                            </div>
                                        @endif

                                    </div>
                                </div>

                                {{-- Change Password --}}
                                <div class="border-b mb-3 pb-3">
                                    <h6 class="mb-3">Change Password</h6>

                                    {{-- New Password --}}
                                    <div class="mb-3">
                                        <label>New Password</label>
                                        <input type="password" wire:model="password" class="form-control">
                                        @error('password')
                                            <span class="text-danger text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- Confirm Password --}}
                                    <div class="mb-3">
                                        <label>Confirm Password</label>
                                        <input type="password" wire:model="password_confirmation" class="form-control">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                        @else
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
                                    <a href="javascript:void(0);"
                                        class="text-dark">{{ $employee->department->name }}</a>
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
                                            <img src="{{ asset('assets/img/profiles/avatar-12.jpg') }}"
                                                class="rounded-full" alt="Img">
                                        </span>
                                        <p class="text-gray-9 mb-0">{{ $employee->branch->name }}</p>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-2">
                                    <a wire:click="toggleEdit" href="javascript:void(0);" data-modal-toggle="editProfile"
                                        data-modal-target="editProfile"
                                        class="flex items-center justify-center btn bg-dark text-sm font-medium py-2 rounded text-white px-3 hover:bg-black hover:text-white">
                                        <i class="ti ti-edit me-1"></i>Edit Info
                                    </a>
                                    
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
                                    <p class="text-dark">{{ $employee->contact_number }}</p>
                                </div>
                                <div class="flex items-center justify-between mb-2">
                                    <span class="inline-flex items-center">
                                        <i class="ti ti-phone me-2"></i>
                                        Alternative Phone
                                    </span>
                                    <p class="text-dark">{{ $employee->alternative_phone_number }}</p>
                                </div>
                              
                                <div class="flex items-center justify-between mb-2">
                                    <span class="inline-flex items-center">
                                        <i class="ti ti-gender-male me-2"></i>
                                        Gender
                                    </span>
                                    <p class="text-dark text-end">{{ ucfirst($employee->gender) }}</p>
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    <span class="inline-flex items-center">
                                        <i class="ti ti-map-pin-check me-2"></i>
                                        Address
                                    </span>
                                    <p class="text-dark text-end">{{ $employee->local_address }}</p>
                                </div>
                            </div>
                        @endif
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
        <div class="xl:col-span-8" wire:ignore>
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
                                                    Account Holder Name
                                                </span>
                                                <h6 class="flex items-center fw-medium mt-1">
                                                    {{ $employee->account_holder_name }}
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

</div>
