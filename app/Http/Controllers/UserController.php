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
                'employmentType'
                
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
    public function updateUser(Request $request, $id)
    {
        if ($request->ajax()) {
            DB::table('users')->where('users.id', '=', $id)
                ->update([
                    'users.email' => $request->email,
                    'users.ic' => $request->ic,
                    'users.name' => $request->name,
                    'users.staffID' => $request->staffID,
                    'users.phoneNum' => $request->phoneNum,
                    'users.category' => $request->category,
                    'users.employmentType' => $request->employmentType,
                    'users.salary' => $request->salary,
                    'users.address' => $request->address,
                    'users.picture' => $request->picture,
                ]);

            return response()->json(array('success' => true));
        }
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
            'bankType' ,
            'accName' ,
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
            DB::table('users')->where('users.id', '=', $id)
                ->update([
                    'users.name' => $request->name,
                    'users.staffID' => $request->staffID,
                    'users.phoneNum' => $request->phoneNum,
                    'users.address' => $request->address,
                ]);

            return response()->json(array('success' => true));
        }
    }

    public function updatePassword(Request $request)
    {

        $user = Auth::user();

        
        User::where('id', '=', $user->id)->update([

        'users.password' => Hash::make($request->password),
        'users.confirmPass' =>Hash::make($request->confirmPass),
    
        ]);
        return back()
        ->with('success', 'You have successfully change password.');
}


}
