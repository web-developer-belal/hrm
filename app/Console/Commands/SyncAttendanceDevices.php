<?php
namespace App\Console\Commands;

use App\Models\AttendanceLog;
use App\Models\Device;
use App\Models\DeviceSyncHistories;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Rats\Zkteco\Lib\ZKTeco;

class SyncAttendanceDevices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-attendance-devices';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync attendance logs from all ZKTeco devices';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $devices = Device::where('status', 1)->get(); // Sync all devices

        foreach ($devices as $device) {
            $this->info("Syncing device: {$device->ip_address}");

            $history = DeviceSyncHistories::create([
                'device_id'       => $device->id,
                'sync_started_at' => now(),
                'status'          => 'processing',
            ]);

            try {
                $zk = new ZKTeco($device->ip_address, $device->port);

                if ($zk->connect()) {
                    $logs = $zk->getAttendance();
                    $zk->disconnect();

                    $count = 0;
                    foreach ($logs as $log) {
                        $timestamp = Carbon::parse($log['timestamp']);
                        $minuteKey = $timestamp->format('Y-m-d H:i');

                        AttendanceLog::firstOrCreate(
                            ['employee_id' => $log['id'], 'attendance_minute' => $minuteKey],
                            [
                                'device_id'        => $device->id,
                                'attendance_date'  => $timestamp->format('Y-m-d'),
                                'attendance_time'  => $timestamp->format('H:i:s'),
                                'device_timestamp' => $timestamp,
                            ]
                        );
                        $count++;
                    }

                    $history->update([
                        'total_logs'        => $count,
                        'sync_completed_at' => now(),
                        'status'            => 'success',
                    ]);
                } else {
                    throw new \Exception("Could not connect to device.");
                }

            } catch (\Exception $e) {
                $history->update([
                    'status'            => 'failed',
                    'message'           => $e->getMessage(),
                    'sync_completed_at' => now(),
                ]);
                $this->error("Failed for device {$device->ip_address}: " . $e->getMessage());
            }
        }
    }
}
