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

    .company-name {
        text-align: left;
        margin-bottom: 0;
    }
</style>
<div class="card mb-3">
    <br>
    <div class="card-header pb-2">
        <div class="invoice-text">
            <h2>#INVOICE</h2>
            <!-- <h4 id="invoiceNumber"></h4>
            <input type="hidden" name="invoiceNumber" id="invoiceNumberInput"> -->
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
                            <textarea style="height: 115px; text-align: start;" class="form-control" id="address" name="address" readonly>
                                <?php
                                $companyInfo = array(
                                    'compName' => $companyData->compName,
                                    'address' => $companyData->address,
                                    'compPhone' => 'Phone Number : ' . $companyData->compPhone,
                                    'compEmail' => 'Email: ' . $companyData->compEmail
                                );

                                $implodedInfo = '';

                                foreach ($companyInfo as $line) {
                                    if (!empty($line)) {
                                        $implodedInfo .= $line . "\n";
                                    }
                                }

                                echo $implodedInfo;
                                ?>
                                </textarea>
                        </div>

                    </div>

                    <input type="hidden" name="compID" value="{{ $companyData->id }}">


                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="date">Issued Date</label>
                            <input type="date" class="form-control" id="issueDate" name="issueDate" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="date">Due Date</label>
                            <input type="date" class="form-control" id="dueDate" name="dueDate" required><div style="color: red;" id="remainingTime"></div>
                        </div>
                
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12">
                            @csrf
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
                                    <tr id="rowTemplate">
                                        <td>1</td>
                                        <td><input type="text" class="form-control" name="itemName[]" required></td>
                                        <td><input type="text" class="form-control quantity" name="quantity[]" required></td>
                                        <td><input type="text" class="form-control price" name="price[]" required></td>
                                        <td><input type="text" class="form-control amount" name="amount[]" readonly></td>
                                        <td>
                                            <div class="btn-group" style="float: right;">
                                                <button type="button" class="btn btn-primary fa fa-plus"></button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <!-- Total Amount -->
                            <div class="form-group">
                                <label for="totalAmount">Total Amount</label>
                                <input type="text" class="form-control" id="totalAmount" name="totalAmount" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="clientAdd">Payment</label>
                            <select class="form-control" name="payment" id="payment" required>
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
                        <a href="{{ route('invoice.page')}}" class="btn btn-danger btn-md">Cancel</a>
                        <button type="submit" id="formNew" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var today = new Date();
        var month = String(today.getMonth() + 1).padStart(2, '0');
        var day = String(today.getDate()).padStart(2, '0');
        var year = today.getFullYear();
        var formattedDate = year + '-' + month + '-' + day;
        document.getElementById("issueDate").value = formattedDate;
        document.getElementById("issueDate").setAttribute("readonly", "true");
    });
</script>
<script>
    $(document).ready(function() {
        var rowCounter = 1; // Initialize the row counter

        // Function to add a new row when the fa-plus button is clicked
        $('#formNew').on('click', '.fa-plus', function(e) {
            e.preventDefault();

            var newRow = $('#rowTemplate').clone(); // Clone the rowTemplate
            newRow.attr('id', 'row' + rowCounter); // Set a unique id for the new row
            newRow.find('input').val(''); // Clear the input values in the new row

            rowCounter++; // Increment the row counter

            // Increment the value of the "Bil" column in the new row
            newRow.find('td:first-child').text(rowCounter);

            // Append the new row to the table body
            $('#dataTable tbody').append(newRow);

            // Calculate the amount for the new row
            calculateAmount(newRow);
            calculateTotalAmount(); // Recalculate the total amount

            generateInvoiceNumber(); // Generate the invoice number
        });

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

        // Function to generate the invoice number
        function generateInvoiceNumber() {
            var prefix = 'INV';
            var currentYear = new Date().getFullYear();
            var formattedCounter = String(rowCounter).padStart(3, '0');
            var invoiceNumber = prefix + currentYear + formattedCounter;
            $('#invoiceNumber').text(invoiceNumber);
            $('#invoiceNumberInput').val(invoiceNumber);
        }

        // Calculate the amount when the quantity or price changes
        $('#formNew').on('keyup', '.quantity, .price', function() {
            var row = $(this).closest('tr');
            calculateAmount(row);
            calculateTotalAmount(); // Recalculate the total amount
        });

        // Calculate the amount for the first row on page load
        calculateAmount($('#rowTemplate'));

        // Set the initial value of the "Bil" column in the first row
        $('#rowTemplate').find('td:first-child').text(rowCounter);

        generateInvoiceNumber(); // Generate the invoice number for the first row on page load
    });
</script>

<script>
        const issueDateInput = document.getElementById("issueDate");
        const dueDateInput = document.getElementById("dueDate");
        const remainingTimeDiv = document.getElementById("remainingTime");

        // Event listener for when either issue date or due date is changed
        issueDateInput.addEventListener("change", calculateRemainingTime);
        dueDateInput.addEventListener("change", calculateRemainingTime);

        function calculateRemainingTime() {
            const issueDate = new Date(issueDateInput.value);
            const dueDate = new Date(dueDateInput.value);

            // Calculate the remaining time in milliseconds
            const remainingTime = dueDate - issueDate;

            // Convert the remaining time to days
            const remainingDays = Math.ceil(remainingTime / (1000 * 60 * 60 * 24));

            // Update the remainingTimeDiv with the result
            remainingTimeDiv.textContent = `Remaining time: ${remainingDays} days`;
        }
    </script>


@endsection