<div>
    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">{{ $isEditMode ? 'Edit Employee' : 'Create Employee' }}</h2>
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
                        {{ $isEditMode ? 'Edit Employee' : 'Create Employee' }}
                    </li>
                </ol>
            </nav>
        </div>

        <div class="flex my-xl-auto right-content items-center flex-wrap ">
            <div class="mb-2">
                <a href="{{ route('admin.employees.index') }}"
                    class="flex items-center bg-primary text-sm font-medium py-2 rounded text-white px-3 hover:bg-primary-900 hover:text-white">
                    <i class="ti ti-circle-plus me-2"></i>Employees
                </a>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <div class="">
        <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white mb-6">
            <div class="card-header p-5 border-b border-borderColor">
                <h5 class="card-title">{{ $isEditMode ? 'Edit Employee' : 'Create Employee' }}</h5>
            </div>

            <div class="card-body p-5">
                <form wire:submit.prevent="saveEmployee"
                    class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-4">


                    <x-form.input
                    label="Photo"
                    name="photo"

                    :error="true"

                    type="file"
                    />
                    @if ($oldPhoto)
                        <img src="{{ customAsset($oldPhoto) }}" height="200" width="200">
                    @endif
                    @if ($photo)
                        <img src="{{ $photo->temporaryUrl() }}" height="200" width="200">
                    @endif


                    <x-form.select
                    label="Select Branch"
                    name="branch_id"
                    :is_required="true"
                    :error="true"
                    :options="$branches" />


                <x-form.select
                    label="Select Department"
                    name="department_id"
                    :is_required="false"
                    :error="true"
                    :options="$departments" />

                    <x-form.input
                        label="First Name"
                        name="first_name"
                        :is_required="true"
                        :error="true"
                        placeholder="Enter First Name" />

                    <x-form.input
                        label="Last Name"
                        name="last_name"
                        :is_required="false"
                        :error="true"
                        placeholder="Enter Last Name" />

                    <x-form.input
                        label="Employee ID"
                        name="employee_code"
                        :is_required="false"
                        :error="true"
                        placeholder="Enter Employee ID or Code" />


                        <x-form.input
                        label="Joinging Date"
                        name="joining_date"
                        :is_required="true"
                        :error="true"
                        type="date" />

                        <x-form.select
                        label="Select Designation"
                        name="designation_id"
                        :is_required="true"
                        :error="true"
                        :options="$designations" />

                        <x-form.input
                        label="Contact No"
                        name="contact_number"
                        :is_required="true"
                        :error="true"
                        placeholder="Enter Contact No" />

                        <x-form.input
                        label="Alternative Contact No"
                        name="alternative_phone_number"
                        :is_required="false"
                        :error="true"
                        placeholder="Enter Alternative Contact no" />


                            <x-form.select
                            label="Select Gender"
                            name="gender"
                            :is_required="true"
                            :error="true"
                            :options="['male' => 'Male', 'female' => 'Female','other'=>' Other']" />

                            <x-form.input
                            label="Present Address"
                            name="local_address"
                            :is_required="true"
                            :error="true"
                            type="text" />

                            <x-form.input
                            label="Permanent Address"
                            name="permanent_address"
                            :is_required="true"
                            :error="true"
                            type="text" />


                            <x-form.input
                            label="Banks Name"
                            name="bank_name"
                            :is_required="true"
                            :error="true"
                            type="text" />

                            <x-form.input
                            label="Account Holder Name"
                            name="account_holder_name"
                            :is_required="true"
                            :error="true"
                            type="text" />

                            <x-form.input
                            label="Account Number"
                            name="account_number"
                            :is_required="true"
                            :error="true"
                            type="text" />

                            <x-form.input
                            label="Banke Routing Number"
                            name="routing_number"
                            :is_required="false"
                            :error="true"
                            type="text" />

                    <!-- Start Date -->
                    <x-form.textarea
                        label="About Employee"
                        name="description"
                        :is_required="false"
                        :error="true"
                       />


                    {{-- <x-form.input
                        label="Start Date"
                        name="start_date"
                        :is_required="true"
                        :error="true"
                        type="date" /> --}}




                    <x-form.input
                    label="Add Resume"
                    name="resume"
                    :error="true"
                    type="file"
                    />
                    <x-form.input
                    label="Add Offer Letter"
                    name="offer_letter"
                    :error="true"
                    type="file"
                    />
                    <x-form.input
                    label="Add Joinging Letter"
                    name="joining_letter"
                    :error="true"
                    type="file"
                    />
                    <x-form.input
                    label="Add Contract & Agreement"
                    name="contract_agreement"
                    :error="true"
                    type="file"
                    />
                    <x-form.input
                    label="Add ID Proof"
                    name="Id_proof"
                    :error="true"
                    type="file"
                    />

                    <!-- Status -->
                    <x-form.select
                        label="Status"
                        name="status"
                        :is_required="true"
                        :error="true"
                        :options="['1' => 'Active', '0' => 'Inactive']" />




                    <!-- Submit Button -->
                    <div class="text-end md:col-span-2">
                        <x-form.button type="submit" />
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
