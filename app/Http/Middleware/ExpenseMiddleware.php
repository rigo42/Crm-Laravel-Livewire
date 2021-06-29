<?php

namespace App\Http\Middleware;

use App\Models\Expense;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseMiddleware
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
        $expense = Expense::find($request->expense->id);
        $userPresent = User::find(Auth::user()->id);
        if($expense->user_id === $userPresent->id || $userPresent->hasRole('Administrador')){
            return $next($request);
        }else{
            session()->flash('alert','No puede intervenir en un gasto que no te pertenece');
            session()->flash('alert-type', 'warning');
            return redirect()->route('expense.index');
        }
    }
}
