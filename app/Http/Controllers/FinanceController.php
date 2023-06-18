<?php

namespace App\Http\Controllers;

use App\Models\Claims;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FinanceController extends Controller
{
    //display new user 
    public function index()
    {

        $currID = Auth::user()->id;

        $currUser = Auth::user()->category;

        $currName = Auth::user()->name;

        $supervisor = User::where('category', '=', "Supervisor")->pluck('name')->all();

        if ($currUser == 'Accountant') {
            $pendingCount = DB::table('claims')
                ->where('claims.status', '=', "Pending")
                ->count();

            $reviewedCount = DB::table('claims')
                ->where('status', '=', "Reviewed")
                ->count();

            $successfulCount = DB::table('claims')
                ->where('status', '=', "Successful")
                ->count();
        } elseif ($currUser == 'Supervisor') {

            $pendingCount = DB::table('claims')
                ->where('claims.status', '=', "Pending")
                ->where('svName', '=',  $currName)
                ->count();

            $reviewedCount = DB::table('claims')
                ->where('status', '=', "Reviewed")
                ->where('svName', '=',  $currName)
                ->count();

            $successfulCount = DB::table('claims')
                ->where('status', '=', "Reviewed")
                ->where('svName', '=',  $currName)
                ->count();
        } else {
            $pendingCount = DB::table('claims')
                ->where('claims.status', '=', "Pending")
                ->where('claims.userID', '=',  $currID)
                ->count();

            $reviewedCount = DB::table('claims')
                ->where('status', '=', "Reviewed")
                ->where('claims.userID', '=',  $currID)
                ->count();

            $successfulCount = DB::table('claims')
                ->where('status', '=', "Successful")
                ->where('claims.userID', '=',  $currID)
                ->count();
        }

        if ($currUser == 'Human Resource') {
            $userRecord = DB::table('claims')

                ->where('claims.userID', '=', $currID)
                ->select(
                    'id',
                    'claimType',
                    'date',
                    'amount',
                    'svName',
                    'status',
                    'remark',
                    'userID',
                )
                ->orderBy('claimType', 'asc')
                ->get();
        } elseif ($currUser == 'Supervisor') {
            $userRecord = DB::table('claims')
                ->select(
                    'id',
                    'claimType',
                    'date',
                    'amount',
                    'svName',
                    'status',
                    'remark',
                    'userID',
                )
                ->whereIn('status', ['Pending', 'Reviewed'])
                ->where('svName', '=',  $currName)
                ->orderBy('svName', 'asc')
                ->get();
        } elseif ($currUser == 'Accountant') {
            $userRecord = DB::table('claims')
                ->select(
                    'id',
                    'claimType',
                    'date',
                    'amount',
                    'svName',
                    'status',
                    'remark',
                    'userID',
                )
                ->orderBy('claimType', 'asc')
                ->get();
        } else {
            $userRecord = DB::table('claims')
                ->where('claims.userID', '=', $currID)
                ->select(
                    'id',
                    'claimType',
                    'date',
                    'amount',
                    'svName',
                    'status',
                    'remark',
                    'userID',
                )
                ->orderBy('claimType', 'asc')
                ->get();
        }


        return view('finance.recordClaim', compact('userRecord', 'supervisor', 'pendingCount', 'reviewedCount', 'successfulCount'));
    }




    //Store claim in database
    public function addClaim(Request $request)
    {

        $currUser = Auth::user()->id;

        $claimType = $request->input('claimType');
        $date = $request->input('date');
        $svName = $request->input('svName');
        $amount = $request->input('amount');
        $remark = $request->input('remark');
        $userID = $currUser;

        $data = array(


            'claimType' => $claimType,
            'date' => $date,
            'svName' => $svName,
            'amount' => $amount,
            'status' => 'Pending',
            'remark' => $remark,
            'userID' => $userID,

        );


        DB::table('claims')->insert($data);


        return redirect('/claim')->with('success', 'Claim Request Added');
    }

    public function editClaim($id)
    {
        $supervisors = User::where('category', 'Supervisor')->get();

        $claim = DB::table('claims')
            ->join('users', 'claims.userID', '=', 'users.id')
            ->where('claims.id', '=', $id)
            ->select(
                'claims.id as claimID',
                'claims.date',
                'claims.claimType',
                'claims.svName',
                'claims.amount',
                'claims.remark',
                'claims.status',
                'claims.userID',
                'users.id',
                'users.name',
                'users.category',
                'users.accNo',
                'users.bankType',
            )->first();

        return view('finance.editClaim', compact('claim', 'supervisors'));
    }


    public function updateClaim(Request $request, $id)
    {
        Claims::where('id', '=', $request->id)
            ->update([

                'claims.claimType' => $request->claimType,
                'claims.date' => $request->date,
                'claims.amount' => $request->amount,
                'claims.status' => $request->status,
                'claims.remark' => $request->remark,
                'claims.svName' => $request->svName,
            ]);

        return back()->with('success', 'Claim info is successfully updated!');
    }

    public function myClaim(Request $request)
    {

        return view('finance.myClaim');
    }
    // public function update(Request $request, $id)
    // {
    //     $claim = Claim::find($id);
    //     $claim->claimType = $request->input('claimType');
    //     $claim->date = $request->input('date');
    //     $claim->amount = $request->input('amount');
    //     $claim->svName = $request->input('svName');
    //     // Update other fields as needed
    //     $claim->save();

    //     return redirect()->back()->with('success', 'Claim updated successfully.');
    // }
}
