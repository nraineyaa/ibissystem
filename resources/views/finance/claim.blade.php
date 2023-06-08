@extends('layouts.sideNav')

@section('content')
<div class="col-lg-2 col-md-4 col-sm-2">
    <h4>Manage Claim</h4>
</div>

@if( auth()->user()->category == "Supervisor")
<div class="row mb-4">
    <div class="col-12 col-xl-12 stretch-card">
        <div class="row flex-grow">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card" style="background:#38BDEF;">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <i class="material-icons" style="font-size:60px;color:antiquewhite;">hourglass_top</i>
                            </div>
                            <div class="form-group col-md-6">
                                <h5 style="color:antiquewhite; font-weight: bold;">In-Review</h5>
                                <h4 style="color:antiquewhite; font-weight: bold;">{{$reviewedCount}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card" style="background:#FF6262;">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <i class="material-icons" style="font-size:60px;color:antiquewhite;">update</i>
                            </div>
                            <div class="form-group col-md-6">
                                <h5 style="color:antiquewhite; font-weight: bold;">Pending</h5>
                                <h4 style="color:antiquewhite; font-weight: bold;">{{$pendingCount}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@else


<div class="row mb-4">
    <div class="col-12 col-xl-12 stretch-card">
        <div class="row flex-grow">
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card" style="background:#0F8914;">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <i class="material-icons" style="font-size:60px;color:antiquewhite;">event_available</i>
                            </div>
                            <div class="form-group col-md-6">
                                <h5 style="color:antiquewhite; font-weight: bold;">Successful</h5>
                                <h4 style="color:antiquewhite; font-weight: bold;">{{$successfulCount}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card" style="background:#D3B700;">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <i class="material-icons" style="font-size:60px;color:antiquewhite;">hourglass_top</i>
                            </div>
                            <div class="form-group col-md-6">
                                <h5 style="color:antiquewhite; font-weight: bold;">In-Review</h5>
                                <h4 style="color:antiquewhite; font-weight: bold;">{{$reviewedCount}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card" style="background:#FF6262;" >
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <i class="material-icons" style="font-size:60px;color:antiquewhite;">update</i>
                            </div>
                            <div class="form-group col-md-6">
                                <h5 style="color:antiquewhite; font-weight: bold;">Pending</h5>
                                <h4 style="color:antiquewhite; font-weight: bold;">{{$pendingCount}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<div class="card">
    <div class="card-header pb-0">
        <div class="row">
            <div class="col-lg-2 col-md-4 col-sm-2">
                <h4>Claim List</h4>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 ml-auto">
                <a class="btn btn-success" data-toggle="modal" data-target="#modalClaim" role="button" href="">
                    <i class="fas fa-plus"> </i>&nbsp; Add New Claim
                </a>
            </div>
        </div>
    </div>


    <div class="card-body">
        @yield('inner_content')
    </div>
</div>

<!-- Modal Add Claim-->
<div class="modal fade" id="modalClaim" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Claim</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <form action="addClaim" enctype="multipart/form-data" method="POST" id="formNew" onsubmit="claim()">
                            @csrf
                            <input type="text" class="form-control" value="addtech" id="addTech" name="addTech" hidden>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="claimType"> Claim Type </label>
                                    <select class="form-control" name="claimType" id="claimType" required>
                                        <option value="claim" selected disabled>Please Select</option>
                                        <option value="Fuel">Fuel</option>
                                        <option value="Overtime">Overtime</option>
                                        <option value="Medical">Medical</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="date">Date</label>
                                    <input type="date" class="form-control" id="date" name="date" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="staffID">Supervisor Name</label>
                                    <select class="form-control" name="svName" id="svName">
                                        <option value="" selected disabled>Please Select</option>
                                        @foreach($supervisor as $data)
                                        <option value="{{ $data }}">{{ $data }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="amount">Amount</label>
                                    <input type="text" class="form-control" id="amount" name="amount" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="name">Bank Account</label>
                                    <input type="text" class="form-control" id="accNo" name="accNo" value="{{ Auth::user()->accNo }}" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="bankType">Bank Name</label>
                                    <input type="text" class="form-control" id="bankType" name="bankType" value="{{ Auth::user()->bankType }}" readonly>
                                </div>
                            </div>


                            <div style="float: right;">
                                <button type="submit" id="formNew" class="btn btn-primary">Submit</button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
<script>
    function claim() {

        let timerInterval
        Swal.fire({
            title: 'Add...',
            showConfirmButton: false,
            html: 'Please wait while system updating your claim.',
            timerProgressBar: true,
            allowOutsideClick: false,
            willOpen: () => {
                Swal.showLoading()

            }
        })
    }
</script>
@endsection