@extends('profile.registerUser')
@section('inner_content')

<div class="row">
    <div class="col">
        <form action="{{ route('addUser') }} " enctype="multipart/form-data" method="POST" id="formNew" onsubmit="upload()">
            @csrf
            <input type="text" class="form-control" value="addtech" id="addTech" name="addTech" hidden>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="bankType">Bank Name </label>
                    <input type="text" class="form-control" id="bankType" name="bankType" placeholder="Bank Name" required>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="accName">Account Name</label>
                    <input type="text" class="form-control" id="accName" name="accName" placeholder="Name" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="accNum">Account Number</label>
                    <input type="text" class="form-control" id="accNum" name="accNum" placeholder="Phone Number" required>
                </div>
            </div>
            <div style="float: right;">
                <a href="{{ url()->previous() }}" class="btn btn-danger btn-md">Cancel</a>
                <button type="submit" id="formNew" class="btn btn-primary">Register</button>
            </div>

        </form>
    </div>
</div>

@endsection