<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Jobs;
use App\Models\Reports;
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
                'status',
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
        $status = $request->input('status');
        $userID = $currUser;

        $data = array(


            'reportTitle' => $reportTitle,
            'date' => $date,
            'file' => $file,
            'remark' => $remark,
            'status' => 'Pending',
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

        return back()->with('success', 'Job info is successfully updated!');
    } 
     public function editJob(Request $request,$id)
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
                'status' => 'Assigned',
            ]);

        return back()->with('success', 'Job info is successfully updated!');
    } 
    
    public function editReport(Request $request, $id)
    {
        
        Reports::where('id', '=', $request->id);

        $report = DB::table('report')
        ->join('users', 'report.userID', '=', 'users.id')
        ->where('report.id', '=', $id)
        ->select(
            'report.id as reportID',
            'report.reportTitle',
            'report.date',
            'report.file',
            'report.remark',
            'report.userID',
            'users.id',
            'users.name',
            'users.category',
            'users.accNo',
            'users.bankType',
        )->first();

    return view('maintenance.editReport', compact('report',));
    }

    public function updateReport(Request $request, $id)
    {
        
        Reports::where('id', '=', $request->id)
            ->update([

                'reportTitle' => $request->reportTitle,
                'date' => $request->date,
                'file' => $request->file,
                'remark' => $request->remark,
                'status' => 'Pending',
            ]);

        return back()->with('success', 'Report info is successfully updated!');
    } 
    public function editStatus(Request $request, $id)
    {
        
        Reports::where('id', '=', $request->id);

        $report = DB::table('report')
        ->join('users', 'report.userID', '=', 'users.id')
        ->where('report.id', '=', $id)
        ->select(
            'report.id as reportID',
            'report.reportTitle',
            'report.date',
            'report.file',
            'report.remark',
            'report.userID',
            'users.id',
            'users.name',
            'users.category',
            'users.accNo',
            'users.bankType',
        )->first();

    return view('maintenance.editReport', compact('report',));
    }
    public function updateStatus(Request $request, $id)
    {
        
        Reports::where('id', '=', $request->id)
            ->update([

                'jobTitle' => $request->jobTitle,
                'date' => $request->date,
                'location' => $request->location,
                'jobDesc' => $request->jobDesc,
                'workersName' => $request->workersName,
                'status' => 'Checked',
            ]);

        return back()->with('success', 'Report info is successfully updated!');
    } 
}
