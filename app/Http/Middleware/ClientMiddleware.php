<?php

namespace App\Http\Middleware;

use App\Models\Client;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientMiddleware
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
        $client = Client::find($request->client->id);
        $userPresent = User::find(Auth::user()->id);
        if($client->user_id === $userPresent->id || $userPresent->hasRole('Administrador')){
            return $next($request);
        }else{
            session()->flash('alert','No puede intervenir en un cliente que no te pertenece');
            session()->flash('alert-type', 'warning');
            return redirect()->route('client.index');
        }
    }
}
