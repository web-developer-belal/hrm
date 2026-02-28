<div>
    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">Create Leave Application</h2>
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('employee.dashboard') }}"
                            class="inline-flex items-center text-xs text-gray-500 hover:text-primary">
                            <i class="ti ti-smart-home"></i>
                        </a>
                    </li>
                    <li>
                        <span class="text-default">/</span>
                    </li>
                    <li class="text-xs text-default">
                        Create Leave Application
                    </li>
                </ol>
            </nav>
        </div>

        <div class="flex my-xl-auto right-content items-center flex-wrap ">
            <div class="mb-2">
                <a href="{{ route('employee.leave') }}"
                    class="flex items-center bg-primary text-sm font-medium py-2 rounded text-white px-3 hover:bg-primary-900 hover:text-white">
                    <i class="ti ti-circle-plus me-2"></i>Leave Application
                </a>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <div class="">
        <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white mb-6">
            <div class="card-header p-5 border-b border-borderColor">
                <h5 class="card-title">Create Leave Application</h5>
            </div>

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            @endif
            <div class="card-body p-5">
                <form wire:submit.prevent="submitApplication" class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-4">

                    <div class="w-full">
                        <label>Leave Type *</label>
                        <select class="form-control" wire:change="setLeaveType($event.target.value)" required>
                            <option value="">Select</option>
                            @foreach ($leaveTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full">
                        <label>Leave Balance</label>
                        <input class="form-control" readonly value="{{ $leave_balance }}">
                    </div>


                    <div class="w-full">
                        <label>From Date</label>
                        <input type="date" class="form-control" wire:change="setFromDate($event.target.value)"
                            required>
                    </div>

                    <div class="w-full">
                        <label>To Date</label>
                        <input type="date" class="form-control" wire:change="setToDate($event.target.value)"
                            required>
                    </div>

                    <div class="w-full">
                        <label>Total Days</label>
                        <input class="form-control" readonly value="{{ $total_days }}">
                    </div>
                    <div class="w-full">
                        <label>Reason</label>
                        <textarea class="form-control" wire:input="setDescription($event.target.value)"></textarea>
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
