@extends('layouts.sideNav')

@section('content')

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