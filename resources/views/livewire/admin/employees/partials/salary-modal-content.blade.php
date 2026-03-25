<div class="px-5 py-4 border-b border-borderColor flex items-center justify-between">
    <div>
        <h5 class="mb-1">Salary Setup</h5>
        <p class="text-xs text-gray-500">{{ $employeeName ?? 'Employee' }}</p>
    </div>
    <button type="button" wire:click="{{ $cancelAction }}"
        class="size-8 flex items-center justify-center rounded-md hover:bg-gray-100 text-gray-600">
        <i class="ti ti-x"></i>
    </button>
</div>

<form wire:submit.prevent="{{ $submitAction }}" class="p-5 overflow-y-auto salary-modal-form-scroll">
    <div class="border rounded-md border-borderColor p-4 mb-4">
        <h6 class="font-medium mb-3">Salary Information (Addition)</h6>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-3 mb-2">
            <div class="md:col-span-4">
                <label class="block mb-1 text-sm font-medium text-title">Salary Basic</label>
                <input type="number" step="0.01" min="0" wire:model.live="basicSalary"
                    class="bg-white border-borderColor text-gray-900 text-sm rounded-input block w-full py-2 px-2.5 h-9.5" />
                @error('basicSalary')
                    <span class="text-xs text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="md:col-span-4">
                <label class="block mb-1 text-sm font-medium text-title">Percent %</label>
            </div>
            <div class="md:col-span-4">
                <label class="block mb-1 text-sm font-medium text-title">Fixed Amount</label>
            </div>
        </div>

        @php
            $additionRows = [
                ['label' => 'House Rent', 'percent' => 'houseRentPercent', 'amount' => 'houseRentAmount'],
                ['label' => 'Medical Allowance', 'percent' => 'medicalAllowancePercent', 'amount' => 'medicalAllowanceAmount'],
                ['label' => 'Dear Allowance', 'percent' => 'dearAllowancePercent', 'amount' => 'dearAllowanceAmout'],
                ['label' => 'Transport Allowance', 'percent' => 'transportAllowancePercent', 'amount' => 'transportAllowanceAmount'],
                ['label' => 'Provident Fund', 'percent' => 'pfEployerContributionPercent', 'amount' => 'pfEployerContributionAmount'],
                ['label' => 'Other Allowance', 'percent' => 'otherAllowancePercent', 'amount' => 'otherAllowanceAmount'],
            ];
        @endphp

        @foreach ($additionRows as $row)
            <div class="grid grid-cols-1 md:grid-cols-12 gap-3 mb-2">
                <div class="md:col-span-4">
                    <label class="block mb-1 text-sm font-medium text-title">{{ $row['label'] }}</label>
                </div>
                <div class="md:col-span-4">
                    <input type="number" step="0.01" min="0" wire:model.live="{{ $row['percent'] }}"
                        class="bg-white border-borderColor text-gray-900 text-sm rounded-input block w-full py-2 px-2.5 h-9.5" />
                    @error($row['percent'])
                        <span class="text-xs text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="md:col-span-4">
                    <input type="number" step="0.01" min="0" wire:model.live="{{ $row['amount'] }}"
                        class="bg-white border-borderColor text-gray-900 text-sm rounded-input block w-full py-2 px-2.5 h-9.5" />
                    @error($row['amount'])
                        <span class="text-xs text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        @endforeach
    </div>

    <div class="border rounded-md border-borderColor p-4 mb-4">
        <h6 class="font-medium mb-3">Salary Deduction</h6>

        @php
            $deductionRows = [
                ['label' => 'PF Employee Contribution', 'percent' => 'pfEmployeeContributionPercent', 'amount' => 'pfEmployeeContributionAmount'],
                ['label' => 'Welfare Contribution', 'percent' => 'welfareContributionPercnet', 'amount' => 'welfareContributionAmount'],
                ['label' => 'Tax Deduction', 'percent' => 'taxDeductionPercent', 'amount' => 'taxDeductionAmount'],
            ];
        @endphp

        @foreach ($deductionRows as $row)
            <div class="grid grid-cols-1 md:grid-cols-12 gap-3 mb-2">
                <div class="md:col-span-4">
                    <label class="block mb-1 text-sm font-medium text-title">{{ $row['label'] }}</label>
                </div>
                <div class="md:col-span-4">
                    <input type="number" step="0.01" min="0" wire:model.live="{{ $row['percent'] }}"
                        class="bg-white border-borderColor text-gray-900 text-sm rounded-input block w-full py-2 px-2.5 h-9.5" />
                    @error($row['percent'])
                        <span class="text-xs text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="md:col-span-4">
                    <input type="number" step="0.01" min="0" wire:model.live="{{ $row['amount'] }}"
                        class="bg-white border-borderColor text-gray-900 text-sm rounded-input block w-full py-2 px-2.5 h-9.5" />
                    @error($row['amount'])
                        <span class="text-xs text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        @endforeach
    </div>

    <div class="border rounded-md border-borderColor p-4 mb-5">
        <h6 class="font-medium mb-3">Total Salary</h6>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
            <div>
                <label class="block mb-1 text-xs font-medium text-title">Basic</label>
                <input type="text" readonly wire:model="basic_salary"
                    class="bg-gray-50 border-borderColor text-gray-900 text-sm rounded-input block w-full py-2 px-2.5 h-9.5" />
            </div>
            <div>
                <label class="block mb-1 text-xs font-medium text-title">House Rent</label>
                <input type="text" readonly wire:model="house_rent"
                    class="bg-gray-50 border-borderColor text-gray-900 text-sm rounded-input block w-full py-2 px-2.5 h-9.5" />
            </div>
            <div>
                <label class="block mb-1 text-xs font-medium text-title">Medical</label>
                <input type="text" readonly wire:model="medical_allowance"
                    class="bg-gray-50 border-borderColor text-gray-900 text-sm rounded-input block w-full py-2 px-2.5 h-9.5" />
            </div>
            <div>
                <label class="block mb-1 text-xs font-medium text-title">Dear</label>
                <input type="text" readonly wire:model="dear_allowance"
                    class="bg-gray-50 border-borderColor text-gray-900 text-sm rounded-input block w-full py-2 px-2.5 h-9.5" />
            </div>
            <div>
                <label class="block mb-1 text-xs font-medium text-title">Transport</label>
                <input type="text" readonly wire:model="transport_allowance"
                    class="bg-gray-50 border-borderColor text-gray-900 text-sm rounded-input block w-full py-2 px-2.5 h-9.5" />
            </div>
            <div>
                <label class="block mb-1 text-xs font-medium text-title">PF Employer</label>
                <input type="text" readonly wire:model="pf_employer_contribution"
                    class="bg-gray-50 border-borderColor text-gray-900 text-sm rounded-input block w-full py-2 px-2.5 h-9.5" />
            </div>
            <div>
                <label class="block mb-1 text-xs font-medium text-title">Other</label>
                <input type="text" readonly wire:model="other_allowance"
                    class="bg-gray-50 border-borderColor text-gray-900 text-sm rounded-input block w-full py-2 px-2.5 h-9.5" />
            </div>
            <div>
                <label class="block mb-1 text-xs font-medium text-title">PF Employee (-)</label>
                <input type="text" readonly wire:model="pf_employee_contribution"
                    class="bg-gray-50 border-borderColor text-gray-900 text-sm rounded-input block w-full py-2 px-2.5 h-9.5" />
            </div>
            <div>
                <label class="block mb-1 text-xs font-medium text-title">Welfare (-)</label>
                <input type="text" readonly wire:model="welfare_contribution"
                    class="bg-gray-50 border-borderColor text-gray-900 text-sm rounded-input block w-full py-2 px-2.5 h-9.5" />
            </div>
            <div>
                <label class="block mb-1 text-xs font-medium text-title">Tax (-)</label>
                <input type="text" readonly wire:model="tax_deduction"
                    class="bg-gray-50 border-borderColor text-gray-900 text-sm rounded-input block w-full py-2 px-2.5 h-9.5" />
            </div>
            <div class="md:col-span-2">
                <label class="block mb-1 text-xs font-medium text-title">Net Salary</label>
                <input type="text" readonly wire:model="totalSalary"
                    class="bg-primary/5 border-primary text-gray-900 text-sm font-semibold rounded-input block w-full py-2 px-2.5 h-9.5" />
            </div>
        </div>
    </div>

    <div class="flex items-center justify-end gap-2">
        <button type="button" wire:click="{{ $cancelAction }}"
            class="px-4 py-2 rounded border border-borderColor text-gray-700 hover:bg-gray-50">
            Cancel
        </button>
        <button type="submit" class="px-4 py-2 rounded bg-primary text-white hover:bg-primary-900">
            Save Salary
        </button>
    </div>
</form>

@push('css')
    <style>
        /* Custom styles for the salary modal */
        .salary-modal-panel-max {
            max-height: 90vh;
        }

        .salary-modal-form-scroll {
            max-height: calc(90vh - 130px);
        }

        .rounded-input {
            border-radius: 0.375rem;
        }
    </style>
@endpush