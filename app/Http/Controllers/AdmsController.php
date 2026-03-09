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
public function handshake(Request $request)
{
    //    \Log::info('device connected handshake');
       $sn = $request->query('SN');
        // \Log::info("Handshake received from Device SN: " . $sn);
    $data = [
        'url' => json_encode($request->all()),
        'data' => $request->getContent(),
        'sn' => $request->input('SN'),
        'option' => $request->input('option'),
    ];
    DB::table('device_logs')->insert($data);

    // update status device
    DB::table('devices')->updateOrInsert(
        ['no_sn' => $request->input('SN')],
        ['online' => now()]
    );

    $r = "GET OPTION FROM: {$request->input('SN')}\r\n" .
         "Stamp=9999\r\n" .
         "OpStamp=" . time() . "\r\n" .
         "ErrorDelay=60\r\n" .
         "Delay=30\r\n" .
         "ResLogDay=18250\r\n" .
         "ResLogDelCount=10000\r\n" .
         "ResLogCount=50000\r\n" .
         "TransTimes=00:00;14:05\r\n" .
         "TransInterval=1\r\n" .
         "TransFlag=1111000000\r\n" .
        //  "TimeZone=7\r\n" .
         "Realtime=1\r\n" .
         "Encrypt=0";

    return $r;
}

    public function receiveRecords(Request $request)
    {

        //DB::connection()->enableQueryLog();
        $content['url'] = json_encode($request->all());
        $content['data'] = $request->getContent();;
        // DB::table('finger_log')->insert($content);
        try {
            // $post_content = $request->getContent();
            //$arr = explode("\n", $post_content);
            $arr = preg_split('/\\r\\n|\\r|,|\\n/', $request->getContent());
            //$tot = count($arr);
            $tot = 0;
            //operation log
            if($request->input('table') == "OPERLOG"){
                // $tot = count($arr) - 1;
                foreach ($arr as $rey) {
                    if(isset($rey)){
                        $tot++;
                    }
                }
                return "OK: ".$tot;
            }
            //attendance
            foreach ($arr as $rey) {
                // $data = preg_split('/\s+/', trim($rey));
                if(empty($rey)){
                    continue;
                }
                    // $data = preg_split('/\s+/', trim($rey));
                    $data = explode("\t",$rey);
                    //dd($data);
                    $timestamp = Carbon::parse($data[1]);
                    $q['device_sn'] = $request->input('SN');
                    // $q['table'] = $request->input('table');
                    // $q['stamp'] = $request->input('Stamp');
                    $q['employee_id'] = $data[0];
                    $q['device_timestamp'] = $data[1];
                    $q['attendance_date']   = $timestamp->format('Y-m-d');
                    $q['attendance_time']   = $timestamp->format('H:i:s');
                    $q['attendance_minute'] = $timestamp->format('Y-m-d H:i');
                    // $q['status1'] = $this->validateAndFormatInteger($data[2] ?? null);
                    // $q['status2'] = $this->validateAndFormatInteger($data[3] ?? null);
                    // $q['status3'] = $this->validateAndFormatInteger($data[4] ?? null);
                    // $q['status4'] = $this->validateAndFormatInteger($data[5] ?? null);
                    // $q['status5'] = $this->validateAndFormatInteger($data[6] ?? null);
                    $q['created_at'] = now();
                    $q['updated_at'] = now();
                    //dd($q);
                    DB::table('attendance_logs')->insert($q);
                    $tot++;
                // dd(DB::getQueryLog());
            }
            return "OK: ".$tot;
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
