<div>
    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">Payrool Engine</h2>
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
                        Run Payrool
                    </li>
                </ol>
            </nav>
        </div>

    </div>
    <!-- /Breadcrumb -->

    <div class="">
        <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white mb-6">
            <div class="card-header p-5 border-b border-borderColor">
                <h5 class="card-title">Run Payrool Engine Branchwise</h5>
            </div>

            <div class="card-body p-5">
                <form wire:submit.prevent="generateBranch" class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-4">

                    <x-form.select label="Select Branch" name="branch_id" :search="true" :isRequired="false"
                        :error="true" :options="$branch_id_options" placeholder="Select Branch" />

                    <div class="w-full">
                        <label>Period Start</label>
                        <input type="date" wire:model="period_start" class="form-control" required>
                        @error('period_start')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="w-full">
                        <label>Period End</label>
                        <input type="date" wire:model="period_end" class="form-control" required>
                        @error('period_end')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>


                    <!-- Submit Button -->
                    <div class="text-end md:col-span-2">
                        <x-form.button type="submit" />
                    </div>



                </form>
            </div>
        </div>
    </div>

    <div class="">
        <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white mb-6">
            <div class="card-header p-5 border-b border-borderColor">
                <h5 class="card-title">Run Payrool Engine Branch Group Wise</h5>
            </div>

            <div class="card-body p-5">
                <form wire:submit.prevent="generateBranchGroup" class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-4">

                    <x-form.select label="Select Branch Group" name="branch_group_id" :search="true" :isRequired="false"
                        :error="true" :options="$branch_group_id_options" placeholder="Select Branch Group" />

                    <div class="w-full">
                        <label>Period Start</label>
                        <input type="date" wire:model="period_start" class="form-control" required>
                        @error('period_start')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    <div class="w-full">
                        <label>Period End</label>
                        <input type="date" wire:model="period_end" class="form-control" required>
                        @error('period_end')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>

                    <div class="text-end md:col-span-2">
                        <x-form.button type="submit" />
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class="">
        <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white mb-6">
            <div class="card-header p-5 border-b border-borderColor">
                <h5 class="card-title">Run Payrool Engine All Employee</h5>
            </div>

            <div class="card-body p-5">
                <form wire:submit.prevent="generateAll" class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-4">



                    <div class="w-full">
                        <label>Period Start</label>
                        <input type="date" wire:model="period_start" class="form-control" required>
                        @error('period_start')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="w-full">
                        <label>Period End</label>
                        <input type="date" wire:model="period_end" class="form-control" required>
                        @error('period_end')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>


                    <!-- Submit Button -->
                    <div class="text-end md:col-span-2">
                        <x-form.button type="submit" />
                    </div>

                </form>
            </div>
        </div>
    </div>



    <div class="">
        <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white mb-6">
            <div class="card-header p-5 border-b border-borderColor">
                <strong>Important:</strong>
                <ul class="mb-0">
                    <li>Make sure attendance sync is completed.</li>
                    <li>Payroll cannot be regenerated if already exists.</li>
                    <li>Approved payroll cannot be modified.</li>
                </ul>
            </div>
        </div>
    </div>
