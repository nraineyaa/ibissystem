<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Claims;
use App\Models\Invoice;
use App\Models\Company;
use App\Models\Jobs;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Carbon;

use Exception;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //FROM LOGIN PAGE TO THIS DASHBOARD PAGE

    public function __construct()
    {
        $this->middleware('auth');
    }

    //authorize session from user type
    public function loadDashboard()
    {
        $category = Auth::user()->category;

        if ($category == 'Supervisor') {

            
            $lostFE = 0;
            $expFE = 0;
            $totalExpFE = 0;

            $branch_id = Auth::user()->id;
            $currName = Auth::user()->name;
            $totalClient =  Invoice::where('userID', '=', $branch_id)->count();
            $itemsTN = 'item';

            $totalAccept = Jobs::where('workersName', '=', $currName)->where('status', '=', 'Accepted')->count();
            $totalJob = Jobs::where('userID', '=', $branch_id)->count();
            $totalJobA = Jobs::where('userID', '=', $branch_id)->where('status', '=', 'Accepted')->count();
            $totalReportSubmit = Jobs::where('userID', '=', $branch_id)->where('status', '=', 'Pending')->count();
            $totalClaims = Claims::where('userID', '=', $branch_id)->count();

            $currentMonth = Carbon::now()->format('F');
            //pie chart claimstatus
            $available = Attendance::where('status', '=', 'Available')->count();
            $onsite= Attendance::where('status', '=', 'On-Site')->count();
            $onleave = Attendance::where('status', '=', 'On-Leave')->count();

            // DB::table($itemsTN)->where('efiesrenewdate','')
            $nextMonth = Carbon::parse(Carbon::now()->addMonth(1))->format('m');
            $year = Carbon::parse(Carbon::now())->format('Y');
            if ($nextMonth == 1) {
                $year = $year + 1;
            }

            $lastYear = Carbon::now()->subYears(1);
            $date14DaysfromNow = Carbon::now()->addDays(14)->todatestring();


            $totalExpiredNM = DB::table('claims')->sum('amount');
            $totalExpiredYear = DB::table('invoices')->sum('totalAmount');
            $totalExpired14 = DB::table('invoices')->where('status', '=', 'Unpaid')->sum('totalAmount');
            $totalRegisterYear = DB::table('invoices')->where('status', '=', 'Paid')->sum('totalAmount');

            try {
                // ...
            } catch (Exception $e) {
                // Handle the exception
            }

            $analysisClients = DB::table('invoices')->where('status', '=', 'Paid')->where('userID', '=', $branch_id)->first();
            $analysisnewJS = DB::table('invoices')->where('status', '=', 'Paid')->where('userID', '=', $branch_id)->first();
            $analysisIPJS = DB::table('invoices')->where('status', '=', 'Paid')->where('userID', '=', $branch_id)->first();
            $analysisCUJS = DB::table('invoices')->where('status', '=', 'Unpaid')->where('userID', '=', $branch_id)->first();
            $analysisCFPJS = DB::table('invoices')->where('status', '=', 'Unpaid')->where('userID', '=', $branch_id)->first();

            $tooltipsClient = '';
            $tooltipsnewJS = '';
            $tooltipsIPJS = '';
            $tooltipsCUJS = '';
            $tooltipsCFPJS = '';

            $counter = 7;

            $dataClients = (array) $analysisClients;
            $datanewJS = (array) $analysisnewJS;
            $dataIPJS = (array) $analysisIPJS;
            $dataCUJS = (array) $analysisCUJS;
            $dataCFPJS = (array) $analysisCFPJS;

            $jobList = DB::table('jobs')
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


            return view('dashboard.Supervisor', compact('analysisClients', 'analysisnewJS', 'analysisIPJS', 'jobList', 'analysisCUJS', 'analysisCFPJS', 'totalExpiredNM', 'totalExpiredYear', 'totalExpired14', 'totalRegisterYear', 'onleave', 'available', 'onsite', 'totalClient', 'totalAccept', 'lostFE', 'expFE', 'totalExpFE', 'totalJob','totalReportSubmit', 'currentMonth', 'totalClaims', 'totalJobA',));
            
    
        }
        if ($category == 'Accountant') {

            $lostFE = 0;
            $expFE = 0;
            $totalExpFE = 0;

            $branch_id = Auth::user()->id;
            $totalClient =  Invoice::where('userID', '=', $branch_id)->count();
            $itemsTN = 'item';

            $totalComp = Company::all()->count();
            $totalIPJS = Invoice::all()->count();
            $totalNewJS = DB::table('invoices')->where('status', '=', 'Paid')->count();
            $totalCPJS = DB::table('invoices')->where('status', '=', 'Unpaid')->count();
            $totalFPJS = DB::table('invoices')->where('status', '=', 'Paid')->count();

            $team1 = DB::table('users')->where('category', '=', 'Supervisor')->count();
            $team2 = DB::table('users')->where('category', '=', 'Accountant')->count();
            $team3 = DB::table('users')->where('category', '=', 'Worker')->count();

            //pie chart claimstatus
            $successful = Claims::where('status', '=', 'Successful')->count();
            $reviewed = Claims::where('status', '=', 'Reviewed')->count();
            $pending = Claims::where('status', '=', 'Pending')->count();

            // DB::table($itemsTN)->where('efiesrenewdate','')
            $nextMonth = Carbon::parse(Carbon::now()->addMonth(1))->format('m');
            $year = Carbon::parse(Carbon::now())->format('Y');
            if ($nextMonth == 1) {
                $year = $year + 1;
            }

            $lastYear = Carbon::now()->subYears(1);
            $date14DaysfromNow = Carbon::now()->addDays(14)->todatestring();


            $totalExpiredNM = DB::table('claims')->sum('amount');
            $totalExpiredYear = DB::table('invoices')->sum('totalAmount');
            $totalExpired14 = DB::table('invoices')->where('status', '=', 'Unpaid')->sum('totalAmount');
            $totalRegisterYear = DB::table('invoices')->where('status', '=', 'Paid')->sum('totalAmount');

            try {
                // ...
            } catch (Exception $e) {
                // Handle the exception
            }

            $analysisClients = DB::table('invoices')->where('status', '=', 'Paid')->where('userID', '=', $branch_id)->first();
            $analysisnewJS = DB::table('invoices')->where('status', '=', 'Paid')->where('userID', '=', $branch_id)->first();
            $analysisIPJS = DB::table('invoices')->where('status', '=', 'Paid')->where('userID', '=', $branch_id)->first();
            $analysisCUJS = DB::table('invoices')->where('status', '=', 'Unpaid')->where('userID', '=', $branch_id)->first();
            $analysisCFPJS = DB::table('invoices')->where('status', '=', 'Unpaid')->where('userID', '=', $branch_id)->first();

            $tooltipsClient = '';
            $tooltipsnewJS = '';
            $tooltipsIPJS = '';
            $tooltipsCUJS = '';
            $tooltipsCFPJS = '';

            $counter = 7;

            $dataClients = (array) $analysisClients;
            $datanewJS = (array) $analysisnewJS;
            $dataIPJS = (array) $analysisIPJS;
            $dataCUJS = (array) $analysisCUJS;
            $dataCFPJS = (array) $analysisCFPJS;


            return view('dashboard.AccountantTest', compact('analysisClients', 'analysisnewJS', 'analysisIPJS', 'analysisCUJS', 'analysisCFPJS', 'totalExpiredNM', 'totalExpiredYear', 'totalExpired14', 'totalRegisterYear', 'pending', 'successful', 'reviewed', 'totalClient', 'totalNewJS', 'totalIPJS', 'totalCPJS', 'totalFPJS', 'team1', 'team2', 'team3', 'lostFE', 'expFE', 'totalExpFE', 'totalComp'));
        }
        if ($category == 'Human Resource') {
            //dd(Auth::user()->id);  $lostFE = 0;
            $expFE = 0;
            $totalExpFE = 0;

            $branch_id = Auth::user()->id;
            $totalClient =  Invoice::where('userID', '=', $branch_id)->count();
            $itemsTN = 'item';

            $totalComp = User::all()->count();
            $totalIPJS = Invoice::all()->count();
            $totalNewJS = DB::table('invoices')->where('status', '=', 'Paid')->count();
            $totalCPJS = DB::table('invoices')->where('status', '=', 'Unpaid')->count();
            $totalFPJS = DB::table('invoices')->where('status', '=', 'Paid')->count();

            $team1 = DB::table('users')->where('category', '=', 'Supervisor')->count();
            $team2 = DB::table('users')->where('category', '=', 'Accountant')->count();
            $team3 = DB::table('users')->where('category', '=', 'Worker')->count();

            //pie chart claimstatus
            $successful = Claims::where('status', '=', 'Successful')->count();
            $reviewed = Claims::where('status', '=', 'Reviewed')->count();
            $pending = Claims::where('status', '=', 'Pending')->count();

            // DB::table($itemsTN)->where('efiesrenewdate','')
            $nextMonth = Carbon::parse(Carbon::now()->addMonth(1))->format('m');
            $year = Carbon::parse(Carbon::now())->format('Y');
            if ($nextMonth == 1) {
                $year = $year + 1;
            }

            $lastYear = Carbon::now()->subYears(1);
            $date14DaysfromNow = Carbon::now()->addDays(14)->todatestring();


            $totalExpiredNM = DB::table('claims')->sum('amount');
            $totalExpiredYear = DB::table('invoices')->sum('totalAmount');
            $totalExpired14 = DB::table('invoices')->where('status', '=', 'Unpaid')->sum('totalAmount');
            $totalRegisterYear = DB::table('invoices')->where('status', '=', 'Paid')->sum('totalAmount');

            try {
                // ...
            } catch (Exception $e) {
                // Handle the exception
            }

            $analysisClients = DB::table('invoices')->where('status', '=', 'Paid')->where('userID', '=', $branch_id)->first();
            $analysisnewJS = DB::table('invoices')->where('status', '=', 'Paid')->where('userID', '=', $branch_id)->first();
            $analysisIPJS = DB::table('invoices')->where('status', '=', 'Paid')->where('userID', '=', $branch_id)->first();
            $analysisCUJS = DB::table('invoices')->where('status', '=', 'Unpaid')->where('userID', '=', $branch_id)->first();
            $analysisCFPJS = DB::table('invoices')->where('status', '=', 'Unpaid')->where('userID', '=', $branch_id)->first();

            $tooltipsClient = '';
            $tooltipsnewJS = '';
            $tooltipsIPJS = '';
            $tooltipsCUJS = '';
            $tooltipsCFPJS = '';

            $counter = 7;

            $dataClients = (array) $analysisClients;
            $datanewJS = (array) $analysisnewJS;
            $dataIPJS = (array) $analysisIPJS;
            $dataCUJS = (array) $analysisCUJS;
            $dataCFPJS = (array) $analysisCFPJS;

            $userRecord = DB::table('users')
            ->select(
                'id',
                'name',
                'staffID',
                'email',
                'phoneNum',
                'category',
                'salary',
                'employmentType',
                'bankType',
                'accNo',

            )
            ->orderBy('name', 'asc')
            ->get();


            return view('dashboard.HumanResource', compact('analysisClients', 'userRecord', 'analysisnewJS', 'analysisIPJS', 'analysisCUJS', 'analysisCFPJS', 'totalExpiredNM', 'totalExpiredYear', 'totalExpired14', 'totalRegisterYear', 'pending', 'successful', 'reviewed', 'totalClient', 'totalNewJS', 'totalIPJS', 'totalCPJS', 'totalFPJS', 'team1', 'team2', 'team3', 'expFE', 'totalExpFE', 'totalComp'));
        
        }
        if ($category == 'Worker') {


            $lostFE = 0;
            $expFE = 0;
            $totalExpFE = 0;

            $branch_id = Auth::user()->id;
            $currName = Auth::user()->name;
            $totalClient =  Invoice::where('userID', '=', $branch_id)->count();
            $itemsTN = 'item';

            $totalAccept = Jobs::where('workersName', '=', $currName)->where('status', '=', 'Accepted')->count();
            $totalJob = Jobs::where('workersName', '=', $currName)->where('status', '=', 'Assigned')->count();
            $totalReportSubmit = Jobs::where('workersName', '=', $currName)->count(); 
            $totalClaims = Claims::where('userID', '=', $branch_id)->count();

            $currentMonth = Carbon::now()->format('F');
            //pie chart claimstatus
            $available = Attendance::where('status', '=', 'Available')->count();
            $onsite= Attendance::where('status', '=', 'On-Site')->count();
            $onleave = Attendance::where('status', '=', 'On-Leave')->count();

            // DB::table($itemsTN)->where('efiesrenewdate','')
            $nextMonth = Carbon::parse(Carbon::now()->addMonth(1))->format('m');
            $year = Carbon::parse(Carbon::now())->format('Y');
            if ($nextMonth == 1) {
                $year = $year + 1;
            }

            $lastYear = Carbon::now()->subYears(1);
            $date14DaysfromNow = Carbon::now()->addDays(14)->todatestring();


            $totalExpiredNM = DB::table('claims')->sum('amount');
            $totalExpiredYear = DB::table('invoices')->sum('totalAmount');
            $totalExpired14 = DB::table('invoices')->where('status', '=', 'Unpaid')->sum('totalAmount');
            $totalRegisterYear = DB::table('invoices')->where('status', '=', 'Paid')->sum('totalAmount');

            try {
                // ...
            } catch (Exception $e) {
                // Handle the exception
            }

            $analysisClients = DB::table('invoices')->where('status', '=', 'Paid')->where('userID', '=', $branch_id)->first();
            $analysisnewJS = DB::table('invoices')->where('status', '=', 'Paid')->where('userID', '=', $branch_id)->first();
            $analysisIPJS = DB::table('invoices')->where('status', '=', 'Paid')->where('userID', '=', $branch_id)->first();
            $analysisCUJS = DB::table('invoices')->where('status', '=', 'Unpaid')->where('userID', '=', $branch_id)->first();
            $analysisCFPJS = DB::table('invoices')->where('status', '=', 'Unpaid')->where('userID', '=', $branch_id)->first();

            $tooltipsClient = '';
            $tooltipsnewJS = '';
            $tooltipsIPJS = '';
            $tooltipsCUJS = '';
            $tooltipsCFPJS = '';

            $counter = 7;

            $dataClients = (array) $analysisClients;
            $datanewJS = (array) $analysisnewJS;
            $dataIPJS = (array) $analysisIPJS;
            $dataCUJS = (array) $analysisCUJS;
            $dataCFPJS = (array) $analysisCFPJS;


            return view('dashboard.Worker', compact('analysisClients', 'analysisnewJS', 'analysisIPJS', 'analysisCUJS', 'analysisCFPJS', 'totalExpiredNM', 'totalExpiredYear', 'totalExpired14', 'totalRegisterYear', 'onleave', 'available', 'onsite', 'totalClient', 'totalAccept', 'lostFE', 'expFE', 'totalExpFE', 'totalJob','totalReportSubmit', 'currentMonth', 'totalClaims',));
            
        }
    }
}
