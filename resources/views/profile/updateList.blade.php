@extends('layouts.sideNav')
@section('content')


<meta name="csrf-token" content="{{ csrf_token() }}">



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="card mb-3">
    <div class="card-body">
        <ul class="list-group list-group-flush">
            <li class="list-group-item p-3">
                <div class="row">
                    <div class="col">
                        <form method="get" action="{{ url('/updateUserList' . '/' . $register->id) }}">
                            <center>
                                <div class="mb-3 mx-auto">
                                    <img class="rounded-circle" src="{{asset('uploads/'.$register->picture)}}" alt=" User Avatar" width="110" height="110">
                                </div>
                            </center>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="email">Employee Email </label>
                                    <input type="text" class="form-control" id="email" name="email" value="{{$register->email}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="ic">Identification No</label>
                                    <input type="text" class="form-control" id="ic" name="ic" value="{{$register->ic}}">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{$register->name}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="staffID">Employee ID</label>
                                    <input type="text" class="form-control" id="staffID" name="staffID" value="{{$register->staffID}}">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="phoneNum">Phone Number</label>
                                    <input type="text" class="form-control" id="phoneNum" name="phoneNum" value="{{$register->phoneNum}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="category">User Type</label>
                                    <select class="form-control" name="category" id="category">

                                        @if($register->category == null)
                                        <option value="" selected disabled>--Please Select--</option>
                                        <option value="Supervisor">Supervisor</option>
                                        <option value="Accountant">Accountant</option>
                                        <option value="Human Resource">Human Resource</option>
                                        <option value="Worker">Worker</option>
                                        @elseif($register->category == "Supervisor")
                                        <option value="Supervisor" selected>Supervisor</option>
                                        <option value="Accountant">Accountant</option>
                                        <option value="Human Resource">Human Resource</option>
                                        <option value="Worker">Worker</option>

                                        @elseif($register->category == "Accountant")
                                        <option value="Supervisor">Supervisor</option>
                                        <option value="Accountant" selected>Accountant</option>
                                        <option value="Human Resource">Human Resource</option>
                                        <option value="Worker">Worker</option>

                                        @elseif($register->category == "Human Resource")
                                        <option value="Supervisor">Supervisor</option>
                                        <option value="Accountant">Accountant</option>
                                        <option value="Human Resource" selected>Human Resource</option>
                                        <option value="Worker">Worker</option>

                                        @elseif($register->category == "Worker")
                                        <option value="Supervisor">Supervisor</option>
                                        <option value="Accountant">Accountant</option>
                                        <option value="Human Resource">Human Resource</option>
                                        <option value="Worker" selected>Worker</option>

                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="salary">Salary</label>
                                    <input type="text" class="form-control" id="salary" name="salary" value="{{$register->salary}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="employmentType">Employment Type</label>
                                    <select class="form-control" name="employmentType" id="employmentType">
                                        @if($register->employmentType == "Contract")
                                        <option value="Contract" selected>Contract</option>
                                        <option value="Permanent">Permanent</option>

                                        @elseif($register->employmentType == "Permanent")
                                        <option value="Contract">Contract</option>
                                        <option value="Permanent" selected>Permanent</option>

                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" value="{{$register->address}}">
                                </div>
                            </div>
                            <br>
                            <div style="float: right;">
                                <a href="{{ url()->previous() }}" class="btn btn-danger btn-md">Cancel</a>
                                <button type="submit" class="btn btn-primary btn-md"><span class="nav-link-text">Update</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>



@endsection