<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Jobs;
use Illuminate\Support\Facades\Auth;


class MaintenanceController extends Controller
{
    //display new user 
    public function index()
    { //

        

        $currID = Auth::user()->id;

        $currUser = Auth::user()->category;
        $jobList = DB::table('jobs')
            ->where('jobs.userID', '=', $currID)
            ->select(

                'id',
                'jobTitle',
                'date',
                'location',
                'jobDesc',
                'userID',
                'workersName',
                'status',

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
        $workers =  User::join('attendance', 'attendance.userID', '=', 'users.id')
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
        $remark = $request->input('remark');
        $workersName = $request->input('workersName');
        $userID = $currUser;

        $data = array(


            'jobTitle' => $jobTitle,
            'date' => $date,
            'location' => $location,
            'jobDesc' => $jobDesc,
            'workersName' => $workersName,
            'remark' => $remark,
            'status' => 'Assigned',
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

    public function jobInfo($id)
    {

        $workers = User::where('category', 'Worker')->get();

        $job = DB::table('jobs')
            ->join('users', 'jobs.userID', '=', 'users.id')
            ->where('jobs.id', '=', $id)
            ->select(
                'jobs.id as jobID',
                'jobs.jobTitle',
                'jobs.date',
                'jobs.location',
                'jobs.jobDesc',
                'jobs.workersName',
                'jobs.status',
                'jobs.remark',
                'jobs.userID',
                'users.id',
                'users.name',
                'users.category',
                'users.accNo',
                'users.bankType',
            )->first();

        return view('maintenance.jobInfo', compact('job', 'workers'));
    }

    public function updateInfo(Request $request, $id)
    {
        Jobs::where('id', '=', $request->id)
            ->update([

                'jobTitle' => $request->jobTitle,
                'date' => $request->date,
                'location' => $request->location,
                'jobDesc' => $request->jobDesc,
                'workersName' => $request->workersName,
                'remark' => $request->remark,
                'status' => 'Accepted',
            ]);

        return back()->with('success', 'Claim info is successfully updated!');
    } 
     public function editJob($id)
    {

        $workers = User::where('category', 'Worker')->get();

        $job = DB::table('jobs')
            ->join('users', 'jobs.userID', '=', 'users.id')
            ->where('jobs.id', '=', $id)
            ->select(
                'jobs.id as jobID',
                'jobs.jobTitle',
                'jobs.date',
                'jobs.location',
                'jobs.jobDesc',
                'jobs.workersName',
                'jobs.status',
                'jobs.remark',
                'jobs.userID',
                'users.id',
                'users.name',
                'users.category',
                'users.accNo',
                'users.bankType',
            )->first();

        return view('maintenance.editJob', compact('job', 'workers'));
    }

    public function updateJob(Request $request, $id)
    {
        Jobs::where('id', '=', $request->id)
            ->update([

                'jobTitle' => $request->jobTitle,
                'date' => $request->date,
                'location' => $request->location,
                'jobDesc' => $request->jobDesc,
                'workersName' => $request->workersName,
                'remark' => $request->remark,
                'status' => 'Assigned',
            ]);

        return back()->with('success', 'Claim info is successfully updated!');
    }
}
