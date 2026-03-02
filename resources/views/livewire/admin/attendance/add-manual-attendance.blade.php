<div>
    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">Add Manual Attendance</h2>
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
                       Add Manual Attendance
                    </li>
                </ol>
            </nav>
        </div>

        
    </div>
    <!-- /Breadcrumb -->

    <div class="">
        <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white mb-6">
            <div class="card-header p-5 border-b border-borderColor">
                <h5 class="card-title">Add Manual Attendance</h5>
            </div>

            <div class="card-body p-5">
                <form wire:submit.prevent="saveManualAttendance"
                    class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-4">

                     <!-- Branch -->
                    <x-form.select
                        label="Select Branch"
                        name="selectedBranch"
                        :isRequired="true"
                        :live="true"
                        :search="true"
                        :options="$selectedBranch_options"
                        placeholder="Select Branch" />

                    <!-- Department (Optional) -->
                    <x-form.select
                        label="Select Department"
                        name="selectedDepartment"
                        :isRequired="false"
                        :search="true"
                        :live="true"
                        placeholder="Select Department"
                        :options="$selectedDepartment_options" />


                    <!-- Employees -->
                    <x-form.select
                        label="Select Employee"
                        name="selectedEmployee"
                        :isRequired="true"
                        :search="true"
                        placeholder="Select Employee"
                        :options="$selectedEmployee_options"
                        :is_multiple="false" />

                    <x-form.select
                        label="Attendance Status"
                        name="clockInOut"
                        :isRequired="true"
                        
                        :options="[''=>'Select Attendance Status','clockIn' => 'Clock In', 'clockout' => 'Clock Out']" />

                    <!-- Start Date -->
                    <x-form.input
                        label="Attendance Time"
                        name="attandenceTime"
                        :isRequired="true"
                        type="datetime-local" />




                    <!-- Submit Button -->
                    <div class="text-end md:col-span-2">
                        <x-form.button type="submit" />
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
