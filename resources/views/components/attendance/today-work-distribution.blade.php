<div class="card border-bordercolor bg-white rounded-[5px] shadow-xs w-full">
    <div class="card-body p-5">
        <div class="flex items-center justify-between gap-3 flex-wrap mb-4">
            <div>
                <h5 class="mb-1">Today's Attendance Work</h5>
                <p class="text-xs text-gray-500 mb-0">{{ $attendanceLabel }}</p>
            </div>
            <span class="text-xs font-medium py-1 px-2 rounded bg-primary-100 text-primary">Shift: {{ $shiftLabel }}</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4 mb-4">
            <div>
                <span class="flex items-center mb-1"><i class="ti ti-point-filled me-1"></i>Total Working hours</span>
                <h3>{{ $workingHours }}</h3>
            </div>
            <div>
                <span class="flex items-center mb-1"><i class="ti ti-point-filled text-success me-1"></i>Productive Hours</span>
                <h3>{{ $productiveHours }}</h3>
            </div>
            <div>
                <span class="flex items-center mb-1"><i class="ti ti-point-filled text-warning me-1"></i>Break hours</span>
                <h3>{{ $breakHours }}</h3>
            </div>
            <div>
                <span class="flex items-center mb-1"><i class="ti ti-point-filled text-info me-1"></i>Overtime</span>
                <h3>{{ $overtimeHours }}</h3>
            </div>
        </div>

        <div class="mb-3">
            <div class="flex items-center justify-center h-6 rounded-[5px] bg-gray-100 overflow-hidden border border-borderColor">
                @forelse ($segments as $segment)
                    <div
                        class="h-full {{ $segment['barClass'] }}"
                        style="width: {{ $segment['width'] }}%"
                        title="{{ $segment['label'] }}: {{ $segment['value'] }}">
                    </div>
                @empty
                    <div class="h-full bg-gray-100 w-full"></div>
                @endforelse
            </div>
        </div>

        <div class="flex items-center justify-center gap-4 flex-wrap mb-3">
            @foreach ($segments as $segment)
                <span class="inline-flex items-center text-xs text-gray-600">
                    <span class="inline-block size-2 rounded-full {{ $segment['dotClass'] }} me-2"></span>
                    {{ $segment['label'] }}: {{ $segment['value'] }}
                </span>
            @endforeach

            @if (empty($segments))
                <span class="text-xs text-gray-500">No attendance activity recorded for today yet.</span>
            @endif
        </div>

        <div class="flex items-center justify-between gap-2 flex-wrap text-xs text-gray-500">
            @foreach ($timelineLabels as $label)
                <span>{{ $label }}</span>
            @endforeach
        </div>
    </div>
</div>