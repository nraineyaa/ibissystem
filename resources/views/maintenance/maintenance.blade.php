@extends('layouts.sideNav')

@section('content')

<style>
    .table-container {
        max-height: 345px;
        overflow-y: auto;
        overflow-x: hidden;
    }

    .text-center {
        display: flex;
        justify-content: center;
    }
    .btn-custom {
    font-size: 24px;
    /* Add any other custom styling if needed */
}

</style>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "order": [
                [0, "asc"]
            ],
            "language": {
                search: '<i class="fa fa-search" aria-hidden="true"></i>',
                searchPlaceholder: 'Search Job'
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#datReport').DataTable({
            "order": [
                [0, "asc"]
            ],
            "language": {
                search: '<i class="fa fa-search" aria-hidden="true"></i>',
                searchPlaceholder: 'Search Report'
            }
        });
    });
</script>

<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <h4>Job List</h4>
                    </div>
                    @if( auth()->user()->category == "Supervisor")
                    <div class="col-lg-6">
                        <a class="btn btn-success" role="button" href="{{ route('jobForm') }}" style="float:right;">
                            <i class="fas fa-plus"></i>&nbsp; Add New Job
                        </a>
                    </div>
                    @else
                    @endif
                </div>

                <div class="table-container">
                    <table class="table table-bordered table-sm" id="dataTable">
                        <thead>
                            <tr>
                                <th>Job Title</th>
                                <th>Date</th>
                                <th>Location</th>
                                <th>Worker Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jobList as $data)
                            <tr id="row{{$data->id}}">
                                <td>{{ $data->jobTitle }}</td>
                                <td>{{ $data->date }}</td>
                                <td>{{ $data->location }}</td>
                                <td>{{ $data->workersName }}</td>
                                <td>
                                    @if($data->status == "Assigned")
                                    <center><span class="badge badge-pill badge-danger" style="width: 100px;">{{ $data->status }}</span></center>
                                    @else
                                    <center><span class="badge badge-pill badge-success" style="width: 100px;">{{ $data->status }}</span></center>
                                    @endif
                                </td>
                                <td style="width: 200px;">
                                    <div>
                                        <a href="{{ route('jobInfo', $data->id) }}" class="btn btn-custom"><i class="material-icons">visibility</i></a>
                                        <a href="{{ route('editJob', $data->id) }}" class="btn btn-custom"><i class="material-icons" style="color:red;">edit_square</i></a>
                                        <a href="{{ route('jobInfo', $data->id) }}" class="btn btn-custom"><i class="material-icons" style="color:black;">email</i></a>
                                    </div>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <h4>Report List</h4>
                    </div>
                    <div class="col-lg-6">
                        <a class="btn btn-success" role="button" href="{{ route('reportForm') }}" style="float:right;">
                            <i class="fas fa-plus"></i>&nbsp; Add New Report
                        </a>
                    </div>
                </div>
                <div class="table-container">
                    <table class="table table-bordered table-sm" id="datReport">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Report Title</th>
                                <th>Date</th>
                                <th>file</th>
                                <th>remark</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reportList as $report)
                            <tr id="row{{$report->id}}">

                                <td>{{ $report->id }}</td>
                                <td>{{ $report->reportTitle }}</td>
                                <td>{{ $report->date }}</td>
                                <td>{{ $report->file }}</td>
                                <td>{{ $report->remark }}</td>
                                <td style="width: 150px;">
                                    <center><span class="badge badge-pill badge-danger" style="width: 100px;">Assigned</span></center>
                                </td>
                                <td style="width: 100px;">
                                    <div class="btn-group text-center">
                                        <a href="" class="btn btn-primary btn-sm">View</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>
</div>

@endsection