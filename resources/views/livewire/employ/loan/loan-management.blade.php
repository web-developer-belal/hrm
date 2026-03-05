<div>
    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">Loan Management</h2>
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
                    <li class="text-xs text-default">Loan Management</li>
                </ol>
            </nav>
        </div>
        <div class="flex my-xl-auto right-content items-center flex-wrap ">
            <div class="mb-2">
                <a href="{{ route('employee.loan.create') }}"
                    class="flex items-center bg-primary text-sm font-medium py-2 rounded text-white px-3 hover:bg-primary-900 hover:text-white">
                    <i class="ti ti-circle-plus me-2"></i>New Loan
                </a>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Loans List -->
    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white">
        <div class="card-header py-4 px-5 border-b border-borderColor flex items-center justify-between flex-wrap gap-3">
            <h5>Loan List</h5>

            <div class="flex items-center gap-3">
                <div class="relative w-[250px]" wire:key="date-range-picker">
                    <x-form.date-range-picker
                        :startDate="$startDate"
                        :endDate="$endDate"
                    />
                </div>

                @if($startDate || $endDate)
                    <button
                        wire:click="clearDateFilter"
                        class="flex items-center text-sm text-gray-600 hover:text-primary transition-colors"
                        title="Clear date filter">
                        <i class="ti ti-x"></i>
                        <span class="ml-1">Clear</span>
                    </button>
                @endif
            </div>
        </div>

        <div class="card-body p-0">
            <div class="overflow-x-auto">
                <table class="table w-full border-b border-borderColor">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-start text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                SL
                            </th>
                            <th class="text-start text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Amount
                            </th>
                            <th class="text-start text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Installment
                            </th>
                            <th class="text-start text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Emi Amount
                            </th>
                            <th class="text-start text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Remaining Amount
                            </th>
                            <th class="text-start text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Start Month
                            </th>
                            <th class="text-start text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Status
                            </th>
                            <th class="text-start text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Action
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-borderColor">
                        @forelse ($loans as $item)
                            <tr class="even:bg-white dark:even-bg-white">
                                <td class="px-5 py-2.5 text-gray-500">
                                    {{ ($loans->currentPage() - 1) * $loans->perPage() + $loop->iteration }}
                                </td>
                                <td class="px-5 py-2.5 text-gray-900">
                                    {{ number_format($item->amount, 2) ?? 'N/A' }}
                                </td>
                                <td class="px-5 py-2.5 text-gray-500">
                                    {{ $item->installments ?? 'N/A' }}
                                </td>
                                <td class="px-5 py-2.5 text-gray-500">
                                    {{ number_format($item->emi_amount, 2) ?? 'N/A' }}
                                </td>
                                <td class="px-5 py-2.5 text-gray-500">
                                    {{ number_format($item->remaining_amount, 2) ?? 'N/A' }}
                                </td>
                                <td class="px-5 py-2.5 text-gray-500">
                                    {{ \Carbon\Carbon::parse($item->start_month)->format('d M Y') }}
                                </td>
                                <td class="px-5 py-2.5">
                                    @php
                                        $statusClasses = [
                                            'active' => 'badge bg-success text-white',
                                            'completed' => 'badge bg-info text-white'
                                        ];
                                        $statusTexts = [
                                            'active' => 'Active',
                                            'completed' => 'Completed'
                                        ];
                                    @endphp
                                    <span class="{{ $statusClasses[$item->status] ?? 'badge bg-secondary' }} px-2 py-1 rounded text-xs">
                                        {{ $statusTexts[$item->status] ?? ucfirst($item->status) }}
                                    </span>
                                </td>
                                <td class="px-5 py-2.5 text-gray-500">
                                    <div class="action-icon inline-flex">
                                        <a href="{{ route('employee.loan.show', ['loan' => $item->id]) }}"
                                            class="me-2 size-[26px] flex items-center justify-center rounded-[5px] hover:bg-light-900 hover:text-gray-900"
                                            title="View Details">
                                            <i class="ti ti-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-5 py-8 text-center text-gray-500">
                                    No loans found.
                                    @if($startDate || $endDate)
                                        <button wire:click="clearDateFilter" class="text-primary underline ml-1">
                                            Clear date filter
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if ($loans->hasPages())
            <div class="card-footer py-4 px-5 border-t border-borderColor">
                {{ $loans->links() }}
            </div>
        @endif
    </div>
    <!-- /Loans List -->
</div>
