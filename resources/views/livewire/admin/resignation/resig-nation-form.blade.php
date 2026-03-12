<div>
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">{{ $isEditMode ? 'Edit Resignation' : 'Create Resignation' }}</h2>
        </div>
        <div class="mb-2">
            <a href="{{ route('admin.resignations.index') }}"
                class="flex items-center bg-primary text-sm font-medium py-2 rounded text-white px-3 hover:bg-primary-900 hover:text-white">
                <i class="ti ti-arrow-left me-2"></i>Back To List
            </a>
        </div>
    </div>

    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white mb-6">
        <div class="card-header p-5 border-b border-borderColor">
            <h5 class="card-title">{{ $isEditMode ? 'Edit Resignation' : 'Create Resignation' }}</h5>
        </div>

        <div class="card-body p-5">
            <form wire:submit.prevent="save" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-form.select label="Employee" name="employee_id" :options="$employee_id_options" :isRequired="true" :search="true"
                    :error="true" />

                <x-form.select label="Status" name="status" :options="['pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected']" :isRequired="true" :error="true" />

                <x-form.input label="Subject" name="subject" :isRequired="true" />
                <x-form.input label="Registration Date" name="registration_date" type="date" :isRequired="true" />
                <div class="md:col-span-2">
                    <x-form.textarea label="Reason for Resignation" name="reason" :isEditor="true" :isRequired="true"
                        rows="4" />
                </div>

                <x-form.textarea label="Admin Comment" name="comment" rows="4" />

                <div class="text-end md:col-span-2">
                    <x-form.button text="{{ $isEditMode ? 'Update' : 'Create' }}" />
                </div>
            </form>
        </div>
    </div>
</div>
