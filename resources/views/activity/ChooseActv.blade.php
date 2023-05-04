@extends('layouts.sideNav')
<script src="{{ asset('frontend') }}/js/jquery.dataTables.js"></script>
<script src="{{ asset('frontend') }}/js/dataTables.bootstrap4.js"></script>

<script src="//code.jquery.com/jquery-1.12.3.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
@section('content')

<style>
    .search {

        -webkit-transition: width 0.4s ease-in-out;
        transition: width 0.4s ease-in-out;
        float: right;
    }

    .searchInput {
        width: 130px;
    }

    /* When the input field gets focus, change its width to 100% */
    .searchInput:focus {
        width: 100%;
    }
</style>

<div class="card">
    <div class="card-header border-bottom pb-0">
        <div class="row">
            <div class="col col-md-6">
                <h6 class="m-0">Choose Activity Details</h6>
            </div>

            <div class="col col-md-6">
                <form onsubmit="searchingg()" action="{{ route('searchActvP') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="input-group search-style">
                        <div class="input-group-prepend">
                            <button class="btn btn-secondary" type="button" onclick="clearFilter()">
                                <i class="fa fa-times "></i>
                            </button>
                        </div>
                        <input autocomplete="off" type="text" class="form-control" placeholder="Search activity" name="query" value="{{$searchActivity['query'] ?? null}}">
                        <div class="input-group-append">
                            <button class="btn btn-secondary" type="submit" id="searchBtn">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="thead-dark">
                        <th>Activity Name</th>
                        <th>Date</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($activities as $activity)
                    <tr>
                        <td>{{$activity->activityName}}</td>
                        <td>{{$activity->activityDate}}</td>
                        <td>{{$activity->activityVenue}}</td>
                        <td>Waiting for Approval</td>
                        <td><a href="{{route('activityDetails', $activity->id)}}" class='btn btn-primary'>Select</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="row" style="margin-right: 1px;">
                <div class="col mt-auto mb-auto">
                    Showing {!! $activities->firstItem() !!} to {!! $activities->lastItem() !!} of {!! $activities->total() !!} activities
                </div>
                <div style="float: right; text-align:right;" class="col">
                    <div class="mt-auto mb-auto p-auto" style="float: right; text-align:center;">
                        {!! $activities->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>

<script>
    function searchingg() {
        var searchBtn = document.getElementById('searchBtn');
        searchBtn.innerHTML = 'Searching...';
        searchBtn.disabled = true;
    }

    function clearFilter() {
        $.ajax({
            type: 'get',
            url: '{{url("/clearFilterActivity")}}',
            data: {
                "_token": "{{ csrf_token() }}",
            },
            success: function(data) {
                if (data.success) {
                    window.location = "/viewActvProposal";
                }

            }
        });

    }
</script>


@endsection