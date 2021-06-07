<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
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
        $user = User::find($request->user->id);
        $userPresent = User::find(Auth::user()->id);
        if($user->id === $userPresent->id || $userPresent->hasRole('Administrador')){
            return $next($request);
        }else{
            session()->flash('alert','No tienes los permisos suficientes');
            session()->flash('alert-type', 'warning');
            return redirect()->back();
        }
        
    }
}
