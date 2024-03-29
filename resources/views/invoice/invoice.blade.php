@extends('layouts.sideNav')

@section('content')

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

<div class="col-lg-6 col-md-6 col-sm-6">
    <h4>Manage Invoice</h4>
</div>

<div class="row mb-4">
    <div class="col-12 col-xl-12 stretch-card mb-2">
        <div class="row flex-grow">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card" style="background:#0F8914;">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <i class="material-icons" style="font-size:60px;color:antiquewhite;">paid</i>
                            </div>
                            <div class="form-group col-md-6">
                                <h5 style="color:antiquewhite; font-weight: bold;">Paid</h5>
                                <h4 style="color:antiquewhite;">{{$paidCount}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card mb-2">
                <div class="card" style="background:#FF6262;">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <i class="material-icons" style=" color:antiquewhite; font-size:60px;">pending_actions</i>
                            </div>
                            <div class="form-group col-md-6">
                                <h5 style="color:antiquewhite;  font-weight: bold;">Unpaid</h5>
                                <h4 style="color:antiquewhite;">{{$unpaidCount}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header pb-0">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8 d-flex align-items-center">
                <h4>Invoice</h4>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 d-flex justify-content-end">
                <div class="mr-2">
                    <a class="btn btn-success btn-sm" role="button" href="{{ route('companyList') }}">
                        <i class="fas fa-plus"></i> Add New Invoice
                    </a>
                </div>
            </div>
        </div>







        <div class="card-body">
            <div class="overflow-auto" style="overflow:auto;">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width:40px">#</th>
                                <th>Issue Date</th>
                                <th>Due Date</th>
                                <th>Company</th>
                                <th>Status</th>
                                <th style="width:30px">Remark</th>
                                <th style="width:30px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($invoiceList as $data)

                            <tr id="row{{$data->id}}">
                                <td>{{ $data->invoiceNumber}}</td>
                                <td>{{ $data->issueDate }}</td>
                                <td>{{ $data->dueDate }}</td>
                                <td>{{ $data->compName }}</td>
                                @if($data->status == 'Unpaid')
                                <td style="width: 100px; color:red;">{{ $data->status }}</td>
                                @else
                                <td style="width: 100px; color:green;">{{ $data->status }}</td>
                                @endif
                                <td>{{ $data->remark }}</td>
                                <td>
                                    <div class="btn-group" style="float: right;">
                                        <a type="button" href="{{ route('viewInvoice', $data->invoiceID ) }}" class="btn btn-primary">View</a>
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
    });
</script>

@endsection