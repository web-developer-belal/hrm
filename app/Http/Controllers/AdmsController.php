<?php

namespace App\Http\Controllers;

use App\Models\AttendanceLog;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdmsController extends Controller
{
    public function receive(Request $request)
    {
       $data = $request->getContent();

        if (!$data) {
            return response('OK');
        }

        $lines = explode("\n", trim($data));

        foreach ($lines as $line) {

            $row = explode("\t", $line);

        
            if (count($row) >= 2) {

                $employeeId = $row[0];
                $timestamp  = Carbon::parse($row[1]);

                $minuteKey = $timestamp->format('Y-m-d H:i');

                AttendanceLog::updateOrCreate(
                    [
                        'employee_id' => $employeeId,
                        'attendance_minute' => $minuteKey,
                    ],
                    [
                        
                        'attendance_date' => $timestamp->format('Y-m-d'),
                        'attendance_time' => $timestamp->format('H:i:s'),
                        'device_timestamp' => $timestamp
                    ]
                );
            }
        }

        return response('OK');
    }

    public function getRequest(Request $request)
    {
        // Handle the incoming request from the mobile app
        $requestData = $request->all();
        // Process the request as needed (e.g., fetch data from database, perform actions)
        // For demonstration, we'll just return a success response with some dummy data
        return response()->json(['status' => 'success', 'message' => 'Request received successfully', 'data' => $requestData]);
    }
}
