<div>
    <div class="card border border-borderColor rounded-[5px] shadow-xs bg-white">
        <div class="card-header py-4 px-5 border-b border-borderColor flex items-center justify-between flex-wrap gap-3">
            <h4 class="card-title">Notice Details</h4>
            <a href="{{ route('admin.notice.index') }}" class="btn btn-light">Back to List</a>
        </div>
        <div class="card-body p-3">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <h5 class="text-sm font-medium text-gray-500">Branch</h5>
                    <p class="text-base text-gray-800">{{ $notice->branch->name }}</p>
                </div>
                <div>
                    <h5 class="text-sm font-medium text-gray-500">Department</h5>
                    <p class="text-base text-gray-800">{{ $notice->department->name }}</p>
                </div>
                <div>
                    <h5 class="text-sm font-medium text-gray-500">Notice Title</h5>
                    <p class="text-base text-gray-800">{{ $notice->title }}</p>
                </div>
                <div>
                    <h5 class="text-sm font-medium text-gray-500">Date</h5>
                    <p class="text-base text-gray-800">{{ $notice->created_at->format('F j, Y') }}</p>
                </div>
                @if ($notice->description)
                    <div class="md:col-span-2">
                        <h5 class="text-sm font-medium text-gray-500">Description</h5>
                        <p class="text-base text-gray-800 whitespace-pre-wrap">{!! $notice->description !!}</p>
                    </div>
                @endif

                @if ($notice->attachments)
                    <div class="md:col-span-2 flex flex-col gap-1">
                        <h5 class="text-sm font-medium text-gray-500">Attachment</h5>
                        @foreach ($notice->attachments as $attachment)
                            <a href="{{ route('file.download', ['filePath' => $attachment]) }}" target="_blank"
                                class="text-primary text-base">
                                {{ basename($attachment) }}
                            </a>
                        @endforeach
                    </div>
                @endif

                {{-- @if ($notice->readers->count())
                <div class="md:col-span-2">
                    <h5 class="text-sm font-medium text-gray-500">Readers</h5>
                    <p class="text-base text-gray-800">
                        {{ $notice->readers->pluck('employee_name')->join(', ') }}
                    </p>
                </div>
                @endif --}}

            </div>
        </div>
    </div>
</div>
