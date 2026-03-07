<div>
    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">{{ $isEditMode ? 'Edit Transfer' : 'Create Transfer' }}</h2>
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
                        {{ $isEditMode ? 'Edit Transfer' : 'Create Transfer' }}
                    </li>
                </ol>
            </nav>
        </div>

        <div class="flex my-xl-auto right-content items-center flex-wrap ">
            <div class="mb-2">
                <a href="{{ route('admin.transfer.index') }}"
                    class="flex items-center bg-primary text-sm font-medium py-2 rounded text-white px-3 hover:bg-primary-900 hover:text-white">
                    <i class="ti ti-arrow-back-up me-2"></i>Transfer
                </a>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <div class="">
        <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white mb-6">
            <div class="card-header p-5 border-b border-borderColor">
                <h5 class="card-title">{{ $isEditMode ? 'Edit Transfer' : 'Create Transfer' }}</h5>


                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                @endif

            </div>

            <div class="card-body p-5">
                <form wire:submit.prevent="submitTransfer" class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-4">

                    <!-- Employees -->
                    <x-form.select label="Select Employee" name="selectedEmployee" :search="true" :isRequired="true" :error="true"
                        :options="$selectedEmployee_options" :live="true" />


                    @if ($form_branch)
                        <div class="w-full">
                            <label class="form-label">From Branch</label>

                            <input type="text" class="form-control " wire:model="form_branch" readonly>

                        </div>
                        <div class="w-full">
                            <label class="form-label">From Department</label>

                            <input type="text" class="form-control " wire:model="form_department" readonly>
                        </div>
                    @endif

                    <!-- Branch -->
                    <x-form.select placeholder="Select a branch" label="Transfer To Branch" name="to_branch_id" :search="true" :isRequired="true" :error="true"
                        :options="$to_branch_id_options" />


                    <!-- Department (Optional) -->
                    <x-form.select placeholder="Select a department" label="Transfer To Department" name="to_department_id" :search="true" :isRequired="true"
                        :error="true" :options="$to_department_id_options" />


                    <x-form.textarea label="Note" name="note" :isRequired="false" :error="true"
                        placeholder="Describe note" />

                    <!-- Status -->
                    <x-form.select label="Status" name="status" :isRequired="true" :error="true"
                        :options="['0' => 'Unapproved', '1' => 'Approved']" />

                    <!-- Submit Button -->
                    <div class="text-end md:col-span-2">
                        <x-form.button type="submit" />
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
