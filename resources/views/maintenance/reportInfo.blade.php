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
            <h2>REPORT</h2>
        </div>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col">
            <form action="{{ route('updateStatus', $report->reportID ) }}" method="get">
                    @csrf
                    <input type="text" class="form-control" value="addtech" id="addTech" name="addTech" hidden>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="date">Title</label>
                            <input type="text" class="form-control" id="reportTitle" name="reportTitle" value="{{$report->reportTitle}}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="date">Date</label>
                            <input type="date" class="form-control" id="date" name="date" value="{{$report->date}}"readonly>
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <iframe src="/{{$report->filePath}}" style="width: 455px; height: 405px; border-style: dashed"></iframe>

                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="clientName">Remark</label>
                            <textarea style="height: 100px;" type="text" class="form-control" id="remark" name="remark" readonly>{{$report->remark}}"</textarea>
                        </div>
                    </div>
                    <div style="float: right;">
                    
                    @if($report->status == 'Pending')
                        <a href="{{ route('maintenance.page') }}"class="btn btn-danger btn-md">Cancel</a>
                        <button type="submit" id="formNew" class="btn btn-success">Checked</button>
                        @else
                        
                        <a href="{{ route('maintenance.page') }}"class="btn btn-dark btn-md">back</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>



@endsection