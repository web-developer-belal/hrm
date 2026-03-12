<div>
    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">Payroll Rule Management</h2>
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
                    <li class="text-xs text-default">Payroll Rule Management</li>
                </ol>
            </nav>
        </div>
        <div class="flex my-xl-auto right-content items-center flex-wrap gap-2">
            <div class="mb-2">
                <a href="{{ route('admin.payroll.rule.create') }}"
                    class="flex items-center bg-primary text-sm font-medium py-2 rounded text-white px-3 hover:bg-primary-900 hover:text-white">
                    <i class="ti ti-circle-plus me-2"></i>Add Rule
                </a>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white">
        <div class="card-header py-4 px-5 border-b border-borderColor flex items-center justify-between flex-wrap gap-3">
            <h5 class="w-fit">Payroll Rule List</h5>

            <div class="flex-1 flex items-center justify-end gap-3">
                <div>
                    <x-form.input name="search" placeholder="Search by rule name..." :live="true" />
                </div>
                <div>
                    <x-form.select name="type" placeholder="Type" :live="true"
                        :options="['bonus' => 'Bonus', 'deduction' => 'Deduction']" />
                </div>
                <div>
                    <x-form.select name="calc_type" placeholder="Calc Type" :live="true"
                        :options="['fixed' => 'Fixed', 'percentage' => 'Percentage', 'per_day' => 'Per Day']" />
                </div>
                <div>
                    <x-form.select name="condition_type" placeholder="Condition" :live="true"
                        :options="['always' => 'Always', 'min_present_days' => 'Min Present Days', 'date_range' => 'Date Range']" />
                </div>
                <div>
                    <x-form.select name="branch_group_id" placeholder="Branch Group" :live="true"
                        :options="$branch_group_options" />
                </div>
                <div>
                    <x-form.select name="status" placeholder="Status" :live="true"
                        :options="['' => 'All', '1' => 'Active', '0' => 'Inactive']" />
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="overflow-x-auto">
                <table class="table w-full border-b border-borderColor">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">SL</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">Rule Name</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">Type</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">Calculation</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">Condition</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">Branch Group</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">Status</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">Action</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-borderColor">
                        @forelse ($rules as $rule)
                            <tr class="even:bg-white hover:bg-gray-50">
                                <td class="px-5 py-2.5 text-gray-500">
                                    {{ ($rules->currentPage() - 1) * $rules->perPage() + $loop->iteration }}
                                </td>
                                <td class="px-5 py-2.5 text-gray-900 font-medium">{{ $rule->name }}</td>
                                <td class="px-5 py-2.5 text-gray-500">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $rule->type === 'bonus' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ ucfirst($rule->type) }}
                                    </span>
                                </td>
                                <td class="px-5 py-2.5 text-gray-500">
                                    {{ ucfirst(str_replace('_', ' ', $rule->calc_type)) }}
                                    ({{ rtrim(rtrim(number_format($rule->value, 2), '0'), '.') }})
                                </td>
                                <td class="px-5 py-2.5 text-gray-500">
                                    @if ($rule->condition_type === 'always')
                                        Always
                                    @elseif($rule->condition_type === 'min_present_days')
                                        Min Present: {{ $rule->condition_present_days }} days
                                    @else
                                        {{ $rule->condition_from?->format('d M Y') }} - {{ $rule->condition_to?->format('d M Y') }}
                                    @endif
                                </td>
                                <td class="px-5 py-2.5 text-gray-500">
                                    {{ $rule->branchGroup->name ?? 'All Groups' }}
                                </td>
                                <td class="px-5 py-2.5 text-gray-500">
                                    <span wire:click="toggleStatus({{ $rule->id }})"
                                        class="bg-{{ $rule->is_active ? 'success' : 'warning' }} text-white rounded text-[10px] font-medium leading-4 py-0.5 px-1.5 inline-flex items-center badge-xs cursor-pointer">
                                        <i class="ti ti-point-filled me-1"></i>{{ $rule->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="px-5 py-2.5 text-gray-500">
                                    <div class="action-icon inline-flex">
                                        <a href="{{ route('admin.payroll.rule.edit', ['ruleId' => $rule->id]) }}"
                                            class="me-2 size-[26px] flex items-center justify-center rounded-[5px] hover:bg-light-900 hover:text-gray-900">
                                            <i class="ti ti-edit"></i>
                                        </a>
                                        <button wire:confirm="Are you sure to delete this payroll rule?"
                                            class="size-[26px] flex items-center justify-center rounded-[5px] hover:bg-light-900 hover:text-gray-900"
                                            wire:click="deleteRule({{ $rule->id }})">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-5 py-8 text-center text-gray-500">
                                    No payroll rules found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if ($rules->hasPages())
            <div class="card-footer py-4 px-5 border-t border-borderColor">
                {{ $rules->links() }}
            </div>
        @endif
    </div>
</div>
