<div>
    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">Attendance Policy Management</h2>
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
                    <li class="text-xs text-default">Attendance Policy Management</li>

                </ol>
            </nav>
        </div>
        <div class="flex my-xl-auto right-content items-center flex-wrap ">

            <div class="mb-2">
                <a href="{{ route('admin.attendance-policy.add') }}"
                    class="flex items-center bg-primary text-sm font-medium py-2 rounded text-white px-3 hover:bg-primary-900 hover:text-white"><i
                        class="ti ti-circle-plus me-2"></i>Add Attendance Policy</a>
            </div>

        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Employees List -->
    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white">
        <div
            class="card-header py-4 px-5 border-b border-borderColor flex items-center justify-between flex-wrap gap-3">
            <h5>Attendance Policy List</h5>

        </div>
        <div class="card-body p-0">
            <div class="overflow-x-auto">
                <table class="table w-full border-b border-borderColor">
                    <thead class="thead-light">
                        <tr>
                            <th
                                class="no-sort text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor hover:outline-none">
                                SL
                            </th>
                           <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Branch</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Policy Name</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Descriptions</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Late Arrival</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Early Departure</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Late Deduction Count Days</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Late Cutoff Time</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Mark Absent If Late</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Late Penalty</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Auto Suspend (Absent)</th>


                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Status</th>

                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-borderColor">
                        @foreach ($attendancePolicies as $item)
                            <tr class="even:bg-white dark:even-bg-white">
                                <td class="px-5 py-2.5 text-gray-500">
                                    {{ $attendancePolicies->firstItem() + $loop->index }}
                                </td>

                                <td class="px-5 py-2.5 text-gray-500">{{ $item->branch->name ?? 'N/A' }}</td>
                                <td class="px-5 py-2.5 text-gray-500">{{ $item->policy_name }}</td>
                                <td class="px-5 py-2.5 text-gray-500">{{ $item->description }}</td>
                                <td class="px-5 py-2.5 text-gray-500">{{ $item->in_grace_period_minutes }}</td>
                                <td class="px-5 py-2.5 text-gray-500">{{ $item->out_grace_period_minutes }}</td>
                                <td class="px-5 py-2.5 text-gray-500">{{ $item->late_deduction_count_days }}</td>
                                <td class="px-5 py-2.5 text-gray-500">{{ $item->late_cutoff_time }}</td>
                                <td class="px-5 py-2.5 text-gray-500">{{ $item->mark_absent_if_late ? 'Yes' : 'No' }}</td>
                                <td class="px-5 py-2.5 text-gray-500">
                                    {{ $item->late_penalty_threshold_days }} late = {{ $item->late_penalty_deduct_days }} day deduct
                                </td>
                                <td class="px-5 py-2.5 text-gray-500">
                                    {{ $item->auto_suspend_on_continuous_absence ? 'Yes' : 'No' }} ({{ $item->continuous_absent_months_for_suspend }} months)
                                </td>


                                <td class="px-5 py-2.5 text-gray-500">

                                    <span wire:click="toggleStatus({{ $item->id }})"
                                        class="bg-{{ $item->status === 'active' ? 'success' : 'warning' }} text-white rounded text-[10px] font-medium leading-4 py-0.5 px-1.5 inline-flex items-center badge-xs cursor-pointer">
                                        <i class="ti ti-point-filled me-1"></i>{{ ucfirst($item->status) }}
                                    </span>

                                </td>
                                <td class="px-5 py-2.5 text-gray-500">
                                    <div class="action-icon inline-flex">
                                        <a href="{{ route('admin.attendance-policy.edit', ['policyID' => $item->id]) }}"
                                            class="me-2 size-[26px] flex items-center justify-center rounded-[5px] hover:bg-light-900 hover:text-gray-900"><i
                                                class="ti ti-edit"></i></a>
                                        <button wire:confirm="Are you sure to delete this attendance policy?"
                                            class="size-[26px] flex items-center justify-center rounded-[5px] hover:bg-light-900 hover:text-gray-900"
                                            wire:click="deleteAttendancePolicy({{ $item->id }})"><i
                                                class="ti ti-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        @if ($attendancePolicies->hasPages())
            <div class="card-footer py-4 px-5 border-t border-borderColor">
                {{ $attendancePolicies->links() }}
            </div>
        @endif

    </div>
    <!-- /Employees List -->
</div>
