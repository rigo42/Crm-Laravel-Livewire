<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:facturas']);
    }

    public function index(){
        return view('invoice.index');
    }

    public function create(){
        $invoice = new Invoice();
        return view('invoice.create', compact('invoice'));
    }

    public function show(Invoice $invoice){
        return view('invoice.show', compact('invoice'));
    }

    public function edit(Invoice $invoice){
        return view('invoice.edit', compact('invoice'));
    }
}
