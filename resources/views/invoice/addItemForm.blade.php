@extends('layouts.sideNav')
@section('content')


<div class="card mb-3">\

    <div class="card-header pb-2">

        <h4>Add Item</h4>

    </div>

    <form action="{{ route('addItem') }} " enctype="multipart/form-data" method="POST" id="formNew" onsubmit="upload()">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="clientAdd">Description</label>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width:70px">Bil</th>
                                <th>Item</th>
                                <th style="width:80px">Quantity</th>
                                <th style="width:200px">Price</th>
                                <th style="width:200px">Amount</th>
                                <th style="width:30px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id="">
                                <td><input type="text" class="form-control" id="bil" name="bil"></td>
                                <td><input type="text" class="form-control" id="itemName" name="itemName"></td>
                                <td><input type="text" class="form-control" id="quantity" name="quantity"></td>
                                <td><input type="text" class="form-control" id="price" name="price"></td>
                                <td><input type="text" class="form-control" id="amount" name="amount"></td>
                                <td>
                                    <div class="btn-group" style="float: right;">
                                        <button type="submit" id="formNew" class="btn btn-primary">Add</button>

                                    </div>
                                </td>

                            </tr>

                        </tbody>
                    </table>
                    <div style="float: right;">
                        <a href="{{ route('invoiceForm') }}" class="btn btn-dark btn-md">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection