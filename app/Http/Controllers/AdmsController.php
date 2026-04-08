<?php

namespace App\Http\Controllers;

use App\Models\AttendanceLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdmsController extends Controller
{
  public function __invoke(Request $request)
   {

   }
       // handshake
       
   public function handle(Request $request)
{
    \Log::info("METHOD: " . $request->method());
    
    if ($request->isMethod('get')) {
        return $this->handshake($request);
    }

    return $this->receiveRecords($request);
}    
       
public function handshake(Request $request)
{
        \Log::info('device connected handshake');
       $sn = $request->query('SN');
        \Log::info("Handshake received from Device SN: " . $sn);
        \Log::info("All Request",$request->all());
    $data = [
        'url' => json_encode($request->all()),
        'data' => $request->getContent(),
        'sn' => $request->input('SN'),
        'option' => $request->input('option'),
    ];
    DB::table('device_logs')->insert($data);
    
    // \Log::info("device log", $data);

    // update status device
    DB::table('devices')->updateOrInsert(
        ['no_sn' => $request->input('SN')],
        ['online' => now()]
    );

    // $r = "GET OPTION FROM: {$request->input('SN')}\r\n" .
    //      "Stamp=9999\r\n" .
    //      "OpStamp=" . time() . "\r\n" .
    //      "ErrorDelay=60\r\n" .
    //      "Delay=30\r\n" .
    //      "ResLogDay=18250\r\n" .
    //      "ResLogDelCount=10000\r\n" .
    //      "ResLogCount=50000\r\n" .
    //      "TransTimes=00:00;14:05\r\n" .
    //      "TransInterval=1\r\n" .
    //      "TransFlag=1111000000\r\n" .
    //     //  "TimeZone=7\r\n" .
    //      "Realtime=1\r\n" .
    //      "Encrypt=0";

    // return $r;
    
    $r = "GET OPTION FROM: {$request->input('SN')}\n" .
     "Stamp=0\n" .
     "OpStamp=0\n" .
     "ErrorDelay=60\n" .
     "Delay=30\n" .
     "TransTimes=00:00;23:59\n" .
     "TransInterval=1\n" .
     "TransFlag=1111111111\n" .
     "Realtime=1\n";

return response($r, 200)
        ->header('Content-Type', 'text/plain');
}



     public function receiveRecords(Request $request)
    {   
        
        \Log::info('device receive');
        \Log::info($request->input('SN'));
        //DB::connection()->enableQueryLog();
        $content['url'] = json_encode($request->all());
      
       
        $content['data'] = $request->getContent();
        \Log::info("AllLogData",$content);
        
       
        try {
           
            $arr = preg_split('/\r\n|\r|\n/', $request->getContent());

    $tot = 0;
    $insertData = [];

    // Handle OPERLOG
    if ($request->input('table') == "OPERLOG") {

        foreach ($arr as $row) {
            if (!empty(trim($row))) {
                $tot++;
            }
        }

        return "OK: " . $tot;
    }

    // Handle ATTLOG
    foreach ($arr as $row) {

        if (empty(trim($row))) {
            continue;
        }

        $data = explode("\t", trim($row));

        // âœ… Safety check
        if (count($data) < 2) {
            continue;
        }

        try {

            $timestamp = Carbon::parse($data[1]);
            
             // Logging 
        \Log::info("ATTLOG Row", [
            'employee_id' => $data[0] ?? null,
            'time' => $data[1] ?? null,
            'status1' => $data[2] ?? null,
            'status2' => $data[3] ?? null,
            'status3' => $data[4] ?? null,
            'status4' => $data[5] ?? null,
            'status5' => $data[6] ?? null,
        ]);

            $insertData[] = [
                'device_sn' => $request->input('SN'),
                'attd_table' => $request->input('table'),
                'stamp' => $request->input('Stamp'),
                'employee_id' => $data[0],
                'device_timestamp' => $data[1],

                'attendance_date'   => $timestamp->format('Y-m-d'),
                'attendance_time'   => $timestamp->format('H:i:s'),
                'attendance_minute' => $timestamp->format('Y-m-d H:i'),
                
                    // 'status1' => $data[2] ?? null,
                    // 'status2' => $data[3] ?? null,
                    // 'status3' => $data[4] ?? null,
                    // 'status4' => $data[5] ?? null,
                    // 'status5' => $data[6] ?? null,

               

                'created_at' => now(),
                'updated_at' => now(),
            ];

            $tot++;

        } catch (\Exception $e) {
            Log::error("Parse Error: " . $e->getMessage());
        }
    }

    // Bulk Insert (FAST)
    if (!empty($insertData)) {
        // DB::table('attendances')->insert($insertData);
        DB::table('attendance_logs')->insert($insertData);
    }

    return "OK: " . $tot;
            
            
        } catch (Throwable $e) {
            $data['error'] = $e;
            DB::table('error_log')->insert($data);
            report($e);
            return "ERROR: ".$tot."\n";
        }
    }
    
    public function test(Request $request)
    {
        // \Log::info('device connected test');
              $log['data'] = $request->getContent();
                DB::table('finger_log')->insert($log);
    }
    public function getrequest(Request $request)
    {
        // \Log::info('device connected get request');

        return "OK";
    }
    private function validateAndFormatInteger($value)
    {
        // \Log::info('device connected validate');
        return isset($value) && $value !== '' ? (int)$value : null;
        // return is_numeric($value) ? (int) $value : null;
    }
}
