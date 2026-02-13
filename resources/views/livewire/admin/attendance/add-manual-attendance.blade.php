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

        <div class="flex my-xl-auto right-content items-center flex-wrap ">
            <div class="mb-2">
                <a href="{{ route('admin.attendance.index') }}"
                    class="flex items-center bg-primary text-sm font-medium py-2 rounded text-white px-3 hover:bg-primary-900 hover:text-white">
                    <i class="ti ti-circle-plus me-2"></i>Manual Attendace
                </a>
            </div>
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
                        :is_required="true"
                        :error="true"
                        :live="true"
                        :options="$branches" />

                    <!-- Department (Optional) -->
                    <x-form.select
                        label="Select Department"
                        name="selectedDepartment"
                        :is_required="false"
                        :error="true"
                        :live="true"
                        :options="$departments" />








                    <!-- Employees -->
                    <x-form.select
                        label="Select Employee"
                        name="selectedEmployee"
                        :is_required="true"
                        :error="true"
                        :options="$employeesData"
                        :is_multiple="false" />

                    <x-form.select
                        label="Punch Status"
                        name="clockInOut"
                        :is_required="true"
                        :error="true"
                        :options="[''=>'Select Punch Status','clockIn' => 'Clock In', 'clockout' => 'Clock Out']" />

                    <!-- Start Date -->
                    <x-form.input
                        label="Attendance Time"
                        name="attandenceTime"
                        :is_required="true"
                        :error="true"
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
