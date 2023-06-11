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

    <form action="{{ route('addInvoice') }} " enctype="multipart/form-data" method="POST" id="formNew" onsubmit="upload()">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <input type="text" class="form-control" value="addtech" id="addTech" name="addTech" hidden>

                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="clientAdd">Bill To</label>
                            <textarea style="height: 100px;" class="form-control" id="address" name="address" required></textarea>
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
                                        <td><input type="text" class="form-control" id="bil" name="bil" readonly></td>
                                        <td><input type="text" class="form-control" id="itemName" name="itemName" readonly></td>
                                        <td><input type="text" class="form-control" id="quantity" name="quantity" readonly></td>
                                        <td><input type="text" class="form-control" id="price" name="price" readonly></td>
                                        <td><input type="text" class="form-control" id="amount" name="amount" readonly></td>
                                        <td>
                                            <div class="btn-group" style="float: right;">
                                            <a href="{{ route('addItemForm') }} ">Add Item</a>

                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
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
                                    @foreach($itemList as $data)
                                    <tr id="row{{$data->id}}">
                                        <td>{{ $data->bil }}</td>
                                        <td>{{ $data->itemName }}</td>
                                        <td>{{ $data->quantity }}</td>
                                        <td>{{ $data->price }}</td>
                                        <td>{{ $data->amount }}</td>
                                        <td>
                                            <div class="btn-group" style="float: right;">
                                                <button type="submit" onclick="deleteItem(this)" data-id="{{ $data->id }}" data-name="{{ $data->itemName }}" id="formNew" class="btn btn-danger">Delete</button>
                                            </div>
                                        </td>
                                    </tr>

                                    @endforeach

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

                </div>
            </div>
        </div>
    </form>
</div>


<script>
    function deleteItem(e) {
        let id = e.getAttribute('data-id');
        let itemName = e.getAttribute('data-name');

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success ml-1',
                cancelButton: 'btn btn-danger mr-1'
            },
            buttonsStyling: false
        });

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            html: "Name: " + itemName + "<br> You won't be able to revert this!",
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                if (result.isConfirmed) {

                    $.ajax({
                        type: 'DELETE',
                        url: '{{url("/deleteItem")}}/' + id,
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function(data) {
                            if (data.success) {
                                swalWithBootstrapButtons.fire(
                                    'Deleted!',
                                    'Item has been deleted.',
                                    "success"
                                );

                                $("#row" + id).remove(); // you can add name div to remove
                            }


                        }
                    });

                }

            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                // swalWithBootstrapButtons.fire(
                //     'Cancelled',
                //     'Your imaginary file is safe :)',
                //     'error'
                // );

            }
        });

    }
</script>

@endsection