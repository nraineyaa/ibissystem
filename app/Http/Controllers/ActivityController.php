<?php

namespace App\Http\Controllers;

use App\Models\Activity;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Notifications\Action;

class ActivityController extends Controller
{
    //to display the list of activity records
    public function loadActv()
    {
        return view('activity.ViewActv');
    }

    //to display add new activity form
    public function addActv()
    {
        return view('activity.AddActv');
    }

    //to display edit page
    public function editActv()
    {
        return view('activity.EditActv');
    }

    //to display proposal activity
    public function planActv()
    {
        return view('activity.PlanActv');
    }

    //to display activity record in table form
    public function index(Request $request)
    {
       
            return view('activity.RecordActv');
        

        // if ($userType == 'Student' || 'Lecturer') {

        //     $allActivities = Activity::all();

        //     // If user is authenticated, get the activities that the user has already joined
        //     if ($userType == 'Student' || 'Lecturer') {
        //         $isMember  = DB::table('joinactv')->join('activity', 'joinactv.activityID', '=', 'activity.id')
        //             ->select(
        //                 'activity.id',
        //                 'activity.activityName',
        //                 'activity.activityDesc',
        //                 'joinactv.activityID'
        //             )
        //             ->Where('joinactv.userID', '=', $userID)
        //             ->exists();
        //     } else {
        //         $isMember  = null;
        //     }

        //     return view('activity.JoinActv', [
        //         'allActivities' => $allActivities,
        //         'isMember' => $isMember
        //     ]);
        // }
    }

    //store new activity into database
    public function addNewActivity(Request $request)
    {

        $request->validate([
            'file' => 'required|mimes:pdf,xlx,csv|max:2048',
        ]);

        $fileName = time() . '.' . $request->file->extension();

        $request->file->move(public_path('uploads'), $fileName);

        $userID = Auth::user()->id;
        $activityName = $request->input('activityName');
        $activityDesc = $request->input('activityDesc');
        $activityCap = $request->input('activityCap');
        $activityDate = $request->input('activityDate');
        $activityVenue = $request->input('activityVenue');

        $data = array(
            'activityName' => $activityName,
            "activityDesc" => $activityDesc,
            "activityCap" => $activityCap,
            "activityDate" => $activityDate,
            "activityVenue" => $activityVenue,
            "activityStatus" => 'Submitted',
            "activityFile" => $fileName
        );

        //dd($data);

        DB::table('activity')->insert($data);

        return view('activity.ViewActv');
    }

    //to get data for edit form
    public function activityDetails(Request $request, $id)
    {
        //dd($request->id);
        $activity = Activity::select(
            'id',
            'activityName',
            'activityDesc',
            'activityCap',
            'activityDate',
            'activityVenue',
            'activityStatus',
            'activityFile'
        )->where('id', '=', $request->id)->first();
        $view = view('activity.EditActv', compact('activity'));

        // if ($request->ajax()) {
        //     $sections = $view->renderSections(); // returns an associative array of 'content', 'head' and 'footer'

        //     return response()->json(array('success' => true, 'html' => $sections['content'], 'pageTitle' => 'PETAKOM-Activity Details', 'urlPath' => '/activityDetails', 'onLoadFunction' => 'activityOnLoad'));
        // }

        return $view;
    }

    //to update activity record
    public function updateActivity(Request $request, $id)
    {
        if ($request->ajax()) {
            DB::table('activity')->where('activity.id', '=', $id)
                ->update([
                    'activity.activityName' => $request->activityName,
                    'activity.activityDesc' => $request->activityDesc,
                    'activity.activityCap' => $request->activityCap,
                    'activity.activityDate' => $request->activityDate,
                    'activity.activityVenue' => $request->activityVenue,
                    'activity.activityStatus' => $request->activityStatus,
                ]);

            return response()->json(array('success' => true));
        }
    }

    //to delete selected record
    public function deleteActivity(Request $request, $id)
    {
        if ($request->ajax()) {

            Activity::where('id', '=', $id)->delete();
            return response()->json(array('success' => true));
        }
    }

    //to clear searched result
    public function clearFilter(Request $request)
    {
        if ($request->ajax()) {
            if (Session::has('searchActivity')) {
                Session::forget('searchActivity');
            }
            return response()->json(array('success' => true));
        }
    }

    //to display activity proposal details
    public function viewActvProposal(Request $request)
    {
        $userCategory = Auth::user()->category;

        $COstatus = Activity::select(
            'activityStatus'
        )->where('activityStatus', '=', 'Submitted')->get();

        $HOSDstatus = Activity::select(
            'activityStatus'
        )->where('activityStatus', '=', 'CO Approved')->get();

        $activity_id = session('id');
        //save object in session
        if (count($request->except('page', '_token')) > 0) {
            session(['searchActivity' => serialize($request->except('page', '_token'))]);
            $searchActivity = unserialize(session('searchActivity'));
        } else {
            if (session('searchActivity') != null) {
                $searchActivity = unserialize(session('searchActivity'));
            } else {
                $searchActivity = [];
            }
        }

        $activities = [];

        try {
            $activities = Activity::where(function ($query) use ($searchActivity) {
                $query->where('activityName', 'LIKE',  '%' . $searchActivity['query'] . '%')
                    ->orWhere('activityDate', 'LIKE',  '%' . $searchActivity['query'] . '%')
                    ->orWhere('activityVenue', 'LIKE',  '%' . $searchActivity['query'] . '%')
                    ->orWhere('activityStatus', 'LIKE',  '%' . $searchActivity['query'] . '%');
            })
                ->paginate(10);
        } catch (Exception $e) {

            if ($userCategory == 'Coordinator') {
                $activities = DB::table('activity')->select(
                    'id',
                    'activityName',
                    'activityDesc',
                    'activityCap',
                    'activityDate',
                    'activityVenue',
                    'activityStatus',
                    'activityFile'
                )->where('activityStatus', '=', 'Submitted')->paginate(10);
            } elseif ($userCategory == 'Hosd') {

                $activities = DB::table('activity')->select(
                    'id',
                    'activityName',
                    'activityDesc',
                    'activityCap',
                    'activityDate',
                    'activityVenue',
                    'activityStatus',
                    'activityFile'
                )->where('activityStatus', '=', 'CO Approved')->paginate(10);
            } else {
                $activities = Activity::paginate(10);
            }
        }
        return view('activity.ChooseActv', compact('activities', 'searchActivity'));
    }

