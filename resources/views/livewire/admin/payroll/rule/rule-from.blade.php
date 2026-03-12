<div>
    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">{{ $isEditMode ? 'Edit Payroll Rule' : 'Create Payroll Rule' }}</h2>
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
                    <li class="text-xs text-default">{{ $isEditMode ? 'Edit Payroll Rule' : 'Create Payroll Rule' }}</li>
                </ol>
            </nav>
        </div>
        <div class="flex my-xl-auto right-content items-center flex-wrap ">
            <div class="mb-2">
                <a href="{{ route('admin.payroll.rule.index') }}"
                    class="flex items-center bg-primary text-sm font-medium py-2 rounded text-white px-3 hover:bg-primary-900 hover:text-white">
                    <i class="ti ti-arrow-back-up me-2"></i>Rule List
                </a>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white mb-6">
        <div class="card-header p-5 border-b border-borderColor">
            <h5 class="card-title">{{ $isEditMode ? 'Update Rule Configuration' : 'Create Rule Configuration' }}</h5>
        </div>
        <div class="card-body p-5">
            <form wire:submit.prevent="save" class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-4">
                <x-form.input label="Rule Name" name="name" :is_required="true" :error="true"
                    placeholder="Example: Festival Bonus" />

                <x-form.select label="Rule Type" name="type" :is_required="true" :error="true"
                    :options="['bonus' => 'Bonus', 'deduction' => 'Deduction']" />

                <x-form.select label="Calculation Type" name="calc_type" :is_required="true" :error="true"
                    :options="[
                        'fixed' => 'Fixed Amount',
                        'percentage' => 'Percentage (%)',
                        'per_day' => 'Per Day Amount',
                    ]" />

                <x-form.input label="Value" name="value" :is_required="true" :error="true"
                    placeholder="Example: 500 or 10" />

                <x-form.select label="Condition Type" name="condition_type" :is_required="true" :error="true" :live="true"
                    :options="[
                        'always' => 'Always Apply',
                        'min_present_days' => 'Minimum Present Days',
                        'date_range' => 'Specific Date Range',
                    ]" />

                <x-form.select label="Branch Group (Optional)" name="branch_group_id" :error="true"
                    placeholder="All Branch Groups" :options="$branch_group_options" />

                @if ($condition_type === 'min_present_days')
                    <x-form.input label="Minimum Present Days" name="condition_present_days" :is_required="true" :error="true"
                        placeholder="Example: 22" />
                @endif

                @if ($condition_type === 'date_range')
                    <x-form.input type="date" label="Condition Start Date" name="condition_from" :is_required="true" :error="true" />
                    <x-form.input type="date" label="Condition End Date" name="condition_to" :is_required="true" :error="true" />
                @endif

                <x-form.select label="Status" name="is_active" :is_required="true" :error="true"
                    :options="['1' => 'Active', '0' => 'Inactive']" />

                <div class="text-end md:col-span-2">
                    <x-form.button type="submit" />
                </div>
            </form>
        </div>
    </div>
</div>
