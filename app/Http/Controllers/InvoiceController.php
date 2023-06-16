<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    //display new user 
    public function index()
    { //
        $invoiceList = DB::table('invoice')
            ->select(

                'id',
                'issueDate',
                'dueDate',
                'address',
                'remark',
                'userID',

            )
            ->orderBy('issueDate', 'asc')
            ->get();
        return view('invoice.invoice', compact('invoiceList'));
    }

    public function invoiceForm(Request $request)
    {

        $itemList = DB::table('item')
            ->select(
                'id',
                'bil',
                'itemName',
                'quantity',
                'price',
                'amount',
                'userID',

            )
            ->orderBy('bil', 'asc')
            ->get();
        return view('invoice.invoiceForm', compact('itemList'));
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


    public function addInvoice(Request $request)
    {

        $currUser = Auth::user()->id;

        $issueDate = $request->input('issueDate');
        $dueDate = $request->input('dueDate');
        $address = $request->input('address');
        $payment = $request->input('payment');
        $remark = $request->input('remark');
        $userID = $currUser;

        $data = array(


            'issueDate' => $issueDate,
            'dueDate' => $dueDate,
            'address' => $address,
            'payment' => $payment,
            'remark' => $remark,
            'userID' => $userID,

        );


        DB::table('invoice')->insert($data);

        return back()->with('success', 'Invoice successfully added');
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
            'userID' => $userID,

        );


        DB::table('company')->insert($data);

        return back()->with('success', 'Company successfully added');
    }

    public function compForm(Request $request)
    {

        return view('invoice.compForm');
    }

    
}
