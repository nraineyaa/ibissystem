<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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
                'employmentType',
                'bankType',
                'accNo',

            )
            ->orderBy('name', 'asc')
            ->get();
        return view('profile.recordUserList', compact('userRecord'));
    }

    public function registerUser()
    { //
        return view('profile.registerUser');
    }

    public function employeeRec(Request $request)
    {

        return view('User.employeeRecord');
    }
    public function recordUpdateList(Request $request)
    {

        return view('User.recordUpdateList');
    }


    public function bankInfo(Request $request)
    {

        return view('User.bankInfo');
    }

    //store new user into database
    public function addUser(Request $request)
    {


        $email = $request->input('email');
        $ic = $request->input('ic');
        $password = $request->input('password');
        $confirmPass = $request->input('confirmPass');
        $name = $request->input('name');
        $phoneNum = $request->input('phoneNum');
        $staffID = $request->input('staffID');
        $category = $request->input('category');
        $employmentType = $request->input('employmentType');
        $salary = $request->input('salary');
        $address = $request->input('address');
        $bankType = $request->input('bankType');
        $accName = $request->input('accName');
        $accNo = $request->input('accNo');




        $data = array(


            'email' => $email,
            'ic' => $ic,
            'password' => Hash::make($password),
            'confirmPass' => Hash::make($confirmPass),
            'name' => $name,
            'phoneNum' => $phoneNum,
            'staffID' => $staffID,
            'category' => $category,
            'employmentType' => $employmentType,
            'salary' => $salary,
            'address' => $address,
            'bankType' => $bankType,
            'accName' => $accName,
            'accNo' => $accNo,
            'picture' => 'pp.png',

        );

        //dd($data);

        DB::table('users')->insert($data);


        return redirect('/registerUser')->with('success', 'User successfully registered');
    }

    //update user ( HR ONLY )
    public function updateUserList(Request $request, $id)
    {
        $user = User::find($id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'ic' => $request->ic,
                'staffID' => $request->staffID,
                'phoneNum' => $request->phoneNum,
                'category' => $request->category,
                'employmentType' => $request->employmentType,
                'salary' => $request->salary,
                'address' => $request->address,
            ]);

        return redirect()->back()->with('success', 'User info is successfully updated!');
    }

    //to delete selected record
    public function deleteUser(Request $request, $id)
    {
        if ($request->ajax()) {

            User::where('id', '=', $id)->delete();
            return response()->json(array('success' => true));
        }
    }

    //view page edit

    public function editUser(Request $request, $id)
    {
        $register = DB::table('users')->select(
            'id',
            'email',
            'ic',
            'password',
            'confirmPass',
            'name',
            'staffID',
            'phoneNum',
            'category',
            'salary',
            'employmentType',
            'address',
            'bankType',
            'accName',
            'accNo',
            'picture',
        )->where('users.id', '=', $request->id)->first();

        return view('profile.updateList', compact('register'));
    }



    public function updateAvatar(Request $request)
    {

        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = Auth::user();

        $avatarName = $user->id . '.' . request()->avatar->getClientOriginalExtension();

        $request->avatar->move(public_path('uploads'), $avatarName);
        $user->avatar = $avatarName;
        User::where('id', '=', $user->id)->update(['picture' => $avatarName]);

        return back()
            ->with('success', 'You have successfully upload image.');
    }


    public function updateProfile(Request $request, $id)
    {
        if ($request->ajax()) {
            DB::table('users')->where('id', $id)
                ->update([
                    'name' => $request->name,
                    'staffID' => $request->staffID,
                    'phoneNum' => $request->phoneNum,
                    'address' => $request->address,
                    'bankType' => $request->bankType,
                    'accNo' => $request->accNo,
                ]);
    
            return response()->json(array('success' => true));
        }
    }
    

    public function updatePassword(Request $request)
    {

        $user = Auth::user();


        User::where('id', '=', $user->id)->update([

            'users.password' => Hash::make($request->password),
            'users.confirmPass' => Hash::make($request->confirmPass),

        ]);
        return back()
            ->with('success', 'You have successfully change password.');
    }

    
}
