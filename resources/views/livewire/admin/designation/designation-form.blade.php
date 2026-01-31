<div>
    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">{{ $isEditMode ? 'Edit Designation' : 'Create Designation' }}</h2>
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
                    <li class="text-xs text-default">{{ $isEditMode ? 'Edit Designation' : 'Create Designation' }}</li>

                </ol>
            </nav>
        </div>
        <div class="flex my-xl-auto right-content items-center flex-wrap ">

            <div class="mb-2">
                <a href="{{ route('admin.designations.index') }}"
                    class="flex items-center bg-primary text-sm font-medium py-2 rounded text-white px-3 hover:bg-primary-900 hover:text-white"><i
                        class="ti ti-circle-plus me-2"></i>Designations</a>
            </div>

        </div>
    </div>
    <!-- /Breadcrumb -->


    <div class="">
        <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white mb-6">
            <div class="card-header p-5 border-b border-borderColor">
                <h5 class="card-title">{{ $isEditMode ? 'Edit Designation' : 'Create Designation' }}</h5>
            </div>
            <div class="card-body p-5">
                <form wire:submit.prevent="save" class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-4">
                    <x-form.input label="Designation Name" name="name" :is_required="true" :error="true"
                        placeholder="Enter Designation Name" />
                    <x-form.select label="Select department" name="department_id" :is_required="true" :error="true"
                        :options="$departments" />
                    <div class="md:col-span-2">
                        <x-form.textarea label="Description" name="description" :error="true" />
                    </div>

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
