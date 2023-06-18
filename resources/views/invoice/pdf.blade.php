@extends('layouts.sideNav')
@section('content')

<style>
    .header-content {
        display: flex;
        align-items: flex-start;
    }

    .address-text {
        width: 500px;
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

<div id="invoiceContent">
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
                    <h3>IBI Services Sdn Bhd</h3>
                    <p>B-2-1 Ampang Tudor Court,Taman Rasmi Jaya,Jalan Dedap</p>
                    <p>68000 Ampang, Selangor.</p>
                    <p>Email: ibishq@ibis.com.my Phone Number: 09-773696</p>
                </div>
            </div>
        </div>
        <hr>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <input type="text" class="form-control" value="addtech" id="addTech" name="addTech" hidden>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <div class="date-label">
                                <label for="date">Invoice To</label>
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
                                    @if($invoice->status == 'Unpaid')
                                    <h4 style="color:red;">{{ $invoice->status }}</h4>
                                    @else
                                    <h4 style="color:green;">{{ $invoice->status }}</h4>
                                    @endif
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
                                <label for="bank"><strong>Payment in favor of 'IBI SERVICES'</strong></label>
                            </div>
                            <div class="date-value">
                                <label for="bank"><strong>Maybank Account No: 553010672276</strong></label>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <img id="main-logo" class="d-inline-block align-center mr-1" style="max-width: 150px;" src="{{ asset('frontend') }}/images/cop.png" alt="cop">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <div class="date-label">
                                <label for="bank"><strong>Generated automatically. No Signature is required</strong></label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div style="float: right;">

                <a type="button" id="cancel" class="btn btn-danger" href="{{ url()->previous() }}">Back</a>
                <button type="button" id="printBtn" class="btn btn-dark">Print</button>
            </div>
        </div>
    </div>
</div>
<script>
document.getElementById("printBtn").addEventListener("click", function() {
  var cardContent = document.querySelector(".card.mb-3").outerHTML;

  // Open a new window
  var win = window.open("", "_blank", "width=800,height=600");

  // Write the card content to the new window
  win.document.write("<html><head><title>Popup Window</title></head><body>" + cardContent + "</body></html>");

  // Add CSS styles for A4 size
  win.document.write('<style>@page { size: A4; margin: 0; }</style>');
  win.document.write('<style>body { margin: 0; }</style>');

  // Add CSS styles
  var linkTags = document.getElementsByTagName("link");
  for (var i = 0; i < linkTags.length; i++) {
    var linkTag = linkTags[i].cloneNode(true);
    win.document.head.appendChild(linkTag);
  }

  // Add inline styles
  var styleTags = document.getElementsByTagName("style");
  for (var j = 0; j < styleTags.length; j++) {
    var styleTag = styleTags[j].cloneNode(true);
    win.document.head.appendChild(styleTag);
  }

  // Hide buttons in the new window
  win.document.getElementById("cancel").style.display = "none";
  win.document.getElementById("printBtn").style.display = "none";

  // Print the window content
  win.print();
});

</script>
@endsection