<div>
    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">{{ $isEditMode ? 'Edit Leave Application' : 'Create Leave Application' }}</h2>
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
                        {{ $isEditMode ? 'Edit Leave Application' : 'Create Leave Application' }}
                    </li>
                </ol>
            </nav>
        </div>

        <div class="flex my-xl-auto right-content items-center flex-wrap ">
            <div class="mb-2">
                <a href="{{ route('admin.leavemgt.leave.list') }}"
                    class="flex items-center bg-primary text-sm font-medium py-2 rounded text-white px-3 hover:bg-primary-900 hover:text-white">
                    <i class="ti ti-arrow-back-up me-2"></i>Leave Application
                </a>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <div class="">
        <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white mb-6">
            <div class="card-header p-5 border-b border-borderColor">
                <h5 class="card-title">{{ $isEditMode ? 'Edit Leave Application' : 'Create Leave Application' }}</h5>
            </div>

            <div class="card-body p-5">
                <form wire:submit.prevent="submitApplication" class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-4">

                    <!-- Employees -->
                    <div class="w-full">
                       <x-form.select label="Employee" name="employee_id" :options="$employee_id_options" :live="true" :isRequired="true" :search="true" />
                    </div>

                    <div class="w-full">
                       <x-form.select label="Leave Type" name="leave_type_id" :options="$leaveTypes" :live="true" :isRequired="true"  />
                    </div>
                    <div class="w-full">
                       <x-form.input label="Leave Balance" name="leave_balance" :isReadonly="true" />
                    </div>


                    <div class="w-full">
                       <x-form.input label="From Date" type="date" name="from_date" :live="true" :isRequired="true" />
                    </div>

                    <div class="w-full">
                       <x-form.input label="To Date" type="date" name="to_date" :live="true" :isRequired="true" />
                    </div>

                    <div class="w-full">
                          <x-form.input label="Total Days" name="total_days" :isReadonly="true" />
                    </div>
                    <div class="md:col-span-2">
                        <x-form.textarea label="Reason" name="description" :isEditor="true" />
                    </div>

                    <!-- Submit Button -->
                    <div class="text-end md:col-span-2">
                        <x-form.button type="submit" />
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
y
