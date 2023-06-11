@extends('layouts.sideNav')
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="col-lg-2 col-md-4 col-sm-2">
    <h4>Claim Details</h4>
</div>


<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col">
                @if( auth()->user()->category == "Supervisor")
                <form method="get" action="{{ route('updateClaim', $claim->claimID ) }}">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="claimType"> Claim Type </label>
                            <select class="form-control" name="claimType" id="claimType">
                                @if($claim->claimType == null)
                                <option value="" selected disabled>--Please Select--</option>
                                <option value="Fuel">Fuel</option>
                                <option value="Overtime">Overtime</option>
                                <option value="Medical">Medical</option>
                                @elseif($claim->claimType == "Fuel")
                                <option value="Fuel" selected>Fuel</option>
                                <option value="Overtime">Overtime</option>
                                <option value="Medical">Medical</option>
                                @elseif($claim->claimType == "Overtime")
                                <option value="Fuel">Fuel</option>
                                <option value="Overtime" selected>Overtime</option>
                                <option value="Medical">Medical</option>
                                @elseif($claim->claimType == "Medical")
                                <option value="Fuel">Fuel</option>
                                <option value="Overtime">Overtime</option>
                                <option value="Medical" selected>Medical</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="date">Date</label>
                            <input type="date" class="form-control" id="date" name="date" value="{{$claim->date}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="amount">Amount</label>
                            <input type="text" class="form-control" id="amount" name="amount" value="{{$claim->amount}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="staffID">Supervisor Name</label>
                            <select class="form-control" name="svName" id="svName">
                                @foreach($supervisors as $user)
                                @if($user->category == 'Supervisor')
                                <option value="{{ $user->name }}" {{ $user->name == $claim->svName ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="date">Status</label>
                            <select class="form-control" name="status" id="status">
                                @if($claim->status == null)
                                <option value="" selected disabled>--Please Select--</option>
                                <option value="Reviewed">Reviewed</option>
                                <option value="Pending">Pending</option>

                                @elseif($claim->status == "Reviewed")
                                <option value="Reviewed" selected>Reviewed</option>
                                <option value="Pending">Pending</option>

                                @elseif($claim->status == "Pending")
                                <option value="Reviewed">Reviewed</option>
                                <option value="Pending" selected>Pending</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="name">Remark</label>
                            @if( auth()->user()->category == "Supervisor")
                            <input type="text" class="form-control" id="remark" name="remark" value="{{$claim->remark}}">
                            @else
                            <input type="text" class="form-control" id="remark" name="remark" value="{{$claim->remark}}" readonly>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="name">Bank Account</label>
                            <input type="text" class="form-control" id="accNo" name="accNo" value="{{$claim->accNo}}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="bankType">Bank Name</label>
                            <input type="text" class="form-control" id="bankType" name="bankType" value="{{$claim->bankType}}" readonly>
                        </div>
                    </div>
                    <div style="float: right;">
                        <a href="{{ route('claim.page', $claim->claimID ) }}" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-primary btn-md"><span class="nav-link-text">Submit</span></button>
                    </div>
                </form>
                @else
                <form method="get" action="{{ route('updateClaim', $claim->claimID ) }}">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="claimType"> Claim Type </label>
                            <select class="form-control" name="claimType" id="claimType">
                                @if($claim->claimType == null)
                                <option value="" selected disabled>--Please Select--</option>
                                <option value="Fuel">Fuel</option>
                                <option value="Overtime">Overtime</option>
                                <option value="Medical">Medical</option>
                                @elseif($claim->claimType == "Fuel")
                                <option value="Fuel" selected>Fuel</option>
                                <option value="Overtime">Overtime</option>
                                <option value="Medical">Medical</option>
                                @elseif($claim->claimType == "Overtime")
                                <option value="Fuel">Fuel</option>
                                <option value="Overtime" selected>Overtime</option>
                                <option value="Medical">Medical</option>
                                @elseif($claim->claimType == "Medical")
                                <option value="Fuel">Fuel</option>
                                <option value="Overtime">Overtime</option>
                                <option value="Medical" selected>Medical</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="date">Date</label>
                            <input type="date" class="form-control" id="date" name="date" value="{{$claim->date}}" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="amount">Amount</label>
                            <input type="text" class="form-control" id="amount" name="amount" value="{{$claim->amount}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="staffID">Supervisor Name</label>
                            <select class="form-control" name="svName" id="svName">
                                @foreach($supervisors as $user)
                                @if($user->category == 'Supervisor')
                                <option value="{{ $user->name }}" {{ $user->name == $claim->svName ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="date">Status</label>
                            <select class="form-control" name="status" id="status">
                                @if($claim->status == null)
                                <option value="" selected disabled>--Please Select--</option>
                                <option value="Successful">Successful</option>
                                @elseif($claim->status == "Reviewed")
                                <option value="Reviewed" selected>Reviewed</option>
                                <option value="Successful">Successful</option>
                                @else
                                <option value="Successful" selected disabled>Successful</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="name">Remark</label>
                            <input type="text" class="form-control" id="remark" name="remark" value="{{$claim->remark}}" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="name">Bank Account</label>
                            <input type="text" class="form-control" id="accNo" name="accNo" value="{{$claim->accNo}}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="bankType">Bank Name</label>
                            <input type="text" class="form-control" id="bankType" name="bankType" value="{{$claim->bankType}}" readonly>
                        </div>
                    </div>
                    <div style="float: right;">
                        <a href="{{ route('claim.page', $claim->claimID ) }}" class="btn btn-secondary">Back</a>
                        @if($claim->status != "Successful")
                        <button type="submit" class="btn btn-primary btn-md"><span class="nav-link-text">Submit</span></button>
                        @else
                        @endif
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection