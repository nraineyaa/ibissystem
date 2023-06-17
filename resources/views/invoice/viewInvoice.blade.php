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

    .date-label {
        margin-bottom: 5px;
        /* Adjust the margin as needed */
    }

    .date-value {
        margin-top: 5px;
        /* Adjust the margin as needed */
    }

    .status-box {
        border: 1px solid #ccc;
        padding: 10px;
        background-color: #f5f5f5;
    }

    .status-value {
        margin-top: 10px;
        font-weight: bold;
        color: red;
    }
</style>
<div class="card mb-3">
    <br>
    <div class="card-header pb-2">
        <div class="invoice-text">
            <h2>INVOICE</h2>
            <h4 id="invoiceNumber" style="color:blue;">#{{ $invoice->invoiceNumber }}</h4>
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
                <input type="text" class="form-control" value="addtech" id="addTech" name="addTech" hidden>

                <div class="row">
                    <div class="form-group col-md-6">
                        <div class="date-label">
                            <label for="date">Bill To</label>
                        </div>
                        <div class="date-value">
                            <?php
                            $companyInfo = array(
                                $companyData->compName,
                                $companyData->address,
                                'Phone Number: ' . $companyData->compPhone,
                                'Email: ' . $companyData->compEmail
                            );
                            $implodedInfo = implode('<br>', $companyInfo);
                            ?>
                            <span readonly>{!! $implodedInfo !!}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="status-box" style="width:150px; float: right;">
                            <span id="invoiceNumber">STATUS :</span>
                            <div class="status-value">
                                <h4 style="color:red;">{{ $invoice->status }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="compID" value="{{ $companyData->id }}">

                <div class="row">
                    <div class="form-group col-md-6">
                        <div class="date-label">
                            <label for="date">Issued Date</label>
                        </div>
                        <div class="date-value">
                            <span readonly>{{ date('d/m/Y', strtotime($invoice->issueDate)) }}</span>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="date-label">
                            <label for="date">Due Date</label>
                        </div>
                        <div class="date-value">
                            <span readonly>{{ date('d/m/Y', strtotime($invoice->dueDate)) }}</span>
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="clientAdd">Description</label>
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr style="background-color:#ECEFF1;">
                                    <th style="width:70px">Bil</th>
                                    <th>Item</th>
                                    <th style="width:80px">Quantity</th>
                                    <th style="width:200px">Price</th>
                                    <th style="width:200px">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->itemName }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->amount }}</td>
                                </tr>
                                @endforeach

                                <!-- New row for total amount -->
                                <tr>
                                    <th colspan="4" style="text-align: right; background-color:#ECEFF1;">Total Amount</th>
                                    <td>{{ $invoice->totalAmount }}</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>


                <div class="row">
                    <div class="form-group col-md-6">
                        <div class="date-label">
                            <label for="date">Payment</label>
                        </div>
                        <div class="date-value">
                            <span readonly>{{ $invoice->payment }}</span>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="date-label">
                            <label for="date">Remark</label>
                        </div>
                        <div class="date-value">
                            <span readonly>{{ $invoice->remark }}</span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                     
                    <span readonly></span>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="date-label">
                            <label for="date">Remark</label>
                        </div>
                        <div class="date-value">
                            <span readonly>{{ $invoice->remark }}</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div style="float: right;">
            <a href="{{ url()->previous() }}" class="btn btn-danger btn-md">Cancel</a>
            <button type="submit" id="formNew" class="btn btn-primary">Paid</button>
            <button type="submit" id="formNew" class="btn btn-primary">Print</button>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    $(document).ready(function() {
        // Calculate the amount for each row on page load
        $('.amount').each(function() {
            var row = $(this).closest('tr');
            calculateAmount(row);
        });

        // Calculate the total amount
        calculateTotalAmount();

        // Function to calculate the amount
        function calculateAmount(row) {
            var quantity = row.find('.quantity').val();
            var price = row.find('.price').val();

            if (quantity && price) {
                var amount = parseFloat(quantity) * parseFloat(price);
                row.find('.amount').val(amount.toFixed(2));
            }
        }

        // Function to calculate the total amount
        function calculateTotalAmount() {
            var total = 0;
            $('.amount').each(function() {
                var amount = parseFloat($(this).val());
                if (!isNaN(amount)) {
                    total += amount;
                }
            });
            $('#totalAmount').val(total.toFixed(2));
        }
    });
</script>


@endsection