<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:pagos']);
        $this->middleware(['payment'])->except('index', 'create');
    }

    public function index(){
        return view('payment.index');
    }

    public function create(){
        $payment = new Payment();
        return view('payment.create', compact('payment'));
    }

    public function show(Payment $payment){
        return view('payment.show', compact('payment'));
    }

    public function edit(Payment $payment){
        return view('payment.edit', compact('payment'));
    }
}
