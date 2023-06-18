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
        <h4>Job Details</h4>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col">
                <form action="{{ route('updateInfo', $job->jobID ) }}" method="get">

                    <input type="text" class="form-control" value="addtech" id="addTech" name="addTech" hidden>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="date">Job Title</label>
                            <input type="text" class="form-control" id="jobTitle" name="jobTitle" value="{{$job->jobTitle}}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="date">Date</label>
                            <input type="date" class="form-control" id="date" name="date" value="{{$job->date}}" readonly>
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="docs">Location</label>
                            <input type="text" class="form-control" id="location" name="location" value="{{$job->	location}}" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="workersName">Worker Name</label>
                            <select class="form-control" name="workersName" id="workersName" readonly>
                                @foreach($workers as $data)
                                @if($data->category == 'Worker')
                                <option value="{{ $data->name }}" {{ $data->name == $job->workersName ? 'selected' : '' }}>
                                    {{ $data->name }}
                                </option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="jobDesc">Job Description</label>
                            <textarea style="height: 100px;" type="text" class="form-control" id="jobDesc" name="jobDesc" readonly>{{$job->jobDesc}}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="jobDesc">Remark</label>
                            @if( auth()->user()->category == "Supervisor")
                            <textarea style="height: 100px;" type="text" class="form-control" id="remark" name="remark" readonly>{{$job->remark}}</textarea>
                            @else
                            <textarea style="height: 100px;" type="text" class="form-control" id="remark" name="remark">{{$job->remark}}</textarea>
                            @endif
                        </div>
                    </div>
                    <div style="float: right;">
                        @if( auth()->user()->category == "Worker")
                        <a href="{{ route('maintenance.page', $job->jobID ) }}" class="btn btn-danger btn-md">Cancel</a>
                        <button type="submit" id="formNew" class="btn btn-primary">Accept</button>
                        @else
                        <a href="{{ route('maintenance.page', $job->jobID ) }}" class="btn btn-dark btn-md">Back</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>



@endsection