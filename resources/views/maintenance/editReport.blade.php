@extends('layouts.sideNav')
@section('content')
<style>
    .header-content {
        display: flex;
        align-items: flex-start;
    }

    .report-text {}
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
                <form action="{{ route('updateReport', $report->reportID ) }}" method="get">
                    @csrf
                    <input type="text" class="form-control" value="addtech" id="addTech" name="addTech" hidden>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="date">Title</label>
                            <input type="text" class="form-control" id="reportTitle" name="reportTitle" value="{{$report->reportTitle}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="date">Date</label>
                            <input type="date" class="form-control" id="date" name="date" value="{{$report->date}}">
                        </div>

                    </div>
                    <!-- <div class="row">
                        <div class="form-group col-md-12">
                            <label for="docs">Document</label>
                            <input type="text" name="id" id="id" class="form-control" value="{{$report->filePath}}">
                            <a id="downloadLink" href="{{ route('download', ['filePath' => $report->filePath]) }}">Download File</a>
                        </div>
                    </div> -->

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="docs">Document</label>
                            <div>
                                <center>
                                    <div>
                                        <embed src="{{ asset('storage/' . $report->filePath) }}" type="application/pdf" width="100%" height="600px" />
                                    </div>

                                </center>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="clientName">Remark</label>
                            <textarea style="height: 100px;" type="text" class="form-control" id="remark" name="remark">{{$report->remark}}"</textarea>
                        </div>
                    </div>
                    <div style="float: right;">
                        <a href="{{ route('maintenance.page') }}" class="btn btn-danger btn-md">Cancel</a>
                        <button type="submit" id="formNew" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<script>
    document.getElementById('downloadLink').addEventListener('click', function(e) {
        e.preventDefault();
        var id = document.getElementById('id').value;
        var downloadUrl = this.getAttribute('href') + '?id=' + id;
        window.location.href = downloadUrl;
    });
</script>

@endsection