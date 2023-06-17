<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Item;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    //display new user 
    public function index()
    { //
        $currUser = Auth::user()->id;
        $invoiceList = DB::table('invoices')
            ->join('company', 'invoices.compID', '=', 'company.id')
            ->select(

                'invoices.id as invoiceID',
                'invoices.issueDate',
                'invoices.dueDate',
                'invoices.remark',
                'invoices.status',
                'invoices.invoiceNumber',
                'invoices.userID',
                'company.id',
                'company.compName',
                'company.address',

            )
            ->orderBy('issueDate', 'asc')
            ->get();
        return view('invoice.invoice', compact('invoiceList'));
    }



    public function addItem(Request $request)
    {

        $currUser = Auth::user()->id;

        $bil = $request->input('bil');
        $itemName = $request->input('itemName');
        $quantity = $request->input('quantity');
        $price = $request->input('price');
        $amount = $request->input('amount');
        $userID = $currUser;

        $data = array(


            'bil' => $bil,
            'itemName' => $itemName,
            'quantity' => $quantity,
            'price' => $price,
            'amount' => $amount,
            'userID' => $userID,

        );


        DB::table('item')->insert($data);

        return back()->with('success', 'Item successfully added');
    }

    public function deleteItem(Request $request, $id)
    {
        if ($request->ajax()) {

            Item::where('id', '=', $id)->delete();
            return response()->json(array('success' => true));
        }
    }



    public function addItemForm(Request $request)
    {

        return view('invoice.addItemForm');
    }

    public function companyList(Request $request)
    {

        $companyList = DB::table('company')
            ->select(

                'id',
                'compName',
                'compPhone',
                'compEmail',
                'address',
                'invoiceID',

            )
            ->orderBy('compName', 'asc')
            ->get();
        return view('invoice.companyList', compact('companyList'));
    }

    public function addCompany(Request $request)
    {

        $currUser = Auth::user()->id;

        $compName = $request->input('compName');
        $compPhone = $request->input('compPhone');
        $email = $request->input('email');
        $address = $request->input('address');
        $userID = $currUser;

        $data = array(
            'compName' => $compName,
            'compPhone' => $compPhone,
            'compEmail' => $email,
            'address' => $address,

        );


        DB::table('company')->insert($data);

        return back()->with('success', 'Company successfully added');
    }

    public function compForm(Request $request)
    {

        return view('invoice.compForm');
    }

    public function invoiceForm(Request $request, $id)
    {

        $companyData = DB::table('company')
            ->select(

                'id',
                'compName',
                'compPhone',
                'compEmail',
                'address',

            )
            ->where('id', '=', $id)
            ->first();

        return view('invoice.invoiceForm', compact('companyData'));
    }

    function generateInvoiceNumber()
    {
        $prefix = 'INV';
        $currentYear = date('Y');
        $counter = Invoice::whereYear('created_at', $currentYear)->count() + 1;
        $formattedCounter = str_pad($counter, 3, '0', STR_PAD_LEFT);
        return $prefix . $currentYear . $formattedCounter;
    }

    // Generate a unique item ID
    function generateItemID()
    {
        return uniqid('ITEM');
    }


    public function addInvoice(Request $request)
    {
        // Retrieve the input data from the request
        $issueDate = $request->input('issueDate');
        $dueDate = $request->input('dueDate');
        $payment = $request->input('payment');
        $remark = $request->input('remark');
        $totalAmount = $request->input('totalAmount');
        $compID = $request->input('compID');
        $userID = auth()->user()->id;
        $itemName = $request->input('itemName');
        $quantity = $request->input('quantity');
        $price = $request->input('price');

        // Save the invoice data
        $invoice = new Invoice();
        $invoice->issueDate = $issueDate;
        $invoice->dueDate = $dueDate;
        $invoice->payment = $payment;
        $invoice->remark = $remark;
        $invoice->totalAmount = $totalAmount;
        $invoice->status = "Unpaid";
        $invoice->userID = $userID;
        $invoice->compID = $compID;
        $invoice->invoiceNumber = $this->generateInvoiceNumber();
        $invoice->save();

        // Save the item data
        $invID = $invoice->id;
        $itemCount = count($itemName);
        for ($i = 0; $i < $itemCount; $i++) {
            $item = new Item();
            $item->invID = $invID;
            $item->itemName = $itemName[$i];
            $item->quantity = $quantity[$i];
            $item->price = $price[$i];
            $item->amount = $quantity[$i] * $price[$i];
            $item->userID = $userID; // Generate the item ID
            $item->save();
        }

        // Redirect or return a response as needed
        return redirect()->back()->with('success', 'Invoice created successfully.');
    }

    public function viewInvoice($invID)
    {
        // Retrieve the invoice data based on the provided invoiceId
        $invoice = Invoice::findOrFail($invID);

        // Retrieve the items associated with the invoice
        $items = Item::where('invID', $invID)->get();


        $companyData = Company::findOrFail($invoice->compID);

        // Calculate the total amount
        $totalAmount = $items->sum('amount');

        // Pass the invoice and item data to the view
        return view('invoice.viewInvoice', compact('invoice', 'companyData', 'items', 'totalAmount'));
    }
}
