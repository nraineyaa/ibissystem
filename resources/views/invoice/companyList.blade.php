@extends('layouts.sideNav')
@section('content')

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "order": [
                [0, "asc"]
            ],
            "language": {
                search: '<i class="fa fa-search" aria-hidden="true"></i>',
                searchPlaceholder: 'Search Company'
            }
        });
    });
</script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

<div class="col-lg-6 col-md-6 col-sm-6">
    <h4>Manage Company</h4>
</div>
<div class="card">
    <div class="card-header pb-0">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8 d-flex align-items-center">
                <h4>Company List</h4>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 d-flex justify-content-end">
                <div class="mr-2">
                    <a class="btn btn-success btn-sm" role="button" href="{{ route('compForm') }}">
                        <i class="fas fa-plus"></i> Add New Company
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
                                <th>Company Name</th>
                                <th>Phone Number</th>
                                <th>Email</th>
                                <th style="width:30px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($companyList as $data)

                            <tr id="row{{$data->id}}">
                                <td>{{ $data->id }}</td>
                                <td>{{ $data->compName }}</td>
                                <td>{{ $data->compPhone }}</td>
                                <td>{{ $data->compEmail }}</td>
                                <td>
                                    <div class="btn-group" style="float: right;">
                                        <a type="button" href="{{ route('invoiceForm', $data->id ) }}" class="btn btn-primary">Select</a>
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
    @endsection