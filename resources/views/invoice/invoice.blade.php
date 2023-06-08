@extends('layouts.sideNav')

@section('content')

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <div class="col-lg-6 col-md-6 col-sm-6">
        <h4>Manage Invoice</h4>
    </div>

    <div class="row mb-4">
        <div class="col-12 col-xl-12 stretch-card">
            <div class="row flex-grow">
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card" style="background:#0F8914;">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <i class="material-icons" style="font-size:60px;color:antiquewhite;">paid</i>
                                </div>
                                <div class="form-group col-md-6">
                                    <h5 style="color:antiquewhite; font-weight: bold;">Paid</h5>
                                    <h4></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card" style="background:#EA8D06;">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <i class="material-icons" style="font-size:60px;color:antiquewhite;">pending_actions</i>
                                </div>
                                <div class="form-group col-md-6">
                                    <h5 style="color:antiquewhite; font-weight: bold;">Unpaid</h5>
                                    <h4></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card" style="background:#FF6262;">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <i class="material-icons" style="font-size:60px; color:antiquewhite">cancel</i>
                                </div>
                                <div class="form-group col-md-6">
                                    <h5 style="color:antiquewhite; font-weight: bold;">Cancel</h5>
                                    <h4></h4>
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
                <div class="col-lg-2 col-md-2 col-sm-2">
                    <h4>Invoice</h4>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 ml-auto">
                    <a class="btn btn-success" role="button" href="{{ route('invoiceForm') }}">
                        <i class="fas fa-plus"></i>&nbsp; Add New Invoice
                    </a>
                </div>
            </div>
        </div>


        <div class="card-body">
            @yield('inner_content')
        </div>
    </div>


    @endsection