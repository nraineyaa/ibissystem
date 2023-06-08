<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class MaintenanceController extends Controller
{
      //display new user 
      public function index()
      { //
          $userRecord = DB::table('users')
              ->select(
                  'id',
                  'name',
                  'staffID',
                  'email',
                  'phoneNum',
                  'category',
                  'salary',
                  'employmentType'
  
              )
              ->orderBy('name', 'asc')
              ->get();
          return view('profile.recordUserList', compact('userRecord'));
      }
}
