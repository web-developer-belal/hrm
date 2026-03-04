<div>
    <!-- Breadcrumb -->
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">Complain Management</h2>
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
                    <li class="text-xs text-default">Complain Management</li>
                </ol>
            </nav>
        </div>
        <div class="flex my-xl-auto right-content items-center flex-wrap ">
            <div class="mb-2">
                <a href="{{ route('employee.complain.create') }}"
                    class="flex items-center bg-primary text-sm font-medium py-2 rounded text-white px-3 hover:bg-primary-900 hover:text-white">
                    <i class="ti ti-circle-plus me-2"></i>New Complain
                </a>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->

    <!-- Complains List -->
    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white">
        <div class="card-header py-4 px-5 border-b border-borderColor flex items-center justify-between flex-wrap gap-3">
            <h5>Complain List</h5>

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
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                SL
                            </th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Branch
                            </th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Complainant
                            </th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Against
                            </th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Subject
                            </th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Date
                            </th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Status
                            </th>
                            <th class="text-sm leading-normal px-5 py-2.5 bg-gray-200 text-gray-900 border-borderColor">
                                Document
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-borderColor">
                        @forelse ($complains as $complain)
                            <tr class="even:bg-white dark:even-bg-white">
                                <td class="px-5 py-2.5 text-gray-500">
                                    {{ ($complains->currentPage() - 1) * $complains->perPage() + $loop->iteration }}
                                </td>
                                <td class="px-5 py-2.5 text-gray-900">{{ $complain->branch?->name ?? 'N/A' }}</td>
                                <td class="px-5 py-2.5 text-gray-900">{{ $complain->complainant?->full_name ?? 'N/A' }}</td>
                                <td class="px-5 py-2.5 text-gray-900">{{ $complain->againstEmp?->full_name ?? 'N/A' }}</td>
                                <td class="px-5 py-2.5 text-gray-900">{{ $complain->subject }}</td>
                                <td class="px-5 py-2.5 text-gray-900">{{ \Carbon\Carbon::parse($complain->date)->format('d M Y') }}</td>
                                <td class="px-5 py-2.5">
                                    @php
                                        $statusClasses = [
                                            0 => 'badge bg-warning text-white',
                                            1 => 'badge bg-success text-white',
                                            2 => 'badge bg-danger text-white'
                                        ];
                                        $statusTexts = [
                                            0 => 'Pending',
                                            1 => 'Resolved',
                                            2 => 'Rejected'
                                        ];
                                    @endphp
                                    <span class="{{ $statusClasses[$complain->status] ?? 'badge bg-secondary' }} px-2 py-1 rounded text-xs">
                                        {{ $statusTexts[$complain->status] ?? 'Unknown' }}
                                    </span>
                                </td>
                                <td class="px-5 py-2.5 text-gray-900">
                                    @if($complain->documents && is_array($complain->documents) && count($complain->documents) > 0)
                                        <div class="flex gap-1">
                                            @foreach ($complain->documents as $index => $document)
                                                @if($index < 2)
                                                    <span class="text-xs bg-gray-100 px-2 py-1 rounded">
                                                        {{ $document }}
                                                    </span>
                                                @endif
                                            @endforeach
                                            @if(count($complain->documents) > 2)
                                                <span class="text-xs text-gray-500">+{{ count($complain->documents) - 2 }} more</span>
                                            @endif
                                        </div>
                                    @else
                                        <span class="text-gray-400">No documents</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-5 py-8 text-center text-gray-500">
                                    No complains found.
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

        @if ($complains->hasPages())
            <div class="card-footer py-4 px-5 border-t border-borderColor">
                {{ $complains->links() }}
            </div>
        @endif
    </div>
    <!-- /Complains List -->
</div>
