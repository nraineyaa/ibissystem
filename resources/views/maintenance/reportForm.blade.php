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
    <div class="card-header pb-2">
        <div class="report-text">
            <h2>REPORT</h2>
        </div>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col">
                <form action="{{ route('addReport') }} " enctype="multipart/form-data" method="POST" id="formNew" onsubmit="upload()">
                    @csrf
                    <input type="text" class="form-control" value="addtech" id="addTech" name="addTech" hidden>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="date">Title</label>
                            <input type="text" class="form-control" id="reportTitle" name="reportTitle" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="date">Date</label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="docs">Document</label>
                            <input type="file" class="form-control" id="file" name="file" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="clientName">Remark</label>
                            <textarea style="height: 100px;" type="text" class="form-control" id="remark" name="remark" required></textarea>
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