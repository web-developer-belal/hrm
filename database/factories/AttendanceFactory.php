<?php
namespace Database\Factories;

use App\Models\Branch;
use App\Models\Employee;
use App\Models\Roster;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendance>
 */
class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $date       = $this->faker->date();
        $shiftStart = '09:00:00';
        $shiftEnd   = '17:00:00';

        $status = $this->faker->randomElement([
            'present',
            'late',
            'absent',
            'leave',
            'holiday',
            'offday',
        ]);

        $clockIn          = null;
        $clockOut         = null;
        $lateMinutes      = 0;
        $overtimeMinutes  = 0;
        $earlyExitMinutes = 0;

        if (in_array($status, ['present', 'late'])) {

            // Base shift times
            $shiftStartTime = \Carbon\Carbon::parse($date . ' ' . $shiftStart);
            $shiftEndTime   = \Carbon\Carbon::parse($date . ' ' . $shiftEnd);

            // Late arrival
            if ($status === 'late') {
                $lateMinutes = $this->faker->numberBetween(5, 45);
                $clockIn     = $shiftStartTime->copy()->addMinutes($lateMinutes);
            } else {
                $clockIn = $shiftStartTime->copy()->subMinutes(
                    $this->faker->numberBetween(0, 5)
                );
            }

            // Random early exit or overtime
            if ($this->faker->boolean(30)) {
                // Early exit
                $earlyExitMinutes = $this->faker->numberBetween(5, 40);
                $clockOut         = $shiftEndTime->copy()->subMinutes($earlyExitMinutes);
            } else {
                // Overtime
                $overtimeMinutes = $this->faker->numberBetween(0, 90);
                $clockOut        = $shiftEndTime->copy()->addMinutes($overtimeMinutes);
            }
        }

        return [
            'branch_id'          => Branch::factory(),
            'employee_id'        => Employee::factory(),
            'roster_id'          => Roster::factory(),
            'date'               => $date,
            'shift_start_time'   => $shiftStart,
            'shift_end_time'     => $shiftEnd,
            'clock_in'           => $clockIn,
            'clock_out'          => $clockOut,
            'late_minutes'       => $lateMinutes,
            'overtime_minutes'   => $overtimeMinutes,
            'early_exit_minutes' => $earlyExitMinutes,
            'status'             => $status,
            'remarks'            => $this->faker->optional()->sentence,
            'is_manually_edited' => false,
            'edited_by'          => null,
            'edited_at'          => null,
        ];
    }
}
