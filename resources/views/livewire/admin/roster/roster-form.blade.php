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
                    <i class="ti ti-circle-plus me-2"></i>Rosters
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
                <form wire:submit.prevent="save"
                    class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-4">

                    <!-- Roster Name -->
                    <x-form.input
                        label="Roster Name"
                        name="name"
                        :is_required="true"
                        :error="true"
                        placeholder="Enter Roster Name" />

                    <!-- Branch -->
                    <x-form.select
                        label="Select Branch"
                        name="branch_id"
                        :is_required="true"
                        :error="true"
                        :options="$branches" />

                    <!-- Department (Optional) -->
                    <x-form.select
                        label="Select Department"
                        name="department_id"
                        :is_required="false"
                        :error="true"
                        :options="$departments" />

                    <!-- Shift -->
                    <x-form.select
                        label="Select Shift"
                        name="shift_id"
                        :is_required="true"
                        :error="true"
                        :options="$shifts" />

                    @php
                        $days = [
                            'monday' => 'Monday',
                            'tuesday' => 'Tuesday',
                            'wednesday' => 'Wednesday',
                            'thursday' => 'Thursday',
                            'friday' => 'Friday',
                            'saturday' => 'Saturday',
                            'sunday' => 'Sunday',
                        ];
                    @endphp

                    <!-- Working Days -->
                    {{-- <x-form.select
                        label="Working Days"
                        name="working_days"
                        :is_required="true"
                        :error="true"
                        :options="$days"
                        :is_multiple="true" /> --}}

                           <select name="working_days[]" id="" wire:model="working_days" class="form-control" multiple>
                            <option value="">Select working days</option>
                               @foreach ($days as $key => $day)
                                <option value="{{ $key }}">{{ $day }}</option>
                                @endforeach
                        </select>

                    <!-- Weekly Off Days -->
                    {{-- <x-form.select
                        label="Weekly Off Days"
                        name="weekly_off_days"
                        :is_required="false"
                        :error="true"
                        :options="$days"
                        :is_multiple="true" /> --}}

                       <select name="weekly_off_days[]" wire:model="weekly_off_days" class="form-control" multiple>
                            <option value="">Select weekly dayoffs</option>

                            @foreach ($days as $key => $day)
                                <option value="{{ $key }}">{{ $day }}</option>
                            @endforeach
                        </select>

                    <!-- Employees -->
                    {{-- <x-form.select
                        label="Select Employee"
                        name="employees"
                        :is_required="true"
                        :error="true"
                        :options="$employeesData"
                        :is_multiple="true" /> --}}

                       <select name="employees[]"  wire:model="employees" multiple class="form-control">
                            @foreach($employeesData as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>

                    <!-- Start Date -->
                    <x-form.input
                        label="Start Date"
                        name="start_date"
                        :is_required="true"
                        :error="true"
                        type="date" />

                    <!-- End Date -->
                    <x-form.input
                        label="End Date"
                        name="end_date"
                        :is_required="true"
                        :error="true"
                        type="date" />

                    <!-- Status -->
                    <x-form.select
                        label="Status"
                        name="status"
                        :is_required="true"
                        :error="true"
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
