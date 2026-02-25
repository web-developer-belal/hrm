<?php

namespace App\Livewire\Admin\Device;

use App\Models\AttendanceLog;
use App\Models\Device;
use App\Models\DeviceSyncHistories;
use Carbon\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Rats\Zkteco\Lib\ZKTeco;

class DeviceSync extends Component
{

    public bool $Modalshow = false;
    #[Validate('required')]
    public $name;

    #[Validate('required')]
    public $ip_address;

    #[Validate('nullable|numeric')]
     public $port;
    #[Validate('nullable')]
     public $status;

     public $device_id;


    public function addDevice($id=null)
    {
        $this->Modalshow = true;
            if($id){

                $this->device_id = Device::find($id);
                $this->name = $this->device_id->name;
                $this->ip_address = $this->device_id->ip_address;
                $this->port = $this->device_id->port;
                $this->status = $this->device_id->status;
            }
    }
     public function closeModal()
     {
         $this->Modalshow = false;
         $this->resetErrorBag();
     }
     public function saveDeviceIP()
     {
        $validateData = $this->validate();

        if($this->device_id )
        {
        $this->device_id->update($validateData);
        }else{
            Device::create($validateData);
        }


        $this->reset(['name','ip_address','port']);
        $this->Modalshow = false;
        flash()->success( 'Device Created or Updated successfully.');

     }

     public function sync($deviceId)
     {
         $device = Device::find($deviceId);

         $history = DeviceSyncHistories::create([
             'device_id' => $device->id,
             'sync_started_at' => now(),
             'status' => 'processing'
         ]);

         try {
             $zk = new ZKTeco($device->ip_address, $device->port);
             $zk->connect();
             $logs = $zk->getAttendance();
             $zk->disconnect();

             $count = 0;

             foreach ($logs as $log) {

                 $timestamp = Carbon::parse($log['timestamp']);

                 $minuteKey = $timestamp->format('Y-m-d H:i');

                 AttendanceLog::firstOrCreate(
                     [
                         'employee_id' => $log['id'],
                         // 'attendance_minute' => $minuteKey,
                     ],
                     [
                         'attendance_minute' => $minuteKey,
                         'device_id' => $device->id,
                         'attendance_date' => $timestamp->format('Y-m-d'),
                         'attendance_time' => $timestamp->format('H:i:s'),
                         'device_timestamp' => $timestamp
                     ]
                 );

                 $count++;
             }

             $history->update([
                 'total_logs' => $count,
                 'sync_completed_at' => now(),
                 'status' => 'success'
             ]);

         } catch (\Exception $e) {

             $history->update([
                 'status' => 'failed',
                 'message' => $e->getMessage(),
                 'sync_completed_at' => now(),
             ]);
         }
     }


    public function render()
    {

        return view('livewire.admin.device.device-sync',[
            'devices'=> Device::all(),
        ]);
    }
}
