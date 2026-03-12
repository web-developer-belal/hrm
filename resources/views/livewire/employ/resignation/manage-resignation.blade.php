<div>
    @if ($isDetails)
        <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
            <div class="my-auto mb-2">
                <h2 class="mb-1">Resignation Details</h2>
            </div>
            <div class="mb-2">
                <a href="{{ route('employee.resignations.index') }}"
                    class="flex items-center bg-primary text-sm font-medium py-2 rounded text-white px-3 hover:bg-primary-900 hover:text-white">
                    <i class="ti ti-arrow-left me-2"></i>Back To List
                </a>
            </div>
        </div>

        <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white">
            <div class="card-body p-5 space-y-4">
                <div><strong>Subject:</strong> {{ $resignation->subject }}</div>
                <div><strong>Resignation Date:</strong> {{ $resignation->resignation_date?->format('d-M-Y') }}</div>
                <div><strong>Status:</strong> {{ ucfirst($resignation->status) }}</div>
                <div><strong>Reason:</strong> {!! $resignation->reason ?: 'N/A' !!}</div>
                <div><strong>Admin Comment:</strong> {{ $resignation->comment ?: 'N/A' }}</div>
                <div><strong>Reviewed By:</strong> {{ $resignation->approver->name ?? 'N/A' }}</div>
            </div>
        </div>
    @else
        <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
            <div class="my-auto mb-2">
                <h2 class="mb-1">My Resignations</h2>
            </div>
            <div class="mb-2">
                <a href="{{ route('employee.resignations.create') }}"
                    class="flex items-center bg-primary text-sm font-medium py-2 rounded text-white px-3 hover:bg-primary-900 hover:text-white">
                    <i class="ti ti-circle-plus me-2"></i>New Application
                </a>
            </div>
        </div>

        <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white">
            <div class="card-header py-4 px-5 border-b border-borderColor flex items-center justify-between gap-3 flex-wrap">
                <div class="w-full md:w-1/3">
                    <input type="text" wire:model.live="search" class="form-control" placeholder="Search subject or reason">
                </div>
                <div class="w-full md:w-1/4">
                    <select wire:model.live="status" class="form-control">
                        <option value="">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="overflow-x-auto">
                    <table class="table w-full border-b border-borderColor">
                        <thead>
                            <tr>
                                <th class="px-5 py-2.5 bg-gray-200">SL</th>
                                <th class="px-5 py-2.5 bg-gray-200">Subject</th>
                                <th class="px-5 py-2.5 bg-gray-200">Date</th>
                                <th class="px-5 py-2.5 bg-gray-200">Status</th>
                                <th class="px-5 py-2.5 bg-gray-200">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($resignations as $item)
                                <tr>
                                    <td class="px-5 py-2.5">{{ $resignations->firstItem() + $loop->index }}</td>
                                    <td class="px-5 py-2.5">{{ $item->subject }}</td>
                                    <td class="px-5 py-2.5">{{ $item->resignation_date?->format('d-M-Y') }}</td>
                                    <td class="px-5 py-2.5">{{ ucfirst($item->status) }}</td>
                                    <td class="px-5 py-2.5">
                                        <a href="{{ route('employee.resignations.details', ['resignation' => $item->id]) }}"
                                            class="text-primary hover:underline">View</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-5 py-4 text-center text-gray-500">No resignations found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if ($resignations->hasPages())
                <div class="card-footer py-4 px-5 border-t border-borderColor">
                    {{ $resignations->links() }}
                </div>
            @endif
        </div>
    @endif
</div>
