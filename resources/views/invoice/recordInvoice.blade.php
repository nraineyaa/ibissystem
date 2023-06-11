@extends('invoice.invoice')

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
                searchPlaceholder: 'Search Invoice'
            }
        });

        $('.dataTables_filter input[type="search"]').css({
            'width': '300px',
            'display': 'inline-block',
            'font-size': '15px',
            'font-weight': '400'
        });
    });
</script>


@section('inner_content')


<div class="overflow-auto" style="overflow:auto;">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th style="width:40px">#</th>
                    <th>Issue Date</th>
                    <th>Due Date</th>
                    <th>Address</th>
                    <th>Status</th>
                    <th style="width:30px">Remark</th>
                    <th style="width:30px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoiceList as $data)

                <tr id="row{{$data->id}}">
                    <td>{{ $data->issueDate }}</td>
                    <td>{{ $data->dueDate }}</td>
                    <td>{{ $data->address }}</td>
                    <td>{{ $data->remark }}</td>
                    <td style="width: 100px;"> <span class="badge badge-pill badge-danger" style="width: 100px;">Unpaid</span></td>
                    <td>
                        <div class="btn-group" style="float: right;">
                            <span class="btn btn-default material-symbols-outlined">
                                chevron_right
                            </span>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


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
                        url: '{{url("/deleteUser")}}/' + id,
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function(data) {
                            if (data.success) {
                                swalWithBootstrapButtons.fire(
                                    'Deleted!',
                                    'User account has been deleted.',
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


<!-- Page level plugin JavaScript-->
<script src="{{ asset('frontend') }}/js/jquery.dataTables.js"></script>
<!-- for sweet alert fire-->
<script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>


@endsection