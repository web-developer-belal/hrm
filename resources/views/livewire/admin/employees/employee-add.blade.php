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
                    <i class="ti ti-arrow-back-up me-2"></i>Employees
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
                <form wire:submit.prevent="saveEmployee" class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-4">


                    <x-form.file-upload label="Photo" name="photo" :error="true" :oldFiles="$isEditMode && $emp->photo ? [customAsset($emp->photo)] : []" :fullPreview="true" />


                    <x-form.select placeholder="Select Branch" label="Select Branch" name="branch_id" :isRequired="true" :error="true"
                        :search="true" :options="$branch_id_options" />


                    <x-form.select placeholder="Select Department" label="Select Department" name="department_id" :isRequired="true" :error="true" :live="true"
                        :search="true" :options="$department_id_options" />

                    <x-form.input label="First Name" name="first_name" :isRequired="true" :error="true"
                        placeholder="Enter First Name" />


                    <x-form.input label="Last Name" name="last_name" :isRequired="false" :error="true"
                        placeholder="Enter Last Name" />

                    <x-form.input label="Email address" name="email" :isRequired="true" type="email"
                        :error="true" placeholder="Enter email address" />
                        
                    <x-form.input label="Employee ID" name="employee_code" :isRequired="false" :error="true"
                        placeholder="Enter Employee ID or Code" />


                    <x-form.input label="Joining Date" name="joining_date" :isRequired="true" :error="true"
                        type="date" />

                    <x-form.select placeholder="Select Designation" label="Select Designation" name="designation_id" :isRequired="true" :live="true"
                        :error="true" :search="true" :options="$designation_id_options" />

                    <x-form.input label="Contact No" name="contact_number" :isRequired="true" :error="true"
                        placeholder="Enter Contact No" />

                    <x-form.input label="Alternative Contact No" name="alternative_phone_number" :isRequired="false"
                        :error="true" placeholder="Enter Alternative Contact no" />

                    <x-form.select placeholder="Select Gender" label="Select Gender" name="gender" :isRequired="true" :error="true"
                        :options="['male' => 'Male', 'female' => 'Female', 'other' => ' Other']" />

                    <x-form.input label="Present Address" name="local_address" :isRequired="true" :error="true"
                        type="text" />

                    <x-form.input label="Permanent Address" name="permanent_address" :isRequired="true"
                        :error="true" type="text" />


                    <x-form.input label="Bank Name" name="bank_name" :isRequired="true" :error="true"
                        type="text" />

                    <x-form.input label="Account Holder Name" name="account_holder_name" :isRequired="true"
                        :error="true" type="text" />
                    <x-form.input label="MFS Account number" name="mfs_account"
                        :error="true" type="text" />

                    <x-form.input label="Account Number" name="account_number" :isRequired="true" :error="true"
                        type="text" />

                    <x-form.input label="Bank Routing Number" name="routing_number" :isRequired="false"
                        :error="true" type="text" />

                    <!-- Start Date -->
                    <x-form.textarea label="About Employee" name="description" :isRequired="false" :error="true" />



                    <x-form.file-upload label="Add Resume" name="resume" :error="true" :oldFiles="$isEditMode && $emp->resume ? [$emp->resume] : []" />
                    <x-form.file-upload label="Add Offer Letter" name="offer_letter" :error="true" :oldFiles="$isEditMode && $emp->offer_letter ? [$emp->offer_letter] : []" />
                    <x-form.file-upload label="Add Joining Letter" name="joining_letter" :error="true" :oldFiles="$isEditMode && $emp->joining_letter ? [$emp->joining_letter] : []" />
                    <x-form.file-upload label="Add Contract & Agreement" name="contract_agreement" :error="true" :oldFiles="$isEditMode && $emp->contract_agreement ? [$emp->contract_agreement] : []" />
                    <x-form.file-upload label="Add ID Proof" name="id_proof" :error="true" :oldFiles="$isEditMode && $emp->id_proof ? [$emp->id_proof] : []" />
                    <x-form.file-upload label="Add Checkbook" name="checkbook" :error="true" :oldFiles="$isEditMode && $emp->checkbook ? [$emp->checkbook] : []" />

                    <!-- Status -->
                    <x-form.select label="Status" name="status" :isRequired="true" :error="true"
                        :options="['1' => 'Active', '0' => 'Inactive']" />

                    <!-- Submit Button -->
                    <div class="text-end md:col-span-2">
                        <x-form.button type="submit" :text="$isEditMode ? 'Update' : 'Submit'" />
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
