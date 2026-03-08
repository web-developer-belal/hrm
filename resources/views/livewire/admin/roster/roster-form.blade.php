<div>
    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">{{ $isEditMode ? 'Edit Roster' : 'Create Roster' }}</h2>
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
                        {{ $isEditMode ? 'Edit Roster' : 'Create Roster' }}
                    </li>
                </ol>
            </nav>
        </div>

        <div class="flex my-xl-auto right-content items-center flex-wrap ">
            <div class="mb-2">
                <a href="{{ route('admin.rosters.index') }}"
                    class="flex items-center bg-primary text-sm font-medium py-2 rounded text-white px-3 hover:bg-primary-900 hover:text-white">
                    <i class="ti ti-arrow-back-up me-2"></i>Rosters
                </a>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <div class="">
        <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white mb-6">
            <div class="card-header p-5 border-b border-borderColor">
                <h5 class="card-title">{{ $isEditMode ? 'Edit Roster' : 'Create Roster' }}</h5>
            </div>

            <div class="card-body p-5">
                <form wire:submit.prevent="save" class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-4">

                    <!-- Roster Name -->
                    <x-form.input label="Roster Name" name="name" :isRequired="true" :error="true"
                        placeholder="Enter Roster Name" />

                    <!-- Branch -->
                    <x-form.select placeholder="Select Branch" label="Select Branch" name="branch_id" :isRequired="true" :error="true"
                        :options="$branch_id_options" :search="true" />

                    <!-- Department (Optional) -->
                    <x-form.select placeholder="Select Department" label="Select Department" name="department_id" :isRequired="false" :error="true"
                        :options="$department_id_options" :search="true" />

                    <!-- Shift -->
                    <x-form.select placeholder="Select Shift" label="Select Shift" name="shift_id" :isRequired="true" :error="true" :live="true"
                        :options="$shift_id_options" :search="true" />

                 

                    <!-- Working Days -->
                    <x-form.select
                        label="Working Days"
                        name="working_days"
                        :isRequired="true"
                        :error="true"
                        :options="$working_days_options"
                        :isMultiple="true" />

                    <!-- Employees -->
                    <x-form.select
                        placeholder="Select Employees"
                        label="Select Employee"
                        name="employees"
                        :isRequired="true"
                        :error="true"
                        :search="true"
                        :options="$employees_options"
                        :isMultiple="true" />

                    <!-- Start Date -->
                    <x-form.input label="Start Date" name="start_date" :isRequired="true" :error="true"
                        type="date" />

                    <!-- End Date -->
                    <x-form.input label="End Date" name="end_date" :isRequired="true" :error="true"
                        type="date" />

                    <!-- Status -->
                    <x-form.select label="Status" name="status" :isRequired="true" :error="true"
                        :options="['active' => 'Active', 'inactive' => 'Inactive']" />

                    <!-- Submit Button -->
                    <div class="text-end md:col-span-2">
                        <x-form.button type="submit" />
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
