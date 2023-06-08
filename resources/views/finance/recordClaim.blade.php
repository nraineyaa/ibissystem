@extends('finance.claim')

@section('inner_content')
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
                searchPlaceholder: 'Search Claim'
            }
        });
    });
</script>

<div class="overflow-auto" style="overflow:auto;">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Claim Type</th>
                    <th>Supervisor Name</th>
                    <th>Amount (RM)</th>
                    <th>Status</th>
                    <th style="width:30px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($userRecord as $data)
                <tr id="row{{$data->id}}">
                    <td>{{ $data->date }}</td>
                    <td>{{ $data->claimType }}</td>
                    <td>{{ $data->svName }}</td>
                    <td>{{ $data->amount }}</td>
                    <td style="width: 100px;">
                        @if($data->status == "Pending")
                        <span class="badge badge-pill badge-danger" style="width: 100px;">Pending</span>
                        @elseif($data->status == "Reviewed")
                        <span class="badge badge-pill badge-warning" style="width: 100px;">In-Review</span>
                        @else
                        <span class="badge badge-pill badge-success" style="width: 100px;">Paid</span>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group" style="float: right;">
                            <a type="button" href="{{ route('editClaim', $data->id ) }}" class="btn btn-primary">View</a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Page level plugin JavaScript-->
<script src="{{ asset('frontend') }}/js/jquery.dataTables.js"></script>
<!-- for sweet alert fire-->
<script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>
@endsection