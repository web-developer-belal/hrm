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
                                    <p class="text-dark">{{ $employee->joining_date->format('d-M-Y') }}</p>
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
                                    <a href="#" wire:click="viewSalary"
                                        class="flex items-center bg-primary text-sm font-medium py-2 rounded text-white px-3 hover:bg-primary-900 hover:text-white justify-center">
                                        <i class="ti ti-circle-plus me-2"></i>Salary
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
        <div class="xl:col-span-8">
            <!-- Bank Information Card -->
            <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white mb-6">
                <div class="card-header p-5 border-b border-borderColor">
                    <h5 class="card-title">Bank Information</h5>
                </div>
                <div class="card-body p-5">
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-y-4 gap-x-6">
                        <div class="md:col-span-3">
                            <span class="inline-flex items-center text-gray-600 text-sm">
                                Bank Name
                            </span>
                            <h6 class="flex items-center fw-medium mt-1">
                                {{ $employee->bank_name }}
                            </h6>
                        </div>
                        <div class="md:col-span-3">
                            <span class="inline-flex items-center text-gray-600 text-sm">
                                Account Holder Name
                            </span>
                            <h6 class="flex items-center fw-medium mt-1">
                                {{ $employee->account_holder_name }}
                            </h6>
                        </div>
                         <div class="md:col-span-3">
                                <span class="inline-flex items-center text-gray-600 text-sm">
                                MFS Account number
                                </span>
                                <h6 class="flex items-center fw-medium mt-1">
                                    {{ $employee->mfs_account }}
                                </h6>
                            </div>
                        <div class="md:col-span-3">
                            <span class="inline-flex items-center text-gray-600 text-sm">
                                Bank account no
                            </span>
                            <h6 class="flex items-center fw-medium mt-1">
                                {{ $employee->account_number }}</h6>
                        </div>
                        <div class="md:col-span-3">
                            <span class="inline-flex items-center text-gray-600 text-sm">
                                Routing No
                            </span>
                            <h6 class="flex items-center fw-medium mt-1">
                                {{ $employee->routing_number }}</h6>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Employee Documents Card -->
            <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white mb-6">
                <div class="card-header p-5 border-b border-borderColor">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center">
                                <i class="ti ti-file-text text-blue-500 fs-18"></i>
                            </div>
                            <h5 class="text-lg font-semibold text-gray-800">Employee Documents</h5>
                            @php
                                $documentCount = 0;
                                $docFields = ['resume', 'offer_letter', 'joining_letter', 'contract_agreement', 'id_proof', 'checkbook'];
                                foreach($docFields as $field) {
                                    if(!empty($employee->$field) && Storage::disk('public')->exists($employee->$field)) {
                                        $documentCount++;
                                    }
                                }
                            @endphp
                            <span class="bg-blue-100 text-blue-600 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                {{ $documentCount }} Files
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-body p-6">
                    @php
                        $documents = [
                            ['name' => 'Resume', 'field' => 'resume', 'icon' => 'ti ti-file-text'],
                            ['name' => 'Offer Letter', 'field' => 'offer_letter', 'icon' => 'ti ti-file-description'],
                            ['name' => 'Joining Letter', 'field' => 'joining_letter', 'icon' => 'ti ti-file-check'],
                            ['name' => 'Contract', 'field' => 'contract_agreement', 'icon' => 'ti ti-file-signature'],
                            ['name' => 'ID Proof', 'field' => 'id_proof', 'icon' => 'ti ti-id'],
                            ['name' => 'Checkbook', 'field' => 'checkbook', 'icon' => 'ti ti-book']
                        ];
                    @endphp

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4">
                        @foreach($documents as $doc)
                            @php
                                $fileName = $employee->{$doc['field']} ?? null;
                                $fileExists = !empty($fileName) && Storage::disk('public')->exists($fileName);
                                $fileUrl = $fileExists ? Storage::url($fileName) : null;
                                $extension = $fileName ? pathinfo($fileName, PATHINFO_EXTENSION) : '';
                            @endphp

                            <div class="group relative bg-gray-50 rounded-xl p-4 hover:bg-gray-100 transition-all duration-200 {{ !$fileExists ? 'opacity-60' : '' }}">
                                <!-- Document Icon -->
                                <div class="flex items-start justify-between mb-3">
                                    <div class="w-10 h-10 rounded-lg {{ $fileExists ? 'bg-blue-100 text-blue-600' : 'bg-gray-200 text-gray-400' }} flex items-center justify-center">
                                        <i class="{{ $doc['icon'] }} fs-20"></i>
                                    </div>

                                    @if($fileExists)
                                        <span class="text-xs font-medium px-2 py-1 rounded-full bg-green-100 text-green-600">
                                            {{ strtoupper($extension) }}
                                        </span>
                                    @else
                                        <span class="text-xs font-medium px-2 py-1 rounded-full bg-gray-200 text-gray-500">
                                            Missing
                                        </span>
                                    @endif
                                </div>

                                <!-- Document Info -->
                                <h6 class="font-medium text-gray-800 mb-1">{{ $doc['name'] }}</h6>
                                <p class="text-xs text-gray-500 mb-3 truncate">
                                    {{ $fileExists ? $fileName : 'No file uploaded' }}
                                </p>

                                <!-- Action Button -->
                                @if($fileExists)
                                    <a href="{{ $fileUrl }}"
                                    target="_blank"
                                    class="inline-flex items-center justify-center w-full px-3 py-2 text-sm font-medium text-blue-600 bg-white border border-blue-200 rounded-lg hover:bg-blue-50 hover:border-blue-300 transition-all duration-200 group-hover:shadow-sm">
                                        <i class="ti ti-eye mr-2 fs-16"></i>
                                        View Document
                                        <i class="ti ti-external-link ml-2 fs-14 opacity-0 group-hover:opacity-100 transition-opacity duration-200"></i>
                                    </a>
                                @else
                                    <button disabled
                                            class="inline-flex items-center justify-center w-full px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-200 rounded-lg cursor-not-allowed">
                                        <i class="ti ti-cloud-off mr-2 fs-16"></i>
                                        Not Available
                                    </button>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <!-- Quick Actions Footer -->
                    <div class="mt-6 pt-4 border-t border-gray-100 flex items-center justify-between">
                        <p class="text-sm text-gray-500">
                            <i class="ti ti-info-circle mr-1"></i>
                            Click on any document to view or download
                        </p>
                        <div class="flex space-x-2">
                            <button onclick="downloadAllDocuments()"
                                    class="px-3 py-1.5 text-sm text-gray-600 hover:text-gray-800 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors duration-150">
                                <i class="ti ti-download mr-1"></i>
                                Download All
                            </button>
                            <button onclick="uploadDocument()"
                                    class="px-3 py-1.5 text-sm text-blue-600 hover:text-blue-700 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors duration-150">
                                <i class="ti ti-upload mr-1"></i>
                                Upload New
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Salary Modal --}}
    @if ($salaryModalshow)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 transition-opacity duration-200">
            <div data-modal-overlay class="absolute inset-0 bg-black/50"></div>

            <div
                class="relative bg-white rounded-lg shadow-xl w-full max-w-4xl salary-modal-panel-max overflow-hidden transition-all duration-200">
                <div class="px-5 py-4 border-b border-borderColor flex items-center justify-between">
                    <div>
                        <h5 class="mb-1">Salary Information</h5>
                        <p class="text-xs text-gray-500">{{ $employee->full_name }}</p>
                    </div>
                    <button type="button" wire:click="closeModal"
                        class="size-8 flex items-center justify-center rounded-md hover:bg-gray-100 text-gray-600">
                        <i class="ti ti-x"></i>
                    </button>
                </div>

                <div class="p-5 overflow-y-auto salary-modal-form-scroll max-h-96">
                    @if ($salary)
                        <div class="space-y-4">
                            {{-- Salary Addition Section --}}
                            <div class="border rounded-md border-borderColor p-4 bg-gray-50">
                                <h6 class="font-medium mb-3">Salary Addition</h6>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                    <div>
                                        <label class="text-sm text-gray-600">Basic Salary</label>
                                        <p class="text-lg font-semibold text-gray-900">{{ number_format($salary->basic_salary, 2) }}</p>
                                    </div>
                                    <div>
                                        <label class="text-sm text-gray-600">House Rent</label>
                                        <p class="text-lg font-semibold text-gray-900">{{ number_format($salary->house_rent, 2) }}</p>
                                    </div>
                                    <div>
                                        <label class="text-sm text-gray-600">Medical Allowance</label>
                                        <p class="text-lg font-semibold text-gray-900">{{ number_format($salary->medical_allowance, 2) }}</p>
                                    </div>
                                    <div>
                                        <label class="text-sm text-gray-600">Dear Allowance</label>
                                        <p class="text-lg font-semibold text-gray-900">{{ number_format($salary->dear_allowance, 2) }}</p>
                                    </div>
                                    <div>
                                        <label class="text-sm text-gray-600">Transport Allowance</label>
                                        <p class="text-lg font-semibold text-gray-900">{{ number_format($salary->transport_allowance, 2) }}</p>
                                    </div>
                                    <div>
                                        <label class="text-sm text-gray-600">Provident Fund (Employer)</label>
                                        <p class="text-lg font-semibold text-gray-900">{{ number_format($salary->pf_employer_contribution, 2) }}</p>
                                    </div>
                                    <div>
                                        <label class="text-sm text-gray-600">Other Allowance</label>
                                        <p class="text-lg font-semibold text-gray-900">{{ number_format($salary->other_allowance, 2) }}</p>
                                    </div>
                                </div>
                            </div>

                            {{-- Salary Deduction Section --}}
                            <div class="border rounded-md border-borderColor p-4 bg-gray-50">
                                <h6 class="font-medium mb-3">Salary Deduction</h6>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                    <div>
                                        <label class="text-sm text-gray-600">PF Employee Contribution</label>
                                        <p class="text-lg font-semibold text-gray-900">{{ number_format($salary->pf_employee_contribution, 2) }}</p>
                                    </div>
                                    <div>
                                        <label class="text-sm text-gray-600">Welfare Contribution</label>
                                        <p class="text-lg font-semibold text-gray-900">{{ number_format($salary->welfare_contribution, 2) }}</p>
                                    </div>
                                    <div>
                                        <label class="text-sm text-gray-600">Tax Deduction</label>
                                        <p class="text-lg font-semibold text-gray-900">{{ number_format($salary->tax_deduction, 2) }}</p>
                                    </div>
                                </div>
                            </div>

                            {{-- Total Section --}}
                            @php
                                $totalAddition = ($salary->basic_salary ?? 0) + ($salary->house_rent ?? 0) + ($salary->medical_allowance ?? 0) + 
                                                ($salary->dear_allowance ?? 0) + ($salary->transport_allowance ?? 0) + 
                                                ($salary->pf_employer_contribution ?? 0) + ($salary->other_allowance ?? 0);
                                $totalDeduction = ($salary->pf_employee_contribution ?? 0) + ($salary->welfare_contribution ?? 0) + ($salary->tax_deduction ?? 0);
                                $netSalary = $totalAddition - $totalDeduction;
                            @endphp
                            <div class="border rounded-md border-gray-300 p-4 bg-gradient-to-r from-blue-50 to-blue-100">
                                <div class="grid grid-cols-3 gap-3">
                                    <div class="text-center">
                                        <label class="text-sm text-gray-600">Total Addition</label>
                                        <p class="text-2xl font-bold text-green-600">{{ number_format($totalAddition, 2) }}</p>
                                    </div>
                                    <div class="text-center">
                                        <label class="text-sm text-gray-600">Total Deduction</label>
                                        <p class="text-2xl font-bold text-red-600">{{ number_format($totalDeduction, 2) }}</p>
                                    </div>
                                    <div class="text-center">
                                        <label class="text-sm text-gray-600">Net Salary</label>
                                        <p class="text-2xl font-bold text-blue-600">{{ number_format($netSalary, 2) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <i class="ti ti-alert-circle text-4xl text-gray-400 mb-3"></i>
                            <p class="text-gray-600">No salary information available</p>
                        </div>
                    @endif
                </div>

                <div class="px-5 py-4 border-t border-borderColor bg-gray-50 flex justify-end gap-2">
                    <button type="button" wire:click="closeModal"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                        Close
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
