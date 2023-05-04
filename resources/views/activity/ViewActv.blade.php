@extends('layouts.sideNav')
@section('content')

<div class="card">
    <div class="card-header pb-0">
        <div class="row">
            <div class=" {{  auth()->user()->category== 'Human Resource' ? 'col-lg-10 col-md-10 col-sm-10' : (request()->routeIs('activity') ? 'col-lg-10 col-md-10 col-sm-10' : 'col-lg-12 col-md-12 col-sm-12') }}">
                <nav class="">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('activity') ? 'active' : '' }}" href="{{ route('activity') }}" role="tab" aria-selected="true">List Of Activity</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('activity/PlanActv') ? 'active' : '' }}" href="{{ route('activity/PlanActv') }}" role="tab" aria-selected="false">Activity Approval</a>
                        </li>
                    </ul>
                </nav>
            </div>

            @if( auth()->user()->category== "Student")

            @if(request()->routeIs('activity'))
            <div class="col-lg-2 col-md-2 col-sm-2" style="float: right;">
                <a class="btn btn-success" style="float: right; width:100%;" role="button" href="{{ route('activity/AddActv') }}">
                    <i class="fas fa-plus"></i>&nbsp; Add New Activity</a>
            </div>
            @else
            <div class="col-lg-2 col-md-2 col-sm-2" style="float: right;">
                <a class="btn btn-success" style="float: right; width:100%;" role="button" href="">
                    <i class="fa fa-cog"></i>&nbsp; TAKDE ADD PAPE</a>
            </div>
            @endif

            @else

            @if(request()->routeIs('activity'))
            <div class="col-lg-2 col-md-2 col-sm-2" style="float: right;">
                <a class="btn btn-success" style="float: right; width:100%;" role="button" href="{{ route('activity/AddActv') }}">
                    <i class="fas fa-plus"></i>&nbsp; Add New Activity</a>
            </div>
            @endif

            @endif

        </div>
    </div>

    <div class="card-body">
        @yield('inner_content')
    </div>
</div>

@endsection