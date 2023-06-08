@extends('layouts.sideNav')
@section('content')
<style>
    .header-content {
        display: flex;
        align-items: flex-start;
    }

    .address-text {
        width: 200px;
        margin-left: 10px;
        /* Adjust the margin as needed to create desired spacing */
    }

    .address-text p {
        margin: 0;
    }

    .invoice-text {
        float: right;
    }
</style>
<div class="card mb-3">
    <br>
    <div class="card-header pb-2">
        <div class="invoice-text">
            <h2>#INVOICE</h2>
        </div>
        <div class="header-content">
            <img id="main-logo" class="d-inline-block align-center mr-1" style="max-width: 100px;" src="{{ asset('frontend') }}/images/logoibis.png" alt="petakom logo">
            <div class="address-text">
                <p>B-2-1 Ampang Tudor Court,</p>
                <p>Taman Rasmi Jaya,</p>
                <p>Jalan Dedap,</p>
                <p>6800 Ampang, Selangor.</p>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col">
                <form action="" enctype="multipart/form-data" method="POST" id="formNew" onsubmit="upload()">
                    @csrf
                    <input type="text" class="form-control" value="addtech" id="addTech" name="addTech" hidden>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="clientAdd">Bill To</label>
                            <textarea style="height: 100px;" class="form-control" id="clientAdd" name="clientAdd" required></textarea>
                        </div>
                        <div class="form-group col-md-6" hidden>
                            <label for="clientName"></label>
                            <input type="text" class="form-control" id="clientName" name="clientName" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="date">Issued Date</label>
                            <input type="date" class="form-control" id="issueDate" name="issueDate" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="date">Due Date</label>
                            <input type="date" class="form-control" id="dueDate" name="dueDate" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="clientAdd">Description</label>
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th style="width:40px">Bil</th>
                                        <th>Item</th>
                                        <th style="width:80px">Quantity</th>
                                        <th style="width:200px">Price</th>
                                        <th style="width:200px">Amount</th>
                                        <th style="width:30px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="">
                                        <td><input type="text" class="form-control" id="id" name="id" required></td>
                                        <td><input type="text" class="form-control" id="item" name="item" required></td>
                                        <td><input type="text" class="form-control" id="quantity" name="quantity" required></td>
                                        <td><input type="text" class="form-control" id="price" name="price" required></td>
                                        <td><input type="text" class="form-control" id="amount" name="amount" required></td>
                                        <td>
                                            <div class="btn-group" style="float: right;">
                                                <a href="" class="btn btn-primary">Add</a>&nbsp;
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="clientAdd">Payment</label>
                            <select class="form-control" name="payment" id="payment">
                                <option value="select">Please Select</option>
                                <option value="FPX">FPX</option>
                                <option value="Cash">Cash</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="clientName">Remark</label>
                            <input type="text" class="form-control" id="remark" name="remark" required>
                        </div>
                    </div>
                    <div style="float: right;">
                        <a href="{{ url()->previous() }}" class="btn btn-danger btn-md">Cancel</a>
                        <button type="submit" id="formNew" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>



@endsection