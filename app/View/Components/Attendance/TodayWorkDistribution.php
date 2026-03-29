<?php

namespace App\View\Components\Attendance;

use App\Models\Attendance as AttendanceModel;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TodayWorkDistribution extends Component
{
    public ?AttendanceModel $attendance;
    public string $timezone;
    public bool $hasPunchIn;
    public string $workingHours;
    public string $productiveHours;
    public string $breakHours;
    public string $overtimeHours;
    public string $shiftLabel;
    public string $attendanceLabel;
    public array $segments;
    public array $timelineLabels;

    public function __construct(?AttendanceModel $attendance = null, string $timezone = 'Asia/Dhaka')
    {
        $this->attendance = $attendance;
        $this->timezone = $timezone;
        $this->hasPunchIn = (bool) $attendance?->clock_in;

        $now = Carbon::now($timezone);
        [$shiftStart, $shiftEnd] = $this->resolveShiftBounds($attendance, $now);

        $workedMinutes = 0;
        $breakMinutes = 0;
        $productiveMinutes = 0;
        $lateMinutes = 0;
        $overtimeMinutes = 0;
        $shiftMinutes = $shiftStart->diffInMinutes($shiftEnd);

        if ($attendance && $attendance->clock_in) {
            $breakMinutes = max(0, (int) ($attendance->in_grace_period_minutes ?? 0) + (int) ($attendance->out_grace_period_minutes ?? 0));
            $lateMinutes = max(0, (int) ($attendance->late_minutes ?? 0));

            $clockIn = $attendance->clock_in->copy()->timezone($timezone);
            $clockOut = $attendance->clock_out
                ? $attendance->clock_out->copy()->timezone($timezone)
                : $now->copy();

            if ($clockOut->lt($clockIn)) {
                $clockOut->addDay();
            }

            $workedMinutes = $clockIn->diffInMinutes($clockOut);
            $productiveMinutes = max(0, $workedMinutes - $breakMinutes);
            $overtimeMinutes = max(0, (int) ($attendance->overtime_minutes ?? 0));

            if (! $attendance->clock_out && $clockOut->gt($shiftEnd)) {
                $overtimeMinutes = $shiftEnd->diffInMinutes($clockOut);
            }
        }

        $productiveWithinShift = min($productiveMinutes, max(0, $shiftMinutes - $lateMinutes - $breakMinutes));
        $remainingMinutes = max(0, $shiftMinutes - $lateMinutes - $breakMinutes - $productiveWithinShift);
        $timelineTotal = max(1, $shiftMinutes + $overtimeMinutes);

        $this->workingHours = $this->formatMinutes($workedMinutes);
        $this->productiveHours = $this->formatMinutes($productiveMinutes);
        $this->breakHours = $this->formatMinutes($breakMinutes);
        $this->overtimeHours = $this->formatMinutes($overtimeMinutes);
        $this->shiftLabel = $shiftStart->format('h:i A') . ' - ' . $shiftEnd->format('h:i A');
        $this->attendanceLabel = $this->hasPunchIn
            ? 'Today\'s shift distribution'
            : 'Punch in to see today\'s shift distribution';

        $this->segments = $this->buildSegments([
            [
                'label' => 'Late',
                'minutes' => $lateMinutes,
                'barClass' => 'bg-warning',
                'dotClass' => 'bg-warning',
            ],
            [
                'label' => 'Productive',
                'minutes' => $productiveWithinShift,
                'barClass' => 'bg-success',
                'dotClass' => 'bg-success',
            ],
            [
                'label' => 'Break',
                'minutes' => $breakMinutes,
                'barClass' => 'bg-gray-300',
                'dotClass' => 'bg-gray-400',
            ],
            [
                'label' => 'Remaining Shift',
                'minutes' => $remainingMinutes,
                'barClass' => 'bg-gray-100',
                'dotClass' => 'bg-gray-300',
            ],
            [
                'label' => 'Overtime',
                'minutes' => $overtimeMinutes,
                'barClass' => 'bg-info',
                'dotClass' => 'bg-info',
            ],
        ], $timelineTotal);

        $timelineEnd = $shiftEnd->copy()->addMinutes($overtimeMinutes);
        $this->timelineLabels = $this->buildTimelineLabels($shiftStart, $timelineEnd);
    }

    public function render(): View|Closure|string
    {
        return view('components.attendance.today-work-distribution');
    }

    private function resolveShiftBounds(?AttendanceModel $attendance, Carbon $now): array
    {
        $baseDate = $attendance?->date?->copy()->timezone($this->timezone) ?? $now->copy();

        $shiftStartTime = $attendance?->shift_start_time ?: '09:00:00';
        $shiftEndTime = $attendance?->shift_end_time ?: '18:00:00';

        $shiftStart = $baseDate->copy()->setTimeFromTimeString($shiftStartTime);
        $shiftEnd = $baseDate->copy()->setTimeFromTimeString($shiftEndTime);

        if ($shiftEnd->lte($shiftStart)) {
            $shiftEnd->addDay();
        }

        return [$shiftStart, $shiftEnd];
    }

    private function buildSegments(array $segments, int $timelineTotal): array
    {
        return collect($segments)
            ->filter(fn (array $segment) => $segment['minutes'] > 0)
            ->map(function (array $segment) use ($timelineTotal) {
                $segment['width'] = round(($segment['minutes'] / $timelineTotal) * 100, 2);
                $segment['value'] = $this->formatMinutes($segment['minutes']);

                return $segment;
            })
            ->values()
            ->all();
    }

    private function buildTimelineLabels(Carbon $start, Carbon $end): array
    {
        $labels = [];
        $totalMinutes = max(1, $start->diffInMinutes($end));

        for ($index = 0; $index < 5; $index++) {
            $minutes = (int) round(($totalMinutes / 4) * $index);
            $labels[] = $start->copy()->addMinutes($minutes)->format('h:i A');
        }

        return $labels;
    }

    private function formatMinutes(int $minutes): string
    {
        $hours = intdiv($minutes, 60);
        $mins = $minutes % 60;

        return $hours . 'h ' . $mins . 'm';
    }
}