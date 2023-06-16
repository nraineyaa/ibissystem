@extends('layouts.sideNav')
@section('content')
<style>
    .header-content {
        display: flex;
        align-items: flex-start;
    }

    .report-text {
      
    }
</style>
<div class="card mb-3">
    <br>
    <div class="card-header pb-2">
        <div class="report-text">
            <h2>Add Company</h2>
        </div>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col">
                <form action="{{ route('addCompany') }} " enctype="multipart/form-data" method="POST" id="formNew" onsubmit="upload()">
                    @csrf
                    <input type="text" class="form-control" value="addtech" id="addTech" name="addTech" hidden>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="compName">Company Name</label>
                            <input type="text" class="form-control" id="compName" name="compName" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="compPhone">Phone Number</label>
                            <input type="text" class="form-control" id="compPhone" name="compPhone" required>
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="clientName">Address</label>
                            <textarea style="height: 100px;" type="text" class="form-control" id="address" name="address" required></textarea>
                        </div>
                    </div>
                    <div style="float: right;">
                        <a href="{{ route('maintenance.page') }}"class="btn btn-danger btn-md">Cancel</a>
                        <button type="submit" id="formNew" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>



@endsection