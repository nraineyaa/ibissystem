@extends('layouts.sideNav')

@section('content')

<style>.table-container {
    overflow: hidden;
}



</style>

<div class="row mb-4">
    <div class="col-12 col-xl-6">
        <div class="card">
            <div class="card-body">
                <h4>Job List</h4>
                <div class="table-container">
                    <table class="table table-bordered table-sm" id="dataTable">
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Location</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($userRecord as $data)
                                <tr id="row{{$data->id}}">
                                    <td>{{ $data->staffID }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td>{{ $data->category }}</td>
                                    <td>
                                        <div class="btn-group" style="float: right;">
                                            <a href="{{route('editUser',$data->id)}}" class="btn btn-primary btn-sm">View</a>
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
    <div class="col-12 col-xl-6">
        <div class="card">
            <div class="card-body">
                <h4>Job List</h4>
            </div>
        </div>
    </div>
</div>








<div class="card">
    <div class="card-header pb-0">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2">
                <h4>Tesssssst</h4>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 ml-auto">
                <a class="btn btn-success" role="button" href="{{ route('employeeRec') }}">
                    <i class="fas fa-plus"></i>&nbsp; Add New Staff
                </a>
            </div>
        </div>
    </div>


    <div class="card-body">
        @yield('inner_content')
    </div>
</div>


@endsection