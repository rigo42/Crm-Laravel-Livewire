<?php

namespace App\Http\Middleware;

use App\Models\Payment;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $payment = Payment::find($request->payment->id);
        $userPresent = User::find(Auth::user()->id);
        if($payment->user_id === $userPresent->id || $userPresent->hasRole('Administrador')){
            return $next($request);
        }else{
            session()->flash('alert','No puede intervenir en un pago que no te pertenece');
            session()->flash('alert-type', 'warning');
            return redirect()->route('payment.index');
        }
    }
}
