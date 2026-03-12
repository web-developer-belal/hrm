<div>
    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">OT Payment Management</h2>
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}"
                            class="inline-flex items-center text-xs text-gray-500 hover:text-primary">
                            <i class="ti ti-smart-home"></i>
                        </a>
                    </li>
                    <li><span class="text-default">/</span></li>
                    <li class="text-xs text-default">OT Payment Management</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- /Breadcrumb -->

    @if (session()->has('success'))
        <div class="mb-4 px-4 py-3 bg-green-100 border border-green-300 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-4 px-4 py-3 bg-red-100 border border-red-300 text-red-800 rounded">
            {{ session('error') }}
        </div>
    @endif

    <!-- Filters -->
    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white mb-4">
        <div class="card-body p-4">
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-3">
                <div>
                    <x-form.input name="search" placeholder="Search employee..." :live="true" />
                </div>
                <div>
                    <x-form.select name="year" placeholder="Select Year" :live="true"
                        :options="collect(range(now()->year - 2, now()->year + 1))->mapWithKeys(fn($y) => [$y => $y])->toArray()" />
                </div>
                <div>
                    <x-form.select name="month" placeholder="Select Month" :live="true"
                        :options="$month_options" />
                </div>
                <div>
                    <x-form.select name="branch_group_id" placeholder="All Branch Groups"
                        :options="$branch_group_options" :live="true" />
                </div>
                <div>
                    <x-form.select name="branch_id" placeholder="All Branches"
                        :options="$branch_options" :live="true" />
                </div>
            </div>
        </div>
    </div>
    <!-- /Filters -->

    <!-- Summary Bar -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
        <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white p-4 flex items-center gap-3">
            <div class="size-10 rounded-full bg-primary/10 flex items-center justify-center">
                <i class="ti ti-clock-hour-4 text-primary text-xl"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500">Total OT Employees</p>
                <p class="text-lg font-semibold text-gray-900">{{ $paginator->total() }}</p>
            </div>
        </div>
        <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white p-4 flex items-center gap-3">
            <div class="size-10 rounded-full bg-warning/10 flex items-center justify-center">
                <i class="ti ti-hourglass text-warning text-xl"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500">Unpaid Payments</p>
                <p class="text-lg font-semibold text-gray-900">
                    {{ $rows->where('payment_status', 'unpaid')->count() }}
                </p>
            </div>
        </div>
        <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white p-4 flex items-center gap-3">
            <div class="size-10 rounded-full bg-success/10 flex items-center justify-center">
                <i class="ti ti-circle-check text-success text-xl"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500">Paid Payments</p>
                <p class="text-lg font-semibold text-gray-900">
                    {{ $rows->where('payment_status', 'paid')->count() }}
                </p>
            </div>
        </div>
    </div>

    <!-- OT Payment List -->
    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white">
        <div class="card-header py-4 px-5 border-b border-borderColor flex items-center justify-between gap-3 flex-wrap">
            <h5>
                OT Summary &mdash;
                {{ \Carbon\Carbon::create(null, $month)->format('F') }} {{ $year }}
            </h5>
            <button
                wire:click="markSelectedAsPaid"
                wire:confirm="Create OT payments and mark selected employees as paid?"
                @disabled(empty($selectedEmployeeIds))
                class="inline-flex items-center px-3 py-2 text-sm font-medium rounded bg-success text-white hover:bg-green-700 transition disabled:opacity-50 disabled:cursor-not-allowed">
                <i class="ti ti-check me-1"></i> Mark Selected Paid
            </button>
        </div>
        <div class="card-body p-0">
            <div class="overflow-x-auto">
                <table class="table w-full border-b border-borderColor">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor text-center">
                                <input type="checkbox" wire:model.live="selectPage" class="rounded border-borderColor text-primary focus:ring-primary">
                            </th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">SL</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">Employee</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">Branch</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">OT Rate Type</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor text-right">Total OT (min)</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor text-right">Total OT (hrs)</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor text-right">Amount</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor text-center">Payment Status</th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-borderColor">
                        @forelse ($rows as $index => $row)
                            @php
                                $emp    = $row['employee'];
                                $ot     = $row['ot_config'];
                                $status = $row['payment_status'];
                            @endphp
                            <tr class="hover:bg-gray-50">
                                <td class="px-5 py-2.5 text-center">
                                    <input
                                        type="checkbox"
                                        value="{{ $emp->id }}"
                                        wire:model.live="selectedEmployeeIds"
                                        @disabled(! $row['can_mark_paid'])
                                        class="rounded border-borderColor text-primary focus:ring-primary disabled:opacity-40 disabled:cursor-not-allowed">
                                </td>
                                <td class="px-5 py-2.5 text-gray-500">{{ $index + 1 }}</td>
                                <td class="px-5 py-2.5">
                                    <div class="font-medium text-gray-900">
                                        {{ $emp->first_name }} {{ $emp->last_name }}
                                    </div>
                                    <div class="text-xs text-gray-400">{{ $emp->employee_code }}</div>
                                </td>
                                <td class="px-5 py-2.5 text-gray-500">
                                    {{ $emp->branch?->name ?? 'N/A' }}
                                </td>
                                <td class="px-5 py-2.5 text-gray-500">
                                    @if ($ot)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            {{ $ot->rate_type === 'fixed' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                                            {{ ucfirst($ot->rate_type) }}
                                            ({{ $ot->rate_type === 'percentage' ? $ot->rate . '%' : number_format($ot->rate, 2) }})
                                        </span>
                                    @else
                                        <span class="text-xs text-gray-400">N/A</span>
                                    @endif
                                </td>
                                <td class="px-5 py-2.5 text-gray-700 text-right font-mono">
                                    {{ number_format($row['total_ot_minutes']) }}
                                </td>
                                <td class="px-5 py-2.5 text-gray-700 text-right font-mono">
                                    {{ number_format($row['total_ot_hours'], 2) }}
                                </td>
                                <td class="px-5 py-2.5 text-gray-700 text-right font-mono">
                                    @if ($row['amount'] !== null)
                                        {{ number_format($row['amount'], 2) }}
                                    @else
                                        <span class="text-gray-400">—</span>
                                    @endif
                                </td>
                                <td class="px-5 py-2.5 text-center">
                                    @if ($status === 'paid')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="ti ti-check me-1"></i> Paid
                                        </span>
                                    @elseif ($status === 'unpaid')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            <i class="ti ti-clock me-1"></i> Unpaid
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-500">
                                            <i class="ti ti-minus me-1"></i> No OT
                                        </span>
                                    @endif
                                </td>
                                <td class="px-5 py-2.5 text-center">
                                    @if ($row['can_mark_paid'])
                                        <button
                                            wire:click="markAsPaid({{ $emp->id }})"
                                            wire:confirm="Create OT payment and mark this employee as paid?"
                                            class="inline-flex items-center px-3 py-1 text-xs font-medium rounded bg-success text-white hover:bg-green-700 transition">
                                            <i class="ti ti-check me-1"></i> Mark Paid
                                        </button>
                                    @else
                                        <span class="text-gray-400 text-xs">—</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="px-5 py-8 text-center text-gray-500">
                                    No employees with non-payroll OT found for this period.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($paginator->hasPages())
            <div class="card-footer py-4 px-5 border-t border-borderColor">
                {{ $paginator->links() }}
            </div>
        @endif
    </div>
    <!-- /OT Payment List -->
</div>

