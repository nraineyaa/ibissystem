@extends('profile.registerUser')
@section('inner_content')


<div class="row">
    <div class="col">
        <form action="{{ route('addUser') }} " enctype="multipart/form-data" method="POST" id="formNew" onsubmit="upload()">
            @csrf
            <input type="text" class="form-control" value="addtech" id="addTech" name="addTech" hidden>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="email">Email </label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="email" required>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="password">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="confirmPass">{{ __('Confirm Password') }}</label>
                    <input id="confirmPass" type="password" class="form-control" required autocomplete="new-password" placeholder="Confirm Password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>


            <div class="row">
                <div class="form-group col-md-6">
                    <label for="name">Fullname</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="phoneNum">Phone Number</label>
                    <input type="text" class="form-control" id="phoneNum" name="phoneNum" placeholder="Phone Number" required>
                </div>
            </div>
        
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="phoneNum">Employee ID</label>
                    <input type="text" class="form-control" id="staffID" name="staffID" placeholder="Staff ID" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="position">User Type</label>
                    <select class="form-control" name="category" id="category">
                        <option value="Accountant">-</option>
                        <option value="Accountant">Accountant</option>
                        <option value="Worker">Worker</option>
                        <option value="Supervisor">Supervisor</option>
                        <option value="HR">HR</option>
                    </select>
                </div>
            </div>
            <div class="row">
            <div class="form-group col-md-6">
                    <label for="position">Employment Type</label>
                    <select class="form-control" name="employmentType" id="employmentType">
                        <option value="Accountant">-</option>
                        <option value="Contract">Contract</option>
                        <option value="Permanent">Permanent</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="Salary">Salary</label>
                    <input type="text" class="form-control" id="salary" name="salary" placeholder="0-10,000" required>
                </div>
            </div>


            <div class="row">
                <div class="form-group col-md-12">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Address" required>
                </div>
            </div>

        </form>
    </div>
</div>



@endsection