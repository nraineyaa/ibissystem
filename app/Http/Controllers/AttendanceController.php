<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class AttendanceController extends Controller
{
    public function checkIn(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Check if the user has already checked in today
        $existingAttendance = DB::table('attendance')
            ->where('userID', $user->id)
            ->whereDate('date', Carbon::now()->toDateString())
            ->first();

        if ($existingAttendance) {
            return redirect()->back()->with('message', 'You have already checked in today.');
        }

        // Get the authenticated user
        $userID = Auth::user()->id;    
        // Set the timezone to Kuala Lumpur
        $kl_timezone = 'Asia/Kuala_Lumpur';
    

        // Get today's date in Kuala Lumpur timezone
        $today_date = Carbon::now($kl_timezone)->toDateString();
        $checkinTime = Carbon::now($kl_timezone)->toTimeString();
        $status = $request->input('status');

       $data = array(
            'userID' => $userID,
            'date' => $today_date,
            'status' => $status,
            'checkIn' => $checkinTime,

        );

        // insert query
        DB::table('attendance')->insert($data);
    
        return redirect()->back()->with('message', 'Check-in successful');
    }

    public function checkOut($id)
    {
   
    
    // Set the timezone to Kuala Lumpur
    $kl_timezone = 'Asia/Kuala_Lumpur';

    // Get today's date in Kuala Lumpur timezone
    $today_date = Carbon::now($kl_timezone)->toDateString();
    $checkoutTime = Carbon::now($kl_timezone)->toTimeString();

    // Update the attendance record for the user with the checkout time
        DB::table('attendance')
        
            ->where('id', $id)
            ->update(['checkout' => $checkoutTime]);

        return redirect()->back()->with('message', 'Check-out successful');
    }

    public function attendance()
    {
        $currentUser = Auth::user()->id;

        $attendList = DB::table('attendance')
        ->where ('attendance.userID', '=', $currentUser)
        ->get();
    
        return view('attendance.attendance', compact('attendList','currentUser'));
    }

}