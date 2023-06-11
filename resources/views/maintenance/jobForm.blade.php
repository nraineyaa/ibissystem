@extends('layouts.sideNav')
@section('content')
<style>
    .header-content {
        display: flex;
        align-items: flex-start;
    }

    .report-text {
        float: right;
    }
</style>
<div class="card mb-3">
    <br>
    <div class="card-header pb-0">
        <h4>Add Job</h4>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col">
                <form action="{{ route('addJob') }} " enctype="multipart/form-data" method="POST" id="formNew" onsubmit="upload()">
                    @csrf
                    <input type="text" class="form-control" value="addtech" id="addTech" name="addTech" hidden>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="date">Job Title</label>
                            <input type="text" class="form-control" id="jobTitle" name="jobTitle" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="date">Date</label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="docs">Location</label>
                            <input type="text" class="form-control" id="location" name="location" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="workersName">Worker Name</label>
                            <select class="form-control" name="workersName" id="workersName">
                            <option value="" selected disabled>Please Select</option>
                                @foreach($workers as $data)
                                <option value="{{ $data}}">{{ $data }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="jobDesc">Job Description</label>
                            <textarea style="height: 100px;" type="text" class="form-control" id="jobDesc" name="jobDesc" required></textarea>
                        </div>
                    </div>
                    <div style="float: right;">
                        <a href="{{ url()->previous() }}" class="btn btn-danger btn-md">Cancel</a>
                        <button type="submit" id="formNew" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>



@endsection