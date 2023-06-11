@extends('layouts.sideNav')

@section('content')

<script src="{{ asset('frontend') }}/js/jquery.dataTables.js"></script>
<script src="{{ asset('frontend') }}/js/dataTables.bootstrap4.js"></script>
<script src="//code.jquery.com/jquery-1.12.3.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

<script>
    // to search the appointment 
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "order": [
                [0, "asc"]
            ],
            "language": {
                search: '<i class="fa fa-search" aria-hidden="true"></i>',
                searchPlaceholder: 'Search Attendance'
            }
        });

        // filter appointment
        $('.dataTables_filter input[type="search"]').css({
            'width': '300px',
            'display': 'inline-block',
            'font-size': '15px',
            'font-weight': '400'
        });
    });
</script>

<!-- to display the alert message if the record has been deleted -->
@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif

<div class="card">

    <div class="card-body">

        <div class="overflow-auto" style="overflow:auto;">
            <div class="table-responsive">
                <div class="card-body ">
                    @if ($attendList->contains('date', now()->toDateString()))
                    <div class="card-header pb-0" hidden>
                        <h4>Attendance</h4>
                    </div>
                    @else
                    <form id="checkInForm" method="post" action="{{ route('checkIn') }}">
                        @csrf
                        <div class="form-group col-md-12">
                            <label for="date">Status</label>
                            <select class="form-control" name="status" id="status">
                                <option value="select">Please Select</option>
                                <option value="Available">Available</option>
                                <option value="On-Leave">On-Leave</option>
                                <option value="On-Site">On-Site</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" style="float: right; ; background:#2952a3;" role="button">Check-in</button>
                    </form>
                    @endif
                </div>

                <hr>
                <div class="card-header pb-0">
                    <h4>Attendance Record</h4>
                </div>
                <div class="card-body">
                    @if( auth()->user()->category== "Accountant")
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Check-in</th>
                                <th>Check-out</th>
                            </tr>
                        </thead>

                        @foreach($attendList as $index => $data)
                        <tbody>
                            <tr id="row{{$data->id}}">
                                <td>{{ $data->id }}</td>
                                <td>{{ $data->date }}</td>
                                <td>{{ $data->status }}</td>
                                <td>{{ $data->checkIn }}</td>
                                <td>

                                    @if ( $data->checkOut == null )
                                    <center><a href="{{ route('checkOut', $data->id) }}" class="btn btn-primary" style="width:40%; background:#2952a3;" role="button">Check-out</a></center>
                                    @elseif( $data->status == "On-Leave" )
                                    <center>-</center>
                                    @else
                                    {{ $data->checkOut }}
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>



                @endif
                <!-- FOR Manager TO VIEW RECORD APPOINTNMENT LIST END -->
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('frontend') }}/js/jquery.dataTables.js"></script>
<script>
    function deleteItem(e) {
        let id = e.getAttribute('data-id');
        let name = e.getAttribute('data-name');

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success ml-1',
                cancelButton: 'btn btn-danger mr-1'
            },
            buttonsStyling: false
        });

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            html: "Name: " + name + "<br> You won't be able to revert this!",
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                if (result.isConfirmed) {

                    $.ajax({
                        type: 'DELETE',
                        url: '{{url("/deleteFile")}}/' + id,
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function(data) {
                            if (data.success) {
                                swalWithBootstrapButtons.fire(
                                    'Deleted!',
                                    'Document has been deleted.',
                                    "success"
                                );

                                $("#row" + id).remove(); // you can add name div to remove
                            }


                        }
                    });

                }

            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                // swalWithBootstrapButtons.fire(
                //     'Cancelled',
                //     'Your imaginary file is safe :)',
                //     'error'
                // );
            }
        });

    }
</script>

@endsection