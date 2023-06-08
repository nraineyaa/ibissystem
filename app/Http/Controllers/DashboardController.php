<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

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
            return view('dashboard.Supervisor');
        }
        if ($category == 'Accountant') {
            return view('dashboard.Accountant');
        }
        if ($category == 'Human Resource') {
            //dd(Auth::user()->id);
            return view('dashboard.HumanResource');
        }
        if ($category == 'Worker') {
            return view('dashboard.Worker');
        }
    }
}
