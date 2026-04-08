<div>
    <div class="md:flex block items-center justify-between page-breadcrumb mb-4">
        <div class="my-auto mb-2">
            <h2 class="mb-1">Leave Details</h2>
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}"
                            class="inline-flex items-center text-xs text-gray-500 hover:text-primary">
                            <i class="ti ti-smart-home"></i>
                        </a>
                    </li>
                    <li><span class="text-default">/</span></li>
                    <li class="text-xs text-default">Leave Details</li>
                </ol>
            </nav>
        </div>

        <div class="mb-2">
            <a href="{{ route('admin.leavemgt.leave.list') }}" class="btn btn-light">Back to List</a>
        </div>
    </div>

    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white">
        <div class="card-header py-4 px-5 border-b border-borderColor flex items-center justify-between flex-wrap gap-3">
            <h4 class="card-title">Leave Details</h4>
            <span class="inline-flex items-center rounded px-3 py-1 text-xs font-medium
                {{ strtolower($leave->status ?? '') === 'approved' ? 'bg-success/10 text-success' : (strtolower($leave->status ?? '') === 'rejected' ? 'bg-danger/10 text-danger' : 'bg-warning/10 text-warning') }}">
                {{ ucfirst($leave->status ?? 'pending') }}
            </span>
        </div>

        <div class="card-body p-5">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <h5 class="text-sm font-medium text-gray-500">Employee</h5>
                    <p class="text-base text-gray-800">{{ $leave->employee?->full_name ?? '--' }}</p>
                </div>
                <div>
                    <h5 class="text-sm font-medium text-gray-500">Branch</h5>
                    <p class="text-base text-gray-800">{{ $leave->branch?->name ?? '--' }}</p>
                </div>
                <div>
                    <h5 class="text-sm font-medium text-gray-500">Department</h5>
                    <p class="text-base text-gray-800">{{ $leave->employee?->department?->name ?? '--' }}</p>
                </div>
                <div>
                    <h5 class="text-sm font-medium text-gray-500">Leave Type</h5>
                    <p class="text-base text-gray-800">{{ $leave->type?->name ?? '--' }}</p>
                </div>
                <div>
                    <h5 class="text-sm font-medium text-gray-500">From Date</h5>
                    <p class="text-base text-gray-800">{{ $leave->from_date?->format('F j, Y') ?? '--' }}</p>
                </div>
                <div>
                    <h5 class="text-sm font-medium text-gray-500">To Date</h5>
                    <p class="text-base text-gray-800">{{ $leave->to_date?->format('F j, Y') ?? '--' }}</p>
                </div>
                <div>
                    <h5 class="text-sm font-medium text-gray-500">Total Days</h5>
                    <p class="text-base text-gray-800">{{ $leave->total_days ?? 0 }}</p>
                </div>
                <div>
                    <h5 class="text-sm font-medium text-gray-500">Requested On</h5>
                    <p class="text-base text-gray-800">{{ $leave->created_at?->format('F j, Y') ?? '--' }}</p>
                </div>
                <div class="md:col-span-2">
                    <h5 class="text-sm font-medium text-gray-500">Reason</h5>
                    <div class="text-base text-gray-800 rounded border border-borderColor bg-gray-50 p-3">
                        {!! $leave->descriptions ?: '<span class="text-gray-500">No reason provided.</span>' !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
