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
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="docs">Document</label>
                            <input type="file" class="form-control" id="pdffile" name="document" accept="application/pdf" onchange="loadFile(this)" value="{{$report->filePath}}">
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

<script type="text/javascript" src='https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.3.min.js'></script>
<script type="text/javascript" src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/js/bootstrap.min.js'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script type="text/javascript">
    $(function() {
        $("#pdffile").change(function() {
            $("#dvPreview").html("");

            $("#dvPreview").show();
            $("#dvPreview").append("<iframe />");
            $("iframe").css({
                "height": "400px",
                "width": "450px"
            });
            var reader = new FileReader();
            reader.onload = function(e) {
                $("#dvPreview iframe").attr("src", e.target.result);
            }
            reader.readAsDataURL($(this)[0].files[0]);
        });
    });
</script>
<script>
    document.getElementById('downloadLink').addEventListener('click', function(e) {
        e.preventDefault();
        var id = document.getElementById('id').value;
        var downloadUrl = this.getAttribute('href') + '?id=' + id;
        window.location.href = downloadUrl;
    });
</script>

@endsection