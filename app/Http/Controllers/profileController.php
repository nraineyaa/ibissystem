<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Profiler\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class profileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //display interface
    public function index()
    {
        return view('auth.profile');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //send user to edit
    public function edit($id)
    {
        $user = User::find($id);
        return view('auth.profile', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //update function
    public function update(Request $request, $id)
    {
        $user = Auth::user();

        User::where('id', '=', $user->id)->update([

            'users.name' => $request->name,
            'users.email' => $request->email,
            'users.staffID' => $request->staffID,
            'users.phoneNum' => $request->phoneNum,
            'users.bankType' => $request->bankType,
            'users.accNo' => $request->accNo,

        ]);

        return back()->with('success', 'Your profile is successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
