@extends('layouts.sideNav')

@section('content')

<div class="card">
    <div class="card-header pb-0">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2">
                <h4>Manage User</h4>
            </div>
        </div>
       
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2"style="float: right;">
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