<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class InvoiceController extends Controller
{
    //display new user 
    public function index()
    { //
        $userRecord = DB::table('users')
            ->select(
                'id',
                'name',
                'staffID',
                'email',
                'phoneNum',
                'category',
                'salary',
                'employmentType'

            )
            ->orderBy('name', 'asc')
            ->get();
        return view('invoice.recordInvoice', compact('userRecord'));
    }

    public function invoiceForm(Request $request)
    {

        return view('invoice.invoiceForm');
    }
}
