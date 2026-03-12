<div>
    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">{{ !$isEditMode ? 'Create Ot' : 'Edit Ot' }}</h2>
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
                        {{ !$isEditMode ? 'Create Ot' : 'Edit Ot' }}
                    </li>
                </ol>
            </nav>
        </div>

        <div class="flex my-xl-auto right-content items-center flex-wrap ">
            <div class="mb-2">
                <a href="{{ route('admin.ot.index') }}"
                    class="flex items-center bg-primary text-sm font-medium py-2 rounded text-white px-3 hover:bg-primary-900 hover:text-white">
                    <i class="ti ti-arrow-back-up me-2"></i>Overtime
                </a>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <div class="">
        <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white mb-6">
            <div class="card-header p-5 border-b border-borderColor">
                <h5 class="card-title">{{ !$isEditMode ? 'Create Ot' : 'Edit Ot' }}</h5>
            </div>

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            @endif
            <div class="card-body p-5">
                <form wire:submit.prevent="save" class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-4">


                    <x-form.select label="Select group" name="branch_group_id" :options="$branchGroups" :isRequired="true" :live="true" />

                    <x-form.input label="Name" name="name" :isRequired="true" />
                    <x-form.input label="Off Day Counting" name="off_day_counting" :isRequired="true" type="checkbox" />
                    <x-form.input label="Include in Payroll" name="include_in_payroll" :isRequired="true" type="checkbox" />

                    <div class="md:col-span-2 mt-2">
                        <h6 class="mb-2">Designation Wise OT Rate</h6>

                        @if (!empty($designations))
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-4">
                                @foreach ($designations as $designation)
                                    <div>
                                        <label class="form-label mb-1 text-sm text-gray-700">{{ $designation['name'] }}</label>
                                        <input type="number" step="0.01" min="0"
                                            wire:model="designation_rates.{{ $designation['id'] }}"
                                            class="form-control"
                                            placeholder="Enter OT rate for {{ $designation['name'] }}">
                                        @error('designation_rates.' . $designation['id'])
                                            <span class="text-danger text-xs">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endforeach
                            </div>
                        @elseif($branch_group_id)
                            <p class="text-sm text-gray-500">No active designations found for selected group branches.</p>
                        @else
                            <p class="text-sm text-gray-500">Select a group to load designations.</p>
                        @endif
                    </div>

                    @error('designation_rates')
                        <div class="md:col-span-2 text-danger text-xs">{{ $message }}</div>
                    @enderror

                    <!-- Submit Button -->
                    <div class="text-end md:col-span-2">
                        <x-form.button type="submit" />
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
