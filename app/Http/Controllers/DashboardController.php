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
        if ($category == 'Lecturer') {
            return view('dashboard.Lecturer');
        }
        if ($category == 'Human Resource') {
            //dd(Auth::user()->id);
            return view('dashboard.HumanResource');
        }
        if ($category == 'Coordinator') {
            return view('dashboard.Coordinator');
        }
        if ($category == 'Hosd') {
            return view('dashboard.Hosd');
        }
        if ($category == 'Dean') {
            return view('dashboard.Dean');
        }
    }
}
