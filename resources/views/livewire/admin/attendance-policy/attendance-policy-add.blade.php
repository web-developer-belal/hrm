 <div>
    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">{{ $isEditMode ? 'Edit Attendance Policy' : 'Create Attendance Policy' }}</h2>
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
                    <li class="text-xs text-default">{{ $isEditMode ? 'Edit Attendance Policy' : 'Create Attendance Policy' }}</li>

                </ol>
            </nav>
        </div>
        <div class="flex my-xl-auto right-content items-center flex-wrap ">

            <div class="mb-2">
                <a href="{{ route('admin.attendance-policy.index') }}"
                    class="flex items-center bg-primary text-sm font-medium py-2 rounded text-white px-3 hover:bg-primary-900 hover:text-white"><i
                        class="ti ti-circle-plus me-2"></i>Attendance Policy</a>
            </div>

        </div>
    </div>
    <!-- /Breadcrumb -->


    <div class="">
        <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white mb-6">
            <div class="card-header p-5 border-b border-borderColor">
                <h5 class="card-title">{{ $isEditMode ? 'Edit Attendance Policy' : 'Create Attendance Policy' }}</h5>
            </div>
            <div class="card-body p-5">
                <form wire:submit.prevent="save" class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-4">
                    <x-form.select label="Branch" placeholder="Select Branch" name="branch_id" :is_required="true" :error="true"
                        :options="$branch_id_options" :search="true" />
                    <x-form.input label="Policy name" name="policy_name" :is_required="true" :error="true"
                        placeholder="Enter Policy Name" />

                    <div class="md:col-span-2">
                        <x-form.textarea label="Description" name="description" :error="false" />
                    </div>

                     <x-form.input label="Entry Grace Time" name="in_grace_period_minutes" :is_required="false" :error="true"
                        placeholder="Enter Entry Grace Time" />
                     <x-form.input label="Exit Grace Time" name="out_grace_period_minutes" :is_required="false" :error="true"
                        placeholder="Enter Exit Grace Time" />
                     <x-form.input label="Late Deduction Count Days" name="late_deduction_count_days" :is_required="false" :error="true"
                        placeholder="Enter Late Deduction Count Days" />
                            <x-form.input label="Late Cutoff Time (After this mark absent)" type="time" name="late_cutoff_time" :is_required="true" :error="true"
                                placeholder="Select Late Cutoff Time" />
                            <x-form.select label="Mark Absent If Late" name="mark_absent_if_late" :is_required="true" :error="true"
                                :options="[1 => 'Yes', 0 => 'No']" />
                            <x-form.input label="Late Penalty Threshold Days" name="late_penalty_threshold_days" :is_required="true" :error="true"
                                placeholder="Enter Late Penalty Threshold Days" />
                            <x-form.input label="Late Penalty Deduct Days" name="late_penalty_deduct_days" :is_required="true" :error="true"
                                placeholder="Enter Late Penalty Deduct Days" />
                            <x-form.input label="Continuous Absent Months For Suspend" name="continuous_absent_months_for_suspend" :is_required="true" :error="true"
                                placeholder="Enter Continuous Absent Months" />
                            <x-form.select label="Auto Suspend On Continuous Absence" name="auto_suspend_on_continuous_absence" :is_required="true" :error="true"
                                :options="[1 => 'Yes', 0 => 'No']" />


                    <x-form.select label="Status" name="status" :is_required="true" :error="true"
                        :options="['active' => 'Active', 'inactive' => 'Inactive']" />

                    <div class="text-end md:col-span-2">
                        <x-form.button type="submit" />
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
