@extends('maintenance.maintenance')

<script src="{{ asset('frontend') }}/js/jquery.dataTables.js"></script>
<script src="{{ asset('frontend') }}/js/dataTables.bootstrap4.js"></script>
<script src="//code.jquery.com/jquery-1.12.3.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

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

        $('.dataTables_filter input[type="search"]').css({
            'width': '200px',
            'display': 'inline-block',
            'font-size': '15px',
            'margin-right': '10px',
            'font-weight': '400'
        });
    });
</script>


@section('inner_content_att')

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
                <td style="width: 150px;">
                    <center><span class="badge badge-pill badge-danger" style="width: 100px;">Assigned</span></center>
                </td>
                <td style="width: 100px;">
                    <div class="btn-group text-center">
                        <a href="{{route('editUser',$data->id)}}" class="btn btn-primary btn-sm">View</a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Page level plugin JavaScript-->
<script src="{{ asset('frontend') }}/js/jquery.dataTables.js"></script>
<!-- for sweet alert fire-->
<script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>


@endsection
