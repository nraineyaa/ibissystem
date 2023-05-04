<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Proposal;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProposalController extends Controller
{
    //function display list proposal page for all users
    public function index()
    {
        // display all proposal
        $proposal = DB::table('proposal')
            ->orderBy('id', 'desc')
            ->get();

        // display all proposal where status = pending for coordinator approval
        $proposalCoordinator = DB::table('proposal')
            ->orderBy('id', 'desc')
            ->where('proposalStatus', 'Pending')
            ->get();

        // display all proposal where status = approved by coordiantor for hosd approval
        $proposalHosd = DB::table('proposal')
            ->orderBy('id', 'desc')
            ->where('proposalStatus', 'Approved by Coordinator')
            ->get();

        // display all proposal where status = approved by hosd for dean approval
        $proposalDean = DB::table('proposal')
            ->orderBy('id', 'desc')
            ->where('proposalStatus', 'Approved by Hosd')
            ->get();

        return view('proposal.ListProposal', compact('proposal', 'proposalCoordinator', 'proposalHosd', 'proposalDean'));
    }

    // to display the add proposal page 
    public function addproposal()
    {
        return view('proposal.AddProposal');
    }

    //to store proposal into database from HumanResource view
    public function storeproposal(Request $request)
    {
        // get user auth
        $id = Auth::user()->id;
        $proposalName = $request->input('proposalName');
        $proposalLocation = $request->input('proposalLocation');
        $proposalDate = $request->input('proposalDate');
        $proposalBudget = $request->input('proposalBudget');
        $proposalPax = $request->input('proposalPax');
        $proposalParticipant = $request->input('proposalParticipant');
        $proposalDoc = $request->file('proposalDoc');

        // to get the checkbox checked (student / lecturer)
        $chkpart = "";
        foreach ($proposalParticipant as $proposalParticipant) {
            $chkpart .= $proposalParticipant . "/";
        }

        // to rename the proposal file
        $filename = time() . '.' . $proposalDoc->getClientOriginalExtension();

        // to store the file by moving to assets folder
        $request->proposalDoc->move('assets', $filename);

        $data = array(
            'userID' => $id,
            'proposalName' => $proposalName,
            'proposalLocation' => $proposalLocation,
            'proposalDate' => $proposalDate,
            'proposalBudget' => $proposalBudget,
            'proposalPax' => $proposalPax,
            'proposalParticipant' => $chkpart,
            'proposalDoc' => $filename,
            'proposalStatus' => 'Pending',
            'proposalComment' => 'No',
        );

        // insert query
        DB::table('proposal')->insert($data);

        // display message box in the same page
        return redirect()->back()->with('message', 'New Proposal Added Successfully');
    }

    //function display page edit proposal for committee view 
    public function editproposal(Request $request, $id)
    {
        $proposal = Proposal::find($id);

        // check the participant type from the database for checkbox use
        $pp = Proposal::select(
            'proposalParticipant'
        )
            ->where('id', $request->id)->get();

        $containStud = Str::contains($pp, 'Student');
        $containLect = Str::contains($pp, 'Lecturer');

        return view('proposal.EditProposal', compact('proposal', 'containStud', 'containLect'));
    }

    // function update for proposal from HumanResource view 
    public function updateproposal(Request $request, $id)
    {
        // find the id from proposal
        $proposal = Proposal::find($id);

        // unlink the old proposal file from assets folder
        $path = public_path() . '/assets/' . $proposal->proposalDoc;
        if (file_exists($path)) {
            unlink($path);
        }

        // to get the checkbox checked (student / lecturer)
        $proposalParticipant = $request->input('proposalParticipant');
        $chkpart = "";
        foreach ($proposalParticipant as $proposalParticipant) {
            $chkpart .= $proposalParticipant . "/";
        }

        $proposal->proposalName = $request->input('proposalName');
        $proposal->proposalLocation = $request->input('proposalLocation');
        $proposal->proposalDate = $request->input('proposalDate');
        $proposal->proposalBudget = $request->input('proposalBudget');
        $proposal->proposalPax = $request->input('proposalPax');
        $proposal->proposalParticipant = $chkpart;
        $proposal->proposalDoc = $request->file('proposalDoc');
        $proposal->proposalStatus = 'Pending';
        $proposal->proposalComment = 'No';

        // to rename the proposal file
        $filename = time() . '.' . $proposal->proposalDoc->getClientOriginalExtension();
        // to store the new file by moving to assets folder
        $request->proposalDoc->move('assets', $filename);

        $proposal->proposalDoc = $filename;

        // upadate query in the database
        $proposal->update();

        // display message box in the same page
        return redirect()->back()->with('message', 'Proposal Updated Successfully');
    }

    //function delete proposal from database for committee view 
    public function deleteproposal(Request $request, $id)
    {
        // find proposal id
        $proposal = Proposal::find($id);

        // unlink the file in the assets folder
        $path = public_path() . '/assets/' . $proposal->proposalDoc;
        if (file_exists($path)) {
            unlink($path);
        }

        // delete the record from the database
        DB::delete('DELETE FROM proposal WHERE id = ?', [$id]);

        echo "Record deleted successfully.<br/>";
        return redirect()->back()->with('message', 'Proposal Deleted Successfully');
    }

    //function to display the verify proposal page for coordinator, hosd and dean
    public function verifyProposal($id)
    {
        $proposalView = DB::table('proposal')
            ->orderBy('id', 'asc')
            ->where('id', $id)
            ->get();
        return view('proposal.VerifyProposal', compact('proposalView'));
    }

    //function to download proposal file from assets folder  
    public function download(Request $request, $proposalDoc)
    {
        return response()->download(public_path('assets/' . $proposalDoc));
    }

    //FUNCTION FOR APPROVE AND REJECT PROPOSAL FOR COORDINATOR, HOSD AND DEAN 
    //function for coordinator to approve
    public function ApproveCoordinator($id)
    {
        $proposal = Proposal::find($id);
        $proposal->proposalStatus = "Approved by Coordinator";

        $proposal->update();
        return $this->index();
    }

    //function for coordinator to reject
    public function RejectCoordinator(Request $request, $id)
    {
        $proposal = Proposal::find($id);
        $proposal->proposalStatus = "Rejected by Coordinator";
        $proposal->proposalComment = $request->input('proposalComment');

        $proposal->update();

        return $this->index();
    }

    //function for hosd to approve
    public function ApproveHosd($id)
    {
        $proposal = Proposal::find($id);
        $proposal->proposalStatus = "Approved by HOSD";

        $proposal->update();
        return $this->index();
    }

    //function for hosd to reject
    public function RejectHosd(Request $request, $id)
    {
        $proposal = Proposal::find($id);
        $proposal->proposalStatus = "Rejected by HOSD";
        $proposal->proposalComment = $request->input('proposalComment');

        $proposal->update();

        return $this->index();
    }

    //function for dean to approve
    public function ApproveDean($id)
    {
        $proposal = Proposal::find($id);
        $proposal->proposalStatus = "Approved by Dean";

        $proposal->update();
        return $this->index();
    }

    //function for dean to reject
    public function RejectDean(Request $request, $id)
    {
        $proposal = Proposal::find($id);
        $proposal->proposalStatus = "Rejected by Dean";
        $proposal->proposalComment = $request->input('proposalComment');

        $proposal->update();

        return $this->index();
    }
}
