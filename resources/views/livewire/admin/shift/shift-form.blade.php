<div>
    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">{{ $isEditMode ? 'Edit Shift' : 'Create Shift' }}</h2>
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
                    <li class="text-xs text-default">{{ $isEditMode ? 'Edit Shift' : 'Create Shift' }}</li>

                </ol>
            </nav>
        </div>
        <div class="flex my-xl-auto right-content items-center flex-wrap ">

            <div class="mb-2">
                <a href="{{ route('admin.shifts.index') }}"
                    class="flex items-center bg-primary text-sm font-medium py-2 rounded text-white px-3 hover:bg-primary-900 hover:text-white"><i
                        class="ti ti-circle-plus me-2"></i>Shifts</a>
            </div>

        </div>
    </div>
    <!-- /Breadcrumb -->


    <div class="">
        <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white mb-6">
            <div class="card-header p-5 border-b border-borderColor">
                <h5 class="card-title">{{ $isEditMode ? 'Edit Shift' : 'Create Shift' }}</h5>
            </div>
            <div class="card-body p-5">
                <form wire:submit.prevent="save" class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-4">
                    <x-form.input label="Shift Name" name="name" :is_required="true" :error="true"
                        placeholder="Enter Shift Name" />
                    <x-form.input label="Start Time" type="time" name="start_time" :is_required="true"
                        :error="true" placeholder="Enter Start Time" live="true" />
                    <x-form.input label="End Time" type="time" name="end_time" :is_required="true" :error="true"
                        placeholder="Enter End Time" live="true" />
                    <x-form.select label="Status" name="status" :is_required="true" :error="true"
                        :options="['active' => 'Active', 'inactive' => 'Inactive']" />
                    <div class="md:col-span-2">
                        {{ $workingText }}
                    </div>



                    <div class="text-end md:col-span-2">
                        <x-form.button type="submit" />
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