    //to search specific record from the activity list
    public function searchActvP(Request $request)
    {
        $activity_id = session('id');
        //save object in session
        if (count($request->except('page', '_token')) > 0) {
            session(['searchActivity' => serialize($request->except('page', '_token'))]);
            $searchActivity = unserialize(session('searchActivity'));
        } else {
            if (session('searchActivity') != null) {
                $searchActivity = unserialize(session('searchActivity'));
            } else {
                $searchActivity = [];
            }
        }

        $activities = [];

        try {
            $activities = Activity::where(function ($query) use ($searchActivity) {
                $query->where('activityName', 'LIKE',  '%' . $searchActivity['query'] . '%')
                    ->orWhere('activityDate', 'LIKE',  '%' . $searchActivity['query'] . '%')
                    ->orWhere('activityVenue', 'LIKE',  '%' . $searchActivity['query'] . '%')
                    ->orWhere('activityCap', 'LIKE',  '%' . $searchActivity['query'] . '%');
            })
                ->paginate(10);
        } catch (Exception $e) {
            $activities = Activity::paginate(10);
        }
        return redirect()->back();
    }

    //to join available activity
    public function joinActivity(Request $request, $id)
    {
        if ($request->ajax()) {

            $currUID = Auth::user()->id;

            $data = array(
                'userID' => $currUID,
                "activityID" => $id
            );
            DB::table('joinactv')->insert($data);

            return response()->json(array('success' => true));
        }
    }

    //to view the listed joined activities
    public function listJoinedActv(Request $request)
    {
        $currId =  Auth::user()->id;
        $activity_id = session('id');
        //save object in session
        if (count($request->except('page', '_token')) > 0) {
            session(['searchListJoinedActivity' => serialize($request->except('page', '_token'))]);
            $searchListJoinedActivity = unserialize(session('searchListJoinedActivity'));
        } else {
            if (session('searchListJoinedActivity') != null) {
                $searchListJoinedActivity = unserialize(session('searchListJoinedActivity'));
            } else {
                $searchListJoinedActivity = [];
            }
        }

        $listActivities = [];

        try {
            $listActivities = Activity::where(function ($query) use ($searchListJoinedActivity) {
                $query->where('activityName', 'LIKE',  '%' . $searchListJoinedActivity['query'] . '%')
                    ->orWhere('activityDate', 'LIKE',  '%' . $searchListJoinedActivity['query'] . '%')
                    ->orWhere('activityVenue', 'LIKE',  '%' . $searchListJoinedActivity['query'] . '%')
                    ->orWhere('activityCap', 'LIKE',  '%' . $searchListJoinedActivity['query'] . '%');
            })
                ->paginate(10);
        } catch (Exception $e) {
            $listActivities = DB::table('activity')->join('joinactv', 'activity.id', '=', 'joinactv.activityID')->where('joinactv.userID', '=', $currId)->paginate(10);
        }
        return view('activity.ListJoinedActv', compact('listActivities', 'searchListJoinedActivity'));
    }

    //to search specific record of joined activities
    public function searchListActv(Request $request)
    {
        $activity_id = session('id');
        //save object in session
        if (count($request->except('page', '_token')) > 0) {
            session(['searchListJoinedActivity' => serialize($request->except('page', '_token'))]);
            $searchListJoinedActivity = unserialize(session('searchListJoinedActivity'));
        } else {
            if (session('searchListJoinedActivity') != null) {
                $searchListJoinedActivity = unserialize(session('searchListJoinedActivity'));
            } else {
                $searchListJoinedActivity = [];
            }
        }

        $listActivities = [];

        try {
            $listActivities = Activity::where(function ($query) use ($searchListJoinedActivity) {
                $query->where('activityName', 'LIKE',  '%' . $searchListJoinedActivity['query'] . '%')
                    ->orWhere('activityDate', 'LIKE',  '%' . $searchListJoinedActivity['query'] . '%')
                    ->orWhere('activityVenue', 'LIKE',  '%' . $searchListJoinedActivity['query'] . '%')
                    ->orWhere('activityCap', 'LIKE',  '%' . $searchListJoinedActivity['query'] . '%');
            })
                ->paginate(10);
        } catch (Exception $e) {
            $listActivities = Activity::paginate(10);
        }
        return redirect()->back();
    }

    //to clear searched result of joined activity
    public function clearFilterListActivity(Request $request)
    {
        if ($request->ajax()) {
            if (Session::has('searchListJoinedActivity')) {
                Session::forget('searchListJoinedActivity');
            }
            return response()->json(array('success' => true));
        }
    }
}
