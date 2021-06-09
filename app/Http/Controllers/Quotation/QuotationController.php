<?php

namespace App\Http\Controllers\Quotation;

use App\Http\Controllers\Controller;
use App\Models\Quotation;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:cotizaciones']);
    }

    public function index(){
        return view('quotation.index');
    }

    public function create(){
        $quotation = new Quotation();
        return view('quotation.create', compact('quotation'));
    }

    public function show(Quotation $quotation){
        return view('quotation.show', compact('quotation'));
    }

    public function edit(Quotation $quotation){
        return view('quotation.edit', compact('quotation'));
    }
}
