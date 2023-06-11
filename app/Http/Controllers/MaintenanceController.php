<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;


class MaintenanceController extends Controller
{
    //display new user 
    public function index()
    { //
        $jobList = DB::table('jobs')
            ->select(
                
                'id',
                'jobTitle',
                'date',
                'location',
                'jobDesc',
                'userID',
                'workersName',

            )
            ->orderBy('jobTitle', 'asc')
            ->get();


            $reportList = DB::table('report')
            ->select(
                
                'id',
                'reportTitle',
                'date',
                'file',
                'remark',
                'userID',

            )
            ->orderBy('reportTitle', 'asc')
            ->get();



        return view('maintenance.maintenance', compact('jobList', 'reportList'));
    }

    public function reportForm(Request $request)
    {

        return view('maintenance.reportForm');
    }

    public function jobForm(Request $request)
    {
        $workers = User::join('attendance', 'attendance.userID', '=', 'users.id')
            ->where('users.category', 'Worker')
            ->where('attendance.status', 'Available')
            ->pluck('users.name')
            ->all();



        return view('maintenance.jobForm', compact('workers'));
    }

    public function addJob(Request $request)
    {

        $currUser = Auth::user()->id;

        $jobTitle = $request->input('jobTitle');
        $date = $request->input('date');
        $location = $request->input('location');
        $jobDesc = $request->input('jobDesc');
        $workersName = $request->input('workersName');
        $userID = $currUser;

        $data = array(


            'jobTitle' => $jobTitle,
            'date' => $date,
            'location' => $location,
            'jobDesc' => $jobDesc,
            'workersName' => $workersName,
            'userID' => $userID,

        );


        DB::table('jobs')->insert($data);

        return back()->with('success', 'Job successfully added');
    }

    public function addReport(Request $request)
    {

        $currUser = Auth::user()->id;
        $request->validate([
            'file' => 'required|mimes:pdf,xlx,csv|max:2048',
        ]);

        $file = time() . '.' . $request->file->extension();
        $request->file->move(public_path('uploads'), $file);


        $reportTitle = $request->input('reportTitle');
        $date = $request->input('date');
        $remark = $request->input('remark');
        $userID = $currUser;

        $data = array(


            'reportTitle' => $reportTitle,
            'date' => $date,
            'file' => $file,
            'remark' => $remark,
            'userID' => $userID,

        );


        DB::table('report')->insert($data);

        return back()->with('success', 'Job successfully added');
    }
}
